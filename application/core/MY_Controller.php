<?php

include APPPATH.'third_party/PDFMerger.php';

class MY_Controller extends CI_Controller {

    public $labref;

    function __construct() {
        parent::__construct();
        $this->load->library(array('Excel', 'Log'));       
    
    }
    
      function getMolecules($labref) {
        return $this->db->where('request_id', $labref)->get('components')->result();
    }
    function getTracking($labref) {
        return $this->db->where('labref',$labref)->get('sample_details')->result();
    }

    function getStandards($labref) {
        return $this->db->query("SELECT * FROM refsubs_usage s, refsubs r WHERE s.refsubs_id = r.id AND s.request_id='$labref'")->result();
    }

    function getEquipment($labref) {
        return $this->db->query("SELECT * FROM equipment_usage eu, equipment e WHERE eu.equipment_id = e.id AND eu.request_id='$labref' ")->result();
    }

    function getReagents($labref) {
        return $this->db->query("SELECT * FROM reagents_usage ru, reagents r WHERE ru.reagent_id = r.id AND ru.request_id='$labref' ")->result();
    }

    function getColumnsChromaCA($labref) {
        return $this->db->query("SELECT * FROM chromatographic_conditions cc, columns c, column_types ct WHERE cc.column_id = c.id AND ct.id = c.column_id AND cc.test_id='5' AND cc.request_id='$labref'")->result();
    }
    function getColumnsChromaCD($labref) {
        return $this->db->query("SELECT * FROM chromatographic_conditions cc, columns c, column_types ct WHERE cc.column_id = c.id AND ct.id = c.column_id AND cc.test_id='2' AND cc.request_id='$labref'")->result();
    }

    function deletePDFgen($labref,$test_id,$analyst_id){
   $this->db->where('request_id',$labref)->where('test_id',$test_id)->where('analyst_id',$analyst_id)->delete('pdf_test_generator');

    }
    
    function insertPDFgen($labref,$pdf_name,$test_id,$analyst_id){
        $pdf = array(
            'request_id'=>$labref,
            'full_name'=>$pdf_name,
            'test_id'=>$test_id,
            'analyst_id'=>$analyst_id
        );
        $this->db->insert('pdf_test_generator',$pdf);
    }
    
    function samples($labref){
        $user = $this->session->userdata('user_id');
        return $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging 
			FROM `assigned_samples` a_s 
			left join sample_issuance si on a_s.labref = si.lab_ref_no
			left join request r on a_s.labref = r.request_id
			left join packaging p on r.packaging = p.id
                        WHERE a_s.analyst_id ='$user'
                        AND a_s.labref ='$labref'
			group by a_s.labref")->result();
    }
    
    function load_tests($i){
        
     return $this->db->query("SELECT name FROM `tests` t, request_details si WHERE si.test_id = t.id AND si.request_id ='$i'" )->result();  
    
    }
    
    function pdfMerger(){
        return new PDFMerger();
    }

    function remove_3($s) {
        return substr($s, 3);
    }

    function logger() {
        $k = new Auditor();
        $sql ="UPDATE `enqcl4`.`analysts` SET `department_id` = '5' WHERE `analysts`.`id` = 1";
        
        $result = $k->query($sql);
        if ($result) {
            echo 'Success';
        }  else {
            
            echo mysql_error();
            
        }
    }

    function checkSampleApproval($labref) {
        
    }
    
       public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('title,fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function readWorkbookMa($labref) {

        $path = "analyst_uploads/" . $labref . "_micro.xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $number = $objPHPExcel->getSheetCount();


        for ($i = 0; $i <= $number - 1; $i++) {
            $objPHPExcel->setActiveSheetIndex($i);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $sheet_name = $objWorksheet->getTitle();


            $assay_array = array(
                'test_id' => 49,
                'component' => $objWorksheet->getCell('B16')->getValue(),
                'average' => $objWorksheet->getCell('C139')->getCalculatedValue() * 100,
                'rsd' => $objWorksheet->getCell('C140')->getCalculatedValue() * 100,
                'n' => $objWorksheet->getCell('C141')->getCalculatedValue(),
                'labref' => $labref
            );

            $this->db->insert('component_summary', $assay_array);
        }
    }

    function readWorkbookBe($labref) {

        $path = "analyst_uploads/" . $labref . "_microlal.xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $number = $objPHPExcel->getSheetCount();


        for ($i = 0; $i <= $number - 1; $i++) {
            $objPHPExcel->setActiveSheetIndex($i);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $sheet_name = $objWorksheet->getTitle();


            $assay_array = array(
                'test_id' => 50,
                'component' => $objWorksheet->getCell('B16')->getValue(),
                'average' => $objWorksheet->getCell('D68')->getCalculatedValue() * 100,
                'rsd' => 'NA',
                'n' => 'NA',
                'labref' => $labref
            );
            //print_r($assay_array);
            $this->db->insert('component_summary', $assay_array);
        }
    }
    
       function readWorkbookUpdate($labref){
           
        $this->db->where('labref',$labref)->delete('component_summary');
        $rawform=  $this->justBringDosageForm($labref);
        echo $dosageForm=$rawform[0]->dosage_form;  
        if($dosageForm=="9" || $dosageForm=="11"|| $dosageForm=="15" ||$dosageForm=="13"){
           
            $this->readUWorkbook_inj($labref); 
        }else{
            
            $this->readUWorkbook_noninj($labref);
        }
    }
    
    function readWorkbook($labref){
        //$this->db->where('labref',$labref)->delete('component_summary');
        $rawform=  $this->justBringDosageForm($labref);
        echo $dosageForm=$rawform[0]->dosage_form;  
        if($dosageForm=="9" || $dosageForm=="11"|| $dosageForm=="15" ||$dosageForm=="13"){
            $this->readWorkbook_inj($labref); 
        }else{
            $this->readWorkbook_noninj($labref);
        }
    }

    function readWorkbook_noninj($labref) {

        $path = "analyst_uploads/" . $labref . ".xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $number = $objPHPExcel->getSheetCount();


        for ($i = 1; $i <= $number - 1; $i++) {
            $objPHPExcel->setActiveSheetIndex($i);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $sheet_name = $objWorksheet->getTitle();
            $value = $objWorksheet->getCell('D128')->getValue();

            if (empty($value)) {

                $assay_array = array(
                    'test_id' => 2,
                    'component' => $this->remove_3($sheet_name),
                    'average' => $objWorksheet->getCell('F115')->getOldCalculatedValue() * 100,
                    'rsd' => $objWorksheet->getCell('F116')->getOldCalculatedValue() * 100,
                    'n' => $objWorksheet->getCell('F117')->getOldCalculatedValue(),
                    'labref' => $labref
                );


                $this->db->insert('component_summary', $assay_array);
            } else {

                $assay_array = array(
                    'test_id' => 2,
                    'component' => $this->remove_3($sheet_name),
                    'average' => $objWorksheet->getCell('B159')->getOldCalculatedValue() * 100,
                    'rsd' => $objWorksheet->getCell('B160')->getOldCalculatedValue() * 100,
                    'n' => $objWorksheet->getCell('B161')->getOldCalculatedValue(),
                    'labref' => $labref
                );

                $this->db->insert('component_summary', $assay_array);
            }




            $diss_array = array(
                'test_id' => 5,
                'component' => $this->remove_3($sheet_name),
                'average' => $objWorksheet->getCell('H72')->getOldCalculatedValue() * 100,
                'rsd' => $objWorksheet->getCell('H73')->getOldCalculatedValue() * 100,
                'n' => $objWorksheet->getCell('H74')->getOldCalculatedValue(),
                'labref' => $labref
            );


            $this->db->insert('component_summary', $diss_array);
        }
    }
    
    
        function readWorkbook_inj($labref) {

        $path = "analyst_uploads/" . $labref . ".xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $number = $objPHPExcel->getSheetCount();


        for ($i = 1; $i <= $number - 1; $i++) {
            $objPHPExcel->setActiveSheetIndex($i);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $sheet_name = $objWorksheet->getTitle();
            //$value = $objWorksheet->getCell('D128')->getValue();
            
            $diss_array = array(
                'test_id' => 5,
                'component' => $this->remove_3($sheet_name),
                'average' => $objWorksheet->getCell('H71')->getOldCalculatedValue() * 100,
                'rsd' => $objWorksheet->getCell('H72')->getOldCalculatedValue() * 100,
                'n' => $objWorksheet->getCell('H73')->getOldCalculatedValue(),
                'labref' => $labref
            );


            $this->db->insert('component_summary', $diss_array);
        }
    }
    
    
    
     function readUWorkbook_noninj($labref) {

        $path = "reviewer_uploads/" . $labref . ".xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $number = $objPHPExcel->getSheetCount();


        for ($i = 1; $i <= $number - 1; $i++) {
            $objPHPExcel->setActiveSheetIndex($i);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $sheet_name = $objWorksheet->getTitle();
            $value = $objWorksheet->getCell('D128')->getValue();

            if (empty($value)) {

                $assay_array = array(
                    'test_id' => 2,
                    'component' => $this->remove_3($sheet_name),
                    'average' => $objWorksheet->getCell('F112')->getOldCalculatedValue() * 100,
                    'rsd' => $objWorksheet->getCell('F113')->getOldCalculatedValue() * 100,
                    'n' => $objWorksheet->getCell('F114')->getOldCalculatedValue(),
                    'labref' => $labref
                );


                $this->db->insert('component_summary', $assay_array);
            } else {

                $assay_array = array(
                    'test_id' => 2,
                    'component' => $this->remove_3($sheet_name),
                    'average' => $objWorksheet->getCell('B159')->getOldCalculatedValue() * 100,
                    'rsd' => $objWorksheet->getCell('B160')->getOldCalculatedValue() * 100,
                    'n' => $objWorksheet->getCell('B161')->getOldCalculatedValue(),
                    'labref' => $labref
                );

                $this->db->insert('component_summary', $assay_array);
            }




            $diss_array = array(
                'test_id' => 5,
                'component' => $this->remove_3($sheet_name),
                'average' => $objWorksheet->getCell('H72')->getOldCalculatedValue() * 100,
                'rsd' => $objWorksheet->getCell('H73')->getOldCalculatedValue() * 100,
                'n' => $objWorksheet->getCell('H74')->getOldCalculatedValue(),
                'labref' => $labref
            );


            $this->db->insert('component_summary', $diss_array);
        }
    }
    
    
        function readUWorkbook_inj($labref) {

        $path = "reviewer_uploads/" . $labref . ".xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $number = $objPHPExcel->getSheetCount();


        for ($i = 1; $i <= $number - 1; $i++) {
            $objPHPExcel->setActiveSheetIndex($i);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $sheet_name = $objWorksheet->getTitle();
            //$value = $objWorksheet->getCell('D128')->getValue();
            
            $diss_array = array(
                'test_id' => 5,
                'component' => $this->remove_3($sheet_name),
                'average' => $objWorksheet->getCell('H71')->getOldCalculatedValue() * 100,
                'rsd' => $objWorksheet->getCell('H72')->getOldCalculatedValue() * 100,
                'n' => $objWorksheet->getCell('H73')->getOldCalculatedValue(),
                'labref' => $labref
            );


            $this->db->insert('component_summary', $diss_array);
        }
    }
    

    function updateCOAFigures($labref) {
        $this->db->where('labref',$labref)->delete('component_summary');
        $path = "reviewer_uploads/" . $labref . ".xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $number = $objPHPExcel->getSheetCount();


        for ($i = 1; $i <= $number - 1; $i++) {
            $objPHPExcel->setActiveSheetIndex($i);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $sheet_name = $objWorksheet->getTitle();
            $value = $objWorksheet->getCell('D128')->getValue();

            if (empty($value)) {

                $assay_array = array(
                    'test_id' => 2,
                    'component' => $this->remove_3($sheet_name),
                    'average' => $objWorksheet->getCell('F112')->getOldCalculatedValue() * 100,
                    'rsd' => $objWorksheet->getCell('F113')->getOldCalculatedValue() * 100,
                    'n' => $objWorksheet->getCell('F114')->getOldCalculatedValue(),
                    'labref' => $labref
                );


                $this->db->insert('component_summary', $assay_array);
            } else {

                $assay_array = array(
                    'test_id' => 2,
                    'component' => $this->remove_3($sheet_name),
                    'average' => $objWorksheet->getCell('B159')->getOldCalculatedValue() * 100,
                    'rsd' => $objWorksheet->getCell('B160')->getOldCalculatedValue() * 100,
                    'n' => $objWorksheet->getCell('B161')->getOldCalculatedValue(),
                    'labref' => $labref
                );

                $this->db->insert('component_summary', $assay_array);
            }




            $diss_array = array(
                'test_id' => 5,
                'component' => $this->remove_3($sheet_name),
                'average' => $objWorksheet->getCell('H72')->getOldCalculatedValue() * 100,
                'rsd' => $objWorksheet->getCell('H73')->getOldCalculatedValue() * 100,
                'n' => $objWorksheet->getCell('H74')->getOldCalculatedValue(),
                'labref' => $labref
            );


            $this->db->insert('component_summary', $diss_array);
        }
        echo 'Update Successfull, you will be redirected shortly! ...';
     header("Refresh: 3; URL=".  base_url()."reviewer");
    }

    function copyWorkbook($labref, $heading) {
        $id = $this->uri->segment(4);
        $sampleinfo = $this->loadSampleInfo($labref);
        $standardsinfo = $this->loadStandardsData($labref, $heading);
        $file1 = "original_workbook/Template.xlsx";
        $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $outputFile = "Workbooks/" . $labref . "/" . $labref . ".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);
        $objPHPExcel2 = PHPExcel_IOFactory::load($file1);

        $name = $objPHPExcel2->getSheetByName('Template');
        $objPHPExcel->addExternalSheet($name);
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $worksheet = $objPHPExcel->getActiveSheet()
                ->setCellValue('B36', $this->input->post('workingvf1'))
                ->setCellValue('B37', $this->input->post('workingpipette1'))
                ->setCellValue('B38', $this->input->post('workingvf2'))
                ->setCellValue('B39', $this->input->post('workingpipette2'))
                ->setCellValue('B40', $this->input->post('workingvf3'))
                ->setCellValue('B41', $this->input->post('workingp3'))
                ->setCellValue('B42', $this->input->post('workingvf4'))
                ->setCellValue('D47', $this->input->post('workingmgml'))
                //->setCellValue('A35', 'Standard A')
                ->setCellValue('D43', $this->input->post('u_weight'))

                //->setCellValue('A36', 'Standard B')
                ->setCellValue('F43', $this->input->post('u_weight1'))
                ->setCellValue('B59', $this->input->post('aiweight'))
                ->setCellValue('B60', $this->input->post('svf1'))
                ->setCellValue('B61', $this->input->post('sp1'))
                ->setCellValue('B62', $this->input->post('svf2'))
                ->setCellValue('B63', $this->input->post('pipette2'))
                ->setCellValue('B64', $this->input->post('vf3'))
                ->setCellValue('B65', $this->input->post('pipette3'))
                ->setCellValue('D66', $this->input->post('vf41'))
                // ->setCellValue('D66', $this->input->post('smgml'))
                //->setCellValue('A35', 'Sample A')
                ->setCellValue('D60', $this->input->post('sampleA'))
                ->setCellValue('D64', $this->input->post('sampleB'))
                ->setCellValue('D68', $this->input->post('sampleC'))
                ->setCellValue('B56', $this->input->post('labelclaim'))
                ->setCellValue('B55', $this->input->post('labelclaim'))
                ->setCellValue('C55', $this->input->post('heading'))
                ->setCellValue('B32', $this->input->post('mwsalt'))
                ->setCellValue('B31', $this->input->post('mwbase'))
                ->setCellValue('B18', $sampleinfo[0]->product_name)
                ->setCellValue('B19', $sampleinfo[0]->request_id)
                ->setCellValue('B20', $sampleinfo[0]->active_ing)
                ->setCellValue('B21', $sampleinfo[0]->label_claim)
                ->setCellValue('B22', $sampleinfo[0]->updated_at)
                ->setCellValue('B26', $standardsinfo[0]->name)
                ->setCellValue('B27', $standardsinfo[0]->rs_code)
                ->setCellValue('B28', $standardsinfo[0]->potency)
                ->setCellValue('B29', $standardsinfo[0]->water_content);


        $speak = $this->input->post('speak');
        $smpeak = $this->input->post('smpeak');

        //standard      
        $row = 38;
        for ($i = 0; $i < 3; $i++) {
            $col = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row, $speak[$i]);
            $row++;
        }

        $row2 = 38;
        for ($i = 3; $i < 6; $i++) {
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $speak[$i]);
            $row2++;
        }

        //sample

        $si = 60;
        for ($i = 0; $i < 3; $i++) {
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $si, $smpeak[$i]);
            $si++;
        }

        $s2 = 64;
        for ($i = 3; $i < 6; $i++) {
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $s2, $smpeak[$i]);
            $s2++;
        }
        $s3 = 68;
        for ($i = 6; $i < 9; $i++) {
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $s3, $smpeak[$i]);
            $s3++;
        }


        /* $objDrawing = new PHPExcel_Worksheet_Drawing();
          $objDrawing->setWorksheet($worksheet);
          $objDrawing->setName("nqcl_logo");
          $objDrawing->setDescription("Just the header image");
          $objDrawing->setPath('worksheet_logo.png');
          $objDrawing->setCoordinates('A1');
          $objDrawing->setOffsetX(1);
          $objDrawing->setOffsetY(5); */
        $objPHPExcel->getActiveSheet()->setTitle('AD_' . $heading);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($outputFile);
    }

    function upDatePostingA($labref) {
        $heading = $this->input->post('heading');
        $new_value = $this->checkAssayPostingStatus($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', $heading);
        $this->db->update('posting_status', $details);
    }

    function checkAssayPostingStatus($labref) {
        $heading = $this->input->post('heading');

        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', $heading)
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    function getLastWorksheet() {
        $labref = $this->uri->segment(3);
        $this->db->select('no_of_sheets');
        $this->db->where('labref', $labref);
        $query = $this->db->get('workbook_worksheets');
        return $result = $query->result();
        // print_r($result);
    }

    function loadSampleInfo($labref) {
        //global  $information ;
        $information = $this->db->where('request_id', $labref)->get('request')->result();
        return $information;
    }

    function loadStandardsData($labref, $component) {
        return $this->db->query("SELECT rs.name, rs.rs_code,rs.potency, rs.water_content FROM refsubs rs, refsubs_usage ru WHERE rs.id = ru.refsubs_id AND ru.request_id ='$labref' AND component='$component'")->result();
    }

    function sanitize_name($param) {
        $data = str_replace(array('*', '"', '/', ' ', '.', "'", "&", "`", "!", "#", "$", "^", "+", "=", "\\", ":", ";", "?", ",", "<", ">", "{", "}", "[", "]", '(', ')'), "_", $param);
        return $data;
    }

    function url_exists($url) {

        $url_data = parse_url($url); // scheme, host, port, path, query
        if (!fsockopen($url_data['host'], isset($url_data['port']) ? $url_data['port'] : 80)) {
            echo 'The URL you entered is not accessible.';
            return FALSE;
        }
        echo 'The URL you entered is online.';
        return TRUE;
    }

    function getTestID($labref) {
        return $this->db->select('test_id')->where('lab_ref_no', $labref)->group_by('test_id')->get('sample_issuance')->result();
    }

    function checkDirectorsComment($labref) {
        $query = $this->db->where('labref', $labref)->get('directors_say')->num_rows();
        if ($query > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function getMicroNumber($labref) {
        error_reporting(0);
        $data = $this->db->where('labref', $labref)->get('microbiology_tracking')->result();
        $new_number = 'BIOL/' . $data[0]->number . '/' . date('Y');
        return $new_number;
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }

    function justBringDosageForm($labref) {
        $this->db->select('dosage_form');
        $this->db->from('dosage_form df');
        $this->db->join('request r', 'df.id=r.dosage_form');
        $this->db->where('r.request_id', $labref);
        $query = $this->db->get();
        return $result = $query->result();
    }

    function checkUploaded($labref) {
        $query = $this->db->select('upload_status')->where('lab_ref_no', $labref)->get('sample_issuance')->result_array();

        foreach ($query as $arr) {
            if (in_array('0', $arr)) {
                $data = '1';
            } else {
                $data = '0';
            }
        }
        return $data;
    }

    function updateUploadStatus($labref, $test_id) {
        $this->db->where('lab_ref_no', $labref)->where('test_id', $test_id)->update('sample_issuance', array('upload_status' => 1));
    }

    function checkApproval($module, $labref, $r, $c) {
        $done = $this->db
                ->where('test_name', $module)
                ->where('labref', $labref)
                ->where('repeat_status', $r)
                ->where('component_no', $c)
                ->get('supervisor_approvals')
                ->num_rows();
        return $done;
    }

    function microUrl() {
        if ($this->uri->segment(4) == 'formicrobiology') {
            return $this->uri->segment(4);
        } else {
            return $this->uri->segment(3);
        }
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
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

    function checkForChanges($labref) {
        return $this->db->where('new_labref', $labref)->limit(200, 18)->get('coa_body_log')->num_rows();
    }

    function countTestRows($labref) {
        return $this->db->where('lab_ref_no', $labref)->from('sample_issuance')->count_all_results();
    }
     function get_user_type(){
         $user_id = $this->session->userdata('user_id');
         return $this->db->query(" SELECT u.email,ut.usertype_id FROM `users_types` ut, user u WHERE u.email = ut.email AND u.id ='$user_id'" )->result();
    }

    function checkMicrobiologyStatus($labref, $sheet_name) {
        return $this->db->where('labref', $labref)->where('sheet_name', $sheet_name)->where('analyst_id', $this->session->userdata('user_id'))->get('custom_sheets')->num_rows();
    }

    function setUrlSegment() {
        if ($this->uri->segment(3) == 'upload_microbiology') {
            return $labref = $this->uri->segment(4);
        } else {
            return $labref = $this->uri->segment(3);
        }
    }

    function launchConverter($labref) {
        $filename = $labref;
        //file location + filename
        $command = "pdfcreator.exe /PF";
        $contents = file_get_contents('launcher.bat');
        file_put_contents('launcher', $contents . "\n" . $command . $filename);
    }

    function updateTabsCapsCOADetails($labref) {
        $verdict = $this->input->post('tablet');
        $comment = $this->input->post('comment');
        $coa_data = array(
            'method' => 'Weight',
            'determined' => $comment,
            'specification' => '<= 2 tablets deviate by more than x% from mean weight',
            'compedia' => 'B.P. 2012 Vol .V App XII C',
            'complies' => $verdict
        );
        $this->db
                ->where('labref', $labref)
                ->where('test_id', 6)
                ->update('coa_body', $coa_data);
    }

    function updatepHCOADetails($labref) {
        $verdict = $this->input->post('phmean');
        $comment = $this->input->post('sampleph');
        $coa_data = array(
            'determined' => $verdict,
            'specification' => $comment
        );
        $this->db
                ->where('labref', $labref)
                ->where('test_id', 7)
                ->update('coa_body', $coa_data);
    }

    //TRACK ANALYST SUPERVISOR INFO
    public function sample_issuance_count($labref) {
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('done_status', 0);
        return $this->db->count_all_results('sample_issuance');
    }

    public function tests_done_count($labref) {
        $this->db->where('labref', $labref);
        return $this->db->count_all_results('tests_done');
    }

    function comparetToDecide($labref) {

        $analyst = $this->getAnalyst();
        $supervisor = $this->getSupervisorA();

        $date = date('d-M-Y H:i:s');
        $analyst_name = $analyst[0]->fname . " " . $analyst[0]->lname;
        $supervisor_name = $supervisor[0]->supervisor_name;

        $from = $analyst_name . ' - Analyst';
        $to = $supervisor_name . ' - Supervisor';

        echo $sample_issuance = $this->sample_issuance_count($labref);
        echo $tests_done = $this->tests_done_count($labref);

        if (($sample_issuance > 0) && ($tests_done <= 0)) {
            //echo 'All samples are with the Analyst';
        } else if ($sample_issuance > 0 && $tests_done > 0) {
            // echo 'Some tests have not been done yet - In transition ';
            $activity = 'Analysis && Supervision';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date_added' => $date,
                'stage' => '3',
                'current_location' => 'Between analysis and Supervision - In transition'
            );
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
        } else if (($sample_issuance === 0) && ($tests_done > 0)) {
            // echo 'samples are entirely with the supervisor';

            $activity = 'Supervision';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date_added' => $date,
                'stage' => '4',
                'current_location' => 'Supervisor'
            );
            
                $this->db->insert('sample_details',array(
                     'labref' =>$labref,
                     'by'=>$supervisor_name,
                     'activity'=>'Supervision', 
                     'user_id'=>$supervisor[0]->supervisor_id,
                     'date_issued'=>date('Y-m-d')
                     
                 ));
                
                 $this->db->where('labref', $labref);
               $this->db->where('activity','Analysis');
            $this->db->update('sample_details', array('date_returned'=>date('Y-m-d')));
                
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
        }
    }

    //TRACK SUPERVISOR DOCUMENTATION INFO

    public function supervisor_issuance_count($labref) {
        $this->db->where('labref', $labref);
        $this->db->where('approval_status', 0);
        return $this->db->count_all_results('tests_done');
    }

    public function documentation_count($labref) {
        $this->db->where('labref', $labref);
        return $this->db->count_all_results('supervisor_approvals');
    }

    function compareToDecide($labref) {

        $documentation = 'Documentation';
        $supervisor = $this->getSupervisor();

        $date = date('d-M-Y H:i:s');

        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;


        $from = $supervisor_name . '- Supervisor';
        $to = $documentation;

        echo $sample_issuance = $this->supervisor_issuance_count($labref);
        echo $tests_done = $this->documentation_count($labref);

        if (($sample_issuance > 0) && ($tests_done <= 0)) {
            //echo 'All samples are with the Analyst';
        } else if ($sample_issuance > 0 && $tests_done > 0) {
            // echo 'Some tests have not been done yet - In transition ';
            $activity = 'Submission to Documentation';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date_added' => $date,
                'stage' => '5',
                'current_location' => 'Between Supervisor and Documentation - In transition'
            );
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
        } else if (($sample_issuance === 0) && ($tests_done > 0)) {
            // echo 'samples are entirely with the supervisor';

            $activity = 'Documentation - Awaiting review';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date_added' => $date,
                'stage' => '6',
                'current_location' => 'Documentation'
            );
            
               $this->db->where('labref', $labref);
               $this->db->where('activity','Supervision');
            $this->db->update('sample_details', array('date_returned'=>date('Y-m-d')));
            
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
        }
    }

    function registerRejectionReason($labref, $level) {
        $name = $this->getAnalyst();
        $fullname = $name[0]->fname . " " . $name[0]->lname;
        $reason = $this->input->post('reason');

        $whole_rejection_data = array(
            'name' => $fullname,
            'at_level' => $level,
            'labref' => $labref,
            'reject_reason' => $reason
        );
        $this->db->insert('sample_rejection', $whole_rejection_data);
    }

    function registerChemicalSubstanceUsed() {
        $labref = $this->uri->segment(3);
        $quantity1 = $this->input->post('rqty');
        $quantity2 = $this->input->post('unit');
        $quantity = $quantity1 . $quantity2;
        $reference_substance = array(
            'labref' => $labref,
            'refsub' => $this->input->post('heading'),
            'nqcl_code' => $this->input->post('codein'),
            'quantity' => $quantity,
            'potency' => $this->input->post('potency')
        );
        $this->db->insert('refsubs_used', $reference_substance);
        $this->upDateChemicalSubstanceQty();
    }

    function upDateChemicalSubstanceQty() {
        (double) $beforeuse = $this->input->post('aqty');
        (double) $afteruse = $this->input->post('rqty');
        $substance = $this->input->post('heading');
        $remaining_qty = (double) $beforeuse - (double) $afteruse;
        $subst_upd = array(
            'init_mass' => $remaining_qty
        );
        $this->db
                ->where('name', $substance)
                ->update('refsubs', $subst_upd);
    }

    function setBackNavigationData() {
        $modules = array(
            'module' => $this->uri->segment(1),
            'module_method' => $this->uri->segment(2)
        );
        $this->session->set_userdata($modules);
    }

    function getAnalyst() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('title, fname,lname,id');
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getSupervisor() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    public function getSupervisorA() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id,supervisor_name');
        $this->db->where('analyst_id', $user_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
    }

    function getDate($labref, $r, $c) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->where('component_no', $c)
                        ->get('tests_done')
                        ->result();
    }

    function checkRepeatStatus($labref, $table_name) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get($table_name);
        return $result = $query->result();
    }

    function findRefSub($substance) {
        echo json_encode(
                $this->db
                        ->where('name', $substance)
                        ->where('application', 'Assay')
                        ->group_by('created_at asc')
                        ->limit(1)
                        ->get('refSubs')
                        ->result()
        );
    }

    function generate_certificate($labref) {
        $row_number = 0;

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("certificates/" . $labref . '/' . $labref . "_COA.xlsx");
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
                ->setCellValue('B13', "BATCH No.\n" . $information[0]->batch_no)
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
        $worksheet->getStyle('B13')->getAlignment()->setWrapText(true);
        $worksheet->getRowDimension('B13')->setRowHeight(-1);
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
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
                    ->setCellValueByColumnAndRow($col++, $row, str_replace(":", "\n\n", $trd[$i]->methods))
                    ->setCellValueByColumnAndRow($col++, $row, str_replace(":", "\n\n", $trd[$i]->compedia));

            $worksheet->setCellValueByColumnAndRow($col++, $row, str_replace(":", "\n\n", $trd[$i]->specification));



            $worksheet->setCellValueByColumnAndRow($col++, $row, str_replace(":", "\n\n\n", $determined));



            $worksheet->setCellValueByColumnAndRow($col++, $row, str_replace(":", "\n\n\n", $trd[$i]->complies));
            $worksheet->getStyle($col++ . $row)->getAlignment()->setWrapText(true);
            $worksheet->getRowDimension($row)->setRowHeight(-1);

            $worksheet->getStyle('B' . $row . ":G" . $row)->applyFromArray($styleArray);

            $worksheet->getStyle('B' . $row . ":B" . $row)->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => 'E0E0E0')
                        )
                    )
            );

            $worksheet->getStyle('G' . $row . ":G" . $row)->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => 'E0E0E0')
                        )
                    )
            );
            $row++;


            // echo $last_row;
            //$worksheet->getStyle('B26:G50')->applyFromArray($styleArray);
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

    public function updateWorksheetNo() {
        $labref = $this->uri->segment(3);
        $data = $this->getLastWorksheet();
        $worksheetIndex = $data[0]->no_of_sheets;
        $newWorksheetIndex = $worksheetIndex + '1';
        $new_no = array(
            'no_of_sheets' => $newWorksheetIndex
        );
        $this->db->where('labref', $labref);
        $this->db->update('workbook_worksheets', $new_no);
    }

    function CopyAndReplace($labref) {
        $file_name = 'workbooks/' . $labref . '/' . $labref . '.xlsx';
        $source = 'Temp/' . $labref . '.xlsx';
        $target = 'workbooks/' . $labref . '/' . $labref . '.xlsx';

        if (is_file($file_name)) {
            unlink($file_name);
            copy($source, $target);
        }
    }

    function setDoneStatus($labref, $test_id) {
        $this->db->where('lab_ref_no', $labref)->where('test_id', $test_id)
                ->update('sample_issuance', array('done_status' => '1'));
    }

    function setWindowsUserAndDeleteLocalExcelWorbook($labref) {
        $nw = new COM("WScript.Network");
        $computername = $nw->computername;
        $owmi = new COM("winmgmts:\\\\$computername\\root\\cimv2");
        $comp = $owmi->get("win32_computersystem.name='$computername'");
        $user = explode("\\", $comp->UserName);
        $path = "C:\\Users\\" . $user[1] . "\\Downloads\\$labref.xlsx";
        unlink($path);
    }

    function saveClientAsUser() {

        //variable name   //class  //html control //php post function("control name in the html file")
        $email = $this->input->post("client_email");
        //$version_id = $this -> input -> post("version_id");
        $client_name = $this->input->post("client_name");
        $client_address = $this->input->post("client_address");
        $client_number = $this->input->post("clientT");
        $contact_person = $this->input->post("contact_person");
        $contact_phone = $this->input->post("contact_phone");
        $comment = "No Comment";
        $client_id = $this->input->post("clientid");
        $client_name1 = str_replace(' ', '_', $client_name);
        $client_name2 = str_replace(')', '-', $client_name1);
        $alias = str_replace('(', '-', $client_name2);
        $quotation_status = $this->input->post("q_status");
        $quotation = $this->uri->segment(3);

        //Check if client exists, if does not add them to clients table
        if ($this->checkUserExistsThenSendorError2() == '0') {

            //variable storing the class instance   
            $client = new Clients();
            //passing the variables posted above to the class variable
            $client->Name = $client_name;
            $client->Address = $client_address;
            $client->Client_type = $client_number;
            $client->Contact_person = $contact_person;
            $client->Contact_phone = $contact_phone;
            //$client -> Ref_number = $client_ref_no;
            //$client -> Version_id = $version_id;
            $client->Clientid = $client_id;
            $client->Alias = $alias;
            $client->Comment = $comment;
            $client->email = $email;


            //Save client data                      
            $client->save();
        }

        //Check if the client exists as user in the users table , add to table if does not exist
        if ($this->checkClientExistsInUsersTable() == '0') {

            //Set statuses
            $client_usertype = "29";
            $client_status = "0";
            $pWord = "123456";

            //Save to Users_types Table to enable client login
            $client_users = new Users_types();
            $client_users->email = $email;
            $client_users->usertype_id = $client_usertype;
            $client_users->password = md5('#*seCrEt!@-*%' . $pWord);
            $client_users->status = $client_status;
            $client_users->save();

            //Save to User table.
            $client_user = new User();
            $client_user->fname = $client_name;
            $client_user->username = $client_name;
            $client_user->email = $email;
            $client_user->telephone = $contact_phone;
            $client_user->user_type = $client_usertype;
            $client_user->save();
        }

        //Check if last segment of url is quotation i.e check if requet to save originates from quotations
        if ($quotation == 'quotation') {
            $this->saveQuotation();
        }
    }

    function checkUserExistsThenSendorError2() {
        $user_is = $this->input->post('clientid');
        $this->db->select('id');
        $this->db->where('id', $user_is);
        $query = $this->db->get('clients');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function checkClientExistsInUsersTable() {
        $user_is = $this->input->post('client_email');
        $this->db->select('email');
        $this->db->where('email', $user_is);
        $query = $this->db->get('users_types');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function saveQuotation() {

        //Get Last Quotation Id
        $last_quotation_id = Quotations::getLastId();
        if (!empty($last_quotation_id)) {
            $last_id = $last_quotation_id[0]['max'];
        } else {
            $last_id = 0;
        }
        $new_id = (int) $last_id + (int) 1;
        $email = $this->input->post("cemail");


        //Save Quotation
        $quotation = new Quotations();
        if (isset($client_id)) {
            $quotation->client_id = $client_id;
        }
        $quotation->client_email = $email;
        $quotation->quotation_no = "NQCL" . "-Q" . "-" . date('y') . "-" . date('m') . "-" . $new_id;
        $quotation->quotation_date = date('y-m-d');
        $quotation->total_amount = 0;
        $quotation->save();
    }

//General data list function
    function dataPerlist() {

        //Parameters
        $id = $this->uri->segment(5);
        $name = $this->uri->segment(3);
        $ref = $this->uri->segment(4);
        $db_data = $name . '_array';

        //Data
        $db_method = 'get' . ucfirst($name) . 'Per' . ucfirst($ref);
        $db_data = $name::$db_method($id);

        //Return
        if (!empty($db_data)) {
            foreach ($db_data as $r) {
                $data[] = $r;
            }
            echo json_encode($data);
        } else {
            echo "[]";
        }
    }

    function Assigned() {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT DATE_FORMAT(designation_date, '%m') as 'month',
COUNT(id) as 'total'
FROM request
WHERE assign_status=1 AND DATE_FORMAT(designation_date, '%Y') > 2010
GROUP BY DATE_FORMAT(designation_date, '%Y%m')");

        return $result = $query2->result_array();
    }

    function Unassigned() {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT DATE_FORMAT(designation_date, '%m') as 'month',
COUNT(id) as 'total'
FROM request
WHERE assign_status=0 AND DATE_FORMAT(designation_date, '%Y') > 2010
GROUP BY DATE_FORMAT(designation_date, '%Y%m')");

        return $result = $query2->result_array();
    }

    function All() {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT DATE_FORMAT(designation_date, '%m') as MONTHNAME(month),
COUNT(id) as 'total'
FROM request
WHERE  DATE_FORMAT(designation_date, '%Y') > 2010
GROUP BY DATE_FORMAT(designation_date, '%Y%m')");

        return $result = $query2->result_array();
    }

}
