<?php

class Analysis_type extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('analysis_type', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('analysis_type');
	}//end setUp

	public function getAll() {
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

}
?>