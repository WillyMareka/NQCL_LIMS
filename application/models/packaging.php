<?php

class Packaging extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('id', 'int', 11);
		$this -> hasColumn('name', 'varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('packaging');
		$this -> hasMany('Request', array(
			'local'=> 'id',
			'foreign' => 'packaging'
			));
	}//end setUp

	public function getAll() {
	$query = Doctrine_Query::create() -> select("*") -> from("packaging");
	$productData = $query -> execute();
	return $productData;
	}//end getall

}
?>