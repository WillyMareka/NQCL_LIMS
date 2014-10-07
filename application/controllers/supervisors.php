<?php

class Supervisors extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['done_tests'] = $this->getTestsDone();
        $data['settings_view'] = 'supervisors_index_v';
        $this->base_params($data);
    }

    function home() {
	error_reporting(1);
        $labref = $this->uri->segment(3);
        $this->session->set_userdata('lab', $labref);
        $data['analyst_data'] = $this->getAnalystData();
        //var_dump($data['analyst_data']);
        //var_dump($this->getTestsDone());
        $data1 = $this->getSessionAnalystId();
        $name = $data1[0]->analyst_name;
        $id = $data1[0]->analyst_id;
        $this->session->set_userdata(array('analyst_id' => $id, 'analyst_name' => $name));
        $data['pm_count'] = $this->pm_count();
        //$data['username']=  $this->getUsername();
        $data['settings_view'] = 'supervisors_v';
        $this->base_params($data);
    }

    function pm_count() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('pm_count,username');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        $result = $query->result();
        return $result;
    }

    function getTestsDone() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('labref,priority');
        $this->db->where('supervisor_id', $supervisor_id);
       $this->db->where('worksheet_status', 1);

        $this->db->group_by('labref');
        //$this->db->group_by('repeat_status');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
        // print_r($result);
    }
    
         public function approve_data(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $test_id=  $this->uri->segment(6);
       $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;
      $supervisor_id=  $this->session->userdata('user_id');
       $supervisor=  $this->getSupervisorName();
       //print_r($supervisor);
       $supervisor_name=$supervisor[0]->fname." ".$supervisor[0]->lname;
       $analyst=  $this->getAnalystName();
       $analyst_name=$analyst[0]->analyst_name;
         $tname=  $this->uri->segment(5); 
         $_tid=  $this->uri->segment(6); 
         
         If($_tid =='49' || $_tid =='50'){
             $department = '0';
         }else{
             $department='1';
         }
       
       $approve_data=array(
           'supervisor_name'=>$supervisor_name,
           'analyst_name'=>$analyst_name,
           'labref'=>$labref,
           'repeat_status'=>$r,
           'test_name'=>$tname,
           'test_product'=>'formicrobiology',
           'supervisor_id'=>$supervisor_id,
           'user_type'=>'5',
           'status'=>'1',
           'priority'=>$urgency,
           'test_id'=>$test_id,
           'department'=>$department,
       );
       $this->db->insert('supervisor_approvals',$approve_data);
       
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('test_subject',$tname);
       $this->db->update('tests_done',array('approval_status'=>'1'));
       
       $this->compareToDecide($labref);
       
       redirect('supervisors/home/'.$this->session->userdata('lab'));
       
       
    }
     public function approve(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $tname=  $this->uri->segment(5); 
      
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('test_name',$tname);
            $query=  $this->db->get('supervisor_approvals');
       if($query->num_rows()>0){
           echo 'Already Approved';
       }else{
           $this->approve_data();  
       }
               
    }

    function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;
          
            $this->db->where('labref', $url);
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
           // $this->db->group_by('test_name');
            $query = $this->db->get('tests_done');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }

    function getAnalystId($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function getSessionAnalystId() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id,analyst_name');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
    }

    public function getSupervisor() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
       // print_r($result);
    }

    public function base_params($data) {
        $data['title'] = "Supervisors";
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
