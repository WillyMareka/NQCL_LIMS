<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Export_tables extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    function export() {
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("COA/test.xlsx");
        $objPHPExcel->setActiveSheetIndexbyName('Sheet1');
        $worksheet = $objPHPExcel->getActiveSheet();
        $tables = $this->db->get('ground_slabs')->result();
        $row2 = 1;

        foreach ($tables as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->materials)
                    ->setCellValueByColumnAndRow($col++, $row2, str_replace(array('*','"','/',' ','.',"'",'(',')'),"_",$signatures->materials));

            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("COA/test.xlsx");


        echo 'Data exported';
    }

}
