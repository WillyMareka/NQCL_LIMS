<?php

class Wkstest extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    function getLastWorksheet() {
        $labref = $this->uri->segment(3);
        $this->db->select('no_of_sheets');
        $this->db->where('labref', $labref);
        $query = $this->db->get('workbook_worksheets');
        return $result = $query->result();
        // print_r($result);
    }

    //=================================IDENTIFICATION==========================================

    public function exportIdentificationExcel_t() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkPostingStatusIdentification($labref);

        $procedure = $this->input->post('identification');
        $finding = $this->input->post('specification');
        $specification = $this->input->post('value3');

        if ($repeat_stat != '0') {


            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

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
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B4', 'Procedure')
                    ->setCellValue('C4', $procedure)
                    ->setCellValue('B5', 'Finding')
                    ->setCellValue('C5', $finding)
                    ->setCellValue('B6', 'Specification')
                    ->setCellValue('C6', $specification)
                    ->setCellValue('B8', 'Worksheet No')
                    ->setCellValue('C8', $labref);

            $objPHPExcel->getActiveSheet()->setTitle('identification');
            $dir = "workbooks";
            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePostingI($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }
    }

    function upDatePostingI($labref) {
        //$heading = $this->input->post('heading');
        $new_value = $this->checkPostingStatusIdentification($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'identification');
        $this->db->update('posting_status', $details);
    }

    function checkPostingStatusIdentification($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'identification')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    //======================================UNIFORMITY============================

    public function exportCapsToExcel_t() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkRepeatStatusTabs($labref);

        $heading = 'uniformity';
        $tcsv1 = $this->input->post('tcsv1');
        $ecsv1 = $this->input->post('ecsv1');
        $csvc1 = $this->input->post('csvc1');
        $dfm1 = $this->input->post('dfm1');

        $tcsv2 = $this->input->post('tcsv2');
        $ecsv2 = $this->input->post('ecsv2');
        $csvc2 = $this->input->post('csvc2');
        $dfm2 = $this->input->post('dfm2');

        $tcsv3 = $this->input->post('tcsv3');
        $ecsv3 = $this->input->post('ecsv3');
        $csvc3 = $this->input->post('csvc3');
        $dfm3 = $this->input->post('dfm3');

        $tcsv4 = $this->input->post('tcsv4');
        $ecsv4 = $this->input->post('ecsv4');
        $csvc4 = $this->input->post('csvc4');
        $dfm4 = $this->input->post('dfm4');

        $tcsv5 = $this->input->post('tcsv5');
        $ecsv5 = $this->input->post('ecsv5');
        $csvc5 = $this->input->post('csvc5');
        $dfm5 = $this->input->post('dfm5');

        $tcsv6 = $this->input->post('tcsv6');
        $ecsv6 = $this->input->post('ecsv6');
        $csvc6 = $this->input->post('csvc6');
        $dfm6 = $this->input->post('dfm6');

        $tcsv7 = $this->input->post('tcsv7');
        $ecsv7 = $this->input->post('ecsv7');
        $csvc7 = $this->input->post('csvc7');
        $dfm7 = $this->input->post('dfm7');

        $tcsv8 = $this->input->post('tcsv8');
        $ecsv8 = $this->input->post('ecsv8');
        $csvc8 = $this->input->post('csvc8');
        $dfm8 = $this->input->post('dfm8');

        $tcsv9 = $this->input->post('tcsv9');
        $ecsv9 = $this->input->post('ecsv9');
        $csvc9 = $this->input->post('csvc9');
        $dfm9 = $this->input->post('dfm9');

        $tcsv10 = $this->input->post('tcsv10');
        $ecsv10 = $this->input->post('ecsv10');
        $csvc10 = $this->input->post('csvc10');
        $dfm10 = $this->input->post('dfm10');

        $tcsv11 = $this->input->post('tcsv11');
        $ecsv11 = $this->input->post('ecsv11');
        $csvc11 = $this->input->post('csvc11');
        $dfm11 = $this->input->post('dfm11');

        $tcsv12 = $this->input->post('tcsv12');
        $ecsv12 = $this->input->post('ecsv12');
        $csvc12 = $this->input->post('csvc12');
        $dfm12 = $this->input->post('dfm12');

        $tcsv13 = $this->input->post('tcsv13');
        $ecsv13 = $this->input->post('ecsv13');
        $csvc13 = $this->input->post('csvc13');
        $dfm13 = $this->input->post('dfm13');

        $tcsv14 = $this->input->post('tcsv14');
        $ecsv14 = $this->input->post('ecsv14');
        $csvc14 = $this->input->post('csvc14');
        $dfm14 = $this->input->post('dfm14');

        $tcsv15 = $this->input->post('tcsv15');
        $ecsv15 = $this->input->post('ecsv15');
        $csvc15 = $this->input->post('csvc15');
        $dfm15 = $this->input->post('dfm15');

        $tcsv16 = $this->input->post('tcsv16');
        $ecsv16 = $this->input->post('ecsv16');
        $csvc16 = $this->input->post('csvc16');
        $dfm16 = $this->input->post('dfm16');

        $tcsv17 = $this->input->post('tcsv17');
        $ecsv17 = $this->input->post('ecsv17');
        $csvc17 = $this->input->post('csvc17');
        $dfm17 = $this->input->post('dfm17');

        $tcsv18 = $this->input->post('tcsv18');
        $ecsv18 = $this->input->post('ecsv18');
        $csvc18 = $this->input->post('csvc18');
        $dfm18 = $this->input->post('dfm18');

        $tcsv19 = $this->input->post('tcsv19');
        $ecsv19 = $this->input->post('ecsv19');
        $csvc19 = $this->input->post('csvc19');
        $dfm19 = $this->input->post('dfm19');

        $tcsv20 = $this->input->post('tcsv20');
        $ecsv20 = $this->input->post('ecsv20');
        $csvc20 = $this->input->post('csvc20');
        $dfm20 = $this->input->post('dfm20');

        $comment = $this->input->post('comment');

        if ($repeat_stat != '0') {

            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            //$objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName($heading);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I30', $heading)
                    ->setCellValue('A32', 'Capsules/Sachets/Vials (mg)')
                    ->setCellValue('C32', 'Empty Capsule/ Sachet/Vial  (mg)')
                    ->setCellValue('D32', 'Capsule/Sachet/Vial Content (mg)')
                    ->setCellValue('E32', 'Percentage Deviation')
                    ->setCellValue('A34', $tcsv1)
                    ->setCellValue('C34', $ecsv1)
                    ->setCellValue('D34', $csvc1)
                    ->setCellValue('E34', $dfm1)
                    ->setCellValue('A35', $tcsv2)
                    ->setCellValue('C35', $ecsv2)
                    ->setCellValue('D35', $csvc2)
                    ->setCellValue('E35', $dfm2)
                    ->setCellValue('A36', $tcsv3)
                    ->setCellValue('C36', $ecsv3)
                    ->setCellValue('D36', $csvc3)
                    ->setCellValue('E36', $dfm3)
                    ->setCellValue('A37', $tcsv4)
                    ->setCellValue('C37', $ecsv4)
                    ->setCellValue('D37', $csvc4)
                    ->setCellValue('E37', $dfm4)
                    ->setCellValue('A38', $tcsv5)
                    ->setCellValue('C38', $ecsv5)
                    ->setCellValue('D38', $csvc5)
                    ->setCellValue('E38', $dfm5)
                    ->setCellValue('A39', $tcsv6)
                    ->setCellValue('C39', $ecsv6)
                    ->setCellValue('D39', $csvc6)
                    ->setCellValue('E39', $dfm6)
                    ->setCellValue('A40', $tcsv7)
                    ->setCellValue('C40', $ecsv7)
                    ->setCellValue('D40', $csvc7)
                    ->setCellValue('E40', $dfm7)
                    ->setCellValue('A41', $tcsv8)
                    ->setCellValue('C41', $ecsv8)
                    ->setCellValue('D41', $csvc8)
                    ->setCellValue('E41', $dfm8)
                    ->setCellValue('A42', $tcsv9)
                    ->setCellValue('C42', $ecsv9)
                    ->setCellValue('D42', $csvc9)
                    ->setCellValue('E42', $dfm9)
                    ->setCellValue('A43', $tcsv10)
                    ->setCellValue('C43', $ecsv10)
                    ->setCellValue('D43', $csvc10)
                    ->setCellValue('E43', $dfm10)
                    ->setCellValue('A44', $tcsv11)
                    ->setCellValue('C44', $ecsv11)
                    ->setCellValue('D44', $csvc11)
                    ->setCellValue('E44', $dfm11)
                    ->setCellValue('A45', $tcsv12)
                    ->setCellValue('C45', $ecsv12)
                    ->setCellValue('D45', $csvc12)
                    ->setCellValue('E45', $dfm12)
                    ->setCellValue('A46', $tcsv13)
                    ->setCellValue('C46', $ecsv13)
                    ->setCellValue('D46', $csvc13)
                    ->setCellValue('E46', $dfm13)
                    ->setCellValue('A47', $tcsv14)
                    ->setCellValue('C47', $ecsv14)
                    ->setCellValue('D47', $csvc14)
                    ->setCellValue('E47', $dfm14)
                    ->setCellValue('A48', $tcsv15)
                    ->setCellValue('C48', $ecsv15)
                    ->setCellValue('D48', $csvc15)
                    ->setCellValue('E48', $dfm15)
                    ->setCellValue('A49', $tcsv16)
                    ->setCellValue('C49', $ecsv16)
                    ->setCellValue('D49', $csvc16)
                    ->setCellValue('E49', $dfm16)
                    ->setCellValue('A50', $tcsv17)
                    ->setCellValue('C50', $ecsv17)
                    ->setCellValue('D50', $csvc17)
                    ->setCellValue('E50', $dfm17)
                    ->setCellValue('A51', $tcsv18)
                    ->setCellValue('C51', $ecsv18)
                    ->setCellValue('D51', $csvc18)
                    ->setCellValue('E51', $dfm18)
                    ->setCellValue('A52', $tcsv19)
                    ->setCellValue('C52', $ecsv19)
                    ->setCellValue('D52', $csvc19)
                    ->setCellValue('E52', $dfm19)
                    ->setCellValue('A53', $tcsv20)
                    ->setCellValue('C53', $ecsv20)
                    ->setCellValue('D53', $csvc20)
                    ->setCellValue('E53', $dfm20)
                    ->setCellValue('A55', 'Comment')
                    ->setCellValue('B55', $comment)
                    ->setCellValue('B57', 'Worksheet No')
                    ->setCellValue('C57', $labref);
//             ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);

            $objPHPExcel->getActiveSheet()->setTitle($heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;




            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I3', $heading)
                    ->setCellValue('A4', 'Capsules/Sachets/Vials (mg)')
                    ->setCellValue('C4', 'Empty Capsule/ Sachet/Vial  (mg)')
                    ->setCellValue('D4', 'Capsule/Sachet/Vial Content (mg)')
                    ->setCellValue('E4', 'Percentage Deviation')
                    ->setCellValue('A5', $tcsv1)
                    ->setCellValue('C5', $ecsv1)
                    ->setCellValue('D5', $csvc1)
                    ->setCellValue('E5', $dfm1)
                    ->setCellValue('A6', $tcsv2)
                    ->setCellValue('C6', $ecsv2)
                    ->setCellValue('D6', $csvc2)
                    ->setCellValue('E6', $dfm2)
                    ->setCellValue('A7', $tcsv3)
                    ->setCellValue('C7', $ecsv3)
                    ->setCellValue('D7', $csvc3)
                    ->setCellValue('E7', $dfm3)
                    ->setCellValue('A8', $tcsv4)
                    ->setCellValue('C8', $ecsv4)
                    ->setCellValue('D8', $csvc4)
                    ->setCellValue('E8', $dfm4)
                    ->setCellValue('A9', $tcsv5)
                    ->setCellValue('C9', $ecsv5)
                    ->setCellValue('D9', $csvc5)
                    ->setCellValue('E9', $dfm5)
                    ->setCellValue('A10', $tcsv6)
                    ->setCellValue('C10', $ecsv6)
                    ->setCellValue('D10', $csvc6)
                    ->setCellValue('E10', $dfm6)
                    ->setCellValue('A11', $tcsv7)
                    ->setCellValue('C11', $ecsv7)
                    ->setCellValue('D11', $csvc7)
                    ->setCellValue('E11', $dfm7)
                    ->setCellValue('A12', $tcsv8)
                    ->setCellValue('C12', $ecsv8)
                    ->setCellValue('D12', $csvc8)
                    ->setCellValue('E12', $dfm8)
                    ->setCellValue('A13', $tcsv9)
                    ->setCellValue('C13', $ecsv9)
                    ->setCellValue('D13', $csvc9)
                    ->setCellValue('E13', $dfm9)
                    ->setCellValue('A14', $tcsv10)
                    ->setCellValue('C14', $ecsv10)
                    ->setCellValue('D14', $csvc10)
                    ->setCellValue('E14', $dfm10)
                    ->setCellValue('A15', $tcsv11)
                    ->setCellValue('C15', $ecsv11)
                    ->setCellValue('D15', $csvc11)
                    ->setCellValue('E15', $dfm11)
                    ->setCellValue('A16', $tcsv12)
                    ->setCellValue('C16', $ecsv12)
                    ->setCellValue('D16', $csvc12)
                    ->setCellValue('E16', $dfm12)
                    ->setCellValue('A17', $tcsv13)
                    ->setCellValue('C17', $ecsv13)
                    ->setCellValue('D17', $csvc13)
                    ->setCellValue('E17', $dfm13)
                    ->setCellValue('A18', $tcsv14)
                    ->setCellValue('C18', $ecsv14)
                    ->setCellValue('D18', $csvc14)
                    ->setCellValue('E18', $dfm14)
                    ->setCellValue('A19', $tcsv15)
                    ->setCellValue('C19', $ecsv15)
                    ->setCellValue('D19', $csvc15)
                    ->setCellValue('E19', $dfm15)
                    ->setCellValue('A20', $tcsv16)
                    ->setCellValue('C20', $ecsv16)
                    ->setCellValue('D20', $csvc16)
                    ->setCellValue('E20', $dfm16)
                    ->setCellValue('A21', $tcsv17)
                    ->setCellValue('C21', $ecsv17)
                    ->setCellValue('D21', $csvc17)
                    ->setCellValue('E21', $dfm17)
                    ->setCellValue('A22', $tcsv18)
                    ->setCellValue('C22', $ecsv18)
                    ->setCellValue('D22', $csvc18)
                    ->setCellValue('E22', $dfm18)
                    ->setCellValue('A23', $tcsv19)
                    ->setCellValue('C23', $ecsv19)
                    ->setCellValue('D23', $csvc19)
                    ->setCellValue('E23', $dfm19)
                    ->setCellValue('A24', $tcsv20)
                    ->setCellValue('C24', $ecsv20)
                    ->setCellValue('D24', $csvc20)
                    ->setCellValue('E24', $dfm20)
                    ->setCellValue('A26', 'Comment')
                    ->setCellValue('B26', $comment)
                    ->setCellValue('B28', 'Worksheet No')
                    ->setCellValue('C28', $labref);


//                    ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);




            $objPHPExcel->getActiveSheet()->setTitle($heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePosting($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }
    }

    function checkRepeatStatusCaps($labref) {
        $this->db->select_max('r_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('weight_uniformity');
        $result = $query->result();
        return $result[0]->r_status;
    }

    //======================================-- ASSAY EXPO TEST=========================================================//
    public function exportAssayToExcel_t() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkAssayPostingStatus($labref);

        $heading = $this->input->post('heading');
        $potency = $this->input->post('potency');

        $weight = $this->input->post('workingweight');
        $vf1 = $this->input->post('workingvf1');
        $pipette1 = $this->input->post('workingpipette1');
        $vf2 = $this->input->post('workingvf2');
        $pipette2 = $this->input->post('workingpipette2');
        $vf3 = $this->input->post('workingvf3');
        $pipette3 = $this->input->post('workingp3');
        $vf4 = $this->input->post('workingvf4');
        $concetration = $this->input->post('workingmgml');



        $weightA = $this->input->post('u_weight');
        $vf1A = $this->input->post('vf1');
        $pipette1A = $this->input->post('pipette1');
        $vf2A = $this->input->post('vf2');
        $pipette2A = $this->input->post('p2');
        $vf3A = $this->input->post('vf31');
        $pipette3A = $this->input->post('p321');
        $vf4A = $this->input->post('vf32');
        $concetrationA = $this->input->post('mgml');


        $weightB = $this->input->post('u_weight1');
        $vf1B = $this->input->post('vf11');
        $pipette1B = $this->input->post('ppt');
        $vf2B = $this->input->post('vf22');
        $pipette2B = $this->input->post('ppt1');
        $vf3B = $this->input->post('vf33');
        $pipette3B = $this->input->post('ppt2');
        $vf4B = $this->input->post('vf34');
        $concetrationB = $this->input->post('mgml1');

        //sample assay posted data
        $pwnumber = $this->input->post('pwnumber');
        $sampleA = $this->input->post('sampleA');
        $sampleB = $this->input->post('sampleB');
        $sampleC = $this->input->post('sampleC');

        $aiweight = $this->input->post('aiweight');
        $u_weighta = $this->input->post('aweightA');
        $u_weightb = $this->input->post('aweightB');
        $u_weightc = $this->input->post('aweightC');

        $svf1 = $this->input->post('svf1');
        $svf11 = $this->input->post('svf11');
        $svf111 = $this->input->post('vf111');
        $svf31 = $this->input->post('svf3');


        $sp1 = $this->input->post('sp1');
        $sp11 = $this->input->post('sp11');
        $sp12 = $this->input->post('sp112');
        $ssp3 = $this->input->post('ssp3');

        $svf2 = $this->input->post('svf2');
        $svf12 = $this->input->post('svf12');
        $svf22 = $this->input->post('svf22');
        $svf33 = $this->input->post('svf33');


        $spipette2 = $this->input->post('pipette2');
        $spf1 = $this->input->post('spf1');
        $spf2 = $this->input->post('spf2');
        $spf3 = $this->input->post('spf3');


        $svf3 = $this->input->post('vf3');
        $svf13 = $this->input->post('svf13');
        $svf23 = $this->input->post('svf23');
        $svf24 = $this->input->post('svf24');


        $spipette3 = $this->input->post('pipette3');
        $spf21 = $this->input->post('spf21');
        $spf33 = $this->input->post('spf33');
        $spf4 = $this->input->post('spf4');


        $vf41 = $this->input->post('vf41');
        $svf14 = $this->input->post('svf14');
        $svf241 = $this->input->post('svf241');
        $svf25 = $this->input->post('svf25');


        $smgml = $this->input->post('smgml');
        $smgml1 = $this->input->post('smgml1');
        $smgml2 = $this->input->post('smgml2');
        $smgml3 = $this->input->post('smgml3');

        //Other values used
        $tabs_caps_average = $this->input->post('tabs_caps_average');
        $labelclaim = $this->input->post('labelclaim');
        $procedure = $this->input->post('procedure');


        if ($repeat_stat != '0') {

            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            //$objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName($heading);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I29', $heading)
                    ->setCellValue('I32', 'Standard Preparation For Assay')
                    ->setCellValue('B33', 'Weight')
                    ->setCellValue('C33', 'vf1')
                    ->setCellValue('D33', 'pipette1')
                    ->setCellValue('E33', 'vf2')
                    ->setCellValue('F33', 'pipette2')
                    ->setCellValue('G33', 'vf3')
                    ->setCellValue('H33', 'pipette3')
                    ->setCellValue('I33', 'vf4')
                    ->setCellValue('K33', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A34', 'Desired Weight')
                    ->setCellValue('B34', $weight)
                    ->setCellValue('C34', $vf1)
                    ->setCellValue('D34', $pipette1)
                    ->setCellValue('E34', $vf2)
                    ->setCellValue('F34', $pipette2)
                    ->setCellValue('G34', $vf3)
                    ->setCellValue('H34', $pipette3)
                    ->setCellValue('I34', $vf4)
                    ->setCellValue('K34', $concetration)
                    ->setCellValue('A35', 'Standard A')
                    ->setCellValue('B35', $weightA)
                    ->setCellValue('C35', $vf1A)
                    ->setCellValue('D35', $pipette1A)
                    ->setCellValue('E35', $vf2A)
                    ->setCellValue('F35', $pipette2A)
                    ->setCellValue('G35', $vf3A)
                    ->setCellValue('H35', $pipette3A)
                    ->setCellValue('I35', $vf4A)
                    ->setCellValue('K35', $concetrationA)
                    ->setCellValue('A36', 'Standard B')
                    ->setCellValue('B36', $weightB)
                    ->setCellValue('C36', $vf1B)
                    ->setCellValue('D36', $pipette1B)
                    ->setCellValue('E36', $vf2B)
                    ->setCellValue('F36', $pipette2B)
                    ->setCellValue('G36', $vf3B)
                    ->setCellValue('H36', $pipette3B)
                    ->setCellValue('I36', $vf4B)
                    ->setCellValue('K36', $concetrationB)
                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('I38', 'Sample Preparation For Assay')
                    ->setCellValue('B39', 'Powder Weight')
                    ->setCellValue('C39', 'API Weight')
                    ->setCellValue('D39', 'vf1')
                    ->setCellValue('E39', 'pipette1')
                    ->setCellValue('F39', 'vf2')
                    ->setCellValue('G39', 'pipette2')
                    ->setCellValue('H39', 'vf3')
                    ->setCellValue('I39', 'pipette3')
                    ->setCellValue('J39', 'vf4')
                    ->setCellValue('L39', 'Concetration')
                    ->setCellValue('F40', $potency)

                    //Assay Standard Preparation desired  
                    ->setCellValue('A40', 'Desired Weight')
                    ->setCellValue('B40', $pwnumber)
                    ->setCellValue('C40', $aiweight)
                    ->setCellValue('D40', $svf1)
                    ->setCellValue('E40', $sp1)
                    ->setCellValue('F40', $svf2)
                    ->setCellValue('G40', $spipette2)
                    ->setCellValue('H40', $svf3)
                    ->setCellValue('I40', $spipette3)
                    ->setCellValue('J40', $vf41)
                    ->setCellValue('L40', $smgml)
                    ->setCellValue('A41', 'Sample A')
                    ->setCellValue('B41', $sampleA)
                    ->setCellValue('C41', $u_weighta)
                    ->setCellValue('D41', $svf11)
                    ->setCellValue('E41', $sp11)
                    ->setCellValue('F41', $svf12)
                    ->setCellValue('G41', $spf1)
                    ->setCellValue('H41', $svf13)
                    ->setCellValue('I41', $spf21)
                    ->setCellValue('J41', $svf14)
                    ->setCellValue('L41', $smgml1)
                    ->setCellValue('A42', 'Sample B')
                    ->setCellValue('B42', $sampleB)
                    ->setCellValue('C42', $u_weightb)
                    ->setCellValue('D42', $svf111)
                    ->setCellValue('E42', $sp12)
                    ->setCellValue('F42', $svf22)
                    ->setCellValue('G42', $spf2)
                    ->setCellValue('H42', $svf23)
                    ->setCellValue('I42', $spf33)
                    ->setCellValue('J42', $svf241)
                    ->setCellValue('L42', $smgml2)
                    ->setCellValue('A43', 'Sample C')
                    ->setCellValue('B43', $sampleC)
                    ->setCellValue('C43', $u_weightc)
                    ->setCellValue('D43', $svf31)
                    ->setCellValue('E43', $ssp3)
                    ->setCellValue('F43', $svf33)
                    ->setCellValue('G43', $spf3)
                    ->setCellValue('H43', $svf24)
                    ->setCellValue('I43', $spf4)
                    ->setCellValue('J43', $svf25)
                    ->setCellValue('L43', $smgml3)
                    //Other values used
                    ->setCellValue('D48', 'Label Claim')
                    ->setCellValue('D49', 'Tabs or Caps Average')
                    ->setCellValue('D50', 'Procedure Used')
                    ->setCellValue('F48', $labelclaim)
                    ->setCellValue('F49', $tabs_caps_average)
                    ->setCellValue('F50', $procedure);

//             ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);

            $objPHPExcel->getActiveSheet()->setTitle($heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;




            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I3', $heading)
                    ->setCellValue('I5', 'Standard Preparation For Assay')
                    ->setCellValue('B7', 'Weight')
                    ->setCellValue('C7', 'vf1')
                    ->setCellValue('D7', 'pipette1')
                    ->setCellValue('E7', 'vf2')
                    ->setCellValue('F7', 'pipette2')
                    ->setCellValue('G7', 'vf3')
                    ->setCellValue('H7', 'pipette3')
                    ->setCellValue('I7', 'vf4')
                    ->setCellValue('K7', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A8', 'Desired Weight')
                    ->setCellValue('B8', $weight)
                    ->setCellValue('C8', $vf1)
                    ->setCellValue('D8', $pipette1)
                    ->setCellValue('E8', $vf2)
                    ->setCellValue('F8', $pipette2)
                    ->setCellValue('G8', $vf3)
                    ->setCellValue('H8', $pipette3)
                    ->setCellValue('I8', $vf4)
                    ->setCellValue('K8', $concetration)
                    ->setCellValue('A9', 'Standard A')
                    ->setCellValue('B9', $weightA)
                    ->setCellValue('C9', $vf1A)
                    ->setCellValue('D9', $pipette1A)
                    ->setCellValue('E9', $vf2A)
                    ->setCellValue('F9', $pipette2A)
                    ->setCellValue('G9', $vf3A)
                    ->setCellValue('H9', $pipette3A)
                    ->setCellValue('I9', $vf4A)
                    ->setCellValue('K9', $concetrationA)
                    ->setCellValue('A10', 'Standard B')
                    ->setCellValue('B10', $weightB)
                    ->setCellValue('C10', $vf1B)
                    ->setCellValue('D10', $pipette1B)
                    ->setCellValue('E10', $vf2B)
                    ->setCellValue('F10', $pipette2B)
                    ->setCellValue('G10', $vf3B)
                    ->setCellValue('H10', $pipette3B)
                    ->setCellValue('I10', $vf4B)
                    ->setCellValue('K10', $concetrationB)

                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('I12', 'Sample Preparation For Assay')
                    ->setCellValue('B13', 'Powder Weight')
                    ->setCellValue('C13', 'API Weight')
                    ->setCellValue('D13', 'vf1')
                    ->setCellValue('E13', 'pipette1')
                    ->setCellValue('F13', 'vf2')
                    ->setCellValue('G13', 'pipette2')
                    ->setCellValue('H13', 'vf3')
                    ->setCellValue('I13', 'pipette3')
                    ->setCellValue('J13', 'vf4')
                    ->setCellValue('L13', 'Concetration')
                    ->setCellValue('F14', $potency)

                    //Assay Standard Preparation desired  
                    ->setCellValue('A14', 'Desired Weight')
                    ->setCellValue('B14', $pwnumber)
                    ->setCellValue('C14', $aiweight)
                    ->setCellValue('D14', $svf1)
                    ->setCellValue('E14', $sp1)
                    ->setCellValue('F14', $svf2)
                    ->setCellValue('G14', $spipette2)
                    ->setCellValue('H14', $svf3)
                    ->setCellValue('I14', $spipette3)
                    ->setCellValue('J14', $vf41)
                    ->setCellValue('L14', $smgml)
                    ->setCellValue('A15', 'Sample A')
                    ->setCellValue('B15', $sampleA)
                    ->setCellValue('C15', $u_weighta)
                    ->setCellValue('D15', $svf11)
                    ->setCellValue('E15', $sp11)
                    ->setCellValue('F15', $svf12)
                    ->setCellValue('G15', $spf1)
                    ->setCellValue('H15', $svf13)
                    ->setCellValue('I15', $spf21)
                    ->setCellValue('J15', $svf14)
                    ->setCellValue('L15', $smgml1)
                    ->setCellValue('A16', 'Sample B')
                    ->setCellValue('B16', $sampleB)
                    ->setCellValue('C16', $u_weightb)
                    ->setCellValue('D16', $svf111)
                    ->setCellValue('E16', $sp12)
                    ->setCellValue('F16', $svf22)
                    ->setCellValue('G16', $spf2)
                    ->setCellValue('H16', $svf23)
                    ->setCellValue('I16', $spf33)
                    ->setCellValue('J16', $svf241)
                    ->setCellValue('L16', $smgml2)
                    ->setCellValue('A17', 'Sample C')
                    ->setCellValue('B17', $sampleC)
                    ->setCellValue('C17', $u_weightc)
                    ->setCellValue('D17', $svf31)
                    ->setCellValue('E17', $ssp3)
                    ->setCellValue('F17', $svf33)
                    ->setCellValue('G17', $spf3)
                    ->setCellValue('H17', $svf24)
                    ->setCellValue('I17', $spf4)
                    ->setCellValue('J17', $svf25)
                    ->setCellValue('L17', $smgml3)

                    //Other values used
                    ->setCellValue('D22', 'Label Claim')
                    ->setCellValue('D23', 'Tabs or Caps Average')
                    ->setCellValue('D24', 'Procedure Used')
                    ->setCellValue('F22', $labelclaim)
                    ->setCellValue('F23', $tabs_caps_average)
                    ->setCellValue('F24', $procedure);

//                    ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);




            $objPHPExcel->getActiveSheet()->setTitle($heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePostingA($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }
    }

    function checkRepeatStatusCaps_t($labref) {
        $heading = $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $heading);
        $query = $this->db->get('multiple_assaystdab');
        $result = $query->result();
        return $result[0]->repeat_status;
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

    //======================================-- DISS EXPO TEST=========================================================//
    public function sendDissolutionDataToExcel_t() {
        $labref = $this->uri->segment(3);
        $component_no = $this->uri->segment(4);

        echo $repeat_stat = $this->checkDissPostingStatus($labref);

        $heading = $this->input->post('active_ing_head');
        //Tabs caps
        $tc1 = $this->input->post('tc1');
        $tc2 = $this->input->post('tc2');
        $tc3 = $this->input->post('tc3');
        $tc4 = $this->input->post('tc4');
        $tc5 = $this->input->post('tc5');
        $tc6 = $this->input->post('tc6');

        $tcmean = $this->input->post('tcmean');
        $tcreading = $this->input->post('tcreading');

        //Dissolution Conditions
        $DM = $this->input->post('DM');
        $R2 = $this->input->post('R2');
        $apparatus = $this->input->post('apparatus');
        $Rm = $this->input->post('Rm');
        $R3 = $this->input->post('R3');


        //dillution conditions
        $label_claim = $this->input->post('labelclaim');
        $volume_used = $this->input->post('vu');
        $piette = $this->input->post('workingp1');
        $volume = $this->input->post('workingv');
        $piette2 = $this->input->post('workingp2');
        $volume2 = $this->input->post('workingv2');
        $piette3 = $this->input->post('workingp3');
        $volume3 = $this->input->post('workingv3');
        $piette4 = $this->input->post('workingp4');
        $volume4 = $this->input->post('workingv4');
        $concetration = $this->input->post('conc');

        //procedure description
        $procedure = $this->input->post('procedure');

        //standard preparation
        //Standard preparation
        $workingweight = $this->input->post('workingweight');
        $workingvf1 = $this->input->post('workingvf1');
        $workingp11 = $this->input->post('workingp11');
        $workingvf2 = $this->input->post('workingvf2');
        $workingp12 = $this->input->post('workingp12');
        $workingvf3 = $this->input->post('workingvf3');
        $workingp13 = $this->input->post('workingp13');
        $workingvf4 = $this->input->post('workingvf4');
        $workingmgml = $this->input->post('workingmgml');

        $weightA = $this->input->post('u_weightA');
        $v1 = $this->input->post('v11');
        $p1 = $this->input->post('standardp1');
        $vf = $this->input->post('standardvf');
        $p2 = $this->input->post('p20');
        $vf3 = $this->input->post('vf3');
        $p3 = $this->input->post('p211');
        $vf4 = $this->input->post('vf4');
        $dmgml = $this->input->post('dmgml');

        $weightB = $this->input->post('u_weightB');
        $v12 = $this->input->post('v2');
        $p12 = $this->input->post('standardp2');
        $vf12 = $this->input->post('standardvf1');
        $p21 = $this->input->post('p21');
        $vf23 = $this->input->post('vf23');
        $p22 = $this->input->post('p22');
        $vf24 = $this->input->post('vf24');
        $dmgml1 = $this->input->post('dmgml1');
        
        //$this->output->enable_profiler();
        
          //Dissolution Conditions Buffer
        $DM2 = $this->input->post('DM2');
        $Rv21 = $this->input->post('Rv21');
        $apparatus2 = $this->input->post('apparatus2');
        $Rm2 = $this->input->post('Rm2');
        $R4 = $this->input->post('R4');


        //dillution conditions
        $label_claim1 = $this->input->post('labelclaim1');
        $volume_used1 = $this->input->post('vu2');
        $piette_2 = $this->input->post('workingp1_2');
        $volume_2 = $this->input->post('workingv_2');
        $piette2_2 = $this->input->post('workingp2_2');
        $volume2_2 = $this->input->post('workingv2_2');
        $piette3_2 = $this->input->post('workingp3_2');
        $volume3_2 = $this->input->post('workingv3_2');
        $piette4_2 = $this->input->post('workingp4_2');
        $volume4_2 = $this->input->post('workingv4_2');
        $concetration_2 = $this->input->post('conc_2');


        if ($repeat_stat != '0') {

            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            //$objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName('diss_' . $heading);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I36', 'REPEAT: ' . $repeat_stat)
                    ->setCellValue('E38', 'Tabs/Capsule Wt. (mg)')
                    ->setCellValue('E38', 'No.')
                    ->setCellValue('F38', 'Tabs/Capsule Wts.(mg)')
                    ->setCellValue('E39', '1')
                    ->setCellValue('F39', $tc1)
                    ->setCellValue('E40', '2')
                    ->setCellValue('F40', $tc2)
                    ->setCellValue('E41', '3')
                    ->setCellValue('F41', $tc3)
                    ->setCellValue('E42', '4')
                    ->setCellValue('F42', $tc4)
                    ->setCellValue('E43', '5')
                    ->setCellValue('F43', $tc5)
                    ->setCellValue('E44', '6')
                    ->setCellValue('F44', $tc6)
                    // ->setCellValue('E45', 'Total')
                    // ->setCellValue('F45', $tcreading)
                    ->setCellValue('E46', 'Mean')
                    ->setCellValue('F46', $tcmean)
                    ->setCellValue('E48', 'Dissolution Conditions')
                    ->setCellValue('H49', 'n Run')
                    ->setCellValue('F50', 'Dissolution Medium')
                    ->setCellValue('H50', $DM)
                    ->setCellValue('I50', $DM2)
                    ->setCellValue('F51', 'Volume Used')
                    ->setCellValue('H51', $R2)
                    ->setCellValue('I51', $Rv21)
                    ->setCellValue('F52', 'Apparatus')
                    ->setCellValue('H52', $apparatus)
                    ->setCellValue('I52', $apparatus2)
                    ->setCellValue('F53', 'Rotations Per minute')
                    ->setCellValue('H53', $Rm)
                    ->setCellValue('I53', $Rm2)
                    ->setCellValue('F54', 'Time Taken')
                    ->setCellValue('H54', $R3)
                    ->setCellValue('I54', $R4)
                    ->setCellValue('E56', 'Subsequent Dillutions')
                    ->setCellValue('B56', 'Label Claim')
                    ->setCellValue('C56', 'Volume Used')
                    ->setCellValue('D56', 'pipette1')
                    ->setCellValue('E56', 'vf1')
                    ->setCellValue('F56', 'pipette2')
                    ->setCellValue('G56', 'vf2')
                    ->setCellValue('H56', 'pipette3')
                    ->setCellValue('I56', 'vf3')
                    ->setCellValue('J56', 'pipette4')
                    ->setCellValue('K56', 'vf4')
                    ->setCellValue('L56', 'Concetration')
                    ->setCellValue('A57', 'Desired Concetration')
                    ->setCellValue('B57', $label_claim)
                    ->setCellValue('C57', $volume_used)
                    ->setCellValue('D57', $piette)
                    ->setCellValue('E57', $volume)
                    ->setCellValue('F57', $piette2)
                    ->setCellValue('G57', $volume2)
                    ->setCellValue('H57', $piette3)
                    ->setCellValue('I57', $volume3)
                    ->setCellValue('J57', $piette4)
                    ->setCellValue('K57', $volume4)
                    ->setCellValue('L57', $concetration)
                    
                    ->setCellValue('Q24', 'Subsequent Dillutions Buffer')
                    ->setCellValue('N56', 'Label Claim')
                    ->setCellValue('O56', 'Volume Used')
                    ->setCellValue('P56', 'pipette1')
                    ->setCellValue('Q56', 'vf1')
                    ->setCellValue('R56', 'pipette2')
                    ->setCellValue('S56', 'vf2')
                    ->setCellValue('T56', 'pipette3')
                    ->setCellValue('U56', 'vf3')
                    ->setCellValue('V56', 'pipette4')
                    ->setCellValue('W56', 'vf4')
                    ->setCellValue('X56', 'Concetration')
                    
                    //->setCellValue('A26', 'Desired Concetration')
                    ->setCellValue('N57', $label_claim1)
                    ->setCellValue('O57', $volume_used1)
                    ->setCellValue('P57', $piette_2)
                    ->setCellValue('Q57', $volume_2)
                    ->setCellValue('R57', $piette2_2)
                    ->setCellValue('S57', $volume2_2)
                    ->setCellValue('T57', $piette3_2)
                    ->setCellValue('U57', $volume3_2)
                    ->setCellValue('V57', $piette4_2)
                    ->setCellValue('W57', $volume4_2)
                    ->setCellValue('X57', $concetration_2)



                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('E457', 'Standard Preparation For Dissolution')
                    ->setCellValue('B59', 'Weight')
                    ->setCellValue('C59', 'Vf1')
                    ->setCellValue('D59', 'pipette1')
                    ->setCellValue('E59', 'vf2')
                    ->setCellValue('F59', 'pipette2')
                    ->setCellValue('G59', 'vf3')
                    ->setCellValue('H59', 'pipette3')
                    ->setCellValue('I59', 'vf4')
                    ->setCellValue('J59', 'Concetration')
                    //  ->setCellValue('L46', 'Concetration')
                    //Assay Standard Preparation desired  
                    ->setCellValue('A60', 'Desired Weight')
                    ->setCellValue('B60', $workingweight)
                    ->setCellValue('C60', $workingvf1)
                    ->setCellValue('D60', $workingp11)
                    ->setCellValue('E60', $workingvf2)
                    ->setCellValue('F60', $workingp12)
                    ->setCellValue('G60', $workingvf3)
                    ->setCellValue('H60', $workingp13)
                    ->setCellValue('I60', $workingvf4)
                    ->setCellValue('J60', $workingmgml)
                    ->setCellValue('A61', 'Standard A')
                    ->setCellValue('B61', $weightA)
                    ->setCellValue('C61', $v1)
                    ->setCellValue('D61', $p1)
                    ->setCellValue('E61', $vf)
                    ->setCellValue('F61', $p2)
                    ->setCellValue('G61', $vf3)
                    ->setCellValue('H61', $p3)
                    ->setCellValue('I61', $vf4)
                    ->setCellValue('J61', $dmgml)
                    ->setCellValue('A62', 'Standard B')
                    ->setCellValue('B62', $weightB)
                    ->setCellValue('C62', $v12)
                    ->setCellValue('D62', $p12)
                    ->setCellValue('E62', $vf12)
                    ->setCellValue('F62', $p21)
                    ->setCellValue('G62', $vf23)
                    ->setCellValue('H62', $p22)
                    ->setCellValue('I62', $vf24)
                    ->setCellValue('J62', $dmgml1)


                    //Other values used
                    ->setCellValue('B64', 'Procedure Used')
                    ->setCellValue('C64', $procedure)
                    ->setCellValue('B66', 'Worksheet No')
                    ->setCellValue('C66', $labref);

//             ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);

            $objPHPExcel->getActiveSheet()->setTitle('diss_' . $heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;




            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I3', $heading)
                    ->setCellValue('E5', 'Tabs/Capsule Weight')
                    ->setCellValue('E6', 'No.')
                    ->setCellValue('F6', 'Tabs/Capsule Weights (mg)')
                    ->setCellValue('E7', '1')
                    ->setCellValue('F7', $tc1)
                    ->setCellValue('E8', '2')
                    ->setCellValue('F8', $tc2)
                    ->setCellValue('E9', '3')
                    ->setCellValue('F9', $tc3)
                    ->setCellValue('E10', '4')
                    ->setCellValue('F10', $tc4)
                    ->setCellValue('E11', '5')
                    ->setCellValue('F11', $tc5)
                    ->setCellValue('E12', '6')
                    ->setCellValue('F12', $tc6)
                    ->setCellValue('E13', 'Total')
                    ->setCellValue('F13', $tcreading)
                    ->setCellValue('E14', 'Mean')
                    ->setCellValue('F14', $tcmean)
                    ->setCellValue('E16', 'Dissolution Conditions')
                    ->setCellValue('H17', 'n Run')
                    ->setCellValue('F18', 'Dissolution Medium')
                    ->setCellValue('H18', $DM)
                    ->setCellValue('I18', $DM2)
                    ->setCellValue('F19', 'Volume Used')
                    ->setCellValue('H19', $R2)
                    ->setCellValue('I19', $Rv21)
                    ->setCellValue('F20', 'Apparatus')
                    ->setCellValue('H20', $apparatus)
                    ->setCellValue('I20', $apparatus2)
                    ->setCellValue('F21', 'Rotations Per minute')
                    ->setCellValue('H21', $Rm)
                    ->setCellValue('I21', $Rm2)
                    ->setCellValue('F22', 'Time Taken')
                    ->setCellValue('H22', $R3)
                    ->setCellValue('I22', $R4)
                    
                    
                    ->setCellValue('E24', 'Subsequent Dillutions')
                    ->setCellValue('B25', 'Label Claim')
                    ->setCellValue('C25', 'Volume Used')
                    ->setCellValue('D25', 'pipette1')
                    ->setCellValue('E25', 'vf1')
                    ->setCellValue('F25', 'pipette2')
                    ->setCellValue('G25', 'vf2')
                    ->setCellValue('H25', 'pipette3')
                    ->setCellValue('I25', 'vf3')
                    ->setCellValue('J25', 'pipette4')
                    ->setCellValue('K25', 'vf4')
                    ->setCellValue('L25', 'Concetration')
                    ->setCellValue('A26', 'Desired Concetration')
                    ->setCellValue('B26', $label_claim)
                    ->setCellValue('C26', $volume_used)
                    ->setCellValue('D26', $piette)
                    ->setCellValue('E26', $volume)
                    ->setCellValue('F26', $piette2)
                    ->setCellValue('G26', $volume2)
                    ->setCellValue('H26', $piette3)
                    ->setCellValue('I26', $volume3)
                    ->setCellValue('J26', $piette4)
                    ->setCellValue('K26', $volume4)
                    ->setCellValue('L26', $concetration)
                    
                    
                    ->setCellValue('Q24', 'Subsequent Dillutions Buffer')
                    ->setCellValue('N25', 'Label Claim')
                    ->setCellValue('O25', 'Volume Used')
                    ->setCellValue('P25', 'pipette1')
                    ->setCellValue('Q25', 'vf1')
                    ->setCellValue('R25', 'pipette2')
                    ->setCellValue('S25', 'vf2')
                    ->setCellValue('T25', 'pipette3')
                    ->setCellValue('U25', 'vf3')
                    ->setCellValue('V25', 'pipette4')
                    ->setCellValue('W25', 'vf4')
                    ->setCellValue('X25', 'Concetration')
                    
                    //->setCellValue('A26', 'Desired Concetration')
                    ->setCellValue('N26', $label_claim1)
                    ->setCellValue('O26', $volume_used1)
                    ->setCellValue('P26', $piette_2)
                    ->setCellValue('Q26', $volume_2)
                    ->setCellValue('R26', $piette2_2)
                    ->setCellValue('S26', $volume2_2)
                    ->setCellValue('T26', $piette3_2)
                    ->setCellValue('U26', $volume3_2)
                    ->setCellValue('V26', $piette4_2)
                    ->setCellValue('W26', $volume4_2)
                    ->setCellValue('X26', $concetration_2)



                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('E28', 'Standard Preparation For Dissolution')
                    ->setCellValue('B28', 'Powder Weight')
                    ->setCellValue('C28', 'API Weight')
                    ->setCellValue('D28', 'vf1')
                    ->setCellValue('E28', 'pipette1')
                    ->setCellValue('F28', 'vf2')
                    ->setCellValue('G28', 'pipette2')
                    ->setCellValue('H28', 'vf3')
                    ->setCellValue('I28', 'pipette3')
                    ->setCellValue('J28', 'vf4')
                    ->setCellValue('L28', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A29', 'Desired Weight')
                    ->setCellValue('B29', $workingweight)
                    ->setCellValue('C29', $workingvf1)
                    ->setCellValue('D29', $workingp11)
                    ->setCellValue('E29', $workingvf2)
                    ->setCellValue('F29', $workingp12)
                    ->setCellValue('G29', $workingvf3)
                    ->setCellValue('H29', $workingp13)
                    ->setCellValue('I29', $workingvf4)
                    ->setCellValue('J29', $workingvf4)
                    ->setCellValue('L29', $workingmgml)
                    ->setCellValue('A30', 'Standard A')
                    ->setCellValue('B30', $weightA)
                    ->setCellValue('C30', $v1)
                    ->setCellValue('D30', $p1)
                    ->setCellValue('E30', $vf)
                    ->setCellValue('F30', $p2)
                    ->setCellValue('G30', $vf3)
                    ->setCellValue('H30', $p3)
                    ->setCellValue('I30', $vf4)
                    ->setCellValue('J30', $vf4)
                    ->setCellValue('L30', $dmgml)
                    ->setCellValue('A31', 'Standard B')
                    ->setCellValue('B31', $weightB)
                    ->setCellValue('C31', $v12)
                    ->setCellValue('D31', $p12)
                    ->setCellValue('E31', $vf12)
                    ->setCellValue('F31', $p21)
                    ->setCellValue('G31', $vf23)
                    ->setCellValue('H31', $p22)
                    ->setCellValue('I31', $vf24)
                    ->setCellValue('J31', $vf24)
                    ->setCellValue('L31', $dmgml1)


                    //Other values used
                    ->setCellValue('B33', 'Procedure Used')
                    ->setCellValue('C33', $procedure)
                    ->setCellValue('B33', 'Worksheet No')
                    ->setCellValue('C33', $labref);

//                    ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);




            $objPHPExcel->getActiveSheet()->setTitle('diss_' . $heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePostingD($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }
    }

    function checkRepeatStatusDiss_t($labref) {

        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $heading);
        $query = $this->db->get('diss_data');
        $result = $query->result();
        return $result[0]->repeat_status;
    }

    function upDatePostingD($labref) {
        $heading = $this->input->post('heading');
        $new_value = $this->checkDissPostingStatus($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'diss_' . $heading);
        $this->db->update('posting_status', $details);
    }

    function checkDissPostingStatus($labref) {
        $heading = $this->input->post('active_ing_head');

        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'diss_' . $heading)
                ->get('posting_status ');
        $result = $query->result();
       return $result[0]->posting_count;
    }

//======================================TABS TO EXCEL=========================================================//
    public function exportTabsToExcel() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkRepeatStatusTabs($labref);

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

        if ($repeat_stat != '0') {

            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            //$objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName('uniformity');
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B28', 'UNIFORMITY TABS REPEAT: ' . $repeat_stat)
                    ->setCellValue('A30', 'Tablets(mg)')
                    ->setCellValue('C30', 'Percentage Deviation')
                    ->setCellValue('A31', $tcsv1)
                    ->setCellValue('C31', $dfm1)
                    ->setCellValue('A32', $tcsv2)
                    ->setCellValue('C32', $dfm2)
                    ->setCellValue('A33', $tcsv3)
                    ->setCellValue('C33', $dfm3)
                    ->setCellValue('A34', $tcsv4)
                    ->setCellValue('C34', $dfm4)
                    ->setCellValue('A35', $tcsv5)
                    ->setCellValue('C35', $dfm5)
                    ->setCellValue('A36', $tcsv6)
                    ->setCellValue('C36', $dfm6)
                    ->setCellValue('A37', $tcsv7)
                    ->setCellValue('C37', $dfm7)
                    ->setCellValue('A38', $tcsv8)
                    ->setCellValue('C38', $dfm8)
                    ->setCellValue('A39', $tcsv9)
                    ->setCellValue('C39', $dfm9)
                    ->setCellValue('A40', $tcsv10)
                    ->setCellValue('C40', $dfm10)
                    ->setCellValue('A41', $tcsv11)
                    ->setCellValue('C41', $dfm11)
                    ->setCellValue('A42', $tcsv12)
                    ->setCellValue('C42', $dfm12)
                    ->setCellValue('A43', $tcsv13)
                    ->setCellValue('C43', $dfm13)
                    ->setCellValue('A44', $tcsv14)
                    ->setCellValue('C44', $dfm14)
                    ->setCellValue('A45', $tcsv15)
                    ->setCellValue('C45', $dfm15)
                    ->setCellValue('A46', $tcsv16)
                    ->setCellValue('C46', $dfm16)
                    ->setCellValue('A47', $tcsv17)
                    ->setCellValue('C47', $dfm17)
                    ->setCellValue('A48', $tcsv18)
                    ->setCellValue('C48', $dfm18)
                    ->setCellValue('A49', $tcsv19)
                    ->setCellValue('C49', $dfm19)
                    ->setCellValue('A50', $tcsv20)
                    ->setCellValue('C50', $dfm20)
                    ->setCellValue('A51', 'Worksheet No')
                    ->setCellValue('C51', $labref);





            $objPHPExcel->getActiveSheet()->setTitle("uniformity");


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;




            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A2', 'Tablets(mg)')
                    ->setCellValue('C2', 'Percentage Deviation')
                    ->setCellValue('A4', $tcsv1)
                    ->setCellValue('C4', $dfm1)
                    ->setCellValue('A5', $tcsv2)
                    ->setCellValue('C5', $dfm2)
                    ->setCellValue('A6', $tcsv3)
                    ->setCellValue('C6', $dfm3)
                    ->setCellValue('A7', $tcsv4)
                    ->setCellValue('C7', $dfm4)
                    ->setCellValue('A8', $tcsv5)
                    ->setCellValue('C8', $dfm5)
                    ->setCellValue('A9', $tcsv6)
                    ->setCellValue('C9', $dfm6)
                    ->setCellValue('A10', $tcsv7)
                    ->setCellValue('C10', $dfm7)
                    ->setCellValue('A11', $tcsv8)
                    ->setCellValue('C11', $dfm8)
                    ->setCellValue('A12', $tcsv9)
                    ->setCellValue('C12', $dfm9)
                    ->setCellValue('A13', $tcsv10)
                    ->setCellValue('C13', $dfm10)
                    ->setCellValue('A14', $tcsv11)
                    ->setCellValue('C14', $dfm11)
                    ->setCellValue('A15', $tcsv12)
                    ->setCellValue('C15', $dfm12)
                    ->setCellValue('A16', $tcsv13)
                    ->setCellValue('C16', $dfm13)
                    ->setCellValue('A17', $tcsv14)
                    ->setCellValue('C17', $dfm14)
                    ->setCellValue('A18', $tcsv15)
                    ->setCellValue('C18', $dfm15)
                    ->setCellValue('A19', $tcsv16)
                    ->setCellValue('C19', $dfm16)
                    ->setCellValue('A20', $tcsv17)
                    ->setCellValue('C20', $dfm17)
                    ->setCellValue('A21', $tcsv18)
                    ->setCellValue('C21', $dfm18)
                    ->setCellValue('A22', $tcsv19)
                    ->setCellValue('C22', $dfm19)
                    ->setCellValue('A23', $tcsv20)
                    ->setCellValue('C23', $dfm20)
                    ->setCellValue('A25', 'Worksheet No')
                    ->setCellValue('C25', $labref);






            $objPHPExcel->getActiveSheet()->setTitle("uniformity");


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePosting($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }
    }

    function upDatePosting($labref) {
        $new_value = $this->checkRepeatStatusTabs($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'uniformity');
        $this->db->update('posting_status', $details);
    }

    function checkRepeatStatusTabs($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'uniformity')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    function show($labref) {
        $this->checkAssayPostingStatus($labref);
    }

    //===================================================SUMMARY SAMPLE==================================================//
    public function getDataToExcel() {
        $component_no = $this->uri->segment(5);

        if ($component_no == '1') {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;
            $labref = $this->uri->segment(3);
            //$this->output->enable_profiler();
            $SampleName = $this->input->post('SampleName');
            $LabRef = $this->input->post('LabRef');
            $LabelClaim = $this->input->post('LabelClaim');
            $ActiveIng = $this->input->post('ActiveInng');
            $DateCompleted = $this->input->post('DateCompleted');



            //standard Assay
            $assayDesired = $this->input->post('assayDesired');
            $stdA = $this->input->post('standardA');
            $stdB = $this->input->post('standardB');
            $dconcetration = $this->input->post('dconcetration');

            //sample preparation, powder Weight
            $samplDesiredpw = $this->input->post('sampleDesiredpw');
            $sastandarda = $this->input->post('sastandarda');
            $sastandardb = $this->input->post('sastandardb');
            $sastandardc = $this->input->post('sastandardc');

            //sample API weight
            $samplDesiredap = $this->input->post('sampleDesiredap');
            $apstandarda = $this->input->post('apstandarda');
            $apstandardb = $this->input->post('apstandardb');
            $apstandardc = $this->input->post('apstandardc');
            $sampleconcetration = $this->input->post('sampleconcetration');
            //Uniformity of weight
            $tabscapsaverage = $this->input->post('tabcapssaverage');
            // $capsaverage = $this->input->post('capsaverage');
            //tab and cap status
            // $tabstatus = $this->input->post('tabstatus');
            // $capstatus= $this->input->post('capstatus');
            //Dissolution Tabs
            $tab1 = $this->input->post('tab1');
            $tab2 = $this->input->post('tab2');
            $tab3 = $this->input->post('tab3');
            $tab4 = $this->input->post('tab4');
            $tab5 = $this->input->post('tab5');
            $tab6 = $this->input->post('tab6');

            //Dissolution Other Tests
            $desiredweight = $this->input->post('desiredweight');
            $disstda = $this->input->post('disstda');
            $disstdb = $this->input->post('disstdb');
            $concetration = $this->input->post('concetration');
            $tabaverage = $this->input->post('tabaverage');

            $head = $this->input->post('head');

            $speak = $this->input->post('speak');
            $smpeak = $this->input->post('smpeak');
            $speakd = $this->input->post('speakd');

            $area_1 = $this->input->post('area1');
            $area_2 = $this->input->post('area2');
            $area_3 = $this->input->post('area3');
            $area_4 = $this->input->post('area4');
            $area_5 = $this->input->post('area5');
            
            $area_11 = $this->input->post('area111');
            $area_22 = $this->input->post('area121');
            $area_33 = $this->input->post('area131');
            $area_44 = $this->input->post('area141');
            $area_55 = $this->input->post('area151');

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");


            echo 'Worksheet loaded';
            $NewWorksheetIndex = $worksheetIndex * 0;
            $objPHPExcel->setActiveSheetIndex($NewWorksheetIndex);
            $objPHPExcel->getActiveSheet()
                    //Worksheet Information
                    ->setCellValue('B9', $head)
                    ->setCellValue('H14',  $head)
                    ->setCellValue('H40',  $head)
                    ->setCellValue('G65',  $head)
                    ->setCellValue('H119',  $head)
                    
                    ->setCellValue('G67', $area_11)
                    ->setCellValue('H67', $area_22)
                    ->setCellValue('I67', $area_33)
                    ->setCellValue('J67', $area_44)
                    ->setCellValue('K67', $area_55)
                    
                    ->setCellValue('M67', $area_11)
                    ->setCellValue('N67', $area_22)
                    ->setCellValue('O67', $area_33)
                    ->setCellValue('P67', $area_44)
                    ->setCellValue('Q67', $area_55)
                    
                    
                    ->setCellValue('B4', $SampleName)
                    ->setCellValue('B5', $LabRef)
                    ->setCellValue('B6', $ActiveIng)
                    ->setCellValue('B7', $LabelClaim)
                    ->setCellValue('B7', $DateCompleted)
                    ->setCellValue('C18', 'Assay Standards - ' . $head)
                    ->setCellValue('E17', 'Sample Assay - ' . $head)
                    

                    //Sample and Standard Assay Information
                    ->setCellValue('D21', $assayDesired)
                    ->setCellValue('D19', $stdA)
                    ->setCellValue('D20', $stdB)
                    ->setCellValue('D22', $dconcetration)
                    ->setCellValue('F27', $samplDesiredpw)
                    ->setCellValue('F28', $samplDesiredap)
                    ->setCellValue('F19', $sastandarda)
                    ->setCellValue('F20', $sastandardb)
                    ->setCellValue('F21', $sastandardc)
                    ->setCellValue('F23', $apstandarda)
                    ->setCellValue('F24', $apstandardb)
                    ->setCellValue('F25', $apstandardc)
                    ->setCellValue('I10', $sampleconcetration)
                    //Dissolution
                    ->setCellValue('B23', $head)
                    ->setCellValue('B24', $tab1)
                    ->setCellValue('B25', $tab2)
                    ->setCellValue('B26', $tab3)
                    ->setCellValue('B27', $tab4)
                    ->setCellValue('B28', $tab5)
                    ->setCellValue('B29', $tab6)

                    //Other Dssolution Data     
                    ->setCellValue('B106', $head)
                    ->setCellValue('B107', $desiredweight)
                    ->setCellValue('B108', $disstda)
                    ->setCellValue('B109', $disstdb)
                    ->setCellValue('B110', $concetration)
                    ->setCellValue('B111', $tabaverage)
                    ->setCellValue('B19', $tabscapsaverage);

            
            $speak = $this->input->post('speak');
            $smpeak = $this->input->post('smpeak');
            $speakd = $this->input->post('speakd');
            
           $area_1 = $this->input->post('area1');
            $area_2 = $this->input->post('area2');
            $area_3 = $this->input->post('area3');
            $area_4 = $this->input->post('area4');
            $area_5 = $this->input->post('area5');
            
            $labelclaims = $this->findComponents($labref);
            $worksheet = $objPHPExcel->getActiveSheet();

            $row2 = 142;

            foreach ($labelclaims as $labels):
                $col = 0;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels->name)
                        ->setCellValueByColumnAndRow($col++, $row2, $labels->volume2);
                $row2++;
            endforeach;


            $row = 15;
            foreach ($speak as $labels):
                $col = 7;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 41;
            foreach ($smpeak as $labels):
                $col = 7;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakd as $labels):
                $col = 7;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 68;
            for ($i = 0; $i < count($area_1); $i++) {
                $col = 6;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5[$i]);
                $row++;
            }



            $objPHPExcel->getActiveSheet()->setTitle("Sample Summary");

            $dir = "workbooks";

            if (is_dir($dir)) {

              

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            

                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->insertData($labref);
                $this->post_repests($labref, $component_no, $head);



                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        } elseif ($component_no == '2') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

            //standard Assay
            $assayDesired = $this->input->post('assayDesired');
            $stdA = $this->input->post('standardA');
            $stdB = $this->input->post('standardB');
            $dconcetration = $this->input->post('dconcetration');

            //sample preparation, powder Weight
            $samplDesiredpw = $this->input->post('sampleDesiredpw');
            $sastandarda = $this->input->post('sastandarda');
            $sastandardb = $this->input->post('sastandardb');
            $sastandardc = $this->input->post('sastandardc');

            //sample API weight
            $samplDesiredap = $this->input->post('sampleDesiredap');
            $apstandarda = $this->input->post('apstandarda');
            $apstandardb = $this->input->post('apstandardb');
            $apstandardc = $this->input->post('apstandardc');
            $sampleconcetration = $this->input->post('sampleconcetration');

            //Dissolution Tabs
            $tab1 = $this->input->post('tab1');
            $tab2 = $this->input->post('tab2');
            $tab3 = $this->input->post('tab3');
            $tab4 = $this->input->post('tab4');
            $tab5 = $this->input->post('tab5');
            $tab6 = $this->input->post('tab6');

            //Dissolution Other Tests
            $desiredweight = $this->input->post('desiredweight');
            $disstda = $this->input->post('disstda');
            $disstdb = $this->input->post('disstdb');
            $concetration = $this->input->post('concetration');
            $tabaverage = $this->input->post('tabaverage');
            
            $area_11 = $this->input->post('area111');
            $area_22 = $this->input->post('area121');
            $area_33 = $this->input->post('area131');
            $area_44 = $this->input->post('area141');
            $area_55 = $this->input->post('area151');

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C23', 'Assay Standards - ' . $head)
                    ->setCellValue('E29', 'Sample Assay - ' . $head)
                    ->setCellValue('C9', $head)
                    
                    ->setCellValue('K14',  $head)
                    ->setCellValue('K40',  $head)
                    ->setCellValue('G75',  $head)
                    ->setCellValue('K119',  $head)
                    
                    ->setCellValue('G77', $area_11)
                    ->setCellValue('H77', $area_22)
                    ->setCellValue('I77', $area_33)
                    ->setCellValue('J77', $area_44)
                    ->setCellValue('K77', $area_55)
                    
                    ->setCellValue('M77', $area_11)
                    ->setCellValue('N77', $area_22)
                    ->setCellValue('O77', $area_33)
                    ->setCellValue('P77', $area_44)
                    ->setCellValue('Q77', $area_55)
                    
                    
                    ->setCellValue('D26', $assayDesired)
                    ->setCellValue('D24', $stdA)
                    ->setCellValue('D25', $stdB)
                    ->setCellValue('D27', $dconcetration)
                    ->setCellValue('F39', $samplDesiredpw)
                    ->setCellValue('F40', $samplDesiredap)
                    ->setCellValue('F31', $sastandarda)
                    ->setCellValue('F32', $sastandardb)
                    ->setCellValue('F33', $sastandardc)
                    ->setCellValue('F35', $apstandarda)
                    ->setCellValue('F36', $apstandardb)
                    ->setCellValue('F37', $apstandardc)
                    ->setCellValue('I10', $sampleconcetration)

                    //Dissolution
                    ->setCellValue('B31', $tab1)
                    ->setCellValue('B32', $tab1)
                    ->setCellValue('B33', $tab2)
                    ->setCellValue('B34', $tab3)
                    ->setCellValue('B35', $tab4)
                    ->setCellValue('B36', $tab5)
                    ->setCellValue('B37', $tab6)

                    //Other Dssolution Data 
                    ->setCellValue('B112', $head)
                    
                    ->setCellValue('B114', $desiredweight)
                    ->setCellValue('B115', $disstda)
                    ->setCellValue('B116', $disstdb)
                    ->setCellValue('B117', $concetration)
                    ->setCellValue('B118', $tabaverage);
            
            
              
            $speak = $this->input->post('speak');
            $smpeak = $this->input->post('smpeak');
            $speakd = $this->input->post('speakd');
            
                     $area_1 = $this->input->post('area1');
            $area_2 = $this->input->post('area2');
            $area_3 = $this->input->post('area3');
            $area_4 = $this->input->post('area4');
            $area_5 = $this->input->post('area5');
            
            
            $labelclaims = $this->findComponents($labref);
            $worksheet = $objPHPExcel->getActiveSheet();    


            $row = 15;
            foreach ($speak as $labels):
                $col = 10;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 41;
            foreach ($smpeak as $labels):
                $col = 10;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakd as $labels):
                $col = 10;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 78;
            for ($i = 0; $i < count($area_1); $i++) {
                $col = 6;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5[$i]);
                $row++;
            }
            

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
          $this->post_repests($labref, $component_no, $head);

            echo 'exported';
        } elseif ($component_no == '3') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

            //standard Assay
            $assayDesired = $this->input->post('assayDesired');
            $stdA = $this->input->post('standardA');
            $stdB = $this->input->post('standardB');
            $dconcetration = $this->input->post('dconcetration');

            //sample preparation, powder Weight
            $samplDesiredpw = $this->input->post('sampleDesiredpw');
            $sastandarda = $this->input->post('sastandarda');
            $sastandardb = $this->input->post('sastandardb');
            $sastandardc = $this->input->post('sastandardc');

            //sample API weight
            $samplDesiredap = $this->input->post('sampleDesiredap');
            $apstandarda = $this->input->post('apstandarda');
            $apstandardb = $this->input->post('apstandardb');
            $apstandardc = $this->input->post('apstandardc');
            $sampleconcetration = $this->input->post('sampleconcetration');

            //Dissolution Tabs
            $tab1 = $this->input->post('tab1');
            $tab2 = $this->input->post('tab2');
            $tab3 = $this->input->post('tab3');
            $tab4 = $this->input->post('tab4');
            $tab5 = $this->input->post('tab5');
            $tab6 = $this->input->post('tab6');

            //Dissolution Other Tests
            $desiredweight = $this->input->post('desiredweight');
            $disstda = $this->input->post('disstda');
            $disstdb = $this->input->post('disstdb');
            $concetration = $this->input->post('concetration');
            $tabaverage = $this->input->post('tabaverage');

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C28', 'Assay Standards - ' . $head)
                    ->setCellValue('E41', 'Sample Assay - ' . $head)
                    ->setCellValue('D9', $head)
                    
                     ->setCellValue('H23',  $head)
                    ->setCellValue('H52',  $head)
                    ->setCellValue('G85',  $head)
                    ->setCellValue('N119',  $head)
                    
                         ->setCellValue('G67', $area_11)
                    ->setCellValue('H87', $area_22)
                    ->setCellValue('I87', $area_33)
                    ->setCellValue('J87', $area_44)
                    ->setCellValue('K87', $area_55)
                    
                    ->setCellValue('M87', $area_11)
                    ->setCellValue('N87', $area_22)
                    ->setCellValue('O87', $area_33)
                    ->setCellValue('P87', $area_44)
                    ->setCellValue('Q87', $area_55)
                    
                    ->setCellValue('D31', $assayDesired)
                    ->setCellValue('D29', $stdA)
                    ->setCellValue('D30', $stdB)
                    ->setCellValue('D32', $dconcetration)
                    ->setCellValue('F52', $samplDesiredpw)
                    ->setCellValue('F51', $samplDesiredap)
                    ->setCellValue('F44', $sastandarda)
                    ->setCellValue('F43', $sastandardb)
                    ->setCellValue('F45', $sastandardc)
                    ->setCellValue('F47', $apstandarda)
                    ->setCellValue('F48', $apstandardb)
                    ->setCellValue('F49', $apstandardc)
                    ->setCellValue('I10', $sampleconcetration)

                    //Dissolution
                    ->setCellValue('B39', $head)
                    ->setCellValue('B40', $tab1)
                    ->setCellValue('B41', $tab2)
                    ->setCellValue('B42', $tab3)
                    ->setCellValue('B43', $tab4)
                    ->setCellValue('B44', $tab5)
                    ->setCellValue('B45', $tab6)

                    //Other Dssolution Data   
                    ->setCellValue('B119', $head)
                    ->setCellValue('B121', $desiredweight)
                    ->setCellValue('B122', $disstda)
                    ->setCellValue('B123', $disstdb)
                    ->setCellValue('B124', $concetration)
                    ->setCellValue('B125', $tabaverage);
            
              $speak = $this->input->post('speak');
            $smpeak = $this->input->post('smpeak');
            $speakd = $this->input->post('speakd');
            
                     $area_1 = $this->input->post('area1');
            $area_2 = $this->input->post('area2');
            $area_3 = $this->input->post('area3');
            $area_4 = $this->input->post('area4');
            $area_5 = $this->input->post('area5');
            
            
            $labelclaims = $this->findComponents($labref);
            $worksheet = $objPHPExcel->getActiveSheet();    


            $row = 24;
            foreach ($speak as $labels):
                $col = 7;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeak as $labels):
                $col = 7;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakd as $labels):
                $col = 13;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 88;
            for ($i = 0; $i < count($area_1); $i++) {
                $col = 6;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5[$i]);
                $row++;
            }
            

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                            $this->post_repests($labref, $component_no, $head);

        } elseif ($component_no == '4') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

            //standard Assay
            $assayDesired = $this->input->post('assayDesired');
            $stdA = $this->input->post('standardA');
            $stdB = $this->input->post('standardB');
            $dconcetration = $this->input->post('dconcetration');

            //sample preparation, powder Weight
            $samplDesiredpw = $this->input->post('sampleDesiredpw');
            $sastandarda = $this->input->post('sastandarda');
            $sastandardb = $this->input->post('sastandardb');
            $sastandardc = $this->input->post('sastandardc');

            //sample API weight
            $samplDesiredap = $this->input->post('sampleDesiredap');
            $apstandarda = $this->input->post('apstandarda');
            $apstandardb = $this->input->post('apstandardb');
            $apstandardc = $this->input->post('apstandardc');
            $sampleconcetration = $this->input->post('sampleconcetration');

            //Dissolution Tabs
            $tab1 = $this->input->post('tab1');
            $tab2 = $this->input->post('tab2');
            $tab3 = $this->input->post('tab3');
            $tab4 = $this->input->post('tab4');
            $tab5 = $this->input->post('tab5');
            $tab6 = $this->input->post('tab6');

            //Dissolution Other Tests
            $desiredweight = $this->input->post('desiredweight');
            $disstda = $this->input->post('disstda');
            $disstdb = $this->input->post('disstdb');
            $concetration = $this->input->post('concetration');
            $tabaverage = $this->input->post('tabaverage');

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C33', 'Assay Standards - ' . $head)
                    ->setCellValue('E53', 'Sample Assay - ' . $head)
                    ->setCellValue('E9', $head)
                    
                      ->setCellValue('K23',  $head)
                    ->setCellValue('K52',  $head)
                    ->setCellValue('G95',  $head)
                    ->setCellValue('H127',  $head)
                    
                         ->setCellValue('G67', $area_11)
                    ->setCellValue('H97', $area_22)
                    ->setCellValue('I97', $area_33)
                    ->setCellValue('J97', $area_44)
                    ->setCellValue('K97', $area_55)
                    
                    ->setCellValue('M97', $area_11)
                    ->setCellValue('N97', $area_22)
                    ->setCellValue('O97', $area_33)
                    ->setCellValue('P97', $area_44)
                    ->setCellValue('Q97', $area_55)
                    
                    ->setCellValue('D36', $assayDesired)
                    ->setCellValue('D34', $stdA)
                    ->setCellValue('D35', $stdB)
                    ->setCellValue('D37', $dconcetration)
                    ->setCellValue('F63', $samplDesiredpw)
                    ->setCellValue('F64', $samplDesiredap)
                    ->setCellValue('F55', $sastandarda)
                    ->setCellValue('F56', $sastandardb)
                    ->setCellValue('F57', $sastandardc)
                    ->setCellValue('F59', $apstandarda)
                    ->setCellValue('F60', $apstandardb)
                    ->setCellValue('F61', $apstandardc)
                    ->setCellValue('I10', $sampleconcetration)

                    //Dissolution
                    ->setCellValue('B47', $head)
                    ->setCellValue('B48', $tab1)
                    ->setCellValue('B49', $tab2)
                    ->setCellValue('B50', $tab3)
                    ->setCellValue('B51', $tab4)
                    ->setCellValue('B52', $tab5)
                    ->setCellValue('B53', $tab6)

                    //Other Dssolution Data 
                    ->setCellValue('B126', $head)
                    ->setCellValue('B128', $desiredweight)
                    ->setCellValue('B129', $disstda)
                    ->setCellValue('B130', $disstdb)
                    ->setCellValue('B131', $concetration)
                    ->setCellValue('B132', $tabaverage);
            
              $speak = $this->input->post('speak');
            $smpeak = $this->input->post('smpeak');
            $speakd = $this->input->post('speakd');
            
                     $area_1 = $this->input->post('area1');
            $area_2 = $this->input->post('area2');
            $area_3 = $this->input->post('area3');
            $area_4 = $this->input->post('area4');
            $area_5 = $this->input->post('area5');
            
            
            $labelclaims = $this->findComponents($labref);
            $worksheet = $objPHPExcel->getActiveSheet();    


            $row = 24;
            foreach ($speak as $labels):
                $col = 10;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeak as $labels):
                $col = 10;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 128;
            foreach ($speakd as $labels):
                $col = 7;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 98;
            for ($i = 0; $i < count($area_1); $i++) {
                $col = 6;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5[$i]);
                $row++;
            }
            
            

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                            $this->post_repests($labref, $component_no, $head);

        } elseif ($component_no == '5') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

            //standard Assay
            $assayDesired = $this->input->post('assayDesired');
            $stdA = $this->input->post('standardA');
            $stdB = $this->input->post('standardB');
            $dconcetration = $this->input->post('dconcetration');

            //sample preparation, powder Weight
            $samplDesiredpw = $this->input->post('sampleDesiredpw');
            $sastandarda = $this->input->post('sastandarda');
            $sastandardb = $this->input->post('sastandardb');
            $sastandardc = $this->input->post('sastandardc');

            //sample API weight
            $samplDesiredap = $this->input->post('sampleDesiredap');
            $apstandarda = $this->input->post('apstandarda');
            $apstandardb = $this->input->post('apstandardb');
            $apstandardc = $this->input->post('apstandardc');
            $sampleconcetration = $this->input->post('sampleconcetration');

            //Dissolution Tabs
            $tab1 = $this->input->post('tab1');
            $tab2 = $this->input->post('tab2');
            $tab3 = $this->input->post('tab3');
            $tab4 = $this->input->post('tab4');
            $tab5 = $this->input->post('tab5');
            $tab6 = $this->input->post('tab6');

            //Dissolution Other Tests
            $desiredweight = $this->input->post('desiredweight');
            $disstda = $this->input->post('disstda');
            $disstdb = $this->input->post('disstdb');
            $concetration = $this->input->post('concetration');
            $tabaverage = $this->input->post('tabaverage');

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C38', 'Assay Standards - ' . $head)
                    ->setCellValue('E65', 'Sample Assay - ' . $head)
                    ->setCellValue('F9', $head)
                    
                     ->setCellValue('H31',  $head)
                    ->setCellValue('N52',  $head)
                    ->setCellValue('G105',  $head)
                    ->setCellValue('K127',  $head)
                    
                    ->setCellValue('G107', $area_11)
                    ->setCellValue('H107', $area_22)
                    ->setCellValue('I107', $area_33)
                    ->setCellValue('J107', $area_44)
                    ->setCellValue('K107', $area_55)
                    
                    ->setCellValue('M107', $area_11)
                    ->setCellValue('N107', $area_22)
                    ->setCellValue('O107', $area_33)
                    ->setCellValue('P107', $area_44)
                    ->setCellValue('Q107', $area_55)
                    
                    ->setCellValue('D41', $assayDesired)
                    ->setCellValue('D39', $stdA)
                    ->setCellValue('D40', $stdB)
                    ->setCellValue('D42', $dconcetration)
                    ->setCellValue('F75', $samplDesiredpw)
                    ->setCellValue('F76', $samplDesiredap)
                    ->setCellValue('F67', $sastandarda)
                    ->setCellValue('F68', $sastandardb)
                    ->setCellValue('F69', $sastandardc)
                    ->setCellValue('F71', $apstandarda)
                    ->setCellValue('F72', $apstandardb)
                    ->setCellValue('F73', $apstandardc)
                    ->setCellValue('I10', $sampleconcetration)


                    //Dissolution
                    ->setCellValue('B55', $head)
                    ->setCellValue('B56', $tab1)
                    ->setCellValue('B57', $tab2)
                    ->setCellValue('B58', $tab3)
                    ->setCellValue('B59', $tab4)
                    ->setCellValue('B60', $tab5)
                    ->setCellValue('B61', $tab6)

                    //Other Dssolution Data
                    ->setCellValue('B133', $head)
                    ->setCellValue('B135', $desiredweight)
                    ->setCellValue('B136', $disstda)
                    ->setCellValue('B137', $disstdb)
                    ->setCellValue('B138', $concetration)
                    ->setCellValue('B139', $tabaverage);
            
            
              $speak = $this->input->post('speak');
            $smpeak = $this->input->post('smpeak');
            $speakd = $this->input->post('speakd');
            
                     $area_1 = $this->input->post('area1');
            $area_2 = $this->input->post('area2');
            $area_3 = $this->input->post('area3');
            $area_4 = $this->input->post('area4');
            $area_5 = $this->input->post('area5');
            
            
            $labelclaims = $this->findComponents($labref);
            $worksheet = $objPHPExcel->getActiveSheet();    


            $row = 32;
            foreach ($speak as $labels):
                $col = 7;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeak as $labels):
                $col = 13;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 128;
            foreach ($speakd as $labels):
                $col = 10;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 108;
            for ($i = 0; $i < count($area_1); $i++) {
                $col = 6;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5[$i]);
                $row++;
            }
            

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                       $this->post_repests($labref, $head,$component_no );

            }
    }

    function postRepeats() {
        $labref=  $this->uri->segment(3);
        $head=  $this->input->post('head');
        $component_no=  $this->input->post('component_no');
        if ($this->checkPostingSummary($labref,$head) == 1 && $component_no=='1') {
         
            
            $data = $this->getLastWorksheet();
                echo $worksheetIndex = $data[0]->no_of_sheets;
                //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');
                //Uniformity of weight
                $tabscapsaverage = $this->input->post('tabcapssaverage');
                // $capsaverage = $this->input->post('capsaverage');
                //tab and cap status
                // $tabstatus = $this->input->post('tabstatus');
                // $capstatus= $this->input->post('capstatus');
                //Dissolution Tabs
                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');

                $head = $this->input->post('head');

                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");


                echo 'Worksheet loaded';
                $NewWorksheetIndex = $worksheetIndex * 0;
                $objPHPExcel->setActiveSheetIndex($NewWorksheetIndex);
                $objPHPExcel->getActiveSheet()


                        //Sample and Standard Assay Information
                        ->setCellValue('D49', $stdA)
                        ->setCellValue('D50', $stdB)
                        ->setCellValue('D51', $assayDesired)
                        ->setCellValue('D52', $dconcetration)
                        ->setCellValue('F90', $samplDesiredpw)
                        ->setCellValue('F91', $samplDesiredap)
                        ->setCellValue('F82', $sastandarda)
                        ->setCellValue('F83', $sastandardb)
                        ->setCellValue('F84', $sastandardc)
                        ->setCellValue('F86', $apstandarda)
                        ->setCellValue('F87', $apstandardb)
                        ->setCellValue('F88', $apstandardc)
                        ->setCellValue('J10', $sampleconcetration)
                        //Dissolution
                        ->setCellValue('B65', $head)
                        ->setCellValue('B66', $tab1)
                        ->setCellValue('B67', $tab2)
                        ->setCellValue('B68', $tab3)
                        ->setCellValue('B69', $tab4)
                        ->setCellValue('B70', $tab5)
                        ->setCellValue('B71', $tab6)

                        //Other Dssolution Data     
                        ->setCellValue('B106', $head)
                        ->setCellValue('C107', $desiredweight)
                        ->setCellValue('C108', $disstda)
                        ->setCellValue('C109', $disstdb)
                        ->setCellValue('C110', $concetration)
                        ->setCellValue('C111', $tabaverage);

                
            $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
                
                     $worksheet = $objPHPExcel->getActiveSheet();    
                $row = 15;
            foreach ($speakr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 41;
            foreach ($smpeakr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakdr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 68;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }




               // $objPHPExcel->getActiveSheet()->setTitle("Sample Summary");

                   

                   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");   
              echo 'exported';

            
        }else if(($this->checkPostingSummary($labref,$head)==1 && ($component_no == '2'))){
           
            //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C53', 'Assay Standards  repeat- ' . $head)
                        ->setCellValue('E92', 'Sample Assay repeat - ' . $head)
                        ->setCellValue('D54', $assayDesired)
                        ->setCellValue('D55', $stdA)
                        ->setCellValue('D56', $stdB)
                        ->setCellValue('D57', $dconcetration)
                        ->setCellValue('F102', $samplDesiredpw)
                        ->setCellValue('F103', $samplDesiredap)
                        ->setCellValue('F94', $sastandarda)
                        ->setCellValue('F95', $sastandardb)
                        ->setCellValue('F96', $sastandardc)
                        ->setCellValue('F98', $apstandarda)
                        ->setCellValue('F99', $apstandardb)
                        ->setCellValue('F100', $apstandardc)
                        ->setCellValue('J10', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B73', $head)
                        ->setCellValue('B74', $tab1)
                        ->setCellValue('B75', $tab2)
                        ->setCellValue('B76', $tab3)
                        ->setCellValue('B77', $tab4)
                        ->setCellValue('B78', $tab5)
                        ->setCellValue('B79', $tab6)

                        //Other Dssolution Data 
                        ->setCellValue('C112', $head)
                        ->setCellValue('C114', $desiredweight)
                        ->setCellValue('C115', $disstda)
                        ->setCellValue('C116', $disstdb)
                        ->setCellValue('C117', $concetration)
                        ->setCellValue('C118', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
            
                $row = 15;
            foreach ($speakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 41;
            foreach ($smpeakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakdr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 78;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }


                

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                echo 'exported';
        
        }else if(($this->checkPostingSummary($labref,$head)==1 && ($component_no == '3'))){
            
             //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C53', 'Assay Standards repeat - ' . $head)
                        ->setCellValue('E104', 'Sample Assay repeat - ' . $head)
                        ->setCellValue('D61', $assayDesired)
                        ->setCellValue('D59', $stdA)
                        ->setCellValue('D60', $stdB)
                        ->setCellValue('D62', $dconcetration)
                        ->setCellValue('F114', $samplDesiredpw)
                        ->setCellValue('F115', $samplDesiredap)
                        ->setCellValue('F106', $sastandarda)
                        ->setCellValue('F107', $sastandardb)
                        ->setCellValue('F108', $sastandardc)
                        ->setCellValue('F110', $apstandarda)
                        ->setCellValue('F111', $apstandardb)
                        ->setCellValue('F112', $apstandardc)
                        ->setCellValue('J10', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B81', $head)
                        ->setCellValue('B82', $tab1)
                        ->setCellValue('B83', $tab2)
                        ->setCellValue('B84', $tab3)
                        ->setCellValue('B85', $tab4)
                        ->setCellValue('B86', $tab5)
                        ->setCellValue('B87', $tab6)

                        //Other Dssolution Data   
                        ->setCellValue('B119', $head)
                        ->setCellValue('C121', $desiredweight)
                        ->setCellValue('C122', $disstda)
                        ->setCellValue('C123', $disstdb)
                        ->setCellValue('C124', $concetration)
                        ->setCellValue('C125', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
                
                $row = 24;
            foreach ($speakr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeakr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 120;
            foreach ($speakdr as $labels):
                $col = 14;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 88;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }



                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            echo 'yes'.$head. 'Exported';
            
        }else if(($this->checkPostingSummary($labref,$head)==1 && ($component_no == '4'))){
            
             //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C63', 'Assay Standards repeat- ' . $head)
                        ->setCellValue('E116', 'Sample Assay repeat- ' . $head)
                        ->setCellValue('D66', $assayDesired)
                        ->setCellValue('D64', $stdA)
                        ->setCellValue('D65', $stdB)
                        ->setCellValue('D67', $dconcetration)
                        ->setCellValue('F126', $samplDesiredpw)
                        ->setCellValue('F127', $samplDesiredap)
                        ->setCellValue('F118', $sastandarda)
                        ->setCellValue('F119', $sastandardb)
                        ->setCellValue('F120', $sastandardc)
                        ->setCellValue('F122', $apstandarda)
                        ->setCellValue('F123', $apstandardb)
                        ->setCellValue('F124', $apstandardc)
                        ->setCellValue('J10', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B89', $head)
                        ->setCellValue('B91', $tab1)
                        ->setCellValue('B92', $tab2)
                        ->setCellValue('B93', $tab3)
                        ->setCellValue('B94', $tab4)
                        ->setCellValue('B95', $tab5)
                        ->setCellValue('B96', $tab6)

                        //Other Dssolution Data 
                        ->setCellValue('B126', $head)
                        ->setCellValue('C128', $desiredweight)
                        ->setCellValue('C129', $disstda)
                        ->setCellValue('C130', $disstdb)
                        ->setCellValue('C131', $concetration)
                        ->setCellValue('C132', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
                
                $row = 24;
            foreach ($speakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeakr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 128;
            foreach ($speakdr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 98;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }



                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            
            echo 'yes Exported'.$head;
        }else if(($this->checkPostingSummary($labref ,$head)==1 && ($component_no == '5'))){
            
            //standard Assay
                $assayDesired = $this->input->post('assayDesired');
                $stdA = $this->input->post('standardA');
                $stdB = $this->input->post('standardB');
                $dconcetration = $this->input->post('dconcetration');

                //sample preparation, powder Weight
                $samplDesiredpw = $this->input->post('sampleDesiredpw');
                $sastandarda = $this->input->post('sastandarda');
                $sastandardb = $this->input->post('sastandardb');
                $sastandardc = $this->input->post('sastandardc');

                //sample API weight
                $samplDesiredap = $this->input->post('sampleDesiredap');
                $apstandarda = $this->input->post('apstandarda');
                $apstandardb = $this->input->post('apstandardb');
                $apstandardc = $this->input->post('apstandardc');
                $sampleconcetration = $this->input->post('sampleconcetration');


                $tab1 = $this->input->post('tab1');
                $tab2 = $this->input->post('tab2');
                $tab3 = $this->input->post('tab3');
                $tab4 = $this->input->post('tab4');
                $tab5 = $this->input->post('tab5');
                $tab6 = $this->input->post('tab6');

                //Dissolution Other Tests
                $desiredweight = $this->input->post('desiredweight');
                $disstda = $this->input->post('disstda');
                $disstdb = $this->input->post('disstdb');
                $concetration = $this->input->post('concetration');
                $tabaverage = $this->input->post('tabaverage');


                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('C68', 'Assay Standards repeat - ' . $head)
                        ->setCellValue('E128', 'Sample Assay repeat- ' . $head)
                        ->setCellValue('D71', $assayDesired)
                        ->setCellValue('D69', $stdA)
                        ->setCellValue('D70', $stdB)
                        ->setCellValue('D72', $dconcetration)
                        ->setCellValue('F138', $samplDesiredpw)
                        ->setCellValue('F139', $samplDesiredap)
                        ->setCellValue('F130', $sastandarda)
                        ->setCellValue('F131', $sastandardb)
                        ->setCellValue('F132', $sastandardc)
                        ->setCellValue('F134', $apstandarda)
                        ->setCellValue('F135', $apstandardb)
                        ->setCellValue('F136', $apstandardc)
                        ->setCellValue('J10', $sampleconcetration)

                        //Dissolution
                        ->setCellValue('B55', $head)
                        ->setCellValue('B98', $tab1)
                        ->setCellValue('B99', $tab2)
                        ->setCellValue('B90', $tab3)
                        ->setCellValue('B91', $tab4)
                        ->setCellValue('B92', $tab5)
                        ->setCellValue('B93', $tab6)

                        //Other Dssolution Data
                        ->setCellValue('B133', $head)
                        ->setCellValue('C135', $desiredweight)
                        ->setCellValue('C136', $disstda)
                        ->setCellValue('C137', $disstdb)
                        ->setCellValue('C138', $concetration)
                        ->setCellValue('C139', $tabaverage);
                
                $speakr = $this->input->post('speak');
            $smpeakr = $this->input->post('smpeak');
            $speakdr = $this->input->post('speakd');
            
            $area_1r = $this->input->post('area1');
            $area_2r = $this->input->post('area2');
            $area_3r = $this->input->post('area3');
            $area_4r = $this->input->post('area4');
            $area_5r = $this->input->post('area5');
            
                     $worksheet = $objPHPExcel->getActiveSheet();    
                
                $row = 32;
            foreach ($speakr as $labels):
                $col = 8;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $labels);
                $row++;
            endforeach;

            $row2 = 53;
            foreach ($smpeakr as $labels):
                $col = 14;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row2 = 128;
            foreach ($speakdr as $labels):
                $col = 11;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row2, $labels);
                $row2++;
            endforeach;

            $row = 108;
            for ($i = 0; $i < count($area_1r); $i++) {
                $col = 12;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $row, $area_1r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_2r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_3r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_4r[$i])
                        ->setCellValueByColumnAndRow($col++, $row, $area_5r[$i]);
                $row++;
            }



                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            
            echo 'yes Exported'.$head;
        }else{
            echo 'Error';
            $this->getDataToExcel();
        }
       }
       function saveWorkbook(){
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                  
        $this->insertData($labref);   
       }
    
    
    function post_repests($labref,$component_no,$component){
        $this->db->insert('summary_post',array(
            'labref'=>$labref,
            'component'=>$component,
            'component_no'=>$component_no,
            'post_status'=>'1'
        ));
        
    }

    function findComponents($labref) {
        return $this->db
                        ->select('*')
                        ->where('request_id', $labref)
                        ->get('components')
                        ->result();
    }

    function checkPostingSummary($labref,$head) {
       $query=$this->db
                        ->where('labref', $labref)
                         ->where('component', $head)
                        //->where('component_no',$component_no)
                        ->get('summary_post')
                        ->num_rows();
       if($query == true){
           return 1;
       }else{
           return 0;
       }
    }

    function insertData($labref) {
        $array = array(
            'labref' => $labref,
            'component' => 'sample_summary',
            'component_no' => 0,
            'test_name' => 'sample_summary',
            'posting_count' => 1,
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $array);
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

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->do_count;
    }

}
