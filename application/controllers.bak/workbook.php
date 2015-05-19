<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class workbook extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    
    function saveToExcel($labref){
        $worksheetindex=0;
       $objReader = PHPExcel_IOFactory::createReader('Excel2007');
       $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
           $dir = "workbooks";

            if (is_dir($dir)) {

                /*$objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('NQCL');
                $objDrawing->setDescription('The Image that I am inserting');
                $objDrawing->setPath('exclusive_image/nqcl.png');
                $objDrawing->setCoordinates('A1');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");


                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
    }
    
    function assayToExcel(){
         
            $labref=  $this->uri->segment(3);
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
        $tabs_caps_average=  $this->input->post('tabs_caps_average');
        $labelclaim = $this->input->post('labelclaim');
        $procedure = $this->input->post('procedure'); 
    }
    function tabsToExcel(){
        
    }
    function dissolutionToExcel(){
        
    }
      function identificationToExcel(){
        
    }
}
?>
