<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Upload extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
        $this->load->library('excel');
        date_default_timezone_set('Asia/Kuwait');
    }
    
    function audit_trail() {
        $this->logger();
    }
    
    function reviewer_uploads(){
            
        $data['labref'] = $this->uri->segment(3);
        $data['error'] = '';
        $data['settings_view'] = 'reviewer_upload_v';
        //$data['supervisor'] = $this->getMySupervisor();
        $this->base_params($data);
    
    }
    
    
    
    function get_data(){
        $test_id= $this->input->post('test');
        $component= $this->input->post('component');
        $average = $test_id= $this->input->post('average');
        $rsd =$test_id= $this->input->post('rsd');
        $n = $test_id= $this->input->post('n');
        
        echo $component.' '. $average.'% (RSD = '.$rsd.'%; n= '.$n.'%)';
    }
    
    function readWorkbook($labref) {

        }
    

    function worksheet($labref) {
        $data['labref'] = $this->uri->segment(3);
         $data['test_id'] = $this->uri->segment(5);
        $data['error'] = '';
        if($this->uri->segment(5) <= 0){
            $data['assay']=  $this->loadAssay($labref);
            $data['dissolution']=  $this->loadDissolution($labref);
           $data['settings_view'] = 'upload_v_2_1'; 
        }else{
            $data['assay']=  $this->loadMicrobialAssay($labref);
            $data['dissolution']=  $this->loadBe($labref);
         $data['settings_view'] = 'upload_v_2_1_1';   
        }
        
        $this->base_params($data);
    }
     function final_coa_upload() {
        $data['labref'] = $this->uri->segment(3);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v_coa';
        $this->base_params($data);
    }
    
    function loadAssay($labref){
       return $this->db->where('test_id',2)->where('labref',$labref)->having('average > ', 0)->get('component_summary')->result(); 
    }
      function loadDissolution($labref){
       return $this->db->where('test_id',5)->where('labref',$labref)->having('average > ', 0)->get('component_summary')->result(); 
    }
    
     function loadMicrobialAssay($labref){
       return $this->db->where('test_id',49)->where('labref',$labref)->having('average > ', 0)->get('component_summary')->result(); 
    }
      function loadBe($labref){
       return $this->db->where('test_id',50)->where('labref',$labref)->having('average > ', 0)->get('component_summary')->result(); 
    }
    

    function do_upload() {

        $labref = $this->uri->segment(3);

        $filename = "reviewer_uploads/" . $labref . '.xlsx';
        unlink($filename);
        $config['upload_path'] = "reviewer_uploads";
        $config['allowed_types'] = 'xls|xlsx';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('worksheet')) {
            $data['labref'] = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            $data['test_id'] = $this->uri->segment(5);
            $data['settings_view'] = 'reviewer_upload_v';
            $this->base_params($data);
        } else {

            $this->readWorkbookUpdate($labref);
            echo 'Worksheet data is being edited, You will be redirected once update is complete.....';
            header('Refresh: 3; url='.  base_url()."reviewer");
        }
    }

    function do_upload_micro() {

        $labref = $this->uri->segment(3);
         $test_id = $this->uri->segment(4);
         if($test_id =='50'){
             $filename = "reviewer_uploads/" . $labref . '_microlal.xlsx';

         }elseif($test_id =='49'){
             $filename = "reviewer_uploads/" . $labref . '_micro.xlsx';

         }else
             {
             $filename = "reviewer_uploads/" . $labref . '.xlsx';
  
         }
         
        if (file_exists($filename)) {
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'file_present_v';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "reviewer_uploads";
            $config['allowed_types'] = 'xls|xlsx'; 
             
            


            $this->load->library('upload', $config);
            $this->SaveFileDetails();

            if (!$this->upload->do_upload('worksheet')) {
                $data['labref'] = $this->uri->segment(3);
                $data['error'] = $this->upload->display_errors();
                 $data['test_id'] = $this->uri->segment(5);
                $data['settings_view'] = 'upload_v_2';
                $this->base_params($data);
            } else {
                echo 'uploaded';
                $this->readexcel_micro();
            }
        }
    }
    
        function do_upload_coa() {

        $labref = $this->uri->segment(3);
        $filename = "final_certificates/" . $labref . '.xlsx';
        if (file_exists($filename)) {
            unlink($filename);
            $config['upload_path'] = "final_certificates";
            $config['allowed_types'] = 'xls|xlsx';


            $this->load->library('upload', $config);
          //  $this->SaveFileDetails();

            if (!$this->upload->do_upload('worksheet')) {
                $data['labref'] = $this->uri->segment(3);
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'upload_v_coa';
                $this->base_params($data);
            } else {
                $this->readexcel_and_protect($labref);
            }
        } else {

            $config['upload_path'] = "final_certificates";
            $config['allowed_types'] = 'xls|xlsx';


            $this->load->library('upload', $config);
           // $this->SaveFileDetails();

            if (!$this->upload->do_upload('worksheet')) {
                $data['labref'] = $this->uri->segment(3);
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'upload_v_coa';
                $this->base_params($data);
            } else {
                $this->updateDispatchRegister($labref);
                $this->readexcel_and_protect($labref);
            }
        }
    }
    
    function readexcel_and_protect($labref) {
        $randpass= rand(0, 8);
        $rand_a=  mt_rand(0, 9);
        $char1='`@#$%';
        $char2='^&*())_';
        $char0=';/.,[1`+-=';
        $password =$char0.$randpass.date('d/Y').$char1.$rand_a.$char2;
        //echo $password;
    
        $path = "final_certificates/" . $labref . "_COA.xlsx";
        $path1 = "final_certificates/" . $labref . "_COA1.xlsx";
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($path);
           
            $objPHPExcel->setActiveSheetIndex(0);
       
       $objPHPExcel->getActiveSheet()->getProtection()->setPassword($password);
       $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
        $objPHPExcel->getActiveSheet()->setTitle('COA');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
        unlink($path);
        $objWriter->save($path);
        unlink($path1);
        redirect('documentation/fromDirector/');
      

    }

    function success() {
        $config['upload_path'] = "reviewer_uploads";
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);
        $data['upload_data'] = $this->upload->data();
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = 'upload_success';
        $this->base_params($data);
    }

    function upload_re() {
        $data['labref'] = $this->uri->segment(3);
        $data['error'] = '';
        $data['settings_view'] = 'file_exists_v';
        $this->base_params($data);
    }

    function re_upload() {
        $labref = $this->uri->segment(3);
        $filename = "reviewer_uploads/" . $labref . '.xlsx';
        unlink($filename);

        $config['upload_path'] = "reviewer_uploads";
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('worksheet')) {
            $data['error'] = $this->upload->display_errors();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_v';
            $this->base_params($data);
        } else {
            $this->readexcel_update();

            $data['upload_data'] = $this->upload->data();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_success';
            $this->base_params($data);
        }
    }

    public function repeated_test() {
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = 'upload_v_repeat';
        $this->base_params($data);
    }

    public function do_upload_repeated() {

        $labref = $this->uri->segment(3);
        $filename = "repeated_tests/" . $labref . '.xlsx';
        if (file_exists($filename)) {
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'file_present_v';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "repeated_tests";
            $config['allowed_types'] = 'xls|xlsx';
            $config['file_name'] = $labref . ".xlsx";


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'upload_v';
                $this->base_params($data);
            } else {
                $this->readexcel_repeated();
            }
        }
    }

    public function readexcel_update() {
        // $analyst_id=  $this->session->userdata('user_id');
        $labref = $this->uri->segment(3);
        $objReader = new PHPExcel_Reader_Excel2007();
        $path = "reviewer_uploads/" . $labref . ".xlsx";
        $objPHPExcel = $objReader->load($path);

        $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sample Summary');
        $G75 = $objWorksheet->getCell('B10')->getValue();
        $G76 = $objWorksheet->getCell('B11')->getValue();
        $G77 = $objWorksheet->getCell('B12')->getValue();

        $E107 = $objWorksheet->getCell('B14')->getValue();
        $E108 = $objWorksheet->getCell('B15')->getValue();
        $E109 = $objWorksheet->getCell('B16')->getValue();

        $analyst_id = $this->session->userdata('user_id');

        $sample_assay_summary = array(
            'labref' => $labref,
            'average' => $G75,
            'rsd' => $G76,
            'n' => $G77,
            'analyst_id' => $analyst_id
        );
        $this->db->where('test_id',5);
        $this->db->where('labref', $labref);
        $this->db->update('sample_summary', $sample_assay_summary);


        $dissolution_summary = array(
            'labref' => $labref,
            'average' => $E107,
            'rsd' => $E108,
            'n' => $E109,
            'analyst_id' => $analyst_id
        );
        $this->db->where('test_id',2);
        $this->db->where('labref', $labref);
        $this->db->update('sample_summary', $dissolution_summary);
    }
    
    function findMethodUsed(){
        
    }
    
    
        public function readexcel_micro() {
        $labref = $this->uri->segment(3);
         $test_id = $this->uri->segment(4);
       /* if (!file_exists("reviewer_uploads/" . $labref . '.xlsx')) {
            $data['error'] = 'You have uploaded an INVALID FILE or WORKSHEET!';
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_v';
            $this->base_params($data);
        } else {*/

      if($test_id =='50'){
          $this->bacterial_endotoxin();
      } else if($test_id =='49'){
          $this->microbial_assay();
      }else{
          $this->readexcel(); 
      }
        
    } 
    
    
    function microbial_assay(){
          $labref = $this->uri->segment(3);
                   $objReader = new PHPExcel_Reader_Excel2007();          
             $path = "reviewer_uploads/" . $labref . "_micro.xlsx";              
            $objPHPExcel = $objReader->load($path);

            $objWorksheet = $objPHPExcel->getActiveSheet(0);
            //Assay components
            $B9 = $objWorksheet->getCell('C139')->getValue();
            /*$C9 = $objWorksheet->getCell('C9')->getValue();
            $D9 = $objWorksheet->getCell('D9')->getValue();
            $E9 = $objWorksheet->getCell('E9')->getValue();
            $F9 = $objWorksheet->getCell('F9')->getValue();*/
            
            //Assay
            $B10 = $objWorksheet->getCell('C139')->getValue();
            $B11 = $objWorksheet->getCell('C140')->getValue();
            $B12 = $objWorksheet->getCell('C141')->getValue();
            
            $C10 = $objWorksheet->getCell('E16')->getValue();
           /* $C11 = $objWorksheet->getCell('C11')->getValue();
            $C12 = $objWorksheet->getCell('C12')->getValue();
            
            $D10 = $objWorksheet->getCell('D10')->getValue();
            $D11 = $objWorksheet->getCell('D11')->getValue();
            $D12 = $objWorksheet->getCell('D12')->getValue();
            
            $E10 = $objWorksheet->getCell('E10')->getValue();
            $E11 = $objWorksheet->getCell('E11')->getValue();
            $E12 = $objWorksheet->getCell('E12')->getValue();
            
            $F10 = $objWorksheet->getCell('F10')->getValue();
            $F11 = $objWorksheet->getCell('F11')->getValue();
            $F12 = $objWorksheet->getCell('F12')->getValue(); */          
            
        
       
            
            
         //Assay Saving   
        if($B10==true && $C10==false){
            
      echo  $data = "$B9 $B10% (Rsd = $B11% ; n = $B12)";     
            $this->save_micro($data);
        }else if($B10==true && $C10==true && $D10==false){
          //  $data1= array('compedia'=>':','specification'=>':','complies'=>':');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12)";
            $this->save_micro($data);
           
        }else if($B10==true && $C10==true && $D10==true && $E10==false){
           //$data1= array('specification'=>'::','complies'=>'::');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12):$D9 $D10% (Rsd = $D11% ; n = $D12)";
             $this->save_micro($data);
             
        }else if($B10==true && $C10==true && $D10==true && $E10==true && $F10==false){
           // $data1= array('compedia'=>':::','specification'=>':::','complies'=>':::');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12):$D9 $D10% (Rsd = $D11% ; n = $D12):$E9 $E10% (Rsd = $E11% ; n = $E12)";
             $this->save_micro($data);
            
        }else if($B10==true && $C10==true && $D10==true && $E10==true && $F10==true ){
          //  $data1= array('compedia'=>'::::','specification'=>'::::','complies'=>'::::');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12):$D9 $D10% (Rsd = $D11% ; n = $D12):$E9 $E10% (Rsd = $E11% ; n = $E12):$F9 $F10% (Rsd = $F11% ; n = $F12)";
             $this->save_micro($data);
           
        }else{
            echo 'No data detecetd on the Worksheet <br>';
            echo "<a href=".site_url('reviewer').">Back</a>";
            unlink($path);
            die();
        }        
       

       $this->updateAccross();
       $this->updateAnalyst($labref);
     // $this->updateDispatchRegister($labref);  
    }
    
     function bacterial_endotoxin(){
          $labref = $this->uri->segment(3);
                   $objReader = new PHPExcel_Reader_Excel2007();          
             $path = "reviewer_uploads/" . $labref . "_microlal.xlsx";              
            $objPHPExcel = $objReader->load($path);

            $objWorksheet = $objPHPExcel->getActiveSheet(0);
 
            $B10 = $objWorksheet->getCell('D68')->getCalculatedValue();
                 
   
        if($B10==true ){
            
     echo   $data = $B10 .'EU/mg';
   
            $this->save_be($data);
       
        }else{
            echo 'No data deteceted on the Worksheet <br>';
            echo "<a href=".site_url('reviewer').">Back</a>";
            unlink($path);
            die();
        }        
       

       $this->updateAccross();
       $this->updateAnalyst($labref);
      //$this->updateDispatchRegister($labref);  
    }
    
    function post_results($labref) {
        $table = 'coa_body';
        $ass_r = $this->input->post('ass_r');
        $diss_r = $this->input->post('diss_r');
        $needle = ':';
        $ass_var = str_repeat($needle, substr_count($ass_r, $needle));
        $diss_var = str_repeat($needle, substr_count($diss_r, $needle));

        //exit();
        if($this->uri->segment(4) > 30){
        $this->db->where('labref', $labref)->where('test_id', 49)->update($table, array('determined' => $ass_r, 'complies' => $ass_var));
        $this->db->where('labref', $labref)->where('test_id', 50)->update($table, array('determined' => $diss_r, 'complies' => $diss_var));
        }else{
        $this->db->where('labref', $labref)->where('test_id', 2)->update($table, array('determined' => $ass_r, 'complies' => $ass_var));
        $this->db->where('labref', $labref)->where('test_id', 5)->update($table, array('determined' => $diss_r, 'complies' => $diss_var));  
        }
        $this->updateAccross();
        $this->updateAnalyst($labref);
        $this->updateDispatchRegister($labref);
    }

    public function readexcel($labref) {
        $labref = $this->uri->segment(3);
       /* if (!file_exists("reviewer_uploads/" . $labref . '.xlsx')) {
            $data['error'] = 'You have uploaded an INVALID FILE or WORKSHEET!';
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_v';
            $this->base_params($data);
        } else {*/

            $analyst_id = $this->session->userdata('user_id');

            $objReader = new PHPExcel_Reader_Excel2007();
            $path = "reviewer_uploads/" . $labref . ".xlsx";
            $objPHPExcel = $objReader->load($path);

            $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sample Summary');
            //Assay components
            $B9 = $objWorksheet->getCell('B9')->getValue();
            $C9 = $objWorksheet->getCell('C9')->getValue();
            $D9 = $objWorksheet->getCell('D9')->getValue();
            $E9 = $objWorksheet->getCell('E9')->getValue();
            $F9 = $objWorksheet->getCell('F9')->getValue();
            
            //Assay
            $B10 = $objWorksheet->getCell('H72')->getValue();
            $B11 = $objWorksheet->getCell('H73')->getValue();
            $B12 = $objWorksheet->getCell('H74')->getValue();
            
            $C10 = $objWorksheet->getCell('C10')->getValue();
            $C11 = $objWorksheet->getCell('C11')->getValue();
            $C12 = $objWorksheet->getCell('C12')->getValue();
            
            $D10 = $objWorksheet->getCell('D10')->getValue();
            $D11 = $objWorksheet->getCell('D11')->getValue();
            $D12 = $objWorksheet->getCell('D12')->getValue();
            
            $E10 = $objWorksheet->getCell('E10')->getValue();
            $E11 = $objWorksheet->getCell('E11')->getValue();
            $E12 = $objWorksheet->getCell('E12')->getValue();
            
            $F10 = $objWorksheet->getCell('F10')->getValue();
            $F11 = $objWorksheet->getCell('F11')->getValue();
            $F12 = $objWorksheet->getCell('F12')->getValue();           
            
        
            
            //Dissolution
            $C3 = $objWorksheet->getCell('C3')->getValue();
            $B14 = $objWorksheet->getCell('B14')->getValue();
            $B15 = $objWorksheet->getCell('B15')->getValue();
            $B16 = $objWorksheet->getCell('B16')->getValue();
            
            $C14 = $objWorksheet->getCell('H72')->getValue();
            $C15 = $objWorksheet->getCell('H73')->getValue();
            $C16 = $objWorksheet->getCell('H74')->getValue();
            
            $D14 = $objWorksheet->getCell('D14')->getValue();
            $D15 = $objWorksheet->getCell('D15')->getValue();
            $D16 = $objWorksheet->getCell('D16')->getValue();
           
            $E14 = $objWorksheet->getCell('E14')->getValue();
            $E15 = $objWorksheet->getCell('E15')->getValue();
            $E16 = $objWorksheet->getCell('E16')->getValue();
            
            $F14 = $objWorksheet->getCell('F14')->getValue();
            $F15 = $objWorksheet->getCell('F15')->getValue();
            $F16 = $objWorksheet->getCell('F16')->getValue();
            
            
         //Assay Saving   
        if($B10==true && $C10==false){
            
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12)";
            $this->save_assay($data);
        }else if($B10==true && $C10==true && $D10==false){
            $data1= array('compedia'=>':','specification'=>':','complies'=>':');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12)";
            $this->save_assay($data);
           // $this->save_assay1($data1);
        }else if($B10==true && $C10==true && $D10==true && $E10==false){
            $data1= array('specification'=>'::','complies'=>'::');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12):$D9 $D10% (Rsd = $D11% ; n = $D12)";
             $this->save_assay($data);
           //  $this->save_assay1($data1);
        }else if($B10==true && $C10==true && $D10==true && $E10==true && $F10==false){
            $data1= array('compedia'=>':::','specification'=>':::','complies'=>':::');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12):$D9 $D10% (Rsd = $D11% ; n = $D12):$E9 $E10% (Rsd = $E11% ; n = $E12)";
             $this->save_assay($data);
            // $this->save_assay1($data1);
        }else if($B10==true && $C10==true && $D10==true && $E10==true && $F10==true ){
            $data1= array('compedia'=>'::::','specification'=>'::::','complies'=>'::::');
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12):$C9 $C10% (Rsd = $C11% ; n = $C12):$D9 $D10% (Rsd = $D11% ; n = $D12):$E9 $E10% (Rsd = $E11% ; n = $E12):$F9 $F10% (Rsd = $F11% ; n = $F12)";
             $this->save_assay($data);
            // $this->save_assay1($data1);
        }else{
            echo 'No data detecetd on the Assay Summary worksheet';
        }
          
        
        
        if($C3==true && $B14==false){
        echo    $data = $C3;         
           $this->save_diss($data);
           //$this->output->enable_profiler();
         //  die();
              $data1= array('compedia'=>'::','specification'=>  $this->getTime($labref),'complies'=>'::');
          // $this->save_diss1($data1);
        }else{
        if($B14==true && $C14==false){
            $data = "$B9  $B14% (Rsd = $B15% ; n = $B16)";
            $this->save_diss($data);
        }else if($B14==true && $C14==true && $D14==false){
            $data1= array('compedia'=>':','specification'=>$this->getTime($labref),'complies'=>':');
            $data = "$B9  $B14% (Rsd = $B15% ; n = $B16):$C9 $C14% (Rsd = $C15% ; n = $C16)";
            $this->save_diss($data);
           //  $this->save_diss1($data1);
        }else if($B14==true && $C14==true && $D14==true && $E14==false){
            $data1= array('compedia'=>'::','specification'=>$this->getTime($labref),'complies'=>'::');
            $data = "$B9  $B14% (Rsd = $B15% ; n = $B16):$C9 $C14% (Rsd = $C15% ; n = $C16):$D9 $D14% (Rsd = $D15% ; n = $D16)";
             $this->save_diss($data);
            // $this->save_diss1($data1);
        }else if($B14==true && $C14==true && $D14==true && $E14==true && $F14==false){
            $data1= array('compedia'=>':::','specification'=>$this->getTime($labref),'complies'=>':::');
            $data = "$B9  $B14% (Rsd = $B15% ; n = $B16):$C9 $C14% (Rsd = $C15% ; n = $C16):$D9 $D14% (Rsd = $D15% ; n = $D16):$E9 $E14% (Rsd = $E15% ; n = $E16)";
             $this->save_diss($data);
            // $this->save_diss1($data1);
        }else if($B14==true && $C14==true && $D14==true && $E14==true && $F14==true ){
            $data1= array('compedia'=>'::::','specification'=>$this->getTime($labref),'complies'=>'::::');
            $data = "$B9  $B14% (Rsd = $B15% ; n = $B16):$C9 $C14% (Rsd = $C15% ; n = $C16):$D9 $D14% (Rsd = $D15% ; n = $D16):$E9 $E14% (Rsd = $E15% ; n = $E16):$F9 $F14% (Rsd = $F15% ; n = $F16)";
             $this->save_diss($data);
            // $this->save_diss1($data1);
        }else{
            echo 'No data detecetd on Dissolution worksheet';
        }
        }
         
         

       $this->updateAccross();
       $this->updateAnalyst($labref);
      //$this->updateDispatchRegister($labref);  
        
    } 
    
    
    function getTime($labref) {
        $sql= "SELECT  time_taken1,time_taken2,time_taken3,time_taken4,time_taken5  FROM `diss_mean` WHERE  labref='$labref'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //print_r($result);
        $time_array = array();
        foreach ($result as $time):
            for($i=1;$i<5;$i++){
               if($time['time_taken'.$i] != 0){
                   $time_statement = "After ". $time['time_taken'.$i]." min run";
                   array_push($time_array, $time_statement);
               }
            }
        endforeach;
        
        //var_dump($time_array);
        return implode(':', $time_array);
    }
        function updateAnalyst($labref){
           // $this->db->where('lab_ref_no',$labref);
                //$this->db->update('sample_issuance',array('u_stat'=>'1'));

    }
    function save_assay($data) {
        $labref = $this->uri->segment(3);     
    
        $assay_summary = array(
            'determined' => $data
           );
        $this->db->where('test_id', 5);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $assay_summary);

    }
    
    function save_micro($data) {
        $labref = $this->uri->segment(3);     
    $test_id=  $this->uri->segment(4);
   // $id=$test_id[0]->test_id;
        $assay_summary = array(
            'determined' => $data ,
         
                );
        $this->db->where('test_id', $test_id);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $assay_summary);

    }
    
        
    function save_be($data) {
        $labref = $this->uri->segment(3);     
    $test_id=  $this->uri->segment(4);
    //$id=$test_id[0]->test_id;
        $assay_summary = array(
            'determined' => $data ,
            'method'=>'LAL'
                );
        $this->db->where('test_id', $test_id);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $assay_summary);

    }
    
     function save_assay1($data) {
        $labref = $this->uri->segment(3);    
        $this->db->where('test_id', 5);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $data);

    }
    
    
    
        function save_diss($data) {
        $labref = $this->uri->segment(3);     
        echo $data;
        $dissolution_summary = array(
            'determined' => $data
           );
        $this->db->where('test_id', 2);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $dissolution_summary);
     }
    
     
            function save_diss1($data1) {        
        $labref = $this->uri->segment(3);   
        $this->db->where('test_id', 2);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $data1);
     }
    function updateAccross(){
        $labref=  $this->uri->segment(3);
      
        $this->letDocumentationKnow($labref);
        $this->addSampleTrackingInformation();
       if($this->uri->segment(4) > 30){
        $this->approveMicro();
        echo 'more';
       }else{
         $this->approve(); 
         echo 'less';
       }
        
    }

    function updateDispatchRegister($labref){

        //Update request
        $coa_done_status = 1;
        $request_update = array('coa_done_status'=> $coa_done_status);
        $request_where_array = array('request_id'=>$labref);
        $this -> db -> where($request_where_array);
        $this -> db -> update('request', $request_update);
    
        //Get coa related numbers from coa_number table
        $coa_no_data = Coa_number::getCoaNo($labref);
        $coa_serial = $coa_no_data['number'];
        $coa_no = $coa_no_data['full_number'];

        //Construct variables relevant to the dispatch register
        $invoice_no = $coa_serial."/".date('y');

        //Get quoted amount and update it as the invoiced amount*
        $dr_quoted_amount = Dispatch_register::getQuote($labref);
        $invoiced_amount = $dr_quoted_amount[0]['amount'];

		//Set archive status to sample issuance table.
        $archive_status = '1';
        $this -> db -> where(array('lab_ref_no' => $labref ));
        $this -> db -> update('sample_issuance', array('archive_status' => $archive_status));

		
        //Update dispatch_register
        $dr_where_array = array('request_id'=>$labref);
        $dr_update_array = array('cert_no' => $coa_no, 'invoice_no' => $invoice_no, 'invoiced_amount'=> $invoiced_amount);
        $this -> db -> where($dr_where_array);
        $this -> db -> update('dispatch_register', $dr_update_array);

    }
    
     function addSampleTrackingInformation() {
     
        $userInfo = $this->getUsersInfo();
       
        $activity = 'To Generate draft COA';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Reviewer';
        $to = 'Documentation';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date_added' => $date,
            'stage'=>'8',
            'current_location' => 'Documentation'
        );
        
           $this->db->insert('sample_details',array(
                     'labref' =>$labref,
                     'by'=>'Documentation',
                     'activity'=>'Draft COA', 
                     'user_id'=>'0',
                     'date_issued'=>date('Y-m-d')
                     
                 ));
        
            $this->db->where('labref', $labref);
               $this->db->where('activity','Review');
            $this->db->update('sample_details', array('date_returned'=>date('Y-m-d')));
        
        $this->db->where('labref', $labref);
        $this->db->update('worksheet_tracking', $array_data);
    }

    function getReviewer() {
        $analyst_id = $this->input->post('reviewer');
        $this->db->select('fname,lname');
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

 
    
    

    function identifyReviewer() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $Query = $this->db->get('user');
        return $result = $Query->result();
    }

    function letDocumentationKnow($labref) {
        $query = $this->db->where('labref',$labref)->get('reviewer_documentation')->num_rows();
        if($query > 0 ){
            echo 'Notice already Recorded';
        }else{
        $names = $this->identifyReviewer();
        $name = $names[0]->fname . " " . $names[0]->lname;
        $user_id = $this->session->userdata('user_id');
        $labref = $this->uri->segment(3);
        $date = date('Y-m-d H:i:s');
        $details = $name;
        $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;

        $data = array(
            'labref' => $labref,
            'reviewer_name' => $details,
            'time_rev_finished' => $date,
            'reviewer_id' => $user_id,
            'priority'=>$urgency
        );
        $this->db->insert('reviewer_documentation', $data);
    }

   
    }      
    
    
     function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
    
    function approve() {
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(3);
        $date = date('Y-m-d H:i:s');
        $data = array(
            'status' => '1',
            'time_done ' => $date
        );
       // $this->db->where('test_id', $test_id);
        $this->db->where('folder', $labref);
        $this->db->update('reviewer_worksheets', $data);
        

        
        $data1 = array(
            'a_stat' => '0',
            
        );
        $this->db->where('labref', $labref);
        $this->db->update('review_samples', $data1);
        
        
       // redirect('reviewer');
    }
    
       function approveMicro() {
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $date = date('Y-m-d H:i:s');
        $data = array(
            'status' => '1',
            'time_done ' => $date
        );
        $this->db->where('test_id', 49);
        $this->db->or_where('test_id', 50);
        $this->db->where('folder', $labref);
        $this->db->update('reviewer_worksheets', $data);
        

        
        $data1 = array(
            'a_stat' => '0',
            
        );
        $this->db->where('labref', $labref);
        $this->db->update('review_samples', $data1);
        
        
   
      $data2 = array(
       
            'method' => 'Microbial Assay'
        );
        $this->db->where('test_id', 49);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $data2);
        
         $data3 = array(
       
            'method' => 'LAL'
        );
        $this->db->where('test_id', 50);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $data3);
    
        
        
        redirect('reviewer');
    }

    public function readexcel_repeated() {
        $analyst_id=$this->session->userdata('user_id');
        $labref = $this->uri->segment(3);
        if (!file_exists("repeated_tests/" . $labref . '.xlsx')) {
            $data['error'] = 'You have uploaded an INVALID FILE or WORKSHEET!';
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_v_repeat';
            $this->base_params($data);
        } else {



            $objReader = new PHPExcel_Reader_Excel2007();
            $path = "reviewer_uploads/" . $labref . ".xlsx";
            $objPHPExcel = $objReader->load($path);

            $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sample Summary');
            $G75 = $objWorksheet->getCell('B10')->getValue();
            $G76 = $objWorksheet->getCell('B11')->getValue();
            $G77 = $objWorksheet->getCell('B12')->getValue();

            $E107 = $objWorksheet->getCell('B14')->getValue();
            $E108 = $objWorksheet->getCell('B15')->getValue();
            $E109 = $objWorksheet->getCell('B16')->getValue();

            $sample_assay_summary = array(
                'labref' => $labref,
                'average' => $G75,
                'rsd' => $G76,
                'n' => $G77,
                'analyst_id' => $analyst_id
            );
            $this->db->insert('sample_assay_summary', $sample_assay_summary);


            $dissolution_summary = array(
                'labref' => $labref,
                'average' => $E107,
                'rsd' => $E108,
                'n' => $E109,
                'analyst_id' => $analyst_id
            );
            $this->db->insert('dissolution_summary', $dissolution_summary);

            redirect('upload/success/' . $labref);
        }
    }

    public function SaveFileDetails() {
        $labref = $this->uri->segment(3);
        $file_details = array(
            'nqcl_number' => $labref,
            'filename' => $labref . '.xlsx'
        );
        $query = $this->db->insert('files', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "Upload Worksheet -" . $labref . '.xlsx';
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}

?>
