<?php

class Q_request_details extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('quotations_id', 'varchar', 30);
		$this -> hasColumn('client_email', 'varchar', 30);
		$this -> hasColumn('client_number', 'varchar', 35);
		$this -> hasColumn('test_charge', 'int', 11);
		$this -> hasColumn('method_charge', 'int', 11);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('method_id', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('q_request_details');
		$this -> hasMany('Tests',
		array(
		'local' => 'test_id',
		'foreign' => 'id'
		));

		$this -> hasMany('tests',array(
			'local' => 'test_id',
			'foreign' => 'id'			
		));
		
		$this -> hasMany('test_methods',array(
			'local' => 'method_id',
			'foreign' => 'id'			
		));

		$this -> hasOne('clients',array(
			'local' => 'client_id',
			'foreign' => 'id'			
		));

		$this -> hasMany('Quotations',
		array(
			'local' => 'quotations_id',
			'foreign' => 'quotations_id'
		));
	}//end setUp

	public function getTestsNames($reqid){
		$query = Doctrine_Query::create()
		-> select("alias, Test_type")
		-> from("tests, q_request_details")
		-> where('q_request_details.client_number =?', $reqid)
		-> andWhere('tests.id = q_request_details.test_id');
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}

	public function getTests2($reqid){
		$query = Doctrine_Query::create()
		-> select("test_id")
		-> from("q_request_details")
		-> where("quotations_id = ?" , $reqid);
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}

	public function getChargesPerClient($rid){
		$query = Doctrine_Query::create()
		-> select("q.*, t.*, m.*")
		-> from("q_request_details q")
		-> leftJoin("q.tests t")
		-> leftJoin("q.test_methods m")
		-> where("q.quotations_id =?", $rid);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}

	public function getTotal($rid){
		$query = Doctrine_Query::create()
		-> select('c.*, m.*, t.*, sum(c.test_charge + c.method_charge)')
		-> from("q_request_details c")
		-> where("c.quotations_id =?", $rid)
		-> leftJoin("c.tests t")
		-> leftJoin("c.test_methods m");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}

}
?>