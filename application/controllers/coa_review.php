<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Coa_Review extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
   public function draft_coa_review() {
        //error_reporting(1);
      //  $data['labref'] = $this->getLabreferences();
        $data['worksheets'] = $this->worksheets();
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'director_v_2';
        $this->base_params($data);
    }
    
        public function worksheets() {
        $reviewer_id = $this->session->userdata('user_id');
   
        $this->db->where('director_id', $reviewer_id);
        $this->db->where('approval_status', 0);
        $this->db->group_by('folder');
        $query = $this->db->get('directors');
        foreach ($query->result() as $folders) {
            $folder[] = $folders;
        }
        return $folder;
    }
    
        public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "COA Review ";
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

