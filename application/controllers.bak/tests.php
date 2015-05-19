<?php
	class Tests extends CI_Controller {
		public function methods(){
			//$reqid = $this -> uri -> segment(3);
			$test_id = $this -> uri -> segment(3);
			$data['methods']= Test_methods::getMethods($test_id);
			$data['content_view'] = "methods_v";
			$this -> load -> view('template1', $data);
			
		}
	}
?>