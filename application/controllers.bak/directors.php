<?php

//error_reporting(0);
class Directors extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    
    function test(){
        $data['settings_view']='test_v';
        $data['coa_body']=  $this->getCOA();
         $data['trd'] = $this->getRequestedTestsDisplay2();
        $this->base_params($data);
        
    } 
      function getRequestedTestsDisplay2() {
        $query = $this->db->query("SELECT  t.id as test_id, cb.method AS methods,`name` , `compedia`,`determined` , `specification`,complies
                                 FROM (
                                       `tests` t, `coa_body` cb
                                       )
                                JOIN `request_details` rd ON `t`.`id` = `cb`.`test_id`
                                WHERE `rd`.`request_id` = 'TRACKINGSAM'
                                AND cb.labref = 'TRACKINGSAM'
                                GROUP BY name
                                ORDER BY name DESC
                                LIMIT 0 , 30");
        $result = $query->result();
     

        return $result;
        // print_r($result);
    }
    
    function getCOA(){
        return $this->db
                ->where('labref','TRACKINGSAM')
                //->where('test_id',2)
                ->get('coa_body')
                ->result();
    }
    function test_values(){
        $a = 'a';
        $b = '';
        $c = '';
        $d = '';
        $e = '';
        
        if($a==true && $b==false){
          
              echo $data="<strong>component x%</strong><br /> (Rsd = 3% ; n = 2)";
        }else if($a==true && $b==true && $c==false){
            echo "<strong>component x% </strong><br />(Rsd = 3% ; n = 2),<br/><strong>component x%</strong><br /> (Rsd = 3% ; n = 2)";
        }else if($a==true && $b==true && $c==true && $d==false){
            echo "component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2)";
        }else if($a==true && $b==true && $c==true && $d==true && $e==false){
            echo "component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2)";
        }else if($a==true && $b==true && $c==true && $d==true && $e==true ){
            echo "component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2),component x% (Rsd = 3% ; n = 2)";
        }
    }


    
    
    public function draft_coa_review() {
       // error_reporting(1);
        $data['labref'] = $this->getLabreferences();
        $data['worksheets'] = $this->worksheets();
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'director_v_2';
        $this->base_params($data);
    }
function superDirector(){
      $data['labref'] = $this->getLabreferences();
        $data['worksheets'] = $this->worksheets();
        $data['is_director']=  $this->checkIfSuperDirector();
       // $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'director_v_1';
        $this->base_params($data);
}


   function reject_reason($labref,$level){
   echo json_encode(
   $this->db->select('reject_reason')->where('labref',$labref)->where('at_level',$level)->get('sample_rejection')->result()
           
           );
    }

function reject($labref){
    $this->db->where('folder',$labref);
    $this->db->update('directors',array('approval_status'=>'2'));
    redirect('dashboard_control/samples/');
    }
    
    
function reject_coa_draft($labref, $level){
    $this->db->where('folder',$labref);
    $this->db->update('directors',array('approval_status'=>'2'));    
    $this->registerRejectionReason($labref, $level);
    redirect('directors/draft_coa_review/');
    }
    
    function reject_d($labref){
    $this->db->where('folder',$labref);
    $this->db->update('directors',array('approval_status'=>'2'));
    redirect('directors/superDirector');
    }
    
    
    
    public function getLabreferences() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('folder');
        //$this->db->where('director_id', $user_id);
        //$this->db->group_by('labref');
        $query = $this->db->get('directors');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $data[] = $value;
            }
        }
        return $data;
    }

    public function samples() {
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'director_uploaded_view';
        $this->base_params($data);
    }
        public function samplesD() {
        $data['is_director']=  $this->checkIfSuperDirector();
        $data['reviewer_id'] = $this->session->userdata('user_id');
        $data['settings_view'] = 'director_uploaded_view_1';
        $this->base_params($data);
    }

    function getName() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function approve($labref) {       
        $data = array(
            'approval_status' => 1
        );
        $this->db->where('folder', $labref);
        $this->db->update('directors', $data);
        $this->updateDrafts($labref);
        $this->updateDocumentation();
        $this->addSampleTrackingInformation();
       
        redirect('dashboard_control/samples/');
    }
    
    
        function approve_coa_draft($labref) {       
        $data = array(
            'approval_status' => 1
        );
        $this->db->where('folder', $labref);
        $this->db->update('directors', $data);
        $this->updateDrafts($labref);
        $this->updateDocumentation();
        $this->addSampleTrackingInformation();
       
        redirect('Coa_Review/draft_coa_review/');
    }
    
    
       function approve_d() {
        $labref_no=  $this->getLabreferences();
        $labref=  $this->uri->segment(3);
        
        $data = array(
            'approval_status' => 1
        );
        $this->db->where('folder', $labref);
        $this->db->update('directors', $data);
        $this->updateDrafts_SD($labref);
        $this->updateDocumentation();
        $this->addSampleTrackingInformationSD();
        $this->addSignature();
        redirect('directors/superdirector');
    }
    
     function addSampleTrackingInformationSD() {
      
        $userInfo = $this->getUsersInfo();
        $reviewer_name = 'Documenation';
        $activity = 'Generate & Print final COA for archieving';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Director\'s Desk';
        $to = $reviewer_name;
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date_added' => $date,
            'stage'=>'11',
            'state'=>2,
            'current_location' => 'Documentation\'s Desk'
        );
        $this->db->where('labref', $labref);
        $this->db->update('worksheet_tracking', $array_data);
    }
    
    
    function addSignature(){                    
                    $name=  $this->getUsersInfo();
                    $signature_name=$name[0]->fname." ".$name[0]->lname;
                    $designation ='DIRECTOR:';
                    $labref = $this -> uri->segment(3);
                    $date_signed=date('m-d-Y');
                    
                    $signature=array(
                        'labref'=>$labref,
                        'designation'=>$designation,
                        'signature_name'=>$signature_name,
                        'date_signed'=>$date_signed
                    );
                    $this->db->insert('signature_table',$signature);
                   
                   }
                   
               
      function addSampleTrackingInformation() {
        $reviewer = $this->getDirector();
        $userInfo = $this->getUsersInfo();
        $reviewer_name = $reviewer[0]->fname . " " . $reviewer[0]->lname;
        $activity = 'To Approve';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . ' \'s Desk';
        $to = $reviewer_name . '- Director';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date_added' => $date,
            'stage'=>'10',
            'current_location' => 'Director\'s office'
        );
        $this->db->where('labref', $labref);
        $this->db->update('worksheet_tracking', $array_data);
    }
    
        public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }
                   
                function getDirector(){
                  
                  $this->db->select('fname,lname');
                  $this->db->where('user_type',8);
                  $this->db->limit(1);
                  $query=  $this->db->get('user');
                  return $result=$query->result();
                  //print_r($result);
                }
                
                
                function updateDrafts($labref){
                    $this->db->where('labref',$labref)->update('draft_samples',array('a_stat'=>'1'));
                }
                  
                  function updateDrafts_SD($labref){
                    $this->db->where('labref',$labref)->update('draft_samples',array('a_stat'=>'2','date_time_returned'=>date('d-m-Y H:i:s')));
                }
                  
                

    function updateDocumentation() {
        $names = $this->getName();
        $details = $names[0]->fname . " " . $names[0]->lname;
        $user_id = $this->session->userdata('user_id');
        $file = $this->uri->segment(3);
         $priority=  $this->findPriority($file);
            $urgency=$priority[0]->urgency;
        $data = array(
            'labref' => $file,
            'name_of_director' => $details,
            'directors_say' => 'OK',
            'director_id' => $user_id,
            
        );
        $this->db->insert('directors_say', $data);
    }
       function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }

    function elfinder_init() {
        $director_id = $this->session->userdata('user_id');
        $this->load->helper('path');
        $opts = array(
            //'debug' => true, 
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './director/' . $director_id,
                    'URL' => base_url() . '/director/' . $director_id,
                    'accessControl' => 'access',
                    'disabled' => array('edit', 'rename', 'cut', 'copy', 'delete', 'trash'),
                    'dotFiles' => false,
                    'tmbDir' => '_tmb',
                    'arc' => '7za',
                    'defaults' => array('read' => true, 'write' => false, 'rm' => false)
                ),
            ),
        );
        $this->load->library('elfinder_lib', $opts);
    }

        function elfinder_init_D() {
        $director_id = $this->session->userdata('user_id');
        $this->load->helper('path');
        $opts = array(
            //'debug' => true, 
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './director/',
                    'URL' => base_url() . '/director/',
                    'accessControl' => 'access',
                    'disabled' => array('edit', 'rename', 'cut', 'copy', 'delete', 'trash'),
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
        $reviewer_id = $this->session->userdata('user_id');
   
        $this->db->where('director_id', $reviewer_id);
     
        $query = $this->db->get('directors');
        foreach ($query->result() as $folders) {
            $folder[] = $folders;
        }
        return $folder;
    }
    function checkIfSuperDirector(){
        $sdirector_id=  $this->session->userdata('user_id');
        $this->db->where('id',$sdirector_id);
        $query=  $this->db->get('user');
        return $result=$query->result();
    }

    public function base_params($data) {
        $data['title'] = "Directors Page";
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
