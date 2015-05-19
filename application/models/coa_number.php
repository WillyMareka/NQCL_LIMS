<?php

class Coa_number extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('number', 'int', 11);
		$this -> hasColumn('full_number', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('coa_number');

		$this -> hasOne('dispatch_register', array(
			'local' => 'request_id',
			'foreign' => 'request_id'
		));

		$this -> hasOne('request', array(
			'local' => 'request_id',
			'foreign' => 'request_id'
		));

	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("coa_body");
		$coaData = $query -> execute();
		return $coaData;
	}

	public function getCoaNo($reqid){
		$query =  Doctrine_Query::create()
		-> select('full_number, number')
		-> from('coa_number')
		-> where('request_id =?', $reqid);
		$coaNoData = $query -> execute();
		return $coaNoData;
	}


}
?>