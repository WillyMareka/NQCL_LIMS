<?php
//error_reporting(0);
class Reviewer extends CI_Controller {

    function __construct() {
        parent::__construct();
        }
public function index() {
    $data['labref']=  $this->getLabreferences();
    $data['worksheets']=  $this->worksheets();
    $data['reviewer_id']=  $this->session->userdata('user_id');
    $data['settings_view']='reviewer_v';
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

public function samples_for_review() {
        $data['reviewer_id']=  $this->session->userdata('user_id');
        $data['settings_view'] = 'samples_uploaded_view';
        $this->base_params($data);
    }

    function elfinder_init() {
        $reviewer_id=$this->session->userdata('user_id');
        $this->load->helper('path');
        $opts = array(
            //'debug' => true, 
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './reviewers/'.$reviewer_id,
                    'URL' => base_url() . '/reviewers/'.$reviewer_id,
                    'accessControl' => 'access',
                    'disabled' => array('edit', 'rename', 'cut', 'copy','delete','trash'),
                    'dotFiles' => false,
                    'tmbDir' => '_tmb',
                    'arc' => '7za',
                    'defaults' => array('read' => true, 'write' => false, 'rm' => false)
                ),
            ),
        );
        $this->load->library('elfinder_lib', $opts);
    }
   

    public function worksheets() {
    $reviewer_id=  $this->session->userdata('user_id');
    $this->db->select('folder,status');
    $this->db->where('reviewer_id',$reviewer_id);
   // $this->db->where('status','0');
    $query=  $this->db->get('reviewer_worksheets');
    return $result=  $query->result();
}
    public function base_params($data) {
        $data['title'] = "Review Page";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
