<?php

class Documentation extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function Home() {
        $data['settings_view'] = 'documents_v';
        $data['documentation_data'] = $this->getData();
         $data['title'] = "Analyzed Samples";
                
        $this->base_params($data);
    }
       function reviewed() {
        $data['settings_view'] = 'documents_v_1';
         $data['title'] = "Reviewed Samples";
        $data['documentation_data'] = $this->getReviewedData();
        $data['coa_draft'] = $this->getCOAStatus();   
        //var_dump($data['coa_draft']);
        $this->base_params($data);
    }
    function getCOAStatus(){
//        $labref_no= $this->getReviewedData();
//        $labref=$labref_no[0]->labref;        
//        $this->db->where('labref',$labref);
        $query=  $this->db->get('coa_draft_status');
        return $result=$query->result();
        
    }
       function fromDirector() {
        $data['settings_view'] = 'documents_v_director';
         $data['title'] = "Sample From Director";
        $data['documentation_data'] = $this->getDataFromDirector();
           
        $this->base_params($data);
    }

    public function getData() {
        $user_id = $this->session->userdata('user_id');
        $this->db->where('user_type', '5');
        //$this->db->group_by('labref');
         $this->db->where('assign_status', 0);
        $query = $this->db->get('supervisor_approvals');
        return $result = $query->result();
        //print_r($result);
    }
      public function getReviewedData() {     
          $this->db->where('assign_status',0);
        $query = $this->db->get('reviewer_documentation');
        return $result = $query->result();
        //print_r($result);
    }
        public function getDataFromDirector() {     
         // $this->db->where('assign_status',0);
        $query = $this->db->get('directors_say');
        return $result = $query->result();
        //print_r($result);
    }
  

    public function getDepatmentName() {
        $department_id = $this->getDepatmentId();
        $department_iid=$department_id[0]->department_id;
        $this->db->select('name');
        $this->db->where('id', $department_iid);
        $query1 = $this->db->get('departments');
        $result=$query1->result();
        
    }

    public function getWorksheets() {

        $this->db->select('*');
        $this->db->where('assign_status', 0);
        $query = $this->db->get('files');

        foreach ($query->result() as $value) {
            $data[] = $value;
        }
        return $data;
    }

    public function getFolderRef() {
        $this->db->select('nqcl_number');
        $this->db->group_by('nqcl_number', 0);
        $query = $this->db->get('files');

        foreach ($query->result() as $value) {
            $data[] = $value;
        }
        return $data;
    }

    public function getDepatmentId() {
        $sesssion = $this->session->userdata('user_id');
        $this->db->select('department_id');
        $this->db->where('id', $sesssion);
        $query1 = $this->db->get('user');
        return $result=$query1->result();
    }
   public function generateCOA($offset=0) {
        $filename=  $this->uri->segment(3);
         //  $data['header']='<header style="width:500px; height:100px; background:black; margin: 0 auto 0 auto;"></header>';
           $data['head']='CERTIFICATE OF ANALYSIS';
           $data['cert_no']='CERTIFICATE No: CAN/'.date('Y').'/';
            $html1=$this->load->view('welcome_message',$data, true);
            //$this->load->view('footer');
            $html=$html1;
                        //call the function createPDF
            $this->dompdf_lib->createPDF($html, 'myfilename');       
             
        }    
         function getRequestInformation($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        return $Information;
    }

    function getRequestedTests($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
                    return $object->name;
                }, $result);
        return $tests = implode(', ', $output);
    }

    function getCOARowStatus(){
        
    }
    public function base_params($data) {
       
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}

?>
