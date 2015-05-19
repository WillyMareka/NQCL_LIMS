<?php
class Current_User {
	
	private static $user;
	
	private function __construct() {}
	
	public static function user() {
				
		if(!isset(self::$user)) {
			
			$CI =& get_instance();
			$CI->load->library('session');
			
			if (!$user_id = $CI->session->userdata('user_id')) {
				return FALSE;
			}
			
			if (!$u = Doctrine::getTable('User')->find($user_id)) {
				return FALSE;
			}
			
			self::$user = $u;
		}
		
		return self::$user;
	}


	
	
	public static function logins($username, $password, $usertype) {
		
		// get User object by username 
		if ($u = Doctrine::getTable('Users_types')->findByDql('email where ?',$username, $usertype)) {
			
	
			// to ge the mutated version of the input password
			$u_input = new Users_types();
			$u_input->password = $password;
			
			// password match
			if ($u->password == $u_input->password && $u->status==1) {
				unset($u_input);
				
				$CI =& get_instance();
				$CI->load->library('session');
				$CI->session->set_userdata('user_id',$u->id);
                                //$CI->session->set_userdata('user_name',$u->username);
				self::$user = $u;
				
				return TRUE;
			}
			
			unset($u_input);
		}
		
		// login failed
		return FALSE;
		
	}



	public static function alternate_login($username, $usertype){
				


	}
		
	
	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
	
}
