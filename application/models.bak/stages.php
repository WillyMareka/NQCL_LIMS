<?php

class Stages extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('stages_no', 'int', 11);
		$this -> hasColumn('stage_status', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('stages');
	}//end setUp

	/*public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("columns");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

	public function getType($reqid, $mid) {
		$query = Doctrine_Query::create() -> select("*")
		-> from("analysis_type")
		-> where("request_id =?", $reqid)
		-> andWhere("method_id=?", $mid);
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll
	*/
}










?>