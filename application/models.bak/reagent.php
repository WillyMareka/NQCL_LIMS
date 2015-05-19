<?php

class Reagent extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('code', 'varchar', 30);
		$this -> hasColumn('description', 'varchar', 30);
		$this -> hasColumn('alias', 'varchar', 100);
		$this -> hasColumn('edit_status', 'int', 11);
		$this -> hasColumn('comment', 'varchar', 255);
	}

	public function setUp() {
		$this -> setTableName('reagent');
	}//end setUp


	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reagent");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

	public function getCodes($ref){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from ('reagent')
		-> where('alias =?', $ref);
		$refsubs = $query -> execute() -> toArray();
		return $refsubs;
	}

	public function getNameCount($name){
		$query = Doctrine_Query::create()
		-> select('count(distinct(name))')
		-> from('reagent')
		-> where('name =?', $name);
		$countData = $query -> execute() -> toArray();
		return $countData;
	}

	public function getReagent($rid){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from ('reagent')
		-> where('id =?', $rid);
		$refsubs = $query -> execute();
		return $refsubs;
	}

}
?>