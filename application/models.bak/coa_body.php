<?php

class Coa_body extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('labref', 'varchar', 20);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('compedia', 'varchar', 100);
		$this -> hasColumn('specification', 'varchar', 100);
		$this -> hasColumn('determined', 'text');
		$this -> hasColumn('method', 'varchar', 20);
		$this -> hasColumn('verdict', 'varchar', 100);
		$this -> hasColumn('conclusion', 'varchar', 70);
		$this -> hasColumn('complies', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('coa_body');

		$this -> hasOne('request', array(
			'local' => 'labref',
			'foreign' => 'request_id'
		));

		$this -> hasOne('Client_billing', array(
			'local' => 'labref',
			'foreign' => 'labref'
		));

	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("coa_body");
		$coaData = $query -> execute();
		return $coaData;
	}


}
?>