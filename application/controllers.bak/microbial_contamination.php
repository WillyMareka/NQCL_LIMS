<?php

class Microbial_contamination extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function worksheet() {
        $data['labref']=$this->uri->segment(3);
         $data['test_id']=$this->uri->segment(4);
        $data['settings_view'] = "microbial_contamination_v";
        $this->base_params($data);
    }
    
     function getDoStatus(){
        $labref=  $this->uri->segment(3);       
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('test_id', 3);
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('sample_issuance')->result();
        return $result=$query[0]->do_count;     
        
    }

    function updateSampleIssuance(){
        $do_status=  $this->getDoStatus()+'1';
        $labref=  $this->uri->segment(3);
        $test_id=  $this->uri->segment(4);
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id',$analyst_id);
        $this->db->update('sample_issuance',array('do_count'=>$do_status));
    }
    public function save() {
    
            
            $labref = $this->uri->segment(3);
            $max_row_id = $this->getDisRepeatStatus($labref);
            (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
            $analyst_id = $this->session->userdata('user_id');     
            
            
                 $disintegration = array(
                'labref' => $labref,
                'dis_medium' =>  $this->input->post('dismedium'),
                'duration' => $this->input->post('dist'),
                'results_observed' => $this->input->post('disro'),
                'comments' => $this->input->post('disco'),
                'fineness_of_dispersion'=> $this->input->post('disfod'),
                 'component'=>0,
                  
                'analyst_id' => $analyst_id,
                'repeat_status'=>$new_status
            ); 
             $this->db->insert('disintegration', $disintegration);
      
            
             $this->updateSampleIssuance();
            $this->updateTestIssuanceStatus();
            $this->updateSampleSummary();
            $this->post_posting();
            $this->save_test();
             $test_id=  $this->uri->segment(4);
        $this->updateUploadStatus($labref, $test_id);
            //$this->updateTabsCapsCOADetails($labref);
            //$sql1 = "UPDATE worksheets SET comment='$comment' WHERE labref='$labref'";
            //$j = mysql_query($sql1);

          

        //redirect('assay/assay_page/' . $labref);
      
        
    }
    
    
    function updateTestIssuanceStatus(){
       $labref=  $this->uri->segment(3);
       
       $analyst_id=  $this->session->userdata('user_id');
       $done_status ='1';
       $data= array(
         'done_status'=>$done_status  
       );
       $this->db->where('lab_ref_no',$labref);
       $this->db->where('test_id',3);
       $this->db->where('analyst_id',$analyst_id);
       $this->db->update('sample_issuance',$data);
       
       $this->comparetToDecide($labref);
    
    }    

     function post_posting(){
        $labref=  $this->uri->segment(3);
        $posts=array(
            'labref'=>$labref,
            'component'=>'disintegration',
            'component_no'=>'0',
            'test_name'=>'Disintegration',
            'date_time'=>date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status',$posts);
    
     }
       function check_repeat_status(){
        $this->db->select_max('repeat_status');
        $this->db->where('labref',  $this->uri->segment(3));
        $this->db->where('test_name','disintegration');
        $query=  $this->db->get('tests_done');
        return $result=$query->result();
        
    }
   function save_test(){
       $labref=  $this->uri->segment(3);
        $priority=  $this->findPriority($labref);
        $urgency=$priority[0]->urgency;
        $data1=  $this->getAnalystId();
        $supervisor_id=$data1[0]->supervisor_id;
        
        $data=$this->check_repeat_status();
        $r_status= $data[0]->repeat_status;
        $new_r_status=$r_status+1;
        $analyst_id=  $this->session->userdata('user_id');
        
        $final_test_done=array(
            'labref'=>$labref,
            'test_name'=>'disintegration',
            'repeat_status'=>$new_r_status,
            'supervisor_id'=>$supervisor_id, 
            'test_subject'=>'disintegration_r',
            'analyst_id'=>$analyst_id,
            'priority'=>$urgency
        );
        $this->db->insert('tests_done',$final_test_done);
    }
       function updateSampleSummary(){
        $labref=  $this->uri->segment(3);
        $data = array(
            'determined' => $this->input->post('dist')
        );
        $this->db->where('test_id',3);
        $this->db->where('labref',$labref);
        $this->db->update('coa_body',$data);
    }
    
    function getAnalystId(){
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('analyst_supervisor');
        return $result=$query->result();
       // print_r($result);
    }

    public function getDisintegrationTestRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('disintegration');
        return $row = $query->result();
    }

       public function disintegration_r() {
           
        $module_name=  $this->uri->segment(1);
        $module=  $this->uri->segment(2);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r']=$r = $this->uri->segment(4);
        $data['c']=$c=  $this->uri->segment(5);
        $data['done']=  $this->checkApproval($module_name, $labref, $r, $c);   
        //$data['caps_results'] = $this->getCaps_v($labref, $r);
        $username=$this->getAnalystData();
        $new=$username[0]->analyst_name;
        $this->session->set_userdata('mail_name',$new);        
        $this->session->set_userdata(array('labref'=>$labref,'module'=>$module));
        $data['disintegration_data'] = $this->getDisintegrationData($labref, $r);
        $data['date_time']=  $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'disintegration_r_v';
        $this->base_params($data);
        }
        function getDisintegrationData($labref,$r){
            return $this->db
                    ->where('labref',$labref)
                    ->where('repeat_status',$r)
                    ->get('disintegration')
                    ->result();
        }
                

  function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId_1($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;          
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('analyst_supervisor');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }
  function getAnalystId_1($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }
    

    
     function getUsername(){
            $this->db->select('analyst_name');
            $this->db->where('supervisor_id',  $this->session->userdata('user_id'));
            $query=  $this->db->get('analyst_supervisor');
            return $result=  $query->result();
           
        }
    
    public function approve_data(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $c=  $this->uri->segment(5);
      $supervisor_id=  $this->session->userdata('user_id');
       $supervisor=  $this->getSupervisorName();
       //print_r($supervisor);
       $supervisor_name=$supervisor[0]->fname." ".$supervisor[0]->lname;
       $analyst=  $this->getAnalystName();
       $analyst_name=$analyst[0]->analyst_name;
        $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;
       $approve_data=array(
           'supervisor_name'=>$supervisor_name,
           'analyst_name'=>$analyst_name,
           'labref'=>$labref,
           'repeat_status'=>$r,
           'test_name'=>'disintegration',
           'component_no'=>$c,
           'test_product'=>'demo',
           'supervisor_id'=>$supervisor_id,
           'user_type'=>'5',
           'status'=>'1',
           'priority'=>$urgency
       );
       $this->db->insert('supervisor_approvals',$approve_data);
       
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('component_no',$c);
       $this->db->where('test_name','disintegration');
       $this->db->update('tests_done',array('approval_status'=>'1'));
       
       
       $this->compareToDecide($labref);
       
       redirect('supervisors/home/'.$this->session->userdata('lab'));
       
       
    }
    
    public function approve(){
       $labref=  $this->uri->segment(3);
       $r=  $this->uri->segment(4);
       $c=  $this->uri->segment(5);
       $status='1';
       $this->db->select('status');
       $this->db->where('status',$status);
       $this->db->where('labref',$labref);
       $this->db->where('repeat_status',$r);
       $this->db->where('component_no',$c);
       $this->db->where('test_name','disintegration');
       
       $query=  $this->db->get('supervisor_approvals');
       if($query->num_rows()>0){
           echo 'Already Approved';
       }else{
           $this->approve_data();  
       }
               
    }   

    
 
        public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }
     public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }
         function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
    
      public function getDisRepeatStatus($labref) {          
         $this->db->select_max('repeat_status');
         $this->db->where('labref',$labref);
         $query=  $this->db->get('disintegration');        
         return $row = $query->result();
       // print_r($row);  
            
        }
        function repeats($labref){
            echo json_encode(
            $this->db
                    ->select('repeat_status')
                    ->where('labref',$labref)
                    ->get('disintegration')
                    ->result()
                    );
        }

    public function base_params($data) {
        $data['title'] = "Microbial Contamination";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
