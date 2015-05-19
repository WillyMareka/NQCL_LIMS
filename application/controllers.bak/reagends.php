<?php

class Reagends extends MY_Controller {

    public function index() {

        $data = array();
        $data['settings_view'] = "reagends_v";
        $this->base_params($data);
    }    
        public function get_reagend_names() {
        $Q = $this->db->get('reagents');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['name'];
                // $data[$row['id']] = $row['id'];
                
            }
        }
        $Q->free_result();
       echo json_encode( $data);
    }
        public function get_reagend_manufacture() {
        $Q = $this->db->get('reagents');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['manufacturer'];
                // $data[$row['id']] = $row['id'];
              //  echo json_encode($data);
                
            }
        }
        $Q->free_result();
        echo json_encode( $data);
    }
    

    public function base_params($data) {
        $data['title'] = "Reagends Used";
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