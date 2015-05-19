<?php 
class Methods extends CI_Controller {
	
	public function index() {
	
		$data=array();
		$data['content_view'] = "methods";
		$this -> base_params($data);
	}
	
	public function base_params($data) {
		$data['title'] = "Inventory";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		//$data['content_view'] = "inventory_v";
		$this -> load -> view('template', $data);
	}
	
}
?>
