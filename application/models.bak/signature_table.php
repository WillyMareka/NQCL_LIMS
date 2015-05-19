<?php
class Signature_table extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('labref', 'varchar', 20);
		$this->hasColumn('designation', 'varchar', 50);
		$this->hasColumn('signature_name', 'varchar', 50);
		$this->hasColumn('sign', 'varchar', 50);
		$this->hasColumn('date_signed', 'varchar', 50);
		$this->hasColumn('repeat_status', 'int', 11);
		
	}
	
	public function setUp() {
		$this->setTableName('siganture_table');		
		
	}	
	
		
	
        
	
	
}
