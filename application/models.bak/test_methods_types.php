<?php 
class Test_methods_types extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar',30);
		$this -> hasColumn('charge', 'int',11);	
	}
	
	public function setUp(){
		$this -> setTableName('test_methods_types');
	}
	
	public static function getAll() {
	$query = Doctrine_Query::create() -> select("*") -> from("test_methods_types");
	$methodtypes = $query -> execute() -> toArray();
	return $methodtypes;
	}	
} 
?>