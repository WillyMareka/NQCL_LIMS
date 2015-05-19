<?php

class Column_issue extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('analyst_id', 'int', 11);
		$this -> hasColumn('column_id', 'int', 11);
		$this -> hasColumn('issue_date', 'date');
	}

	public function setUp() {
		$this -> setTableName('column_issue');

		$this -> hasMany('columns', array(
			'local' => 'column_id',
			'foreign' => 'column_id'
		));

		$this -> hasOne('user', array(
			'local' => 'analyst_id',
			'foreign' => 'id'
		));


	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("column_issue");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

	public function getIssued($cid) {
		$query = Doctrine_Query::create() -> select("*") -> from("column_issue")
		-> where("column_id = ?", $cid);
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll
}
?>