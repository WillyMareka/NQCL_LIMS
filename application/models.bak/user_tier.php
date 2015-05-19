<?php
class User_tier extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('name', 'varchar', 30);
	}
	
	public function setUp() {
		$this->setTableName('user_tier');
		$this -> hasMany('User_type', array(
			'local'=> 'id',
			'foreign' => 'tier'
			));
	}

	public function getAll() {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('user_tier');
		$testData = $query -> execute();
		return $testData;
	}

	
}
