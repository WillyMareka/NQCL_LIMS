<?php

class Reagents_log extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('batch_no', 'int', 11);
		$this -> hasColumn('status', 'varchar', 30);
		$this -> hasColumn('quantity', 'int', 11);
		$this -> hasColumn('qunit','varchar', 15);
	}

	public function setUp() {
		$this -> setTableName('reagents_log');
		$this->actAs('Timestampable');

	}//end setUp


	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reagents");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

}
?>