<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Labreference extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $data['labref']=  $this->getLabreferences();
        $data['settings_view']='file_upload_v';
        $this->base_params($data);
    }


    
    public function getLabreferences(){
        $user_id=$this->session->userdata('user_id');
        $this->db->select('folder');
        $this->db->where('reviewer_id',$user_id);
        //$this->db->group_by('labref');
        $query=$this->db->get('reviewer_worksheets');
        
        if($query->num_rows()>0){
            foreach ($query->result() as $value) {
                $data[]=$value;
            }
        }
        return $data;
    }
    
    public function base_params($data) {
		$data['title'] = "Upload File Links";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "uniformity";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}
}
