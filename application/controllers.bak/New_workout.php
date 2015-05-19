<?php

//require_once APPPATH.'core/MY_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class New_workout extends Wkstest {

    function __construct() {
        parent::__construct();
    }

    //======================================-- ASSAY EXPO TEST=========================================================//
    public function exportAssayToExcel_t($labref, $id) {
        $sampleinfo = $this->loadSampleInfo($labref);
        $standardsinfo = $this->loadStandardsData($labref, $id);

        $repeat_stat = $this->checkAssayPostingStatus($labref);

        $heading = $this->input->post('heading');


        if ($repeat_stat != '0') {

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName('Template');
            $worksheet = $objPHPExcel->getActiveSheet()


                    //Assay Standard Preparation desired  
                    // ->setCellValue('B36', $this->input->post('workingweight'))
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
                    ->setCellValue('B58', $this->input->post('aiweight'))
                    ->setCellValue('B59', $this->input->post('svf1'))
                    ->setCellValue('B60', $this->input->post('sp1'))
                    ->setCellValue('B61', $this->input->post('svf2'))
                    ->setCellValue('B62', $this->input->post('pipette2'))
                    ->setCellValue('B63', $this->input->post('vf3'))
                    ->setCellValue('B64', $this->input->post('pipette3'))
                    ->setCellValue('D65', $this->input->post('vf41'))
                    // ->setCellValue('D66', $this->input->post('smgml'))
                    //->setCellValue('A35', 'Sample A')
                    ->setCellValue('D59', $this->input->post('sampleA'))
                    ->setCellValue('D63', $this->input->post('sampleB'))
                    ->setCellValue('D67', $this->input->post('sampleC'))
                    ->setCellValue('B55', $this->input->post('labelclaim'))
                    ->setCellValue('C55', $this->input->post('heading'))
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

            $si = 59;
            for ($i = 0; $i < 3; $i++) {
                $col = 5;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $si, $smpeak[$i]);
                $si++;
            }

            $s2 = 63;
            for ($i = 3; $i < 6; $i++) {
                $col = 5;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $s2, $smpeak[$i]);
                $s2++;
            }
            $s3 = 67;
            for ($i = 6; $i < 9; $i++) {
                $col = 5;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $s3, $smpeak[$i]);
                $s3++;
            }



            $objPHPExcel->getActiveSheet()->setTitle('Template');


            $dir = "workbooks";

            if (is_dir($dir)) {

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
              
                echo 'Data exported';
                //  exit();
            } else {
                echo 'Dir does not exist';
            }
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndexbyName('Template');
            $worksheet = $objPHPExcel->getActiveSheet()


                    //Assay Standard Preparation desired  
                    // ->setCellValue('B36', $this->input->post('workingweight'))
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
                    ->setCellValue('B58', $this->input->post('aiweight'))
                    ->setCellValue('B59', $this->input->post('svf1'))
                    ->setCellValue('B60', $this->input->post('sp1'))
                    ->setCellValue('B61', $this->input->post('svf2'))
                    ->setCellValue('B62', $this->input->post('pipette2'))
                    ->setCellValue('B63', $this->input->post('vf3'))
                    ->setCellValue('B64', $this->input->post('pipette3'))
                    ->setCellValue('D65', $this->input->post('vf41'))
                    // ->setCellValue('D66', $this->input->post('smgml'))
                    //->setCellValue('A35', 'Sample A')
                    ->setCellValue('D59', $this->input->post('sampleA'))
                    ->setCellValue('D63', $this->input->post('sampleB'))
                    ->setCellValue('D67', $this->input->post('sampleC'))
                    ->setCellValue('B55', $this->input->post('labelclaim'))
                    ->setCellValue('C55', $this->input->post('heading'))
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

            $si = 59;
            for ($i = 0; $i < 3; $i++) {
                $col = 5;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $si, $smpeak[$i]);
                $si++;
            }

            $s2 = 63;
            for ($i = 3; $i < 6; $i++) {
                $col = 5;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $s2, $smpeak[$i]);
                $s2++;
            }
            $s3 = 67;
            for ($i = 6; $i < 9; $i++) {
                $col = 5;
                $worksheet
                        ->setCellValueByColumnAndRow($col++, $s3, $smpeak[$i]);
                $s3++;
            }



            $objPHPExcel->getActiveSheet()->setTitle('Template');


            $dir = "workbooks";

            if (is_dir($dir)) {

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePosting($labref);
                echo 'Data exported';
                //  exit();
            } else {
                echo 'Dir does not exist';
            }
        }
    }

}
