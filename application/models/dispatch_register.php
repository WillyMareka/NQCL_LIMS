<?php

class Dispatch_register extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('client_id', 'int', 11);
		$this -> hasColumn('date', 'date');
		$this -> hasColumn('cert_no', 'varchar', 30);
		$this -> hasColumn('request_id', 'int', 11);
		$this -> hasColumn('invoiced_amount', 'int', 11);
		$this -> hasColumn('invoice_no', 'varchar', 30);
		$this -> hasColumn('discount', 'int', 11);
		$this -> hasColumn('amount', 'int', 11);
		$this -> hasColumn('amount_paid', 'int', 11);
		$this -> hasColumn('balance', 'int', 11);
		$this -> hasColumn('percentage', 'int', 11);
		$this -> hasColumn('quotation_status', 'int', 11);
		$this -> hasColumn('paid_status', 'int', 11);
		$this -> hasColumn('date_of_payment', 'date');
		$this -> hasColumn('proforma_no','varchar', 50);
		$this -> hasColumn('apportionment_status', 'int', 11);
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('dispatch_register');
		$this -> hasOne('Clients', array(
			'local' => 'client_id',
			'foreign' => 'id'
			));
		$this -> hasMany('Request', array(
			'local' => 'request_id',
			'foreign' => 'request_id'
		));	
		$this -> hasMany('Client_billing', array(
			'local' => 'request_id',
			'foreign' => 'request_id'
		));

		$this -> hasMany('Payments', array(
			'local' => 'client_id',
			'foreign' => 'client_id'
		));

		$this -> hasOne('Coa_number', array(
			'local' => 'request_id',
			'foreign' => 'request_id'
		));

		$this -> hasOne('coa_collection', array(
			'local' => 'request_id',
			'foreign' => 'ref_no'
		));

	}//end setUp

	public function getAllDispatch() {
		$query = Doctrine_Query::create() -> 
		select("d.*, r.*, b.*, c.*") ->
		from("dispatch_register d") ->
		innerJoin("d.Request r") ->
		innerJoin("d.Client_billing b") ->
		innerJoin("d.Clients c");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}//end getAll


	public function getAllDispatch2() {
		$query = Doctrine_Query::create() -> 
		select("d.*, r.*, b.*, c.*, p.*, coa.*") ->
		from("dispatch_register d") ->
		innerJoin("d.Request r") ->
		innerJoin("d.Client_billing b") ->
		innerJoin("d.Clients c") ->
		leftJoin("d.Payments p") ->
		leftJoin("d.Coa_number coa") ->
		where("r.coa_done_status = 1");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getQuote($labref){
		$query = Doctrine_Query::create()
		-> select('amount')
		-> from('dispatch_register')
		-> where('request_id =?', $labref);
		$quoteData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $quoteData;
	}

	public function getAllDispatchByClient(){
		$query = Doctrine_Query::create() -> 
			select("d.*, p.*, r.*, b.*, c.*, count(distinct(r.request_id)) as all_samples,
			count(distinct case when paid_status = 0 then d.request_id end) as un_paid,
			count(distinct case when paid_status = 1 then d.request_id end) as partially_paid,
			count(distinct case when paid_status = 2 then d.request_id end) as fully_paid,
			sum(p.amount_paid) as total_paid,
			sum(distinct(amount)) - sum(distinct(p.amount_paid)) as total_balance,
			sum(distinct(amount)) as total_owed 
			") ->
			from("dispatch_register d") ->
			innerJoin("d.Request r") ->
			innerJoin("d.Client_billing b") ->
			innerJoin("d.Clients c") ->
			leftJoin("d.Payments p") ->
			groupBy("c.id");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getDispatchPerSample($cid){
		$query = Doctrine_Query::create() -> 
			select("d.*, p.*, r.*, b.*, c.*") ->
			from("dispatch_register d") ->
			innerJoin("d.Request r") ->
			innerJoin("d.Client_billing b") ->
			innerJoin("d.Clients c") ->
			leftJoin("d.Payments p") ->
			where("c.id =?", $cid) ->
			andWhere("d.quotation_status = 1");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getDispatchPerSampleSimple($cid){	
		$query = Doctrine_Query::create() ->
			select("*") ->
			from ("dispatch_register") ->
			where("client_id =?", $cid) ->
			andWhere("paid_status = '1' or paid_status = '0'") ->
			andWhere("quotation_status = 1") ->
			orderBy("id DESC");
		$dispatchData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $dispatchData;
	}

	public function getAmountOwedTotal($cid){
		$query = Doctrine_Query::create() ->
			select("sum(amount) as total_proforma_amount, sum(invoiced_amount) as total_invoiced_amount, sum(amount_paid) as total_amount_paid") ->
			from ("dispatch_register") ->
			where("client_id =?", $cid) ->
			andWhere("paid_status = '1' or paid_status = '0'") ->
			andWhere("quotation_status = 1") ->
			orderBy("id DESC");
		$dispatchData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $dispatchData;
	}

	public function getAmountPaid($reqid){
		$query = Doctrine_Query::create()
		-> select("amount_paid, balance, percentage, amount")
		-> from("dispatch_register")
		-> where("request_id = ?", $reqid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}

	public function getPercentage($reqid){
		$query = Doctrine_Query::create()
		-> select("percentage")
		-> from("dispatch_register")
		-> where("request_id = ?", $reqid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}

	public function getBalance($cid){
		$query = Doctrine_Query::create()
		-> select("d.id, p.id, sum(distinct(amount)) - sum(p.amount_paid) as total_balance")
		-> from("dispatch_register d") 
		-> leftJoin("d.Payments p")
		-> where("d.client_id = ?", $cid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}
}
?>