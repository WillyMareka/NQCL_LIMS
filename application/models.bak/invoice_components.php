<?php

class Invoice_components extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('component', 'varchar', 50);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('method_charge', 'int', 11);
		$this -> hasColumn('test_charge', 'int', 11);
		$this -> hasColumn('additional_charge', 'int', 11);
		$this -> hasColumn('charge_system', 'int', 11);
		$this -> hasColumn('quotation_status', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('invoice_components');
		$this -> hasMany('Request_details',
		array(
		'local' => 'request_id',
		'foreign' => 'request_id'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("invoice_components");
		$coaData = $query -> execute();
		return $coaData;
	}

	public function getInvoiceComponents($reqid){
		$query = Doctrine_Query::create() 
		-> select("rc.component, rc.id") 
		-> from("invoice_components rc")
		-> where("rc.request_id = ?", $reqid)
		-> groupBy("rc.component");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public function getInvoice_components($reqid){
		$query = Doctrine_Query::create() 
		-> select("rc.component, rc.id") 
		-> from("invoice_components rc")
		-> where("rc.request_id = ?", $reqid)
		-> groupBy("rc.component");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}


	public function getBaseCharge($a, $reqid){
		$query = Doctrine_Query::create() 
		-> select("rc.method_charge") 
		-> from("invoice_components rc")
		-> where("rc.test_id = ?", $a)
		-> andWhere("rc.request_id =?", $reqid)
		-> groupBy("rc.component")
		-> limit("1");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData[0];
	}


}
?>