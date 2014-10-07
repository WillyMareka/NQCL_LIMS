<?php
class Oos_sample extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> listing();
	}

	function GetAutocomplete($options=array())
	{
		$this->db ->distinct();
		$this->db->select('name');
		$this->db->like('name', $options['name'], 'after');
		$query = $this->db->get('clients');
		return $query->result();

	}


	function suggestions()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetAutocomplete(array('name' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->name);

		echo json_encode($keywords);


	}


	function GetAutocompleteManufacturerAddress($options=array())
	{
		$this->db ->distinct();
		$this->db->select('manufacturer_add');
		$this->db->like('manufacturer_add', $options['manufacturer_add'], 'after');
		$query = $this->db->get('request');
		return $query->result();

	}


	function suggestions1()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetAutocompleteManufacturerAddress(array('manufacturer_add' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->manufacturer_add);

		echo json_encode($keywords);
	}

	function GetLabelClaim($options=array())
	{
		$this->db ->distinct();
		$this->db->select('label_claim');
		$this->db->like('label_claim', $options['label_claim'], 'after');
		$query = $this->db->get('request');
		return $query->result();

	}


	function suggestions2()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetLabelClaim(array('label_claim' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->label_claim);

		echo json_encode($keywords);
	}

	function GetProductName($options=array())
	{
		$this->db ->distinct();
		$this->db->select('product_name');
		$this->db->like('product_name', $options['product_name'], 'after');
		$query = $this->db->get('request');
		return $query->result();

	}


	function suggestions3()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetProductName(array('product_name' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->product_name);

		echo json_encode($keywords);
	}



	function getCodes() {
		$ref = $this -> uri -> segment(3);
		$ref = str_replace('%20', '_', $ref);
		$codes = Clients::getClientDetails($ref);
		echo json_encode($codes);
	}

	function pushCodes(){
		$codes = $this->getCodes();
		$codes_array = array();

		foreach($codes as $code)
			array_push($codes_array, $code->code);
		echo json_encode($codes_array);
	}

	function suggestions4()
	{

		$term = $this->input->post('term',TRUE);

		$rows = $this->GetProductDescription(array('description' => $term));

		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row->description);

		echo json_encode($keywords);
	}

	function GetProductDescription($options=array())
	{
		$this->db ->distinct();
		$this->db->select('description');
		$this->db->like('description', $options['description'], 'after');
		$query = $this->db->get('request');
		return $query->result();

	}


	public function test_methods(){
		$reqid = $this -> uri -> segment(3);
		$data['tests'] = Request_details::getTests($reqid);
		$data['settings_view'] = "tests_methods_v";
		$this -> base_params($data);
	}



	public function coPackageSave(){
		
		if (is_null($_POST)) {
			echo json_encode(array(
					'status' => 'error',
					'message'=> 'Data was not posted.'
			));
		}
		else
		{
			echo json_encode(array(
					'status' => 'success',
					'message'=> 'Data added successfully',
					'array' => json_encode($_POST)
			));
		}
		
		$reqid =  $this -> uri -> segment(3);
		$no_of_packs = $this -> input -> post("no_of_packs",TRUE);
		

		for($i = 1; $i <= $no_of_packs; $i++){
			$copack = new Copackages();
			$copack -> request_id = $reqid;
			$copack -> pack_no = $i;
			$copack -> no_of_packs = $no_of_packs;
			$copack -> save();
		}

	}
	
	public function coPackageDetailsSave() {
		if (is_null($_POST)) {
			echo json_encode(array(
					'status' => 'error',
					'message'=> 'Data was not posted.'
			));
		}
		else
		{
			echo json_encode(array(
					'status' => 'success',
					'message'=> 'Data added successfully',
					'array' => json_encode($_POST)
			));
		}
		
		$reqid = $this->uri->segment(3);
		$name = $this -> input -> post('cp_name', TRUE);
		$batch_no = $this -> input -> post('cp_batch_no', TRUE);
		$exp_date = $this -> input -> post('cp_exp_date', TRUE);
		$mfg_date = $this -> input -> post('cp_mfg_date', TRUE);
		$quantity = $this -> input -> post('cp_quantity', TRUE);
		$unit = $this -> input -> post('cp_unit', TRUE);
		

		
		$copack = new Copackages();
		$copack -> name = $name;
		$copack -> request_id = $reqid;
		$copack -> batch_no = $batch_no;
		$copack -> exp_date = date('y-m-d',strtotime($exp_date));
		$copack -> mfg_date = date('y-m-d',strtotime($mfg_date));
		$copack -> quantity = $quantity;
		$copack -> unit = $unit;
		$copack -> save();
		
		
	}


	public function getTestMethods(){
		$testid = $this -> uri -> segment(3);
		$methods = Test_methods::getMethods($testid);
		echo json_encode($methods);
	}

	public function getMethodTypes(){
		$types = Test_methods_types::getAll();
		echo json_encode($types);
	}

	public function history(){

		$reqid = $this -> uri -> segment(3);
		$version_id = $this -> uri -> segment(4);
		//$data['row_count'] = Request::getRowCount();
		$data['history'] = Request::getHistory($reqid, $version_id);
		//$this -> view -> load('history_table');
		//$data['test_history'] = Request_details::testHistory($reqid, $version_id);
		//$data['settings_view'] = "history";
		$this -> load -> view('history',$data);

	}


	public function other_history(){

		$reqid = $this -> uri -> segment(3);
		$version_id = $this -> uri -> segment(4);
		//$data['row_count'] = Request::getRowCount();
		$data['chistory'] = Clients::getHistory($reqid, $version_id);
		$data['thistory'] = Request_details::getTestHistory($reqid, $version_id);
		//$this -> view -> load('history_table');
		//$data['test_history'] = Request_details::testHistory($reqid, $version_id);
		//$data['settings_view'] = "history";
		$this -> load -> view('other_history',$data);

	}


	public function getLabelPdf(){

		require_once("application/helpers/dompdf/dompdf_config.inc.php");
		 
		$this->load->helper('dompdf','file');
		$this->load->helper('file');
		 
		$dompdf = new DOMPDF();
		$dompdf->set_paper('A5', "portrait");
		 
		$saveTo = './labels';
		$data['reqid'] = $this -> uri -> segment(3);
		$data['prints_no'] = $this -> uri -> segment(4);
		$labelname = "Label". $data['reqid'] . ".pdf";
		$data['infos'] =Request::getSample($data['reqid']);
		$data['settings_view'] = "label_view2";
		$this -> base_params($data);
		$html = $this->load->view('label_view2', $data, TRUE);
		 
		$dompdf->load_html($html);
		$dompdf->render();
		write_file($saveTo."/".$labelname, $dompdf->output());
	}


	public function edit_view() {
		$data['requests'] = Request::getAll();
		$this -> load -> view("requests_v_ajax", $data);
	}

	public function requests_list(){
		$request = Request::getAllHydrated();
		foreach ($request as $r){
			$data[] = $r;
		}
		echo json_encode($data);
	}


	public function getRequest(){
		$reqid = $this -> uri -> segment(3);
		$request = Request::getSingleHydrated($reqid);
		echo json_encode($request);
	}


	public function setPresentationDescription(){
		$reqid = $this -> uri -> segment(3);
		$test_id = $this -> uri -> segment(4);
		$presentation = $this -> input -> post("presentation");
		$description = $this -> input -> post("description");
		$worksheet_url = $this -> input -> post("worksheet_url");
		
		$desc_status = '1';
		
		$this -> session -> set_userdata('wksht_url', $worksheet_url);
		$presentation_description_update = array(
				'description' =>  $description,
				'presentation' =>  $presentation
		);

		$sample_issuance_update = array(
				'desc_status' => $desc_status
		);
	
		$s_array = array(
				'lab_ref_no' => $reqid
		);
		
		$this -> db -> where($s_array);
		$this -> db -> update('sample_issuance', $sample_issuance_update);

		$this -> db -> where('request_id', $reqid);
		$this -> db -> update('request', $presentation_description_update);
	}


	public function getClientInfo(){
		$id = $this -> uri -> segment(3);
		$id = Clients::getClientInfo($id);
		echo json_encode($id);
	}
        function Assigned_samples(){
                $data['settings_view'] = "request_v_ds";
		$data['info'] =  $this->getAssigned();
               $data['title'] = "Assigned Samples";
		$this -> base_params($data);    
        }
        
          function Review_samples(){
                $data['settings_view'] = "request_v_rs";
		$data['info'] =  $this->getReview();
               $data['title'] = "Review Samples";
		$this -> base_params($data);    
        }
        
        function getAssigned(){
            return $this->db->where('stat',0)->get('assigned_samples')->result();
        }
        
         function getReview(){
            return $this->db->where('stat',0)->get('review_samples')->result();
        }
        function complete($labref){
            $this->db->where('labref',$labref)->update('assigned_samples',array('a_stat'=>1));  
           // $this->db->where('labref',$labref)->update('assigned_samples',array('stat'=>1));  
            redirect('request_management/assigned_samples');
        }
 
        
        
       public function SendToReviewer() {
               
        $labref = $this->uri->segment(3);
        $reviewer_name = $this->input->post('reviewer');        
  
        $data = array(
            'labref' => $labref,
            'analyst_name' => $reviewer_name,
            'date_time'=>date('d-m-Y H:i:s'),
            
        );
         $this->db->insert('review_samples', $data);
         $this->db->where('labref',$labref)->update('assigned_samples',array('stat'=>1));  
         //redirect('request_management/assigned_samples');
    }

	public function listing() {
		//$data = array();
            $data['title'] = "OOS Samples";
		$data['settings_view'] = "oos_v";
		//$data['info'] =  $this->getAll_Oos();;
		$this -> base_params($data);
	}//end listing

        public function getAll_Oos() {
            $data= $this->db->where('oos',1)->get('oos_request')->result();
            foreach ($data as $r):
                $result[]=$r;
            endforeach;
            echo json_encode($result);
        }
        

        
	function ajax_loader() {
		$this->db->select_max('id');
		$query = $this->db->get('request');
		$data = $query->result();
		echo json_encode($data);
	}


	function ajax_client_loader() {
		$this->db->select_max('id');
		$query = $this->db->get('clients');
		$data = $query->result();
		return $data;
	}

	public function add() {
		$data['new_clientid'] = $this -> ajax_client_loader();
		$data['months'] = Months::getAll();
		$data['title'] = "Add New Request";
		$data['last_req_id']= Request::getLastRequestId();
		$data['lastClient'] = Clients::getLastId();
		//var_dump($data['last_req_id']);
		$data['dosageforms'] = Dosage_form::getAll();
		$data['packages'] = Packaging::getAll();
		$data['usertypes'] = User_type::getAll();
		$data['clients'] = Clients::getAll();
		$data['sample_id'] = Sample_Information::getAll();
		$data['wetchemistry'] = Tests::getWetChemistry();
		$data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
		$data['medicaldevices'] = Tests::getMedicalDevices();
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("jquery.ui.core.js","jquery.ui.datepicker.js","jquery.ui.widget.js");
		$data['styles'] = array("jquery.ui.all.css");
		$data['settings_view'] = "request_v";
		$this -> base_params($data);
	}//end add


	public function edit(){
		$reqid = $this -> uri -> segment(3);
		$data['reqid'] = $this -> uri -> segment(3);
		$data['tests_checked']  = Request_details::getTestsNames($reqid);
		$data['tests_issued'] = Sample_issuance::getIssuedTests2($reqid);
		$data['months'] = Months::getAll();
		$data['dosageforms'] = Dosage_form::getAll();
		$data['wetchemistry'] = Tests::getWetChemistry();
		$data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
		$data['medicaldevices'] = Tests::getMedicalDevices();
		$data['client'] = Clients::getClient2($reqid);
		$data['request'] = Request::getAll5($reqid);
		$data['content_view'] = "edit_request";
		$data['info'] =Request::getAll();
		$this -> load -> view("template1", $data);
	}


	public function getTestName(){
		$test_id = $this -> uri -> segment(3);
		$test = Tests::getTestName3($test_id);
		foreach ($test as $t){
			$data[] = $t;
		}
		echo json_encode($data);
	}


	public function save() {


		if (is_null($_POST)) {
			echo json_encode(array(
					'status' => 'error',
					'message'=> 'Data was not posted.'
			));
		}
		else
		{
			echo json_encode(array(
					'status' => 'success',
					'message'=> 'Data added successfully',
					'array' => json_encode($_POST)
			));
		}

		$dsgntr = $this -> input -> post("dsgntr");
		$dsgntn = $this -> input -> post("dsgntn");
		$moa = $this -> input -> post("moa");
		$crs = $this -> input -> post("crs");

		$dateformat = $this -> input -> post("dateformat");
		$test =$this -> input -> post("test");
		$clientid = $this -> input -> post("clientid");
		$product_name = $this -> input -> post("product_name");
		$dosage_form = $this -> input -> post("dosage_form");
		$manufacturer_name = $this -> input -> post("manufacturer_name");
		$manufacturer_address = $this -> input -> post("manufacturer_address");
		$batch_no = $this -> input -> post("batch_no");
			if($dateformat == 'dmy'){
				$expiry_date = $this -> input -> post("date_e");
				$manufacture_date = $this -> input -> post("date_m");
			}
			else if($dateformat == 'my'){
				$ed = "31 ". $this -> input -> post("e_date");
				$md = "01 ". $this -> input -> post("m_date");
				$expiry_date = str_replace(' ', '-', $ed);
				$manufacture_date = str_replace(' ', '-', $md);
			}
		$label_claim = $this -> input -> post("label_claim");
		$active_ingredients = $this -> input -> post("active_ingredients");
		$quantity = $this -> input -> post("quantity");
		$applicant_reference_number = $this -> input -> post("applicant_reference_number");
		$client_number = $this -> input -> post("ndqno");
		$designator_name = $this -> input -> post("designator_name");
		$designation = $this -> input -> post("designation");
		$designation_date = $this -> input -> post("designation_date");
		$urgency = $this -> input -> post("urgency");
		$edit_notes = $this -> input -> post("edit_notes");
		$country_of_origin = $this -> input -> post("country_of_origin");
		$product_lic_no = $this -> input -> post("product_lic_no");
		$presentation = $this -> input -> post("presentation");
		$description = $this -> input -> post("description");
		$clientsampleref = $this -> input -> post("applicant_reference_number");
		$packaging = $this -> input -> post("packaging");
		//$full_details_status = 0;


		$request = new Request();
		$request -> dsgntn = $dsgntn;
		$request -> dsgntr = $dsgntr;
		$request -> moa = $moa;
		$request -> crs = $crs;
		$request -> clientsampleref = $clientsampleref;
		$request -> dateformat = $dateformat;
		$request -> description = $description;
		$request -> presentation = $presentation;
		$request -> product_lic_no = $product_lic_no;
		$request -> country_of_origin = $country_of_origin;
		$request -> client_id = $clientid;
		$request -> product_name = $product_name;
		$request -> Dosage_Form = $dosage_form;
		$request -> Manufacturer_Name = $manufacturer_name;
		$request -> Manufacturer_add = $manufacturer_address;
		$request -> Batch_no = $batch_no;
		//$request -> full_details_status = $full_details_status;
		$request -> exp_date = date('Y-m-d', strtotime($expiry_date));
		$request -> Manufacture_date = date('Y-m-d', strtotime($manufacture_date));
		$request -> label_claim = $label_claim;
		$request -> Urgency = $urgency;
		$request -> active_ing = $active_ingredients;
		$request -> sample_qty = $quantity;
		$request -> request_id = $client_number;
		$request -> Designator_Name = $designator_name;
		$request -> Designation = $designation;
		$request -> Designation_date = date('y-m-d',strtotime($designation_date));
		$request -> edit_notes = $edit_notes;
		$request -> packaging = $packaging;
		$request -> save();
		$this->create_sample_folder($client_number);
                $this->create_coa_folder($client_number);
		 $this->addSampleTrackingInformation();

		for($i=0;$i<count($test);$i++){
			$request = new Request_details();
			$request -> test_id = $test[$i];
			$request -> request_id = $client_number;
			$request -> save();
		}

		for($i=0;$i<count($test);$i++){
			$coa = new Coa_body();
			$coa -> test_id = $test[$i];
			$coa -> labref = $client_number;
			$coa -> save();
		}

		$no = "  ";
		$dr = new Dispatch_register();
		$dr -> client_id = $clientid;
		$dr -> date = date('y-m-d');
		$dr -> cert_no = "CAN" . "/" . $no ."/". date('y');
		$dr -> request_id = $client_number;
		$dr -> invoice_no = $no. "/" .date('y');
		$dr -> save();

		for($i=0;$i<count($test);$i++){
			$test_charges = Tests_charges::getTestCharge($test[$i]);
			$test_methods = Test_methods::getMethodsHydrated($test[$i]);
			//$method_charges = Test_methods_charges::getMethodCharge($test[$i]);
			$cb = new Client_billing();
			$cb -> request_id = $client_number;
			$cb -> client_id = $clientid;
			$cb -> test_id = $test[$i];
				if(!empty($test_charges)){
					$cb -> test_charge = $test_charges[0]['charge'];	
					$tcharges[] = $test_charges[0]['charge'];
				}
			//$coa -> total_test_charge = $test_charges[0]['charge'] + $method_charges[0]['charge'];
			$cb -> save();
		}

			


		if($this -> checkUserExistsThenSendorError() == '0' ){
			$client_name = $this -> input -> post("client_name");
			$client_address = $this -> input -> post("client_address");
			$client_number = $this -> input -> post("clientT");
			$contact_person = $this -> input -> post("contact_person");
			$contact_phone = $this -> input -> post("contact_phone");
			//$client_ref_no = $this -> input -> post("client_ref_no");
			$client_id = $this -> input -> post("clientid");
			$alias = str_replace(' ', '_', $client_name);
			//variable storing the class instance
			$client = new Clients();

			//passing the variables posted above to the class variable
			$client -> Name = $client_name;
			$client -> Address = $client_address;
			$client -> Client_type = $client_number;
			$client -> Contact_person = $contact_person;
			$client -> Contact_phone = $contact_phone;
			//$client -> Ref_number = $client_ref_no;

			$client -> Clientid = $client_id;
			$client -> Alias = $alias;
			//save the data
			$client -> save();
		}




	}


	public function testCh () {
		$t = $this -> uri -> segment(3);
		$test_charges = Tests_charges::getTestCharge($t);
		if(empty($test_charges)){
			$test_methods = Test_methods::getMethodsHydrated($t);
		}
		var_dump($test_methods[0]['charge']);
	}




	public function checkUserExistsThenSendorError() {
		$user_is = $this->input->post('clientid');
		$this->db->select('id');
		$this->db->where('id', $user_is);
		$query = $this->db->get('clients');
		if ($query->num_rows() > 0) {
			return '1';
		} else {
			return '0';
		}
	}


	public function setComponents(){
		if (is_null($_POST)) {
			echo json_encode(array(
					'status' => 'error',
					'message'=> 'Data was not posted.'
			));
		}
		else
		{
			echo json_encode(array(
					'status' => 'success',
					'message'=> 'Data added successfully',
					'array' => json_encode($_POST)
			));
		}
		
		$multicomponent_status = $this -> input -> post("multicomponent");
		$components =$this -> input -> post("component");
		$component_volume = $this -> input -> post("component_volume");
		$component_unit = $this -> input -> post("component_unit");
		$multistage_status = $this -> input -> post("multistage");
		$stages_no = $this -> input -> post("multistage_no");
		//$this->output->enable_profiler();
		$testid = $this->uri->segment(4);
		$request_id = $this->uri->segment(3);
		$dissolution_id = '2';
		
		$stage = new Stages();
		$stage -> test_id = $testid;
		$stage -> stages_no = $stages_no;
		$stage -> stage_status = $multistage_status;
		$stage -> request_id = $request_id;
		$stage -> save();
		
		//Update Multicomponent and Multistage Statuses in the Client Billing Table
		$cb_cstatus_updateArray = array('component_status' => $multicomponent_status);
		$cb_mstatus_updateArray = array('stage_status' => $multistage_status);
		$dissolution_where_array = array('request_id' => $request_id, 'test_id' => $dissolution_id);

		$this -> db -> where('request_id', $request_id);
		$this -> db -> update('client_billing', $cb_cstatus_updateArray);

		$this -> db -> where($dissolution_where_array);
		$this -> db -> update('client_billing', $cb_mstatus_updateArray);
		
		//if($multicomponent_status == '1'){
			for ($i = 0; $i < count($components); $i++){
				$component = new Components();
				$component -> test_id = $testid;
				$component -> name = $components[$i];
				$component -> volume = $component_volume[$i];
				$component -> unit = $component_unit[$i];
				$component -> request_id = $request_id;
				$component -> save();	
			}
	//}
	
	/*else {
		  
		//Since not Multicomponent, assume Product Name will be Component Name
		//Therefore get product name from requests table
		//$request_info = Request::getComponentName($request_id);
		$component_name = $request_info[0]-> product_name;
		
		$component = new Components();
		$component -> test_id = $testid;
		$component -> name = $component_name;
		$component -> request_id = $request_id;
		$component -> save();
		
	}*/
		
	}

	
	public function showComponents(){
		$data['reqid'] = $this -> uri -> segment(3);
		$data['test_id'] = $this -> uri -> segment(4);
		$data['component_status'] = $this -> uri -> segment(5);
		$data['components'] = Components::getComponents($data['reqid']);
		$data['last_component'] = Components::getLastComponent($data['reqid'], $data['test_id']);
		$data['methods']= Test_methods::getMethods($data['test_id']);
		$data['content_view'] = "componentsWizard_v";
		$this -> load -> view('template1', $data);
	}

	public function updateComponents(){
		
		if (is_null($_POST)) {
			echo json_encode(array(
					'status' => 'error',
					'message'=> 'Data was not posted.'
			));
		}
		else
		{
			echo json_encode(array(
					'status' => 'success',
					'message'=> 'Data added successfully',
					'array' => json_encode($_POST)
			));
		}
		
		$componentName = $this -> input -> post("component_name");
		$methodName = $this -> input -> post("name");
		$methodId = $this -> input -> post("id");
		$reqid = $this->uri->segment(3);
		$test_id =$this->uri->segment(4);
		
		$componentsUpdateArray = array(
			'method_id' => $methodId,
			'method_name' => $methodName			
		);

		$this -> db -> where('request_id', $reqid);
		$this -> db -> insert('components', $componentsUpdateArray);

	}
	
		public function updateMethods(){
		
		if (is_null($_POST)) {
			echo json_encode(array(
					'status' => 'error',
					'message'=> 'Data was not posted.'
			));
		}
		else
		{
			echo json_encode(array(
					'status' => 'success',
					'message'=> 'Data added successfully',
					'array' => json_encode($_POST)
		
			));
		}
		
		$reqid = $this->uri->segment(3);
		$test_id =$this->uri->segment(4);
		$component_ids = $this -> input -> post("component_ids");
		$method_status = "1";
		$data['components'] = Components::getComponents($reqid, $test_id);
		

		
		for($i=0; $i < count($component_ids); $i++){	 
			$post_index = "component" . $component_ids[$i];
			$method_name = $this -> input -> post($post_index);
			$method_charges = Test_methods::getMethodChargeHydrated($method_name, $test_id);
                        if(empty($method_charges)){
                            $method_charge ='0';
                            $method_id='0';
                        }else{
			$method_charge = $method_charges[0]['charge'];
                        $method_id = $method_charges[0]['id'];	
                        }
			//$method_id = $method_charges[0]['id'];	
			$methodsUpdateArray = array(
				'method' => $this -> input -> post($post_index)			
			);

			$methodsUpdateArray2 = array(
				'method_name' => $this -> input -> post($post_index)				
			);

			$m_array = array(
				'labref' => $reqid ,
				'test_id' => $test_id	
			);

			$m_array3 = array(
				'request_id' => $reqid ,
				'test_id' => $test_id	
			);

			$clientBillingWhereArray = array(
				'test_id' => $test_id,
				'request_id' => $reqid
			);

			$clientBillingUpdateArray = array(
				'method_id' => $method_id,
				'method_charge' => $method_charge			
			);	


		$this -> db -> where($m_array);
		$this -> db -> update('coa_body', $methodsUpdateArray);	

		$this -> db -> where($m_array3);
		$this -> db -> update('components', $methodsUpdateArray2);

		$this -> db -> where($clientBillingWhereArray);
		$this -> db -> update('client_billing', $clientBillingUpdateArray);

		}
		
		$m_array2 = array(
			'lab_ref_no' => $reqid ,
			'test_id' => $test_id	
		);

		$m_status_array = array('method_status' => $method_status);

		$this -> db -> where($m_array2);
		$this -> db -> update('sample_issuance', $m_status_array);

		
	}
	
	public function quotation(){

		$reqid = $this -> uri -> segment(4);
		$methodIdArray = Request_test_methods::getMethods($reqid);
		$testIdArray = Request_details::getTests($reqid);

		foreach ($methodIdArray as $methodArray){
			$data['method_charges'][] = Test_methods_charges::getCharges($methodArray['test_id']);
		}

		foreach ($testIdArray as $testArray){
			$data['test_charges'][] = Tests::getCharges($testArray['test_id']);
		}

		/*for($i = 0; $i < count($testIdArray); $i++){
		 $data['test_charges'][] = Tests_charges::getCharges($testIdArray[$i]['id']);
		}*/

		//var_dump($testIdArray);
		$data['settings_view'] = 'invoice_v';
		$this -> base_params($data);
	}

	public function getMethodCharges(){
		$mid = $this -> uri -> segment(3);
		$data['mcharges'] = Test_methods_charges::getMethodCharges($mid);
		$data['settings_view'] = "mcharges_v";
	}

	public function update(){

			
		//Variables storing the analysis request variables
		//variable storing the class instance

		$tests =$this -> input -> post("test");
		$clientid = $this -> input -> post("client_id");
		$product_name = $this -> input -> post("product_name");
		$dosage_form = $this -> input -> post("dosage_form");
		$manufacturer_name = $this -> input -> post("manufacturer_name");
		$manufacturer_address = $this -> input -> post("manufacturer_address");
		$batch_no = $this -> input -> post("batch_no");
		$dateformat = $this -> input -> post("dateformat");
		$expiry_date = $this -> input -> post("date_e");
		$manufacture_date = $this -> input -> post("date_m");
		$label_claim = $this -> input -> post("label_claim");
		$active_ingredients = $this -> input -> post("active_ingredients");
		$quantity = $this -> input -> post("quantity");
		$applicant_reference_number = $this -> input -> post("client_ref_no");
		$client_number = $this -> input -> post("lab_ref_no");
		$designator_name = $this -> input -> post("designator_name");
		$designation = $this -> input -> post("designation");
		$designation_date = $this -> input -> post("designation_date");
		$edit_notes = $this -> input -> post("edit_notes");
		$country_of_origin = $this -> input -> post("country_of_origin");
		$product_lic_no = $this -> input -> post("product_lic_no");
		$presentation = $this -> input -> post("presentation");
		$description = $this -> input -> post("description");
		$tests_issued = Sample_issuance::getIssuedTests2($client_number);

		//$client_id =  $this -> input -> post("client_id");
		//Variables hold client information
		$client_name = $this -> input -> post("client_name");
		$client_address = $this -> input -> post("client_address");
		$client_type = $this -> input -> post("clientT");
		$contact_person = $this -> input -> post("contact_person");
		$contact_phone = $this -> input -> post("contact_phone");
		$client_ref_no = $this -> input -> post("client_ref_no");

		//Analysis update array holds above variables , later to
		//be passed to update() function (CodeIgniter.)

		$analysis_update_array =  array(
				'client_id' => $clientid ,
				'product_name' => $product_name,
				'Dosage_form' => $dosage_form  ,
				'Manufacturer_Name' => $manufacturer_name ,
				'Manufacturer_add' => $manufacturer_address ,
				'Batch_no'  => $batch_no,
				'dateformat' => $dateformat ,
				'exp_date' => $expiry_date ,
				'Manufacture_date' => $manufacture_date  ,
				'label_claim' =>  $label_claim  ,
				'active_ing' => $active_ingredients ,
				'sample_qty' => $quantity ,
				'clientsampleref' => $applicant_reference_number  ,
				'request_id' => $client_number  ,
				'Designation_date' =>  $designation_date ,
				'edit_notes' => $edit_notes ,
				'country_of_origin' => $country_of_origin  ,
				'product_lic_no' => $product_lic_no ,
				'presentation' => $presentation ,
				'description' =>  $description  );

		//Array stores client details to be updated
		$client_update_array = array(
			 'Name' => $client_name ,
			 'Address' => $client_address,
			 'Client_type' => $client_type,
			 'Contact_person' => $contact_person,
			 'Contact_phone' => $contact_phone
		);

		//For loop , iterates through array of test ids, updating
		//each accordingly

		for($i = 0; $i < count($tests); $i++){

			foreach($tests_issued as $tests_i){
				if($tests[$i] != $tests_i['Test_id']){
					$request = new Request_details();
					$request -> test_id = $test[$i];
					$request -> request_id = $client_number;
					$request -> save();
				}
		 }

		}

		//Codeigniter where() and update() methods update tables accordingly.
		$this -> db -> where('request_id', $client_number);
		$this -> db -> update('request', $analysis_update_array);

		$this -> db -> where('clientid', $clientid);
		$this -> db -> update('clients', $client_update_array);

		//User is redirected to the requests listing page.
		redirect("request_management/listing");


	}

	public function edit_history(){
		$reqid = $this -> uri -> segment(3);
		$data['title'] = "Requests Edit History";
		$data['settings_view'] = "requests_edit_history_v";
		$data['info'] = Request::getHistory($reqid);
		//$data['requestInformation'] = $requestInformation;
		$this -> base_params($data);

	}




	public function requests($id){
		$data['title'] = "Request Information";
		$data['settings_view'] = "requests_v";
		$requestInformation = Request::getRequest($id);
		$data['requestInformation'] = $requestInformation;
		$this -> base_params($data);
	}


	public function create_sample_folder($labref){
		$workbooks = "Workbooks";
		if(is_dir($workbooks)){
			mkdir($workbooks."/".$labref, 0777, true);
			$this -> create_workbook($labref);
		}
	}

		public function create_workbook($labref){
		$workbooks = "Workbooks";
		$target = "original_workbook/Template.xlsx";
		$destination = "Workbooks/".$labref. "/". $labref. ".xlsx";
		if(is_dir($workbooks."/".$labref)){
			copy($target, $destination);		
		 }
		//redirect("request_management/listing");
	}
        public function add_sample_to_priority_table(){
            $data=array(
                'labref'=> $this -> input -> post("ndqno"),
                'priority'=>'High'
            );
            $this->db->insert('priority_table',$data);
        }
        
            public function create_coa_folder($labref) {
        $certificates = "certificates";
        if (is_dir($certificates)) {
            mkdir($certificates . "/" . $labref, 0777, true);
            $this->create_coa($labref);
        }
    }

    public function create_coa($labref) {
        $certificates = "certificates";
        $target2 = "original_coa/coa_template.xlsx";
        $destination2 = "certificates/" . $labref . "/" . $labref . "_COA.xlsx";
        if (is_dir($certificates . "/" . $labref)) {
            copy($target2, $destination2);
        }
        //redirect("request_management/listing");
    }
        
         public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }
        
        function addSampleTrackingInformation(){
            $userInfo=  $this->getUsersInfo();
            $client=$this -> input -> post("client_name");
            $activity='Samples Recieving';
            $labref=$this -> input -> post("ndqno");
            $names=$userInfo[0]->fname." ". $userInfo[0]->lname;
            $from = $client. '- Client';
            $to= $names .'- Documentation';
            $date=date('d-M-Y H:i:s');
         
            $array_data=array(
              'labref'=>$labref,
                'activity'=>$activity,
                'from'=>$from,
                'to'=>$to,
                'date'=>$date,
                'date_added'=>'1',
                'current_location'=>'Documentation'
            );
            $this->db->insert('worksheet_tracking',$array_data);
        }

	public function base_params($data) {
		
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "request";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}//end base_params
}