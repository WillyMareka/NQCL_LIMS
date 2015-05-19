<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Result_reader extends MY_Controller {

    function __construct() {
        parent::__construct();
       $this->load->library('excel');
    }
    
    
    function readResults($labref){
      $source = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
      $objPHPExcel = PHPExcel_IOFactory::load($source);
      $molecules = $this->getMolecules($labref);
      $worksheet_number = $objPHPExcel->getSheetCount();
      $worksheet_names = $objPHPExcel->getSheetNames();
      for ($i = 0; $i < count($molecules); $i++) {
          foreach ($worksheet_names as $name):
               $worksheet = $objPHPExcel->setActiveSheetIndexByName($name);
               if($name=='Uniformity'){
                 $m_name='Uniformity';
                  $deviation = $worksheet->getCell('G43')->getValue();
                  $worksheet->getCell('A150')->getValue();
               }else if($name == $molecules[$i]->name){
              $assay= array(
                  'labref'=>$labref,
                   'component'=>$m_name = $molecules[$i]->name,
                   'test_id'=> $test_id='2',
                   'average'=> $Average = $worksheet->getCell('H72')->getValue() * 100 ,
                    'rsd'=>$RSD = $worksheet->getCell('H73')->getValue(), 
                    'n'=>$n = $worksheet->getCell('H74')->getValue()
                   );
              
                   $this->db->insert('component_summary',$assay);
                    $dissolution1= array(
                   'labref'=>$labref,
                   'component'=>$m_name = $molecules[$i]->name,
                   'test_id'=> $test_id='5',
                   'average'=> $Average = $worksheet->getCell('F118')->getValue() * 100 ,
                    'rsd'=>$RSD = $worksheet->getCell('F119')->getValue(), 
                    'n'=>$n = $worksheet->getCell('F120')->getValue()
                   );
                   $this->db->insert('component_summary',$dissolution1);
                   $acidbuffer = $worksheet->getCell('F135')->getValue();
                   if(!empty($acidbuffer)){
                     $dissolution2= array(
                   'labref'=>$labref,
                   'component'=>$m_name = $molecules[$i]->name,
                   'test_id'=> $test_id='5',
                   'average'=> $Average = $worksheet->getCell('F135')->getValue() * 100 ,
                    'rsd'=>$RSD = $worksheet->getCell('F136')->getValue(), 
                    'n'=>$n = $worksheet->getCell('F137')->getValue()
                   );
                     $this->db->insert('component_summary',$dissolution2);
                   }else{
                       echo 'Not a multistage Dissolution <br>';
                   }
               }else if($name == 'Relative Density'){
                     $test_id= '17';
                    $m_name = 'Relative Density<br>';
                     echo $k = $worksheet->getCell('C39')->getValue().'<br>';
               }
                
             
          endforeach; 
          echo 'Successfully Inserted';
      }
      
      
      //echo $worksheet_number;

 

    }

}

