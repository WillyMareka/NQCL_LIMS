<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard_control extends MY_Controller {

    function __construct() {
        parent::__construct();
        
    }

    function index() {       
        
        $this->controllAccess();
       
    }

    function home() {
      
        $data['contents'] = 'dashboard_view/dashboard_home_v';
        $data['all_samples'] = $this->AllSamplesCount();
        $data['all_clients'] = $this->AllClientsCount();
        $data['all_assigned'] = $this->AllAssignedSamples();
        $data['all_unassigned'] = $this->AllUnassignedSamples();
        $data['all_urgent'] = $this->AllUrgentSamples();

        $this->base_param($data);
    }

    function AllSamplesCount() {
        return $this->db->count_all_results('request');
    }

    function AllClientsCount() {
        return $this->db->count_all_results('clients');
    }

    function AllAssignedSamples() {
        return $this->db->query("SELECT COUNT(*) AS numrows FROM `request`  WHERE assign_status='1'")->result();
    }

    function AllUnassignedSamples() {
        return $this->db->query("SELECT COUNT(*) AS numrows FROM `request` WHERE assign_status='0'")->result();
    }

    function AllUrgentSamples() {
        return $this->db->where('urgency', '1')->count_all('request');
    }

    function sample_assignments() {
        $data['contents'] = 'dashboard_view/sample_assignments_v';
        $this->base_param($data);
    }

    function samples() {
        $data['labref'] = $this->getLabreferences();
        $data['worksheets'] = $this->worksheets();
       // $data['changes']=  $this->checkForChanges($labref);
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['contents'] = 'dashboard_view/samples_v';
        $this->base_param($data);
    }
        public function worksheets() { 
           echo $user_id=  $this->session->userdata('user_id');
        $query = $this->db->where('director_id',$user_id)->get('directors');
        foreach ($query->result() as $folders) {
            $folder[] = $folders;
        }
        return $folder;
    }
    function changes_made($labref){
     $data['changes_made']=  $this->getCOAChanges($labref);
     $this->load->view('dashboard_view/coa_changes_v',$data);
    }
    function show(){
    $username=shell_exec("echo %username%" );
echo ("username : $username" );


     

    }
    
    function getCOAChanges($labref){
        $offset=$this->countTestRows($labref);
        return  $this->db->where('new_labref',$labref)->limit(200,$offset)->get('coa_body_log')->result();  
    }
    
        public function getLabreferences() {     
        $this->db->select('folder'); 
        $query = $this->db->get('directors');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $data[] = $value;
            }
        }
        }
        
      

    function notifications() {
        $data['contents'] = 'dashboard_view/notifications';
        $this->base_param($data);
    }

    function controllAccess() {
        $user_id = $this->session->userdata('user_id');
        $user_type = User::getUserType($user_id);
       
        if ($user_type[0]['user_type'] === '8') {
            $this->home();
        } else {
            //$this->protected_page();
            $this->home();
         
    }
    }
    function samples_location(){
        $data['contents']='dashboard_view/sample_locator_v';
        $data['location']=  $this->getSampleLocation();      
        $this->base_param($data);
    }
       function getSampleLocation(){
        return $this->db->get('worksheet_tracking')->result();
    }
    

    function protected_page() {
        $data['content_view'] = 'protected_v';
        $this->base_params($data);
    }

    function base_param($data) {
        $this->load->view('dashboard_view/dashboard_template', $data);
    }

    public function base_params($data) {
        $data['title'] = "Protected Area - Unautharised Access";
        $this->load->view('template', $data);
    }

}
