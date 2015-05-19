<?php

class Client_Management extends MY_Controller{
	function __construct(){
		//calls constructor method
		parent::__construct();
	}//end constructor
	
	public function index(){
		//redirects to listing method
		$this -> listing();
	}//end index
	
	public function listing(){
		//method listing() gives a tabular report of existing records
		$data = array();
		//places view on the right in the array key 'settings_view', and can thus be accessed under the key from elsewhere
		//$data['settings_view'] = "clients_v";
				
		//the method call on the right passes the returned data as an array and stores it in the 'client_details' key to be called from another file
		$data['client_details'] = Clients::getAllHydrated();
		
		//formatting for the tabular report mentioned above, make sure to pass id and the rest are the way you'd like the title captions
		$this -> table -> set_heading(array('id', 'Client Name', 'Client Address','Client Type', 'Contact Person', 'Contact Phone'));
		
		//pass all the data in the '$data' array to the base_params method
		$this -> base_params($data);
	}//end listing
		
	public function save(){
		//stores the validation results in a variable, $valid
		$valid = $this -> _validate_submission();
		
		//if the result is true or false...



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

		 //variable name   //class  //html control //php post function("control name in the html file")
		 	$email = $this -> input -> post("client_email");
		 	$version_id = $this -> input -> post("version_id");
			$client_name = $this -> input -> post("client_name");
			$client_address = $this -> input -> post("client_address");
			$client_number = $this -> input -> post("clientT");
			$contact_person = $this -> input -> post("contact_person");
			$contact_phone = $this -> input -> post("contact_phone");
			$comment = "No Comment";
			$client_id = $this -> input -> post("clientid");
			$client_name1 = str_replace(' ', '_', $client_name);
			$client_name2 = str_replace(')', '-', $client_name1);
            $alias = str_replace('(', '-', $client_name2);
			$quotation_status = $this -> input -> post("q_status");
			$quotation = $this -> uri -> segment(3);

			if($this -> checkUserExistsThenSendorError2() == '0' ){

				//variable storing the class instance	
				$client = new Clients();
				//passing the variables posted above to the class variable
				$client -> Name = $client_name;
				$client -> Address = $client_address;
				$client -> Client_type = $client_number;
				$client -> Contact_person = $contact_person;
				$client -> Contact_phone = $contact_phone;
				//$client -> Ref_number = $client_ref_no;
				$client -> Version_id = $version_id;
				$client -> Clientid = $client_id;
				$client -> Alias = $alias;
				$client -> Comment = $comment;
				$client -> email = $email;


				//Save client data						
				$client -> save();

				//Set statuses
				$client_usertype = "29";
				$client_status = "0";
				$pWord = "123456";

				//Save to Users_types Table to enable client login
				$client_users = new Users_types();
				$client_users -> email = $email;
				$client_users -> usertype_id = $client_usertype;
				$client_users -> password = md5('#*seCrEt!@-*%'.$pWord);
				$client_users -> status = $client_status;
				$client_users -> save();

				//Save to User table.
				$client_user = new User();
				$client_user -> fname  = $client_name;
				$client_user -> username = $client_name;
				$client_user -> email = $email;
				$client_user -> telephone = $contact_phone;
				$client_user ->	user_type = $client_usertype;
				$client_user -> save();

				//Save Quotation
				if($quotation  == 'quotation'){
					$this->saveQuotation();	
				}
			}

			else{
				//Save Quotation
				if($quotation == 'quotation'){
					$this->saveQuotation();
				}	
			}
	}//end save

	public function saveQuotation(){

				//Get Last Quotation Id
				$last_quotation_id = Quotations::getLastId();
					if(!empty($last_quotation_id)){
						$last_id = $last_quotation_id[0]['max'];
					}
					else{
						$last_id = 0;
					}	
				$new_id = (int)$last_id + (int)1;
				$email = $this -> input -> post("cemail");

				
				//Save Quotation
				$quotation = new Quotations();
					if(isset($client_id)){
						$quotation -> client_id =  $client_id;
					}
				$quotation -> client_email = $email;
				$quotation -> quotation_no = "NQCL" . "-Q" . "-" . date('y'). "-" . date('m'). "-".$new_id;
				$quotation -> quotation_date = date('y-m-d');
				$quotation -> total_amount = 0;	
				$quotation -> save();
	}

	public function checkQuotationNo(){
			$last_quotation_id = Quotations::getLastId();
			//var_dump($last_quotation_id);
			if(!empty($last_quotation_id)){
				$last_id = $last_quotation_id[0]['max'];
			}
			else{
				$last_id = 0;
			}
			$new_id = (int)$last_id + (int)1;
			var_dump($new_id);	
	}


	public function checkUserExistsThenSendorError2() {
		$user_is = $this->input->post('email_hidden');
		$this->db->select('id');
		$this->db->where('email', $user_is);
		$query = $this->db->get('clients');
		if ($query->num_rows() > 0) {
			return '1';
		} else {
			return '0';
		}
	}
	
	public function edit(){

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
                'message'=> 'Data added successfully'
            ));
            }

            $cid = $this -> input -> post("cid");
            $cname = $this -> input -> post("cname");
			$ctype = $this -> input -> post("ctype");
			$cadd = $this -> input -> post("cadd");
			$cperson = $this -> input -> post("cperson");
			$cphone = $this -> input -> post("cphone");
			$comment = $this -> input -> post("comment");
			$status = $this -> input -> post("status");
			$edit_status = "1";

			$clients_update = array(
				'Name' => $cname,
	        	'Client_type' => $ctype,
	        	'Address' => $cadd,	
	        	'Contact_person' => $cperson,
	        	'Contact_phone' => $cphone,
	        	'Comment' => $comment,
	        	'Client_status' => $status,
	        	'Edit_status' => $edit_status
			);

			$this -> db -> where(array('id' => $cid));
        	$this -> db -> update('clients', $clients_update);	

	}


	/*public function update(){
		//stores the validation results in a variable, $valid
		$valid = $this -> _validate_submission();
		
		//if the result is true or false...
		if($valid == false){
			$this -> listing();
		}else{
		 //variable name   //class  //html control //php post function("control name in the html file")
		$version_id = $this -> input -> post("version_id");
		
		$client_name = $this -> input -> post("applicant_name");
		$client_address = $this -> input -> post("applicant_address");
		$client_type = $this -> input -> post("clientT");
		$contact_person = $this -> input -> post("contact_name");
		$contact_phone = $this -> input -> post("contact_telephone");
		$client_ref_no = $this -> input -> post("client_ref_no");
		$client = new Clients();
			
			//passing the variables posted above to the class variable
			$client -> Name = $client_name;
			$client -> Address = $client_address;
			$client -> Client_type = $client_number;
			$client -> Contact_person = $contact_person;
			$client -> Contact_phone = $contact_phone;
			$client -> Ref_number = $client_ref_no;
			$client -> Version_id = $version_id;
			//save the data						
			$client -> update();
			
			//get details of last client added
			//$data['lastclient']= Clients::getLast();
			
			//redirect("request_management/l");
		}//end else
	}*/
	

	public function clients_showHistory(){
		$data['cid'] = $this -> uri -> segment(3);
        $data['clients'] = Clients::getClientDetail($data['cid']);
        $this -> load -> view ("clients_history_v", $data);
	}

	public function clntslist(){
		$data['cid'] = $this -> uri -> segment(3);
		$query_array = array('clients_log_id' => $data['cid']);
        $query = $this -> db -> get_where('clients_log', $query_array);
        foreach($query-> result() as $row){
                    $data2[] = $row;
                }
        echo json_encode($data2);
	}
	
	
	
	
	private function _validate_submission() {
		//validation rules
		$this -> form_validation -> set_rules('client_name', 'Client Name', 'trim|required|min_length[2]|max_length[25]');
		$this -> form_validation -> set_rules('client_address', 'Client Address', 'trim|required|min_length[2]|max_length[25]');
		//$this -> form_validation -> set_rules('client_ref_no', 'Client Number', 'trim|required|min_length[1]|max_length[15]');
		$this -> form_validation -> set_rules('contact_person', 'Contact Person', 'trim|required|min_length[2]|max_length[25]');
		$this -> form_validation -> set_rules('contact_phone', 'Contact Telephone Number', 'trim|required');
		return $this -> form_validation -> run();
	}//end validate_submission
	
	public function base_params($data) {
		$data['title'] = "Client Management";	
		//$data['styles'] = array("jquery-ui.css");
		//$data['scripts'] = array("jquery-ui.js");
		$data['quick_link'] = "clients";
		$data['content_view'] = "settings_v";
		$data['settings_view'] = "clients_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";
		
		$this -> load -> view('template',$data);
	}//end base_params
}//end class
