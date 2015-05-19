<?php
class Request_test_methods extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('test_id', 'int', 11);
		/*$this -> hasColumn('multicomponent', 'tinyint', 1);
		$this -> hasColumn('multistage', 'tinyint', 1);
		$this -> hasColumn('components_no', 'int', 11);
		$this -> hasColumn('stages_no', 'int', 11);
		$this -> hasColumn('analysis_type', 'int', 11);
		$this -> hasColumn('combi_no', 'int', 11);*/
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('request_test_methods');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("request_test_methods");
		$methodData = $query -> execute();
		return $methodData;
	}//end getAll

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") -> from("request_test_methods");
		$methodData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $methodData;
	}

	public function getMethods2($reqid) {
		$query = Doctrine_Query::create() -> select("name, test_id, [tests.name]") 
		-> from("test_methods, request_test_methods, tests")
		-> where("request_test_methods.request_id = ?", $reqid)
		-> andWhere("test_methods.id = request_test_methods.method_id")
		-> andWhere("tests.id = request_test_methods.test_id");
		$methodData = $query -> execute()->toArray();
		return $methodData;
	}

	public function getMethods($reqid, $tid){
		$query = Doctrine_Query::create() -> select("*")
		-> from("request_test_methods")
		-> where("request_id =?", $reqid)
		-> andWhere("test_id =?", $tid);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

}//end class
