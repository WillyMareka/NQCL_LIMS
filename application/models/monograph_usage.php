<?php

class Monograph_usage extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('monograph_id', 'int', 11);
		$this -> hasColumn('comment', 'varchar', 200);
	}

	public function setUp() {
		$this -> setTableName('monograph_usage');
		$this -> hasOne('monographs', array(
			'local' => 'monograph_id',
			'foreign' => 'id'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("monograph_usage");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll
	
	public function getMonograph($request_id) {
		$query = Doctrine_Query::create()
		-> select("mu.*")
		-> from("monograph_usage mu")
		-> leftJoin("mu.monographs m")
		-> where("m.request_id =?", $request_id);
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll
}
?>