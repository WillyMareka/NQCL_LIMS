<?php

class Tests extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('Name', 'varchar', 35);
		$this -> hasColumn('Department', 'varchar', 25);
		$this -> hasColumn('Alias', 'varchar', 25);
		$this -> hasColumn('Test_type', 'int', 11);
		$this -> hasColumn('Charge', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('tests');
		$this -> hasOne('Request_details',
		array(
		'local'=>'id',
		'foreign' => 'test_id'
		));
		$this -> hasMany('client_billing',
			array(
				'local'=> 'id',
				'foreign' => 'test_id'
		));
		$this -> hasMany('Sample_issuance',array(
			'local' => 'id',
			'foreign' => 'Test_id'			
		));
		$this -> hasOne('Units',
			array(
			'local' => 'Department',
			'foreign' => 'dept_id'	
		));
		$this -> hasMany('Test_methods', array(
			'local' => 'id',
			'foreign' => 'test_id'
		));
		$this -> hasOne('Q_request_details',
		array(
		'local'=>'id',
		'foreign' => 'test_id'
		));

	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests");
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getWetChemistry() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 1');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getMicrobiologicalAnalysis() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 2');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getMedicalDevices() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 3');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("Name,Charge") -> from("tests");
		$testData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData;
	}
	
	public static function getTestName($reqid, $dept_id){
		$query=Doctrine_Query::create()
		->select("t.Name, t.Department, t.Id" )
		->from("Tests t, Request_details r")
		->where('r.Request_id = ?', $reqid)
		->andWhere('t.Department = ?', $dept_id)
		->andWhere("r.test_id = t.id");
		$testData=$query->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}

	
	public static function getTestName3($test_id) {
		
		$query = Doctrine_Query::create()
		->select('t.Name' )
		->from('Tests t')
		->where('t.id = ?', $test_id);
		
		$testNamesData = $query->execute() -> toArray();
		return $testNamesData;
	}

	public static function getTestNames($user_id){
		
		$query = Doctrine_Query::create()
		->select('t.Name, t.Department, t.Id')
		->from('Tests t, Sample_issuance s')
		->where('s.Analyst_id = ?', $user_id)
		->andWhere('t.Id = s.Test_id');
		
		$testNamesData = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testNamesData;
		
	}

	public static function getTestsByDept($reqid, $unit_id){
		$query = Doctrine_Query::create()
		->select('t.Name, t.Department, t.id, r.request_id')
		->from('Tests t')
		->leftJoin('t.Request_details r')
		->where('r.request_id = ?', $reqid)
		->andWhere('t.Department = ?', $unit_id);
		$testData2 = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData2;
	}

	public static function getAllTests($reqid){
		$query = Doctrine_Query::create()
		->select('t.Name, t.Department, t.id, r.request_id')
		->from('Tests t')
		->leftJoin('t.Request_details r')
		->where('r.request_id = ?', $reqid);
		$testData2 = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData2;
	}




	public static function getWorksheet($test_id){
		
		$query = Doctrine_Query::create()
		->select('alias')
		->from('tests')
		->where('id = ?', $test_id);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
	}

	public static function getWetchem() {
		
		$query = Doctrine_Query::create()
		->select('id')
		->from('tests')
		->where('department = ?', 1);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
		
	}

	public static function getMedevices() {
		
		$query = Doctrine_Query::create()
		->select('id')
		->from('tests')
		->where('department = ?', 3);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
		
	}

	public static function getBiological() {
		
		$query = Doctrine_Query::create()
		->select('id')
		->from('tests')
		->where('department = ?', 2);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
		
	}
	
	public static function getUnit($reqid){
		$query =  Doctrine_Query::create()
		->select('Department')
		->from('Tests, Request_details')
		
		->Where('request_id = ?', $reqid)
		->andWhere('id = test_id')
		->groupBy('Department');
		$unitdata = $query -> execute()->toArray();
		return $unitdata;
		
	}

	public static function getUnit3($reqid){
		$query = Doctrine_Query::create()
		->select('t.id, u.*')
		->from('tests t')
		->leftJoin('t.Units u')
		->where("u.id < 3")
		//->leftJoin('t.Request_details r')
		//->where('t.Department = u.id')
		//->andWhere('r.request_id = ?', $reqid)
		->groupBy('u.id');
		$unitData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $unitData;
	}



	public static function getUnit2($reqid){
		$query =  Doctrine_Query::create()
		->select('Department')
		->from('Tests, Request_details')
		//-> where("request_details.version_id IN (select max(request_details.version_id) from request_details where request_details.request_id = '$reqid')")
		->where('Tests.id = Request_details.test_id')
		->groupBy('Department');
		$unitdata = $query -> execute()->toArray();
		return $unitdata;
		
	}

	public function getCharges($test_id) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("tests")
		-> where("id = ?", $test_id);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}

	public function getDepartments($test_id){
		$query = Doctrine_Query::create() -> select("Department")
		-> from("tests")
		-> where("id = ?", $test_id);
		$deptData = $query -> execute() -> toArray();
		return $deptData;
	}

	public function getTestsPerRequest1($reqid){
		$query = Doctrine_Query::create() 
		-> select("t.*, m.*, c.*, r.id")
		-> from("tests t")
		-> leftJoin("t.Test_methods m")
		-> leftJoin("t.Request_details r")
		-> where("r.request_id = ?", $reqid);
		$deptData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $deptData;
	}

	public function getTestsPer($reqid, $test_details, $ref){
		$leftjoin = "t.".ucfirst($test_details)." r";
		$query = Doctrine_Query::create() 
		-> select("t.*, m.*, c.*, r.id")
		-> from("tests t")
		-> leftJoin("t.Test_methods m")
		-> leftJoin($leftjoin)
		-> where("r.$ref = ?", $reqid);
		$deptData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $deptData;
	}


}
?>