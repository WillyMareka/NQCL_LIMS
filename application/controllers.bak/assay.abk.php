<?php

class Assay extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }
    
  public function assay_page() {
        $labref = $this->uri->segment(3);
          $redirect = $this->uniformityExists($labref);
          $uniformity_done=  $this->checkUniformityStatus($labref);
          if($redirect==1 && $uniformity_done==1){
             redirect('assay/assay_worksheet/' . $labref);
          }elseif ($redirect==1 && $uniformity_done!=1) {
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = "uniformity_error_v";
            $data['error'] = $this->getError();
            $this->base_params($data); 
        }else if($redirect!=1 && $uniformity_done!=1){
            redirect('assay/assay_worksheet/' . $labref);
        }
    
    }
    public function assayPetition() {
        error_reporting(1);
        $labref = $this->uri->segment(3);
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = "assay_v_1";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $data['unassay'] = $this->getUniformityAssay($labref);
        $data['unassay'] = $this->getUniformityAssay($labref);
        $this->base_params($data);
    }

    public function assayMultiplePetition() {
        error_reporting(1);
        $labref = $this->uri->segment(3);
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = "assay_multiple_v_1";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $data['unassay'] = $this->getUniformityAssay($labref);
        $data['unassay'] = $this->getUniformityAssay($labref);
        $this->base_params($data);
    }

    public function worksheet() {
        $worksheet_name = $this->uri->segment(1);
        if ($worksheet_name == "assay") {
            $this->assay_page();
        } else {

            $this->assay_worksheet();
        }
    }

    public function assay_worksheet() {
        $data = array();
        $labref = $this->uri->segment(3);
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = "assay_v";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $data['unassay'] = $this->getUniformityAssay($labref);
        //$data['unassay'] = $this->getUniformityAssay($labref);

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
        error_reporting(0);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['settings_view'] = "assay_multiple_v";
        $data['unassay'] = $this->getUniformityAssay($labref);
        $this->base_params($data);
    }

    public function testinput() {
        $this->output->enable_profiler();
    }

    public function save_assay_multiple() {
        if ($_POST):
            $table_suffix = 'multiple_';
            $labref = $this->uri->segment(3);
            $analyst_id = $this->session->userdata('user_id');

            $max_row_id = $this->getTestAssayRepeatStatusM($labref);
            (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
            
            
            $max_component_row_id = $this->getTestAssayComponentNo($labref);
            (int) $new_status_component = (int) $max_component_row_id[0]->component_no + 1;

            $assaySTD = array(
                'labref' => $labref,
                'component' => $this->input->post('heading'),
                'component_no'=>$new_status_component,
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
                'analyst_id' => $analyst_id
            );
            $this->db->insert($table_suffix . 'assay_desiredw', $assaySTD);

            $assayA = array(
                'labref' => $labref,
                'component' => $this->input->post('heading'),
                'component_no'=>$new_status_component,
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
                'component_no'=>$new_status_component,
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
                'component_no'=>$new_status_component,
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
                'analyst_id' => $analyst_id
            );

            $this->db->insert($table_suffix . 'sample_assay_desiredw', $desired_abc_sample);



            //$this->setDoneStatus($labref);
            $array = array(
                0 => array('labref' => $labref, 'powder_weight' => $pwnumber, 'component' => $component,'component_no'=>$new_status_component, 'api_weight' => $aiweight, 'vf1' => $svf1, 'pipette1' => $sp1, 'vf2' => $svf2, 'pipette2' => $pipette2, 'vf3' => $vf3, 'pipette3' => $pipette3, 'vf4' => $vf41, 'concetration' => $smgml, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
                , 1 => array('labref' => $labref, 'powder_weight' => $sampleA, 'component' => $component,'component_no'=>$new_status_component, 'api_weight' => $u_weighta, 'vf1' => $svf11, 'pipette1' => $sp11, 'vf2' => $svf12, 'pipette2' => $spf1, 'vf3' => $svf13, 'pipette3' => $spf21, 'vf4' => $svf14, 'concetration' => $smgml1, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
                , 2 => array('labref' => $labref, 'powder_weight' => $sampleB, 'component' => $component,'component_no'=>$new_status_component,'api_weight' => $u_weightb, 'vf1' => $svf111, 'pipette1' => $sp12, 'vf2' => $svf22, 'pipette2' => $spf2, 'vf3' => $svf23, 'pipette3' => $spf33, 'vf4' => $svf241, 'concetration' => $smgml2, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
                , 3 => array('labref' => $labref, 'powder_weight' => $sampleC, 'component' => $component,'component_no'=>$new_status_component, 'api_weight' => $u_weightc, 'vf1' => $svf3, 'pipette1' => $ssp3, 'vf2' => $svf33, 'pipette2' => $spf3, 'vf3' => $svf24, 'pipette3' => $spf4, 'vf4' => $svf25, 'concetration' => $smgml3, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
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
            if ($k) {
                $this->save_testM();
                  $this->updateTestIssuanceStatus();
                echo 'Saved';
            } else {
                echo mysql_error();
            }

            echo true;
        else:
            echo false;
        endif;
    }

    public function save_assay_single() {        // $this->output->enable_profiler();
        //$this->load->database();
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');

        $max_row_id = $this->getTestAssayRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;

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
            'analyst_id' => $analyst_id
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
            'analyst_id' => $analyst_id
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
            'analyst_id' => $analyst_id
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
            'analyst_id' => $analyst_id
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


        if ($k) {
            redirect('analyst_controller');
        } else {
            echo mysql_error();
        }
    }
        
     function updateTestIssuanceStatus(){
       $labref=  $this->uri->segment(3);
       $test_id=  $this->uri->segment(4);
       $analyst_id=  $this->session->userdata('user_id');
       $done_status ='1';
       $data= array(
         'done_status'=>$done_status  
       );
       $this->db->where('lab_ref_no',$labref);
       $this->db->where('test_id',5);
       $this->db->where('analyst_id',$analyst_id);
       $this->db->update('sample_issuance',$data);
       
    }

    public function getTestAssayRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('assaystdab');
        return $row = $query->result();
    }
       public function getTestAssayRepeatStatusM($labref) {
         $component=  $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component',$component);
        $query = $this->db->get('multiple_assaystdab');
        return $row = $query->result();
    }
       public function getTestAssayComponentNo($labref) {
        $this->db->select_max('component_no');
        $this->db->where('labref', $labref);
        $query = $this->db->get('multiple_assaystdab');
        return $row = $query->result();
    }

    public function checkUniformityStatus($labref) {
        $this->db->select('uniformity_status');
        $this->db->where('labref', $labref);
        $this->db->where('test_type', 'Tablets');
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
        $component=  $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'assay');
        $this->db->where('component',$component);
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
        $labref=  $this->uri->segment(3);
        $max_component_row_id = $this->getTestAssayComponentNo($labref);
        (int) $new_status_component = (int) $max_component_row_id[0]->component_no + 1;
        
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;
        
        $data = $this->check_repeat_statusM();
        $r_status = $data[0]->repeat_status;
        $new_r_status = $r_status + 1;
        $analyst_id = $this->session->userdata('user_id');
        $component=  $this->input->post('heading');

        $final_test_done = array(
            'labref' => $labref,
            'component'=>$component,
            'component_no'=>$new_status_component,
            'test_name' => 'assay',
            'repeat_status' => $new_r_status,
            'test_subject' => 'assa_r_multiple',
            'supervisor_id' => $supervisor_id,
            'analyst_id' => $analyst_id
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

        $this->db->select('average');
        $this->db->where('labref', $labref);
        $sql = $this->db->get('caps_tabs_data');

        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
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
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component_no'] = $component_no = $this->uri->segment(5);
        $data['no_of_pages'] = $this->printPages($labref);
        $data['assay_desired_weight'] = $this->getDesiredWeightDataM($labref, $r, $component_no);
        $data['assay_standard_ab'] = $this->getAssayStandardABM($labref, $r, $component_no);
        $data['assay_tabs_caps'] = $this->getTabsCapsDataM($labref, $r, $component_no);
        $data['sample_assay_desired_weight'] = $this->getSampleAssayDesiredWeightM($labref, $r, $component_no);
        $data['sample_assay_standars_abc'] = $this->getSampleAssayStandardABCM($labref, $r, $component_no);
        $data['component_name'] = $this->findComponentNameM($labref, $r, $component_no);
        $data['settings_view'] = 'assay_r_multiple_v';
        $this->base_params($data);
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

    //===============================END OF MULTIPLE==============================//
    public function getError() {
        $labref = $this->uri->segment(3);
        return $error = "<div class='error' style='color:red'><p ><h2>Error: Uniformity of weight must be done first for sample' $labref'</h2></p></div>";
    }

    public function approve_data() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
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
            'status' => '1'
        );
        $this->db->insert('supervisor_approvals', $approve_data);
        echo 'Approved';
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('test_name', 'assay');
        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            echo 'Already Approved';
        } else {
            $this->approve_data();
        }
    }
    
        public function approveM() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $component_no=  $this->uri->segment(5);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no',$component_no);
        $this->db->where('test_name', 'assay');
        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            echo 'Already Approved';
        } else {
            $this->approve_dataM();
        }
    }
        public function approve_dataM() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;

        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,
            'component'=>$component,
            'component_no'=>$component_no,
            'repeat_status' => $r,
            'test_name' => 'assay',
            'test_product' => 'tablets',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1'
        );
        $this->db->insert('supervisor_approvals', $approve_data);
        echo 'Approved';
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

    public function sendDataFlyingToExcel() {
        if ($_POST):
            //Worksheet Information

            $labref = $this->uri->segment(3);
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


            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
            //$sheet=$objPHPExcel->getActiveSheet();
            $objPHPExcel->getActiveSheet(0)
                    ->setCellValue('I22', 'Standard Preparation For Assay')
                    ->setCellValue('B23', 'Weight')
                    ->setCellValue('C23', 'vf1')
                    ->setCellValue('D23', 'pipette1')
                    ->setCellValue('E23', 'vf2')
                    ->setCellValue('F23', 'pipette2')
                    ->setCellValue('G23', 'vf3')
                    ->setCellValue('H23', 'pipette3')
                    ->setCellValue('I23', 'vf4')
                    ->setCellValue('K23', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A24', 'Desired Weight')
                    ->setCellValue('B24', $weight)
                    ->setCellValue('C24', $vf1)
                    ->setCellValue('D24', $pipette1)
                    ->setCellValue('E24', $vf2)
                    ->setCellValue('F24', $pipette2)
                    ->setCellValue('G24', $vf3)
                    ->setCellValue('H24', $pipette3)
                    ->setCellValue('I24', $vf4)
                    ->setCellValue('K24', $concetration)
                    ->setCellValue('A25', 'Standard A')
                    ->setCellValue('B25', $weightA)
                    ->setCellValue('C25', $vf1A)
                    ->setCellValue('D25', $pipette1A)
                    ->setCellValue('E25', $vf2A)
                    ->setCellValue('F25', $pipette2A)
                    ->setCellValue('G25', $vf3A)
                    ->setCellValue('H25', $pipette3A)
                    ->setCellValue('I25', $vf4A)
                    ->setCellValue('K25', $concetrationA)
                    ->setCellValue('A26', 'Standard B')
                    ->setCellValue('B26', $weightB)
                    ->setCellValue('C26', $vf1B)
                    ->setCellValue('D26', $pipette1B)
                    ->setCellValue('E26', $vf2B)
                    ->setCellValue('F26', $pipette2B)
                    ->setCellValue('G26', $vf3B)
                    ->setCellValue('H26', $pipette3B)
                    ->setCellValue('I26', $vf4B)
                    ->setCellValue('K26', $concetrationB)

                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('I28', 'Sample Preparation For Assay')
                    ->setCellValue('B29', 'Powder Weight')
                    ->setCellValue('C29', 'API Weight')
                    ->setCellValue('D29', 'vf1')
                    ->setCellValue('E29', 'pipette1')
                    ->setCellValue('F29', 'vf2')
                    ->setCellValue('G29', 'pipette2')
                    ->setCellValue('H29', 'vf3')
                    ->setCellValue('I29', 'pipette3')
                    ->setCellValue('J29', 'vf4')
                    ->setCellValue('L29', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A30', 'Desired Weight')
                    ->setCellValue('B30', $pwnumber)
                    ->setCellValue('C30', $aiweight)
                    ->setCellValue('D30', $svf1)
                    ->setCellValue('E30', $sp1)
                    ->setCellValue('F30', $svf2)
                    ->setCellValue('G30', $spipette2)
                    ->setCellValue('H30', $svf3)
                    ->setCellValue('I30', $spipette3)
                    ->setCellValue('J30', $vf41)
                    ->setCellValue('L30', $smgml)
                    ->setCellValue('A31', 'Sample A')
                    ->setCellValue('B31', $sampleA)
                    ->setCellValue('C31', $u_weighta)
                    ->setCellValue('D31', $svf11)
                    ->setCellValue('E31', $sp11)
                    ->setCellValue('F31', $svf12)
                    ->setCellValue('G31', $spf1)
                    ->setCellValue('H31', $svf13)
                    ->setCellValue('I31', $spf21)
                    ->setCellValue('J31', $svf14)
                    ->setCellValue('L31', $smgml1)
                    ->setCellValue('A32', 'Sample B')
                    ->setCellValue('B32', $sampleB)
                    ->setCellValue('C32', $u_weightb)
                    ->setCellValue('D32', $svf111)
                    ->setCellValue('E32', $sp12)
                    ->setCellValue('F32', $svf22)
                    ->setCellValue('G32', $spf2)
                    ->setCellValue('H32', $svf23)
                    ->setCellValue('I32', $spf33)
                    ->setCellValue('J32', $svf241)
                    ->setCellValue('L32', $smgml2)
                    ->setCellValue('A33', 'Sample C')
                    ->setCellValue('B33', $sampleC)
                    ->setCellValue('C33', $u_weightc)
                    ->setCellValue('D33', $svf31)
                    ->setCellValue('E33', $ssp3)
                    ->setCellValue('F33', $svf33)
                    ->setCellValue('G33', $spf3)
                    ->setCellValue('H33', $svf24)
                    ->setCellValue('I33', $spf4)
                    ->setCellValue('J33', $svf25)
                    ->setCellValue('L33', $smgml3)

                    //Other values used
                    ->setCellValue('D38', 'Label Claim')
                    ->setCellValue('D39', 'Tabs or Caps Average')
                    ->setCellValue('D40', 'Procedure Used')
                    ->setCellValue('F38', $labelclaim)
                    ->setCellValue('F39', $tabs_caps_average)
                    ->setCellValue('F40', $procedure);


            // $objWorkSheet->setTitle("Assay");

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

?> 