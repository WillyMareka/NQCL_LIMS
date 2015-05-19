<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_Registration extends MY_Controller {
	function __construct() {
		parent::__construct();		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	public function index() {
		$data['content_view'] = "signup_v";
		$data['banner_text'] = "Sign Up";
		$this -> load -> view("template", $data);
	}

	public function users_edit(){
		$data['user_id'] = $this -> uri -> segment(3);
    	$data['content_view'] = "fancybox-users-edit";
    	$data['usertype'] = User_type::getAll();
    	$data['depts'] = Departments::getAll();
    	$data['user_data'] = User::getUserDetails($data['user_id']);
    	$data['formname'] = 'userdetails';
    	$data['save_url'] = $this->router->fetch_class();
    	$this -> load -> view ("template1", $data);
	}


	public function users_fancybox(){
    	$data['u_type'] = $this -> uri -> segment(3);
    	$data['content_view'] = "fancybox-users";
    	$data['usertype'] = User_type::getAll();
    	$data['depts'] = Departments::getAll();
    	$data['formname'] = 'userdetails';
    	$data['save_url'] = $this->router->fetch_class();
    	//$data['reagent'] = Reagents::getReagent($rid);
    	$this -> load -> view ("template1", $data);
    }
	
	public function getUnits(){
		$dept_id = $this -> uri -> segment(3);
		$units = Units::getUnit($dept_id);
		echo json_encode($units);
	}

	public function getRoles(){
		$dept_id = $this -> uri -> segment(3);
		$roles = User_type::getRole($dept_id);
		echo json_encode($roles);
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
        $title = $this->input->post('title');    
        $fname=$this->input->post('fName');
		$lname=$this->input->post('lName');
		$onames=$this->input->post('oNames');
		
		$email=$this->input->post('email');
		$db_email =$this->input -> post('db_email');
		
		$username=$this->input->post('email');
		$tPhone=$this->input->post('tPhone');
		$department_id=$this->input->post('deptID');		
		$dbid = $this -> input -> post("dbid");
		$user_type=$this->input->post('userType');
		$unit_id = $this->input->post('unit');
		$acc_status = $this -> input -> post('acc_status');
		$comment = $this -> input -> post('comment');
		$edit_status = "1";
		
		$user_update_array = array(
			'title' => $title,
			'other_names' => $onames,
			'fname' => $fname,
			'lname' => $lname,
			'username' => $email,
			'email' => $email,
			'telephone' => $tPhone,
			'acc_status' => $acc_status,
			'comment' => $comment,
			'department_id' => $department_id,
			'unit_id' => $unit_id,
			'edit_status' => $edit_status,
			'comment' => $comment
		);

		//$users_types_update_array(array())

		$this -> db -> where(array('id' => $dbid));
        $this -> db -> update('user', $user_update_array);    

        if(!empty($user_type)){
	        $users_types_delete_array = array('email' => $db_email);
	        $this -> db -> delete('users_types', $users_types_delete_array);

	        for($i =0;$i < count($user_type);$i++){
	        	$pWord = '123456'. $i;
	        	$utype = new Users_types();
	        	$utype -> email = $email;
	        	$utype -> usertype_id = $user_type[$i];
	        	$utype -> password = md5('#*seCrEt!@-*%'.$pWord);
	        	$utype -> status = '0';
	        	$utype -> save();
	        }
     }   

	}


	public function deactivate_user(){
		$user_id = $this -> uri -> segment(3);
		$user_update = array(
         'acc_status' => '0',
        );
		$this -> db -> where('id', $user_id);	
        $this -> db -> update('user', $user_update);
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
                	'message'=> 'Data added successfully'
            ));
            }
        $title = $this->input->post('title');    
		$fname=$this->input->post('fName');
		$lname=$this->input->post('lName');
		$onames = $this->input->post('oNames');
		$email=$this->input->post('email');
		$username=$this->input->post('email');
		$tPhone=$this->input->post('tPhone');
		$department_id=$this->input->post('deptID');		
		$user_type=$this->input->post('userType');
		$unit_id = $this->input->post('unit');
		
				
		$this->registerClients($title,$fname,$lname,$onames,$email, $username, $tPhone, $user_type, $department_id, $unit_id);
		
	}


    public function registerClients($title,$fName, $lName, $onames, $email, $uName, $tPhone, $userType, $deptID, $unit_id)
	{

		$user_details=array(
		'title'=>$title,	
		'fname'=>$fName,
		'lname'=>$lName,
		'other_names'=>$onames,
		'email'=>$email,
		'username'=>$uName,
		'telephone'=>$tPhone,
		'department_id'=>$deptID,
		'unit_id' => $unit_id		
		);
		
		$this->db->insert('user',$user_details);
		
		for($i=0;$i<count($userType);$i++){
			$pWord = '123456'. $i;
      		$saltedPword = md5('#*seCrEt!@-*%'.$pWord);
			$usertype_details = array(
					'email' => $email,
					'usertype_id' => $userType[$i],
					'password' => $saltedPword
				);

			$this -> db -> insert('users_types', $usertype_details);		
		}	 

	}

	
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

	public function submit(){
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		$email=$this->input->post('email');
		$name1=$this->input->post('fname');
		$name2=$this->input->post('lname');
		$password=$this->input->post('password');
		$username=$this->input->post('username');
		
		$u = new User();
		$u->fname=$this->input->post('fname');
		$u->lname=$this->input->post('lname');
		$u->email = $this->input->post('email');
		$u->username = $this->input->post('username');
		$u->password = $this->input->post('password');
		$u->usertype_id = $this->input->post('type');
		$u->telephone = $this->input->post('tell');
		$u->district = $this->input->post('district');
		$u->facility = $this->input->post('facility');
		$u->save();
		
		$fromm='hcmpkenya@gmail.com';
		$messages='Hallo '.$name1.', You have been Registered as a user for the Health Commodities Management Platform System. Your username is '.$username.' and your password is '.$password.' . Please change your password when you login into the system. 
		
		Thank you';
	
  		$config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'hcmpkenya@gmail.com', // change it to yours
  'smtp_pass' => 'healthkenya', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
); 
		
        //$this->email->initialize($config);
		$this->load->library('email', $config);
 
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'Health Commodities Management Platform'); // change it to yours
  		$this->email->to($email); // change it to yours
  		$this->email->cc('kariukijackson@gmail.com,kelvinmwas@gmail.com,nicomaingi@gmail.com,jsphmk14@gmail.com');
  		$this->email->subject('User Registration :'.$name1.' '.$name2);
 		$this->email->message($messages);
 
  if($this->email->send())
 {

 }
 else
{
 show_error($this->email->print_debugger());
}

		$data['content_view'] = "moh/signup_v";
		$data['title'] = "User Registration";
		$data['banner_text'] = "Sign Up";
		$this -> load -> view("template", $data);
	}
	private function _submit_validate() {
		
		// validation rules
		$this->form_validation->set_rules('fname', 'First Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('lname', 'Last Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('username', 'Username', 
			'trim|required|alpha_numeric|min_length[3]|max_length[12]|unique[User.username]');
		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|min_length[3]|max_length[12]');
		
		$this->form_validation->set_rules('passconf', 'Confirm Password',
			'trim|required|matches[password]');
		
		$this->form_validation->set_rules('email', 'E-mail',
			'trim|required|valid_email|unique[User.email]');
			
			$this->form_validation->set_rules('tell', 'Mobile Number', 
			'trim|required|numeric|min_length[10]');
		
		return $this->form_validation->run();
		
	}
}