<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Relativity extends MY_Controller {

    function __construct() {
        parent::__construct();
        }
        
        function worksheet(){
             $data['test_id']=$this->uri->segment(4);
            $data['labref']=  $this->uri->segment(3);
            $data['settings_view']='relative_density_v';
            $this->base_params($data);
            
        }
        
        function getDoStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 17);
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
        $max_row_id = $this->getRdRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
        $analyst_id = $this->session->userdata('user_id');
        
       

        $rda = array(
            0 => array('labref' => $labref, 'pyknometer_water' => $this->input->post('pykwater'),'pyknometer_sample' => $this->input->post('pyksample'),  'analyst_id' => $analyst_id, 'repeat_status' => $new_status),
            1 => array('labref' => $labref, 'pyknometer_water' => $this->input->post('pykwater2'), 'pyknometer_sample' => $this->input->post('pyksample2'), 'analyst_id' => $analyst_id, 'repeat_status' => $new_status),
            2 => array('labref' => $labref, 'pyknometer_water' => $this->input->post('pykwater3'), 'pyknometer_sample' => $this->input->post('pyksample3'),  'analyst_id' => $analyst_id, 'repeat_status' => $new_status),
            3 => array('labref' => $labref, 'pyknometer_water' => $this->input->post('pykwater4'),  'pyknometer_sample' => $this->input->post('pyksample4'),'analyst_id' => $analyst_id, 'repeat_status' => $new_status)
            
        );
        foreach ($rda as $rd):
            $this->db->insert('relative_density_a', $rd);
        endforeach;
        
        $rdb=array(
            'labref'=>$labref,
            'pyknometer_mass'=>  $this->input->post('pykmass'),
            'meanofwater'=>$this->input->post('meanofwater'),
            'meanofsample'=>$this->input->post('meanofsample'),
            'massofwater'=>$this->input->post('maw'),
            'massofsample'=>$this->input->post('mos'),
            'relative_density'=>$this->input->post('srd'),
            'repeat_status'=>$new_status,
            'analyst_id'=>$analyst_id
           );
           $this->db->insert('relative_density_b',$rdb);
           
           $file1 = "original_workbook/RD.xlsx";
        $file2 = "Workbooks/".$labref."/".$labref.".xlsx";
       // $outputFile = "Workbooks/".$labref."/".$labref.".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);
        $objPHPExcel2 = PHPExcel_IOFactory::load($file1);

        $name = $objPHPExcel2->getSheetByName('Relative Density');
        $objPHPExcel->addExternalSheet($name);
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        // $objPHPExcel->setActiveSheetIndexbyName('Template');
          $objPHPExcel->getActiveSheet()
        

                    //Assay Standard Preparation desired  
                
                   // ->setCellValue('B36', $this->input->post('workingweight'))
                    ->setCellValue('A2', $this->input->post('pykmass'))
                    ->setCellValue('B2', $this->input->post('pykwater'))
                    ->setCellValue('B3', $this->input->post('pykwater2'))
                    ->setCellValue('B4', $this->input->post('pykwater3'))
                    ->setCellValue('C2',$this->input->post('pyksample'))
                    ->setCellValue('C3',$this->input->post('pyksample2'))
                    ->setCellValue('C4', $this->input->post('pyksample3'));         
             
$objPHPExcel->getActiveSheet()->setTitle('Relative density');
            $dir = "workbooks";

            if (is_dir($dir)) {           

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();
           // $this->upDatePosting($labref);
            echo 'Data exported';
          //  exit();
        } else {
            echo 'Dir does not exist';
            
        }   
           
           


        $this->updateSampleIssuance();
        $this->updateTestIssuanceStatus();
        $this->updateSampleSummary();
        $this->post_posting();
        $this->save_test();
         $test_id=  $this->uri->segment(4);
        $this->updateUploadStatus($labref, $test_id);
        //$this->updatepHCOADetails($labref);
      
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 17);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $posts = array(
            'labref' => $labref,
            'component' => 'relative_density',
            'component_no' => '0',
            'test_name' => 'relative_density',
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'relative_density');
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
            'test_name' => 'relativity',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'relativity_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function updateSampleSummary() {
        $labref = $this->uri->segment(3);
        $data = array(
            'determined' => $this->input->post('srd'),
            'specification' => $this->input->post('srd')
        );
        $this->db->where('test_id', 17);
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

  

    public function relativity_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
        $module_name = $this->uri->segment(1);
        $data['done'] = $this->checkApproval($module_name, $labref, $r, $c);  
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;    
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        $data['rda'] = $this->getRda($labref, $r);
        $data['rdb'] = $this->getRdb($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'relative_density_r_v';
        $this->base_params($data);
    }
    
          function getRda($labref,$r){
            return $this->db
                    ->where('labref',$labref)
                    ->where('repeat_status',$r)
                    ->get('relative_density_a')
                    ->result();
        }
            function getRdb($labref,$r){
            return $this->db
                    ->where('labref',$labref)
                    ->where('repeat_status',$r)
                    ->get('relative_density_b')
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
            'test_name' => 'relativity',
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
        $this->db->where('test_name', 'relativity');
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
        $this->db->where('test_name', 'relativity');

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

    public function getRdRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('relative_density_a');
        return $row = $query->result();
        // print_r($row);  
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('relative_density_b')
                        ->result()
        );
    }
        
        public function base_params($data) {
        $data['title'] = "Relative Density";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}