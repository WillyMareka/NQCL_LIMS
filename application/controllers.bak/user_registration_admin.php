<?php

class User_registration_admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	public function index() {
		$data['title'] = "User Registration";
		$data['settings_view'] = "home_v";
		$data['content_view'] = "user_v_ajax_admin";
		$data['banner_text'] = "Add New User";
		$data['link'] = "home";
		$this -> load -> view("template", $data);
	}

	public function addUser() {
		$data['content_view'] = "signup_v_admin";
		$data['banner_text'] = "Sign Up";
		$data['title'] = "User Registration";
		$this -> load -> view("template", $data);
	}		
	
	public function submit()
	{
		
		if ($this->_submit_validate() === FALSE)
		{
			$this->addUser();
			return;
		}
		
		$fname=$this->input->post('fName');
		$lname=$this->input->post('lName');
		$email=$this->input->post('email');
		$username=$this->input->post('email');
		$password=$this->input->post('pWord');
		$tPhone=$this->input->post('tPhone');
		$department_id=$this->input->post('deptID');		

		$checkbox=$this->input->post('userType');		
		$user_type= $this->getUserType($checkbox);
							
		$this->registerClients($fname,$lname, $email, $username, $password, $tPhone, $user_type, $department_id);
		
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
	
	public function registerClients($fName, $lName, $email, $username, $pWord, $tPhone, $userType, $deptID)
	{
		$salt = md5('#*seCrEt!@-*%'.$pWord);
		
		$clients=array(
		'fname'=>$fName,
		'lname'=>$lName,
		'email'=>$email,
		'username'=>$username,
		'password'=>$salt,
		'telephone'=>$tPhone,
		'user_type'=>$userType,
		'department_id'=>$deptID		
		);
		
		$this->db->insert('user',$clients);
				 
		$data['title'] = "Registration Successful";
		$data['settings_view'] = "home_v";
		$data['content_view'] = "user_v_ajax_admin";
		$data['banner_text'] = "Thank You";
		$data['link'] = "home";
		$this -> load -> view("template", $data);
	}
	
	private function _submit_validate() 
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// validation rules
		
		$this->form_validation->set_rules('pWord', 'Password',
			'trim|required|min_length[3]|max_length[12]');
		
		$this->form_validation->set_rules('confPWord', 'Confirm Password',
			'trim|required|matches[pWord]');
				
		$this->form_validation->set_rules('fName', 'First Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('lName', 'Last Name', 
			'trim|required|alpha_numeric|min_length[3]');
		
		$this->form_validation->set_rules('email', 'E-mail',
			'trim|required|valid_email|unique[User.email]');
			
		$this->form_validation->set_rules('tPhone', 'Mobile Number', 
			'trim|required|numeric|min_length[10]');

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
			'trim|valid_email|unique[User.email]');
			
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
	   
	   $this->db->select('*');
	   $this->db->from('user');
	   $this->db->join('user_type', 'user_type.code = user.user_type');
	   $this->db->join('user_acc_status', 'user_acc_status.status = user.acc_status');
	   $this->db->join('departments', 'departments.dept_code = user.department_id');
	   $query= $this->db->get();
	   $result=$query->result();
	   
	   $array=array(
		   'aaData'=>$result
	   
	   );
	   
	   echo json_encode($array);
	}
	
	public function listing() {
		//$data = array();
		$data['settings_view'] = "user_v_ajax_admin";
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
  
  
	function edit_view() {
		
		$userid=$this->uri->segment(3);
		$data['r'] = $this->getUsername($userid);
		$data['content_view'] = "user_edit_v_admin";
		$this -> load -> view("template", $data);
		
	}

	function edit_user_validate() {
		$data['content_view'] = "user_edit_v_valid_admin";
		$data['banner_text'] = "Please Try Again";
		$data['title'] = "Edit User Details";
		$this -> load -> view("template", $data);
	}		
	   
	function emailCheckAvailability(){

		$username = $this->uri->segment(3);
    		$namecount = User::getMailCount($username);	
 	
    		if($namecount[0]['count'] == 1 ){
    			echo json_encode(array('status'=>'Unavailable',
    					'message'=>'Username Exists'));
    		}
    		else{
    			echo json_encode(array('status'=>'Available'));
    	}

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


        $user_update = array(
         'fname' => $fname,
         'lname' => $lname,
         'email' => $email,
         'telephone' => $telephone,
         'department_id' => $deptID,
		 'user_type' => $user_type,
		 'acc_status'=> $accStatus,
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
	
	function user_delete($dbid){
        $this -> db -> where('id', $dbid);
        $this -> db -> delete('user');
		
		}

	function user_password_reset($dbid){
		$password = '123456';
		$enc_password= md5('#*seCrEt!@-*%'.$password);
		$user_update = array(
         'password' => $enc_password,
        );

		$this -> db -> where('id', $dbid);	
        $this -> db -> update('user', $user_update );
	}

	function user_deactivate($dbid){
		$account_status = 0;
        $user_update = array(
         'acc_status' => $account_status,
        );

        $this -> db -> where('id', $dbid);
        $this -> db -> update('user', $user_update );
	}

	function show($password){
			
			
			echo $salt = md5('#*seCrEt!@-*%'.$password);
		}



}
?>