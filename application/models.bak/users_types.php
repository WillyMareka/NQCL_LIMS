<?php
class Users_types extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('email', 'varchar', 30);
		$this->hasColumn('usertype_id', 'int', 11);
		$this->hasColumn('password', 'varchar', 100);
		$this->hasColumn('status', 'int', 11);
	}

	public function setUp() {
	
		$this->setTableName('users_types');
		$this -> hasOne('Users', array(
			'local'=> 'email',
			'foreign' => 'email'
			));
		$this -> hasMany('User_type', array(
			'local'=> 'usertype_id',
			'foreign' => 'id'
			));
	}

	public function getAll() {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('users_types');
		$testData = $query -> execute();
		return $testData;
	}

	protected function _encrypt_password($value) {
		$salt = '#*seCrEt!@-*%';
		$this->_set('password', $value);
	}

	public function getUsername() {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('users_types');
		$testData = $query -> execute();
		return $testData;
	}

	public function getUsernameCount($email){
		$query = Doctrine_Query::create()
		-> select('count(distinct(email))')
		-> from('users_types')
		-> where('email=?', $email);
		$countData = $query -> execute() -> toArray();
		return $countData;
	}

	public function alt_login($username, $password, $usertype){
			$query = Doctrine_Query::create()
				-> select('*')
				-> from('users_types')
				-> where('email =?', $username)
				-> andWhere('password =?', md5('#*seCrEt!@-*%'.$password))
				-> andWhere('usertype_id =?', $usertype);	
			$countData = $query -> execute() -> toArray();
			return count($countData);	
		}

	public function getUserTypes($email){
		$query = Doctrine_Query::create()
		-> select('u.*, t.*')
		-> from('users_types u')
		-> leftJoin('u.User_type t')
		-> where('u.email=?', $email);
		$countData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY) ;
		return $countData;
	}
	
}
