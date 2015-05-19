<?php

class References extends MY_Controller {

    public function index() {

        $data = array();
        $data['settings_view'] = "references_v";
        $this->base_params($data);
    }    
       

    public function base_params($data) {
        $data['title'] = "Reference Substances";
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