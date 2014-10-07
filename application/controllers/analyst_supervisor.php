<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * cls
 */

class Analyst_supervisor extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['settings_view'] = 'analyst_supervisors_v';
        $data['supervisors'] = User::getAllSupervisors();
        $data['analysts'] = User::getAnalystsAll();
        $data['all']=  $this->getAll();
        $this->base_params($data);
    }

    function getSupervisors() {
        $this->db->select('id,lname,fname,username');
        $this->db->where('user_type', 2);
        $query = $this->db->get('user');
        return $result = $query->result();
        // print_r($result);       
    }
    
    function getAll(){
        $query=$this->db->get('analyst_supervisor');
        $result=$query->result();
        return $result;
        
    }

    function getAnalysts() {
        $this->db->select('id,lname,fname,username');
        $this->db->where('user_type', 1);
        $query = $this->db->get('user');
        return $result = $query->result();
        // print_r($result); 
        
    }
    
    function unassign($analyst_id,$supervisor_id){
        $this->db->where('analyst_id',$analyst_id);
        $this->db->where('supervisor_id',$supervisor_id);
        $this->db->delete('analyst_supervisor');
        redirect('analyst_supervisor');
    }

    function assign() {
        $analyst_id=  $this->input->post('analyst');
        
        $this->db->select('analyst_id');
        $this->db->where('analyst_id',$analyst_id);
        $this->db->where('status','1');
        $query=  $this->db->get('analyst_supervisor');        
        if($query->num_rows()>0){
            echo 'Analyst has a supervisor';
        }else{
        $data=array(
            'analyst_id'=>  $this->input->post('analyst'),
            'analyst_name'=>  $this->input->post('analyst_name'),
            'supervisor_id'=>  $this->input->post('supervisor'),
            'supervisor_name'=>  $this->input->post('supervisor_name')
        );
        $this->db->insert('analyst_supervisor',$data);
        echo 'Assigned';
        }
    }
    
    function check_assign_status(){
       $analyst_id=  $this->input->post('analyst');
        
        $this->db->select('analyst_id');
        $this->db->where('analyst_id',$analyst_id);
        $this->db->where('status','1');
        $query=  $this->db->get('analyst_supervisor');        
        if($query->num_rows()>0){
            echo 'Analyst has a supervisor';
        }else{
            echo 'Go ahead';
        }
    }

    public function base_params($data) {
        $data['title'] = "Assign Supervisors To Analysts";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        $data['link'] = "settings_management";
        $this->load->view('template', $data);
    }

}

?>
