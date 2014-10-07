<?php

class Client_totals extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'int', 11);
		$this -> hasColumn('client_id', 'varchar', 30);
		$this -> hasColumn('total', 'int', 11);
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('client_billing');

		$this -> hasOne('clients',array(
			'local' => 'client_id',
			'foreign' => 'id'			
		));

	}//end setUp

	public function getAll(){
		$query = Doctrine_Query::create()
		-> select("c.*, cl.*")
		-> from("client_totals c")
		-> leftJoin("c.clients cl");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}
	
}