<?php

class Split extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'int', 11);
		$this -> hasColumn('dept', 'int', 11);
		$this -> hasColumn('status', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('split');
		$this -> hasOne('Request',array(
			'local' => 'request_id',
			'foreign' => 'request_id'			
		));
	}	 

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("split");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

	public function getSplit($rid) {
		$query = Doctrine_Query::create() -> select("*") -> from("split")
		-> where("request_id = ?", $rid);
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

	public function getUnassigned($rid) {
		$query = Doctrine_Query::create() -> select("dept") 
		-> from("split")
		-> where("request_id = ?", $rid)
		-> andWhere("status = ?", 0);
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

	public function getSplitInfo($lab_ref_no, $dept_id){
		$query = Doctrine_Query::create()
		-> select("status, dept")
		-> from("split")
		-> where("request_id = ?", $lab_ref_no)
		-> andWhere("NOT(dept = $dept_id)");
		$splitinfo = $query -> execute() -> toArray();
		return $splitinfo;
	}
}
?>