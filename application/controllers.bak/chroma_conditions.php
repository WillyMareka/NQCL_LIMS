<?php
class Chroma_conditions extends MY_Controller {
	

public function index(){
	$this -> itemsUsed();	
}

public function itemsUsed(){
	$data = array();
	$reqid = $this -> uri -> segment(3);
	$data['components'] = Components::getComponents($reqid);
	$data['content_view'] = "items_used_v";
	$this -> load -> view("template1", $data);
}


public function hplc(){

$data=array();        
$data['content_view'] = "chroma_hplc";
$this -> load -> view("template1", $data);	
	
}


public function columns(){
	$data=array();
	$data['worksheet_name'] = $this -> uri -> segment(5);
	$data['test_id'] = $this -> uri -> segment(3);
	$data['reqid'] =  $this -> uri -> segment(4);
	$data['save_url'] = $this->router->fetch_class();
	$data['formname'] = $this->router->fetch_method() . "form"; 
       
	$data['content_view'] = "chromatographic_conditions_v";
	$this -> load -> view("template1", $data);	
}


public function compendia(){
	$data=array();
	$data['worksheet_name']  =$this -> uri -> segment(5);
	$data['test_id'] = $this -> uri -> segment(3);
	$data['reqid'] =  $labref=$this -> uri -> segment(4);
         $data['c_count']= $this->load_count($labref);
	$data['save_url'] = $this->router->fetch_class();
	$data['formname'] = $this->router->fetch_method() . "form"; 
        
	$data['content_view'] = "compendia_v";
	$this -> load -> view("template1", $data);	
}

function load_count($labref){
   return $this->db->where('request_id',$labref)->get('components')->result(); 
}


public function compendia_save(){
	$this->checkPost();

	//Get Request_id
	$reqid = $this -> input -> post("request_id");

	//Get Test_id
	$test_id = $this -> input -> post("test_id");

	//Hold input values in variables - get compendia and specification
	$compendia = $this -> input -> post("compendia");
       // print_r($compendia);
        $c_splited = implode(":", $compendia);
	$specification = $this -> input -> post("specification");
        $s_splited = implode(":", $specification);
	
      

	//Concatenate specifications and limits
	//$specs_limits = $specification . " " .$limits;
        
   

	//Update arrays
	$coa_body_where_array = array('test_id' => $test_id, 'labref' => $reqid);
	$coa_body_update_array = array('compedia' => $c_splited, 'specification' => $s_splited);

	//Update Coa Body
	$this -> db -> where($coa_body_where_array);
	$this -> db -> update('coa_body', $coa_body_update_array);
	
	//Set compendia status to 1 in sample issuance table
$this -> setCompendiaStatus($test_id, $reqid);

}


public function setCompendiaStatus($t, $r){

	//Set Compendia Status to 1 in Sample Issuance Table
	$this -> db -> where(array('test_id' => $t, 'lab_ref_no' => $r));
	$this -> db -> update('sample_issuance', array('compendia_status'=>1));
}


public function getUser(){
	$userarray = $this->session->userdata;
	$user_id = $userarray['user_id'];
	return $user_id;
}

public function checkPost(){
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
}


public function save(){

	//Check if POST is successful
	$this -> checkPost();

	//User Logged in
	$user_id = $this->getUser();

	//Get Lab Reference Number
	$reqid = $this -> input -> post("request_id");

	//Get Test_id
	$test_id = $this -> input -> post("test_id");

	//Hold input values in variables
	$id = $this -> input -> post("column_id");
	$column_temp = $this -> input -> post("column_temp");
	$detection = $this -> input -> post("detection");
	$injection = $this -> input -> post("injection");
	$flow_rate = $this -> input -> post("flow_rate");
	$pump_pressure = $this -> input -> post("pump_pressure");
	$mobile_phase = $this -> input -> post("mobile_phase");


	//Log Column Usage
	$clmn =  new Columns_usage();
	$clmn -> column_id = $id;
	$clmn -> request_id = $reqid;
	$clmn -> test_id = $test_id;
	$clmn -> date = date('y-m-d');
	$clmn -> user_id = $user_id;
	$clmn -> save();

	//Save Chromatographic Conditions
	$chrmcnd = new Chromatographic_conditions();
	$chrmcnd -> request_id = $reqid;
	$chrmcnd -> test_id = $test_id;
	$chrmcnd -> column_id = $id;
	$chrmcnd -> column_temp = $column_temp;
	$chrmcnd -> detection = $detection;
	$chrmcnd -> injection = $injection;
	$chrmcnd -> flow_rate = $flow_rate;
	$chrmcnd -> pump_pressure = $pump_pressure;
	$chrmcnd -> mobile_phase = $mobile_phase;	
	$chrmcnd -> save();

	//Set status to 1
	$chroma_status = 1;

	//Set update arrays
	$chroma_where_array = array('lab_ref_no'=> $reqid, 'test_id' => $test_id);
	$chroma_update_array = array('chroma_status' => $chroma_status);
	

	//Update chromatographic conditions status to 0
	$this -> db -> where($chroma_where_array);
	$this -> db -> update('sample_issuance', $chroma_update_array);	

}



public function uv(){

$data=array();        
$data['content_view'] = "chroma_uv";
$this -> load -> view("template1", $data);	
}


public function GetAutocomplete($options=array(), $table_name, $column)
	{
		$this->db ->distinct();
		$this->db->select($column);
		$this->db->like($column, $options[$column], 'after');
		$query = $this->db->get($table_name);
		return $query->result();
	}


public function suggestions()
	{
		$column = $this -> uri -> segment(4);
		$table = $this -> uri -> segment(3);
		$term = $this->input->post('term',TRUE);
		$rows = $this->GetAutocomplete(array($column => $term), $table, $column);
		$keywords = array();
		foreach ($rows as $row)
			array_push($keywords, $row-> $column);
		echo json_encode($keywords);
	}


	function getItems() {
		$table = $this -> uri -> segment(4);
		$method = "get" . $table;
		$ref = $this -> uri -> segment(3);
		$ref = str_replace('%20', '_', $ref);
		$details = $table::$method($ref);
		echo json_encode($details);
	}

	function pushCodes(){
		$details = $this->getCodes();
		$details_array = array();

		foreach($details as $detail)
			array_push($details_array, $details->code);
		echo json_encode($details_array);
	}

public function save_items(){
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

	//Date	
	$date = date('y-m-d');	

	//User id
	$userarray = $this->session->userdata;
	$user_id = $userarray['user_id'];	

	//Request id
	$reqid = $this -> uri -> segment(3);

	//Test id

	$test_id = $this -> uri -> segment(4);

	//Item ids		
	$equipment = $this -> input -> post('e_id', TRUE);
	$reagents = $this -> input -> post('r_id', TRUE);
	$standards = $this -> input -> post('s_id', TRUE);
	$columns = $this -> input -> post('c_id', TRUE);

	//Components per refsub
	$components = $this -> input -> post("s_components", TRUE);
	
	/*Quantity
	$reagents_qty = $this -> input -> post('reagents_qty', TRUE);
	$standards_qty = $this -> input -> post('standards_qty', TRUE);	
	*/

	//Save Equipment
	if(!empty($equipment)){
		for($i=0;$i<count($equipment);$i++){
			$equip =  new Equipment_usage();
			$equip -> equipment_id = $equipment[$i];
			$equip -> request_id = $reqid;
			$equip -> date = $date;
			$equip -> user_id = $user_id;
			$equip -> save();
		}
	}

	//Save Reagents
	if(!empty($reagents)) {
		for($i=0;$i<count($reagents);$i++){

			/*Offset used quantities against existing quantities
			$reagentData = Reagents::getQuantity($reagents[$i]);
			*/
			if(!empty($reagentData)){
				/*
				$oldReagentQty = $reagentData[0]['volume'];	
				$reagentUnit = $reagentData[0]['qunit'];
				$newReagentQty = $oldReagentQty - $reagents_qty[$i];
				$updateReagentQty = array('volume' => $newReagentQty);
		
				//Update reagents table
				$this -> db -> where('id', $reagents[$i]);
				$this -> db -> update('reagents', $updateReagentQty);				
				*/

				$rgnt =  new Reagents_usage();
				$rgnt -> reagent_id = $reagents[$i];
				$rgnt -> request_id = $reqid;
				$rgnt -> date = $date;
				$rgnt -> user_id = $user_id;
				//$rgnt -> quantity = $reagents_qty[$i];
				$rgnt -> unit = $reagentUnit;
				$rgnt -> save();
			}
		}
	}	

	 

	//Save Standards
	if(!empty($standards)) {

		for($i=0;$i<count($standards);$i++){	
			/*Offset used quantities against existing quantities
			$standardsData = Refsubs::getQuantity2($standards[$i]);
			*/
			//if(!empty($standardsData)){
				
				/*
				$oldStandardQty = $standardsData[0]['init_mass'];	
				$standardUnit = $standardsData[0]['init_mass_unit'];
				$newStandardQty = $oldStandardQty - $standards_qty[$i];
				$updateStandardQty = array('init_mass' => $newStandardQty);

				Update reagents table
				$this -> db -> where('id', $standards[$i]);
				$this -> db -> update('refsubs', $updateStandardQty);
				*/

				//Save Refsubs
				$rfsb =  new Refsubs_usage();
				$rfsb -> refsubs_id = $standards[$i];
				$rfsb -> request_id = $reqid;
				$rfsb -> date = $date;
				$rfsb -> user_id = $user_id;
				$rfsb -> component= $components[$i];
				//$rfsb -> quantity = $standards_qty[$i];
				//$rfsb -> unit = $standardUnit;
				$rfsb -> save();
			//}		
			
		}

	}
	//Save Columns
	
	/*if(!empty($standards)) {
		for($i=0;$i<count($columns);$i++){
			$rfsb =  new Columns_usage();
			$rfsb -> column_id = $columns[$i];
			$rfsb -> request_id = $reqid;
			$rfsb -> date = $date;
			$rfsb -> user_id = $user_id;
			$rfsb -> save();
		}
	}*/

	//Update equip status
	$equip_update_where_array = array('lab_ref_no' => $reqid);
	$equip_update_array = array('equip_status' => '1');
	$this -> db -> where($equip_update_where_array);
	$this -> db -> update('sample_issuance', $equip_update_array); 	
}	



public function base_params($data) {
$data['title'] = "Chromatographic Conditions";
$data['styles'] = array("jquery-ui.css");
$data['scripts'] = array("jquery-ui.js");
$data['scripts'] = array("SpryAccordion.js");
$data['styles'] = array("SpryAccordion.css");		
$data['content_view'] = "settings_v";
$data['banner_text'] = "Chromatographic Conditions";
$data['link'] = "settings_management";
$this -> load -> view('template', $data);
}

public function test(){
	$id = $this -> uri -> segment(3);
	$standardsData = Refsubs::getQuantity2($id);
	echo $oldStandardQty = $standardsData[0]['init_mass'];	
	echo $standardUnit = $standardsData[0]['init_mass_unit'];
	 //			$newStandardQty = $oldStandardQty - $standards_qty[$i];
	

	echo $newStandardQty;
}

}
?>