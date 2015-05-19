<?php
//error_reporting(0);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Final_Submission extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->loadsubmissions();
    }

    function loadsubmissions($labref) {
        $data['labref'] = $labref=$this->uri->segment(3);
        $data['testdata'] = $this->load_tests($labref);
        $data['upload_status']=  $this->checkUploaded($labref);
        $data['settings_view'] = 'analyst_final_submission_v';
        $this->base_params($data);
    }
    
    
    function microbial_assay($labref) {
       $data['labref'] = $labref=$this->uri->segment(3);    
        $this->load->view('microbial_assay',$data);
    }
        function bacterial_endotoxin($labref) {
        $data['labref'] = $labref=$this->uri->segment(3);    
        $this->load->view('micro_endotoxin',$data);
    }
    

    function uniformity_of_weight() {
        $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
        $data['labrefuri'] = $labref;
        $data['labref'] = $labref;
        $rawform = $this->justBringDosageForm($labref);
        $dosageForm = $rawform[0]->dosage_form;
        if ($dosageForm == "2") {
            $data['caps_results'] = $this->getCaps_v($labref, $r);
            $data['caps_ta'] = $this->getUniformityTotal($labref, $r);
            $data['date'] = $this->getDate($labref);
            $this->load->view('uniformity_r_v_1', $data);
        } else if ($dosageForm == "1") {
            $data['tabs_results'] = $this->getTabs_v($labref, $r);
            $data['tabs_ta'] = $this->getTabsTotal($labref, $r);
            $data['date'] = $this->getDate($labref);
            $this->load->view('tabs_r_v_1', $data);
        }
    }

    function justBringDosageForm($labref) {
        $this->db->select('dosage_form');
        $this->db->from('dosage_form df');
        $this->db->join('request r', 'df.id=r.dosage_form');
        $this->db->where('r.request_id', $labref);
        $query = $this->db->get();
        return $result = $query->result();
        //print_r($result);
    }

    function getTabs_v($labref, $r) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets');
        return $result = $query->result();
    }

    function getTabsTotal($labref, $r) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets_ta');
        return $result = $query->result();
    }

    function uniformity_of_weight_repeat($labref) {
        $rawform = $this->justBringDosageForm($labref);
        $dosageForm = $rawform[0]->dosage_form;
        if ($dosageForm == "2") {
            echo json_encode($this->db
                            ->select('repeat_status')
                            ->where('labref', $labref)
                            ->group_by('repeat_status')
                            ->get('weight_caps_ta')
                            ->result());
        } else if ($dosageForm == "1") {
            echo json_encode($this->db
                            ->select('repeat_status')
                            ->where('labref', $labref)
                            ->group_by('repeat_status')
                            ->get('weight_tablets_ta')
                            ->result());
        }
    }

    function getDate($labref) {
        return $this->db
                        ->select('date_time')
                        ->where('labref', $labref)
                        ->where('component', 'uniformity')
                        ->get('posting_status')
                        ->result();
    }

    function Identification() {
        $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
        $data['labrefuri'] = $labref;
        $data['labref'] = $labref;
        $data['identification'] = $this->findIdentification($labref, $r);
        $this->load->view('identification_r_v_1', $data);
    }

    function findIdentification($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('identification')
                        ->result();
    }

    function Identification_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('identification')
                        ->result());
    }

    function dissolution() {
        $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
        $data['labrefuri'] = $labref;
        $data['labref'] = $labref;
        $data['diss_conds_conc'] = $this->getDissCondsConclusion($labref, $r, $c);
        $data['subsequent'] = $this->getSubsequentDillutions($labref, $r, $c);
        $data['diss_tabs'] = $this->getTabsData($labref, $r, $c);
        $data['diss_std_prep'] = $this->getDissoulutionStdPrep($labref, $r, $c);
        $data['component_name'] = $this->findComponentNameMD($labref, $r, $c);
        $data['area_absorb']=  $this->getAbsorbancesAreas($labref, $r, $c);
        $data['pareas']=  $this->getPeakAreas($labref, $r, $c);
        $data['stage_2_conds']=  $this->getStage2Conds($labref, $r, $c);
        $data['stage_2_subsequent']=  $this->getStage2Subsequent($labref, $r, $c);
        $this->load->view('dissolution_r_v_1', $data);
    }

    function dissolution_components($labref) {
        echo json_encode($this->db
                        ->distinct()
                        ->select('component,component_no')
                        ->where('labref', $labref)
                        ->get('diss_data')
                        ->result());
    }

    function dissolution_repeat($labref, $r) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->where('component_no', $r)
                        ->group_by('repeat_status')
                        ->get('diss_data')
                        ->result());
    }
    
     function getStage2Conds($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('buff_diss_mean');
        return $result = $query->result();
    }
     function getStage2Subsequent($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('dissbuffer_subsequent_dillutions');
        return $result = $query->result();
    }

    function getDissCondsConclusion($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('diss_mean');
        return $result = $query->result();
    }
    
       function getAbsorbancesAreas($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('dissolution_areas_absorbance');
        return $result = $query->result();
    }
    
      function getPeakAreas($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('diss_peak_areas_stdab');
        return $result = $query->result();
    }
    

    function getSubsequentDillutions($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('diss_subsequent_dillutions');
        return $result = $query->result();
    }

    function getTabsData($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('dissolution_tabs_caps');
        return $result = $query->result();
    }

    function getDissoulutionStdPrep($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('diss_stdassay_prep`');
        return $result = $query->result();
    }

    function findComponentNameMD($labref, $r, $c) {
        $this->db->select('component');
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->group_by('component');
        $query = $this->db->get('dissolution_tabs_caps');
        return $result = $query->result();
    }

    function assay() {
        $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
        $data['labrefuri'] = $labref;
        $data['labref'] = $labref;
        $data['assay_desired_weight'] = $this->getDesiredWeightDataM($labref, $r, $c);
        $data['assay_standard_ab'] = $this->getAssayStandardABM($labref, $r, $c);
        $data['assay_stdpeaks_ab'] = $this->getAssayPeakStdAB($labref, $r,$c);
        $data['assay_samplepeaks'] = $this->getAssayPeakSample($labref, $r,$c);
        $data['sample_assay_desired_weight'] = $this->getSampleAssayDesiredWeightM($labref, $r, $c);
        // print_r( $data['sample_assay_desired_weight'] );
        $data['sample_assay_standars_abc'] = $this->getSampleAssayStandardABCM($labref, $r, $c);
        $data['component_name'] = $this->findComponentNameM($labref, $r, $c);
        $this->load->view('assay_r_v_1', $data);
    }
    
    function getAssayPeakStdAB($labref,$r,$c){
       $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('peak_areas_stdab');
        return $result = $query->result();  
    }
    function getAssayPeakSample($labref,$r,$c){
       $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('peak_areas_sample');
        return $result = $query->result();  
    }

    function assay_components($labref) {
        echo json_encode($this->db
                        ->distinct()
                        ->select('component,component_no')
                        ->where('labref', $labref)
                        ->get('multiple_assaystdab')
                        ->result());
    }

    function assay_repeat($labref, $r) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->where('component_no', $r)
                        ->group_by('repeat_status')
                        ->get('multiple_assaystdab')
                        ->result());
    }

    function getDesiredWeightDataM($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('multiple_assay_desiredw');
        return $result = $query->result();
    }

    function getAssayStandardABM($labref, $r, $c) {

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('multiple_assaystdab');
        return $result = $query->result();
    }

    function getTabsCapsDataM($labref, $r) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('caps_tabs_data');
        return $result = $query->result();
    }

    function getSampleAssayDesiredWeightM($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('multiple_sample_assay_desiredw');
        return $result = $query->result();
    }

    function getSampleAssayStandardABCM($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('multiple_sample_assay_abc');
        return $result = $query->result();
    }

    function findComponentNameM($labref, $r, $c) {
        $this->db->select('component');
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->group_by('component');
        $query = $this->db->get('multiple_assaystdab');
        return $result = $query->result();
    }

    function getCaps_v($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('r_status', $r);
        $query = $this->db->get('weight_uniformity');
        return $result = $query->result();
    }

    function getUniformityTotal($labref, $r) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_caps_ta');
        return $result = $query->result();
    }

    function load_tests($labref) {
        $analyst_id = $this->session->userdata('user_id');
        $query = $this->db->select('t.name')
                ->from('tests t')
                ->join('sample_issuance si', 'si.test_id=t.id')
                ->where('si.lab_ref_no', $labref)
                ->where('si.analyst_id', $analyst_id)
                ->get()
                ->result();

        return $query;
    }

    function getUniRepeats($labref) {
        echo json_encode(
                $this->db
                        ->select('r_status')
                        ->where('labref', $labref)
                        ->group_by('r_status')
                        ->get('weight_uniformity')
                        ->result()
        );
    }

    function disintegration() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['disintegration_data'] = $this->getDisintegrationData($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('disintegration_r_v_1', $data);
    }

    function getDisintegrationData($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('disintegration')
                        ->result();
    }

    function disintegration_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('disintegration')
                        ->result());
    }
    
    
    function uniformity_of_content() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['uoc'] = $this->getUOCData($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('uniformity_of_contents_r_v_1', $data);
    }

    function getUOCData($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('uniformity_of_content')
                        ->result();
    }

    function uniformity_of_content_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('uniformity_of_content')
                        ->result());
    }
    
     function weight_variation() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['uoc'] = $this->getWVARData($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('weight_variation_r_v_1', $data);
    }

    function getWVARData($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('weight_variation')
                        ->result();
    }

    function weight_variation_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('weight_variation')
                        ->result());
    }



    function friability() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['friability_data'] = $this->getFriabilityData($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('friability_r_v_1', $data);
    }

    function getFriabilityData($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('friability')
                        ->result();
    }

    function friability_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('friability')
                        ->result());
    }
    
        function viscosity() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['viscosity_data'] = $this->getViscosityData($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('viscosity_r_v_1', $data);
    }

    function getViscosityData($labref, $r) {
       return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('viscosity')
                        ->result();
    }
    

    function viscosity_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('viscosity')
                        ->result());
    }
    
         function related_substances() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['rs'] = $this->getRSData($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('related_substances_r_v_1', $data);
    }

    function getRSData($labref, $r) {
       return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('related_substances')
                        ->result();
    }
    

    function related_substances_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('related_substances')
                        ->result());
    }


    function pH() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['ph_top'] = $this->getpHa($labref, $r);
        $data['ph_bottom'] = $this->getpHb($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('pHv_r_v_1', $data);
    }

    function getpHa($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('ph_top')
                        ->result();
    }

    function pH_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('ph_bottom')
                        ->result());
    }

    function getpHb($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('ph_bottom')
                        ->result();
    }

    function Refractive_index() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['ph_top'] = $this->getRta($labref, $r);
        $data['ph_bottom'] = $this->getRtb($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('refractive_index_r_v_1', $data);
    }

    function getRta($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('refractive_index_top')
                        ->result();
    }

    function Refractive_index_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('refractive_index_top')
                        ->result());
    }

    function getRtb($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('refractive_index_bottom')
                        ->result();
    }

    function Relative_density() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['rda'] = $this->getRda($labref, $r);
        $data['rdb'] = $this->getRdb($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('relative_density_r_v_1', $data);
    }

    function getRda($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('relative_density_a')
                        ->result();
    }

    function getRdb($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('relative_density_b')
                        ->result();
    }

    function Relative_density_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('relative_density_b')
                        ->result());
    }
    
    function melting_point() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['rda'] = $this->getMpa($labref, $r);
        $data['rdb'] = $this->getMpb($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('melting_point_r_v_1', $data);
    }

    function getMpa($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('melting_point_a')
                        ->result();
    }

    function getMpb($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('melting_point_b')
                        ->result();
    }

    function Melting_point_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('melting_point_b')
                        ->result());
    }
    
      function sterility() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['s_data']=  $this->getSterility($labref ,$r);      
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('sterility_r_v_1', $data);
    }

    function getSterility($labref, $r) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('repeat_status', $r)
                        ->get('sterility')
                        ->result();
    }
    
      function sterility_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('sterility')
                        ->result());
    }
    
    function sterility_components($labref) {
        echo json_encode($this->db
                        ->distinct()
                        ->select('component,component_no')
                        ->where('labref', $labref)
                        ->get('sterility')
                        ->result());
    }
    
       function microbial_load() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['s_data']=  $this->getDataA($labref ,$r);       
        $data['b_data']=  $this->getDataB($labref ,$r);   
        $data['comspe'] = $this->findComSpec($labref);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('microbial_load_r_v_1', $data);
    }

 function getDataA($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('microbial_load_body')->result();
    }
     function getDataB($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('microbial_load_top')->result();
    }
    function findComSpec($labref){
        return $this->db->where('labref',$labref)->where('test_id',14)->get('coa_body')->result();
    }
      function microbial_load_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('microbial_load_top')
                        ->result());
    }
    
       function microbial_load_components($labref) {
        echo json_encode($this->db
                        ->distinct()
                        ->select('component,component_no')
                        ->where('labref', $labref)
                        ->get('microbial_load_top')
                        ->result());
    }
    
    function preservative_efficacy(){
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $data['d_count']=  $this->getDaycount($labref ,$r);
        $data['d_countb']=  $this->getDaycountB($labref ,$r);
        $data['d_average']=  $this->getDayAverage($labref ,$r);
        $data['d_info']=  $this->getTopInfo($labref ,$r);     
        $data['comspec']=  $this->getComSpec($labref ,$r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $this->load->view('preservative_efficacy_r_v_1', $data);  
    }
    
       
    function getDaycount($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_day_count')->result();
    }
     function getDayAverage($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_day_count_average')->result();
    }
     function getDayCountB($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_day_count_b')->result();
    }
     function getTopInfo($labref,$r) {
        return $this->db->where('labref',$labref)->where('repeat_status',$r)->get('pt_top_info')->result();
    }
     function getComSpec($labref,$r) {
        return $this->db->where('labref',$labref)->where('test_id',15)->get('coa_body')->result();
    }
    
        function preservative_efficacy_repeat($labref) {
        echo json_encode($this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->group_by('repeat_status')
                        ->get('pt_top_info')
                        ->result());
    }
    
       function preservative_efficacy_components($labref) {
        echo json_encode($this->db
                        ->distinct()
                        ->select('component,component_no')
                        ->where('labref', $labref)
                        ->get('pt_top_info')
                        ->result());
    }
    

   

    function home_page() {
        echo 'Select a test from the left pane';
    }

    public function base_params($data) {
        $data['content_view'] = 'settings_v_1';
        $data['title'] = 'Final Submission';
        $this->load->view('template', $data);
    }

}
