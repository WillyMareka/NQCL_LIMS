<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Test_1 extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    
    function show(){
      $salt = '#*seCrEt!@-*%';
      $data="";
      echo md5($salt.$data);
    }
    
    
    function get_username(){
        $username=array(
          'username'=>'alphy',
            'password'=>'tatatatatatatat',
            'uid'=>7
            
        );
        return $username;
       
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
