<?php

class Wkstest_1 extends CI_Controller {

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

    //=================================DISINTEGRATION==========================================

    public function disintegration() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkPostingStatusDisintegration($labref);

        $dis_medium = $this->input->post('dismedium');
        $duration = $this->input->post('dist');
        $results_observed = $this->input->post('disro');
        $comments = $this->input->post('disco');
        $fineness_of_dispersion = $this->input->post('disfod');

        $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $outputFile = "Workbooks/" . $labref . "/" . $labref . ".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);

        $objPHPExcel->createSheet();
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $objPHPExcel->getActiveSheet()
                    ->setCellValue('B8', 'Dissolution Medium')
                    ->setCellValue('C8', $dis_medium)
                    ->setCellValue('B9', 'Duration')
                    ->setCellValue('C9', $duration)
                    ->setCellValue('B11', 'Results Observed')
                    ->setCellValue('C11', $results_observed)
                    ->setCellValue('B12', 'comments')
                    ->setCellValue('C12', $comments)
                    ->setCellValue('B13', 'Fineness of Dispersion')
                    ->setCellValue('C13', $fineness_of_dispersion)
                    ->setCellValue('C15', 'Worksheet No')
                    ->setCellValue('D15', $labref);
//             ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref); 

            $objPHPExcel->getActiveSheet()->setTitle('disintegration');
            $dir = "workbooks";
            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePostingDis($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        
    }

    function upDatePostingDis($labref) {
        //$heading = $this->input->post('heading');
        $new_value = $this->checkPostingStatusDisintegration($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'disintegration');
        $this->db->update('posting_status', $details);
    }

    function checkPostingStatusDisintegration($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'disintegration')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    //========================================END====================================//
    //=================================FRIABILITY==========================================

    public function friability() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkPostingStatusFriability($labref);

        $tw_before_test = $this->input->post('fbtest');
        $tw_after_test = $this->input->post('fbatest');
        $loss = $this->input->post('fbloss');
        $percentage_loss = $this->input->post('fbploss');
        $comments = $this->input->post('comments');

        //  if ($repeat_stat != '0') {


        $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $outputFile = "Workbooks/" . $labref . "/" . $labref . ".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);

        $objPHPExcel->createSheet();
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $objPHPExcel->getActiveSheet()
                ->setCellValue('B8', 'Weight of 20 Tablets/Capsules')
          ->setCellValue('C8', 'Run')
          ->setCellValue('B10', 'Weight before Test(g)')
          ->setCellValue('C10', $tw_before_test)
          ->setCellValue('B11', 'Weight after Test(g)')
          ->setCellValue('C11', $tw_after_test)
          ->setCellValue('B12', 'Loss')
          ->setCellValue('C12', $loss)
          ->setCellValue('B13', 'Percentage Loss')
          ->setCellValue('C13', $percentage_loss)
          ->setCellValue('B14', 'comments')
          ->setCellValue('C14', $comments)
          ->setCellValue('C16', 'Worksheet No')
          ->setCellValue('D16', $labref);



        $objPHPExcel->getActiveSheet()->setTitle('Friability');


        $dir = "workbooks";

        if (is_dir($dir)) {
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
            $objWriter->save($outputFile);


            echo 'Data exported';
        } else {
            echo 'Dir does not exist';
        }
        /* }else {

          $data = $this->getLastWorksheet();
          echo $worksheetIndex = $data[0]->no_of_sheets;

          $objReader = PHPExcel_IOFactory::createReader('Excel2007');
          $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

          $objPHPExcel->createSheet();
          $objPHPExcel->setActiveSheetIndex($worksheetIndex);
          $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
          $objPHPExcel->getActiveSheet()
          ->setCellValue('B8', 'Weight of 20 Tablets/Capsules')
          ->setCellValue('C8', 'Run')
          ->setCellValue('B10', 'Weight before Test(g)')
          ->setCellValue('C10', $tw_before_test)
          ->setCellValue('B11', 'Weight after Test(g)')
          ->setCellValue('C11', $tw_after_test)
          ->setCellValue('B12', 'Loss')
          ->setCellValue('C12', $loss)
          ->setCellValue('B13', 'Percentage Loss')
          ->setCellValue('C13', $percentage_loss)
          ->setCellValue('B14', 'comments')
          ->setCellValue('C14', $comments)
          ->setCellValue('C16', 'Worksheet No')
          ->setCellValue('D16', $labref);

          $objPHPExcel->getActiveSheet()->setTitle('friability');
          $dir = "workbooks";
          if (is_dir($dir)) {
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
          $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
          $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
          $this->updateWorksheetNo();
          $this->upDatePostingFri($labref);
          echo 'Data exported';
          } else {
          echo 'Dir does not exist';
          }
          } */
    }

    function upDatePostingFri($labref) {
        //$heading = $this->input->post('heading');
        $new_value = $this->checkPostingStatusFriability($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'friability');
        $this->db->update('posting_status', $details);
    }

    function checkPostingStatusFriability($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'friability')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    //========================================END====================================//
    //=================================pH==========================================

    public function Refractive_index() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkPostingStatusRI($labref);

        $comments = $this->input->post('comments');
        $ph1 = $this->input->post('ph1_r');
        $ph2 = $this->input->post('ph2_r');
        $ph3 = $this->input->post('ph3_r');
        $ph4 = $this->input->post('ph4_r');
        $mean = $this->input->post('phmean_r');
        $ph = $this->input->post('sampleph_r');
        // $this->output->enable_profiler();

       $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $outputFile = "Workbooks/" . $labref . "/" . $labref . ".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);

        $objPHPExcel->createSheet();
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $objPHPExcel->getActiveSheet()
                    ->setCellValue('B21', 'Procedure')
                    ->setCellValue('C21', $comments)
                    ->setCellValue('B23', 'Determination of Refractive Index')
                    ->setCellValue('B25', 'No')
                    ->setCellValue('C25', 'Sample Reading')
                    ->setCellValue('B26', '1')
                    ->setCellValue('C26', $ph1)
                    ->setCellValue('B27', '2')
                    ->setCellValue('C27', $ph2)
                    ->setCellValue('B28', '3')
                    ->setCellValue('C28', $ph3)
                    ->setCellValue('B29', '4')
                    ->setCellValue('C29', $ph4)
                    ->setCellValue('B30', 'Mean')
                    ->setCellValue('C30', $mean)
                    ->setCellValue('B31', 'Refraction Index of the Sample  ')
                    ->setCellValue('C31', $ph)
                    ->setCellValue('C32', 'Worksheet No')
                    ->setCellValue('D32', $labref);



            $objPHPExcel->getActiveSheet()->setTitle('Refractive Index');


            $dir = "workbooks";

            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save($outputFile);
                                $this->upDatePostingRI($labref);


                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
       /* } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B6', 'Procedure')
                    ->setCellValue('C6', $comments)
                    ->setCellValue('B8', 'Determination of Refractive Index')
                    ->setCellValue('B10', 'No')
                    ->setCellValue('C10', 'Sample Reading')
                    ->setCellValue('B12', '1')
                    ->setCellValue('C12', $ph1)
                    ->setCellValue('B13', '2')
                    ->setCellValue('C13', $ph2)
                    ->setCellValue('B14', '3')
                    ->setCellValue('C14', $ph3)
                    ->setCellValue('B15', '4')
                    ->setCellValue('C15', $ph4)
                    ->setCellValue('B16', 'Mean')
                    ->setCellValue('C16', $mean)
                    ->setCellValue('B17', 'Refraction Index of the Sample')
                    ->setCellValue('C17', $ph)
                    ->setCellValue('C19', 'Worksheet No')
                    ->setCellValue('D19', $labref);

            $objPHPExcel->getActiveSheet()->setTitle('Refractive Index');
            $dir = "workbooks";
            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePostingRI($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }*/
    }

    function upDatePostingRI($labref) {
        //$heading = $this->input->post('heading');
        $new_value = $this->checkPostingStatusRI($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'Refractivity');
        $this->db->update('posting_status', $details);
    }

    function checkPostingStatusRI($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'Refractivity')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    //========================================END====================================//
    //=================================pH==========================================

    public function pH() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkPostingStatuspH($labref);

        $comments = $this->input->post('comments');
        $ph1 = $this->input->post('ph1');
        $ph2 = $this->input->post('ph2');
        $ph3 = $this->input->post('ph3');
        $ph4 = $this->input->post('ph4');
        $mean = $this->input->post('phmean');
        $ph = $this->input->post('sampleph');
        // $this->output->enable_profiler();

   $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $outputFile = "Workbooks/" . $labref . "/" . $labref . ".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);

        $objPHPExcel->createSheet();
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $objPHPExcel->getActiveSheet()
                     ->setCellValue('C6', $comments)
                    ->setCellValue('B8', 'Determination of pH')
                    ->setCellValue('B10', 'No')
                    ->setCellValue('C10', 'Run')
                    ->setCellValue('B12', '1')
                    ->setCellValue('C12', $ph1)
                    ->setCellValue('B13', '2')
                    ->setCellValue('C13', $ph2)
                    ->setCellValue('B14', '3')
                    ->setCellValue('C14', $ph3)
                    ->setCellValue('B15', '4')
                    ->setCellValue('C15', $ph4)
                    ->setCellValue('B16', 'Mean')
                    ->setCellValue('C16', $mean)
                    ->setCellValue('B17', 'pH of Sample')
                    ->setCellValue('C17', $ph)
                    ->setCellValue('C19', 'Worksheet No')
                    ->setCellValue('D19', $labref);



            $objPHPExcel->getActiveSheet()->setTitle('pH');


            $dir = "workbooks";

            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save($outputFile);
                 $this->upDatePostingpH($labref);

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
     /*   } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B6', 'Procedure')
                    ->setCellValue('C6', $comments)
                    ->setCellValue('B8', 'Determination of pH')
                    ->setCellValue('B10', 'No')
                    ->setCellValue('C10', 'Run')
                    ->setCellValue('B12', '1')
                    ->setCellValue('C12', $ph1)
                    ->setCellValue('B13', '2')
                    ->setCellValue('C13', $ph2)
                    ->setCellValue('B14', '3')
                    ->setCellValue('C14', $ph3)
                    ->setCellValue('B15', '4')
                    ->setCellValue('C15', $ph4)
                    ->setCellValue('B16', 'Mean')
                    ->setCellValue('C16', $mean)
                    ->setCellValue('B17', 'pH of Sample')
                    ->setCellValue('C17', $ph)
                    ->setCellValue('C19', 'Worksheet No')
                    ->setCellValue('D19', $labref);

            $objPHPExcel->getActiveSheet()->setTitle('pH');
            $dir = "workbooks";
            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePostingpH($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }*/
    }

    function upDatePostingpH($labref) {
        //$heading = $this->input->post('heading');
        $new_value = $this->checkPostingStatuspH($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'pH');
        $this->db->update('posting_status', $details);
    }

    function checkPostingStatuspH($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'pH')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    //========================================END====================================//



    public function Rd() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkPostingStatusRd($labref);

        $pyknometer_mass = $this->input->post('pykmass');

        $pyknometer_water = $this->input->post('pykwater');
        $pyknometer_water2 = $this->input->post('pykwater2');
        $pyknometer_water3 = $this->input->post('pykwater3');
        $pyknometer_water4 = $this->input->post('pykwater4');

        $pyknometer_sample = $this->input->post('pyksample');
        $pyknometer_sample2 = $this->input->post('pyksample2');
        $pyknometer_sample3 = $this->input->post('pyksample3');
        $pyknometer_sample4 = $this->input->post('pyksample4');

        $meanofwater = $this->input->post('meanofwater');
        $meanofsample = $this->input->post('meanofsample');
        $massofwater = $this->input->post('maw');
        $massofsample = $this->input->post('mos');
        $relative_density = $this->input->post('srd');

         $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $outputFile = "Workbooks/" . $labref . "/" . $labref . ".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);

        $objPHPExcel->createSheet();
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $objPHPExcel->getActiveSheet()
               ->setCellValue('B4', 'Pyknometer Mass(g)')
                    ->setCellValue('C4', 'Pyknometer + Water(g)')
                    ->setCellValue('D4', 'Pyknometer + Sample(g)')
                    ->setCellValue('B6', $pyknometer_mass)
                    ->setCellValue('C6', $pyknometer_water)
                    ->setCellValue('D6', $pyknometer_sample)
                    ->setCellValue('C7', $pyknometer_water2)
                    ->setCellValue('D7', $pyknometer_sample2)
                    ->setCellValue('C8', $pyknometer_water3)
                    ->setCellValue('D8', $pyknometer_sample3)
                    ->setCellValue('C9', $pyknometer_water4)
                    ->setCellValue('D9', $pyknometer_sample4)
                    ->setCellValue('B10', 'MEAN')
                    ->setCellValue('C10', $meanofwater)
                    ->setCellValue('D10', $meanofsample)
                    ->setCellValue('C12', 'Mass of Water(g)')
                    ->setCellValue('C13', 'Mass of Sample(g)')
                    ->setCellValue('C14', 'Sample Relative Density')
                    ->setCellValue('D12', $massofwater)
                    ->setCellValue('D13', $massofsample)
                    ->setCellValue('D14', $relative_density)
                    ->setCellValue('C16', 'Worksheet No')
                    ->setCellValue('D16', $labref);

            $objPHPExcel->getActiveSheet()->setTitle('Relative Density');


            $dir = "workbooks";

            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save($outputFile);


                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
       /* } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B4', 'Pyknometer Mass(g)')
                    ->setCellValue('C4', 'Pyknometer + Water(g)')
                    ->setCellValue('D4', 'Pyknometer + Sample(g)')
                    ->setCellValue('B6', $pyknometer_mass)
                    ->setCellValue('C6', $pyknometer_water)
                    ->setCellValue('D6', $pyknometer_sample)
                    ->setCellValue('C7', $pyknometer_water2)
                    ->setCellValue('D7', $pyknometer_sample2)
                    ->setCellValue('C8', $pyknometer_water3)
                    ->setCellValue('D8', $pyknometer_sample3)
                    ->setCellValue('C9', $pyknometer_water4)
                    ->setCellValue('D9', $pyknometer_sample4)
                    ->setCellValue('B10', 'MEAN')
                    ->setCellValue('C10', $meanofwater)
                    ->setCellValue('D10', $meanofsample)
                    ->setCellValue('C12', 'Mass of Water(g)')
                    ->setCellValue('C13', 'Mass of Sample(g)')
                    ->setCellValue('C14', 'Sample Relative Density')
                    ->setCellValue('D12', $massofwater)
                    ->setCellValue('D13', $massofsample)
                    ->setCellValue('D14', $relative_density)
                    ->setCellValue('C16', 'Worksheet No')
                    ->setCellValue('D16', $labref);

            $objPHPExcel->getActiveSheet()->setTitle('Relative Density');
            $dir = "workbooks";
            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();
                $this->upDatePostingRd($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }*/
    }

    function upDatePostingRd($labref) {
        //$heading = $this->input->post('heading');
        $new_value = $this->checkPostingStatusRd($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'relative_density');
        $this->db->update('posting_status', $details);
    }

    function checkPostingStatusRd($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'relative_density')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    //========================================END====================================//


    public function Melting_point() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkPostingStatusMp($labref);



        $start1 = $this->input->post('smp1');
        $end1 = $this->input->post('sen1');
        $finish1 = $this->input->post('sfr1');

        $start2 = $this->input->post('smp2');
        $end2 = $this->input->post('sen2');
        $finish2 = $this->input->post('sfr2');

        $start3 = $this->input->post('smp3');
        $end3 = $this->input->post('sen3');
        $finish3 = $this->input->post('sfr3');

        $start4 = $this->input->post('smp4');
        $end4 = $this->input->post('sen4');
        $finish4 = $this->input->post('sfr4');

        $melting_point = $this->input->post('sm_p');

       $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $outputFile = "Workbooks/" . $labref . "/" . $labref . ".xlsx";

        $objPHPExcel = PHPExcel_IOFactory::load($file2);

        $objPHPExcel->createSheet();
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $objPHPExcel->getActiveSheet();
            $objPHPExcel->getActiveSheet()->mergeCells('B5:C6');
            $objPHPExcel->getActiveSheet()->mergeCells('D5:E5');
            $objPHPExcel->getActiveSheet()->mergeCells('B7:B9');
            $objPHPExcel->getActiveSheet()->mergeCells('B10:C10');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B5', 'Samples')
                    ->setCellValue('D5', 'Range')
                    ->setCellValue('F5', 'Final Reading')
                    ->setCellValue('D6', 'Start')
                    ->setCellValue('E6', 'End')
                    ->setCellValue('B7', 'Calibrate')
                    ->setCellValue('C7', 'Vanillin Melting Point Standard')
                    ->setCellValue('C8', 'Phenacetin Melting Point Standard')
                    ->setCellValue('C9', 'Caffeine Melting Point Standard')
                    ->setCellValue('B10', 'Sample')
                    ->setCellValue('C12', 'Melting Point of Sample :')
                    ->setCellValue('D7', $start1)
                    ->setCellValue('E7', $end1)
                    ->setCellValue('F7', $finish1)
                    ->setCellValue('D8', $start2)
                    ->setCellValue('E8', $end2)
                    ->setCellValue('F8', $finish2)
                    ->setCellValue('D9', $start3)
                    ->setCellValue('E9', $end3)
                    ->setCellValue('F9', $finish3)
                    ->setCellValue('D10', $start4)
                    ->setCellValue('E10', $end4)
                    ->setCellValue('F10', $finish4)
                    ->setCellValue('E12', $melting_point)
                    ->setCellValue('C14', 'Worksheet No')
                    ->setCellValue('D14', $labref);

            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle('B5:F10')->applyFromArray($styleArray);

            $objPHPExcel->getActiveSheet()->setTitle('Melting Point');
            $dir = "workbooks";
            if (is_dir($dir)) {
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objWriter->save($outputFile);
                $this->updateWorksheetNo();
                $this->upDatePostingMp($labref);
                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        
    }

    function upDatePostingMp($labref) {
        //$heading = $this->input->post('heading');
        $new_value = $this->checkPostingStatusMp($labref) + 1;
        $details = array(
            'posting_count' => $new_value
        );
        $this->db->where('labref', $labref);
        $this->db->where('component', 'melting_point');
        $this->db->update('posting_status', $details);
    }

    function checkPostingStatusMp($labref) {
        $query = $this->db
                ->select('posting_count')
                ->where('labref', $labref)
                ->where('component', 'melting_point')
                ->get('posting_status ');
        $result = $query->result();
        return $result[0]->posting_count;
    }

    //========================================END====================================//



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

}
