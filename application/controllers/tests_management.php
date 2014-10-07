<?php
	class Tests_management extends MY_Controller {
		public function methods(){
			//$reqid = $this -> uri -> segment(3);
			$test_id = $this -> uri -> segment(3);
			$data['methods']= Test_methods::getMethods($test_id);
			$data['content_view'] = "methods_v";
			$this -> load -> view('template1', $data);
			
		}

		public function testsMethodsWizard1(){
			$data['reqid'] = $this -> uri -> segment(3);
			$data['sample_info'] = Request::getSampleInfoSimple($data['reqid']);
			$data['tests'] = Tests::getTestsPerRequest($data['reqid']);
			$data['content_view'] = "tests_methods_wizard_v";
			$this -> load -> view('template1', $data);
		}


		public function testsMethodsWizard(){
			
			//get table names from uri segments 
		    $data['table'] = $table1 = $this -> uri -> segment(4);
		    $data['table2'] = $table2 = $this -> uri -> segment(5);
		   	$data['table3'] = $table3 = $this -> uri -> segment(6);
		    $data['reqid'] = $this -> uri -> segment(3);

		    //Get Client_id
		    $data['client_id'] = $c = $this -> uri -> segment(7);


		    //construct methods from table names from uri segments
		    $method1 = 'get'.ucfirst($table1).'InfoSimple';
		 	$method2 = 'get'.ucfirst($table2).'Per';
		   	

		 	//construct table name from uri segments
		   	$table4 = $table1."_components"; 

		   	//construct method to get components
		   	$method3 = 'get'.ucfirst($table4);

			//Get column to use to do where clause
		   	$ref = $table1.'_id';

			//get data from tables
			$data['sample_info'] = $table1::$method1($data['reqid']);
			$data['tests'] = $table2::$method2($data['reqid'], $table3, $ref);
			$data['components'] = $table4::$method3($data['reqid'], $ref);
			$data['components_count'] = count($data['components']);
			
			//Var_dump 
			//echo $table2."::".$method2."(".$data['reqid'].",".$table3.",".$ref.")";
			//var_dump($data['tests']);
			//pass data to view
			$data['content_view'] = "tests_methods_wizard_v";
			$this -> load -> view('template1', $data);
		}

		public function updateClientBilling(){
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

			//Initialize Charges arrays
			$test_charges = array();
			$method_charges = array();

			//Get request id
			$reqid = $this -> uri -> segment(3);
			$table = $this -> uri -> segment(4);
			
			//Condition to set table, method variables
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

			//Get POST values
			$tests = $this -> input -> post('tests', TRUE);
			
			//Capitalize components table variable, make as class
			$components_table_class = ucfirst($components_table);

			//Get components method
			$components_method = 'get'.$components_table_class;

			//Get component ids from quotation_components table
			$components = $components_table_class::$components_method($reqid, $ref);
			
			//Array to hold component specific method charges
			$method_charges_components = array();
			$multi_tests = array(2,5);

			if(count($components) > 1){
				for($i=0;$i<count($multi_tests);$i++){
			//Update quotation components ,Loop through components
				foreach($components as $component){

					//Get Method Post Name for Assay
					$method_post_name = "methods_".$component['component']."_".$multi_tests[$i];
					$method2 = $this -> input -> post($method_post_name);

					//If method is not null then get Method Details
					if($method2 != 0){
						$method_details = Test_methods::getMethodDetails($method2);
						$mcharges = $method_details[0]['charge'];
						array_push($method_charges_components, $method_details[0]['charge']);
					}
					else{
						$mcharges = 0;
					}

					//Update Arrays
					$cb_where_array = array('test_id' => $multi_tests[$i], 'component' => $component['component']);
					$cb_update_array = array('method_charge' => $mcharges , 'method_id' => $method2);

					//Update quotation_components
					$this -> db -> where($cb_where_array);
					$this -> db -> update($components_table, $cb_update_array);

					}
				}
			}
			
			//else{

				//Update client billing
				for($i=0;$i<count($tests);$i++){

					//Get Method Post Name
					$method_post_name = "methods_".$tests[$i];
					$method = $this -> input -> post($method_post_name);

					//If method is not null then get Method Details
					if($method != 0){
						$method_details = Test_methods::getMethodDetails($method);
						$mcharges = $method_details[0]['charge'];
						array_push($method_charges, $method_details[0]['charge']);
					}
					else{
						$mcharges = 0;
					}

					//Get test details
					$test_details = Tests::getCharges($tests[$i]);
					
					//

					//Update Arrays
					$cb_where_array = array($id => $reqid, 'test_id' => $tests[$i]);
					$cb_update_array = array('method_charge' => $mcharges , 'method_id' => $method);

					//var_dump($cb_where_array);
					//echo $billing_table;
					//var_dump($cb_update_array);
					//Update Client Billing
					$this -> db -> where($cb_where_array);
					$this -> db -> update($billing_table, $cb_update_array);
				
					//Push method charges into initialized array
					array_push($test_charges, $test_details[0]['Charge']);

					}
				//}
					
			
			if(count($components) < 2){
				//Get Totals
				$method_totals = array_sum($method_charges);
				$test_totals = array_sum($test_charges);
				$total_charges = $method_totals + $test_totals;

				//Determine if request made from quotation or request , do discount

				if($main_table == 'request'){
					//Get Discount	
					$discount_percentage = 10;
					$discount = $total_charges * $discount_percentage/100;

					//Discounted amount
					$discounted_amount = $total_charges - $discount;
				}
				else{
					$discounted_amount = $total_charges;
					$discount = 0;
				}


				//Update Dispatch register
				$quotation_status = 1;
				$dr_update_array = array('amount' => $discounted_amount, 'discount' => $discount, 'quotation_status' => $quotation_status);
				$this -> db -> where($id, $reqid);
				$this -> db -> update($register, $dr_update_array);

				//Update Main Table
				$main_update_array = array('quotation_status' => $quotation_status);
				$this -> db -> where($id, $reqid);
				$this -> db -> update($main_table, $main_update_array);
			}

		}

	}
?>