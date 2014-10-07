<?php
class Test_methods extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('charge', 'int', 11);
		$this -> hasColumn('alias', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('test_methods');
		$this -> hasOne('Tests',
		array(
		'local'=> 'test_id',
		'foreign' => 'id'
		));

		$this -> hasMany('client_billing',
			array(
				'local'=> 'id',
				'foreign' => 'method_id'
		));

		$this -> hasMany('q_request_details',
			array(
				'local'=> 'id',
				'foreign' => 'method_id'
		));
	}//end setUp

	public function getMethods($testid){
	$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("test_methods")
		-> where("test_id = ?", $testid);
		$methodData = $query -> execute();
		return $methodData;	
	}


	public function getMethodsHydrated($testid){
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("test_methods")
		-> where("test_id = ?", $testid);
		$methodData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $methodData;	
	}

	public function getCharges($method_id, $tid) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("test_methods")
		-> where("id = ?", $method_id)
		-> andWhere("test_id = ?", $tid);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

	public function getMethodDetails($method_id) {
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("test_methods")
		-> where("id = ?", $method_id);
		$methodData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY); 
		return $methodData;
	}

		public function getCharges2($test_id) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("test_methods")
		-> where("test_id = ?", $test_id);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

	public function getMethodChargeHydrated($method_name, $test_id){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("test_methods")
		-> where("name =?", $method_name)
		-> andWhere("test_id =?", $test_id);
		$chargesData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $chargesData;
	}

}
?>