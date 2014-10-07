<?php

class Chromatographic_conditions extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('column_id', 'int', 11);
		$this -> hasColumn('column_temp', 'int', 11);
		$this -> hasColumn('detection', 'int', 11);
		$this -> hasColumn('injection', 'int', 11);
		$this -> hasColumn('flow_rate', 'int', 11);
		$this -> hasColumn('pump_pressure', 'int', 11);
		$this -> hasColumn('mobile_phase', 'varchar', 50);

	}

	public function setUp() {
		$this -> setTableName('chromatographic_conditions');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("chromatographic_conditions");
		$coaData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $coaData;
	}


}
?>