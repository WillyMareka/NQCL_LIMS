<?php
error_reporting(1);
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_Management extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	public function index() {
		$data['content_view'] = 'login_v';
		$this->load->view('template1', $data);
	}

	public function login() {
               //$this->keepLogoutLog();
		$data = array();
		$data['title'] = "System Login";
		$data['content_view'] = "login_v";
		$this -> load -> view("template1", $data);
	}

	public function logout() {
               //$this->keepLogoutLog();
		//$this -> session -> destroy();
		$this -> session -> sess_destroy();
		$data = array();
		$data['title'] = "System Login";
		$data['content_view'] = "login_v";

		$this -> load -> view("template1", $data);
	}

public function test_submit(){
	$username = $this -> uri -> segment(3);
	$usertype = $this -> uri -> segment(4);
	$password = $this -> uri -> segment(5);
	$reply=User::alt_login($username, $usertype);
	//var_dump($reply);
	echo $reply[0]['email'];
}


public function submit() {
		$username=$_POST['username'];
		$usertype = $_POST['usertype'];
		$password=$_POST['password'];
		
		$myvalue = $usertype;
		$userdata = Current_User::alt_login($username,$password,$usertype);
		
		if($userdata == '1'){
		
		if($myvalue == 1){
			
			redirect("analyst_controller");
		}
		
		
	}else{
		echo '0';

		$this -> index();	
	}
		/*$myvalue = $usertype;
		$userdata = Current_User::alt_login($username,$password,$usertype);
		if($userdata == '1'){

			if($myvalue == 4 || $myvalue == 5){	
		
		redirect("home_controller");
		}
		
		else if($myvalue == 1){
			
			redirect("analyst_controller");
		}
		else if ($myvalue == 3){
			redirect("inventory");
		}
                  else if ($myvalue == 7){
			redirect("documentation/home/");
		}
                else if ($myvalue == 3){
			redirect("reviewer");
		}
		else if ($myvalue == 2){
				redirect("supervisors");
		
		}
		
		 else if ($myvalue == 4){
			redirect("directors");
		}
                 else if ($myvalue == 4){
			redirect("directors/superDirector");
		}
        
		else if ($myvalue == 9){
			redirect("inventory/refSubslist");
		}
		
		else if ($myvalue == 10){
			redirect("inventory/equipmentlist");
		}
		else if ($myvalue == 11){
			redirect("inventory/columnslist");
		}
		else if ($myvalue == 12){
			redirect("inventory/reagentslist");
		}

		}
		else{
			//$this -> index();
		}
			
			/*if ($this->_submit_validate() === FALSE) {
				$this->index();
				return;
			}*/
		//$reply=User::alt_login($username, $usertype);
		//var_dump($reply);	
		//$n=$reply->toArray();
		//echo($n['username']);

		//$myvalue=$usertype;
		//$namer=$n['fname'];
		//$id_d=$n['id'];
		//$inames=$n['lname'];
		//$disto=$n['district'];
		//$faci=$n['facility'];
	    //$user_id=$n['id'];	
        //$user_message=$n['pm_count'];
            
            $this->keepLog();
            
          
		
		
		
		
		 
   
}


		function usernameCheckAvailability(){
			$username = $this -> uri -> segment(3);
			$username_count = Users_types::getUsernameCount($username);
			if($username_count[0]['count'] < 1 ){
    			echo json_encode(array('status'=>'non-existent',
    					'message'=>'User does not exist.'));
    		}
    		else{
    			
    			echo json_encode(array('status'=>'existent',
    				'message' => 'Please choose Domain.'));
    		}
		}


		function getUserTypes(){
			$username = $this -> uri -> segment(3);
			$usertypes = Users_types::getUserTypes($username);
			echo json_encode($usertypes);
		}



        function keepLog() 
		{
        	$user_id = $this->session->userdata('user_id');
	        $names = $this->getUsersInfo();
    	    $name = $names[0]->fname . " " . $names[0]->lname;
        	$date_time = date("d-m-Y H:i:s");
        
	        $details = array(
    	        'user_id'=>$user_id,
        	    'name' => $name,
            	'login_time' => $date_time,
	            'did' => 'Logged In'
 			    );
			
			$this->db->insert('user_log_table', $details);
			$messages=  $this->checkForMessages();

			foreach ($messages as $message)
			{
	        $this->session->set_userdata('messages',$message->pm_count);
    	    }
    	}

    function keepLogoutLog(){
       $user_id = $this->session->userdata('user_id');
        $names = $this->getUsersInfo();
        $name = $names[0]->fname . " " . $names[0]->lname;
        $date_time = date("d-m-Y H:i:s");
        
        $details = array(
            'user_id'=>$user_id,
            'name' => $name,
            'login_time' => $date_time,
            'did' => 'Logged Out'
        );
        $this->db->insert('user_log_table', $details);
    }


    public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function checkForMessages(){
        $user_id=  $this->session->userdata('user_id');
        $this->db->select('pm_count');
        $this->db->where('id',$user_id);
        $query=  $this->db->get('user');
       return  $result=$query->result();
       // print_r($result);
    }


	private function _submit_validate() {
		
		$this->form_validation->set_rules('username', 'Username', 
			'trim|required|callback_authenticate');

		$this->form_validation->set_rules('usertype', 'Usertype', 
			'trim|required|callback_authenticate');
		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required');
	
		$this->form_validation->set_message('authenticate','Invalid login. Please try again.');
	
		return $this->form_validation->run();

	}

	public function pwd_fancybox(){
		$data['save_url'] =$this->router->fetch_class();
		$data['formname'] = 'changepwd';
		$data['content_view'] = 'pwd_fancybox';
		$this -> load -> view('template1', $data);
	}

	public function changePwd(){
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
                	'views' => $this -> session -> userdata('user_views'),
                	'utype' => $this -> session -> userdata('usertype_id')
            ));
           }
		$email = $this -> uri -> segment(3);
		$updated_pwd = $this -> input -> post('pwd2', TRUE);
		$pwdarray = array('password' => md5('#*seCrEt!@-*%'.$updated_pwd), 'status' => '1');
		$this -> db -> where('email', $email);
		$this -> db -> update('users_types', $pwdarray);

	}
	
	public function test_login(){
		$uname = $this -> input -> post('username');
		$pword = $this -> input -> post('password');
		$utype = $this -> input -> post('usertype');
		$auth_count = Users_types::alt_login($uname,$pword,$utype);
		$userdata = User::getUserData($uname, $utype);
		$userviews = Users_types::getUserTypes($uname);
		$acc_status = $userdata[0]['acc_status'];

		if($auth_count == '1' && $acc_status == '1' ){
			
			echo json_encode(array(
				'status' => 'success',
				'message'=> 'Login Successful',
				'utype'  => $utype,
				'pwd_status' => $userdata[0]['Users_types'][0]['status'],
                                
			));

			$custom_session_data = array('username' => $userdata[0]['username'],
			'usertype_id' => $userdata[0]['Users_types'][0]['usertype_id'],
			'usertype_name' => $userdata[0]['Users_types'][0]['User_type'][0]['name'],
			'user_dept'=> $userdata[0]['Departments']['Name'],
			'user_id' =>  $userdata[0]['id'],
			'user_views' => $userviews);
			$this -> session -> set_userdata($custom_session_data);
				/*if($utype == 1 ){
					redirect('analyst_controller', 'location');
				}
				else{
					redirect('home_controller');
				}*/
		}
		else if($auth_count == '0' && $acc_status == '0'){
			echo json_encode(array(
				'status' => 'wrong_pwd_usrnm',
				'message'=> 'Wrong username/password combination.'
			));		
		}
		else if($auth_count == '0' && $acc_status == '1'){
			echo json_encode(array(
				'status' => 'wrong_pwd_usrnm',
				'message'=> 'Wrong username/password combination.'
			));		
		}
		else if($auth_count == '1' && $acc_status == '0'){
			echo json_encode(array(
				'status' => 'acc_deactivated',
				'message'=> 'Account Deactivated.Contact Admin.'
			));
		}
	}


	public function authenticate() {
		
	 return Current_User::alt_login($this->input->post('username'), 
									$this->input->post('password'),	
									$this->input->post('usertype'));
		
	}
		

	public function go_home($data) {
		$data['title'] = "System Home";
		$data['content_view'] = "home_v";
		$data['banner_text'] = "Dashboards";
		$data['link'] = "home";
		$this -> load -> view("template", $data);
	}
		
	
}
