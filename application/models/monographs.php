<?php

class Monographs extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('monographs');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("monographs");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll
}
?>