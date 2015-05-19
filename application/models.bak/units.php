<?php
class Units extends Doctrine_Record {

	public function setTableDefinition() {

		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('dept_id', 'int', 11);
	
	}
	public function setUp() {
		$this -> setTableName('units');
		/*$this -> hasMany('User_type', array(
			'local'=> 'id',
			'foreign' => 'unit'
			));*/
		$this -> hasMany('Users', array(
			'local'=> 'id',
			'foreign' => 'unit_id'
			));
		$this -> hasMany('Sample_issuance',array(
			'local' => 'id',
			'foreign' => 'Department_id'			
		));

		$this -> hasMany('Tests', array(
			'local' => 'dept_id',
			'foreign' => 'Department'
		));

	}//end setUp

	public function getUnit($dept_id){

		$query = Doctrine_Query::create()
		-> select("*")
		-> from("units")
		-> where("dept_id = ?", $dept_id);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}
	
	public function getMainUnits(){
		$query = Doctrine_Query::create()
		-> select("u.*")
		-> from("units u")
		-> where("u.id < 3");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	
	}


}
?>