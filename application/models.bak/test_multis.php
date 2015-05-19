<?php 
class Test_multis extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar',30);
		$this -> hasColumn('stages_no', 'int',11);
		$this -> hasColumn('method_id', 'int',11);			
	}
	
	public function setUp(){
		$this -> setTableName('test_multis');
	}
	
	public static function getAll() {
	$query = Doctrine_Query::create() -> select("*")
	-> from("test_multis");
	$test_multi = $query -> execute() -> toArray();
	return $test_multi;
	}	

	public static function getMultis($reqid, $tid) {
	$query = Doctrine_Query::create() -> select("*")
	-> from("test_multis")
	-> where("request_id =?", $reqid);
	$test_multis = $query -> execute() -> toArray();
	return $test_multis;
	}	

} 
?>