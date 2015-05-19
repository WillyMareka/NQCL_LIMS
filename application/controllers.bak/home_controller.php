<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home_Controller extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {

		$this -> home();
	}
public function checkurl(){

echo base_url(). "Scipts/fancybox";
$this->load->view('analyst_v_1');

}
	public function home() {

		$data['title'] = "Home";
		$data['settings_view'] = "home_v";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "System Home";
		$data['link'] = "home";
		$this -> load -> view("template", $data);

	}
     function load_stock(){
     	$data['title'] = "Stock level";
     	$data['content_view'] = "stock";
     	$data['scripts'] = array("FusionCharts/FusionCharts.js"); 
		$data['banner_text'] = "System Home";
		$data['quick_link'] ="load_stock";
		$data['link'] = "home";
		$this -> load -> view("template", $data);
		
     }
 

}
