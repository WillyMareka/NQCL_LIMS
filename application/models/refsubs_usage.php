<?php
class Refsubs_usage extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('refsubs_id', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('date', 'date');
		$this -> hasColumn('quantity', 'int', 11);
		$this -> hasColumn('unit', 'int', 11);
		$this -> hasColumn('user_id', 'int', 11);
		$this -> hasColumn('component', 'varchar', 30);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('refsubs_usage');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("refsubs_usage");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

}//end class

?>