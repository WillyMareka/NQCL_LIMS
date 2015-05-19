<?php

class Preservative_efficacy extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function worksheet() {
        $data['labref'] = $labref= $this->uri->segment(3);
        $data['test_id'] =$test_id= $this->uri->segment(4);
        $data['active']=  $this->getActiveIng($labref);
        $data['micro_number']=  $this->getMicroNumber($labref);
        $data['settings_view'] = "preservative_efficacy_v";
        $data['active']=  $this->getActiveIng($labref);
         $data['date']=  $this->findthedate($labref,$test_id);
        $this->base_params($data);
    }

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 15);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->do_count;
    }
    function getActiveIng($labref){
        return $this->db->select('name')->where('request_id',$labref)->get('components')->result();
    }
    function findthedate($labref,$test_id){
     return $this->db->select('created_at')->where('lab_ref_no',$labref)->where('test_id',$test_id)->get('sample_issuance')->result();

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
        $max_row_id = $this->getDisRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
        $analyst_id = $this->session->userdata('user_id');
                 $component = $this->input->post('active_ingredient');
          $max_component_row_id = $this->getDissComponentNo($labref, $component);
        $new_component = $max_component_row_id;
 
        $component_no = $new_component;

        $microlab = $this->input->post('microlab_no');
        $date_rec = $this->input->post('date_rec');
        $date_set = $this->input->post('date_set');
        $date_of_results = $this->input->post('date_of_results');
        $sample_preparation = $this->input->post('sp');
        $comply = $this->input->post('comply');
        $conclusion = $this->input->post('com');
        
        $A1 =  $this->input->post('A1');
        $A2 =  $this->input->post('A2');
        $A3 =  $this->input->post('A3');
        $A4 =  $this->input->post('A4');
        
        $B1 =  $this->input->post('B1');
        $B2 =  $this->input->post('B2');
        $B3 =  $this->input->post('B3');
        $B4 =  $this->input->post('B4');
        
        $average1 =$this->input->post('average');
        $average2 =$this->input->post('average2');
        $average3 =$this->input->post('average3');
        $average4 =$this->input->post('average4');
        
        
        $micro1 =$this->input->post('microrganism1');
        $micro2 =$this->input->post('microrganism2');
        $micro3 =$this->input->post('microrganism3');
        $micro4 =$this->input->post('microrganism4');
        
        $other_top = array(
                    'labref'=>$labref,
                    'component'=>$component,
                    'component_no'=>$component_no,
                    'repeat_status'=>$new_status,
                    'analyst_id'=>$analyst_id,
                    'micro_number'=>$microlab,
                    'date_recieved'=>$date_rec,
                    'date_test_set'=>$date_set,
                    'date_of_results'=>$date_of_results,                
                    'sample_preparation'=>$sample_preparation,  
                    'micro1'=>$micro1,
                    'micro2'=>$micro2,
                    'micro3'=>$micro3,
                    'micro4'=>$micro4,
                    'comply'=>$comply, 
                    'comments'=>$conclusion
                
        );        
        $this->db->insert('pt_top_info',$other_top);
        
        
       for($i=0;$i<count($A1);$i++){
          $ptcount= array(
                    'labref'=>$labref,
                    'component'=>$this->input->post('pname'),
                    'component_no'=>$component_no,
                    'repeat_status'=>$new_status,
                    'analyst_id'=>$analyst_id,                                   
                    'day_count1'=>$A1[$i],
                    'day_count2'=>$A2[$i],
                    'day_count3'=>$A3[$i],
                    'day_count4'=>$A4[$i],                  
                
            );
            $this->db->insert('pt_day_count',$ptcount);
       }
        
       
           for($i=0;$i<count($B1);$i++){
          $ptcount1= array(
                    'labref'=>$labref,
                    'component'=>$this->input->post('pname'),
                    'component_no'=>$component_no,
                    'repeat_status'=>$new_status,
                    'analyst_id'=>$analyst_id,                                   
                   'day_count1'=>$B1[$i],
                    'day_count2'=>$B2[$i],
                    'day_count3'=>$B3[$i],
                    'day_count4'=>$B4[$i],                  
                
            );
            $this->db->insert('pt_day_count_b',$ptcount1);
       }
       
             for($i=0;$i<count($average1);$i++){
          $avecount= array(
                    'labref'=>$labref,
                    'component'=>$this->input->post('pname'),
                    'component_no'=>$component_no,
                    'repeat_status'=>$new_status,
                    'analyst_id'=>$analyst_id,                                   
                    'day_avg1'=>$average1[$i],
                    'day_avg2'=>$average2[$i],
                    'day_avg3'=>$average3[$i],
                    'day_avg4'=>$average4[$i],                  
                
            );
            $this->db->insert('pt_day_count_average',$avecount);
       }
  
        
  



         $this->updateSampleIssuance();
          $this->updateTestIssuanceStatus();
          $this->updateSampleSummary();
          $this->post_posting();
          $this->save_test();
          $test_id=  $this->uri->segment(4);
          $this->updateUploadStatus($labref, $test_id);
          //$this->updateTabsCapsCOADetails($labref);
          //$sql1 = "UPDATE worksheets SET comment='$comment' WHERE labref='$labref'";
          //$j = mysql_query($sql1); */



       redirect('analyst_controller');
    }
    
        public function getDissComponentNo($labref, $component) {

        $query = $this->db->query("SELECT MAX( component_no ) as component_number , component
                                    FROM `pt_top_info`
                                    WHERE labref = '$labref' AND component='$component'");
        $row = $query->result();

        $mydata = $row[0]->component_number;
        if (empty($mydata)) {
            $query = $this->db->select_max('component_no')
                    ->where('labref', $labref)
                    ->get('pt_top_info')
                    ->result();
            $row_data = $query[0]->component_no + 1;
            return $mydata = $row_data;
        } else {
            return $mydata;
        }
    }
    
    
    function getDaycount($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_day_count')->result();
    }
     function getDayAverage($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_day_count_average')->result();
    }
     function getDayCountB($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_day_count_b')->result();
    }
     function getTopInfo($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_top_info')->result();
    }
     function getComSpec($labref,$r) {
        return $this->db->where('labref',$labref)->where('test_id',15)->get('coa_body')->result();
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 15);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $posts = array(
            'labref' => $labref,
            'component' => 'sterility',
            'component_no' => '0',
            'test_name' => 'sterility',
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'sterility');
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
            'test_name' => 'preservative_efficacy',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'preservative_efficacy_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function updateSampleSummary() {
        $labref = $this->uri->segment(3);
      $data = array(
       
            'method' => 'Preservative Efficacy'
        );
        $this->db->where('test_id', 15);
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
        $query = $this->db->get('sterility');
        return $row = $query->result();
    }

    public function preservative_efficacy_r() {
        
        $module_name = $this->uri->segment(1);
        $module = $this->uri->segment(2);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
        $data['done'] = $this->checkApproval($module_name, $labref, $r, $c);
        //$data['caps_results'] = $this->getCaps_v($labref, $r);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        $this->session->set_userdata('mail_name', $new);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        $data['d_count']=  $this->getDaycount($labref ,$r);
        $data['d_countb']=  $this->getDaycountB($labref ,$r);
        $data['d_average']=  $this->getDayAverage($labref ,$r);
        $data['d_info']=  $this->getTopInfo($labref ,$r);     
        $data['comspec']=  $this->getComSpec($labref ,$r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'preservative_efficacy_r_v';
        $this->base_params($data);
    }

    function getDisintegrationData($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('sterility')
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
            'test_name' => 'preservative_efficacy',
            'component_no' => $c,
            'test_product' => 'demo',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency,
              
        );
        $this->db->insert('supervisor_approvals', $approve_data);

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'preservative_efficacy');
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
        $this->db->where('test_name', 'preservative_efficacy');

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

    public function getDisRepeatStatus($labref) {
       $component = $this->input->post('pname');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
         $this->db->where('component', $component);
        $query = $this->db->get('pt_top_info');
        return $row = $query->result();
        // print_r($row);  
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('sterilityt')
                        ->result()
        );
    }

    public function base_params($data) {
        $data['title'] = "Preservative Efficacy";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
