<?php

class Related_substances extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function worksheet() {
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = "related_substances_v";
        $this->base_params($data);
    }
    
            function uploadSpace(){
        
        $data['test_id']= $this->uri->segment(4);
        $data['labref'] = $this->uri->segment(3);
       
        $data['settings_view'] = "rs_upload_v"; 
         $data['error'] = "";  
         $this->base_params($data);
    }

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 22);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->do_count;
    }

    function updateSampleIssuance() {
        $do_status = $this->getDoStatus() + '1';
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', array('do_count' => $do_status));
    }

    public function save() {
        $labref = $this->uri->segment(3);
         $this->do_upload();
        $this->updateSampleIssuance();
        $this->updateTestIssuanceStatus();
        //$this->updateSampleSummary();
        $this->post_posting();
        $this->updatepHCOADetails($labref);
        $this->save_test();
         $test_id=  $this->uri->segment(4);
        $this->updateUploadStatus($labref, $test_id);
               redirect('analyst_controller');

    }
    
            function do_upload() {
           
        $labref = $this->uri->segment(3);
        $target= 'workbooks/'.$labref.'/'.$labref.'.xlsx';
        $filename = $target;
        if(file_exists($filename)){
            unlink($filename);
        }

            $config['upload_path'] = "workbooks/".$labref;
            $config['allowed_types'] = 'xls|xlsx';


            $this->load->library('upload', $config);
            

            if (!$this->upload->do_upload('worksheet')) {
                 $data['test_id']=$this->uri->segment(4);
                $data['labref'] = $this->uri->segment(3);
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'rs_upload_v';
                $this->base_params($data);
            } else {
                $this->readexcel();
            }
        
    }
    
           public function readexcel() {
        $labref = $this->uri->segment(3);
        $max_row_id = $this->getpHRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
        $analyst_id = $this->session->userdata('user_id');
     
          $target= 'workbooks/'.$labref.'/'.$labref.'.xlsx';
        if (!file_exists("workbooks/" .$labref.'/'.$labref.'.xlsx')) {
            $data['error'] = 'You have uploaded an INVALID FILE or WORKSHEET!';
               $data['test_id']= $this->uri->segment(4);
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'rs_upload_v';
            $this->base_params($data);
        } else {

            
            $objReader = new PHPExcel_Reader_Excel2007();
            $path = $target;
            $objPHPExcel = $objReader->load($path);

            $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('related substances');
           
            if($this->checkIfExistsData($labref) > 0){
           $B4 = $objWorksheet->getCell('B6')->getValue();
            }else{
           $B4 = $objWorksheet->getCell('B5')->getValue();
  
            }
            
            if(\is_null($B4)){
                
            $data['error'] = 'The expected viscosity value was not found in cell B5 or B6!';
            $data['test_id']= $this->uri->segment(4);
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'rs_upload_v';
            $this->base_params($data);
            }else{
            
                 $post= array(
                'labref' => $labref, 
                'run' => $B4,
                'remarks' => '',
                'component' => 0,
                'analyst_id' => $analyst_id,
                'repeat_status' => $new_status
                    );      
        
      
            $this->db->insert('related_substances', $post); 
               $this->db->where('test_id', 22);
                $this->db->where('labref', $labref);
                $this->db->update('coa_body', array('determined'=>$B4));
             
            }
            
    } 
        }

    function checkIfExistsData($labref){
       $query=  $this->db
               ->where('labref',$labref)
               ->get('related_substances')
               ->num_rows();
       if($query > 0){
           return 1;
       }else{
           return 0;
       }
    }
    
    
    
    

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 22);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $posts = array(
            'labref' => $labref,
            'component' => 'related_substances',
            'component_no' => '0',
            'test_name' => 'related_substances',
            'date_time' => date('d-m-Y H:i:s:a')
        );
        $this->db->insert('posting_status', $posts);
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'related_substances');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function save_test() {
        $labref = $this->uri->segment(3);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;

        $data = $this->check_repeat_status();
        $r_status = $data[0]->repeat_status;
        $new_r_status = $r_status + 1;
        $analyst_id = $this->session->userdata('user_id');

        $final_test_done = array(
            'labref' => $labref,
            'test_name' => 'related_substances',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'related_substances_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function updateSampleSummary() {
        $labref = $this->uri->segment(3);
        $data = array(
            'determined' => $this->input->post('sampleph'),
            
        );
        $this->db->where('test_id', 22);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $data);
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }

    public function getDisintegrationTestRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('related_substances');
        return $row = $query->result();
    }

    public function related_substances_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
        $module_name = $this->uri->segment(1);
        $data['done'] = $this->checkApproval($module_name, $labref, $r, $c);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
       $data['rs'] = $this->getRSData($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'related_substances_r_v';
        $this->base_params($data);
    }
    
   function getRSData($labref, $r) {
       return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('related_substances')
                        ->result();
    }
    

    function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId_1($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('analyst_supervisor');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }

    function getAnalystId_1($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function getUsername() {
        $this->db->select('analyst_name');
        $this->db->where('supervisor_id', $this->session->userdata('user_id'));
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
    }

    public function approve_data() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        //print_r($supervisor);
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,
            'repeat_status' => $r,
            'test_name' => 'related_substances',
            'component_no' => $c,
            'test_product' => 'demo',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'related_substances');
        $this->db->update('tests_done', array('approval_status' => '1'));


        $this->compareToDecide($labref);

        redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'related_substances');

        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            echo 'Already Approved';
        } else {
            $this->approve_data();
        }
    }

    public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }

    public function getpHRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('related_substances');
        return $row = $query->result();
        // print_r($row);  
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('related_substances')
                        ->result()
        );
    }

    public function base_params($data) {
        $data['title'] = "Related Substances";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
