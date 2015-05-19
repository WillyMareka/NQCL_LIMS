<?php

class Assign extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function assing_reviewer() {
        $data['labref'] = $this->uri->segment(3);
        $data['reviewers'] = $this->getReviewers();
        $data['title'] = 'Reviewer page';
        $data['settings_view'] = 'reviewer_assign';
        $this->base_params($data);
    }

    public function getReviewers() {
        $this->db->select('alias,id');
        $this->db->where('user_type', 6);
        $query = $this->db->get('user');
        foreach ($query->result() as $value) {
            var_dump($data[] = $value);
        }
        return $data;
    }

    public function getAJAXReviewers() {
        $this->db->select('alias,id');
        $this->db->where('user_type', 6);
        $query = $this->db->get('user');
        foreach ($query->result() as $value) {
            $data[] = $value;
        }
        echo json_encode($data);
    }

    
    public function sendSamplesFolder() {
        $reveiwer_id = $this->session->userdata('user_id');
        $folder = $this->uri->segment(3);
        $data1 = $this->input->post('reviewer');

        //$data2 = $this ->getReviewers();
        $data = array(
            'reviewer_id' => $data1,
            'time_done'=>  date("d-M-Y H:i:s"),
            'folder' => $folder
        );
        $this->db->insert('reviewer_worksheets', $data);
        $this->upDate();
        $this->createDir();
        $this->full_copy();

        echo 'Reloading page.....';

        // redirect('uploaded_worksheets');
    }

    public function upDate() {
        $folder = $this->uri->segment(3);
        $data = array(
            'assign_status' => 1 //chane this to 1
        );
        $this->db->where('labref', $folder);
        $this->db->update('supervisor_approvals', $data);
    }

    public function createDir() {
        $data2 = $this->getReviewers();
        $rootDir = 'reviewers';
        $reviewer_folder = $this->input->post('reviewer');
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
    function approve(){
        $labref=  $this->uri->segment(3);
        $data =array(
            'status'=>'1',
            'time_done '=> date('d-M-Y')
        );
        $this->db->where('folder',$labref);
        $this->db->update('reviewer_worksheets',$data);
        redirect('reviewer');
    }
       function reject(){
        $labref=  $this->uri->segment(3);
        $data =array(
            'status'=>'2',
            'time_done '=>'NOW()'
        );
        $this->db->where('folder',$labref);
        $this->db->update('reviewer_worksheets',$data);
        redirect('reviewer');
    }

    public function full_copy() {
        $labref = $this->uri->segment(3);
        $data2 = $this->getReviewers();
        $reviewer_folder = $this->input->post('reviewer');
        $source = 'analyst_uploads/'.date('Y').'/'.date('M').'/'. $labref . '/' . $labref . '.xlsx';
        $newfolder = 'reviewers';
        if (is_dir($newfolder)) {
            mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref, 0777, TRUE);
            mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref, 0777, TRUE);
        }
        $target = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref . '/' . $labref . '.xlsx';
        $target2=$newfolder . '/' . $reviewer_folder . '/' . date('Y') .'/'. $labref . '/' . $labref . '.xlsx';
        copy($source, $target);
        copy($source, $target2);
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