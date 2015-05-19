<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Microbiology_worksheets extends MY_Controller {

   function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    function index() {
        $data['depts'] = $this->getDepts();
        $data['settings_view'] = 'w_creation_v_m';
        $data['sheets'] = $this->loadsheets();

        $this->base_params($data);
    }

    function getDepts() {
        return $this->db->get('test_departments')->result();
    }

    function do_upload() {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "microbiology_custom_worksheets/" . $sname . '.xlsx';
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
            $data['depts'] = $this->getDepts();
            $data['sheets'] = $this->loadsheets();
            $data['settings_view'] = 'w_creation_v_m';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "microbiology_custom_worksheets";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'xlsx';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v_m';
                $this->base_params($data);
            } else {
                   $this->SaveWorksheetDetails();
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v_m';
                $this->base_params($data);
            }
        }
    }

    function do_upload_edit() {
        $w_name = $this->input->post('w_title_edit');
        $sname = $this->sanitize_name(ucfirst($w_name));
      


        $config['upload_path'] = "microbiology_custom_worksheets";
        $config['file_name'] = $sname;
        $config['allowed_types'] = 'xlsx';


        $this->load->library('upload', $config);
        $file_name = $this->input->post('worksheet_edit');
        if ($file_name == '') {
            $this->upload_edit();            
            redirect('microbiology_worksheets');
        } else {
            if (!$this->upload->do_upload('worksheet_edit')) {
                echo $this->upload->display_errors() . ' ' . "<a href='" . base_url() . 'worksheet_creation' . "'>Back</a>";
            } else {
                redirect('microbiology_worksheets');
            }
        }
    }

    function loadsheets() {

        return $this->db->where('c_status', 1)->get('tests')->result();
    }

    function loadsheetsJ($id) {

        echo json_encode($this->db->where('id', $id)->where('c_status', 1)->get('tests')->result());
    }

    function delete_m($id) {
        $sheet_name = $this->db->where('id', $id)->select('alias')->get('tests')->result();
        echo $name = $sheet_name[0]->alias;
        $this->db->where('id', $id)->delete('tests');
        unlink('microbiology_custom_worksheets/' . $name . '.xlsx');
        redirect('microbiology_worksheets');
    }

    public function SaveWorksheetDetails() {
        $w_name = $this->input->post('w_title');
        $file_details = array(
            'name' => ucfirst($w_name),
            'department' => '2',
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->insert('tests', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function upload_edit() {
        $id = $this->input->post('id');
        $w_name = $this->input->post('w_title_edit');
        $department = $this->input->post('dept_edit');
        $file_details = array(
            'name' => ucfirst($w_name),
            'department' => $department,
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->where('id', $id)->update('tests', $file_details);
        if ($query) {
            $oldname=  $this->input->post('sheet_name');
            rename('microbiology_custom_worksheets/'.$oldname.'.xlsx', 'microbiology_custom_worksheets/'.$this->sanitize_name(ucfirst($w_name)).'.xlsx');
            return true;
        } else {
            return false;
        }
    }

    public function SaveWetChemSheets() {
        $w_name = $this->input->post('w_title');
         $department = $this->input->post('dept');
        $file_details = array(
            'name' => ucfirst($w_name),
            'department' => $department,
            'alias' => $this->sanitize_name(ucfirst($w_name)),
            'w_chem'=>1
        );
        $query = $this->db->insert('tests', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function base_params($data) {
        $data['title'] = "Worksheet Creation";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
