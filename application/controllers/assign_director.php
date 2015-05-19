<?php

class Assign_director extends MY_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Africa/Nairobi');
    }

    public function assing_reviewer() {
        $data['labref'] = $this->uri->segment(3);
        $data['reviewers'] = $this->getReviewers();
        $data['title'] = 'Reviewer page';
        $data['settings_view'] = 'reviewer_assign';
        $this->base_params($data);
    }

    public function getAJAXDirectors() {
		$directors = User::getAllReviewersOfCoa();
      
        echo json_encode($directors);
    }

    public function sendSamplesFolderToDirector() {
       
        $folder = $this->uri->segment(3);
        $data1 = $this->input->post('director');
         $priority=  $this->findPriority($folder);
            $urgency=$priority[0]->urgency;

        //$data2 = $this ->getReviewers();
        $data = array(
            'director_id' => $data1,
            'folder' => $folder,
            'time_done' => date('d-m-Y H:i:s'),
            'priority'=>$urgency
        );
        $this->db->insert('directors', $data);
        $this->updateAssignedSamples();
        $this->db->where('labref',$folder)->update('review_samples',array('stat'=>1)); 
        //$this->upDate();
        $this->createDir();
        $this->full_copy();
        $this->addSampleTrackingInformation();
        $this->addSignature();

        echo 'Reloading page.....';

        // redirect('uploaded_worksheets');
    }
    
    
    function complete_review($labref){
        $this->db->where('labref',$labref)->update('draft_samples',array('a_stat'=>1)); 
        
        $supervisor = $this->getSupervisor($labref);
        $from = $supervisor[0]->analyst_name;
        $date = date('d-M-Y H:i:s');
        $activity = 'Documentation - Awaiting D.Director;\'s Review';
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => 'Documentation',
            'date' => $date,
            'stage' => '8',
            'current_location' => 'Documentation'
        );
        $this->db->where('labref', $labref)->update('worksheet_tracking', $array_data);
        $this->db->where('labref', $labref)->update('review_samples ', array('date_time_returned' => $date));
        
              redirect('request_management/review_samples');
    }
    
        public function getSupervisor($labref) {
        // $user_id = $this->session->userdata('user_id');
        $this->db->select('analyst_name');
        $this->db->where('labref', $labref);
        $query = $this->db->get('review_samples');
        return $result = $query->result();
    }
    
     function updateAssignedSamples(){
                 $labref = $this -> input -> post("labref_no");  
                 $analyst_name = $this -> input -> post("rev_name");  
                 $date=date('d-m-Y H:i:s');
                 $this->db->insert('draft_samples',array(
                   'labref'=>$labref,
                   'analyst_name'=>$analyst_name,
                   'date_time'=>$date
                 ));
                 
                }
    
    function addSignature(){                    
                    $name=  $this->getDeputyDirector();
                    $signature_name=$name[0]->fname." ".$name[0]->lname;
                    $designation ='ANALYST: ';
                    $labref = $this -> uri->segment(3);
                    $date_signed=date('m-d-Y');
                    
                    $signature=array(
                        'labref'=>$labref,
                        'designation'=>$designation,
                        'signature_name'=>$signature_name,
                        'date_signed'=>$date_signed
                    );
                    $this->db->insert('signature_table',$signature);
                   // redirect('documentation/home/');
                   }
                   
                   
                   
                   
                   
                                     
     function addSampleTrackingInformation() {
           $data1 = $this->input->post('director');
        $reviewer = $this->getDeputyDirector();
        $userInfo = $this->getUsersInfo();
        $reviewer_name = $reviewer[0]->fname . " " . $reviewer[0]->lname;
        $activity = 'Draft COA Review';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Documentation';
        $to = $reviewer_name . '- Draft COA reviewer';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date_added' => $date,
            'stage'=>'9',
            'current_location' => $reviewer_name. ' \'s Desk'
        );
        
         $this->db->insert('sample_details',array(
                     'labref' =>$labref,
                     'by'=>$reviewer[0]->title ." ". $reviewer_name,
                     'activity'=>'Draft COA Review', 
                     'user_id'=>$data1,
                     'date_issued'=>date('Y-m-d')
                     
                 ));
        
        $this->db->where('labref', $labref);
        $this->db->update('worksheet_tracking', $array_data);
    }

    function getReviewer() {
        $analyst_id = $this->input->post('reviewer');
        $this->db->select('fname,lname');
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }


                   
                   
                  function getDeputyDirector(){
                  $analyst_id = $this->input->post('director');
                  $this->db->select('title,fname,lname');
                  $this->db->where('id',$analyst_id);
                  $query=  $this->db->get('user');
                  return $result=$query->result();
                  //print_r($result);
                }

    public function upDate() {
        $folder = $this->uri->segment(3);
        $data = array(
            'assign_status' => 1 //change this to 1
        );
        $this->db->where('labref', $folder);
        $this->db->update('reviewer_documentation', $data);
    }

    public function createDir() {

        $rootDir = 'directors';
        $reviewer_folder = $this->input->post('directors');
        if (is_dir($rootDir)) {
            // echo basename($dirName);
            $w = mkdir($rootDir . '/' . $reviewer_folder, 0777, TRUE);
            if ($w) {
                echo 'subdir has been created';
            } else {
                echo 'An error occured';
            }
        }
    }

    public function full_copy() {
        $labref = $this->uri->segment(3);

        $reviewer_folder = $this->input->post('director');
        $source = 'reviewer_uploads/'. $labref . '.xlsx';
        $source1 = 'workbooks/' . $labref .'/'. $labref . '.pdf';
        $newfolder = 'director';
        $test='test';
        $excelFile=$labref.".xlsx";
        $pdfFile=$labref.".pdf";
        if (is_dir($newfolder)) {
            mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref, 0777, TRUE);
            //mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref, 0777, TRUE);
        }
        $target = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref . '/'.$excelFile ;
        $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') .'/'. date('M') .'/'. $labref . '/' . $pdfFile;
        $target3 = $newfolder . '/' .$excelFile ;

        copy($source, $target);
     //  copy($source1, $target2);
       copy($source,$target3);
    }
    
        function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "Reviewer - " . $labref;
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