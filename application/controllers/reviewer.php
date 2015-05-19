<?php
error_reporting(0);
class Reviewer extends MY_Controller {

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


function reject($labref,$level){
    $this->db->where('folder',$labref);
    $this->db->update('reviewer_worksheets',array('status'=>'2'));
    
      $data1 = array(
            'a_stat' => '5',
            
        );
        $this->db->where('labref', $labref);
        $this->db->update('review_samples', $data1);
    
    $this->registerRejectionReason($labref,$level);
   // $this->updateAnalyst($labref);
   // redirect('reviewer');
    }
    
    function reject_reason($labref,$level){
   echo json_encode(
   $this->db->select('reject_reason')->where('labref',$labref)->where('at_level',$level)->get('sample_rejection')->result()
           
           );
    }
    
    
    
    
    
    function updateAnalyst($labref){
            $this->db->where('lab_ref_no',$labref);
                $this->db->update('sample_issuance',array('status'=>'2'));

    }
  
   public function getLabreferences(){
        $user_id=$this->session->userdata('user_id');
        $this->db->select('folder,priority');
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
    $data['labref']=  $this->uri->segment(3);
        $data['reviewer_id']=  $this->session->userdata('user_id');
        $data['settings_view'] = 'samples_uploaded_view';
        $this->base_params($data);
    }

    function elfinder_init() {
        $reviewer_id=$this->session->userdata('user_id');
        $labref=$this->uri->segment(3);
        $this->load->helper('path');
        $opts = array(
            //'debug' => true, 
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './reviewers/'.$reviewer_id.'/'.date('Y').'/'.$labref,
                    'URL' => base_url() . '/reviewers/'.$reviewer_id.'/'.$labref,
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
   
    $this->db->where('reviewer_id',$reviewer_id);
 
    $query=  $this->db->where('status','0')->group_by('folder')->get('reviewer_worksheets');
  foreach($query->result() as $folders){
      $folder[]=$folders;
  }
  return $folder;
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
