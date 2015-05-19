<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Protected_area extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function index(){
        $data['settings_view']='protected_v';
        $this->base_params($data);
    }
     public function base_params($data) {
		$data['title'] = "Protected Area Access";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");		
		$data['content_view'] = "settings_v";
		//$data['banner_text'] = "NQCL Settings";
		//$data['link'] = "settings_management";

		$this -> load -> view('template', $data);

}
}

