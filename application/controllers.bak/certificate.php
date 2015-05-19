<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
    }

    function generate($labref) {

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("COA/" . $labref . "_COA" . ".xlsx");
        $objPHPExcel->setActiveSheetIndexbyName('COA');

        $tests_requested = $this->getRequestedTests($labref);
        $information = $this->getRequestInformation($labref);
        $trd = $this->getRequestedTestsDisplay2($labref);
        $coa_details = $this->getAssayDissSummary($labref);
        $signatories = $this->getSignatories($labref);
        $conclusion = $this->salvageConclusion($labref);
        $coa_number = $this->salvageCOANumbering();

        $objPHPExcel->getActiveSheet()
                ->setCellValue('C10', $information[0]->product_name)
                ->setCellValue('F10', $information[0]->request_id)
                ->setCellValue('B12', $information[0]->designation_date)
                ->setCellValue('D11', $information[0]->label_claim)
                ->setCellValue('B14', $information[0]->batch_no)
                ->setCellValue('D13', $information[0]->presentation)
                ->setCellValue('B16', $information[0]->manufacture_date)
                ->setCellValue('D15', $information[0]->manufacturer_name)
                ->setCellValue('D17', $information[0]->manufacturer_add)
                ->setCellValue('B18', $information[0]->exp_date)
                ->setCellValue('D19', $information[0]->name . " " . $information[0]->address)
                ->setCellValue('B21', $information[0]->clientsampleref)
                ->setCellValue('D21', $tests_requested)
                ->setCellValue('C36', $conclusion[0]->conclusion)
                ->setCellValue('B8', 'CERTIFICATE No: CAN/' . date('Y') . '/' . $coa_number[0]->number);

        $row = 26;
        $worksheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );



        for ($i = 0; $i < count($trd); $i++) {
            $col = 1;
            foreach ($coa_details as $coa) {
                if ($coa->test_id == $trd[$i]->test_id) {
                    $determined = $coa->determined;
                    $remarks = $coa->verdict;
                }
            }
            

            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row, $trd[$i]->name)
                    ->setCellValueByColumnAndRow($col++, $row, $trd[$i]->methods)
                    ->setCellValueByColumnAndRow($col++, $row, $trd[$i]->compedia)
                    ->setCellValueByColumnAndRow($col++, $row, $trd[$i]->specification);
         
                $worksheet->setCellValueByColumnAndRow($col++, $row, $determined);
           

            $worksheet->setCellValueByColumnAndRow($col++, $row, $trd[$i]->complies);
            //$worksheet->getStyle('B'.$row.':'.$col++,$row)->applyFromArray($styleArray);
            $row++;
        }


        $row2 = 38;

        foreach ($signatories as $signatures):
            $col = 1;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->designation)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->signature_name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->sign)
                    ->setCellValueByColumnAndRow($col++, $row2, 'DATE: ' . $signatures->date_signed);
            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle('COA');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("COA/" . $labref . "_COA" . ".xlsx");


        echo 'Data exported';
    }
    function salvageCOANumbering() {
        $this->db->select('number');
        $query = $this->db->get('coa_number');
        return $result = $query->result();
        //print_r($result);
    }
    

    function getRequestedTests($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $this->db->order_by('name', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
            return $object->name;
        }, $result);
        return $tests = implode(', ', $output);
    }

    function getRequestInformation($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        return $Information;
    }

    function getRequestedTestsDisplay2($labref) {
        $query = $this->db->query("SELECT  t.id as test_id, cb.method AS methods,`name` , `compedia`,`determined` , `specification`,complies
                                 FROM (
                                       `tests` t, `coa_body` cb
                                       )
                                JOIN `request_details` rd ON `t`.`id` = `cb`.`test_id`
                                WHERE `rd`.`request_id` = '$labref'
                                AND cb.labref = '$labref'
                                GROUP BY name
                                ORDER BY name DESC
                                LIMIT 0 , 30");
        $result = $query->result();
        // print_r($result);

        return $result;
        // print_r($result);
    }

    function getAssayDissSummary($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        $result = $query->result();
        // print_r($result);
        return $result;
    }

    function getSignatories($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('signature_table');
        return $result = $query->result();
        // print_r($result);
    }
    
        function salvageConclusion($labref) {
        $this->db->select('conclusion');
        $this->db->where('labref', $labref);
        $this->db->group_by('labref');
        $query = $this->db->get('coa_body');
        
        return $result = $query->result();
        //print_r($result);
    }
     
    
    
    

}
