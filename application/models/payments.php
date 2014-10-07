<?php
class Payments extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('client_id', 'varchar', 30);
		$this -> hasColumn('amount_paid', 'int', 11);
		$this -> hasColumn('payer_name', 'varchar', 30);
		$this -> hasColumn('id_no', 'varchar', 30);
		$this -> hasColumn('phone_no','varchar', 30);
		$this -> hasColumn('receipt_no', 'varchar', 30);
		$this -> hasColumn('auto_receipt_no', 'varchar', 20);
		$this -> hasColumn('payment_date', 'date');
		$this -> hasColumn('client_paid_for', 'varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('payments');
		$this -> hasOne('clients',array(
			'local' => 'client_id',
			'foreign' => 'alias'			
		));

		$this -> hasMany('dispatch_register',array(
			'local' => 'client_id',
			'foreign' => 'client_id'			
		));

	}//end setUp

	public function getAll(){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("payments");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public function getPerClient($cid){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("payments")
		-> where("client_id =?", $cid)
		-> andWhere("amount_paid > 0");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public function getAmountPaid($reqid){
		$query = Doctrine_Query::create()
		-> select("amount_paid")
		-> from("payments")
		-> where("request_id = ?", $reqid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}


	public function getPaymentStatus($reqid){
		$query = Doctrine_Query::create()
		-> select("count(*)")
		-> from("payments")
		-> where("request_id = ?", $reqid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}


	public function getPaymentsPerClient($cid){
		$query = Doctrine_Query::create()
		-> select("p.*")
		-> from("payments p")
		-> where("p.client_id = ?", $cid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public function getRowCount(){
		$query = Doctrine_Query::create()
		-> select('count(*)')
		-> from("payments");
		$rowcount = $query -> execute() -> toArray();
		return $rowcount;
	}
}
?>