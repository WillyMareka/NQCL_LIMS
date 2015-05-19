<?php
class Tests_charges extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('charge', 'int', 11);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('tests_charges');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests_charges");
		$methodData = $query -> execute();
		return $methodData;
	}//end getAll

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests_charges");
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

	public function getTestCharge($test_id) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("tests_charges")
		-> where("test_id = ?", $test_id);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

}//end class
