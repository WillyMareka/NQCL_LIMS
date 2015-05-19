<?php

class Client_contacts extends Doctrine_Record {

	public function setTableDefinition() {

		$this -> hasColumn('contact_name', 'varchar', 50);
		$this -> hasColumn('contact_phone', 'varchar', 50);
		$this -> hasColumn('client_id', 'int', 11);
	
	}

	public function setUp() {
		$this -> setTableName('client_contacts');

		$this -> hasOne('Clients', array(
			'local'=> 'client_id',
			'foreign' => 'id'
		));

	}

	public function getContactForThisClient($client_id, $contact_no){
		$query = Doctrine_Query::create()
			-> select("count(*)")
			-> from("client_contacts")
			-> where("client_id = ?", $client_id)
			-> andWhere("contact_phone = ?", $contact_no);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}
}

?>