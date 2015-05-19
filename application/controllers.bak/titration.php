<?php

class Titration extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function worksheet() {

        $data['settings_view'] = "titration_v";
        $this->base_params($data);
    }

    public function base_params($data) {
        $data['title'] = "Assay Titration";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
