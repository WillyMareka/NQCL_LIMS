<?php

class Client_credit extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('client_id', 'varchar', 30);
		$this -> hasColumn('amount_paid', 'int', 11);
		$this -> hasColumn('receipt_no', 'varchar', 30);
		$this -> hasColumn('cheque_no', 'varchar', 30);
		$this -> hasColumn('payment_date', 'date');
	}

	public function setUp() {
		$this -> setTableName('client_credit');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("client_credit");
		$coaData = $query -> execute();
		return $coaData;
	}

	public function getCreditHist($cid){
		$query = Doctrine_Query::create()
		 -> select("*") 
		 -> from("client_credit")
		 -> where("client_id =?", $cid);
		$coaData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $coaData;		
	}
}
?>