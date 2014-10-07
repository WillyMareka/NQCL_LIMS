<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Wordexe extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Word');
    }

    function generate($labref) {
        $tests_requested = $this->getRequestedTests($labref);
        $information = $this->getRequestInformation($labref);
        $trd = $this->getRequestedTestsDisplay2($labref);
        $coa_details = $this->getAssayDissSummary($labref);
        $signatories = $this->getSignatories($labref);
        //create a new word document
        $word = new PHPWord();
        $word->setDefaultFontName('Book Antiqua');
        //create potrait orientation
        $section = $word->createSection();
        $tableStyle = array('cellMarginTop' => 80,
            'cellMarginLeft' => 90,
            $tableStyle = array('cellMarginTop' => 80,
        'cellMarginLeft' => 80,
        'cellMarginRight' => 80,
        'cellMarginBottom' => 80),
        'cellMarginRight' => 80,
        'cellMarginBottom' => 80);
        $table1 = $section->addTable($tableStyle);
        $styleTop = array('bold' => true, 'size' => 18, 'name' => 'Book Antiqua');
        $table1->addRow(400);
        $table1->addCell(9000)->addText('CERTIFICATE OF ANALYSIS', $styleTop);

        $section->addTextBreak(2);

        $table2 = $section->addTable($tableStyle);
        $styleTop1 = array('bold' => true, 'size' => 13, 'name' => 'Book Antiqua');
        $table2->addRow(200);
        $table2->addCell(7000)->addText('CERTIFICATE No: CAN/2013/', $styleTop1);

        $section->addTextBreak(2);

        $border = array('size' => 1, 'borderColor' => '000000');

        $table = $section->addTable($border);
        $style = array('bold' => true, 'size' => 11, 'name' => 'Book Antiqua');
        $style1 = array('bold' => true, 'size' => 11, 'name' => 'Book Antiqua');
        //header row
        $table->addRow(400, array('bgColor' => 'dbdbdb'));
        $table->addCell(2000, array('bgColor' => 'dbdbdb'))->addText('PRODUCT', $style);
        $table->addCell(3500, array('bgColor' => 'dbdbdb'))->addText($information[0]->product_name);
        $table->addCell(1500, array('bgColor' => 'dbdbdb'))->addText('REF. NO: ', $style1);
        $table->addCell(2000, array('bgColor' => 'dbdbdb'))->addText($information[0]->request_id);
        //Row 1
        $table->addRow(400);
        $table->addCell(2000, array('bgColor' => 'b1b1b1'))->addText('DATE RECEIVED' . $information[0]->designation_date);
        $table->addCell(2000)->addText('LABEL CLAIM');
        $table->addCell(5000)->addText($information[0]->label_claim);
        //Row 2
        $table->addRow(400);
        $table->addCell(2000, array('bgColor' => 'b1b1b1'))->addText('BATCH NO.' . $information[0]->batch_no);
        $table->addCell(2000)->addText('PRESENTATION');
        $table->addCell(5000)->addText($information[0]->presentation);

        //Row 3
        $table->addRow(400);
        $table->addCell(2000, array('bgColor' => 'b1b1b1'))->addText('MGF. DATE' . $information[0]->manufacture_date);
        $table->addCell(2000)->addText('MANUFACTURER');
        $table->addCell(5000)->addText($information[0]->manufacturer_name);

        //Row 4
        $table->addRow(400);
        $table->addCell(2000, array('bgColor' => 'b1b1b1'))->addText('EXP. DATE' . $information[0]->exp_date);
        $table->addCell(2000)->addText('ADDRESS');
        $table->addCell(5000)->addText($information[0]->manufacturer_add);

        //Row 5
        $table->addRow(400);
        $table->addCell(2000, array('bgColor' => 'b1b1b1'))->addText('CLIENT REF NO');
        $table->addCell(2000)->addText('CLIENT');
        $table->addCell(5000)->addText($information[0]->name . " " . $information[0]->address);


        //Row 6
        $table->addRow(400);
        $table->addCell(2000, array('bgColor' => 'b1b1b1'))->addText($information[0]->clientsampleref);
        $table->addCell(2000)->addText('TEST(S) REQUESTED');
        $table->addCell(5000)->addText($tests_requested);

        $section->addTextBreak(2);

        $style3 = array('bold' => true, 'size' => 9, 'name' => 'Book Antiqua');
        $table3 = $section->addTable();
        $table3->addRow(400, array('bgColor' => 'dbdbdb'));
        $table3->addCell(1500, array('bgColor' => 'dbdbdb'))->addText('TEST', $style3);
        $table3->addCell(1500, array('bgColor' => 'dbdbdb'))->addText('METHOD', $style3);
        $table3->addCell(1700, array('bgColor' => 'dbdbdb'))->addText('COMPEDIA', $style3);
        $table3->addCell(1800, array('bgColor' => 'dbdbdb'))->addText('SPECIFICATION', $style3);
        $table3->addCell(1700, array('bgColor' => 'dbdbdb'))->addText('DETERMINED', $style3);
        $table3->addCell(1500, array('bgColor' => 'dbdbdb'))->addText('REMARKS', $style3);

        for ($i = 0; $i < count($trd); $i++) {

            foreach ($coa_details as $coa) {

                if ($coa->test_id == $trd[$i]->test_id) {
                    $determined = $coa->determined;
                    $remarks = $coa->verdict;
                }
            }
            $table3->addRow(400);
            $table3->addCell(1500, array('bgColor' => 'dbdbdb'))->addText($trd[$i]->name);
            $table3->addCell(1500)->addText($trd[$i]->methods);
            $table3->addCell(1700)->addText($trd[$i]->compedia);
            $table3->addCell(1800)->addText($trd[$i]->specification);
            $table3->addCell(1700)->addText('DETERMINED', $style3);
            $table3->addCell(1500, array('bgColor' => 'dbdbdb'))->addText($trd[$i]->complies);
        }

        $section->addTextBreak(2);

        $table5 = $section->addTable();
        $table5->addRow(150);
        $table5->addCell(2000)->addText('CONCLUSION:', $style3);
        $table5->addCell(7000, array('bgColor' => 'dbdbdb'))->addText('The product complies with the specifications for the tests performed. ');

        $section->addTextBreak(2);

        $table4 = $section->addTable();
        foreach ($signatories as $signatures):
            $table4->addRow(100);
            $table4->addCell(1500)->addText($signatures->designation);
            $table4->addCell(2000)->addText($signatures->signature_name);
            $table4->addCell(2000)->addText($signatures->sign);
            $table4->addCell(1800)->addText('DATE:' . $signatures->date_signed);
        endforeach;


        // Save File
        $objWriter = PHPWord_IOFactory::createWriter($word, 'Word2007');
        $objWriter->save($labref . '.docx');
//        header('Content-Description: File Transfer');
//header('Content-type: application/force-download');
//header('Content-Disposition: attachment; filename='.basename('Text.docx'));
//header('Content-Transfer-Encoding: binary');
//header('Content-Length: '.filesize('Text.docx'));
//readfile('Text.docx');
        echo 'Text.docx created successfully';
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

}

?>
