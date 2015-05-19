<?php

class Worksheet_creation extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    function index() {
        $data['depts'] = $this->getDepts();
        $data['settings_view'] = 'w_creation_v';
        $data['sheets'] = $this->loadsheets();

        $this->base_params($data);
    }

    function getDepts() {
        return $this->db->get('test_departments')->result();
    }

    function do_upload() {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "custom_worksheets/" . $sname . '.xlsx';
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
            $data['depts'] = $this->getDepts();
            $data['sheets'] = $this->loadsheets();
            $data['settings_view'] = 'w_creation_v';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "custom_worksheets";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'xlsx|pdf';


            $this->load->library('upload', $config);
            $department = $this->input->post('dept');
            if ($department == '1') {
                $this->SaveWetChemSheets();
            } else {
                $this->SaveWorksheetDetails();
            }

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v';
                $this->base_params($data);
            } else {
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v';
                $this->base_params($data);
            }
        }
    }

    function do_upload_edit() {
        $w_name = $this->input->post('w_title_edit');
        $sname = $this->sanitize_name(ucfirst($w_name));
        $filename = "custom_worksheets/" . $sname . '.xlsx';


        $config['upload_path'] = "custom_worksheets";
        $config['file_name'] = $sname;
        $config['allowed_types'] = 'xlsx|pdf';


        $this->load->library('upload', $config);
        $file_name = $this->input->post('worksheet_edit');
        if ($file_name == '') {
            $this->upload_edit();            
            redirect('worksheet_creation');
        } else {
            if (!$this->upload->do_upload('worksheet_edit')) {
                echo $this->upload->display_errors() . ' ' . "<a href='" . base_url() . 'worksheet_creation' . "'>Back</a>";
            } else {
                redirect('worksheet_creation');
            }
        }
    }

    function loadsheets() {

        return $this->db->where('c_status', 1)->get('tests')->result();
    }

    function loadsheetsJ($id) {

        echo json_encode($this->db->where('id', $id)->where('c_status', 1)->get('tests')->result());
    }

    function delete($id) {
        $sheet_name = $this->db->where('id', $id)->select('alias')->get('tests')->result();
        echo $name = $sheet_name[0]->alias;
        $this->db->where('id', $id)->delete('tests');
        unlink('custom_worksheets/' . $name . '.pdf');
        redirect('worksheet_creation');
    }

    public function SaveWorksheetDetails() {
        $w_name = $this->input->post('w_title');
        $department = $this->input->post('dept');
        $file_details = array(
            'name' => ucfirst($w_name),
            'department' => $department,
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
            rename('custom_worksheets/'.$oldname.'.pdf', 'custom_worksheets/'.$this->sanitize_name(ucfirst($w_name)).'.xlsx');
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
