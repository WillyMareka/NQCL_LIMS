<?php

class Columns_log extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('columns_log_id', 'int', 11);
		$this -> hasColumn('old_columns_log_column_no', 'int', 11);
		$this -> hasColumn('new_columns_log_column_no', 'int', 11);
		$this -> hasColumn('old_columns_log_serial_no', 'varchar', 30);
		$this -> hasColumn('new_columns_log_serial_no', 'varchar', 30);
		$this -> hasColumn('old_columns_log_column_dimensions', 'varchar', 30);
		$this -> hasColumn('new_columns_log_column_dimensions', 'varchar', 30);
		$this -> hasColumn('old_columns_log_manufacturer', 'varchar', 30);
		$this -> hasColumn('new_columns_log_manufacturer', 'varchar', 30);
		$this -> hasColumn('old_columns_log_date_received', 'date');
		$this -> hasColumn('new_columns_log_date_received', 'date');
		$this -> hasColumn('old_columns_log_column_status', 'varchar', 30);
		$this -> hasColumn('new_columns_log_column_status', 'varchar', 30);
		$this -> hasColumn('old_columns_log_reserved_for', 'varchar', 100);
		$this -> hasColumn('new_columns_log_reserved_for', 'varchar', 100);
		$this -> hasColumn('old_columns_log_comment', 'varchar', 255);
		$this -> hasColumn('new_columns_log_comment', 'varchar', 255);
		$this -> hasColumn('old_columns_log_status', 'int', 11);
		$this -> hasColumn('new_columns_log_status', 'int', 11);
		$this -> hasColumn('old_columns_log_issued_to', 'int', 11);
		$this -> hasColumn('new_columns_log_issued_to', 'int', 11);
		$this -> hasColumn('log_date', 'date');
		$this -> hasColumn('who', 'varchar', 25);
		$this -> hasColumn('activity', 'varchar', 10);
	}

	public function setUp() {
		$this -> setTableName('columns_log');
		$this -> hasOne('User', array(
			'local' => 'new_columns_log_issued_to',
			'foreign' => 'id'
			));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> 
		select("c.*, u.fname, u.lname") ->
		from("columns_log c") ->
		leftJoin("c.User u");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll

	public function getColumnLog($cid){
		$query = Doctrine_Query::create() ->
		select("*") ->
		from("columns_log") ->
		where("columns_log_id = ?", $cid);
		$columnData = $query -> execute() -> toArray();
		return $columnData;
	}
}
?>