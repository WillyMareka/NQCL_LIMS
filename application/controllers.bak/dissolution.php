<?php

//
//error_reporting(0);
class Dissolution extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }
    
   

    public function worksheet() {
         $data['test_id']=$this->uri->segment(4);
        $labref = $this->uri->segment(3);
        $data['settings_view'] = "dissolution_v_custom";
        $data['labref'] = $this->uri->segment(3);
        $data['assayweight'] = $this->getStandards($labref);
        $data['labreference']=  $this->loadlabref();
        //$data['standards']=  $this->getStandards($labref);
        // $data['lastworksheet'] = $this->getWorksheet() + 1;
        $this->base_params($data);
    }
    
        public function worksheet_c() {
         $data['test_id']=$this->uri->segment(4);
        $labref = $this->uri->segment(3);
        $data['settings_view'] = "dissolution_v_2";
        $data['labref'] = $this->uri->segment(3);
        $data['assayweight'] = $this->getStandards($labref);
        $data['labreference']=  $this->loadlabref();
        //$data['standards']=  $this->getStandards($labref);
        // $data['lastworksheet'] = $this->getWorksheet() + 1;
        $this->base_params($data);
    }
    
     function loadlabref(){
        return $this->db->select('labref')->group_by('labref')->get('multiple_assay_desiredw')->result();
    }

    function loadComponents($labref) {
        echo json_encode($this->db->select('name')
                        ->where('request_id', $labref)                       
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
           'test'=>'Dissolution: Component '.$component,
           'reason'=>$reason
       );
       $this->db->insert('repeat_reason',$array);
      echo 'success';
    }
    
       function check_done($labref,$component){
        $query= $this->db->where('labref',$labref)->where('component',$component)->get('diss_data');
        if($query->num_rows()> 0){
           echo json_encode(array('done_state'=>1));
        }else{
          echo json_encode(array('done_state'=>0));
        }
    }
          function check_done_post($labref,$component){
        $query= $this->db->where('labref',$labref)->where('component',$component)->get('diss_data');
        if($query->num_rows()> 0){
          return 1;
        }else{
        return 0;
        }
    }
    
    

    function loadFreshComponents($labref) {
        echo json_encode($this->db->select('name')
                        ->where('request_id', $labref)
                        
                        ->where('d_status', 0)
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

    function loadRepeatComponents($labref) {
        echo json_encode($this->db->select('name')
                        ->where('request_id', $labref)
                        ->where('status', 1)
                        ->where('d_status', 1)
                        ->get('components')
                        ->result()
        );
    }

    function getdata($labref, $component) {
        $component = $this->input->post('heading');
        echo json_encode($this->db->select('repeat_status')
                        ->where('labref', $labref)
                        ->where('component', $component)
                        ->group_by('repeat_status')
                        ->get('multiple_assaystdab')
                        ->result()
        );
    }

    function getAB($labref, $component, $repeat_status) {
        echo json_encode($this->db->select('*')
                        ->where('labref', $labref)
                        ->where('component', $component)
                        ->where('repeat_status', $repeat_status)
                        ->get('multiple_assaystdab')
                        ->result()
        );
    }
    
        function get_SAB($labref, $component, $repeat_status) {
        echo json_encode($this->db->select('peak_area')
                        ->where('labref', $labref)
                        ->where('component', $component)
                        ->where('repeat_status', $repeat_status)
                        ->get('peak_areas_stdab')
                        ->result()
        );
    }

    function getStandards($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('multiple_assaystdab');
        $result = $query->result();
        return $result;
    }

    public function dis_tab_weights() {
        $data = array();
        $data['settings_view'] = "dissolution_weights";

        $this->base_params($data);
    }

    public function multidissolution() {
        $data = array();
        $data['settings_view'] = "dissolution_multistaged_v";

        $this->base_params($data);
    }

    public function multistaged() {
        $data = array();
        $data['settings_view'] = "dissolution_multi_stage_v";
        $data['labref'] = $this->uri->segment(3);
        $this->base_params($data);
    }

    public function getWorksheet() {
        $res = mysql_query("SELECT MAX(id) AS lastId FROM worksheets");
        while ($row = mysql_fetch_assoc($res)) {
            $lastId = $row['lastId'];
        }
        return $lastId;
    }

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $component = $this->input->post('heading');
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $component);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('diss_data')->result();
        return $result = $query[0]->repeat_status;
    }

    public function save_dissolution_data($labref,$id) {

        $sampleinfo = $this->loadSampleInfo($labref);
                $standardsinfo =  $this->loadStandardsData($labref, $id);
                
        $analyst_id = $this->session->userdata('user_id');
        $component1 = $this->input->post('heading');
        $diss_repeat = $this->check_done_post($labref, $component1);
        $max_component_row_id = $this->getDissComponentNo($labref, $component1);
        $new_component = $max_component_row_id;
        $max_row_id = $this->getDissolutionTestRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;             
                
        
        $component = $this->input->post('heading');
        //Dissolution Conditions
        $DM = $this->input->post('DM');
        $R2 = $this->input->post('R2');
        $apparatus = $this->input->post('apparatus');
        $Rm = $this->input->post('Rm');
        $R3 = $this->input->post('R3');
        $tcmean = $this->input->post('tcmean');
        $tcreading = $this->input->post('tcreading');
        $time=  $this->input->post('R3');
                $time1=  $this->input->post('R31');
                $time2=  $this->input->post('R32');
                $time3=  $this->input->post('R33');
                $time4=  $this->input->post('R34');
        
        
      

        $dissolution_conds = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'dissolution_medium' => $DM,
            'volume_used' => $R2,
            'apparatus' => $apparatus,
            'rotations_per_minute' => $Rm,
            'time_taken1' => $time,
            'time_taken2' => $time1,
            'time_taken3' => $time2,
            'time_taken4' => $time3,
            'time_taken5' => $time4,
            'diss_total' => $tcreading,
            'diss_mean' => $tcmean,
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id,
            'date_time'=>date('m-d-Y H:i:s')
        );
        $this->db->insert('diss_mean', $dissolution_conds);
        
        $DM1 = $this->input->post('DM2');
        $R21 = $this->input->post('Rv21');
        $apparatus1 = $this->input->post('apparatus2');
        $Rm1 = $this->input->post('Rm2');
        $R31 = $this->input->post('R4');
        
           $dissolution_conds_buffer = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'dissolution_medium' => $DM1,
            'volume_used' => $R21,
            'apparatus' => $apparatus1,
            'rotations_per_minute' => $Rm1,
            'time_taken' => $R31,
            'diss_total' => $tcreading,
            'diss_mean' => $tcmean,
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id,
            'date_time'=>date('m-d-Y H:i:s')
        );
       $this->db->insert('buff_diss_mean', $dissolution_conds_buffer);
        
        //$this->output->enable_profiler();

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
        $procedure = $this->input->post('procedure');
        
        $label_claim1 = $this->input->post('labelclaim1');
        $volume_used1 = $this->input->post('vu2');
        $piette1 = $this->input->post('workingp1_2');
        $volume1 = $this->input->post('workingv_2');
        $piette21 = $this->input->post('workingp2_2');
        $volume21 = $this->input->post('workingv2_2');
        $piette31 = $this->input->post('workingp3_2');
        $volume31 = $this->input->post('workingv3_2');
        $piette41 = $this->input->post('workingp4_2');
        $volume41 = $this->input->post('workingv4_2');
        $concetration1 = $this->input->post('conc_2');
        


        $dissolution_subsequent = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'label_claim' => $label_claim,
            'volume_used' => $volume_used,
            'pipette' => $piette,
            'volume' => $volume,
            'pipette2' => $piette2,
            'volume2' => $volume2,
            'pipette3' => $piette3,
            'volume3' => $volume3,
            'pipette4' => $piette4,
            'volume4' => $volume4,
            'concetration' => $concetration,
            'procedure' => $procedure,
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id
        );
        $this->db->insert('diss_subsequent_dillutions', $dissolution_subsequent);
        
        
            $dissolution_subsequent_buffer = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'label_claim' => $label_claim1,
            'volume_used' => $volume_used1,
            'pipette' => $piette1,
            'volume' => $volume1,
            'pipette2' => $piette21,
            'volume2' => $volume21,
            'pipette3' => $piette31,
            'volume3' => $volume31,
            'pipette4' => $piette41,
            'volume4' => $volume41,
            'concetration' => $concetration1,
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id
        );
      $this->db->insert('dissbuffer_subsequent_dillutions', $dissolution_subsequent_buffer);
        //$this->output->enable_profiler();

        $tc1 = $this->input->post('tc1');
        $tc2 = $this->input->post('tc2');
        $tc3 = $this->input->post('tc3');
        $tc4 = $this->input->post('tc4');
        $tc5 = $this->input->post('tc5');
        $tc6 = $this->input->post('tc6');
        $stage = $this->input->post('distage');



        $array = array(
            0 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc1, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 1 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc2, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 2 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc3, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 3 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc4, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 4 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc5, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 5 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc6, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
        );


        foreach ($array as $v) {
            $this->db->insert('dissolution_tabs_caps', $v);
        }

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

        $u_weightA = $this->input->post('u_weightA');
        $v11 = $this->input->post('v11');
        $standardp1 = $this->input->post('standardp1');
        $standardvf = $this->input->post('standardvf');
        $p20 = $this->input->post('p20');
        $vf3 = $this->input->post('vf3');
        $p211 = $this->input->post('p211');
        $vf4 = $this->input->post('vf4');
        $dmgml = $this->input->post('dmgml');

        $u_weightB = $this->input->post('u_weightB');
        $v2 = $this->input->post('v2');
        $standardp2 = $this->input->post('standardp2');
        $standardvf1 = $this->input->post('standardvf1');
        $p21 = $this->input->post('p21');
        $vf23 = $this->input->post('vf23');
        $p22 = $this->input->post('p22');
        $vf24 = $this->input->post('vf24');
        $dmgml1 = $this->input->post('dmgml1');




        $data = array(
            0 => array(
                'labref' => $labref,
                'component_no' => $new_component,
                'component' => $component,
                'weight' => $workingweight,
                'vf1' => $workingvf1,
                'pipette1' => $workingp11,
                'vf2' => $workingvf2,
                'pipette2' => $workingp12,
                'vf3' => $workingvf3,
                'pipette3' => $workingp13,
                'vf4' => $workingvf4,
                'concetration' => $workingmgml,
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            ),
            1 => array(
                'labref' => $labref,
                'component_no' => $new_component,
                'component' => $component,
                'weight' => $u_weightA,
                'vf1' => $v11,
                'pipette1' => $standardp1,
                'vf2' => $standardvf,
                'pipette2' => $p20,
                'vf3' => $vf3,
                'pipette3' => $p211,
                'vf4' => $vf4,
                'concetration' => $dmgml,
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            ),
            2 => array(
                'labref' => $labref,
                'component_no' => $new_component,
                'component' => $component,
                'weight' => $u_weightB,
                'vf1' => $v2,
                'pipette1' => $standardp2,
                'vf2' => $standardvf1,
                'pipette2' => $p21,
                'vf3' => $vf23,
                'pipette3' => $p22,
                'vf4' => $vf24,
                'concetration' => $dmgml1,
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            )
        );
        foreach ($data as $key) {
           $this->db->insert('diss_stdassay_prep', $key);
        }



        $dissolution_weights = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'desired_weight' => $desired_weight = $this->input->post('workingweight'),
            'stdA' => $this->input->post('u_weightA'),
            'stdB' => $this->input->post('u_weightB'),
            'desired_conc' => $conc = $this->input->post('conc'),
            'tabs_caps_mean' => $conc = $this->input->post('tcmean'),
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id
        );
        $this->db->insert('diss_data', $dissolution_weights);
        
         $data = $this->getLastWorksheet();
        echo $worksheetIndex = $data[0]->no_of_sheets;

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        //we load the file that we want to read

        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

      $objPHPExcel->setActiveSheetIndexbyName('AD_'.$component1);
         $worksheet=  $objPHPExcel->getActiveSheet();
        
                            
                    //Assay Standard Preparation desired  
                 
                    if($diss_repeat === 0){            

            // ->setCellValue('B36', $this->input->post('workingweight'))
                   $worksheet ->setCellValue('B86', $this->input->post('workingvf1'))
                    ->setCellValue('B87', $this->input->post('workingp11'))
                    ->setCellValue('B88', $this->input->post('workingvf2'))
                    ->setCellValue('B89', $this->input->post('workingp12'))
                    ->setCellValue('B90', $this->input->post('workingvf3'))
                    ->setCellValue('B91', $this->input->post('workingp13'))
                    ->setCellValue('B92', $this->input->post('workingvf4'))
                   // ->setCellValue('D97', $this->input->post('workingmgml'))
                    //->setCellValue('A35', 'Standard A')
                    ->setCellValue('D93', $this->input->post('u_weightA'))
                    
                    //->setCellValue('A36', 'Standard B')
                    ->setCellValue('F93', $this->input->post('u_weightB'))
                 
                 
                 ->setCellValue('B104', $this->input->post('vu'))
                    ->setCellValue('B105', $this->input->post('workingp1'))
                    ->setCellValue('B106', $this->input->post('workingv'))
                    ->setCellValue('B107', $this->input->post('workingv2'))
                    ->setCellValue('B106', $this->input->post('workingp3'))
                    ->setCellValue('B108', $this->input->post('workingv3'))
                    ->setCellValue('B109', $this->input->post('workingp4'))
                    ->setCellValue('B110', $this->input->post('workingv4'))

                   
         
                     ->setCellValue('B18', $sampleinfo[0]->product_name)
                    ->setCellValue('B19', $sampleinfo[0]->request_id)
                    ->setCellValue('B20', $sampleinfo[0]->active_ing)
                    ->setCellValue('B21', $sampleinfo[0]->label_claim)
                    ->setCellValue('B22', $sampleinfo[0]->updated_at);
         

         
                     $speak=  $this->input->post('speak');
                   $area1=  $this->input->post('area1');
        
             //standard      
         $row = 88;
        for($i=0;$i<3;$i++){
            $col = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row, $speak[$i]);
            $row++;
        }
        
         $row2 = 88;
        for($i=3;$i<6;$i++){
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $speak[$i]);
            $row2++;
        }
        
        //sample
        
        $si = 105;
        for($i=0;$i<count($area1);$i++){
            $col = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $si, $area1[$i]);
            $si++;
        }
        
       }else{
           
             // ->setCellValue('B36', $this->input->post('workingweight'))
                   $worksheet ->setCellValue('B126', $this->input->post('workingvf1'))
                    ->setCellValue('B127', $this->input->post('workingp11'))
                    ->setCellValue('B128', $this->input->post('workingvf2'))
                    ->setCellValue('B129', $this->input->post('workingp12'))
                    ->setCellValue('B130', $this->input->post('workingvf3'))
                    ->setCellValue('B131', $this->input->post('workingp13'))
                    ->setCellValue('B132', $this->input->post('workingvf4'))
                   // ->setCellValue('D97', $this->input->post('workingmgml'))
                    //->setCellValue('A35', 'Standard A')
                    ->setCellValue('D133', $this->input->post('u_weightA'))
                    
                    //->setCellValue('A36', 'Standard B')
                    ->setCellValue('F133', $this->input->post('u_weightB'))
                 
                 
                 ->setCellValue('B144', $this->input->post('vu'))
                    ->setCellValue('B145', $this->input->post('workingp1'))
                    ->setCellValue('B146', $this->input->post('workingv'))
                    ->setCellValue('B147', $this->input->post('workingv2'))
                    ->setCellValue('B148', $this->input->post('workingp3'))
                    ->setCellValue('B149', $this->input->post('workingv3'))
                    ->setCellValue('B150', $this->input->post('workingp4'))
                    ->setCellValue('B151', $this->input->post('workingv4'));

                   
         
                   
         

         
                     $speak=  $this->input->post('speak');
                   $area1=  $this->input->post('area1');
        
             //standard      
         $row = 128;
        for($i=0;$i<3;$i++){
            $col = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row, $speak[$i]);
            $row++;
        }
        
         $row2 = 128;
        for($i=3;$i<6;$i++){
            $col = 5;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $speak[$i]);
            $row2++;
        }
        
        //sample
        
        $si = 145;
        for($i=0;$i<count($area1);$i++){
            $col = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $si, $area1[$i]);
            $si++;
        }
           
           
           
       }
        
              
        
      
            $objPHPExcel->getActiveSheet()->setTitle('AD_'.$component1);


            $dir = "workbooks";

            if (is_dir($dir)) {           

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();
            //$this->upDatePosting($labref);
            echo 'Data exported';
           // exit();
        } else {
            echo 'Dir does not exist';
            
        } 
        
      //  exit();
        $this->save_areas();
        $this->save_peaks();
        $this->save_test();
        $this->post_posting();
        $this->updateTestIssuanceStatus();
        $this->registerChemicalSubstanceUsed();
        $this->saveBuffer();
        $test_id=  $this->uri->segment(4);
        $this->updateUploadStatus($labref, $test_id);
        $this->updateCOA($labref);
       // $this->updateSampleIssuance();
        
        // redirect('analyst_controller');
    }
    function save_peaks(){
        
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $component1 = $this->input->post('heading');
        $max_component_row_id = $this->getDissComponentNo($labref, $component1);
        $new_component = $max_component_row_id;
        $max_row_id = $this->getDissolutionTestRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status ;
        
         $speak=  $this->input->post('speak');
       for($i=0; $i <count($speak); $i++){
           $data=array(
               'labref'=>$labref,
               'component'=>$component1,
               'component_no'=>$new_component,
               'peak_area'=>$speak[$i],
               'repeat_status'=>$new_status,
               'analyst_id'=>$analyst_id
           );
             $this->db->insert('diss_peak_areas_stdab',$data);
       }
    }
    
    function save_areas() {

        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $component1 = $this->input->post('heading');
        $max_component_row_id = $this->getDissComponentNo($labref, $component1);
        $new_component = $max_component_row_id;
        $max_row_id = $this->getDissolutionTestRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status ;



        $area_1 = $this->input->post('area1');
        $area_2 = $this->input->post('area2');
        $area_3 = $this->input->post('area3');
        $area_4 = $this->input->post('area4');
        $area_5 = $this->input->post('area5');
        //$area_6 = $this->input->post('area6');

        if ($area_1 == true && $area_2 == false) {

            for ($i = 0; $i < count($area_1); $i++) {
                $data = array(
                    'labref' => $labref,
                    'area_1' => $area_1[$i],
                    'area_2' => 'Not Done',
                    'area_3' => 'Not Done',
                    'area_4' => 'Not Done',
                    'area_5' => 'Not Done',
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id,
                    'component_no' => $new_component,
                    'component' => $component1,
                    'stage' => '0'
                );
                $this->db->insert('dissolution_areas_absorbance', $data);
            }
        } else if ($area_1 == true && $area_2 == true && $area_3 == false) {

            for ($i = 0; $i < count($area_1); $i++) {
                $data = array(
                    'labref' => $labref,
                    'area_1' => $area_1[$i],
                    'area_2' => $area_2[$i],
                    'area_3' => 'Not Done',
                    'area_4' => 'Not Done',
                    'area_5' => 'Not Done',
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id,
                    'component_no' => $new_component,
                    'component' => $component1,
                    'stage' => '0'
                );
                $this->db->insert('dissolution_areas_absorbance', $data);
            }
        } else if ($area_1 == true && $area_2 == true && $area_3 == true && $area_4 == false) {

            for ($i = 0; $i < count($area_1); $i++) {
                $data = array(
                    'labref' => $labref,
                    'area_1' => $area_1[$i],
                    'area_2' => $area_2[$i],
                    'area_3' => $area_3[$i],
                    'area_4' => 'Not Done',
                    'area_5' => 'Not Done',
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id,
                    'component_no' => $new_component,
                    'component' => $component1,
                    'stage' => '0'
                );
                $this->db->insert('dissolution_areas_absorbance', $data);
            }
        } else if ($area_1 == true && $area_2 == true && $area_3 == true && $area_4 == true && $area_5 == false) {

            for ($i = 0; $i < count($area_1); $i++) {
                $data = array(
                    'labref' => $labref,
                    'area_1' => $area_1[$i],
                    'area_2' => $area_2[$i],
                    'area_3' => $area_3[$i],
                    'area_4' => $area_4[$i],
                    'area_5' => 'Not Done',
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id,
                    'component_no' => $new_component,
                    'component' => $component1,
                    'stage' => '0'
                );
                $this->db->insert('dissolution_areas_absorbance', $data);
            }
        } else if ($area_1 == true && $area_2 == true && $area_3 == true && $area_4 == true && $area_5 == true) {

            for ($i = 0; $i < count($area_1); $i++) {
                $data = array(
                    'labref' => $labref,
                    'area_1' => $area_1[$i],
                    'area_2' => $area_2[$i],
                    'area_3' => $area_3[$i],
                    'area_4' => $area_4[$i],
                    'area_5' => $area_5[$i],
                    'repeat_status' => $new_status,
                    'analyst_id' => $analyst_id,
                    'component_no' => $new_component,
                    'component' => $component1,
                    'stage' => '0'
                );
                $this->db->insert('dissolution_areas_absorbance', $data);
            }
        }



        /* for($i=0;$i<count($area_1);$i++){
          $data=array(
          'labref'=>$labref,
          'area_1'=>$area_1[$i],
          'area_2'=>$area_2[$i],
          'area_3'=>$area_3[$i],
          'area_4'=>$area_4[$i],
          'area_5'=>$area_5[$i],
          'repeat_status'=>$new_status,
          'analyst_id'=>$analyst_id,
          'component_no'=>$new_component,
          'component'=>$component1,
          'stage'=>'0'

          );
          $this->db->insert('dissolution_areas_absorbance',$data);
          } */
    }

    function saveBuffer() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $component1 = $this->input->post('heading');
        $max_component_row_id = $this->getDissComponentNo($labref, $component1);
        $new_component = $max_component_row_id;
        $max_row_id = $this->getDissolutionTestRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status ;
         $medium=  $this->input->post('DM2');
         $R21=  $this->input->post('R21');
          $apparatus2=  $this->input->post('apparatus2');
          $Rm2=$this->input->post('Rm2');
            $time=  $this->input->post('R4');
            $time1=  $this->input->post('R41');
            $time2=  $this->input->post('R42');
            $time3=  $this->input->post('R43');
            $time4=  $this->input->post('R44');
        if($medium == '' && $time==''&& $time1==''&& $time2==''&& $time3==''&& $time4==''){
            $medium='Not Used';
            $time='Not Used';
            $R21='Not Used';
            $apparatus2='Not Used';
            $Rm2='Not Used';
             
        }else{
            $medium=  $this->input->post('DM2');
            $time=  $this->input->post('R4');
            $time1=  $this->input->post('R41');
            $time2=  $this->input->post('R42');
            $time3=  $this->input->post('R43');
            $time4=  $this->input->post('R44');
            $R21=  $this->input->post('R21');
            $apparatus2=  $this->input->post('apparatus2');
            $Rm2=$this->input->post('Rm2');
        }
        $component = $this->input->post('heading');
        
        $buffer_data=array(
            'labref'=>$labref,
            'analyst_id'=>$analyst_id,
            'component'=>$component,
            'component_no'=>$new_component,
            'repeat_status'=>$new_status,
            'medium'=>$medium,
            'volume'=>$R21,
            'apparatus'=>$apparatus2,
            'rpm'=>$Rm2, 
            'time_taken'=>$time.", ".$time2.", ".$time3.", ".$time4
        );
        $this->db->insert('dissolution_buffer',$buffer_data);
    }
    
    function updateCOA($labref) {
        $time = $this->input->post('R3');
        $time1 = $this->input->post('R31');
        $time2 = $this->input->post('R32');
        $time3 = $this->input->post('R33');
        $time4 = $this->input->post('R34');

        if ($time == true && $time1 == false) {
           $data = array('specification' => "After $time Mins", 'complies' => '');
            $this->db->where('labref', $labref)->where('test_id', 2)->update('coa_body', $data); 
        } else if ($time == true && $time1 == true && $time2 == false) {
            $data = array('specification' => "After $time Mins, After $time1 Mins", 'complies' => ',');
            $this->db->where('labref', $labref)->where('test_id', 2)->update('coa_body', $data);
        } else if ($time == true && $time1 == true && $time2 == true && $time3 == false) {
            $data = array('specification' => "After $time Mins, After $time1 Mins , After $time2 Mins", 'complies' => ',,');
            $this->db->where('labref', $labref)->where('test_id', 2)->update('coa_body', $data);
        } else if ($time == true && $time1 == true && $time2 == true && $time3 == true && $time4 == false) {
            $data = array('specification' => "After $time Mins, After $time1 Mins , After $time2 Mins, After $time3 Mins", 'complies' => ',,,');
            $this->db->where('labref', $labref)->where('test_id', 2)->update('coa_body', $data);
        } else {
            $data = array('specification' => "After $time Mins, After $time1 Mins , After $time2 Mins, After $time3 Mins, After $time4 Mins", 'complies' => ',,,,');
            $this->db->where('labref', $labref)->where('test_id', 2)->update('coa_body', $data);
        }
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $component = $this->input->post('heading');
        $max_component_row_id = $this->getDissComponentNo($labref, $component);
        $new_component = $max_component_row_id;        
        $posts = array(
            'labref' => $labref,
            'component' => 'diss_' . $component,
            'test_name' => 'Dissolution',
            'component_no'=>$new_component,
            'date_time'=>date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 2);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    function upDate($labref) {
        $component = $this->input->post('active_ingredient');
        $this->db
                ->where('request_id', $labref)
                ->where('name', $component)
                ->update('components', array('d_status' => 1)
        );
    }

    function check_repeat_status() {    
        $component = $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));  
         $this->db->where('component', $component);
        $this->db->where('test_name', 'dissolution');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
     //  print_r($result);
    }

    public function diss_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c= $component = $this->uri->segment(5);
        $data['no_of_pages'] = $this->printPages($labref);
          $module=  $this->uri->segment(1);
        $data['done']=  $this->checkApproval($module, $labref, $r, $c);   
        $data['diss_conds_conc'] = $this->getDissCondsConclusion($labref, $r, $component);
        $data['stage_2'] = $this->getDissCondsConclusion1($labref, $r, $component);
        $data['subsequent'] = $this->getSubsequentDillutions($labref, $r, $component);
        $data['diss_tabs'] = $this->getTabsData($labref, $r, $component);
        $data['diss_std_prep'] = $this->getDissoulutionStdPrep($labref, $r, $component);
        $data['component_name'] = $this->findComponentNameM($labref, $r, $component);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        //$data['sample_assay_standars_abc'] = $this->getSampleAssayStandardABC($labref, $r);
        $data['date_time']=  $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'dissolution_r_v';
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

    function findComponentNameM($labref, $r, $component_no) {
        $this->db->select('component');
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $this->db->group_by('component');
        $query = $this->db->get('dissolution_tabs_caps');
        return $result = $query->result();
    }

    function getUsername() {
        $this->db->select('username');
        $this->db->where('id', $this->session->userdata('analyst_id'));
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function getTabsData($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('dissolution_tabs_caps');
        return $result = $query->result();
    }

    function getDissCondsConclusion($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('diss_mean');
        return $result = $query->result();
    }
        function getDissCondsConclusion1($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('dissolution_buffer');
        return $result = $query->result();
    }

    function getSubsequentDillutions($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('diss_subsequent_dillutions');
        return $result = $query->result();
    }

    function getDissoulutionStdPrep($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('diss_stdassay_prep`');
        return $result = $query->result();
    }

    function save_test() {
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;
        $labref = $this->uri->segment(3);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $data = $this->check_repeat_status();
        $r_status = $data[0]->repeat_status + 1;
        $new_r_status = $r_status;
        $analyst_id = $this->session->userdata('user_id');

        $component1 = $this->input->post('heading');
        $max_component_row_id = $this->getDissComponentNo($labref, $component1);
        $new_component = $max_component_row_id;
        // (int) $new_component = (int) $max_component[0]->component_no;
        $component = $this->input->post('heading');
        $final_test_done = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'test_name' => 'dissolution',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'diss_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
        $this->upDate($labref);
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }

    public function getAssayStdAB($labref) {
        $this->db->select('weight');
        $this->db->where('labref', $labref);
        $query = $this->db->get('assaystdab');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $data[] = $value;
            }
        }
        return $data;
    }

    public function getDissolutionTestRepeatStatus($labref) {
        $component = $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $component);
        $query = $this->db->get('diss_data');
        return $row = $query->result();
    }

    public function approve_data() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c=  $this->uri->segment(5);
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
            'repeat_status' => $r,
            'component_no'=>$c,
            'test_name' => 'dissolution',
            'test_product' => 'tablets',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);

       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('component_no',$c);
       $this->db->where('test_name','dissolution');
       $this->db->update('tests_done',array('approval_status'=>'1'));
       
       
       $this->compareToDecide($labref);
       
       redirect('supervisors/home/'.$this->session->userdata('lab'));
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no',$c);
        $this->db->where('test_name', 'dissolution');
        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            redirect('supervisors/home/' . $this->session->userdata('lab'));
        } else {
            $this->approve_data();
        }
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

    public function getDataToExcel() {
        if ($_POST):
            $labref = $this->uri->segment(3);
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

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");


            $objWorkSheet = $objPHPExcel->createSheet(1);


            $objWorkSheet->setCellValue('E22', 'Tabs/Capsule Weight')
                    ->setCellValue('E23', 'No.')
                    ->setCellValue('F23', 'Tabs/Capsule Weights (mg)')
                    ->setCellValue('E24', '1')
                    ->setCellValue('F24', $tc1)
                    ->setCellValue('E25', '2')
                    ->setCellValue('F25', $tc2)
                    ->setCellValue('E26', '3')
                    ->setCellValue('F26', $tc3)
                    ->setCellValue('E27', '4')
                    ->setCellValue('F27', $tc4)
                    ->setCellValue('E28', '5')
                    ->setCellValue('F28', $tc5)
                    ->setCellValue('E29', '6')
                    ->setCellValue('F29', $tc6)
                    ->setCellValue('E30', 'Total')
                    ->setCellValue('F30', $tcreading)
                    ->setCellValue('E31', 'Mean')
                    ->setCellValue('F31', $tcmean)
                    ->setCellValue('E33', 'Dissolution Conditions')
                    ->setCellValue('H34', 'n Run')
                    ->setCellValue('F35', 'Dissolution Medium')
                    ->setCellValue('H35', $DM)
                    ->setCellValue('F36', 'Volume Used')
                    ->setCellValue('H36', $R2)
                    ->setCellValue('F37', 'Apparatus')
                    ->setCellValue('H37', $apparatus)
                    ->setCellValue('F38', 'Rotations Per minute')
                    ->setCellValue('H38', $Rm)
                    ->setCellValue('F39', 'Time Taken')
                    ->setCellValue('H39', $R3)
                    ->setCellValue('E41', 'Subsequent Dillutions')
                    ->setCellValue('B42', 'Label Claim')
                    ->setCellValue('C42', 'Volume Used')
                    ->setCellValue('D42', 'pipette1')
                    ->setCellValue('E42', 'vf1')
                    ->setCellValue('F42', 'Concetration')
                    ->setCellValue('A43', 'Desired Concetration')
                    ->setCellValue('B43', $label_claim)
                    ->setCellValue('C43', $volume_used)
                    ->setCellValue('D43', $piette)
                    ->setCellValue('E43', $volume)
                    ->setCellValue('F43', $concetration)



                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('E45', 'Standard Preparation For Dissolution')
                    ->setCellValue('B46', 'Powder Weight')
                    ->setCellValue('C46', 'API Weight')
                    ->setCellValue('D46', 'vf1')
                    ->setCellValue('E46', 'pipette1')
                    ->setCellValue('F46', 'vf2')
                    ->setCellValue('G46', 'pipette2')
                    ->setCellValue('H46', 'vf3')
                    ->setCellValue('I46', 'pipette3')
                    ->setCellValue('J46', 'vf4')
                    ->setCellValue('L46', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A47', 'Desired Weight')
                    ->setCellValue('B47', $workingweight)
                    ->setCellValue('C47', $workingvf1)
                    ->setCellValue('D47', $workingp11)
                    ->setCellValue('E47', $workingvf2)
                    ->setCellValue('F47', $workingp12)
                    ->setCellValue('G47', $workingvf3)
                    ->setCellValue('H47', $workingp13)
                    ->setCellValue('I47', $workingvf4)
                    ->setCellValue('J47', $workingmgml)
                    ->setCellValue('A48', 'Standard A')
                    ->setCellValue('B48', $weightA)
                    ->setCellValue('C48', $v1)
                    ->setCellValue('D48', $p1)
                    ->setCellValue('E48', $vf)
                    ->setCellValue('F48', $p2)
                    ->setCellValue('G48', $vf3)
                    ->setCellValue('H48', $p3)
                    ->setCellValue('I48', $vf4)
                    ->setCellValue('J48', $dmgml)
                    ->setCellValue('A49', 'Standard B')
                    ->setCellValue('B49', $weightB)
                    ->setCellValue('C49', $v12)
                    ->setCellValue('D49', $p12)
                    ->setCellValue('E49', $vf12)
                    ->setCellValue('F49', $p21)
                    ->setCellValue('G49', $vf23)
                    ->setCellValue('H49', $p22)
                    ->setCellValue('I49', $vf24)
                    ->setCellValue('J49', $dmgml1)


                    //Other values used
                    ->setCellValue('B51', 'Procedure Used')
                    ->setCellValue('C51', $procedure);

//$objPHPExcel->setTitle("dissolution");

            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");


                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }



            return true;
        else:
            return false;
        endif;
    }

    /*   function getDissComponentNo($labref) {
      $this->db->select_max('component_no');
      $this->db->where('labref', $labref);
      $query = $this->db->get('dissolution_tabs_caps');
      return $result = $query->result();
      // print_r($result);
      } */

    public function getDissComponentNo($labref, $component) {

        $query = $this->db->query("SELECT MAX( component_no ) as component_number , component
                                    FROM `dissolution_tabs_caps`
                                    WHERE labref = '$labref' AND component='$component'");
        $row = $query->result();

        $mydata = $row[0]->component_number;
        if (empty($mydata)) {
            $query = $this->db->select_max('component_no', 'component_number')
                    ->where('labref', $labref)
                    ->get('dissolution_tabs_caps')
                    ->result();
            $row_data = $query[0]->component_number + 1;
            return $mydata = $row_data;
        } else {
            return $mydata;
        }
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
                            FROM `dissolution_tabs_caps`
                            WHERE labref = '$labref'
                            )x");
        $result = $query->result();
        return $result;
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

    public function base_params($data) {
        $data['title'] = "Dissolution";
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

?> 