<?php

class Limits extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('limits', 'varchar', 200);
	}

	public function setUp() {
		$this -> setTableName('limits');	
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("limits");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll
	
	public function getLimit($request_id, $test_id) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("limits")
		-> where("request_id =?", $request_id)
		-> andWhere("test_id =?", $test_id);
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}
}
?>