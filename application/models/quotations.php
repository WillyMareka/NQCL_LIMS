<?php

class Quotations extends Doctrine_Record {
	
	public function setTableDefinition() {
	
	$this->hasColumn('client_email','varchar', 30);
	$this->hasColumn('Client_number','varchar', 35);	
	$this->hasColumn('Client_name','varchar', 35);
	$this->hasColumn('Sample_name','varchar', 35);
	$this->hasColumn('No_of_batches','int', 11);
	$this->hasColumn('Quotation_date','varchar',35);
	$this->hasColumn('Quotations_id','varchar',35);
	$this->hasColumn('Quotation_no','varchar',35);
	$this->hasColumn('Amount','int',11);
	$this->hasColumn('Active_ingredients','varchar',35);
	$this->hasColumn('Dosage_form','int', 11);
	$this->hasColumn('Quotation_status', 'int', 11);
	$this->hasColumn('quotation_print_status', 'int', 11);
	$this->hasColumn('signatory_title', 'varchar', 50);
	$this->hasColumn('signatory_name', 'varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('Quotations');
		$this -> hasOne('Clients', array(
			'local' => 'client_number',
			'foreign' => 'id'
		));

		$this -> hasMany('Q_request_details', array(
			'local' => 'quotations_id',
			'foreign' => 'quotations_id'
		));
	}//end setUp


	public function getLastId(){
		$query = Doctrine_Query::create()
		-> select('max(id)')
		-> from("quotations");
		$lastreqid = $query -> execute() -> toArray();
		return $lastreqid;
	}


	public function getNos($c){
		$query = Doctrine_Query::create()
		-> select('Quotation_no')
		-> from("quotations")
		-> where("Client_number = ?", $c);
		$lastreqid = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $lastreqid;
	}


	public function getRowCount(){
		$query = Doctrine_Query::create()
		-> select('count(*)')
		-> from("quotations");
		$rowcount = $query -> execute() -> toArray();
		return $rowcount;
	}


	public function getRowCountPerClient($c){
		$query = Doctrine_Query::create()
		-> select('count(*)')
		-> from("quotations")
		-> where("Client_number = ?", $c);
		$rowcount = $query -> execute() -> toArray();
		return $rowcount;
	}


	public function getQuotationsInfoSimple($reqid){
		$query = Doctrine_Query::create()
		-> select("q.id, q.sample_name as product_name, c.name")
		-> from("quotations q")
		-> leftJoin("q.Clients c")
		-> where("q.quotations_id = ?", $reqid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}

	public function getInvoiceDetails($r){
		$query = Doctrine_Query::create()
		-> select("q.Quotation_date as Date,q.quotations_id as Quotation_No, q.Client_name as Client_Name, q.client_email as Client_Email, q.sample_name as Sample_Name,  q.No_of_batches as No_Of_Batches, t.Name, q.id, rq.id, q.amount as Unit_Cost, (q.amount * q.No_of_batches) as Total_Cost")
		-> from("quotations q")
		-> leftJoin("q.Clients c")
		-> leftJoin("q.Q_request_details rq")
		-> leftJoin("rq.Tests t")
		-> where("q.quotations_id =?", $r);
		$invoiceData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $invoiceData;
	}

	public function getClientId($r){
		$query = Doctrine_Query::create()
		-> select("distinct(client_number)")
		-> from("quotations")
		-> where("quotations_id = ?", $r);
		$client_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $client_data[0];
	}


	public function getInvoiceDetailsPerClient($c, $q){
		$query = Doctrine_Query::create()
		-> select("q.Quotation_date as Date,q.quotations_id as Quotation_No, q.quotation_no as Q_No, q.Client_name as Client_Name, q.client_email as Client_Email, q.sample_name as Sample_Name,  q.No_of_batches as No_Of_Batches, t.Name, q.id, rq.id, q.amount as Unit_Cost, (q.amount * q.No_of_batches) as Total_Cost")
		-> from("quotations q")
		-> leftJoin("q.Clients c")
		-> leftJoin("q.Q_request_details rq")
		-> leftJoin("rq.Tests t")
		-> where("q.client_number =?", $c)
		-> andWhere("q.Quotation_no =?", $q);
		$invoiceData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $invoiceData;
	}


	public function getTotalPerClient($c, $q){
		$query = Doctrine_Query::create()
		-> select("sum(q.amount * q.No_of_batches), q.id")
		-> from("quotations q")
		-> where("q.client_number =?", $c)
		-> andWhere("q.Quotation_no =?", $q);
		$invoiceData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $invoiceData;
	}



public function getSample($reqid) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("quotations")
		-> where("client_number =?", $reqid);
		$productData = $query -> execute() -> toArray();
		return $productData;
	}//end getall


	public function getQuotationNumber($reqid) {
		$query = Doctrine_Query::create() -> select("quotation_no") 
		-> from("quotations")
		-> where("quotations_id =?", $reqid);
		$productData = $query -> execute() -> toArray();
		return $productData;
	}



	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Quotations");
		$productData = $query -> execute() -> toArray();
		return $productData;
	}//end getall

}

?>