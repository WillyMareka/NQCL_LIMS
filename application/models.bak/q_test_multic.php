<?php 
class Q_test_multic extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('client_number', 'varchar',30);
		$this -> hasColumn('components_no', 'int',11);
		$this -> hasColumn('method_id', 'int',11);			
	}
	
	public function setUp(){
		$this -> setTableName('q_test_multic');
	}
	
	public static function getAll() {
	$query = Doctrine_Query::create() -> select("*")
	-> from("q_test_multic");
	$test_multi = $query -> execute() -> toArray();
	return $test_multi;
	}

	public static function getMultic($reqid, $tid){
	$query = Doctrine_Query::create() -> select("*")
	-> from("q_test_multic")
	-> where("client_number =?", $reqid);
	$q_test_multic = $query -> execute() -> toArray();
	return $q_test_multic;
	}	
} 
?>