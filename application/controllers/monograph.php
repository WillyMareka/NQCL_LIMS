<?php
class Monograph extends MY_Controller {
	public function index() {
		//$data = array();
		$data['settings_view'] = "monograph_v";
		//$data['info'] =Request::getAll();
		$this -> base_params($data);
	}//end listing
	
	
		public function base_params($data) {
		$data['title'] = "Request Management";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "request";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}
	
	
	
}
?>