<?php

class Tabs extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
        $this->load->library('encrypt');
        date_default_timezone_set('Asia/Kuwait');
    }
    
    function save_new_tablet_weights($labref){
       
        
        $max_row_id=  $this->getUniformityTestRepeatStatus($labref);
        (int)$new_status=(int)$max_row_id[0]->repeat_status +1;
        $analyst_id=  $this->session->userdata('user_id');
        
        $tablet_weight = $this->input->post('tabdata');
        
       for($i=0; $i<count($tablet_weight);$i++){
        $tab_array=array(
           'labref'=>$labref,
          'tcsv'=>$tablet_weight[$i],
          'percent_deviation'=>'',
          'repeat_status'=>$new_status,
          'analyst_id'=>$analyst_id  
                );
                $this->db->insert('weight_tablets',$tab_array);
       }
       
        $average_weights=array(
      'labref'=>$labref,      
      'total'=>'',
      'average'=>$actual_average=  $this->input->post('average'),
      'tstatus'=>'',
      'repeat_status'=>$new_status,
      'analyst_id'=>$analyst_id  
       );
     
       $this->db->insert('weight_tablets_ta',$average_weights);
   
      $average_weights1=array(
      'labref'=>$labref,      
      'average'=>$actual_average=  $this->input->post('average'),
      'test_status'=>'',
      'repeat_status'=>$new_status,
      'analyst_id'=>$analyst_id
       );
       $this->db->insert('caps_tabs_data',$average_weights1);
       
        $uniformity_status=array(
      'labref'=>$labref,      
      'uniformity_status'=>1 ,
            'test_type'=>'TC',
            'analyst_id'=>$analyst_id
            
       );
       
       $this->db->insert('uniformity_status',$uniformity_status);
       $test_id=  $this->uri->segment(4);
       $this->senttoExcel($labref); 
       $this->readExcelUpdate($labref, $new_status);
       $this->RegisterUniformityValues($labref, $new_status);
       $this->deletePDFgen($labref, $test_id, $analyst_id);
       $pdf_name=$labref.'_uniformity';
       $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
       $this->save_test();
       $this->updateTestIssuanceStatus();
       $this->updateSampleSummary();
       $this->post_posting();
      // $this->updateTabsCapsCOADetails($labref);
    
        $this->updateUploadStatus($labref, $test_id);
               
    }
    
    function readExcelUpdate($labref, $r){
        $last_id = $this->db->query("SELECT `id` FROM `weight_tablets` WHERE `labref`='$labref' AND `repeat_status`='$r' ORDER BY id ASC limit 1 ")->result();
       
        $file2 = "Workbooks/".$labref."/".$labref.".xlsx"; 
        $objPHPExcel = PHPExcel_IOFactory::load($file2);
        $worksheet = $objPHPExcel->setActiveSheetIndexByName('Uniformity');
        $start_id = $last_id[0]->id;
        for($i=24;$i<44;$i++){
            $cell = array(
                'percent_deviation'=>round($worksheet->getCell('D'.$i)->getCalculatedValue()*100,2)
            );   
            $this->db->where('id',$start_id)->update('weight_tablets',$cell);
             $start_id++;
        }
        
        $tarray = array(
            'total'=>round($worksheet->getCell('C45')->getCalculatedValue(),8),
            //'average'=>round($worksheet->getCell('C46')->getCalculatedValue(),4),
             'tstatus'=>round($worksheet->getCell('C49')->getCalculatedValue()* 100,4)
        );
        
        $this->db->where('labref',$labref)->where('repeat_status',$r)->update('weight_tablets_ta',$tarray);       
       
       
    }
    
    function senttoExcel($labref) {
    
        $tablet_weight = $this->input->post('tabdata');

              $file1 = "original_workbook/uniformity_tabs.xlsx";
        $file2 = "Workbooks/".$labref."/".$labref.".xlsx";
     

        $objPHPExcel = PHPExcel_IOFactory::load($file2);
        $objPHPExcel2 = PHPExcel_IOFactory::load($file1);
        
        
        $name = $objPHPExcel2->getSheetByName('Uniformity');
        $active = $objPHPExcel->getActiveSheetIndex();
        $objPHPExcel->removeSheetByIndex($active);
        $objPHPExcel->addExternalSheet($name);
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
         $worksheet=  $objPHPExcel->getActiveSheet();
        $row2 = 24;
        foreach ($tablet_weight as $weights):
            $col = 2;
            $worksheet
                    ->setCellValueByColumnAndRow($col, $row2, $weights);
            $row2++;
        endforeach;
        $worksheet->setCellValue('C15', $labref);

        $objPHPExcel->getActiveSheet()->setTitle("Uniformity");


        $dir = "workbooks";

        if (is_dir($dir)) {


            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $this->updateWorksheetNo();
            //$this->upDatePosting($labref);
            echo 'Data exported';
        } else {
            echo 'Dir does not exist';
        }
    }
    
    
         function RegisterUniformityValues($labref,$repeat_status) {
        if (file_exists('samplepdfs/'.$labref.'_uniformity.pdf')) {
           unlink('samplepdfs/'.$labref.'_uniformity.pdf');
        } else {
           // echo 'Not found';
        }
        $uniformity = $this->getTabs_v($labref, $repeat_status);
         $uniformity_d = $this->taverage($labref, $repeat_status);
        

        $full_name = 'samplepdfs/uniformity.pdf';     
        $pdf = new FPDI('P', 'mm', 'A4');
        $pdf->AliasNbPages();

        $pagecount = $pdf->setSourceFile($full_name);

        $i = 1;
        do {
            // add a page
            $pdf->AddPage();
            // import page
            $tplidx = $pdf->ImportPage($i);

            $pdf->useTemplate($tplidx, 10, 10, 200);

            $pdf->SetFont('Arial');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFontSize(8);
            
            $xa=1;
            $ya1=(int)56;
            
            for($u=0; $u<count($uniformity);$u++){
            
            $pdf->SetXY(53, $ya1+=5);
            $pdf->Write(1, $uniformity[$u]->tcsv);
            
            $pdf->SetXY(174, $ya1);
            $pdf->Write(1, $uniformity[$u]->percent_deviation);
            
          }
          
            $pdf->SetXY(53, 167);
            $pdf->Write(1, $uniformity_d[0]->total);
            
            
             $pdf->SetXY(53, 176);
            $pdf->Write(1, $uniformity_d[0]->average);
            
             $pdf->SetXY(63, 185);
            $pdf->Write(1, $uniformity_d[0]->tstatus);
            
          
          
       
       





            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/'.$labref.'_uniformity.pdf', 'F');
         
        echo 'Done';
    }
    
       function getTabs_v($labref, $r) {       
        $this->db->where('labref', $labref);       
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets');
        return $result = $query->result();
        //print_r($result);
    }
     function taverage($labref, $r) {       
        $this->db->where('labref', $labref);       
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets_ta');
        return $result = $query->result();
        //print_r($result);
    }

    public function save_tablet_weights() {
          if($_POST):
              $labref=$this->uri->segment(3);
       
         $max_row_id=  $this->getUniformityTestRepeatStatus($labref);
        (int)$new_status=(int)$max_row_id[0]->repeat_status +1;
        $analyst_id=  $this->session->userdata('user_id');
        
           $tcsv1 = $this->input->post('tcsv1');
            $dfm1 = $this->input->post('dfm1');
            $tcsv2 = $this->input->post('tcsv2');
            $dfm2 = $this->input->post('dfm2');
            $tcsv3 = $this->input->post('tcsv3');
            $dfm3 = $this->input->post('dfm3');
            $tcsv4 = $this->input->post('tcsv4');
            $dfm4 = $this->input->post('dfm4');
            $tcsv5 = $this->input->post('tcsv5');
            $dfm5 = $this->input->post('dfm5');
            $tcsv6 = $this->input->post('tcsv6');
            $dfm6 = $this->input->post('dfm6');
            $tcsv7 = $this->input->post('tcsv7');
            $dfm7 = $this->input->post('dfm7');
            $tcsv8 = $this->input->post('tcsv8');
            $dfm8 = $this->input->post('dfm8');
            $tcsv9 = $this->input->post('tcsv9');
            $dfm9 = $this->input->post('dfm9');
            $tcsv10 = $this->input->post('tcsv10');
            $dfm10 = $this->input->post('dfm10');
            $tcsv11 = $this->input->post('tcsv11');
            $dfm11 = $this->input->post('dfm11');
            $tcsv12 = $this->input->post('tcsv12');
            $dfm12 = $this->input->post('dfm12');
            $tcsv13 = $this->input->post('tcsv13');
            $dfm13 = $this->input->post('dfm13');
            $tcsv14 = $this->input->post('tcsv14');
            $dfm14 = $this->input->post('dfm14');
            $tcsv15 = $this->input->post('tcsv15');
            $dfm15 = $this->input->post('dfm15');
            $tcsv16 = $this->input->post('tcsv16');
            $dfm16 = $this->input->post('dfm16');
            $tcsv17 = $this->input->post('tcsv17');
            $dfm17 = $this->input->post('dfm17');
            $tcsv18 = $this->input->post('tcsv18');
            $dfm18 = $this->input->post('dfm18');
            $tcsv19 = $this->input->post('tcsv19');
             $dfm19 = $this->input->post('dfm19');
            $tcsv20 = $this->input->post('tcsv20');
            $dfm20 = $this->input->post('dfm20');
    
        
       
        
            $array = array(
                 0=>array('labref'=>$labref,'tcsv'=>$tcsv1,'percent_deviation'=>$dfm1,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,1=>array('labref'=>$labref,'tcsv'=>$tcsv2,'percent_deviation'=>$dfm2,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,2=>array('labref'=>$labref,'tcsv'=>$tcsv3,'percent_deviation'=>$dfm3,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,3=>array('labref'=>$labref,'tcsv'=>$tcsv4,'percent_deviation'=>$dfm4,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,4=>array('labref'=>$labref,'tcsv'=>$tcsv5,'percent_deviation'=>$dfm5,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,5=>array('labref'=>$labref,'tcsv'=>$tcsv6,'percent_deviation'=>$dfm6,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,6=>array('labref'=>$labref,'tcsv'=>$tcsv7,'percent_deviation'=>$dfm7,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,7=>array('labref'=>$labref,'tcsv'=>$tcsv8,'percent_deviation'=>$dfm8,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,8=>array('labref'=>$labref,'tcsv'=>$tcsv9,'percent_deviation'=>$dfm9,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,9=>array('labref'=>$labref,'tcsv'=>$tcsv10,'percent_deviation'=>$dfm10,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,10=>array('labref'=>$labref,'tcsv'=>$tcsv11,'percent_deviation'=>$dfm11,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,11=>array('labref'=>$labref,'tcsv'=>$tcsv12,'percent_deviation'=>$dfm12,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,12=>array('labref'=>$labref,'tcsv'=>$tcsv13,'percent_deviation'=>$dfm13,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,13=>array('labref'=>$labref,'tcsv'=>$tcsv14,'percent_deviation'=>$dfm14,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,14=>array('labref'=>$labref,'tcsv'=>$tcsv15,'percent_deviation'=>$dfm15,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,15=>array('labref'=>$labref,'tcsv'=>$tcsv16,'percent_deviation'=>$dfm16,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,16=>array('labref'=>$labref,'tcsv'=>$tcsv17,'percent_deviation'=>$dfm17,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,17=>array('labref'=>$labref,'tcsv'=>$tcsv18,'percent_deviation'=>$dfm18,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,18=>array('labref'=>$labref,'tcsv'=>$tcsv19,'percent_deviation'=>$dfm19,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                ,19=>array('labref'=>$labref,'tcsv'=>$tcsv20,'percent_deviation'=>$dfm20,'repeat_status'=>$new_status,'analyst_id'=>$analyst_id)
                                
    );
    foreach($array as $v){
    $sql = "INSERT INTO weight_tablets (labref,tcsv,percent_deviation,repeat_status,analyst_id)
    value
    ('{$v['labref']}','{$v['tcsv']}','{$v['percent_deviation']}','{$v['repeat_status']}','{$v['analyst_id']}')";
    //execute $sql here or it will overwrite on loop
    $k=mysql_query($sql);
    }
    
    $average_weights=array(
      'labref'=>$labref,      
      'total'=>$actual_total=  $this->input->post('totalss'),
      'average'=>$actual_average=  $this->input->post('average'),
      'tstatus'=>$tstatus =$this->input->post('tabStatus'),
      'repeat_status'=>$new_status,
      'analyst_id'=>$analyst_id  
       );
     
       $this->db->insert('weight_tablets_ta',$average_weights);
   
      $average_weights1=array(
      'labref'=>$labref,      
      'average'=>$actual_average=  $this->input->post('average'),
      'test_status'=>$tstatus =$this->input->post('tabStatus'),
      'repeat_status'=>$new_status,
      'analyst_id'=>$analyst_id
       );
       $this->db->insert('caps_tabs_data',$average_weights1);
       
        $uniformity_status=array(
      'labref'=>$labref,      
      'uniformity_status'=>1 ,
            'test_type'=>'TC',
            'analyst_id'=>$analyst_id
            
       );
       $this->db->insert('uniformity_status',$uniformity_status);
       
       $this->save_test();
       $this->updateTestIssuanceStatus();
       $this->updateSampleSummary();
       $this->post_posting();
       $this->updateTabsCapsCOADetails($labref);
        $test_id=  $this->uri->segment(4);
        $this->updateUploadStatus($labref, $test_id);
    
       
    if($k){
        redirect('analyst_controller/');
    }else{
       echo 'The error is:'. mysql_error();
    }
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
    function updateTestIssuanceStatus(){
       $labref=  $this->uri->segment(3);
       $test_id=  $this->uri->segment(4);
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
    
      public function getUniformityTestRepeatStatus($labref) {          
         $this->db->select_max('repeat_status');
         $this->db->where('labref',$labref);
         $query=  $this->db->get('weight_tablets_ta');        
         return $row = $query->result();
       // print_r($row);  
            
        }
        
    public function exportabs_to_excel() {
         if($_POST):
            $tcsv1 = $this->input->post('tcsv1');
            $dfm1 = $this->input->post('dfm1');
            $tcsv2 = $this->input->post('tcsv2');
            $dfm2 = $this->input->post('dfm2');
            $tcsv3 = $this->input->post('tcsv3');
            $dfm3 = $this->input->post('dfm3');
            $tcsv4 = $this->input->post('tcsv4');
            $dfm4 = $this->input->post('dfm4');
            $tcsv5 = $this->input->post('tcsv5');
            $dfm5 = $this->input->post('dfm5');
            $tcsv6 = $this->input->post('tcsv6');
            $dfm6 = $this->input->post('dfm6');
            $tcsv7 = $this->input->post('tcsv7');
            $dfm7 = $this->input->post('dfm7');
            $tcsv8 = $this->input->post('tcsv8');
            $dfm8 = $this->input->post('dfm8');
            $tcsv9 = $this->input->post('tcsv9');
            $dfm9 = $this->input->post('dfm9');
            $tcsv10 = $this->input->post('tcsv10');
            $dfm10 = $this->input->post('dfm10');
            $tcsv11 = $this->input->post('tcsv11');
            $dfm11 = $this->input->post('dfm11');
            $tcsv12 = $this->input->post('tcsv12');
            $dfm12 = $this->input->post('dfm12');
            $tcsv13 = $this->input->post('tcsv13');
            $dfm13 = $this->input->post('dfm13');
            $tcsv14 = $this->input->post('tcsv14');
            $dfm14 = $this->input->post('dfm14');
            $tcsv15 = $this->input->post('tcsv15');
            $dfm15 = $this->input->post('dfm15');
            $tcsv16 = $this->input->post('tcsv16');
            $dfm16 = $this->input->post('dfm16');
            $tcsv17 = $this->input->post('tcsv17');
            $dfm17 = $this->input->post('dfm17');
            $tcsv18 = $this->input->post('tcsv18');
            $dfm18 = $this->input->post('dfm18');
            $tcsv19 = $this->input->post('tcsv19');
            $dfm19 = $this->input->post('dfm19');
            $tcsv20 = $this->input->post('tcsv20');
            $dfm20 = $this->input->post('dfm20');
             $date=date('d-M-y');
             $labref=  $this->uri->segment(3);
              // var_dump($_POST);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        //we load the file that we want to read

        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
             
               $objPHPExcel->getActiveSheet() ;
               $objWorkSheet = $objPHPExcel->createSheet(1);
                              $objWorkSheet ->setCellValue('A22', 'Tablets(mg)') 
                               ->setCellValue('C22', 'Percentage Deviation') 
                               ->setCellValue('A24', $tcsv1) 
                               ->setCellValue('C24', $dfm1) 
                               ->setCellValue('A25', $tcsv2) 
                               ->setCellValue('C25', $dfm2)
                               ->setCellValue('A26', $tcsv3) 
                               ->setCellValue('C26', $dfm3) 
                               ->setCellValue('A27', $tcsv4) 
                               ->setCellValue('C27', $dfm4)
                               ->setCellValue('A28', $tcsv5) 
                               ->setCellValue('C28', $dfm5) 
                               ->setCellValue('A29', $tcsv6) 
                               ->setCellValue('C29', $dfm6)
                               ->setCellValue('A30', $tcsv7) 
                               ->setCellValue('C30', $dfm7) 
                               ->setCellValue('A31', $tcsv8) 
                               ->setCellValue('C31', $dfm8)
                               ->setCellValue('A32', $tcsv9) 
                               ->setCellValue('C32', $dfm9) 
                               ->setCellValue('A33', $tcsv10) 
                               ->setCellValue('C33', $dfm10)
                               ->setCellValue('A34', $tcsv11) 
                               ->setCellValue('C34', $dfm11) 
                               ->setCellValue('A35', $tcsv12) 
                               ->setCellValue('C35', $dfm12) 
                               ->setCellValue('A36', $tcsv13) 
                               ->setCellValue('C36', $dfm13) 
                               ->setCellValue('A37', $tcsv14) 
                               ->setCellValue('C37', $dfm14) 
                               ->setCellValue('A38', $tcsv15) 
                               ->setCellValue('C38', $dfm15) 
                               ->setCellValue('A39', $tcsv16) 
                               ->setCellValue('C39', $dfm16) 
                               ->setCellValue('A40', $tcsv17) 
                               ->setCellValue('C40', $dfm17) 
                               ->setCellValue('A41', $tcsv18) 
                               ->setCellValue('C41', $dfm18) 
                               ->setCellValue('A42', $tcsv19) 
                               ->setCellValue('C42', $dfm19) 
                               ->setCellValue('A43', $tcsv20) 
                               ->setCellValue('C43', $dfm20) ;
      
            // $objPHPExcel->setTitle("uniformity: Tabs");

        $dir = "workbooks";
        
        if (is_dir($dir)) {
            
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('NQCL');
        $objDrawing->setDescription('The Image that I am inserting');
        $objDrawing->setPath('exclusive_image/nqcl.png');
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
             
                  
             echo 'Data exported';
        } else {
            echo 'Dir does not exist';
            
        }
        
                
                
                return true;
                else:
                return false;
                endif;
    }
    function postRepeatReason(){
     
       $labref=  $this->uri->segment(3);      
       $reason=  $this->input->post('why');
       $array=array(
          'labref'=>$labref,
           'test'=>'uniformity',
           'reason'=>$reason
       );
       $this->db->insert('repeat_reason',$array);
      echo 'success';
    }
    
     public function approve_data(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;
      $supervisor_id=  $this->session->userdata('user_id');
       $supervisor=  $this->getSupervisorName();
       //print_r($supervisor);
       $supervisor_name=$supervisor[0]->fname." ".$supervisor[0]->lname;
       $analyst=  $this->getAnalystName();
       $analyst_name=$analyst[0]->analyst_name;
       
       $approve_data=array(
           'supervisor_name'=>$supervisor_name,
           'analyst_name'=>$analyst_name,
           'labref'=>$labref,
           'repeat_status'=>$r,
           'test_name'=>'uniformity',
           'test_product'=>'Tablets',
           'supervisor_id'=>$supervisor_id,
           'user_type'=>'5',
           'status'=>'1',
           'priority'=>$urgency
       );
       $this->db->insert('supervisor_approvals',$approve_data);
       
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('test_name','uniformity');
       $this->db->update('tests_done',array('approval_status'=>'1'));
       
       $this->compareToDecide($labref);
       
       redirect('supervisors/home/'.$this->session->userdata('lab'));
       
       
    }
     public function approve(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);   
      
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('test_name','uniformity');
            $query=  $this->db->get('supervisor_approvals');
       if($query->num_rows()>0){
           echo 'Already Approved';
       }else{
           $this->approve_data();  
       }
               
    }
        
    public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
         return $result = $query->result();
       // print_r($result);
    }

    public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }
      public function getWorksheet() {
    $res=  mysql_query("SELECT MAX(id) AS lastId FROM worksheets");
        while ($row = mysql_fetch_assoc($res)) {
           $lastId=$row['lastId'];
            
        }
        return $lastId;
        
    } 
    function check_repeat_status(){
        $this->db->select_max('repeat_status');
        $this->db->where('labref',  $this->uri->segment(3));
        $this->db->where('test_name','uniformity');
        $query=  $this->db->get('tests_done');
        return $result=$query->result();
        
    }
     function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
   function save_test(){
        $data1=  $this->getAnalystId();
        $supervisor_id=$data1[0]->supervisor_id;
        $labref=  $this->uri->segment(3);
        $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;
        $data=$this->check_repeat_status();
        $r_status= $data[0]->repeat_status;
        $new_r_status=$r_status+1;
        $analyst_id=  $this->session->userdata('user_id');
        
        $final_test_done=array(
            'labref'=>$labref,
            'test_name'=>'uniformity',
            'repeat_status'=>$new_r_status,
            'supervisor_id'=>$supervisor_id, 
            'test_subject'=>'tabs_r',
            'analyst_id'=>$analyst_id,
            'priority'=>$urgency
        );
        //$this->db->insert('tests_done',$final_test_done);
    }
    
    function updateSampleSummary(){
        $labref=  $this->uri->segment(3);
        $data = array(
            'remarks' => $this->input->post('comment')
        );
        $this->db->where('test_id',6);
        $this->db->where('labref',$labref);
        $this->db->update('sample_summary',$data);
    }
    
    function getAnalystId(){
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('analyst_supervisor');
        return $result=$query->result();
       // print_r($result);
    }
    
    function getDoStatus(){
        $labref=  $this->uri->segment(3);
        $test_id=  $this->uri->segment(4);
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('sample_issuance')->result();
        return $result=$query[0]->do_count;     
        
    }
    function show(){
        echo date('d-m-Y H:i:s');
    }
    
	public function base_params($data) {
		$data['title'] = "Weights and uniformity- Tabs";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "uniformity";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}
}