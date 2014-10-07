<?php
class Months extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar',20);
		$this -> hasColumn('alias', 'varchar',20);	
	}
	
	public function setUp(){
		$this -> setTableName('months');
	}
	
	public static function getAll() {
	$query = Doctrine_Query::create() -> select("*") -> from("months");
	$mnth = $query -> execute();
	return $mnth;
	}
	
	
	
}
	
?>