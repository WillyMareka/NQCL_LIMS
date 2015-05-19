<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Db_Backup extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function perform_backup(){
        $backup_folder='database_backup';
        $prefs=array(
          'format'=>'gzip',
          'filename'=>'nqcl.sql',
          'add_drop'=>TRUE,
          'add_insert'=>TRUE,
          'newline'=>"\n"
      );
        $this->load->dbutil();
        $backup=& $this->dbutil->backup($prefs);
        $this->load->helper('file');
        write_file($backup_folder.'/NQCLdb-'.date('d-m-Y-H-i-s').'.gz', $backup);
        echo 'Database successfully backed up';
    }
   
    

}
