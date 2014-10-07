<?php
class User_type extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('name', 'varchar', 20);
		$this->hasColumn('tier', 'int', 11);
		$this->hasColumn('view', 'int', 11);
		$this->hasColumn('dept_id', 'int', 11);
		$this->hasColumn('unit', 'int', 11);
	}
	
	public function setUp() {
		$this->setTableName('user_type');
		$this -> hasOne('User', array(
			'local'=> 'tier',
			'foreign' => 'tier'
			));
		$this -> hasOne('User_tier', array(
			'local'=> 'tier',
			'foreign' => 'id'
			));
		$this -> hasOne('Users_types', array(
			'local'=> 'id',
			'foreign' => 'usertype_id'
			));
	}


	public function getAll() {
		$query = Doctrine_Query::create()
		-> select('u.*, t.*, ut.*')
		-> from('user_type u')
		-> leftJoin('u.User_tier t')
		-> leftJoin('u.Users_types ut');
		$testData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData;
	}

	public function getRole($dept_id) {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('user_type')
		-> where('dept_id =?', $dept_id);
		$testData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData;
	}


	public function getDefaultView($user_type){
		$query = Doctrine_Query::create()
		-> select('view')
		-> from('user_type')
		-> where('id = ?', $user_type);
		$viewData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $viewData;
	}
	

	
}
?>
