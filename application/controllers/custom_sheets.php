<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Custom_sheets extends MY_Controller {

   function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    function index() {
        $data['depts'] = $this->getDepts();
        $data['settings_view'] = 'w_creation_v_m_1';
        $data['sheets'] = $this->loadsheets();

        $this->base_params($data);
    }
    
       function excel() {
        $data['depts'] = $this->getDepts();
        $data['settings_view'] = 'w_creation_v_m_1_1';
        $data['sheets'] = $this->loadesheets();
        $data['tests']= $this->loadTests();
        $this->base_params($data);
    }
function loadTests(){
    return $this->db->get('tests')->result();
}

    function getDepts() {
        return $this->db->get('test_departments')->result();
    }

    function do_upload() {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "samplepdfs/" . $sname . '.pdf';
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
            $data['depts'] = $this->getDepts();
            $data['sheets'] = $this->loadsheets();
            $data['settings_view'] = 'w_creation_v_m_1';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "samplepdfs";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'pdf';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v_m_1';
                $this->base_params($data);
            } else {
                $this->SaveWorksheetDetails();
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadsheets();
                $data['settings_view'] = 'w_creation_v_m_1';
                $this->base_params($data);
            }
        }
    }
    
    
    function excel_do_upload() {
        $w_name = $this->input->post('w_title');
        $sname = $this->sanitize_name(ucfirst($w_name));

        $filename = "exceltemplates/" . $sname . '.xlsx';
        if (file_exists($filename)) {
            $data['exists'] = $w_name . ' Already Exists';
            $data['depts'] = $this->getDepts();
            $data['sheets'] = $this->loadsheets();
            $data['settings_view'] = 'w_creation_v_m_1';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "exceltemplates";
            $config['file_name'] = $sname;
            $config['allowed_types'] = 'xlsx';


            $this->load->library('upload', $config);        
             
            

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadesheets();
                $data['settings_view'] = 'w_creation_v_m_1_1';
                $this->base_params($data);
            } else {
                $this->SaveWorksheetDetailse();
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['depts'] = $this->getDepts();
                $data['sheets'] = $this->loadesheets();
                $data['settings_view'] = 'w_creation_v_m_1_1';
                $this->base_params($data);
            }
        }
    }

    function do_upload_edit() {
        $w_name = $this->input->post('w_title_edit');
        $sname = $this->sanitize_name(ucfirst($w_name));
      


        $config['upload_path'] = "smplepdfs";
        $config['file_name'] = $sname;
        $config['allowed_types'] = 'pdf';


        $this->load->library('upload', $config);
        $file_name = $this->input->post('worksheet_edit');
        if ($file_name == '') {
            $this->upload_edit();            
            redirect('custom_sheets');
        } else {
            if (!$this->upload->do_upload('worksheet_edit')) {
                echo $this->upload->display_errors() . ' ' . "<a href='" . base_url() . 'worksheet_creation' . "'>Back</a>";
            } else {
                redirect('custom_sheets');
            }
        }
    }
    
       function do_upload_edite() {
        $w_name = $this->input->post('w_title_edit');
        $sname = $this->sanitize_name(ucfirst($w_name));
      


        $config['upload_path'] = "exceltemplates";
        $config['file_name'] = $sname;
        $config['allowed_types'] = 'xlsx';


        $this->load->library('upload', $config);
        $file_name = $this->input->post('worksheet_edit');
        if ($file_name == '') {
            $this->upload_edite();            
            redirect('custom_sheets/excel');
        } else {
            if (!$this->upload->do_upload('worksheet_edit')) {
                echo $this->upload->display_errors() . ' ' . "<a href='" . base_url() . 'worksheet_creation' . "'>Back</a>";
            } else {
                redirect('custom_sheets/excel');
            }
        }
    }

    function loadsheets() {

        return $this->db->get('worksheet_tests')->result();
    }
   function loadesheets() {

        return $this->db->get('worksheets_excel')->result();
    }
    function loadsheetsJ($id) {

        echo json_encode($this->db->where('id', $id)->get('worksheet_tests')->result());
    }
    
       function loadsheetsJe($id) {

        echo json_encode($this->db->where('id', $id)->get('worksheets_excel')->result());
    }
      function delete_me($id) {
        $sheet_name = $this->db->where('id', $id)->select('alias')->get('worksheets_excel')->result();
        echo $name = $sheet_name[0]->alias;
        $this->db->where('id', $id)->delete('worksheets_excel');
        unlink('exceltemplates/' . $name . '.xlsx');
        redirect('custom_sheets/excel');
    }

    function delete_m($id) {
        $sheet_name = $this->db->where('id', $id)->select('alias')->get('worksheet_tests')->result();
        echo $name = $sheet_name[0]->alias;
        $this->db->where('id', $id)->delete('worksheet_tests');
        unlink('samplepdfs/' . $name . '.pdf');
        redirect('custom_sheets');
    }

    public function SaveWorksheetDetails() {
        $w_name = $this->input->post('w_title');
        $file_details = array(
            'name' => ucfirst($w_name),
           
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->insert('worksheet_tests', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
       public function SaveWorksheetDetailse() {
        $w_name = $this->input->post('w_title');
          $test_id = $this->input->post('test_id');
        $file_details = array(
            'name' => ucfirst($w_name),
            'test_id'=>$test_id,
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->insert('worksheets_excel', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function upload_edit() {
        $id = $this->input->post('id');
        $w_name = $this->input->post('w_title_edit');
     
        $file_details = array(
            'name' => ucfirst($w_name),
           // 'department' => $department,
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->where('id', $id)->update('worksheet_tests', $file_details);
        if ($query) {
            $oldname=  $this->input->post('sheet_name');
            rename('samplepdfs/'.$oldname.'.pdf', 'samplepdfs/'.$this->sanitize_name(ucfirst($w_name)).'.pdf');
            return true;
        } else {
            return false;
        }
    }
    
        public function upload_edite() {
        $id = $this->input->post('id');
        $w_name = $this->input->post('w_title_edit');
     
        $file_details = array(
            'name' => ucfirst($w_name),
           // 'department' => $department,
            'alias' => $this->sanitize_name(ucfirst($w_name))
        );
        $query = $this->db->where('id', $id)->update('worksheets_excel', $file_details);
        if ($query) {
            $oldname=  $this->input->post('sheet_name');
            rename('exceltemplates/'.$oldname.'.xlsx', 'exceltemplates/'.$this->sanitize_name(ucfirst($w_name)).'.xlsx');
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
