<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Labwork extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Excel');
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

    
    
}

