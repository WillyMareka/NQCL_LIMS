<?php

class Ex_cont extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['settings_view'] = 'samples_uploaded_view_1';
        $this->base_params($data);
    }

    function elfinder_init() {
        $this->load->helper('path');
        $opts = array(
            // 'debug' => true, 
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './application/',
                    'URL' => base_url() . '/application/',
                    'accessControl' => 'access',
                    'enabled' => array('edit', 'rename', 'cut', 'copy','delete','trash'),
                    'dotFiles' => false,
                    'tmbDir' => '_tmb',
                    'arc' => '7za',
                    'defaults' => array('read' => true, 'write' => true, 'rm' => true)
                ),
            ),
        );
        $this->load->library('elfinder_lib', $opts);
    }

    public function base_params($data) {

        $data['title'] = "Uploaded Worksheet ";
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
