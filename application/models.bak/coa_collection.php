<?php

class Coa_collection extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('ref_no', 'varchar', 30);
		$this -> hasColumn('coa_no', 'int', 30);
		$this -> hasColumn('title', 'varchar', 20);
		$this -> hasColumn('fname', 'varchar', 30);
		$this -> hasColumn('sname', 'varchar', 30);
		$this -> hasColumn('email', 'varchar', 30);
		$this -> hasColumn('phone_no', 'varchar', 30);
		$this -> hasColumn('id_type', 'int', 11);
		$this -> hasColumn('id_no', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('coa_collection');

		$this -> hasMany('dispatch_register', array(
			'local' => 'ref_no',
			'foreign' => 'request_id'
		));

	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("coa_collection");
		$coaData = $query -> execute();
		return $coaData;
	}

	public function getCollector($id){
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("coa_collection")
		-> where("ref_no = ?", $id);
		$coaData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $coaData[0];
	}


}
?>