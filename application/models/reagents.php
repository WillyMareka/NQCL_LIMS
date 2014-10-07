<?php

class Reagents extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('comment', 'varchar', 255);
		$this -> hasColumn('manufacturer', 'varchar', 35);
		$this -> hasColumn('batch_no', 'varchar', 15);
		$this -> hasColumn('date_received', 'date');
		$this -> hasColumn('date_opened', 'date');
		$this -> hasColumn('date_of_expiry', 'date');
		$this -> hasColumn('reorder_level', 'varchar', 30);
		$this -> hasColumn('packaging', 'varchar', 30);
		$this -> hasColumn('volume', 'decimal', 16 , array('type'=>'decimal','scale'=> 6, 'length'=> 16));
		$this -> hasColumn('qunit','varchar', 15);
		$this -> hasColumn('quantity','int', 11);
		$this -> hasColumn('form', 'varchar', 30);
		$this -> hasColumn('closing_value', 'int', 11);
		$this -> hasColumn('reagentid', 'int', 11);
		$this -> hasColumn('edit_status', 'int', 11);
		$this -> hasColumn('status', 'varchar', 20);
	}

	public function setUp() {
		$this -> setTableName('reagents');
	}//end setUp


	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reagents");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll
	

	public function getReagents($ref) {
		$name = str_replace('_', ' ',$ref);
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("reagents")
		-> where("name=?", $name);
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getQuantity($id){
		$query = Doctrine_Query::create() 
		-> select("volume, qunit") 
		-> from("reagents")
		-> where("id=?", $id);
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;	
	}

}
?>