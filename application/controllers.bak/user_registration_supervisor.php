<?php

class User_registration_supervisor extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	public function index() {
		$data['title'] = "User Registration";
		$data['settings_view'] = "home_v";
		$data['content_view'] = "user_v_ajax_supervisor";
		$data['banner_text'] = "Add New User";
		$data['link'] = "home";

		//Get Type of User Logged in
		$userarray = $this->session->userdata;
		$user_id = $userarray['user_id'];
		$user_typ = User::getUserType($user_id);
		$data['user_type'] = $user_typ[0]['user_type'];


		$this -> load -> view("template", $data);
		

	}

	public function addUser() {
		$data['content_view'] = "signup_v_supervisor";
		$data['banner_text'] = "Sign Up";
		$data['title'] = "User Registration";
		$this -> load -> view("template", $data);
	}		
	
	public function saved() {
		
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

		$fname=$this->input->post('fName');
		$lname=$this->input->post('lName');
		$email=$this->input->post('email');
		$username=$this->input->post('email');
		$tPhone=$this->input->post('tPhone');
		$department_id=$this->input->post('deptID');		
		$usertype=$this->input->post('userType');		
						
		$this->registerClients($fname,$lname, $email, $username, $tPhone, $user_type, $department_id);
		
	}
	
	function getUserType($checkbox)
	{     
		$my_sum=0;
		$userType=$checkbox;

		foreach($userType as $x){
			$my_sum+=$x;
		}
		
		switch($my_sum){
			case 1:
			$user_type= 1;
			break;

			case 5:
			$user_type= 2;
			break;

			case 3:
			$user_type= 3;
			break;

			case 4:
			$user_type= 4;
			break;

			case 7:
			$user_type= 5;
			break;

			case 6:
			$user_type= 6;
			break;

			case 8:
			$user_type= 7;
			break;

		}
		
		return $user_type;
	}
	
	public function registerClientsT($fName, $lName, $email, $uName, $pWord, $tPhone, $userType, $deptID)
	{

		$pWord = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
        $salt = md5('#*seCrEt!@-*%'.$pWord);
	
		$user_details=array(
		'fname'=>$fName,
		'lname'=>$lName,
		'email'=>$email,
		'username'=>$uName,
		'password'=>$salt,
		'telephone'=>$tPhone,
		'department_id'=>$deptID		
		);
		
		$this->db->insert('user',$user_details);
		
		for($i=0;$i<count($userType);$i++){
			$usertype_details = array(
					'email' => $email,
					'usertype_id' => $userType[$i]
				);

			$this -> db -> insert('users_types', $usertype_details);		
		}	 

	}
	
	private function _submit_validate() 
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// validation rules
		$this->form_validation->set_rules('uName', 'Username', 
			'trim|required|alpha_numeric|min_length[3]|max_length[12]|unique[User.username]');
		
		$this->form_validation->set_rules('pWord', 'Password',
			'trim|required|min_length[3]|max_length[12]');
		
		$this->form_validation->set_rules('confPWord', 'Confirm Password',
			'trim|required|matches[pWord]');
				
		/*$this->form_validation->set_rules('fName', 'First Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('lName', 'Last Name', 
			'trim|required|alpha_numeric|min_length[3]');
		
		$this->form_validation->set_rules('email', 'E-mail',
			'trim|required|valid_email|unique[User.email]');
			
		$this->form_validation->set_rules('tPhone', 'Mobile Number', 
			'trim|required|numeric|min_length[10]');*/

		$this->form_validation->set_rules('userType[]', 'User Type', 
			'required');

		$this->form_validation->set_rules('deptID', 'Department ID', 
			'required');

		return $this->form_validation->run();		
	}
	
		private function _edit_validate() 
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// validation rules
		
		$this->form_validation->set_rules('fName', 'First Name', 
			'trim|required|alpha_numeric|min_length[1]');
			
		$this->form_validation->set_rules('lName', 'Last Name', 
			'trim|required|alpha_numeric|min_length[3]');
		
		$this->form_validation->set_rules('email', 'E-mail',
			'trim|required|valid_email|unique[User.email]');
			
		$this->form_validation->set_rules('tPhone', 'Mobile Number', 
			'trim|numeric|min_length[10]');

		$this->form_validation->set_rules('userType[]', 'User Type', 
			'required');

		$this->form_validation->set_rules('deptID', 'Department ID', 
			'required');

		return $this->form_validation->run();		
	}

	
	function requests_list(){
//		$query=$this->db->get('user');
		$allUsers = User::getAll6();
		$allUserTypes = User_type::getAll();	   
	   /*$this->db->select('u.*');
	   $this->db->from('user u');
	   $this->db->join('user_type ut', 'ut.id = u.user_type');
	   $this->db->join('user_acc_status uas', 'uas.status = u.acc_status');
	   $this->db->join('departments d', 'd.id = u.department_id');

	   $query= $this->db->get();
	   $result=$query->result();
	   
	   $array=array(
		   'aaData'=>$result
	   
	   );*/
        foreach($allUsers as $a){
            $data[] = $a;
        }
        echo json_encode($data);
	}
	
	public function listing() {
		//$data = array();
		$data['settings_view'] = "user_v_ajax_supervisor";
		$data['info'] =Request::getAll();
		$this -> base_params($data);
	}//end listing
	
/*	public function requests_list(){
        $request = user::getAllHydrated();
        foreach ($request as $r){
            $data[] = $r;
        }
        echo json_encode($data);
}
  */
  
  function getUsername($editUserID){	
		$this->db->where('id',$editUserID);
		$query=$this->db->get('user');
	return $result=$query->result();
		//print_r($result);
  }
  
  
	/*public function edit_view() {
		
		$userid=$this->uri->segment(3);
		$data['r'] = $this->getUsername($userid);		
		$data['content_view'] = "user_edit_v_supervisor";
		//$this -> base_params($data);
		$this -> load -> view("template", $data);
		
	}*/



	public function users_showHistory() {

        $data['uid'] = $this -> uri -> segment(3);
        //$data['content_view'] = "columns_history_v";
        $data['user'] = User::getUser($data['uid']);
        $this -> load -> view ("users_history_v", $data);

    }

    public function usrlog_list(){
        $uid = $this -> uri -> segment(3);
        $query_array = array('user_log_id' => $uid);
        $query = $this -> db -> get_where('user_log', $query_array);  
                foreach($query-> result() as $row){
                    $data[] = $row;
                }
        echo json_encode($data);
    }
	   
	   /*public function user_edit(){
        
        $fname = $this -> input -> post("fName");
        $lname = $this -> input -> post("lName");
        $email = $this -> input -> post("email");
        $telephone = $this -> input -> post("tPhone");
		$deptID = $this -> input -> post("deptID");
		$accStatus = $this -> input -> post("status");
        $dbid = $this -> input -> post("dbid");
        $comment = $this -> input -> post("comment");
		
		$checkbox=$this->input->post('userType');		
		$user_type= $this->getUserType($checkbox);
		$edit_status = "1";

        $user_update = array(
         'fname' => $fname,
         'lname' => $lname,
         'email' => $email,
         'telephone' => $telephone,
         'department_id' => $deptID,
		 'user_type' => $user_type,
		 'acc_status'=> $accStatus,
		 'edit_status' => $edit_status,
		 'comment' => $comment
        );

        $this -> db -> where('id', $dbid);
        $this -> db -> update('user', $user_update );

    }*/

	function user_password_reset($email){
		$password = '123456';
		$enc_password= md5('#*seCrEt!@-*%'.$password);
		$user_update = array(
         'password' => $enc_password,
		 'status' => '0'
        );

		$this -> db -> where('email', $email);	
        $this -> db -> update('users_types', $user_update );
	}
	
	function edit_view() {
		
		$userid=$this->uri->segment(3);
		$userDetails= $this->getUsername($userid);
		
		$uneditable= $userDetails[0]->user_type;

		if($uneditable==4 || $uneditable==5)
		{
		$data['content_view'] = "user_edit_uneditable";
		$this -> load -> view("template", $data);
		}
		else
		{
		$data['r'] = $this->getUsername($userid);
		$data['content_view'] = "user_edit_v_supervisor";
		$this -> load -> view("template", $data);
		}

	}

	function edit_user_validate() {
		$data['content_view'] = "user_edit_v_valid_supervisor";
		$data['banner_text'] = "Please Try Again";
		$data['title'] = "Edit User Details";
		$this -> load -> view("template", $data);
	}		

	function revelio()
	{
        $fname = $this -> input -> post("fName");
        $lname = $this -> input -> post("lName");
        $email = $this -> input -> post("email");
        $telephone = $this -> input -> post("tPhone");
		$deptID = $this -> input -> post("deptID");
		$accStatus = $this -> input -> post("status");
        $dbid = $this -> input -> post("dbid");
		
		$checkbox=$this->input->post('userType');		
		$user_type= $this->getUserType($checkbox);


        $user_update = array(
         'fname' => $fname,
         'lname' => $lname,
         'email' => $email,
         'telephone' => $telephone,
         'department_id' => $deptID,
		 'user_type' => $user_type,
		 'acc_status'=> $accStatus,
        );

		echo var_dump($user_update);
	}
	 function user_edit(){
 		if ($this->_edit_validate() === FALSE)
		{
			$this->edit_user_validate();
			return;
		}
		else
		{
        $fname = $this -> input -> post("fName");
        $lname = $this -> input -> post("lName");
        $email = $this -> input -> post("email");
        $telephone = $this -> input -> post("tPhone");
		$deptID = $this -> input -> post("deptID");
		$accStatus = $this -> input -> post("status");
        $dbid = $this -> input -> post("dbid");
		
		$checkbox=$this->input->post('userType');		
		$user_type= $this->getUserType($checkbox);
		$edit_status = "1";
		$comment = $this -> input -> post("comment");

        $user_update = array(
         'fname' => $fname,
         'lname' => $lname,
         'email' => $email,
         'telephone' => $telephone,
         'department_id' => $deptID,
		 'user_type' => $user_type,
		 'acc_status'=> $accStatus,
		 'edit_status' => $edit_status,
		 'comment' => $comment
        );

        $this -> db -> where('id', $dbid);
        $this -> db -> update('user', $user_update );
		}
?>
		<script type="text/javascript">

			function close(){
	 		parent.$.fancybox.close();
		}

		</script>		
<?php		

		echo '<body onload="close()"></body>';

    }

    function usernameCheckAvailability(){
    		$username = $this->uri->segment(3);
    		$namecount = User::getNameCount($username);	
 	
    		if($namecount[0]['count'] == 1 ){
    			echo json_encode(array('status'=>'Unavailable',
    					'message'=>'Username Exists'));
    		}
    		else{
    			echo json_encode(array('status'=>'Available'));
    	}
    }
	
	function user_delete($dbid){
        $this -> db -> where('id', $dbid);
        $this -> db -> delete('user');
			}
	
	function show($password){
		echo $salt = md5('#*seCrEt!@-*%'.$password);
		}
		
	function user_deactivate($dbid){
		$account_status = 0;
		$this -> db -> where('id', $dbid);
        
		$user_update = array(
         'acc_status' => $account_status
        );
	
        $this -> db -> update('user', $user_update );
	}

		
		

    public function base_params($data) {
		$data['title'] = "Upload File Links";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "uniformity";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}

}
