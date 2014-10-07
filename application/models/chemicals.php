<?php

class Chemicals extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('item_description', 'varchar', 200);
		$this -> hasColumn('unit_of_issue', 'varchar', 20);
		$this -> hasColumn('physical', 'int', 11);
		$this -> hasColumn('value', 'int', 11);
		$this -> hasColumn('ledger', 'int', 11);
		$this -> hasColumn('variation', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('chemicals');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("chemicals");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll


}
?>