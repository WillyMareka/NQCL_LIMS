<?php
class Components extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('unit1', 'varchar', 10);
		$this -> hasColumn('unit2', 'varchar', 10);
		$this -> hasColumn('volume1', 'int', 11);
		$this -> hasColumn('volume2', 'int',11);
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('method_name', 'varchar', 30);
		
	}

	public function setUp() {
		$this -> setTableName('components');
	}//end setUp

	public function getComponents($reqid){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("components")
		-> where("request_id = ?", $reqid);
		$componentData = $query -> execute();
		return $componentData;
	}

	public function getComponentName($id){
		$query = Doctrine_Query::create()
		-> select("name")
		-> from("components")
		-> where("id = ?", $id);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}
	
	public function getLastComponent($reqid, $test_id){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("components")
		-> where("request_id = ?", $reqid)
		-> andWhere("test_id = ?", $test_id);
		$componentData = $query -> execute() ->getLast();
		return $componentData;
	}
}
?>