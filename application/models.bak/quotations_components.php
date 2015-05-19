<?php

class Quotations_components extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('component', 'varchar', 50);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('quotations_id', 'varchar', 30);
		$this -> hasColumn('method_charge', 'int', 11);
		$this -> hasColumn('test_charge', 'int', 11);
		$this -> hasColumn('additional_charge', 'int', 11);
		$this -> hasColumn('charge_system', 'int', 11);
		$this -> hasColumn('quotation_status', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('quotations_components');
		$this -> hasMany('Q_request_details',
		array(
		'local' => 'quotations_id',
		'foreign' => 'quotations_id'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("quotations_components");
		$coaData = $query -> execute();
		return $coaData;
	}

	public function getQuotations_components($reqid, $ref){
		$query = Doctrine_Query::create() 
		-> select("rc.component, rc.id") 
		-> from("quotations_components rc")
		-> where("rc.$ref = ?", $reqid)
		-> groupBy("rc.component");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public function getBaseCharge($a, $reqid){
		$query = Doctrine_Query::create() 
		-> select("rc.method_charge") 
		-> from("quotations_components rc")
		-> where("rc.test_id = ?", $a)
		-> andWhere("rc.quotations_id =?", $reqid)
		-> groupBy("rc.component")
		-> limit("1");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData[0];
	}


}
?>