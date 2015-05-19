<?php

class Q_analysis_type extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('analysis_type', 'int', 11);
		$this -> hasColumn('client_number', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('q_analysis_type');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("columns");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

	public function getType($reqid, $mid) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("q_analysis_type")
		-> where("client_number =?", $reqid)
		-> andWhere("method_id=?", $mid);
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

}
?>