<?php
class Reagents_usage extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('reagent_id', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('date', 'date');
		$this -> hasColumn('quantity', 'int', 11);
		$this -> hasColumn('unit', 'int', 11);
		$this -> hasColumn('user_id', 'int', 11);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('reagents_usage');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reagents_usage");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

}//end class

?>