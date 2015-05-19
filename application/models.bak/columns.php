<?php

class Columns extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('column_id', 'int', 11);
		$this -> hasColumn('serial_no', 'varchar', 50);
		$this -> hasColumn('column_no', 'int', 11);
		$this -> hasColumn('column_status', 'varchar', 30);
		$this -> hasColumn('edit_status', 'int', 11);
		$this -> hasColumn('issuance_status', 'int', 11);
		$this -> hasColumn('comment', 'varchar', 255);
	}

	public function setUp() {
		$this -> setTableName('columns');
		$this -> hasOne('column_types', array(
			'local' => 'column_id',
			'foreign' => 'id'
		));
		$this -> hasOne('column_issue', array(
			'local' => 'column_id',
			'foreign' => 'column_id'
		));

	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> 
		select("c.*, ci.id, u.fname, u.lname, cs.*") ->
		from("columns cs") ->
		leftJoin("cs.column_types c")
		-> leftJoin("cs.column_issue ci")
		-> leftJoin("ci.user u");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll


	public function getColumns($ref) {
		$query = Doctrine_Query::create() 
		-> select("ci.id, u.fname, u.lname, cs.serial_no, cs.column_no, c.column_type, c.column_dimensions") 
		-> from("columns cs")
		-> leftJoin("cs.column_types c")
		-> leftJoin("cs.column_issue ci")
		-> leftJoin("ci.user u")
		-> where("cs.column_no=?", $ref)
		-> andWhere("cs.column_status =?", '1');
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

}
?>