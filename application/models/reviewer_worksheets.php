<?php

class Reviewer_worksheets extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('reviewer_id', 'int', 11);
		$this -> hasColumn('time_done', 'varchar', 30);
		$this -> hasColumn('folder', 'varchar', 20);
		$this -> hasColumn('status', 'int', 11);
		$this -> hasColumn('priority', 'int', 11);
		$this -> hasColumn('microbiology','int', 11);
		$this -> hasColumn('test_id', 'int', 11);
	}

	public function setUp() {
		
		$this -> setTableName('reviewer_worksheets');
	
		$this ->hasMany('User', array(
		'local'=>'reviewer_id',
		'foreign'=> 'id'));

		$this ->hasOne('Tests', array(
		'local'=>'test_id',
		'foreign'=> 'id'));
	}

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reviewer_worksheets");
		$departmentData = $query -> execute();
		return $departmentData;
	}

	public function getReviewerDetails ($reqid){
		$query = Doctrine_Query::create()
		-> select("rw.*, t.name as test_name,u.fname as fname, u.lname as lname")
		-> from("reviewer_worksheets rw")
		-> where("folder =?", $reqid)
		-> leftJoin("rw.User u")
		-> leftJoin("rw.Tests t");
		$reviewer_data = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $reviewer_data;
	}

}
?>