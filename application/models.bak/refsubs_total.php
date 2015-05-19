<?php
class Refsubs_total extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('rs_code', 'varchar', 50);
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('batch_no', 'varchar', 20);
		$this -> hasColumn('potency', 'decimal', 16 , array('type'=>'decimal','scale'=> 6, 'length'=> 16));
		$this -> hasColumn('potency_unit', 'varchar', 20);
		$this -> hasColumn('total', 'decimal', 6, array('type'=>'decimal','scale'=> 2, 'length'=> 6));
		$this -> hasColumn('total_unit', 'varchar', 20);
	}

	public function setUp() {
		$this -> setTableName('refsubs_total');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("refsubs_total");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

	public function getLastTotal($rsc){
		$query = Doctrine_Query::create() 
		-> select("total") 
		-> from("refsubs_total")
		-> where("rs_code = ?", $rsc);
		$totalData = $query -> execute() -> toArray();
		return $totalData;
	}

}//end class
