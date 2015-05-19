<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Coa_Scans extends MY_Controller{

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        $data['settings_view'] ='coa_scans_v';
        $this->base_params($data);
        
    }
    
    public function upload_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

        if ($status != "error") {
            $config['upload_path'] = 'coa_scans_files/';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $image_path = $data['full_path'];
                 $file_ext = $data['file_ext'];
                 $fname = $data['orig_name'];
                if (file_exists($image_path)) {
                    $name =$this->input->post('title');
                    $labref =$this->input->post('labref');
                    $this->insert_file($labref, $fname, $name);
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    
        public function insert_file($labref, $filename, $title)
    {
        $data = array(
            'labref' =>$labref,
            'filename'      => $filename,
            'title'         => $title
        );
        $this->db->insert('coa_scans', $data);
        
    }
    
    function delete($id){
        $this->db->where('filename',$id)->delete('coa_scans'); 
        unlink('coa_scans_files/'.$id);
    }
    
     public function requests_list() {
        $request = $this->db->get('coa_scans')->result();
        if(!empty($request)){
            foreach ($request as $r) {
                $data[] = $r;
            }
            echo json_encode($data);
        }
        else{
            echo "[]";
        }
    }

    public function base_params($data) {
        
        $data['title'] = "COA SCANS MANAGEMENT ";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";    

        $this->load->view('template', $data);
    }

}
