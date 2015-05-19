<?php
class Quotation extends MY_Controller {

	function __construct() {
		parent::__construct();
	}


	public function index(){

		Quotation::generate();

	}

	public function updateSystem(){
		//Get request_id
		$reqid = $this -> uri -> segment(3);
		$table = $this -> uri -> segment(4);


		//Condition gets variables
			if($table == 'request'){
				$id = 'request_id';
				$billing_table = 'client_billing';
				$register = 'dispatch_register';
				$main_table = 'request';
				$components_table = $main_table."_components";
				$ref = $main_table.'_id';
			}
			else if($table == 'quotations'){
				$id = 'quotations_id';
				$billing_table = 'q_request_details';
				$register = 'quotations';
				$main_table = $register;
				$components_table = $main_table."_components";
				$ref = $register.'_id';
			}
			else if($table == 'invoice'){
				$id = 'request_id';
				$billing_table = 'invoice_billing';
				$register = 'dispatch_register';
				$main_table = 'request';
				$components_table = $table."_components";
				$ref = $id;
			}

		//Get post inputs
		$assay_sys = $this -> input -> post('system_5');
		$dissolution_sys = $this -> input -> post('system_2');
		$no_of_stages = $this -> input -> post('no_of_stages');
		$extra_charge = 3200;
		
		//Capitalize components table variable, make as class
		$components_table_class = ucfirst($components_table);

		//Get components method
		$components_method = 'get'.$components_table_class;


		$components = $components_table_class::$components_method($reqid, $ref);
		$components_no = count($components);

		//Get Test Ids
		$assay = 5;
		$dissolution = 2; 		

		//Get Base Charge of Test
		$base_charge_assay = $components_table_class::getBaseCharge($assay, $reqid);
		$base_charge_dissolution = $components_table_class::getBaseCharge($dissolution, $reqid);
		
		//Update Assay
		if($assay_sys != 0){
		//Update Assay System
		$cb_where_array = array($ref => $reqid, 'test_id' => 5);
		$cb_update_array = array('charge_system' => $assay_sys);

		//Update quotation_components for Assay
		$this -> db -> where($cb_where_array);
		$this -> db -> update($billing_table, $cb_update_array);

		if($assay_sys == 1){
			$test_charge = $base_charge_assay['method_charge']  + ($extra_charge * ($components_no - 1));
		}
		else if($assay_sys == 2){
			$test_charge = $base_charge_assay['method_charge'] * $components_no;
		}


		//Update Client Billing Table
		$cb_update_array2 = array('test_charge' => $test_charge);

		$this -> db -> where($cb_where_array);
		$this -> db -> update($billing_table, $cb_update_array2);

	 	$assay_id = $base_charge_assay['id'] + 1;

		$rc_where_array = array('id' => $assay_id);
		$rc_update_array = array('method_charge' => $extra_charge);

		$this -> db -> where($rc_where_array);
		$this -> db -> update($components_table, $rc_update_array);

		//var_dump($base_charge_assay);

		}

		//Update Dissolution
		if($dissolution_sys != 0){
			$cb_where_array = array($ref => $reqid, 'test_id' => 2);
			$cb_update_array = array('charge_system' => $dissolution_sys, 'stages' => $no_of_stages);
		
			//Update quotation_components for Assay
			$this -> db -> where($cb_where_array);
			$this -> db -> update($billing_table, $cb_update_array);
		
			//Get test Charges for dissolution
			if($dissolution_sys == 1){
				$test_charge2 = $base_charge_dissolution['method_charge']  + ($extra_charge * ($components_no - 1));
			}
			else if($dissolution_sys == 2){
				$test_charge2 = $base_charge_dissolution['method_charge'] * $components_no;
			}

			$cb_update_array2 = array('test_charge' => $test_charge2);

			$this -> db -> where($cb_where_array);
			$this -> db -> update($billing_table, $cb_update_array2);

		 	$diss_id = $base_charge_assay['id'] + 1;

			$rc_where_array = array('id' => $diss_id);
			$rc_update_array = array('method_charge' => $extra_charge);

			$this -> db -> where($rc_where_array);
			$this -> db -> update($components_table, $rc_update_array);

		}

		//Add Assay and Dissolution
		//$total = $test_charge + $test_charge2;

		//Get existing amount from the register table
		$amount = $billing_table::getTotal($reqid);
		$total = $amount[0]['sum'];
		
		//Discoun and total amount
		$discounted_amount = $total;
		$discount = 0;

		//Update Dispatch register
		$quotation_status = 1;
			
			if($table != 'invoice'){
				$dr_update_array = array('amount' => $discounted_amount, 'discount' => $discount, 'quotation_status' => $quotation_status);
			}
			else{
				$dr_update_array = array('invoiced_amount'=> $discounted_amount);
			}

		$this -> db -> where(array($ref => $reqid));
		$this -> db -> update($register, $dr_update_array);

		//Update Main Table
		$main_update_array = array('quotation_status' => $quotation_status);
		$this -> db -> where($ref, $reqid);
		$this -> db -> update($main_table, $main_update_array);

		if($table == 'invoice'){
			$system_status = 1;
			$sample_issuance_update = array('system_status' => $system_status);
			$sample_issuance_where = array('Lab_ref_no' => $reqid);
			
			//Sample Issuance System Select Status
			$this -> db -> where($sample_issuance_where);
			$this -> db -> update('sample_issuance', $sample_issuance_update);

		}

	}

	public function chooseSystem(){

		//Get unique id
		$data['reqid'] = $this -> uri -> segment(3);

		//Get tables from uri segments
		$data['table'] = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);

		//Get Client_id
		$data['client_id'] = $this -> uri -> segment(7);

		//Capitalize class name
		$tests_table = ucfirst($data['table3']);

		$data['multi_tests'] = array('2' => 'Dissolution', '5' => 'Assay');
		$data['tests_checked'] = array();
		$tests = $tests_table::getTests2($data['reqid']);
		foreach ($tests as $test) {
			$data['tests_checked'][] = $test['test_id'];	
		}
		$data['content_view'] = 'system_select_v';
		$this -> load -> view('template1', $data);
	}


	public function stateComponents(){

			//get table names from uri segments 
		    $data['table'] = $this -> uri -> segment(4);
		    $data['table2'] = $this -> uri -> segment(5);
		   	$data['table3']= $this -> uri -> segment(6);
		    
		   	//Get unique identifier
		    $data['reqid'] = $this -> uri -> segment(3);

		    //Get client id
		    $data['client_id'] = $this -> uri -> segment(7);


		   	if($data['table'] == "request"){
		   		//Get requisite proforma info
		    	$proforma_info = Request::getProformaNo($data['reqid']);

		   		//Get Date Received
		   		$date_received = $proforma_info[0]['Designation_date'];
		    	
		    	//Get number of distinct existing proformas for this client and date
		   		$no_of_proformas = Request::getProformaCountPerClient($data['client_id'], $date_received);

		   		if(!empty($no_of_proformas)){
		   			$data['proforma_no'] = $no_of_proformas[0]['count'];
		   		}
		   		else{
		   			$data['proforma_no'] = 0;
		   		}

		   		
		   		//Get Client Agent
		    	$c_a_i = Clients::getClientAgentId($data['client_id']);
            	$client_agent_id = $c_a_i[0]['client_agent_id'];

            	$data['proforma_nos'] = Request::getProformaInfo($data['client_id'], $date_received);

		    }
		    
			//pass data to view
			$data['content_view'] = 'quotation_state_components_v';
			$this -> load -> view('template1', $data);
	}


	public function setComponents(){

		//Get unique request id from last segment of uri
		$reqid = $this -> uri -> segment(3);

		//Get tables from last segment of uri
		$table = $this -> uri -> segment(4);
		$table2 = $this -> uri -> segment(5);
		$table3 = $this -> uri -> segment(6);

		//Get client id
		$data['client_id'] = $this -> uri -> segment(7);

		//Hold array of component inputs in array variable (input name was set as an array in the view)
		$components = $this -> input -> post("component");

		//Get multicomponent status
		$component_status = $this -> input -> post("multicomponent");


		//Condition determines if table is request
		if($table == "request"){

			//Get Proforma No from the Proforma No. Select
			$p_no = $this -> input -> post("proforma_no");

			//Get Date Received
			$data['proforma_no'] = $proforma_info = Request::getProformaNo($reqid);
		   	$date_received = $proforma_info[0]['Designation_date'];

			//Get proforma No from function that checks if p_no is empty/not
			$proforma_no = $this -> getProformaNo($p_no, $data['client_id'], $date_received);

			//Update Proforma No in Request Table
			$proforma_update_array = array('proforma_no' => $proforma_no, 'proforma_no_status' => 1);
			$proforma_update_where_array = array('request_id' => $reqid);

			//Update Proforma
			$this -> db -> where($proforma_update_where_array);
			$this -> db -> update('request',$proforma_update_array);

			//Update Client Billing Table with new Proforma Number		
			$proforma_update_array_cb = array('proforma_no' => $proforma_no);
			$proforma_update_where_array_cb = array('request_id' => $reqid);

			//Update Proforma
			$this -> db -> where($proforma_update_where_array_cb);
			$this -> db -> update('client_billing',$proforma_update_array_cb);

		}

		//Get tests affected by multicomponent quality of sample
		//Condition so that if single, not to enter multiple components
		if($component_status == 1){
			$multi_tests = array(2,5);
		}
		else if($component_status == 0){
			$multi_tests = array(0);
		}

		//Construct table names and unique column names with variables
		$components_table = ucfirst($table)."_components";
		$id = $table."_id";

		//Loop through array of components, saving each to own row in quotations_components table
		for($j=0; $j < count($multi_tests); $j++){
			for ($i=0; $i < count($components); $i++) {
			  	$component = new $components_table();
	            $component->component = $components[$i];
	            $component->test_id = $multi_tests[$j];
	            $component->$id = $reqid;
	            $component->save();	
			}
		}
	}

	public function getProformaNo($p_no, $c, $d){

			//Condition checks whether proforma_no has been selected in generate quotation view
			if(!empty($p_no) && $p_no != 'New'){
				$proforma_no = $p_no;
			}
			else if(empty($p_no) || $p_no == 'New'){

				//Get No. of Quotations
				$no_of_proformas = Request::getProformaCountPerClient($c, $d);

				//Get Month and Year from date received
				$yr = date('y', strtotime($d));
				$m = date('m', strtotime($d));
				$d = date('d', strtotime($d));

				//Concatenate gotten year and month to generate year-month part of proforma no.
				$date_r = $yr."-".$m."-".$d;

				if(!empty($no_of_proformas)){
					//Increment no. of quotations by 1
					$proforma_serial = $no_of_proformas[0]["count"] + 1;

					//Pad quotation no with two leading zeros
					$serial = sprintf('%02s', $proforma_serial);

					//Generate quotation number
					$proforma_no = 'NDQ-'.$c."-".$date_r."-P".$serial;
				}
				else{
					$proforma_no = 'NDQ-'.$c."-".$date_r."-P"."01";
				}


			}

			return $proforma_no;
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
		
		$email = $this -> input -> post("client_email");
		$client_number = $this -> input -> post("client_id");
		$test =$this -> input -> post("test");
		$no_of_batches = $this -> input -> post("no_of_batches");
		$sample_name = $this -> input -> post("sample_name");
		$client_name = $this -> input -> post("client_name");
		//$active_ingredients = $this -> input -> post("active_ing");
		$dosage_form = $this -> input -> post("dosage_form");
		$quotation_date = $this -> input -> post("quotation_date");
		$q_no = $this -> input -> post("quotation_no");
		//$quoted_amount = $this -> input -> post("quoted_amount");

		//Get Quotation Id
		$quotation_id = $this -> getQuotationId();

		//Get client number
		$client_number = $this -> getClientNumber($client_number);

		//Get Quotation Number
		
		$quotation_no = $this -> getQuotationNo($client_number, $q_no);		

		//Save Quotation
		$quotation = new Quotations();
		$quotation -> Dosage_form = $dosage_form;
		$quotation -> client_email = $email;
		//$quotation -> Active_ingredients = $active_ingredients;
		$quotation -> Sample_name = $sample_name;
		$quotation -> Client_name = $client_name;
		$quotation -> Quotation_date = date('y-m-d');
		$quotation -> No_of_batches = $no_of_batches;
		$quotation -> Client_number = $client_number;
		$quotation -> Quotations_id = $quotation_id;
		$quotation -> Quotation_no = $quotation_no;
		$quotation -> save();
		

			for($i=0;$i<count($test);$i++){
				$test_charges = Tests::getCharges($test[$i]);
				$request = new Q_request_details();
				$request -> test_id = $test[$i];
				$request -> client_number = $client_number;
				$request -> client_email = $email;
				$request -> quotations_id = $quotation_id;
				if (!empty($test_charges)) {
                	$request-> test_charge = $test_charges[0]['Charge'];
            	}
				$request -> save();
			}
		}

		public function getQuotationNos(){
			$cid = $this -> uri -> segment(3);
			$quotation_nos = Quotations::getNos($cid);
			echo json_encode($quotation_nos);
		}

		public function getClientNumber($client_number){
			if (!empty($client_number)) {
	            $client_number = $this->input->post("client_id");
	        } else {
	            $cid = Clients::getLastId();
	            $client_number = $cid[0]['max'] + 1;
	            $this -> saveClientAsUser();
	        }
	        return $client_number;
		}

		public function getQuotationId(){
			//Get no. of quotations in table
			$no_of_quotations = Quotations::getRowCount();

			//Increment no. of quotations by 1
			$quotation_serial = $no_of_quotations[0]["count"] + 1;

			//Pad quotation no with two leading zeros
			$serial = sprintf('%02s', $quotation_serial);

			//Generate quotation number
			$quotation_no = 'Q-'.date('y-m')."-".$serial;

			return $quotation_no;
		}


		public function getQuotationNo($c, $q){

			//Condition checks whether quotation_no has been selected in generate quotation view
			if(!empty($q)){
				$quotation_no = $q;
			}
			else if(empty($q) || $q == 'New'){

				//Get No. of Quotations
				$no_of_quotations = Quotations::getRowCountPerClient($c);

				//Increment no. of quotations by 1
				$quotation_serial = $no_of_quotations[0]["count"] + 1;

				//Pad quotation no with two leading zeros
				$serial = sprintf('%02s', $quotation_serial);

				//Generate quotation number
				$quotation_no = 'NDQ-'.$c."-".date('y-m')."-Q-".$serial;
			}

			return $quotation_no;
		}


	public function generate(){
		$data['lastclientno'] = Quotations::getLastId();
		$data['dosageforms'] = Dosage_form::getAll();
		$data['tests'] = Tests::getAll();
		$data['wetchemistry'] = Tests::getWetChemistry();
		$data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
		$data['medicaldevices'] = Tests::getMedicalDevices();
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("jquery.ui.core.js","jquery.ui.datepicker.js","jquery.ui.widget.js");		
		$data['styles'] = array("jquery.ui.all.css");
		$data['content_view'] = "generate_quotation_v";
		$data['quotation_no'] = $this -> getQuotationId();
		//$data['previous_quotations'] = $this -> getPreviousQuotations(); 
		$this -> load -> view('template1', $data);
	}

	public function listing(){
		$data['quotations'] = Quotations::getAll();
		$data['settings_view'] = "quotations_list_v";
		$this -> base_params($data);
	}


	public function printQuotation(){

        //DOMpdf initialization
        require_once("application/helpers/dompdf/dompdf_config.inc.php");
        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->set_paper('A4');

        //Get unique id
       	$data['reqid'] = $reqid = $this -> uri -> segment(3);

       	//Get tables from uri segments
       	$data['table'] = $table = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);

		//Get Signatory Details
		$signatory_title = $this -> uri -> segment(7);
		$signatory = $this -> uri -> segment(8);

		//Replace special characters in signatory details
		$data['signatory'] = str_replace("%20", " ", $signatory_title);
		$data['signatory_title'] = str_replace("%20", " ", $signatory);

		//Get method
		$data['method'] = $this -> router -> fetch_method();

		//Get client id
		$cid = Quotations::getClientId($data['reqid']);
		$client_id = $data['cid'] = $cid['distinct'];

		//Do condition for getting billing tables e.t.c
			if($table == 'request'){
				$id = 'request_id';
				$billing_table = 'Client_billing';
				$register = 'dispatch_register';
				$main_table = 'Request';
				$components_table = $main_table."_components";
				$ref = $main_table.'_id';
				$status = 'proforma_print_status';
				$tests_index = 4;
			}
			else if($table == 'quotations'){
				$id = 'quotations_id';
				$billing_table = 'Q_request_details';
				$register = 'Quotations';
				$main_table = $register;
				$components_table = $main_table."_components";
				$ref = $register.'_id';
				$status = 'quotation_print_status';
				$tests_index = 6;
			}


		//Pdf url info
       	$saveTo = './quotations';
       	$quotation_name = "Quotation_" . $data['reqid'] . ".pdf";


       	$qt_no = $this -> getQuotationNoFromDb($data['reqid']);

		$data['test_data'] = $billing_table::getChargesPerClient($data['reqid']);
		$data['invoice_data'] = $data['i_data'] = $main_table::getInvoiceDetailsPerClient($client_id, $qt_no);
 		
		//Get Total
		$data['total'] = $register::getTotalPerClient($client_id, $qt_no);
		$total_cost = $data['total'][0]['sum'];
		
		//Push amounts into array that generates totals footer
		$data['tr_array'] = array('TOTAL COST'=>$total_cost);	
		
		//Push to view
        //$data['settings_view'] = "quotation_multiple_v";
        $html = $this->load->view('quotation_multiple_v', $data, TRUE);
       // $this -> base_params($data);
        
        
        $dompdf->load_html($html);
        $dompdf->render();
        write_file($saveTo . "/" . $quotation_name, $dompdf->output());
        

       //Set invoice print status
       $this -> setInvoicePrintStatus($reqid, $saveTo, $quotation_name, $main_table, $ref, $status);

        
	}

		public function getQuotationNoFromDb($r){
			//Get Quotation No.
       		$quotation_n = Quotations::getQuotationNumber($r);
			$qt_no = $quotation_n[0]["Quotation_no"];
			return $qt_no;
		}


		public function printProforma(){

        //DOMpdf initialization
        require_once("application/helpers/dompdf/dompdf_config.inc.php");
        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->set_paper('A4');

        //Get unique id
       	$data['reqid'] = $reqid = $this -> uri -> segment(3);

       	//Get tables from uri segments
       	$data['table'] = $table = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);

		//Get client id
		$data['client_id'] = $client_id = $this -> uri -> segment(7);

		//Get Proforma No
		//$data['proforma_no'] = $proforma_no = $this -> uri -> segment(8);

		//Get Date Received
		$data['proforma_info'] = $proforma_info = Request::getProformaNo($data['reqid']);
		$data['date_received'] = $date_received = $proforma_info[0]['Designation_date'];
		$data['proforma_no'] = $proforma_no = $proforma_info[0]['proforma_no'];

		//Get method 
		$data['method'] = $this -> router -> fetch_method();

		//Get Signatory Details
		$signatory_title = $this -> uri -> segment(8);
		$signatory = $this -> uri -> segment(9);

		//Replace special characters in signatory details
		$data['signatory'] = str_replace("%20", " ", $signatory_title);
		$data['signatory_title'] = str_replace("%20", " ", $signatory);

		//Do condition for getting billing tables e.t.c
			if($table == 'request'){
				$id = 'request_id';
				$billing_table = 'Client_billing';
				$register = 'dispatch_register';
				$main_table = 'Request';
				$components_table = $main_table."_components";
				$ref = $main_table.'_id';
				$status = 'proforma_print_status';
				$tests_index = 4;
			}
			else if($table == 'quotations'){
				$id = 'quotations_id';
				$billing_table = 'Q_request_details';
				$register = 'Quotations';
				$main_table = $register;
				$components_table = $main_table."_components";
				$ref = $register.'_id';
				$status = 'quotation_print_status';
				$tests_index = 6;
			}


		//Pdf url info
       	$saveTo = './proformas';
       	$quotation_name = "Proforma_" . $data['reqid'] . ".pdf";
		
		//Get data for the pdf	
		$data['test_data'] = $billing_table::getChargesPerClient($data['reqid']);
		//$data['invoice_data'] = $main_table::getInvoiceDetails($data['reqid']);
 		
		//Get invoice_data per client
 		$data['invoice_data'] = $main_table::getInvoiceDetailsPerClient($client_id, $date_received, $proforma_no);

		//Get Total
		$data['total'] = $billing_table::getTotalperClientProforma($client_id, $proforma_no);

		//Set Totals and discounts to variables
		$total_cost = $data['total'][0]['sum'];
		$amount_payable = 0.8 * $total_cost;
		
		//Push amounts into array that generates totals footer
		$data['tr_array'] = array('TOTAL COST'=>$total_cost,'80%' => $amount_payable);	
		

	     //$data['settings_view'] = 'proforma_invoice_v';
	     $html = $this->load->view('proforma_invoice_v', $data, TRUE);
	     //$this -> base_params($data);
        
        $dompdf->load_html($html);
        $dompdf->render();
        write_file($saveTo . "/" . $quotation_name, $dompdf->output());
        

       //Set invoice print status
       $this -> setInvoicePrintStatus($reqid, $saveTo, $quotation_name, $main_table, $ref, $status);
 
	}




	public function printInvoice(){

       	//Get tables from uri segments
       	$data['table'] = $table = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);
		
		//Status Method Parameters
		$main_table = 'request';
		$ref = 'request_id';
		$status = 'invoice_print_status';

        //DOMpdf initialization
        require_once("application/helpers/dompdf/dompdf_config.inc.php");
        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->set_paper('A4');

        //
       	$data['reqid'] = $reqid = $this -> uri -> segment(3);	
       	$saveTo = './invoices';
       	$invoicename = "Invoice_" . $data['reqid'] . ".pdf";
			
		$data['test_data'] = Invoice_billing::getChargesPerClient($data['reqid']);
		$data['invoice_data'] = Request::getInvoiceDetails($data['reqid']);

		//Get client id
		$data['client_id']  = $this -> uri -> segment(7);

		//Get Total
		$data['total'] = Invoice_billing::getTotal($data['reqid']);
		$total_cost = $data['total'][0]['sum'];	

		//Get Discount Data
		$client_discount_percentage = Clients::getDiscountPercentage($data['client_id']);
		$discount_percentage = $client_discount_percentage[0]['discount_percentage'];
		$discount_title = 'DISCOUNT '. $discount_percentage.'%';
	
		//Compute Discounts
		$discount = $discount_percentage/100 * $total_cost;
		$amount_payable = $total_cost - $discount;

		//Push amounts into array that generates totals footer depending on client eligible for discount/not
		if($discount_percentage != 0){
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, $discount_title => $discount , 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 6;
			$data['discount_csp']= 2;
		}
		else{
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 5;
			$data['discount_csp'] = 1;
		}

		//Get method 
		$data['method'] = $this -> router -> fetch_method();

		//Get Signatory Details
		$signatory_title = $this -> uri -> segment(8);
		$signatory = $this -> uri -> segment(9);

		//Replace special characters in signatory details
		$data['signatory'] = str_replace("%20", " ", $signatory_title);
		$data['signatory_title'] = str_replace("%20", " ", $signatory);

		//Push to view
        $html = $this->load->view('invoice_pdf_v', $data, TRUE);
        $dompdf->load_html($html);
        $dompdf->render();
        write_file($saveTo . "/" . $invoicename, $dompdf->output());
		
        //Set invoice print status
        $this -> setInvoicePrintStatus($reqid, $saveTo, $invoicename, $main_table, $ref, $status);
	}

	public function showInvoiceBeforePrint(){
	
		//Get unique id
		$data['reqid'] = $this -> uri -> segment(3);
		
		//Get tables
		$data['table'] = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);

		//Get client id
		$data['client_id']  = $this -> uri -> segment(7);

		//Get list of eligible signatories
		$data['signatories'] = User::getSignatories();

		//Get Invoice Data to go to pdf print
		$data['test_data'] = Invoice_billing::getChargesPerClient($data['reqid']);
		$data['invoice_data'] = Request::getInvoiceDetails($data['reqid']);

		//Get originator method
		$data['method'] = $this -> router -> fetch_method();

		//Get Total
		$data['total'] = Invoice_billing::getTotal($data['reqid']);
		$total_cost = $data['total'][0]['sum'];	

		//Get Discount Data
		$client_discount_percentage = Clients::getDiscountPercentage($data['client_id']);
		$discount_percentage = $client_discount_percentage[0]['discount_percentage'];
		$discount_title = 'DISCOUNT '. $discount_percentage.'%';
	
		//Compute Discounts
		$discount = $discount_percentage/100 * $total_cost;
		$amount_payable = $total_cost - $discount;

		//Push amounts into array that generates totals footer depending on client eligible for discount/not
		if($discount_percentage != 0){
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, $discount_title => $discount , 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 6;
			$data['discount_csp']= 2;
		}
		else{
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 5;
			$data['discount_csp'] = 1;
		}

		//Set view, load it
		$data['content_view'] = 'invoice_before_print_v';
		$this -> load -> view('template1', $data);	
	
	}

	public function seeJson(){	
		$data['reqid'] = $reqid = $this -> uri -> segment(3);
		$test = Client_billing::getChargesPerClient($data['reqid']);
		echo json_encode($test);
	}
     
	public function setInvoicePrintStatus($r, $s, $i, $table, $ref, $status){

		//Request update arrays
		$request_where_array =  array($ref => $r);
		$request_update_array = array($status => 1);

		//Update request
		$this -> db -> where($request_where_array);
		$this -> db -> update($table,$request_update_array);

	}

	public function showBillsPerTest(){
		$data['rid'] = $this -> uri -> segment(3);
		$data['content_view'] = 'quotation_bill_per_test_v';
		$this -> load -> view('template1', $data);
	}

	public function show_breakdown(){
		$data['rid'] = $this -> uri -> segment(3);
		$this -> load -> view('quotation_billing_breakdown_v', $data);	
	}

	public function breakdown(){
		$rid = $this -> uri -> segment(3);
		$charges =Q_request_details::getChargesPerQuotation($rid);
		foreach ($charges as $r){
			$data[] = $r;
		}
		echo json_encode($data);
	}

	public function show(){
	$data['settings_view'] = "show_quotation_v";
	$this -> base_params($data);	
	}

	public function base_params($data) {
		$data['title'] = "Request Management";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "quotation";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";
		$this -> load -> view('template', $data);
	}//end base_params

}






?>