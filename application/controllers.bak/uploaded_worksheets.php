<?php

class Uploaded_Worksheets extends CI_Controller {

  
    public function index() {
      
       $data=array();  
       
       $data['settings_view'] = "uploaded_sheets";
        $data['labref']=  $this->getFolderRef(); 
	$data['worksheets']=  $this->getWorksheets();
        $data['department']=  $this->getDepatmentName();
        $this -> base_params($data);
    }
    
    public function getWorksheets() {
        
        $this->db->select('*');  
        $this->db->where('assign_status',0);
        $query=$this->db->get('files');
        
        foreach ($query->result() as $value) {
            $data[]=$value;
        }
        return $data;
        
    }
    public function getDepatmentName() {
    $department_id = $this->getDepatmentId();
        $this->db->select('name');
        $this->db->where('id', $department_id);
        $query1 = $this->db->get('departments');
        foreach ($query1->result() as $value) {
            $data[] = $value;
        }
        return $data;

    }
    public function getFolderRef() {
       $this->db->select('nqcl_number');  
        $this->db->group_by('nqcl_number',0);
        $query=$this->db->get('files');
        
        foreach ($query->result() as $value) {
            $data[]=$value;
        }
        return $data;
        
      
    }
    
    public function getDepatmentId() {
    $sesssion = $this->session->userdata('user_id');
        $this->db->select('department_id');
        $this->db->where('id', $sesssion);
        $query1 = $this->db->get('user');
        foreach ($query1->result() as $value) {
            $value1=$value->department_id;
        }
        return $value1;

    }
    
        
    
    
	
        public function base_params($data) {
		$data['title'] = "Uploaded Worksheets";
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


