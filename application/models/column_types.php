<?php

class Column_types extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('column_type', 'varchar', 60);
		$this -> hasColumn('column_dimensions', 'varchar', 30);
		$this -> hasColumn('manufacturer', 'varchar', 30);
		$this -> hasColumn('quantity_received','int', 11);
		$this -> hasColumn('quantity_issued','int', 11);
		$this -> hasColumn('date_received', 'date');
		$this -> hasColumn('status', 'int', 11);
		$this -> hasColumn('comment', 'varchar', 255);
		$this -> hasColumn('edit_status', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('column_types');
		$this -> hasMany('columns', array(
			'local' => 'id',
			'foreign' => 'column_id'
			));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> 
		select("c.*, cs.*, u.fname, u.lname") ->
		from("column_types c") ->
		leftJoin("c.columns cs") ->
		leftJoin("cs.User u");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll

	public function getColumn($cid){
		$query = Doctrine_Query::create() ->
		select("*") ->
		from("column_types") ->
		where("id = ?", $cid);
		$columnData = $query -> execute() -> toArray();
		return $columnData;
	}

	public function getColumns($ref) {
		$no = str_replace('_', ' ',$ref);
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("column_types c")
		-> leftJoin("c.columns cs")
		-> where("cs.column_no=?", $no)
		-> andWhere("status =?", '1');
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}
}
?>