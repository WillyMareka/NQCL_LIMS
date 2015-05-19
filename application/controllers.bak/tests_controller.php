<?php
	class Tests_controller extends CI_Controller {
		public function methods(){
			$data['reqid'] = $this -> uri -> segment(4);
			$data['test_id'] = $this -> uri -> segment(3);
			$data['methods']= Test_methods::getMethods($data['test_id']);
			$data['content_view'] = "methods_v";
			$this -> load -> view('template1', $data);
			
		}
	}
?>