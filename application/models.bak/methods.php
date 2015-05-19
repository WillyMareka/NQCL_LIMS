<?php

class Methods extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('batch_no', 'varchar', 30);
		$this -> hasColumn('exp_date', 'date');
		$this -> hasColumn('request_id', 'int', 11);
		$this -> hasColumn('mfg_date', 'date');
		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('quantity', 'int', 11);
		$this -> hasColumn('request_id', 'varchar', 30);
		$this -> hasColumn('unit', 'varchar', 20);

	}

	public function setUp() {
		$this -> setTableName('copackages');
		/*$this -> hasOne('Request as Department',
		array(
		'local'=> 'dept_id',
		'foreign' => 'id'
		));*/
	}//end setUp

}
?>