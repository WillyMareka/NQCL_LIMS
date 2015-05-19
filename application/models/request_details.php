<?php

class Request_details extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 20);
		$this -> hasColumn('test_id', 'int', 11);
		/*$this -> hasColumn('version_id', 'int', 11);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('multicomponent', 'tinyint', 1);
		$this -> hasColumn('multistage', 'tinyint', 1);
		$this -> hasColumn('components_no', 'int', 11);
		$this -> hasColumn('components_no_uow', 'int', 11);
		$this -> hasColumn('stages_no', 'int', 11);
		$this -> hasColumn('batch_system', 'tinyint', 1);
		$this -> hasColumn('single_system', 'tinyint', 1);
		$this -> hasColumn('elements_no', 'int', 11);
		$this -> hasColumn('charges', 'int', 11);*/
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('request_details');
		$this -> hasMany('Tests',
		array(
		'local' => 'test_id',
		'foreign' => 'id'
		));

		$this -> hasMany('Request_components',
		array(
		'local' => 'request_id',
		'foreign' => 'request_id'
		));

		$this -> hasOne('Request_details',array(
			'local' => 'request_id',
			'foreign' => 'request_id'			
		));
		$this -> hasOne('Request',array(
			'local' => 'request_id',
			'foreign' => 'request_id'			
		));
	}//end setUp

		
	public static function getTestHistory($reqid){
  	
		$query=Doctrine_Query::create()
		-> select("t.name")
		->from("tests t, request_details r")
		-> where('r.request_id = ?', $reqid)
		//-> andWhere('r.version_id = ?', $version_id)
		-> andWhere('r.test_id = t.id')
		-> orderBy('id DESC');
		$testData=$query->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}	




	public static function get_value2($reqid){
  	
		$query=Doctrine_Query::create()-> select("*")->from("request_details")-> where("request_id = '$reqid'");
		$testData=$query->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}
	
	
	public function getTests2($reqid){
		$query = Doctrine_Query::create()
		-> select("test_id")
		-> from("request_details")
		-> where("request_id = ?" , $reqid);
		//-> where('request_id = ?', $reqid);
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}
	
	
	public function getTests($reqid) {
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("request_details")
		-> where("request_details.request_id = ?", $reqid);
		//-> andwhere("tests.id = request_details.test_id")
		$testData = $query -> execute() -> toArray();
		return $testData;
	}

	public function getTestIds($reqid){
		$query = Doctrine_Query::create()
		-> select("test_id")
		-> from("request_details")
		-> where("request_id = ?", $reqid);
		$testIdData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testIdData;
	
	}



	public function getTestsNames($reqid){
		$query = Doctrine_Query::create()
		-> select("alias, Name, Test_type")
		-> from("tests, request_details")
		-> where('request_details.request_id =?', $reqid)
		-> andWhere('tests.id = request_details.test_id')
		//-> where("request_details.version_id IN (select max(request_details.version_id) from request_details where request_details.request_id = '$reqid')")
		//-> andWhere('tests.id = request_details.test_id')
		;
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}
	
	
	/*public function getTestSplit($reqid){
		$query = Doctrine_Query::create()
		-> select("Department as dept")
		-> from("tests, request_details")
		//-> where("request_details.version_id IN (select max(request_details.version_id) from request_details where request_details.request_id = '$reqid')")
		-> where('tests.id = request_details.test_id');
		//-> groupBy('Department');
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}*/


	public function getTestSplit($reqid){
		$query = Doctrine_Query::create()
		-> select("r.id, t.Department, u.name")
		-> from("request_details r")
		-> leftJoin("r.Tests t")
		-> leftJoin("t.Units u")
		//-> where("request_details.version_id IN (select max(request_details.version_id) from request_details where request_details.request_id = '$reqid')")
		-> where('t.id = r.test_id')
		-> andWhere('r.request_id =?', $reqid)
		-> groupBy('t.Department');
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}
	
	public function testsCount($reqid) {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('request_details')
		-> where('request_id = ?', $reqid);
		$testCount = $query -> execute();
		return $testCount;
	}

}
?>