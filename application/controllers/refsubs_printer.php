<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Refsubs_printer extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    function generate($status) {

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("refsubs_template/template.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $signatories = $this->getSignatories($status);

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $worksheet->setCellValue('A2', 'NQCL ' . $status . ' STANDARDS');
        $row2 = 4;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->standard_type)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->source)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->rs_code)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_received)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_of_expiry)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->potency . '' . $signatures->potency_unit)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->quantity)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->init_mass . '' . $signatures->init_mass_unit);

            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        unlink('refsubs_template/'.$status . "_standards.xlsx");
        $objWriter->save("refsubs_template/" . $status . "_standards.xlsx");


        echo 'Data exported';
    }

    function getSignatories($status) {
        if ($status == 'Expired') {
            return $this->db->where('status', $status)->get('refsubs')->result();
        } else {
            return $this->db->where('standard_type', $status)->get('refsubs')->result();
        }
    }

}
