<?php

class Client_agents extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('client_agents');

		$this -> hasMany('clients', array(
			'local' => 'id',
			'foreign' => 'client_agent_id'
		));

	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create()
		-> select("*") 
		-> from("client_agents");
		$coaData = $query -> execute();
		return $coaData;
	}


}
?>