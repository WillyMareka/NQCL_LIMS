<?php

class Dosage_form extends Doctrine_Record {
	
	public function setTableDefinition(){
	
	$this->hasColumn('name','varchar', 22);	
		
	}
	
	public function setUp(){
		
	$this ->setTableName('dosage_form');	
		
	}
	
	
	public static function getAll(){
		
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('dosage_form');
		$dosageforms = $query -> execute();
		return $dosageforms;
	}
	
	
	
	public static function getDosageName($df_id){
		
		$query = Doctrine_Query::create()
		-> select('name')
		-> from('dosage_form')
		-> where('id =?', $df_id);
		$dfnames =$query -> execute() -> toArray();
		return $dfnames;
	}
	
}

	


?>