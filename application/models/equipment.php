<?php
class Equipment extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('serial_no', 'varchar', 20);
		$this -> hasColumn('nqcl_no', 'varchar', 20);
		$this -> hasColumn('date_acquired', 'date');
		$this -> hasColumn('date_of_calibration', 'date');
		$this -> hasColumn('date_of_nxtcalibration', 'date');
		$this -> hasColumn('status', 'varchar', 30);
		$this -> hasColumn('room', 'varchar', 50);
		$this -> hasColumn('comment', 'varchar', 100);
		$this -> hasColumn('edit_status', 'int', 11);
		$this -> hasColumn('type', 'varchar', 20);
		$this -> hasColumn('model', 'varchar', 150);
		$this -> hasColumn('alias', 'varchar', 50);
		$this -> hasColumn('remarks', 'varchar', 50);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('equipment');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("equipment");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("name,nqcl_no") -> from("equipment");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getEquipment($eid) {
		$name = str_replace('_', ' ',$eid);
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("equipment")
		-> where("name=?", $name);
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getMax(){
		$query = Doctrine_Query::create() 
		-> select("count('*')")
		-> from("equipment");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;	
	}

}//end class
