<?php

class Refsubs extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('standard_type', 'varchar', 30);
		$this -> hasColumn('source', 'varchar', 30);
		$this -> hasColumn('batch_no', 'varchar', 30);
		$this -> hasColumn('rs_code', 'varchar', 30);
		$this -> hasColumn('rs_code_prefix', 'varchar', 30);
		$this -> hasColumn('date_received', 'date');
		$this -> hasColumn('effective_date', 'date');
		$this -> hasColumn('date_of_expiry', 'date');
		$this -> hasColumn('date_of_restandardisation', 'date');
		$this -> hasColumn('potency', 'decimal', 16 , array('type'=>'decimal','scale'=> 6, 'length'=> 16));
		$this -> hasColumn('potency_unit', 'varchar', 15);
		$this -> hasColumn('init_mass', 'decimal', 6, array('type'=>'decimal','scale'=> 2, 'length'=> 6));
		$this -> hasColumn('init_mass_unit', 'varchar', 15);
		$this -> hasColumn('status', 'varchar', 30);
		$this -> hasColumn('restandardisation_status', 'varchar', 20);
		$this -> hasColumn('application', 'varchar', 30);
		$this -> hasColumn('standard_type', 'varchar', 30);
		$this -> hasColumn('version_id', 'int', 11);
		$this -> hasColumn('edit_status', 'int',11);
		$this -> hasColumn('quantity', 'int', 11);
		$this -> hasColumn('serial_no', 'int', 11);
		$this -> hasColumn('storage_conditions', 'varchar', 50);
		$this -> hasColumn('water_content', 'int', 11);
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('refsubs');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("refsubs");
		//s-> where("id IN (select max(id) from refsubs group by rs_code)");
		$clientData = $query -> execute();
		return $clientData;
	}//end getall



	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("refsubs");
		//-> where("id IN (select max(id) from refsubs group by rs_code)");
		$clientData = $query -> execute() -> toArray();
		return $clientData;
	}//end getall


	public function getStandardsCountByRscode($rs_code_prefix){
		$query = Doctrine_Query::create() 
		-> select("count(distinct rs_code)")
		-> from("refsubs")
		-> where("rs_code_prefix =?", $rs_code_prefix);
		$refsubdata = $query -> execute() -> toArray();
		return $refsubdata;

	}

	public function getQuantity3($batch_no, $rs_code){
		$query = Doctrine_Query::create() 
		-> select("quantity, init_mass")
		-> from("refsubs")
		-> where("batch_no =?", $batch_no)
		-> andWhere("rs_code =?", $rs_code);
		$refsubdata = $query -> execute() -> toArray();
		return $refsubdata;
	}

	public function getQuantity2($id){
		$query = Doctrine_Query::create() 
		-> select("init_mass, init_mass_unit") 
		-> from("refsubs")
		-> where("id=?", $id);
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;	
	}

	public function getLastSerial($name){
		$query = Doctrine_Query::create() 
		-> select("max(serial_no)")
		-> from("refsubs")
		-> where("name =?", $name);
		//-> andWhere("rs_code_prefix =?", $rs_code_prefix);
		$refsubdata = $query -> execute() -> toArray();
		return $refsubdata;
	}

	public function getStandardsCount($batch_no, $rs_code_prefix){
		$query = Doctrine_Query::create() 
		-> select("count(distinct rs_code_prefix)")
		-> from("refsubs")
		-> where("batch_no =?", $batch_no)
		-> andWhere("rs_code_prefix =?", $rs_code_prefix);
		$refsubdata = $query -> execute() -> toArray();
		return $refsubdata;	
	}

	public function getRefSub($rid){
		$query = Doctrine_Query::create() 
		-> select("*")
		-> from("refsubs")
		-> where("id =?", $rid);
		$refsubdata = $query -> execute();
		return $refsubdata;
	}

	public function getRefSubArray($rid){
		$query = Doctrine_Query::create() 
		-> select("name, rs_code, source, batch_no, potency, potency_unit, date_received, date_of_expiry, storage_conditions, water_content")
		-> from("refsubs")
		-> where("id =?", $rid);
		$refsubdata = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $refsubdata;
	}

	public function getRefsubs($ref) {
		$name = str_replace('_', ' ',$ref);
		$query = Doctrine_Query::create() 
		-> select("min(id),*") 
		-> from("refsubs")
		-> where("name=?", $name)
		-> andWhere("status=?", 'Effective')
		-> groupBy("name",'DESC');
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getNameCount($name){
		$query = Doctrine_Query::create() 
		-> select("count(name)")
		-> from("refsubs")
		-> where("name =?", $name);
		$refsubdata = $query -> execute();
		return $refsubdata;
	}

	public function getCount($name, $standard_type, $batch_no) {
		$query = Doctrine_Query::create() 
		-> select('count(name)')
		-> from("refsubs")
		-> where('name = ?',$name)
		-> andWhere('standard_type = ?', $standard_type)
		-> andWhere('batch_no = ?', $batch_no)
;
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}

	public function getSerial($batch_no, $rs_code_prefix){
		$query = Doctrine_Query::create() 
		-> select('serial_no')
		-> from('refsubs')
		-> where('batch_no = ?', $batch_no)
		-> andWhere('rs_code_prefix = ?', $rs_code_prefix);
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}

	public function getCount2($batch_no, $name) {
		$query = Doctrine_Query::create() 
			-> select('count(name)')
			-> from("refsubs")
			-> where('batch_no = ?', $batch_no)
			-> andWhere('name = ?', $name);
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}

	public function getCode($batch_no) {
		$query = Doctrine_Query::create() 
			-> select('rs_code')
			-> from("refsubs")
			-> where('batch_no = ?', $batch_no);
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}

	public function getQuantity($batch_no) {
		$query = Doctrine_Query::create() 
			-> select('init_mass, init_mass_unit, quantity')
			-> from("refsubs")
			-> where('batch_no = ?', $batch_no);
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}

}
?>