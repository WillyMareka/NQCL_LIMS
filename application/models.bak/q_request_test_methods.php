<?php

class Q_request_test_methods extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('client_number', 'varchar', 30);
		//$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('test_id', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('q_request_test_methods');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("q_request_test_methods");
		$methodData = $query -> execute();
		return $methodData;
	}//end getAll

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") -> from("q_request_test_methods");
		$methodData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $methodData;
	}

	public function getMethods2($reqid) {
		$query = Doctrine_Query::create() -> select("name, test_id, [tests.name]") 
		-> from("test_methods, q_request_test_methods, tests")
		-> where("q_request_test_methods.client_number = ?", $reqid)
		-> andWhere("test_methods.id = q_request_test_methods.method_id")
		-> andWhere("tests.id = q_request_test_methods.test_id");
		$methodData = $query -> execute()->toArray();
		return $methodData;
	}

	public function getMethods($reqid){
		$query = Doctrine_Query::create() -> select("method_id")
		-> from("q_request_test_methods")
		-> where("client_number =?", $reqid)
		-> andWhere("test_id=?", $tid);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

}//end class
