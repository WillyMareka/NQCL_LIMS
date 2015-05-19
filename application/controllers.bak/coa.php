<?php

class Coa extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('dompdf_lib');
    }
//
//    function generateCoa($labref) {
//        // error_reporting(1);
//        $data['labref'] = $labref = $this->uri->segment(3);
//        $data['information'] = $this->getRequestInformation($labref);
//        $data['tests_requested'] = $this->getRequestedTests($labref);
//        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
//       // print_r($data['trd']);
//        $data['signatories'] = $this->getSignatories($labref);
//        $data['coa_details'] = $this->getAssayDissSummary($labref);
//        $data['conclusion'] = $this->salvageConclusion($labref);
//        $data['coa_number'] = $this->salvageCOANumbering();
//
//        $data['settings_view'] = 'coa_v';
//        $this->base_params($data);
//    }
    
        function generateCoa($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat']=  $this->checkDirectorsComment($labref);
       $data['title']='COA -'.$labref;
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3',$data);
    }
    
       function generateCoa_r($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
       $data['title']='COA -'.$labref;
        $data['coa_stat']=  $this->checkDirectorsComment($labref);
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_review',$data);
    }
    
    function generateCoa_cr($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
          $data['coa_stat']=  $this->checkDirectorsComment($labref);
       $data['title']='COA -'.$labref;
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_after_r',$data);
    }
    
      function generateCoa_fd($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
          $data['coa_stat']=  $this->checkDirectorsComment($labref);
       $data['title']='COA -'.$labref;
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_1',$data);
    }
    
        function generateCoa_dash($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat']=  $this->checkDirectorsComment($labref);
        $data['title']='COA -'.$labref;
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_dash',$data);
    }
    function analyst_coa_view($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat']=  $this->checkDirectorsComment($labref);
        $data['title']='COA -'.$labref;
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_analyst',$data);
    }

    function saveCOA() {
        $labref = $this->uri->segment(3);
        $test_id = $this->getRequestedTestIds($labref);

        if ($this->checkIfCOABodyExists($labref) == '1') {
           // $method_array = $this->input->post('method');   
           // $compedia_array = $this->input->post('compedia');
            //$specification_array = $this->input->post('specification');
           // $complies_array = $this->input->post('complies');
            $testid_array = $this->input->post('tests');
            
            $method1_array=array();
            $compedia1_array=array();
            $specification1_array=array();
            $determined_array=array();
            $complies1_array=array();
            
            
            $temp_array1=array();
            $temp_array2=array();
            $temp_array3=array();
            $temp_array4=array();
            $temp_array5=array();
            
            $count=0;
            
            foreach($testid_array as $temp_array){
                
              $temp_array1=$this->input->post('determined_'.$count);
              $temp_array2=$this->input->post('method_'.$count);
              $temp_array3=$this->input->post('compedia_'.$count);
              $temp_array4=$this->input->post('specification_'.$count);
              $temp_array5=$this->input->post('complies_'.$count);             
              
              
              $method1_array[$temp_array]= implode(':',$temp_array2); 
              $compedia1_array[$temp_array]= implode(':',$temp_array3); 
              $specification1_array[$temp_array]= implode(':',$temp_array4); 
              $determined_array[$temp_array]= implode(':',$temp_array1); 
              $complies1_array[$temp_array]= implode(':',$temp_array5); 
              $count++;
            }
            
        
            $spec_count = 0;
            foreach ($testid_array as $testid) {

                $update_data = array(
                    'method' => $method1_array[$testid],
                    'compedia' => $compedia1_array[$testid],
                    'specification' => $specification1_array[$testid],
                    'determined' => $determined_array[$testid],
                    'complies' => $complies1_array[$testid],
                    'conclusion'=>$this->input->post('conclusion')
                );
                

                

                $this->db->where('labref', $labref);
                $this->db->where('test_id', $testid);
                $this->db->update('coa_body', $update_data);
                $spec_count++;
            }
            //$this->db->where( 'test_id',$testid);
            $new_numbers=  $this->salvageCOANumbering();
            $number=$new_numbers[0]->number+1;
            $full_number = "CAN/".$number."/".date('Y');
           // $this->db->where('labref', $labref);
            //$this->db->update('coa_body', array('conclusion' => $this->input->post('conclusion')));
            $this->db->update('coa_number',array('number'=> $number, 'full_number' => $full_number, 'request_id' => $labref));
            $this->coaIsDraftedUpdate($labref);
            $this->saveCOATOP($labref);
            $this->generate_certificate($labref);
            $this->convertToPdf($labref);

           //$this->generateCoaDraft($labref);
         //$this->output->enable_profiler();
        } else {
            $compedia_array = $this->input->post('compedia');
            $specification_array = $this->input->post('specification');
            $testid_array = $this->input->post('tests');
            $spec_count = 0;
            foreach ($testid_array as $testid) {
                $update_data = array(
                    'compedia' => $compedia_array[$spec_count],
                    'specification' => $specification_array[$spec_count]
                );
                $this->db->where('labref', $labref);
                $this->db->where('test_id', $testid);
                $this->db->update('coa_body', $update_data);
                $spec_count++;
            }
            $this->generate_certificate($labref);
           // $this->generateCoaDraft($labref);
        }
    }
    
      	function GetProcAutocomplete($options=array())
	{
		$this->db ->distinct();
		$this->db->select('name');
		$this->db->like('name', $options['name'], 'after');
		$query = $this->db->get('proc_suggestions');
		return $query->result();

	}


	function method_suggestions()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetProcAutocomplete(array('name' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->name);

		echo json_encode($keywords);


	}
    
    function saveCOATOP($labref){
        
        $data = array(
            'manufacturer_name' =>$this->input->post('manufacturer'),
            'manufacturer_add' =>$this->input->post('address'),
            'label_claim' =>$this->input->post('labelclaim'),
            'presentation'=>$this->input->post('presentation')
          
        );
        $this->db->where('request_id',$labref)->update('request',$data);
        
    }

    function coaIsDraftedUpdate($labref) {
        $coaUpdate = array('coa_status' => '1');
        $this->db->where('labref', $labref);
        $this->db->update('reviewer_documentation', $coaUpdate);
    }

    function getCOABody($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        $result = $query->result();
        return $result;
        //print_r($result);
    }

    function checkIfCOABodyExists($labref) {
        $this->db->select('labref');
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function generateCoaDraft($labref, $offset = 0) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['signatories'] = $this->getSignatories($labref);
        $data['compedia_specification'] = $this->getCOABody($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();
        $html = $this->load->view('coa_v_2', $data, true);
        $this->dompdf_lib->createPDF($html, $labref);
    }

    function makeCoaSecondPart($labref) {
        $cd = $this->getCOABody($labref);
        for ($i = 0; $i < count($cd); $i++) {
            echo $cd[$i]->compedia;
        }
    }

    function getRequestInformation($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        return $Information;
    }

    function getRequestedTests($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $this->db->order_by('name', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
                    return $object->name;
                }, $result);
        return $tests = implode(', ', $output);
    }

    function getRequestedTestIds($labref) {
        $this->db->select('test_id');
        $this->db->from('coa_body');
        //$this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('labref', $labref);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
        // print_r($result);
    }

    function getRequestedTestsDisplay($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getRequestedTestsDisplay2($labref) {
        $query = $this->db->query("SELECT  t.id as test_id, cb.method AS methods,`name` , `compedia`,`determined` , `specification`,complies
                                 FROM (
                                       `tests` t, `coa_body` cb
                                       )
                                JOIN `request_details` rd ON `t`.`id` = `cb`.`test_id`
                                WHERE `rd`.`request_id` = '$labref'
                                AND cb.labref = '$labref'
                                GROUP BY name
                                ORDER BY name DESC
                                LIMIT 0 , 30");
        $result = $query->result();
       // print_r($result);

        return $result;
        // print_r($result);
    }

    function salvageConclusion($labref) {
        $this->db->select('conclusion');
        $this->db->where('labref', $labref);
        $this->db->group_by('labref');
        $query = $this->db->get('coa_body');
        
        return $result = $query->result();
        //print_r($result);
    }

    function salvageCOANumbering() {
        $this->db->select('number');
        $query = $this->db->get('coa_number');
        return $result = $query->result();
        //print_r($result);
    }

    function getAssayDissSummary($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
         $result = $query->result();
        // print_r($result);
         return $result;
    }

    function getSignatories($labref) {
        $this->db->where('labref', $labref);
        $this->db->group_by('signature_name', $labref);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('signature_table');
        return$result = $query->result();
        // print_r($result);
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "COA - " . $labref;
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

