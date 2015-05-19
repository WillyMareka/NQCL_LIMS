<?php

class Excel_man extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }
    
    function index(){
        $this->load->view('excel_sample_v');
    }
    
    function accept(){
        $a= $this->input->post('a');
                
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');         

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            //$objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName('identification');
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B8', 'Procedure')
                    ->setCellValue('C8', $procedure)
                    ->setCellValue('B9', 'Findings')
                    ->setCellValue('C9', $finding)
                    ->setCellValue('B10', 'Specification')
                    ->setCellValue('C10', $specification)
                    ->setCellValue('C11', 'Worksheet No')
                    ->setCellValue('D11', $labref);
//             ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);

            $objPHPExcel->getActiveSheet()->setTitle('identification');


            $dir = "workbooks";

            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");


                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        
        
        
        
        for($i=0;$i<count($a); $i++){
           print_r($a[$i]); 
        }
    }

}

