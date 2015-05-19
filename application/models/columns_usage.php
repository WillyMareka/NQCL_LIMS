<?php
class Columns_usage extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('column_id', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('test_id', 'varchar', 30);
		$this -> hasColumn('date', 'date');
		$this -> hasColumn('user_id', 'int', 11);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('columns_usage');
		
		$this -> hasOne('columns', array(
			'local' => 'column_id',
			'foreign' => 'id'
		));
		
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("columns_usage");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

	public function getColumnNumber($r, $t){
		$query =  Doctrine_Query::create()
		-> select("cu.id, cu.column_id, cs.column_no")
		-> from("columns_usage cu")
		-> leftJoin("cu.columns cs")
		-> where("cu.request_id =?", $r)
		-> andWhere("cu.test_id =?", $t);
		$cdata = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $cdata;
	}	
	
}//end class

?>