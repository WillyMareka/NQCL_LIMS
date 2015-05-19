<?php

class Assay extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }
    
    function copy(){
        $this->copyWorkbook();
    }

    public function assay_page() {

        $labref = $this->uri->segment(3);
        $r1 = $this->getComponentNo($labref);
       $r = $r1[0]->component_no;
       redirect('assay/assay_worksheet/' . $labref . '/' . $r);
       /*$redirect = $this->uniformityExists($labref);
        $uniformity_done = $this->checkUniformityStatus($labref);
        if ($redirect == 1 && $uniformity_done == 1) {
            redirect('assay/assay_worksheet/' . $labref . '/' . $r);
        } elseif ($redirect == 1 && $uniformity_done != 1) {
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = "uniformity_error_v";
            $data['error'] = $this->getError();
            $this->base_params($data);
        } else if ($redirect != 1 && $uniformity_done != 1) {
            redirect('assay/assay_worksheet/' . $labref . '/' . $r);
        }*/
    }

    function refsubs($substance){
        $this->findRefSub($substance);
    }
            function getDoStatus() {
        $labref = $this->uri->segment(3);
        $component = $this->input->post('heading');
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $component);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('multiple_assay_desiredw')->result();
        return $result = $query[0]->repeat_status;
    }

    function loadComponents($labref) {
        echo json_encode($this->db
                        ->where('request_id', $labref)                        
                        ->get('components')
                        ->result()
        );
    }
     function loadComponents_lc($labref, $component) {
        echo json_encode($this->db
                        ->where('request_id', $labref)
                        ->where('name',$component)                       
                        ->get('components')
                        ->result()
        );
    }
        function postRepeatReason(){
     
       $labref=  $this->uri->segment(3);      
       $reason=  $this->input->post('why');
         $component = $this->input->post('heading');
       $array=array(
          'labref'=>$labref,
           'test'=>'Assay: Component '.$component,
           'reason'=>$reason
       );
       $this->db->insert('repeat_reason',$array);
      echo 'success';
    }
    
    function check_done($labref,$component){
        $query= $this->db->where('labref',$labref)->where('component',$component)->get('multiple_assaystdab');
        if($query->num_rows()> 0){
           echo json_encode(array('done_state'=>1));
        }else{
          echo json_encode(array('done_state'=>0));
        }
    }
    
 
    

    function loadRepeatComponents($labref) {
        echo json_encode($this->db->select('name')
                        ->where('request_id', $labref)
                        ->where('status', 1)
                        ->get('components')
                        ->result()
        );
    }

    function upDate($labref) {
        $this->db->where('request_id', $labref)
                ->where('name', $this->input->post('heading'))
                ->update('components', array('status' => 1)
        );
    }

    public function assayPetition() {
        //error_reporting(1);
        $labref = $this->uri->segment(3);
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = "assay_v_1";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $data['unassay'] = $this->getUniformityAssay($labref);
        //$data['unassay'] = $this->getUniformityAssay($labref);
        $this->base_params($data);
    }
    
     public function titration() {
      
        $data['settings_view'] = "titration_v";
        
        $this->base_params($data);
    }

    public function assayMultiplePetition() {
        //error_reporting(1);
        $labref = $this->uri->segment(3);
        $data['r'] = $this->uri->segment(5);
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = "assay_multiple_v_1";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $data['unassay'] = $this->getUniformityAssay($labref);
        //$data['unassay'] = $this->getUniformityAssay($labref);
        $this->base_params($data);
    }
    
    
        function worksheet($labref){ 
        $worksheet_name = $this->uri->segment(1);
        $rawform=  $this->justBringDosageForm($labref);
        $dosageForm=$rawform[0]->dosage_form;
        if($worksheet_name == "assay" && $dosageForm=="2" || $dosageForm=="1" || $dosageForm=="6"|| $dosageForm=="5"|| $dosageForm=="16" || $dosageForm=="17"){
            $this->assay_worksheet();
         }else if($worksheet_name == "assay" && $dosageForm=="13" || $dosageForm=="7"  || $dosageForm=="8"  || $dosageForm=="10" || $dosageForm=="12"  ){
            $this->assay_i_worksheet();
        }else if($worksheet_name == "assay" && $dosageForm=="11" || $dosageForm=="15"){
           $this->assay_s_worksheet();
        }else if($worksheet_name == "assay" && $dosageForm=="4" ){
           $this->assay_t_worksheet();
        }else if($dosageForm=="9"){
           $this->assay_p_worksheet();
        }
        }
        
         function worksheet_c($labref){ 
        $worksheet_name = $this->uri->segment(1);
        $rawform=  $this->justBringDosageForm($labref);
        $dosageForm=$rawform[0]->dosage_form;
        if($worksheet_name == "assay" && $dosageForm=="2" || $dosageForm=="1" || $dosageForm=="6"|| $dosageForm=="5"|| $dosageForm=="16" || $dosageForm=="17"){
            $this->assay_worksheet_c();
         }else if($worksheet_name == "assay" && $dosageForm=="13" || $dosageForm=="7"  || $dosageForm=="8"  || $dosageForm=="10" || $dosageForm=="12"  ){
            $this->assay_i_worksheet_c();
        }else if($worksheet_name == "assay" && $dosageForm=="11" || $dosageForm=="15"){
           $this->assay_s_worksheet_c();
        }else if($worksheet_name == "assay" && $dosageForm=="4" || $dosageForm=="9"){
           $this->assay_t_worksheet_c();
        }
        }
    
    
    



    public function assay_worksheet() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "assay_multiple_v_custom";
       
        $data['unassay'] = $this->getUniformity($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }
    
       public function assay_p_worksheet() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "assay_multiple_v_pi";
       
        $data['unassay'] = $this->getUniformity($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }
    
      public function assay_worksheet_c() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "assay_multiple_v_2";
       
        $data['unassay'] = $this->getUniformity($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }
    
        public function assay_i_worksheet() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "assay_multiple_v_injection_1";
       
        $data['unassay'] = $this->getUniformityAssay($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }
    
          public function assay_i_worksheet_c() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "assay_multiple_v_injection_1";
       
        $data['unassay'] = $this->getUniformityAssay($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }
    
      public function assay_s_worksheet() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "assay_multiple_v_suspensions_1";
       
        $data['rd'] = $this->getUniformityAssay($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }
    
        public function assay_s_worksheet_c() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "assay_multiple_v_suspensions_1";
       
        $data['rd'] = $this->getUniformityAssay($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }
    
        public function assay_t_worksheet() {
       
        $labref = $this->uri->segment(3);
       
        $data['test_id']=$this->uri->segment(4);
        $data['repeat'] = 6;
        $data['labref'] = $this->uri->segment(3);
        $data['active'] = $this->getComponent($labref);
        $data['labreference']=  $this->loadlabref();
        //print_r($data['active'][0]->component);
        $data['settings_view'] = "titration_v";
       
       // $data['rd'] = $this->getUniformityAssay($labref);
        //$data['components'] = $this->loadComponents($labref);

        $this->base_params($data);
    }

    public function getWorksheet() {
        $res = mysql_query("SELECT MAX(id) AS lastId FROM worksheets");
        while ($row = mysql_fetch_assoc($res)) {
            $lastId = $row['lastId'];
        }
        return $lastId;
    }

    public function multiple() {
        //error_reporting(0);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['settings_view'] = "assay_multiple_v";
        $data['unassay'] = $this->getUniformityAssay($labref);
        $this->base_params($data);
    }

    function getComponent($labref) {
        $this->db->select('active_ing');
        $this->db->where('request_id', $labref);
        //$this->db->where('repeat_status',$r);
        //$this->db->where('component_no',$r);
        $query = $this->db->get('request');
        return $result = $query->result();
        //print_r($result);
    }

    function getComponentNo($labref) {
        $this->db->select_max('component_no');
        $this->db->where('labref', $labref);
        $query = $this->db->get('multiple_assay_desiredw');
        return $result = $query->result();
        // print_r($result);
    }

    public function testinput($labref, $component) {
        $max_component_row_id = $this->getTestAssayComponentNo($labref, $component);
        echo $max_component_row_id;
    }
    
    function checkforComponent($labref,$heading){
        return $this->db->where('labref',$labref)
                ->where('component',$heading)
                ->count_all_results('multiple_assay_desiredw');
    }
    
    
   

    public function save_assay_multiple($labref) {
    
            if ($_POST):
                $table_suffix = 'multiple_';
            $component1 = $this->input->post('heading');
                //$labref = $this->uri->segment(3);
                $sampleinfo = $this->loadSampleInfo($labref);
                $standardsinfo =  $this->loadStandardsData($labref, $component1);
                $analyst_id = $this->session->userdata('user_id');
                // $repeat_stat = $this->checkAssayPostingStatus($labref);
                $max_row_id = $this->getTestAssayRepeatStatusM($labref);
                (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;

                $posting_check = $this->checkforComponent($labref, $component1);
                
                $max_component_row_id = $this->getTestAssayComponentNo($labref, $component1);
                $new_status_component = $max_component_row_id;


                $priority = $this->findPriority($labref);
                $urgency = $priority[0]->urgency;

                $assaySTD = array(
                    'labref' => $labref,
                    'component' => $this->input->post('heading'),
                    'component_no' => $new_status_component,
                    'desired_weight' => $weight = $this->input->post('workingweight'),
                    'vf1' => $vf1 = $this->input->post('workingvf1'),
                    'pippette1' => $pipette1 = $this->input->post('workingpipette1'),
                    'vf2' => $vf2 = $this->input->post('workingvf2'),
                    'pipette2' => $concetration = $this->input->post('workingpipette2'),
                    'vf3' => $weight = $this->input->post('workingvf3'),
                    'pipette3' => $vf1 = $this->input->post('workingp3'),
                    'vf4' => $pipette1 = $this->input->post('workingvf4'),
                    'concetration' => $concetration = $this->input->post('workingmgml'),
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id,
                    'potency' => $this->input->post('potency'),
                    'priority' => $urgency
                );
              $this->db->insert($table_suffix . 'assay_desiredw', $assaySTD);

                $assayA = array(
                    'labref' => $labref,
                    'component' => $this->input->post('heading'),
                    'component_no' => $new_status_component,
                    'weight' => $weight = $this->input->post('u_weight'),
                    'vf1' => $vf1 = $this->input->post('vf1'),
                    'pippette1' => $pipette1 = $this->input->post('pipette1'),
                    'vf2' => $vf2 = $this->input->post('vf2'),
                    'pipette2' => $concetration = $this->input->post('p2'),
                    'vf3' => $this->input->post('vf31'),
                    'pipette3' => $vf1 = $this->input->post('p321'),
                    'vf4' => $pipette1 = $this->input->post('vf32'),
                    'concetration' => $concetration = $this->input->post('mgml'),
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id
                );
               $this->db->insert($table_suffix . 'assaystdab', $assayA);
                $assayB = array(
                    'labref' => $labref,
                    'component' => $this->input->post('heading'),
                    'component_no' => $new_status_component,
                    'weight' => $weight = $this->input->post('u_weight1'),
                    'vf1' => $vf1 = $this->input->post('vf11'),
                    'pippette1' => $pipette1 = $this->input->post('ppt'),
                    'vf2' => $vf2 = $this->input->post('vf22'),
                    'pipette2' => $concetration = $this->input->post('ppt1'),
                    'vf3' => $weight = $this->input->post('vf33'),
                    'pipette3' => $vf1 = $this->input->post('ppt2'),
                    'vf4' => $pipette1 = $this->input->post('vf34'),
                    'concetration' => $concetration = $this->input->post('mgml1'),
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id
                );
               $this->db->insert($table_suffix . 'assaystdab', $assayB);


                //saving the assay sampels
                //sample desired weight*/


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
                $svf3 = $this->input->post('svf3');


                $sp1 = $this->input->post('sp1');
                $sp11 = $this->input->post('sp11');
                $sp12 = $this->input->post('sp112');
                $ssp3 = $this->input->post('ssp3');

                $svf2 = $this->input->post('svf2');
                $svf12 = $this->input->post('svf12');
                $svf22 = $this->input->post('svf22');
                $svf33 = $this->input->post('svf33');


                $pipette2 = $this->input->post('pipette2');
                $spf1 = $this->input->post('spf1');
                $spf2 = $this->input->post('spf2');
                $spf3 = $this->input->post('spf3');


                $vf3 = $this->input->post('vf3');
                $svf13 = $this->input->post('svf13');
                $svf23 = $this->input->post('svf23');
                $svf24 = $this->input->post('svf24');


                $pipette3 = $this->input->post('pipette3');
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

                $labelclaim = $this->input->post('labelclaim');
                $procedure = $this->input->post('procedure');
                $component = $this->input->post('heading');

                $desired_abc_sample = array(
                    'labref' => $labref,
                    'powder_weight' => $this->input->post('pwnumber'),
                    'component' => $this->input->post('heading'),
                    'component_no' => $new_status_component,
                    'api_weight' => $this->input->post('aiweight'),
                    'vf1' => $this->input->post('svf1'),
                    'pipette1' => $this->input->post('sp1'),
                    'vf2' => $this->input->post('svf2'),
                    'pipette2' => $this->input->post('pipette2'),
                    'vf3' => $this->input->post('vf3'),
                    'pipette3' => $this->input->post('pipette3'),
                    'vf4' => $this->input->post('vf41'),
                    'concetration' => $this->input->post('smgml'),
                    'labelclaim' => $labelclaim,
                    'preparation_proc' => $procedure,
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id,
                    'uniformity_weight'=>  $this->input->post('tabs_caps_average'),
                    'date_time'=>date('d-m-Y H:i:s')
                );

                $this->db->insert($table_suffix . 'sample_assay_desiredw', $desired_abc_sample);



                //$this->setDoneStatus($labref);
                $array = array(
                    0 => array('labref' => $labref, 'powder_weight' => $pwnumber, 'component' => $component, 'component_no' => $new_status_component, 'api_weight' => $aiweight, 'vf1' => $svf1, 'pipette1' => $sp1, 'vf2' => $svf2, 'pipette2' => $pipette2, 'vf3' => $vf3, 'pipette3' => $pipette3, 'vf4' => $vf41, 'concetration' => $smgml, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
                    , 1 => array('labref' => $labref, 'powder_weight' => $sampleA, 'component' => $component, 'component_no' => $new_status_component, 'api_weight' => $u_weighta, 'vf1' => $svf11, 'pipette1' => $sp11, 'vf2' => $svf12, 'pipette2' => $spf1, 'vf3' => $svf13, 'pipette3' => $spf21, 'vf4' => $svf14, 'concetration' => $smgml1, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
                    , 2 => array('labref' => $labref, 'powder_weight' => $sampleB, 'component' => $component, 'component_no' => $new_status_component, 'api_weight' => $u_weightb, 'vf1' => $svf111, 'pipette1' => $sp12, 'vf2' => $svf22, 'pipette2' => $spf2, 'vf3' => $svf23, 'pipette3' => $spf33, 'vf4' => $svf241, 'concetration' => $smgml2, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
                    , 3 => array('labref' => $labref, 'powder_weight' => $sampleC, 'component' => $component, 'component_no' => $new_status_component, 'api_weight' => $u_weightc, 'vf1' => $svf3, 'pipette1' => $ssp3, 'vf2' => $svf33, 'pipette2' => $spf3, 'vf3' => $svf24, 'pipette3' => $spf4, 'vf4' => $svf25, 'concetration' => $smgml3, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
                );

                foreach ($array as $v) {
                    // $this->db->insert('multiple_sample_assay_abc',$v);
                    $sql = "INSERT INTO multiple_sample_assay_abc (labref,component,component_no,powder_weight,api_weight,vf1,pipette1,vf2,pipette2,vf3,pippette3,vf4,concetration,repeat_status,analyst_id)
    VALUES
    ('{$v['labref']}','{$v['component']}','{$v['component_no']}','{$v['powder_weight']}','{$v['api_weight']}','{$v['vf1']}','{$v['pipette1']}'
    ,'{$v['vf2']}','{$v['pipette2']}','{$v['vf3']}','{$v['pipette3']}'
    ,'{$v['vf4']}','{$v['concetration']}','{$v['repeat_status']}','{$v['analyst_id']}')";

                    //execute $sql here or it will overwrite on loop
                    $k = mysql_query($sql);
                }
              //  $data = $this->getLastWorksheet();
       // echo $worksheetIndex = $data[0]->no_of_sheets;
          if($posting_check == 1){
        $file1 = "original_workbook/Template.xlsx";
        $file2 = "Workbooks/".$labref."/".$labref.".xlsx";
       // $outputFile = "Workbooks/".$labref."/".$labref.".xlsx";

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
        // $objPHPExcel->setActiveSheetIndexbyName('Template');
         $worksheet=  $objPHPExcel->getActiveSheet()
        

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
                 
                 
                 //->setCellValue('B59', $this->input->post('aiweight'))
                    ->setCellValue('B59', $this->input->post('svf1'))
                    ->setCellValue('B60', $this->input->post('sp1'))
                    ->setCellValue('B61', $this->input->post('svf2'))
                    ->setCellValue('B62', $this->input->post('pipette2'))
                    ->setCellValue('B63', $this->input->post('vf3'))
                    ->setCellValue('B64', $this->input->post('pipette3'))
                    ->setCellValue('D65', $this->input->post('vf41'))
                   // ->setCellValue('D66', $this->input->post('smgml'))
                    //->setCellValue('A35', 'Sample A')
                    ->setCellValue('D60', $this->input->post('sampleA'))           
                   
                    ->setCellValue('D64', $this->input->post('sampleB'))
                    ->setCellValue('D68', $this->input->post('sampleC'))
                  ->setCellValue('B55', $this->input->post('labelclaim'))
                 ->setCellValue('B56', $this->input->post('labelclaim'))
                   ->setCellValue('C55', $this->input->post('heading'))
                   ->setCellValue('B31', $this->input->post('mwsalt'))
                   ->setCellValue('B32', $this->input->post('mwbase'))
         
                    ->setCellValue('B18', $sampleinfo[0]->product_name)
                    ->setCellValue('B19', $sampleinfo[0]->request_id)
                    ->setCellValue('B20', $sampleinfo[0]->active_ing)
                    ->setCellValue('B21', $sampleinfo[0]->label_claim)
                    ->setCellValue('B22', $sampleinfo[0]->updated_at)
         
                    ->setCellValue('B26', $standardsinfo[0]->name)
                    ->setCellValue('B27', $standardsinfo[0]->rs_code)
                    ->setCellValue('B28', $standardsinfo[0]->potency)
                    ->setCellValue('B29', $standardsinfo[0]->water_content);


            $speak=  $this->input->post('speak');
                   $smpeak=  $this->input->post('smpeak');
        
             //standard      
         $row = 38;
        for($i=0;$i<3;$i++){
            $col = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row, $speak[$i]);
            $row++;
        }
        
         $row2 = 38;
        for($i=3;$i<6;$i++){
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $speak[$i]);
            $row2++;
        }
        
        //sample
        
        $si = 60;
        for($i=0;$i<3;$i++){
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $si, $smpeak[$i]);
            $si++;
        }
        
         $s2 = 64;
        for($i=3;$i<6;$i++){
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $s2, $smpeak[$i]);
            $s2++;
        }
           $s3 = 68;
        for($i=6;$i<9;$i++){
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
      $objDrawing->setOffsetY(5);*/
$objPHPExcel->getActiveSheet()->setTitle('AD_'.$component1);
            $dir = "workbooks";

            if (is_dir($dir)) {           

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();
            //$this->upDatePosting($labref);
            echo 'Data exported';
          //  exit();
        } else {
            echo 'Dir does not exist';
            
        } 
                
            if ($k) {
                    $this->save_testM();
                    $this->updateTestIssuanceStatus();
                    $this->upDate($labref);
                    $this->post_posting();
                    $this->registerChemicalSubstanceUsed();
                    $labref=  $this->uri->segment(3);
                    $test_id=  $this->uri->segment(4);
                    $this->updateUploadStatus($labref, $test_id);
                   // $this->post_peaks($labref);
                    echo 'Saved';
                } else {
                    echo mysql_error();
                }
          }else{
                $this->copyWorkbook($labref, $component1);
                //exit();
                $this->save_testM();
                $this->updateTestIssuanceStatus();
                $this->upDate($labref);
                $this->post_posting();
                $this->registerChemicalSubstanceUsed();
                $labref = $this->uri->segment(3);
                $test_id = $this->uri->segment(4);
                $this->updateUploadStatus($labref, $test_id);
            }

                echo true;
            else:
                echo false;
            endif;
        
    }
    
    function post_peaks($labref){
        
 
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
        $worksheet=$objPHPExcel->getActiveSheet();
        $max_row_id = $this->getTestAssayRepeatStatusM($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status;
         $component=  $this->input->post('heading');
        $max_component_row_id = $this->getTestAssayComponentNo($labref, $component);
        $new_status_component = $max_component_row_id;
        $analyst_id = $this->session->userdata('user_id');
        $labref=  $this->uri->segment(3);       
        $speak=  $this->input->post('speak');
        $smpeak=  $this->input->post('smpeak');
        
       for($i=0; $i <count($speak); $i++){
           $data=array(
               'labref'=>$labref,
               'component'=>$component,
               'component_no'=>$new_status_component ,
               'peak_area'=>$speak[$i],
               'repeat_status'=>$new_status,
               'analyst_id'=>$analyst_id
           );
             $this->db->insert('peak_areas_stdab',$data);
       }
       
         $row = 38;
        foreach ($speak as $labels):
            $col = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row, $labels);
            $row++;
        endforeach;
       
        for($i=0; $i <count($smpeak); $i++){           
            $data2=array(
                'labref'=>$labref,
               'component'=>$component,
               'component_no'=>$new_status_component,
               'peak_area'=>$smpeak[$i],
               'repeat_status'=>$new_status,
               'analyst_id'=>$analyst_id
           );           
      
           $this->db->insert('peak_areas_sample',$data2);          
           
       }
      
         $row2 = 19;
        foreach ($smpeak as $labels):
            $col = 11;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $labels);
            $row2++;
        endforeach;
      $objPHPExcel->getActiveSheet()->setTitle("Template");
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");

          
    }
    
     function post_posting(){
        $labref=  $this->uri->segment(3);
        
        $component=  $this->input->post('heading');
        $posts=array(
            'labref'=>$labref,
            'component'=>$component,           
            'test_name'=>'Assay' ,
            'date_time'=>date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status',$posts);
    }

    public function save_assay_single() {        // $this->output->enable_profiler();
        //$this->load->database();
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');

        $max_row_id = $this->getTestAssayRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;

        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;

        $assaySTD = array(
            'labref' => $labref,
            'desired_weight' => $weight = $this->input->post('workingweight'),
            'vf1' => $vf1 = $this->input->post('workingvf1'),
            'pippette1' => $pipette1 = $this->input->post('workingpipette1'),
            'vf2' => $vf2 = $this->input->post('workingvf2'),
            'pipette2' => $concetration = $this->input->post('workingpipette2'),
            'vf3' => $weight = $this->input->post('workingvf3'),
            'pipette3' => $vf1 = $this->input->post('workingp3'),
            'vf4' => $pipette1 = $this->input->post('workingvf4'),
            'concetration' => $concetration = $this->input->post('workingmgml'),
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('assay_desiredw', $assaySTD);

        $assayA = array(
            'labref' => $labref,
            'weight' => $weight = $this->input->post('u_weight'),
            'vf1' => $vf1 = $this->input->post('vf1'),
            'pippette1' => $pipette1 = $this->input->post('pipette1'),
            'vf2' => $vf2 = $this->input->post('vf2'),
            'pipette2' => $concetration = $this->input->post('p2'),
            'vf3' => $this->input->post('vf31'),
            'pipette3' => $vf1 = $this->input->post('p321'),
            'vf4' => $pipette1 = $this->input->post('vf32'),
            'concetration' => $concetration = $this->input->post('mgml'),
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('assaystdab', $assayA);
        $assayB = array(
            'labref' => $labref,
            'weight' => $weight = $this->input->post('u_weight1'),
            'vf1' => $vf1 = $this->input->post('vf11'),
            'pippette1' => $pipette1 = $this->input->post('ppt'),
            'vf2' => $vf2 = $this->input->post('vf22'),
            'pipette2' => $concetration = $this->input->post('ppt1'),
            'vf3' => $weight = $this->input->post('vf33'),
            'pipette3' => $vf1 = $this->input->post('ppt2'),
            'vf4' => $pipette1 = $this->input->post('vf34'),
            'concetration' => $concetration = $this->input->post('mgml1'),
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('assaystdab', $assayB);


        //saving the assay sampels
        //sample desired weight*/


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
        $svf3 = $this->input->post('svf3');


        $sp1 = $this->input->post('sp1');
        $sp11 = $this->input->post('sp11');
        $sp12 = $this->input->post('sp112');
        $ssp3 = $this->input->post('ssp3');

        $svf2 = $this->input->post('svf2');
        $svf12 = $this->input->post('svf12');
        $svf22 = $this->input->post('svf22');
        $svf33 = $this->input->post('svf33');


        $pipette2 = $this->input->post('pipette2');
        $spf1 = $this->input->post('spf1');
        $spf2 = $this->input->post('spf2');
        $spf3 = $this->input->post('spf3');


        $vf3 = $this->input->post('vf3');
        $svf13 = $this->input->post('svf13');
        $svf23 = $this->input->post('svf23');
        $svf24 = $this->input->post('svf24');


        $pipette3 = $this->input->post('pipette3');
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

        $labelclaim = $this->input->post('labelclaim');
        $procedure = $this->input->post('procedure');

        $desired_abc_sample = array(
            'labref' => $labref,
            'powder_weight' => $this->input->post('pwnumber'),
            'api_weight' => $this->input->post('aiweight'),
            'vf1' => $this->input->post('svf1'),
            'pipette1' => $this->input->post('sp1'),
            'vf2' => $this->input->post('svf2'),
            'pipette2' => $this->input->post('pipette2'),
            'vf3' => $this->input->post('vf3'),
            'pipette3' => $this->input->post('pipette3'),
            'vf4' => $this->input->post('vf41'),
            'concetration' => $this->input->post('smgml'),
            'labelclaim' => $labelclaim,
            'preparation_proc' => $procedure,
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );

        $this->db->insert('sample_assay_desiredw', $desired_abc_sample);



        //$this->setDoneStatus($labref);
        $array = array(
            0 => array('labref' => $labref, 'powder_weight' => $pwnumber, 'api_weight' => $aiweight, 'vf1' => $svf1, 'pipette1' => $sp1, 'vf2' => $svf2, 'pipette2' => $pipette2, 'vf3' => $vf3, 'pipette3' => $pipette3, 'vf4' => $vf41, 'concetration' => $smgml, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 1 => array('labref' => $labref, 'powder_weight' => $sampleA, 'api_weight' => $u_weighta, 'vf1' => $svf11, 'pipette1' => $sp11, 'vf2' => $svf12, 'pipette2' => $spf1, 'vf3' => $svf13, 'pipette3' => $spf21, 'vf4' => $svf14, 'concetration' => $smgml1, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 2 => array('labref' => $labref, 'powder_weight' => $sampleB, 'api_weight' => $u_weightb, 'vf1' => $svf111, 'pipette1' => $sp12, 'vf2' => $svf22, 'pipette2' => $spf2, 'vf3' => $svf23, 'pipette3' => $spf33, 'vf4' => $svf241, 'concetration' => $smgml2, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 3 => array('labref' => $labref, 'powder_weight' => $sampleC, 'api_weight' => $u_weightc, 'vf1' => $svf3, 'pipette1' => $ssp3, 'vf2' => $svf33, 'pipette2' => $spf3, 'vf3' => $svf24, 'pipette3' => $spf4, 'vf4' => $svf25, 'concetration' => $smgml3, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
        );

        foreach ($array as $v) {
            $sql = "INSERT INTO sample_assay_abc (labref,powder_weight,api_weight,vf1,pipette1,vf2,pipette2,vf3,pippette3,vf4,concetration,repeat_status,analyst_id)
    VALUES
    ('{$v['labref']}','{$v['powder_weight']}','{$v['api_weight']}','{$v['vf1']}','{$v['pipette1']}'
    ,'{$v['vf2']}','{$v['pipette2']}','{$v['vf3']}','{$v['pipette3']}'
    ,'{$v['vf4']}','{$v['concetration']}','{$v['repeat_status']}','{$v['analyst_id']}')";

            //execute $sql here or it will overwrite on loop
            $k = mysql_query($sql);
        }



        $this->save_test();
        $this->updateTestIssuanceStatus();
        $this->updateSampleIssuance();
        $test_id=  $this->uri->segment(4);
        $this->updateUploadStatus($labref, $test_id);
     

        if ($k) {
            redirect('analyst_controller');
        } else {
            echo mysql_error();
        }
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 5);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    public function getTestAssayRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('assaystdab');
        return $row = $query->result();
    }

    public function getTestAssayRepeatStatusM($labref) {
        $component = $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $component);
        $query = $this->db->get('multiple_assaystdab');
        return $row = $query->result();
    }

    public function getTestAssayComponentNo($labref, $component) {

        $query = $this->db->query("SELECT MAX( component_no ) as component_number , component
                                    FROM `multiple_assaystdab`
                                    WHERE labref = '$labref' AND component='$component'");
        $row = $query->result();

        $mydata = $row[0]->component_number;
        if (empty($mydata)) {
            $query = $this->db->select_max('component_no', 'component_number')
                    ->where('labref', $labref)
                    ->get('multiple_assaystdab')
                    ->result();
            $row_data = $query[0]->component_number + 1;
            return $mydata = $row_data;
        } else {
            return $mydata;
        }
    }
    
    
    public function getTestAssayComponentNo_1($labref, $component) {

        $query = $this->db->query("SELECT MAX( component_no ) as component_number , component
                                    FROM `multiple_assaystdab`
                                    WHERE labref = '$labref' AND component='$component'");
        $row = $query->result();

        return $mydata = $row[0]->component_number;
    
    }
    

    public function checkUniformityStatus($labref) {
        $this->db->select('uniformity_status');
        $this->db->where('labref', $labref);
        $this->db->where('test_type', 'TC');
        // $this->db->or_where('test_type', 'Capsules');
        $query = $this->db->get('uniformity_status');
        $row = $query->row();
        return $uniformity = $row->uniformity_status;
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'assay');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
        //print_r($result);
    }

    function check_repeat_statusM() {
        $component = $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'assay');
        $this->db->where('component', $component);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
        //print_r($result);
    }

    function save_test() {
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;
        $labref = $this->uri->segment(3);
        $data = $this->check_repeat_status();
        $r_status = $data[0]->repeat_status;
        $new_r_status = $r_status + 1;
        $analyst_id = $this->session->userdata('user_id');

        $final_test_done = array(
            'labref' => $labref,
            'test_name' => 'assay',
            'repeat_status' => $new_r_status,
            'test_subject' => 'assa_r',
            'supervisor_id' => $supervisor_id,
            'analyst_id' => $analyst_id
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function save_testM() {

        $labref = $this->uri->segment(3);
        $component1 = $this->input->post('heading');
        $max_component_row_id = $this->getTestAssayComponentNo($labref, $component1);
        $new_status_component = $max_component_row_id;

        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;

        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;

        $data = $this->check_repeat_statusM();
        $r_status = $data[0]->repeat_status;
        $new_r_status = $r_status + 1;
        $analyst_id = $this->session->userdata('user_id');
        $component = $this->input->post('heading');

        $final_test_done = array(
            'labref' => $labref,
            'component' => $component,
            'component_no' => $new_status_component,
            'test_name' => 'assay',
            'repeat_status' => $new_r_status,
            'test_subject' => 'assa_r_multiple',
            'supervisor_id' => $supervisor_id,
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }

    public function getUniformityAssay($labref) {

        $this->db->select('relative_density');
        $this->db->where('labref', $labref);
        $sql = $this->db->get('relative_density_b');

        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return @$data;
    }
    
      public function getUniformity($labref) {

        $this->db->select('average');
        $this->db->where('labref', $labref);
        $sql = $this->db->get('caps_tabs_data');

        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return @$data;
    }

    public function getTabsCapsAverageData($labref) {
        $this->db->select('weight_caps_ta.actual_average,weight_tablets_ta.average');
        $this->db->where('labref', $labref);
        $sql = $this->db->get('weight_caps_ta');
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function assa_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c']=  $c=  $this->uri->segment(5);
        $data['assay_desired_weight'] = $this->getDesiredWeightData($labref, $r);
        $data['assay_standard_ab'] = $this->getAssayStandardAB($labref, $r);
        $data['assay_tabs_caps'] = $this->getTabsCapsData($labref, $r);
        $data['sample_assay_desired_weight'] = $this->getSampleAssayDesiredWeight($labref, $r);
        $data['sample_assay_standars_abc'] = $this->getSampleAssayStandardABC($labref, $r);
        $data['settings_view'] = 'assay_r_v';
        $this->base_params($data);
    }

//======================SINGLE ASSAY=====================================//
    function getDesiredWeightData($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('assay_desiredw');
        return $result = $query->result();
        //print_r($result);    
    }

    function getAssayStandardAB($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('assaystdab');
        return $result = $query->result();
        //print_r($result);    
    }

    function getTabsCapsData($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('caps_tabs_data');
        return $result = $query->result();
        //print_r($result);
    }

    function getSampleAssayDesiredWeight($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('sample_assay_desiredw');
        return $result = $query->result();
        //print_r($result);    
    }

    function getSampleAssayStandardABC($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('sample_assay_abc');
        return $result = $query->result();
        //print_r($result);    
    }

//===================================MULTIPLE ASSAY ====================================//

    public function assa_r_multiple() {
        error_reporting(0);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
         $data['c']=  $c=  $this->uri->segment(5);    
        $module_name=  $this->uri->segment(1);
        $data['done']=  $this->checkApproval($module_name, $labref, $r, $c);  
        $data['component_no'] = $component_no = $this->uri->segment(5);
        $data['no_of_pages'] = $this->printPages($labref);
        $data['no_of_repeats']=  $this->repeatPage($labref,$c);
        $data['assay_desired_weight'] = $this->getDesiredWeightDataM($labref, $r, $component_no);
        $data['assay_standard_ab'] = $this->getAssayStandardABM($labref, $r, $component_no);
        $data['assay_tabs_caps'] = $this->getTabsCapsDataM($labref, $r, $component_no);
        $data['sample_assay_desired_weight'] = $this->getSampleAssayDesiredWeightM($labref, $r, $component_no);
        $data['sample_assay_standars_abc'] = $this->getSampleAssayStandardABCM($labref, $r, $component_no);
        $data['component_name'] = $this->findComponentNameM($labref, $r, $component_no);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
         $data['date_time']=  $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'assay_r_multiple_v';
        $this->base_params($data);
    }

    function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId_1($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('analyst_supervisor');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }

    function getAnalystId_1($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function getUsername() {
        $this->db->select('username');
        $this->db->where('id', $this->session->userdata('analyst_id'));
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function getDesiredWeightDataM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $query = $this->db->get('multiple_assay_desiredw');
        return $result = $query->result();
        //print_r($result);    
    }

    function getAssayStandardABM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $query = $this->db->get('multiple_assaystdab');
        return $result = $query->result();
        //print_r($result);    
    }

    function getTabsCapsDataM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('caps_tabs_data');
        return $result = $query->result();
        //print_r($result);
    }

    function getSampleAssayDesiredWeightM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $query = $this->db->get('multiple_sample_assay_desiredw');
        return $result = $query->result();
        //print_r($result);    
    }

    function getSampleAssayStandardABCM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $query = $this->db->get('multiple_sample_assay_abc');
        return $result = $query->result();
        //print_r($result);    
    }

    function findComponentNameM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->select('component');
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $this->db->group_by('component');
        $query = $this->db->get('multiple_assaystdab');
        return $result = $query->result();
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }

    //===============================END OF MULTIPLE==============================//
    public function getError() {
        $labref = $this->uri->segment(3);
        return $error = "<div class='error' style='color:red'><p ><h2>Error: Uniformity of weight must be done first for sample' $labref'</h2></p></div>";
    }

    public function approve_data() {

        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c=  $this->uri->segment(5);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;

        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,
            'repeat_status' => $r,
            'test_name' => 'assay',
            'test_product' => 'tablets',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);
       
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no',$c);
        $this->db->where('test_name', 'assay');
        
        $this->db->update('tests_done', array('approval_status' => '1'));

        $this->compareToDecide($labref);

        redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c=  $this->uri->segment(5);
        
        $status = '1';
        
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        
        
           
        $this->db->where('repeat_status', $r);
        $this->db->where('test_name', 'assay');
        
        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            redirect('supervisors/home/' . $this->session->userdata('lab'));
        } else {
            $this->approve_data();
        }
    }

    public function approveM() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $component_no = $this->uri->segment(5);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $this->db->where('test_name', 'assay');
        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            redirect('supervisors/home/' . $this->session->userdata('lab'));
        } else {
            $this->approve_dataM();
        }
    }

    public function approve_dataM() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $component_no = $this->uri->segment(5);
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;

        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;

        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,         
            'component_no' => $component_no,
            'repeat_status' => $r,
            'test_name' => 'assay',
            'test_product' => 'tablets',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);
        $this->updateStatus($labref,$r,$component_no);
        redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    function updateStatus($labref,$r,$component_no) {
         $this->db->where('labref',$labref );
         $this->db->where('repeat_status', $r);
         $this->db->where('component_no',$component_no);
         $this->db->where('test_name', 'assay');        
         $this->db->update('tests_done', array('approval_status' => '1'));
         $this->compareToDecide($labref);
         redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }

    function uniformityExists($labref) {
        $data = $this->checkIfUniformity($labref);
        foreach ($data as $row) {
            if (in_array('6', $row)) {
                $data = '1';
            } else {
                $data = '0';
            }
        }
        return $data;
    }

    function checkIfUniformity($labref) {
        $this->db->select('test_id');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request_details');
        return $result = $query->result_array();
        //print_r($result);
    }

   
    
        function repeatPage($labref,$component_no ){   
        $paging=  $this->getRepeats($labref, $component_no);
        $limit = $paging[0]->totalRows;
       return range(1, $limit);
    }
    
    function getRepeats($labref,$component_no){
      
$query = $this->db->query("SELECT COUNT( * ) AS totalRows
                            FROM (

                            SELECT DISTINCT component, repeat_status
                            FROM `multiple_assaystdab`
                            WHERE labref = '$labref'
                            AND component_no = '$component_no'
                            )x");
return $result=  $query->result();


    }

    function printPages($labref) {
        $dataSource = $this->getAssayMultipleCount($labref);
        $limit = $dataSource[0]->totalRows;
        return $numbers = range(1, $limit);
    }

    function getAssayMultipleCount($labref) {
        $query = $this->db->query("SELECT COUNT(*) as totalRows
                            FROM(
                            SELECT DISTINCT component
                            FROM `multiple_sample_assay_abc`
                            WHERE labref = '$labref'
                            )x");
        $result = $query->result();
        return $result;
    }

    function updateSampleIssuance() {
        $do_status = $this->getDoStatus() + '1';
        $labref = $this->uri->segment(3);
        $test_id = 5;
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', array('do_count' => $do_status));
    }

    
    function loadlabref(){
        return $this->db->select('labref')->group_by('labref')->get('multiple_assay_desiredw')->result();
    }
    function loadAssayComponents($labref){
       echo json_encode( $this->db->select('component')->where('labref',$labref)->group_by('component')->get('multiple_assay_desiredw')->result()); 
    }
     function loadAssayComponentRuns($labref, $component){
       echo json_encode( $this->db->select('repeat_status')->where('labref',$labref)->where('component',$component)->group_by('repeat_status')->get('multiple_assay_desiredw')->result()); 
    }
        function loadAssayComponentData($labref, $component,$r){
       echo json_encode( $this->db->where('labref',$labref)->where('component',$component)->where('repeat_status',$r)->get('multiple_assay_desiredw')->result()); 
       
    }
     function loadAssayComponentStdAB($labref, $component,$r){
       echo json_encode( $this->db->where('labref',$labref)->where('component',$component)->where('repeat_status',$r)->get('multiple_assaystdab')->result()); 
       
    }
    
    function save_titration($labref) {

        $titrant = $this->input->post('titra');
        $pstd = $this->input->post('pstd');
        $ied = $this->input->post('ied');
        $eqv = $this->input->post('eqv');

        $stdw = $this->input->post('stdw');
        $stde = $this->input->post('stde');
        $stdf = $this->input->post('stdf');
        $stdi = $this->input->post('stdi');
        $stdt = $this->input->post('stdt');
        $stdn = $this->input->post('stdn');

        $wv = $this->input->post('wv');
        $ev = $this->input->post('ev');
        $fv = $this->input->post('fv');
        $iv = $this->input->post('iv');
        $tv = $this->input->post('tv');
        $av = $this->input->post('av');


        $max_row_id = $this->getTestAssayRepeatStatusM($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status;
        $component = $this->input->post('heading');
        $max_component_row_id = $this->getTestAssayComponentNo($labref, $component);
        $new_status_component = $max_component_row_id;
        $analyst_id = $this->session->userdata('user_id');
        $labref = $this->uri->segment(3);

        $top = array(
            'labref' => $labref,
            'titrant' => $titrant,
            'ps' => $pstd,
            'ied' => $ied,
            'eq' => $eqv,
            'component' => $component,
            'component_no' => '',
            'repeat_status' => '',
            'analyst_id' => $analyst_id
        );
        $this->db->insert('titre_head', $top);


        for ($i = 0; $i < count($stdw); $i++) {
            $data2 = array(
                'labref' => $labref,
                'component' => $component,
                'component_no' => '',
                'weight' => $stdw[$i],
                'expected_titre' => $stde[$i],
                'final_vol' => $stdf[$i],
                'initial_vol' => $stdi[$i],
                'titre_vol' => $stdt[$i],
                'normality_factor' => $stdn[$i],
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            );                    
            

            $this->db->insert('titre_std', $data2);
        }
     

        for ($i = 0; $i < count($wv); $i++) {
            $data21 = array(
                'labref' => $labref,
                'component' => $component,
                'component_no' => '',
                'weight_vol' => $wv[$i],
                'expected_titre' => $ev[$i],
                'final_vol' => $fv[$i],
                'initial_vol' => $iv[$i],
                'titre_vol' => $tv[$i],
                'actual' => $av[$i],
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            );

            $this->db->insert('titre_sample', $data21);
        }
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "Assay: Sample - " . $labref;
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        //$data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}

