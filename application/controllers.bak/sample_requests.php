<?php

//error_reporting(0);

class Sample_requests extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
        
    }
    
    function homepage(){
        echo 'Select component , Assay run and/or Dissolution Run from the panel on the left to load data here!';
    }
    
 function loadsubmissions($labref) {
        $data['labref'] =$labref= $this->uri->segment(3);           
        $data['r'] =$r= $this->uri->segment(4);
        $data['c'] = $c=$this->uri->segment(5);        
         $data['worksheetInfo'] = $this->getWorksheetInfo($labref, $r, $c);
        $data['posting_summary']=  $this->checkPostingSummary($labref);
        $data['settings_view'] = 'sample_v';
        $this->base_params($data);
    }
    public function index() {
        $data['samples'] = $this->getSampleRequests();
        $data['settings_view'] = "sample_v_labrefs";
        $this->base_params($data);
    }

    public function samples() {
        error_reporting(0);
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);        
        $data['labref'] = $this->uri->segment(3);
        $data['r'] = $this->uri->segment(4);
        $data['c'] = $this->uri->segment(5);
        //$data['no_of_pages'] = $this->printPages($labref);
        //$data['no_of_repeats']=  $this->repeatPage($labref,$c);
        //$data['no_of_drepeats']=  $this->repeatDPage($labref,$c);
        $data['stdweight'] = $this->getStandard($labref, $r, $c);
        $data['worksheetInfo'] = $this->getWorksheetInfo($labref, $r, $c);
        $data['stddesired'] = $this->getStandardDesired($labref, $r, $c);
        $data['sample_assay'] = $this->getSampleAssay($labref, $r, $c);
        $data['sample_assay_desired'] = $this->getSampleAssayDesired($labref, $r, $c);
        $data['dissolutionts'] = $this->getDissolutionTabsCaps($labref, $r, $c);
        $data['dissolutionData'] = $this->getOtherDissolutionData($labref, $r, $c);
        $data['diss_conds_conc'] = $this->getDissCondsConclusion($labref, $r, $c);
        $data['tabs'] = $this->getTabletCaps($labref, $r);
        $data['unassay'] = $this->getUniformityAssay($labref, $c);
        $data['area_absorb']=  $this->getAbsorbancesAreas($labref, $r, $c);
        $data['pareas']=  $this->getPeakAreas($labref, $r, $c);
        $data['stage_2_conds']=  $this->getStage2Conds($labref, $r, $c);
        $data['stage_2_subsequent']=  $this->getStage2Subsequent($labref, $r, $c);
        $data['component_name'] = $this->findComponentNameM($labref, $r, $c);
        $data['posting_summary']=  $this->checkPostingSummary($labref);
         $data['assay_standard_ab'] = $this->getAssayStandardABM($labref, $r, $c);
        $data['assay_stdpeaks_ab'] = $this->getAssayPeakStdAB($labref, $r,$c);
        $data['assay_samplepeaks'] = $this->getAssayPeakSample($labref, $r,$c);
       
        $this->load->view('final_samples_v',$data);       
    }
    function getAssayStandardABM($labref, $r, $c) {

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('multiple_assaystdab');
        return $result = $query->result();
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
    

    function getSubsequentDillutions($labref, $r, $c) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $query = $this->db->get('diss_subsequent_dillutions');
        return $result = $query->result();
    }

    
     function checkPostingSummary($labref) {
        return $this->db
                        ->where('labref', $labref)
                        ->where('component', 'sample_summary')
                        ->get('posting_status')
                        ->num_rows();
    }
    
        function components($labref) {
        echo json_encode($this->db
                        ->distinct()
                        ->select('component,component_no')
                        ->where('labref', $labref)
                        ->where('test_name','assay')
                       //->or_where('test_name','assay')
                        ->get('tests_done')
                        ->result());
    }
    function project(){
        $this->load->view('file_exists_v',$data);
    }

    function findComponentNameM($labref, $r, $c) {

        $db=  $this->db->query("SELECT DISTINCT labref, repeat_status, component_no, component
                                FROM (

                                SELECT labref, repeat_status, component_no, component
                                FROM diss_data
                                UNION ALL
                                SELECT labref, repeat_status, component_no, component
                                FROM multiple_assaystdab
                                GROUP BY labref DESC
                                )x
                                WHERE component_no = '$c'
                                AND labref = '$labref'
                                AND repeat_status = '$r'"
                              );
        return $db->result();
        
    }

    public function getStandard($labref, $r, $c) {
        $this->db->select('weight');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_assaystdab');
        /* $sql= $this->db->query("SELECT assaystdab.weight
          FROM assaystdab
          WHERE assaystdab.labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getWorksheetInfo($labref) {
        $this->db->select('request.request_id, request.active_ing, request.label_claim, request.product_name');
        $this->db->where('request.request_id', $labref);
        $sql = $this->db->get('request');
        /* $sql= $this->db->query("SELECT request.request_id, request.active_ing,request.label_claim, sample_information.chemical_name
          FROM request,sample_information
          WHERE request.request_id ='NDQB2012832' AND sample_information.lab_ref_no='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    /* public function getCaps($labref,$r) {
      $this->db->select('actual_average,cstatus');
      $this->db->where('labref', $labref);
      $this->db->where('repeat_status', $r);
      $sql = $this->db->get('weight_caps_ta');
      if ($sql->num_rows() > 0) {
      foreach ($sql->result() as $value) {
      var_dump($data = $value);
      // $data[1]=$value;
      }

      return $data;
      } */

    public function getTabletCaps($labref, $r) {
        $this->db->select('average');
        $this->db->where('labref', $labref);
        //$this->db->where('component_no',$c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('caps_tabs_data');
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getStandardDesired($labref, $r, $c) {
        $this->db->select('desired_weight,concetration,potency');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_assay_desiredw');
        /* $sql= $this->db->query("SELECT desired_weight
          FROM assay_desiredw
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getSampleAssay($labref, $r, $c) {

        $this->db->select('powder_weight, api_weight,concetration');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_sample_assay_abc');

        /* $sql= $this->db->query("SELECT powder_weight, api_weight
          FROM sample_assay_abc
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getDissolutionTabsCaps($labref, $r, $c) {

        $this->db->select('tab_caps_weights');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('dissolution_tabs_caps');

        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
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

    function getPeaks($labref, $r) {
        $this->db->select('peak1,peak2,peak3,peak4');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('multiple_assay_desiredw');
        return $query->result();
    }

    public function getOtherDissolutionData($labref, $r, $c) {
        $this->db->select('desired_weight, stda,stdb,desired_conc,tabs_caps_mean');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('diss_data');

        /* $sql= $this->db->query("SELECT powder_weight, api_weight
          FROM sample_assay_desiredw
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getSampleRequests() {
        $analyst_id = $this->session->userdata('user_id');

        /*$sql = $this->db->query("SELECT DISTINCT labref,analyst_id
FROM
(
    SELECT labref,analyst_id
    FROM multiple_assaystdab
    UNION ALL
    SELECT labref, analyst_id
    FROM diss_data
    GROUP BY labref 
) x WHERE analyst_id='$analyst_id'");
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;*/
        return $this->db->where('analyst_id',$analyst_id)->group_by('labref')->get('tests_done')->result();
    }

    public function getSampleAssayDesired($labref, $r, $c) {
        $this->db->select('powder_weight, api_weight');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_sample_assay_desiredw');
        /* $sql= $this->db->query("SELECT powder_weight, api_weight
          FROM sample_assay_desiredw
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }    

    function printPages($labref) {
        $dataSource = $this->getAssayMultipleCount($labref);
        $limit = $dataSource[0]->totalRows;
        return $numbers = range(1, $limit);
    }
    function repeatPage($labref,$component_no ){   
        $paging=  $this->getRepeats($labref, $component_no);
        $limit = $paging[0]->totalRows;
       return range(1, $limit);
    }
      function repeatDPage($labref,$component_no ){   
        $paging=  $this->getDRepeats($labref, $component_no);
        $limit = $paging[0]->totalRows;
       return range(1, $limit);
    }
    
    function getRepeats_Assay($labref,$component_no){
      
$query = $this->db->query("

                            SELECT DISTINCT component, repeat_status
                            FROM `multiple_assaystdab`
                            WHERE labref = '$labref'
                            AND component_no = '$component_no'
                            ");
 $result=  $query->result();
 echo json_encode($result);


    }
    
    
        function getRepeats_Dissolution($labref,$component_no){
      
$query = $this->db->query("

                            SELECT DISTINCT component, repeat_status
                            FROM `dissolution_tabs_caps`
                            WHERE labref = '$labref'
                            AND component_no = '$component_no'
                            ");
 $result=  $query->result();
 echo json_encode($result);


    }

    function getAssayMultipleCount($labref) {
        $query = $this->db->query("SELECT COUNT(*) as totalRows
                            FROM(
                            SELECT DISTINCT component
                            FROM `multiple_assay_desiredw`
                            WHERE labref = '$labref'
                            )x");
        $result = $query->result();
        return $result;
    }
    
    

    public function getWorksheet() {
        $data['labref'] = $this->uri->segment(3);
        $data['r'] = $this->uri->segment(4);
        $data['settings_view'] = 'worksheet_v';
        $this->base_params($data);
    }

    public function base_params($data) {
        $data['title'] = "Sample Requests";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
