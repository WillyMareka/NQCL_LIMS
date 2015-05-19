<?php
class Equipment_log extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('old_columns_log_name', 'varchar', 50);
		$this -> hasColumn('new_columns_log_name', 'varchar', 50);
		$this -> hasColumn('serial_no', 'varchar', 20);
		$this -> hasColumn('nqcl_no', 'varchar', 20);
		$this -> hasColumn('date_acquired', 'date');
		$this -> hasColumn('date_of_calibration', 'date');
		$this -> hasColumn('date_of_nxtcalibration', 'date');
		$this -> hasColumn('status', 'varchar', 30);
		$this -> hasColumn('room', 'varchar', 50);
		$this -> hasColumn('log', 'varchar', 50);
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
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("equipment")
		-> where("id=?", $eid);
		$equipmentData = $query -> execute();
		return $equipmentData;
	}

	public function getMax(){
		$query = Doctrine_Query::create() 
		-> select("max('id')")
		-> from("equipment");
		$equipmentData = $query -> execute();
		return $equipmentData;	
	}

}//end class
