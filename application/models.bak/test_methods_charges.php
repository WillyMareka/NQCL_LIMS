<?php
class Test_methods_charges extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('charge', 'int', 11);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('test_methods_charges');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("test_methods_charges");
		$methodData = $query -> execute();
		return $methodData;
	}//end getAll

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") -> from("test_methods_charges");
		$methodData = $query -> execute();
		return $methodData;
	}

	public function getMethodCharge($method_id) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("test_methods_charges")
		-> where("method_id = ?", $method_id);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

}//end class
