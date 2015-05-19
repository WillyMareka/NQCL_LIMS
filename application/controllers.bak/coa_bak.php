<?php

class Coa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('dompdf_lib');
    }

    function generateCoa($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        // $data['tests_requested_display'] = $this->getRequestedTestsDisplay($labref);
        $data['compedia_specification'] = $this->getCOABody($labref);
        $data['settings_view'] = 'coa_v';
        $this->base_params($data);
      //  $html = $this->load->view('coa_v', $data, true);
      //  $this->dompdf_lib->createPDF($html, $labref);
    }

    function saveCOA() {
        $labref = $this->uri->segment(3);
        $test_id = $this->getRequestedTestIds($labref);
        if ($this->checkIfCOABodyExists($labref) == '1') {
            $data = $this->input->post('compedia');
            $data1 = $this->input->post('specification');
            count($data) == count($test_id); //Always True!
            for ($i = 0; $i < count($data); $i++) {
                $update_data = array(
                    
                    'compedia' => $data[$i],
                    'specification' => $data1[$i]
                );
                $this->db->where('labref', $labref);
                $this->db->where( 'test_id',$test_id[$i]['test_id']);
               $this->db->update('coa_body', $update_data);
            }
            $this->coaIsDraftedUpdate($labref);
            $this->generateCoaDraft($labref);
        } else {
            $data = $this->input->post('compedia');
            $data1 = $this->input->post('specification');
            count($data) == count($data1) && count($data) == count($test_id); //Always True!
            for ($i = 0; $i < count($data); $i++) {
                $insert_data = array(
                    'labref' => $labref, //NDQA201303001 - Same for all the rows
                    'test_id' => $test_id[$i]['test_id'],
                    'compedia' => $data[$i],
                    'specification' => $data1[$i]
                );
                $this->db->insert('coa_body', $insert_data);
            }
            $this->generateCoaDraft($labref);
        }
    }

    function coaIsDraftedUpdate($labref){
        $coaUpdate=array('coa'=>'1');
        $this->db->where('labref',$labref);
        $this->db->update('coa_draft_status',$coaUpdate);
    }
    function getCOABody($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        $result = $query->result();
        return $result;
        //print_r($result);
    }

    function checkIfCOABodyExists($labref) {
        $this->db->select('labref');
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function generateCoaDraft($labref,$offset=0) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['compedia_specification'] = $this->getCOABody($labref);
       $html = $this->load->view('coa_v', $data, true);
       $this->dompdf_lib->createPDF($html, $labref);
    }

    function makeCoaSecondPart($labref) {
        $cd = $this->getCOABody($labref);
        for ($i = 0; $i < count($cd); $i++) {
            echo $cd[$i]->compedia;
        }
    }

    function getRequestInformation($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        return $Information;
    }

    function getRequestedTests($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
                    return $object->name;
                }, $result);
        return $tests = implode(', ', $output);
    }

    function getRequestedTestIds($labref) {
        $this->db->select('test_id');
        $this->db->from('coa_body');
        //$this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('labref', $labref);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
        // print_r($result);
    }

    function getRequestedTestsDisplay($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getRequestedTestsDisplay2($labref) {
        $query = $this->db->query("SELECT `name` , `compedia` , `specification`
                                 FROM (
                                       `tests` t, `coa_body` cb
                                       )
                                JOIN `request_details` rd ON `t`.`id` = `cb`.`test_id`
                                WHERE `rd`.`request_id` = '$labref'
                                AND cb.labref = '$labref'
                                GROUP BY name
                                LIMIT 0 , 30");
        $result = $query->result();

        return $result;
        // print_r($result);
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "COA - " . $labref;
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

