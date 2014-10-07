<?php
class Columns_usage extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('column_id', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('test_id', 'varchar', 30);
		$this -> hasColumn('date', 'date');
		$this -> hasColumn('user_id', 'int', 11);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('columns_usage');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("columns_usage");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

}//end class

?>