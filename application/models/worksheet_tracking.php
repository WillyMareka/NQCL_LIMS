<?php

class Worksheet_tracking extends Doctrine_Record {

	public function setTableDefinition() {

		$this -> hasColumn('labref', 'varchar', 20);
		$this -> hasColumn('client_id', 'int', 11);
		$this -> hasColumn('activity', 'varchar', 255);
		$this -> hasColumn('from', 'varchar', 35);
		$this -> hasColumn('to', 'varchar', 35);
		$this -> hasColumn('date_added', 'varchar', 30);
		$this -> hasColumn('stage', 'int', 11);
		$this -> hasColumn('state', 'int', 11);
		$this -> hasColumn('priority','int', 11);
		$this -> hasColumn('current_location', 'varchar', 100);
	}

	public function setUp() {
		$this -> setTableName('worksheet_tracking');
		$this -> hasOne('clients',array(
			'local' => 'client_id',
			'foreign' => 'id'			
		));
		$this -> hasOne('request',array(
			'local' => 'labref',
			'foreign' => 'request_id'			
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("clients");
		$clientData = $query -> execute();
		return $clientData;
	}//end getall

	public function getSampleLocation($cid) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("worksheet_tracking")
		-> where("client_id =?", $cid);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}//end getall

	public function getWorksheet_trackingPerClient($cid) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("worksheet_tracking")
		-> where("client_id =?", $cid);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}//end getall	


	public function getTrackingPerRequest($r) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("worksheet_tracking")
		-> where("labref =?", $r);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}

}
?>