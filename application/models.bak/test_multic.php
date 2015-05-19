<?php 
class Test_multic extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar',30);
		$this -> hasColumn('components_no', 'int',11);
		$this -> hasColumn('method_id', 'int',11);			
	}
	
	public function setUp(){
		$this -> setTableName('test_multic');
	}
	
	public static function getAll() {
	$query = Doctrine_Query::create() -> select("*")
	-> from("test_multic");
	$test_multi = $query -> execute() -> toArray();
	return $test_multi;
	}

	public static function getMultic($reqid, $tid){
	$query = Doctrine_Query::create() -> select("*")
	-> from("test_multic")
	-> where("request_id =?", $reqid)
	-> andWhere("method_id =?", $tid);
	$test_multic = $query -> execute() -> toArray();
	return $test_multic;
	}	
} 
?>