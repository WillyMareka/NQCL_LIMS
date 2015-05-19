<?php
class Finance_management extends MY_Controller {
	

public function trackSample(){
$u_id = $this -> session -> userdata('usertype_id');
}

public function index(){
	$this -> clientRegister();
}

public function viewBills() {
	$data["quick_link"] = "bills";
	$data['settings_view'] = "client_bills_v";
	$this -> base_params($data);
}

public function dispatchRegister(){
	$data["quick_link"] = "dispatch";
	$data["settings_view"] = "dispatch_register_v";
	$this -> base_params($data);
}

public function clientRegister(){
	$data["quick_link"] = "client";
	$data["settings_view"] = "finance_client_register_v";
	$this -> base_params($data);
}

public function clientAccounts(){
	$data["quick_link"] = "accounts";
	$data["settings_view"] = "client_accounts_v";
	$this -> base_params($data);
}

public function GetAutocomplete($options=array()) {
		$this->db ->distinct();
		$this->db->select('request_id');
		$this->db->where('client_id', $options['client_id']);
		$this->db->like('request_id', $options['request_id'], 'after');
		$query = $this->db->get('request');
		return $query->result();
}

public function sample_suggestions() {
			$cid = $this -> uri -> segment(3);
			$term = $this->input->post('reqid',TRUE);
			$rows = $this->GetAutocomplete(array('request_id' => $term, 'client_id' => $cid));
			$keywords = array();
			foreach ($rows as $row)
				array_push($keywords, $row->request_id);
				echo json_encode($keywords);
}

public function getProductInfo() {
		$ref = $this -> uri -> segment(3);
		$ref = str_replace('%20', '_', $ref);
		$codes = Request::getProdInfo($ref);
		echo json_encode($codes);
}

public function pushCodes(){
		$codes = $this->getCodes();
		$codes_array = array();
		foreach($codes as $code)
			array_push($codes_array, $code->code);
		echo json_encode($codes_array);
}

public function dispatchList(){
	$dispatch = Dispatch_register::getAllDispatch2();
	if(!empty($dispatch)){
	foreach ($dispatch as $r){
		$data[] = $r;
		}
	echo json_encode($data);
	}
	else{
		echo "[]";
	}
}

public function coaCollectionAdd(){
	$data['formname'] = 'coa_collection';
	$data['content_view'] = 'coaCollectionAdd_v';
	$data['reqid'] = $this -> uri -> segment(3);
	$data['coa_no'] = $this -> uri -> segment(4);
	$this -> load -> view('template1', $data);
}

public function coaCollectionView(){
	$data['content_view'] = 'coaCollectionView_v';
	$reqid = $this -> uri -> segment(3);
	$data['collectors'] = Coa_collection::getCollector($reqid);
	$this -> load -> view('template1', $data);
}

public function ajaxResponse(){
	if (is_null($_POST)) {
			echo json_encode(array(
				'status' => 'error',
				'message'=> 'Data was not posted.'
				));
			}
			else {
			echo json_encode(array(
				'status' => 'success',
				'message'=> 'Data added successfully',
			));
	}
}

public function coaCollectionSave(){
//Get Ajax Response
$this -> ajaxResponse();

//Get request_id from third segment
$reqid = $this -> uri -> segment(3);
$coa_no = $this -> uri -> segment(4);

//Get inputs
$title = $this -> input -> post('title', TRUE);
$fname = $this -> input -> post('fName', TRUE);
$sname = $this -> input -> post('sName', TRUE);
$email = $this -> input -> post('email', TRUE);
$phone = $this -> input -> post('tPhone', TRUE);
$id_type = $this -> input -> post('id_type', TRUE);
$id_no = $this -> input -> post('id_no', TRUE);

//Save to table
$coa = new Coa_collection();
$coa -> ref_no = $reqid;
$coa -> coa_no = $coa_no;
$coa -> title = $title;
$coa -> fname = $fname;
$coa -> sname = $sname;
$coa -> email = $email;
$coa -> phone_no = $phone;
$coa -> id_type = $id_type;
$coa -> id_no = $id_no;
$coa -> save();

//Update collection status
$collection_array = array('coa_collection_status' => 1);
$this -> db -> where('request_id', $reqid);
$this -> db -> update('request', $collection_array);

}

public function dispatchListPerSample(){
	$cid = $this -> uri -> segment(3);
	$dispatch = Dispatch_register::getDispatchPerSample($cid);
	if(!empty($dispatch)){
		foreach ($dispatch as $r){
			$data[] = $r;
		}
		echo json_encode($data);
	}
	else{
		echo "[]";
	}
	
}

public function clientDispatchList(){
	$client_dispatch = $this->getDispatchAll();
	if(!empty($client_dispatch)){
			foreach ($client_dispatch as $r){
		$data[] = $r;
	}
	echo json_encode($data);
	}
	else{
		echo "[]";
	}

}



public function showClientPaymentHistory(){
	$data['cid'] = $this -> uri -> segment(3);
	$data['cname'] = $this -> uri -> segment(4);
	$this -> load -> view('client_credit_history_v', $data);
}

public function paySample(){
	$data['content_view'] = 'pay_sample_v';
	$data['cid'] = $this -> uri -> segment(3);
	$data['name'] = $this -> uri -> segment(4);
	$data['client_credit'] = Clients::getClientCredit($data['cid']);
	$data['balance'] = Dispatch_register::getBalance($data['cid']);
	$data['totalAmountOwed'] = Client_billing::getTotalperClient($data['cid']);
	$data['totalAmountPaid'] = Payments::getTotalAmountPaid($data['cid']);
	$data['bal'] = $data['totalAmountOwed'][0]['sum'] - $data['totalAmountPaid'][0]['sum']; 
	$this -> load -> view('template1', $data);
}

public function clientCreditHistoryList(){
	$cid = $this -> uri -> segment(3);
	$credit_h = Client_credit::getCreditHist($cid);
	foreach ($credit_h as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}

public function clientsAccountList(){
	$acclist = Clients::getAllClientAccounts();
	foreach ($acclist as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}

public function requests_list(){
	$request =Request::getRequestsPerClient($uname);
	foreach ($request as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}

public function charges_list(){
	$charges =Client_billing::getAll2();
	foreach ($charges as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}

public function breakdown(){

	//Get variables from uri segments
	$rid = $this -> uri -> segment(3);
	$table = $this -> uri -> segment(4);

	//Condition evaluates to billing table 
	if($table == 'request'){
		$billing_table = 'Client_billing';
	}  
	else if($table == 'quotations'){
		$billing_table = 'Q_request_details';
	}
	else if($table == 'invoice'){
		$billing_table = 'Invoice_billing';
	}

	//Get charges
	$charges = $billing_table::getChargesPerClient($rid);
	foreach ($charges as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}


public function totals_list(){
	$rid = $this -> uri -> segment(3);
	$totals =Client_billing::getTotal($rid);
	foreach ($totals as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}


public function payments_list(){
	$payments = Payments::getAll();
	foreach ($payments as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}


public function payments_list_per_client(){
	$cid = $this -> uri -> segment(3);
	$payments = Payments::getPerClient($cid);
	if(!empty($payments)){
		foreach ($payments as $r){
			$data[] = $r;
		}
	echo json_encode($data);
	}
	else{
		echo "[]";
	}
	
}

public function show_more(){
	$data['rid'] = $this -> uri -> segment(3);
	$this -> load -> view('finance_billing_v', $data);	
}

public function showReceipt(){
	$data['cid'] = $this -> uri -> segment(3);
	$data['name'] = Clients::getName($data['cid']);
	$data['content_view'] = 'payments_v';
	$this -> load -> view('template1', $data);	
}


public function showDispatchPerClient(){
	$data['rid'] = $this -> uri -> segment(3);
	$this -> load -> view('samples_dispatch_v2', $data);	
}


public function showDispatchPerClient_Client(){
	$data['rid'] = $this -> uri -> segment(3);
	$this -> load -> view('samples_dispatch_v', $data);	
}

public function pay(){
	$data['content_view'] = 'finance_payment_v';
	$data['a_paid1']  = $this -> uri -> segment(7);	
	$data['a_owed'] = $this -> uri -> segment(6);
	$data['cid'] = $this -> uri -> segment(3); 
	$data['a_quoted'] = $this -> uri -> segment(8);
	$data['inv_id'] = $this -> uri -> segment(4);
	$data['cert_id'] = $this -> uri -> segment(5);
	$data['client_credit'] = Clients::getClientCredit($data['cid']);
	$data['dispatch'] = Dispatch_register::getBalance($data['cid']);
	$this -> load -> view('template1', $data);	
}

public function add_credit(){
	$data['content_view'] = 'add_credit_v'; 	 
	$data['cid'] = $this -> uri -> segment(3);
	$data['name'] = $this -> uri -> segment(4);
	$data['client_credit'] = Clients::getClientCredit($data['cid']);
	$data['balance'] = Dispatch_register::getBalance($data['cid']);
	$data['totalAmountOwed'] = Client_billing::getTotalperClient($data['cid']);
	$data['totalAmountPaid'] = Payments::getTotalAmountPaid($data['cid']);
	$data['bal'] = $data['totalAmountOwed'][0]['sum'] - $data['totalAmountPaid'][0]['sum']; 
	$this -> load -> view('template1', $data);	
}

public function apportionment_view(){
	$data['content_view'] = 'apportionment_v';
	$proforma_amount = $this -> uri -> segment(5);
	$invoice_amount = $this -> uri -> segment(6);

	//Get Request Id and Client Id
	$data['reqid'] = $reqid = $this -> uri -> segment(3);
	$data['client_id'] = $this -> uri -> segment(4); 

	//Get existing amount_paid
	$existing_amount_paid = Dispatch_register::getAmountPaid($reqid);
	$e_amount_paid = $existing_amount_paid[0]['amount_paid'];
	
	if($invoice_amount == 0){
		if($e_amount_paid == 0){
			$data['amount_owed'] = $proforma_amount;
		}
		else{
			$data['amount_owed'] = $proforma_amount - $e_amount_paid;
		}
	}
	else{
		if($e_amount_paid == 0){
			$data['amount_owed'] = $invoice_amount;
		}
		else{
			$data['amount_owed'] = $invoice_amount - $e_amount_paid;
		}
	}
	$data['eighty_percent']  = 80/100*$proforma_amount;

	$available_credit = Clients::getClientCredit($data['client_id']);
	$data['available_credit'] = $available_credit[0]['credit'];
	$this -> load -> view('template1', $data);	
}

public function apportionment(){

	//Prompt display of ajax response
	$this -> ajaxResponse();

	//Assign input values to variables
	$amount_to_apportion = $this -> input -> post("amount_to_apportion");
	

	$amount_owed = $this -> input -> post("amount_owed");
	$available_credit = $this -> input -> post("available_credit");
	$eighty_percent = $this -> input -> post("eighty_percent");
	$client_id = $this -> input -> post("client_id");
	$reqid = $this -> input -> post("reqid");
	
	//Condition to determine percentage of amount to apportion to amount owed
	if($amount_to_apportion > $amount_owed){
		$apportioned = $amount_owed;
		$balance = 0;
		$pay_percentage = 100;
		$apportionment_status = 1;
		$paid_status = 2;
	}
	else if($amount_to_apportion <= $amount_owed){
		if($amount_to_apportion > 0){
			$apportioned = $amount_to_apportion;
			$balance = $amount_owed - $amount_to_apportion;
			$pay_percentage = $amount_to_apportion/$amount_owed * 100;
			$apportionment_status = 0;
			$paid_status = 1;
		}
		else{
			$apportioned = 0;
			$balance = $amount_owed;
			$pay_percentage = 0;
			$apportionment_status = 0;
			$paid_status = 0;
		}
	}

	//Get existing amount_paid
	$existing_amount_paid = Dispatch_register::getAmountPaid($reqid);
	$e_amount_paid = $existing_amount_paid[0]['amount_paid'];
	$e_amount_owed = $existing_amount_paid[0]['amount'];
	//Reconcile existing + apportioned for percentage
	$amount_paid_update = $e_amount_paid + $apportioned;
	$new_paid_percentage = $amount_paid_update / $e_amount_owed * 100;
	$new_balance = $e_amount_owed - $amount_paid_update; 
	$new_credit = $available_credit - $amount_to_apportion;

	//Offset client credit, individual analysis request debt
	$dr_update_array = array('amount_paid'=>$amount_paid_update, 'balance'=> $new_balance, 'percentage'=> $new_paid_percentage, 'apportionment_status' => $apportionment_status, 'paid_status' => $paid_status);
	$dr_where_array = array('request_id' => $reqid);

	//Update clients
	$clients_update_array = array('credit' => $new_credit);
	$clients_where_array = array('id' => $client_id);

	//Do Dispatch Register Update
	$this -> db -> where($dr_where_array);
	$this -> db -> update('dispatch_register',$dr_update_array);

	//Do Clients Update
	$this -> db -> where($clients_where_array);
	$this -> db -> update('clients', $clients_update_array);

}

public function deposit(){
	$client_credit = Clients::getClientCredit($cid);
	$deposit = $this -> input -> post('deposit');
	$cid = $this -> uri -> segment(3);
}

public function deposit_view(){
	$data['cid'] = $this -> uri -> segment(3); 
	$this -> load -> view('deposit_v', $data);
}

public function show_more_dispatch(){
	$data['rid'] = $this -> uri -> segment(3);
	$this -> load -> view('payments_v', $data);	
}

public function show_breakdown(){
	$data['rid'] = $this -> uri -> segment(3);
	$this -> load -> view('billing_breakdown_v', $data);	
}



public function base_params($data) {
	$data['title'] = "Finance Billing";
	$data['styles'] = array("jquery-ui.css");
	$data['scripts'] = array("jquery-ui.js");
	$data['scripts'] = array("SpryAccordion.js");
	$data['styles'] = array("SpryAccordion.css");		
	$data['content_view'] = "settings_v";
	$data['banner_text'] = "Chromatographic Conditions";
	$data['link'] = "settings_management";
	$this -> load -> view('template', $data);
}


public function save_sample_pay(){
		if (is_null($_POST)) {
			echo json_encode(array(
				'status' => 'error',
				'message'=> 'Data was not posted.'
				));
			}
			else {
			echo json_encode(array(
				'status' => 'success',
				'message'=> 'Data added successfully',
			));
		}

		
		$client_id = $this-> uri ->segment(3);		 
		$totalAmountOwed = Client_billing::getTotalperClient($client_id);
		$reqid = $this -> input -> post('reqid', TRUE);
		$amount_paid = $this -> input -> post('amount_paid', TRUE);
		$amountOwedPerSample = Client_billing::getAmountOwedPerSample($reqid);
		$a_owedPerSample = $amountOwedPerSample[0]['sum'];
		$percentage = $amount_paid / $a_owedPerSample * 100;
				if($percentage == '100'){
					$paid_status = '1';
				}
				else{
					$paid_status = '0';
				}
		//Save Payments
		$fpay = new Payments();
		$fpay -> client_id = $client_id;
		$fpay -> amount_paid = $amount_paid;
		$fpay -> request_id = $reqid;
		$fpay -> payment_date = date('y-m-d');
		$fpay -> percentage = $percentage;
		$fpay -> status = $paid_status;
		$fpay -> save();

		$existing_credit = Clients::getClientCredit($client_id);
		$e_credit = $existing_credit[0]['credit'];
		$credit = $e_credit - $amount_paid; 
		$balance1 = $a_owedPerSample - $amount_paid;
		$balance = $balance1;
		$credit_update = array('credit' => $credit);
		$dr_update = array('amount_paid' => $amount_paid,'balance' => $balance);
		$request_update = array('payment_status' => $paid_status);
		
		//Update Client Credit in Client Table
		$this -> db -> where('id', $client_id);
		$this -> db -> update('clients', $credit_update);	

		$this -> db -> where('request_id', $reqid);
		$this -> db -> update('request', $request_update);	

		$this -> db -> where('request_id', $reqid);
		$this -> db -> update('dispatch_register', $dr_update);	


}

public function save_pay(){
		if (is_null($_POST)) {
			echo json_encode(array(
				'status' => 'error',
				'message'=> 'Data was not posted.'
				));
			}
			else {
			echo json_encode(array(
				'status' => 'success',
				'message'=> 'Data added successfully',
			));
		}

		$front_amount_owed = $this -> uri -> segment(5);
		$client_id = $this-> uri ->segment(4);
		$reqid = $this-> uri ->segment(3);
		
		//Dirty hack to avoid division by 0.
		if($front_amount_owed == 0){
			$front_amount_owed = 1;
		}


		//Transaction Details
		$front_amount_paid = $this -> input -> post('amount_paid', TRUE);
		$receipt_no = $this -> input -> post('receipt_no', TRUE);
		$client_paid_for = $this -> input -> post('client_paid_for', TRUE);
		
		//Payer Details
		$name = $this -> input -> post('name', TRUE);
		$id_no = $this -> input -> post('id_no', TRUE);
		$phone_no = $this -> input -> post('phone_no', TRUE);


		$balance1 = $front_amount_owed - $front_amount_paid;
		$front_percentage = $front_amount_paid / $front_amount_owed * 100; 

		//Db Values
		$db_amount_paid = Dispatch_register::getAmountPaid($reqid);
		$db_percentage = Dispatch_register::getPercentage($reqid);
		
		//Consolidated values (Db + Front)
		$amount_owed = $front_amount_owed -($db_amount_paid[0]['amount_paid'] + $front_amount_paid); 
		$amount_paid = $db_amount_paid[0]['amount_paid'] + $front_amount_paid;
		$percentage = $db_percentage[0]['percentage'] + $front_percentage;
		$balance = $amount_owed; 

		//Get no. of payments
		$no_of_payments = Payments::getRowCount();
		$serial = $no_of_payments[0]['count'] + 1;

		//Auto Generate Receipt No.
		$auto_receipt_no = "NDQR-".$client_id."-".date('y-m')."-". $serial;

		//Save Payments
		$fpay = new Payments();
		$fpay -> client_id = $client_id;
		$fpay -> request_id = $reqid;
		$fpay -> name = $name;
		$fpay -> id_no = $id_no;
		$fpay -> phone_no = $phone_no;
		$fpay -> amount_owed = $amount_owed;
		$fpay -> amount_paid = $amount_paid;
		$fpay -> a_paid = $front_amount_paid;		
		$fpay -> receipt_no = $receipt_no;
		$fpay -> auto_receipt_no = $auto_receipt_no;
		$fpay -> client_paid_for = $client_paid_for;
		$fpay -> percentage = $percentage;
		$fpay -> payment_date = date('y-m-d');
		$fpay -> save();

		//Condition to set credit
		if($balance < 0){
			$new_credit = $balance * -1;
		}
		else{
			$new_credit = 0;
		}
 
 		//Update Client Credit
		$existing_credit = Clients::getClientCredit($client_id);
		$e_credit = $existing_credit[0]['credit'];
		$credit = $e_credit + $new_credit; 
		$credit_update = array('credit' => $credit);

		//Update Dispatch Register Amount and Balance
		$dr_update = array('amount_paid' => $amount_paid,
						   'balance' => $balance,
						   'percentage' => $percentage);
		$this -> db -> where('request_id', $reqid);
		$this -> db -> update('dispatch_register', $dr_update);		
		
		//Update Client Credit in Client Table
		$client_update = array('credit' => $credit);	
		$this -> db -> where('id', $client_id);
		$this -> db -> update('clients', $credit_update);
}

public function getAmountP(){
	$r = $this -> uri -> segment(3);
	$e_credit2 = Client_billing::getTotalperClient($r);
	echo $e_credit2[0]['sum'];
	//var_dump($e_credit2);
}


public function payment(){

		//Check if $_POST is_null
		if (is_null($_POST)) {
			echo json_encode(array(
				'status' => 'error',
				'message'=> 'Data was not posted.'
				));
			}
			else {
			echo json_encode(array(
				'status' => 'success',
				'message'=> 'Data added successfully',
			));
		}

		//Client Details
		$client_id = $this-> uri ->segment(3);

		//Transaction Details
		$amount_paid = $this -> input -> post('amount_paid', TRUE);
		$receipt_no = $this -> input -> post('receipt_no', TRUE);
		$client_paid_for = $this -> input -> post('client_paid_for', TRUE);
	

		//Payer Details
		$name = $this -> input -> post('name', TRUE);
		$id_no = $this -> input -> post('id_no', TRUE);
		$phone_no = $this -> input -> post('phone_no', TRUE);

		//Get no. of payments
		$no_of_payments = Payments::getRowCount();
		$serial = $no_of_payments[0]['count'] + 1;

		//Auto Generate Receipt No.
		$auto_receipt_no = "NDQR-".$client_id."-".date('y-m')."-". $serial;

		//Get sample quotations for client
		$samples = Dispatch_register::getDispatchPerSample($client_id);


		//Save Payments
		$fpay = new Payments();
		$fpay -> client_id = $client_id;
		$fpay -> payer_name = $name;
		$fpay -> id_no = $id_no;
		$fpay -> phone_no = $phone_no;
		$fpay -> amount_paid = $amount_paid;	
		$fpay -> receipt_no = $receipt_no;
		$fpay -> auto_receipt_no = $auto_receipt_no;
		$fpay -> client_paid_for = $client_paid_for;
		$fpay -> payment_date = date('y-m-d');
		$fpay -> save();

		//Get existing client credit
		$client_credit = Clients::getClientCredit($client_id);
		$credit = $client_credit[0]['credit'];

		//Add existing client credit to amount paid
		$new_credit = $credit + $amount_paid;

		//Update Client Credit
		$credit_update_array = array('credit' => $new_credit);
		$this -> db -> where('id', $client_id);
		$this -> db -> update('clients', $credit_update_array);

}

public function getDispatchAll(){
	$sql = 'select d.*, c.*, t.*, count(distinct(d.request_id)) as all_samples, 
			count(distinct case when paid_status = 0 then d.request_id end) as un_paid,
			count(distinct case when paid_status = 1 then d.request_id end) as partially_paid,
			count(distinct case when paid_status = 2 then d.request_id end) as fully_paid,
			t.total_paid as total_paid,
			sum(amount) as total_owed,
			(sum(amount) - t.total_paid) as total_balance 
			from dispatch_register d
			left join (select  p.*, sum(p.amount_paid) as total_paid from payments p GROUP BY p.client_id) t on t.client_id = d.client_id
			left join clients c on c.id = d.client_id
			where d.quotation_status = "1"
			group by d.client_id';
	$query = $this->db->query($sql);
	$dispatch =  $query -> result_array();
	return $dispatch;
}

public function test_samples(){

	//Get variables from URI
	$client_id = $this-> uri ->segment(3);
	$amount_paid = $this -> uri -> segment(4);

	//Initiatize amounts array
	$amount_array1 = array();
	$amount_array2 = array();

	//Get samples array
	$balance = Dispatch_register::getBalance($client_id);
	$samples = Dispatch_register::getDispatchPerSampleSimple($client_id);
	//$dispatch = Dispatch_register::getAllDispatchByClient2();
	//echo count($samples);


		//Get amount owed
		$amount_owed_total = Dispatch_register::getAmountOwedTotal($client_id);

		//Condition determines whether any of the final invoices for the client is out
		//If the invoiced amount is nil, then amount owed is amount in proforma minus amount paid else ... amount in invoice minus amount paid
		if($amount_owed_total[0]['total_invoiced_amount'] == 0){
			$total_amount_owed = $amount_owed_total[0]['total_proforma_amount'] - $amount_owed_total[0]['total_amount_paid'];
		}
		else{
			$total_amount_owed = $amount_owed_total[0]['total_invoiced_amount'] - $amount_owed_total[0]['total_amount_paid'];
		}

		//Get percentage of amount paid / amount owed
		if($amount_paid > 0){
			if($total_amount_owed > 0){
				$pay_percentage = $amount_paid / $total_amount_owed * 100;
			}
			else{

				//Percentage more than 100% since difference is negative i.e Client paid more.
				$surplus_percentage = $amount_paid / $total_amount_owed * 100 * -1;

				//Normal Percentage
				$pay_percentage = 100;
				
				//Get percentage of extra payment
				$extra_percentage = $surplus_percentage - $pay_percentage;

				//Extra paid
				$total_amount_owed = $total_amount_owed * -1;
			}
		}
		else{
			$pay_percentage = 0;
		}


		for($i=0;$i<count($samples);$i++){
			if($samples[$i]['invoiced_amount'] == 0){

				//Get balance for this analysis request
				$balance = $samples[$i]['amount'] - $samples[$i]['amount_paid'];
				
				//Get new amount to update
				$update = $balance + ($pay_percentage * $amount_paid);

				//Percentage
				$individual_percentage = $update/$samples[$i]['amount'] * 100;
			}

		}

		echo $pay_percentage;
		//var_dump($amount_array2);


		$amount_array = array_merge($amount_array1, $amount_array2);
		//var_dump($amount_array);

}



}
?>