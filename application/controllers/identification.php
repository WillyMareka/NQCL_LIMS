<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Identification extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function worksheet() {
        $data['labref'] = $this->uri->segment(3);
        $data['test_id']=$this->uri->segment(4);
        $data['settings_view'] = 'identification_v';
        $this->base_params($data);
    }

    function identification_r($labref) {
        $module = $this->uri->segment(1);
        $data['labref'] = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);

        $data['done'] = $this->checkApproval($module, $labref, $r, $c);

        $data['identification'] = $this->findIdentification($labref);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'identification_r_v';
        $this->base_params($data);
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('identification')
                        ->result()
        );
    }

    public function approve_data() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        //print_r($supervisor);
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,
            'repeat_status' => $r,
            'test_name' => 'identification',
            'component_no' => $c,
            'test_product' => 'csv',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'identification');
        $this->db->update('tests_done', array('approval_status' => '1'));


        $this->compareToDecide($labref);

        redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'identification');

        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            echo 'Already Approved';
        } else {
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

    function findIdentification($labref) {
        return $this->db
                        ->where('labref', $labref)
                        ->get('identification')
                        ->result();
    }

    function saveDescription($labref) {
        $repeat = $this->checkIdentificationRepeat($labref);
        $repeat_no = $repeat[0]->repeat_status + 1;
        $array = array(
            'labref' => $labref,
            'description' => $this->input->post('description'),
            'specification' => $this->input->post('specification'),
            'value3' => $this->input->post('value3'),
            'repeat_status' => $repeat_no,
            'date_time' => date('m-d-Y :H:i:s')
        );
        $this->db->insert('identification', $array);
        $this->save_test();
        $this->updateTestIssuanceStatus();
        $this->update_coa($labref);
         $labref=  $this->uri->segment(3);
                    $test_id=  $this->uri->segment(4);
                    //$this->updateUploadStatus($labref, $test_id);
        redirect('analyst_controller');
    }
       function update_coa($labref){
        $this->db
                ->where('labref',$labref)
                ->where('test_id',1)
                ->update('coa_body',array('specification'=>  $this->input->post('value3'),'determined'=>$this->input->post('specification'))
                        );
    }


    function save_test() {
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;
        $labref = $this->uri->segment(3);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $data = $this->check_repeat_status();
        $r_status = $data[0]->repeat_status + 1;
        $new_r_status = $r_status;
        $analyst_id = $this->session->userdata('user_id');


        $final_test_done = array(
            'labref' => $labref,
            'component_no' => '',
            'component' => '',
            'test_name' => 'identification',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'identification_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
        $this->post_posting();
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        //  $component = $this->input->post('heading');
        $posts = array(
            'labref' => $labref,
            'component' => 'identification',
            'test_name' => 'Identification',
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }
 
    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'identification');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
        //print_r($result);
    }

    function checkIdentificationRepeat($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('identification');
        return $result = $query->result();
        //return $result[0]->repeat_status;
        //print_r($result);
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array('done_status' => $done_status);
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 1);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);
        $this->comparetToDecide($labref);
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }
    
    
    	function GetProcAutocomplete($options=array())
	{
		$this->db ->distinct();
		$this->db->select('name');
		$this->db->like('name', $options['name'], 'after');
		$query = $this->db->get('proc_suggestions');
		return $query->result();

	}


	function procedure_suggestions()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetProcAutocomplete(array('name' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->name);

		echo json_encode($keywords);


	}
        
         	function GetFindingsAutocomplete($options=array())
	{
		$this->db ->distinct();
		$this->db->select('name');
		$this->db->like('name', $options['name'], 'after');
		$query = $this->db->get('proc_findings');
		return $query->result();

	}


	function Findings_suggestions()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetFindingsAutocomplete(array('name' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->name);

		echo json_encode($keywords);


	}
        
                 	function GetSpecificationsAutocomplete($options=array())
	{
		$this->db ->distinct();
		$this->db->select('name');
		$this->db->like('name', $options['name'], 'after');
		$query = $this->db->get('proc_specifications');
		return $query->result();

	}


	function Specifications_suggestions()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetSpecificationsAutocomplete(array('name' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->name);

		echo json_encode($keywords);


	}
    

    public function base_params($data) {
        $data['title'] = "Identification";
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
