<?php
class Excel_page extends CI_Controller{
  
    
    
    public function index() 
    { 
        $this->load->view('ex_v');
    }
    public function export_to_excel(){
        $date=date('d-M-y');
        $this->load->library('excel');
        $fname=  $this->input->post('name');
        $lname=  $this->input->post('lname');
        $name1=  $this->input->post('name1');
        $name2=  $this->input->post('lname1');
        
 
               $this->excel->setActiveSheetIndex(0) 
                               ->setCellValue('A1', $fname) 
                               ->setCellValue('B2', $lname) 
                               ->setCellValue('C1', $name1) 
                               ->setCellValue('D2', $name2); 
                $this->excel->getActiveSheet()->setTitle('Simple'); 
 
                $this->excel->setActiveSheetIndex(0); 
 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007'); 
 
                $objWriter->save(APPPATH."../excel/test"."$date.xlsx");  
                
                
                echo 'Data successfully exported to Excel';
               
}
}

?>
