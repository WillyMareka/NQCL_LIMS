<?php
require APPPATH.'core/MY_Labwork.php';
class Uniformity extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('testing');
    }
    
    function test(){
        error_reporting(0);
        $data['settings_view']='uniformity_v';
        $this->base_params($data);
    }
    function worksheet($labref){
    
        $rawform=  $this->justBringDosageForm($labref);
        $dosageForm=$rawform[0]->dosage_form;
        if($dosageForm=="2" || $dosageForm=="13"){
            $this->capsules($labref);
        }else if($dosageForm=="1"){
            $this->tabs($labref);
        }else if($dosageForm=="3"){
            $this->less_than_40($labref);
        }else if($dosageForm=="5" || $dosageForm=="6"){
            $this->sup_pes($labref);
        }
		
        }
    
   

    public function capsules() {
        $data = array();


        $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['repeat_no']= $this->getDoStatus();
        $data['test_id'] = $this->uri->segment(4);
        $data['settings_view'] = "uniformity_v_custom";
        $data['lastworksheet'] = $this->getWorksheet() + 1;




        $this->base_params($data);

        //echo $GLOBALS['labref'];
    }
    
    function less_than_40(){
        
         $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['repeat_no']= $this->getDoStatus();
        $data['test_id'] = $this->uri->segment(4);
        $data['settings_view'] = "uniformity_v_40";
        $data['lastworksheet'] = $this->getWorksheet() + 1;




        $this->base_params($data);
        
    }
    
    
        function sup_pes(){
        
         $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['repeat_no']= $this->getDoStatus();
        $data['test_id'] = $this->uri->segment(4);
        $data['settings_view'] = "uniformity_v_sup_pes";
        $data['lastworksheet'] = $this->getWorksheet() + 1;




        $this->base_params($data);
        
    }
    

    public function getWorksheet() {
        $res = mysql_query("SELECT MAX(id) AS lastId FROM worksheets");
        while ($row = mysql_fetch_assoc($res)) {
            $lastId = $row['lastId'];
        }
        return $lastId;
    }
    function getDoStatus(){
        $labref=  $this->uri->segment(3);
        $test_id=  $this->uri->segment(4);
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('sample_issuance')->result();
        return $result=$query[0]->done_status;     
        
    }

    function updateSampleIssuance(){
        $do_status=  $this->getDoStatus()+'1';
        $labref=  $this->uri->segment(3);
        $test_id=  $this->uri->segment(4);
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id',$analyst_id);
        $this->db->update('sample_issuance',array('do_count'=>$do_status));
    }
    public function save_capsule_weights() {
    
            $this->updateSampleIssuance();
            $labref = $this->uri->segment(3);
            $max_row_id = $this->getUniRepeatStatus($labref);
            (int) $new_status = (int) $max_row_id[0]->r_status + 1;
            $analyst_id = $this->session->userdata('user_id');

             $cw1 = $this->input->post('capsdata1');
         $cw2 = $this->input->post('capsdata2');
        
       for($i=0; $i<count($cw1);$i++){
        $tab_array=array(
           'labref'=>$labref,
          'tcsv'=>$cw1[$i],
          'ecsv'=>$cw2[$i],
            'csvc'=>'',
          'percent_deviation'=>'',
          'r_status'=>$new_status,
          'analyst_id'=>$analyst_id  
                );
          $this->db->insert('weight_uniformity',$tab_array);
       }

       $this->senttoExcel($labref);
     
            
            $this->save_totalaverage_weights();
            $this->updateTestIssuanceStatus();
            $this->updateSampleSummary();
            $this->post_posting();
            $this->updateTabsCapsCOADetails($labref);
             $test_id=  $this->uri->segment(4);
        $this->updateUploadStatus($labref, $test_id);
            //$sql1 = "UPDATE worksheets SET comment='$comment' WHERE labref='$labref'";
            //$j = mysql_query($sql1);

          

        redirect('analyst_controller/');
      
        
    }
    
     function senttoExcel($labref) {
    
             $cw1 = $this->input->post('capsdata1');
         $cw2 = $this->input->post('capsdata2');
        

              $file1 = "original_workbook/uniformity_multi.xlsx";
        $file2 = "Workbooks/".$labref."/".$labref.".xlsx";
     

        $objPHPExcel = PHPExcel_IOFactory::load($file2);
        $objPHPExcel2 = PHPExcel_IOFactory::load($file1);
       
        $name = $objPHPExcel2->getSheetByName('uniformity');
        $objPHPExcel->addExternalSheet($name);
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
         $worksheet=  $objPHPExcel->getActiveSheet();
        $row2 = 2;
        for ($i=0;$i<count($cw1);$i++ ){
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $cw1[$i])
                    ->setCellValueByColumnAndRow($col++, $row2, $cw2[$i]);
            $row2++;
        }
        //$worksheet->setCellValue('A1', $labref);

        $objPHPExcel->getActiveSheet()->setTitle("Uniformity");


        $dir = "workbooks";

        if (is_dir($dir)) {


            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            //$this->updateWorksheetNo();
            //$this->upDatePosting($labref);
            echo 'Data exported';
        } else {
            echo 'Dir does not exist';
        }
    }
    
    
    function updateTestIssuanceStatus(){
       $labref=  $this->uri->segment(3);
       
       $analyst_id=  $this->session->userdata('user_id');
       $done_status ='1';
       $data= array(
         'done_status'=>$done_status  
       );
       $this->db->where('lab_ref_no',$labref);
       $this->db->where('test_id',6);
       $this->db->where('analyst_id',$analyst_id);
       $this->db->update('sample_issuance',$data);
       
       $this->comparetToDecide($labref);
    
    }

    public function save_totalaverage_weights() {
        $this->load->database();
        if ($_POST):
            
           
            $labref = $this->uri->segment(3);
            $max_row_id = $this->getUniformityTestRepeatStatus($labref);
            (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
            
            $labref = $this->uri->segment(3);
            $analyst_id = $this->session->userdata('user_id');

            $average_weights = array(
                'labref' => $labref,
                'overall_total' => $overall_total = $this->input->post('utotals'),
                'overall_average' => $this->input->post('average'),
                'actual_total' => $this->input->post('totalss2'),
                'actual_average' => $actual_average = $this->input->post('uav3'),
                'cstatus'=> $this->input->post('comment'),
                'analyst_id' => $analyst_id,
                'repeat_status'=>$new_status
            );
            $this->db->insert('weight_caps_ta', $average_weights);
            $this->save_test();

            $average_weights1 = array(
                'labref' => $labref,
                'average' => $actual_average = $this->input->post('uav3'),
               
                'analyst_id' => $analyst_id
            );
            $this->db->insert('caps_tabs_data', $average_weights1);

      $uniformity_status=array(
      'labref'=>$labref,      
      'uniformity_status'=>1 ,
      'test_type'=>'TC',
      'analyst_id'=>$analyst_id
            
       );
       $this->db->insert('uniformity_status',$uniformity_status);

            return false;
        else :
            return true;
        endif;
    }
    
  function post_posting(){
        $labref=  $this->uri->segment(3);
        $posts=array(
            'labref'=>$labref,
            'component'=>'uniformity',
            'component_no'=>'0',
            'test_name'=>'Uniformity of Weight',
            'date_time'=>date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status',$posts);
    
     }
       function check_repeat_status(){
        $this->db->select_max('repeat_status');
        $this->db->where('labref',  $this->uri->segment(3));
        $this->db->where('test_name','uniformity');
        $query=  $this->db->get('tests_done');
        return $result=$query->result();
        
    }
   function save_test(){
       $labref=  $this->uri->segment(3);
        $priority=  $this->findPriority($labref);
        $urgency=$priority[0]->urgency;
        $data1=  $this->getAnalystId();
        $supervisor_id=$data1[0]->supervisor_id;
        
        $data=$this->check_repeat_status();
        $r_status= $data[0]->repeat_status;
        $new_r_status=$r_status+1;
        $analyst_id=  $this->session->userdata('user_id');
        
        $final_test_done=array(
            'labref'=>$labref,
            'test_name'=>'uniformity',
            'repeat_status'=>$new_r_status,
            'supervisor_id'=>$supervisor_id, 
            'test_subject'=>'uniformity_r',
            'analyst_id'=>$analyst_id,
            'priority'=>$urgency
        );
        $this->db->insert('tests_done',$final_test_done);
    }
       function updateSampleSummary(){
        $labref=  $this->uri->segment(3);
        $data = array(
            'determined' => $this->input->post('comment'),
            'complies' => $this->input->post('comment')
        );
        $this->db->where('test_id',6);
        $this->db->where('labref',$labref);
        $this->db->update('coa_body',$data);
    }
    
    function getAnalystId(){
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('analyst_supervisor');
        return $result=$query->result();
       // print_r($result);
    }

    public function getUniformityTestRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('weight_caps_ta');
        return $row = $query->result();
    }

    public function tabs() {   
        
        $data = array();
        $data['test_id']=$id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
         $data['repeat_no']= $this->getDoStatus();
        $data['settings_view'] = "tabs_v_custom";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $this->base_params_tabs($data);
    }

    public function tabs_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r']=$r = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
         $data['component']=$c=  $this->uri->segment(5);
        $data['no_of_pages'] = $this->printPages($labref);
        $data['tabs_results'] = $this->getTabs_v($labref, $r);
        $data['tabs_ta'] = $this->getTabsTotal($labref, $r);
        $module_name=  $this->uri->segment(1);

         $data['done']=  $this->checkApproval($module_name, $labref, $r, $c);
          $username=$this->getAnalystData();
        $new=$username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name',$new);
        $labref=  $this->uri->segment(3);
        $module=  $this->uri->segment(2);
        $this->session->set_userdata(array('labref'=>$labref,'module'=>$module));
        $data['settings_view'] = 'tabs_r_v';
        $this->base_params($data);
    }
       public function uniformity_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r']=$r = $this->uri->segment(4);
        $data['component']=$c=  $this->uri->segment(5);
          $module_name=  $this->uri->segment(1);
        $data['done']=  $this->checkApproval($module_name, $labref, $r, $c);   
        $analyst_id = $this->session->userdata('user_id');
        $data['caps_results'] = $this->getCaps_v($labref, $r);
       // print_r($data['caps_results']);
       $username=$this->getAnalystData();
        $new=$username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name',$new);
        $labref=  $this->uri->segment(3);
        $module=  $this->uri->segment(2);
        $this->session->set_userdata(array('labref'=>$labref,'module'=>$module));
        $data['caps_ta'] = $this->getUniformityTotal($labref, $r);
        $data['date_time']=  $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'uniformity_r_v';
        $this->base_params($data);
    }
    

            
        function printPages($labref) {
       $dataSource = $this->UniformityPages($labref);
       $new_number=(int)$dataSource;
       return $numbers = range(1, $new_number);
    }

    function UniformityPages($labref) {

        $rawform = $this->justBringDosageForm($labref);
        $dosageForm = $rawform[0]->dosage_form;
        if ($dosageForm == "2") {
            $query = $this->db
                    ->where('labref', $labref)
                    ->get('weight_caps_ta')
                    ->num_rows();
            return $query;
        } else if ($dosageForm == "1") {
            $query = $this->db
                    ->where('labref', $labref)
                    ->get('weight_tablets_ta')
                    ->num_rows();
            return $query;
        }
        
        
       
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
    

    
     function getUsername(){
            $this->db->select('analyst_name');
            $this->db->where('supervisor_id',  $this->session->userdata('user_id'));
            $query=  $this->db->get('analyst_supervisor');
            return $result=  $query->result();
           
        }
    function getTabs_v($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets');
        return $result = $query->result();
        //print_r($result);
    }

    function getTabsTotal($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets_ta');
        return $result = $query->result();
        //print_r($result);
    }
    
     function getCaps_v($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('r_status', $r);
        $query = $this->db->get('weight_uniformity');
        return $result = $query->result();
       // print_r($result);
    }

    function getUniformityTotal($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_caps_ta');
         return $result = $query->result();
      //  print_r($result);
    }
    
    public function approve_data(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $c=  $this->uri->segment(5);
      $supervisor_id=  $this->session->userdata('user_id');
       $supervisor=  $this->getSupervisorName();
       //print_r($supervisor);
       $supervisor_name=$supervisor[0]->fname." ".$supervisor[0]->lname;
       $analyst=  $this->getAnalystName();
       $analyst_name=$analyst[0]->analyst_name;
        $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;
       $approve_data=array(
           'supervisor_name'=>$supervisor_name,
           'analyst_name'=>$analyst_name,
           'labref'=>$labref,
           'repeat_status'=>$r,
           'test_name'=>'uniformity',
           'component_no'=>$c,
           'test_product'=>'csv',
           'supervisor_id'=>$supervisor_id,
           'user_type'=>'5',
           'status'=>'1',
           'priority'=>$urgency
       );
       $this->db->insert('supervisor_approvals',$approve_data);
       
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('component_no',$c);
       $this->db->where('test_name','uniformity');
       $this->db->update('tests_done',array('approval_status'=>'1'));
       
       
       $this->compareToDecide($labref);
       
       redirect('supervisors/home/'.$this->session->userdata('lab'));
       
       
    }
    
    public function approve(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $c=  $this->uri->segment(5);
       $status='1';
       $this->db->select('status');
       $this->db->where('status',$status);
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('component_no',$c);
       $this->db->where('test_name','uniformity');
       
       $query=  $this->db->get('supervisor_approvals');
       if($query->num_rows()>0){
           echo 'Already Approved';
       }else{
           $this->approve_data();  
       }
               
    }

    

function justBringDosageForm($labref){
    $this->db->select('dosage_form');
    $this->db->from('dosage_form df');
    $this->db->join('request r','df.id=r.dosage_form');
    $this->db->where('r.request_id',$labref);
    $query=  $this->db->get();
    return $result=$query->result();
    //print_r($result);
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
         function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
    
      public function getUniRepeatStatus($labref) {          
         $this->db->select_max('r_status');
         $this->db->where('labref',$labref);
         $query=  $this->db->get('weight_uniformity');        
         return $row = $query->result();
       // print_r($row);  
            
        }
        function repeats($labref){
            echo json_encode(
            $this->db
                    ->select('repeat_status')
                    ->where('labref',$labref)
                    ->get('caps_tabs_data')
                    ->result()
                    );
        }
    

    public function base_params($data) {
        $uri = $this->uri->segment(3);
        $data['title'] = "Weights and uniformity :" . $uri;
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

    public function base_params_tabs($data) {
        $uri = $this->uri->segment(3);
        $data['title'] = "Weights and uniformity - Tabs:" . $uri;
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
