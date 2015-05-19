<?php
class Column_management extends CI_Controller{
	
	public function index() {
	


	}

	public function issue(){

		$data['analysts'] = User::getAllAnalysts();
		$this -> load -> view('columns_issue_v', $data);
	
	}


	public function issueslist(){





	}

	
	public function issuesave(){

		

	
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