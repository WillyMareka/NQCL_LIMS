<?php
class Client_billing_management extends MY_Controller {
	

public function trackSample(){
$u_id = $this -> session -> userdata('usertype_id');
}

public function index(){
	$this -> paymentHistory();
}


public function viewRequests(){
	$data["quick_link"] = "Requests";
	$u_id = $this -> session -> userdata('usertype_id');
	$data['settings_view'] = "client_requests_v";
	$this -> base_params($data);
}


public function requests_list(){
	$uname = $this -> session -> userdata('username');
	$request =Request::getRequestsPerClient($uname);
	foreach ($request as $r){
		$data[] = $r;
	}
	echo json_encode($data);
}

public function charges_list(){
	$rid = $this -> uri -> segment(3);
	$charges =Client_billing::getChargesPerClient($rid);
	foreach ($charges as $r){
		$data[] = $r;
	}
	echo json_encode($charges);
}

public function show_more(){
	$data['rid'] = $this -> uri -> segment(3);
	$this -> load -> view('client_billing_v', $data);	
}
function me(){
	$this->load->view('');
}

public function getClientId(){
	$data['name'] = $uname = $this -> session -> userdata('username');
	$cid = Clients::getUid($uname);
	$id = $cid[0]['id'];
	return $id;
}

public function paymentHistory(){
	$data["quick_link"] = "Payments";
	$data['cid'] = $cid = $this -> session -> userdata('user_id');
	$data['name'] = $uname = $this -> session -> userdata('username');
	$data['id'] = $this -> getClientId();
	$data['settings_view'] = "client_payments_per_client_v";
	$this -> base_params($data);
}

public function sampleTracking(){
	$data["quick_link"] = "Tracking";
	$data['cid'] = $this -> uri -> segment(3);
	$data['content_view'] = "client_sample_tracking_v";
	$this -> load -> view('template1', $data);
}

public function datalist(){
	$this -> dataPerlist();
}

public function tracking_list(){
	$rid = $this -> uri -> segment(3);
	$tracking = Worksheet_tracking::getTrackingPerRequest($rid);
	if(!empty($tracking)){
		foreach ($tracking as $r){
			$data[] = $r;
		}
		echo json_encode($data);
	}
	else{
		echo "[]";
	}	
}

public function paymentsPerClient(){
	$id = $this -> uri -> segment(3);
	$sql = "select d.*, c.*, count(distinct(d.request_id)) as all_samples,
			count(distinct case when paid_status = 0 then d.request_id end) as un_paid,
			count(distinct case when paid_status = 1 then d.request_id end) as partially_paid,
			count(distinct case when paid_status = 2 then d.request_id end) as fully_paid,
			t.total_paid as total_paid,
			sum(amount) as total_owed,
			(sum(amount) - t.total_paid) as total_balance 	
			from dispatch_register d
			left join (select  p.*, sum(p.amount_paid) as total_paid from payments p group by p.client_id ) t on t.client_id = d.client_id
			left join clients c on c.id = d.client_id
			where d.quotation_status = '1'
			and d.client_id = "."'".$id."'";	
	
	$query = $this->db->query($sql);
	$dispatch =  $query -> result();
	if(!empty($dispatch)){
		echo json_encode($dispatch);
	}
	else{
		echo "[]";
	}
}


public function showInvoiceBillPerTest(){
	
	//Get unique id
	$data['rid'] = $this -> uri -> segment(3);
	
	//Get tables
	$data['table'] = $this -> uri -> segment(4);
	$data['table2'] = $this -> uri -> segment(5);
	$data['table3'] = $this -> uri -> segment(6);

	//Get client id
	$data['client_id']  = $this -> uri -> segment(7);

	//Get list of eligible signatories
	$data['signatories'] = User::getSignatories();

	//Set view, load it
	$data['content_view'] = 'invoice_bill_per_test_v';
	$this -> load -> view('template1', $data);	
}

public function showBillPerTest(){
	
	//Get unique id
	$data['rid'] = $this -> uri -> segment(3);
	
	//Get tables
	$data['table'] = $this -> uri -> segment(4);
	$data['table2'] = $this -> uri -> segment(5);
	$data['table3'] = $this -> uri -> segment(6);

	//Get client id
	$data['client_id']  = $this -> uri -> segment(7);

	//Get list of eligible signatories
	$data['signatories'] = User::getSignatories();

	//Set view, load it
	$data['content_view'] = 'bill_per_test_v';
	$this -> load -> view('template1', $data);	
}



public function base_params($data) {
	$data['title'] = "Client Billing";
	$data['styles'] = array("jquery-ui.css");
	$data['scripts'] = array("jquery-ui.js");
	$data['scripts'] = array("SpryAccordion.js");
	$data['styles'] = array("SpryAccordion.css");		
	$data['content_view'] = "settings_v";
	$data['banner_text'] = "Chromatographic Conditions";
	$data['link'] = "settings_management";
	$this -> load -> view('template', $data);
}

}
?>