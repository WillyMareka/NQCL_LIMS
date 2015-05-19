<?php

class Sample_summary extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('labref', 'varchar', 20);
		$this -> hasColumn('test_id', 'int', 11);
                $this -> hasColumn('average', 'varchar', 100);
                $this -> hasColumn('rsd', 'varchar', 100);
                $this -> hasColumn('n', 'varchar', 100);
                $this -> hasColumn('remarks', 'varchar', 100);              
		$this -> hasColumn('compedia', 'varchar', 100);
		$this -> hasColumn('specification', 'varchar', 100);
                $this -> hasColumn('determination', 'varchar', 100);
	}

	public function setUp() {
		$this -> setTableName('sample_summary');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("sample_summary");
		$coaData = $query -> execute();
		return $coaData;
	}


}
?>