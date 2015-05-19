<?php

class Sample_issuance extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('desc_status', 'int', 11);	
		$this -> hasColumn('Test_id','int', 11);
		$this -> hasColumn('Analyst_id','int',11);
		$this -> hasColumn('Lab_ref_no','varchar', 25);
		$this -> hasColumn('Samples_no','int', 11);
		$this -> hasColumn('Status_id','int',11);
		$this -> hasColumn('Department_id','int',11);
		$this -> hasColumn('Split_status','int',11);
		$this -> hasColumn('Samples_returned','int',11);
		$this -> hasColumn('Withdrawal_status', 'int', 11);
		$this -> hasColumn('Edit_notes', 'varchar', 255);
		$this -> hasColumn('Samples_used', 'int', 11);
		$this -> hasColumn('method_status', 'int', 11);
		$this -> hasColumn('desc_status', 'int', 11);
		$this -> hasColumn('equip_status', 'int', 11);
		$this -> hasColumn('chroma_status', 'int', 11);
		$this -> hasColumn('review_status', 'int', 11);
		$this -> hasColumn('do_count', 'int', 11);
		$this -> hasColumn('desc_status', 'int', 11);
		$this -> hasColumn('component_status', 'int', 11);
		$this -> hasColumn('done_status', 'int', 11);
		$this -> hasColumn('upload_status', 'int', 11);
		$this -> hasColumn('priority', 'int', 11);
		$this -> hasColumn('compendia_status', 'int', 11);
		$this -> hasColumn('system_status', 'int', 11);
		$this -> hasColumn('multicomponent_status','int', 11);
		$this -> hasColumn('archive_status','int', 11);
		$this -> hasColumn('withdrawal_status','int', 11);
		$this -> hasColumn('download_status','int', 11);
		$this -> hasColumn('completion','int', 11);
		$this -> hasColumn('withdrawal_reason_id','int', 11);
		$this -> hasColumn('withdrawal_comment','varchar', 100);
		$this -> hasColumn('Assigner_id','int', 11);
	}
	
	public function setUp(){
		
		$this->actAs('Timestampable');
		$this -> setTableName('sample_issuance');

		$this -> hasOne('User', array(
			'local' => 'Analyst_id',
			'foreign' => 'id'
		));
		
		$this -> hasOne('Tests', array(
			'local' => 'Test_id',
			'foreign' => 'id'
			));
		
		$this -> hasMany('Request',array(
			'local' => 'Lab_ref_no',
			'foreign' => 'request_id'			
		));

		$this -> hasOne('Units',array(
			'local' => 'Department_id',
			'foreign' => 'id'			
		));

	}
	
	
	public function getIssuedTests($reqid, $dept_id) {
			
		$query = Doctrine_Query::create()
		
		-> select('*')
		-> from('sample_issuance')
		-> where('lab_ref_no = ?', $reqid)
		//-> andWhere('version_id =?', $issues_version_id)
		-> andWhere('department_id =?', $dept_id);
		
		$IssuedData = $query -> execute() -> toArray();
		return $IssuedData;
		
	}

	public function getAnalystsAssignedTo($reqid) {
		$query = Doctrine_Query::create()
		-> select('analyst_id')
		-> from('sample_issuance')
		-> where('lab_ref_no = ?', $reqid)
		-> groupBy('analyst_id');
		$IssuedData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $IssuedData;
	}

	public function getAssignment($reqid){
		$query = Doctrine_Query::create()
		-> select('s.Samples_no, s.created_at, d.name, u.fname, u.lname, ')
		-> from('Sample_issuance s')
		-> leftJoin('s.Units d')
		-> leftJoin('s.User u')
		-> where('s.Lab_ref_no = ?', $reqid)
		-> groupBy('d.id');
		$IssuedData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $IssuedData;
	}

	public function getAllAssignments($reqid){
		$query = Doctrine_Query::create()
		-> select('s.Samples_no as quantity, p.name as packaging, s.Department_id,s.Test_id, s.Analyst_id, s.created_at, d.name as department, u.fname as fname, u.lname as lname, t.name as test')
		-> from('Sample_issuance s')
		-> leftJoin('s.Units d')
		-> leftJoin('s.User u')
		-> leftJoin('s.Tests t')	
		-> leftJoin('s.Request r')
		-> leftJoin('r.Packaging p')
		-> where('s.Lab_ref_no = ?', $reqid)
		-> groupBy('s.analyst_id');
		$IssuedData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $IssuedData;
	}
	

	public function getIssuance($reqid){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('sample_issuance')
		-> where('lab_ref_no = ?', $reqid);
		$IssuedData = $query -> execute() -> toArray();
		return $IssuedData;
	}
	

	public function getDescriptionStatus($lab_ref_no){
		$query = Doctrine_Query::create()
		-> select('count(*)')
		-> from('sample_issuance')
		-> where('lab_ref_no = ?', $lab_ref_no)
		-> andWhere('desc_status =?', 1);
		$desc_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $desc_data;
	}
	
	public function getTests($user_id) {
		
		$query = Doctrine_Query::create()
		-> select('*') 
		-> from('sample_issuance s')
		-> where('s.analyst_id = ?', $user_id)
			-> andWhere('s.completion = ?', '0')
		-> andWhere('s.archive_status =?', 0);
		//-> andWhere('s.withdrawal_status = ?', null)
		//-> andWhere("version_id IN (select max(version_id) from sample_issuance group by lab_ref_no)");
		//-> andwhere('t.id = s.test_id');
		$testData = $query -> execute();
		return $testData;
		
	}

	public function getTests2($user_id, $dept_id, $reqid){
		$query = Doctrine_Query::create()
		-> select('s.id, t.name as test_name, t.id as test_id') 
		-> from('sample_issuance s')
		-> leftJoin('s.Tests t')
		-> where('s.analyst_id = ?', $user_id)
		-> andWhere('s.Department_id =?', $dept_id)
		-> andWhere('s.Lab_ref_no =?', $reqid);
		$testData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData;
	}
	
	public function getStatus($lab_ref_no, $test_id){
		$query = Doctrine_Query::create()

		-> select('status_id')
		-> from('sample_issuance')
		-> where('lab_ref_no = ?', $lab_ref_no)
		-> andWhere('test_id = ?', $test_id);
		
		$statusData = $query -> execute();
		return $statusData;
	}


	public function getStatus2($reqid){
		$query = Doctrine_Query::create()

		-> select('status_id, department_id, split_status')
		-> from('sample_issuance')
		-> where('lab_ref_no = ?', $reqid)
		-> andWhere('split_status = ?', 1)
		-> groupBy('department_id');
		
		$statusData = $query -> execute();
		return $statusData;
	}
	

	public function getSampleIssue($reqid) {
		
		$query = Doctrine_Query::create()
		->select('*')
		->from('sample_issuance')
		->where('lab_ref_no = ?', $reqid);
		//->andWhere('version_id = ?', $version_id);
		$listingData = $query -> execute();
		return $listingData;
		
	}
	

	

	public function getAll() {
		
		$query = Doctrine_Query::create()
		->select('*')
		->from('sample_issuance');
		//->where("version_id IN (select max(version_id) from sample_issuance group by lab_ref_no)");
		$listingData = $query -> execute();
		return $listingData;
		
	}


	public function getIssuedTests2($reqid) {
		
		$query = Doctrine_Query::create()
		->select('*')
		->from('sample_issuance');
		//->where("version_id IN (select max(version_id) from sample_issuance where lab_ref_no = '$reqid')");
		$listingData = $query -> execute()-> toArray();
		return $listingData;
		
	}

	
	public static function getSplits($reqid) {
		
		$query = Doctrine_Query::create()
		->select('Department_id')
		->from('Sample_issuance')
		->where('lab_ref_no = ?', $reqid)
		->andWhere('Department_id <> 2')
		->groupBy('Department_id');		
		$splitData = $query -> execute()->toArray();
		return $splitData;
	}
	
		
	     	public function getCompendiaStatus($lab_ref_no, $test_id){
		$query = Doctrine_Query::create()

		-> select('compendia_status')
		-> from('sample_issuance')
		-> where('lab_ref_no = ?', $lab_ref_no)
		-> andWhere('test_id = ?', $test_id);
		
		$statusData = $query -> execute();
		return $statusData[0]['compendia_status'];
	}


}



?>