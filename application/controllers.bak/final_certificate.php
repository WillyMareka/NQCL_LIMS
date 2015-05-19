<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Final_certificate extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['samples'] = $this->getAllCertificates();
        $data['settings_view'] = 'certificates_v';
        $data['title'] = "Certificates";
        $this->base_params($data);
    }

    function getAllCertificates() {
        return $this->db->group_by('labref')->get('coa_body')->result();
    }

    public function base_params($data) {

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
