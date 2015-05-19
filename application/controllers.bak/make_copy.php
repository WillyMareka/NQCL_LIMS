<?php

class Make_copy extends CI_Controller{
    
    public function index() {
        $this->load->view('make_copy_v');
    }
    public function make_copy1(){
         $rand= 'NQCLA_'.date('d-M-Y');
        
        $target_file = "excel/test12-Oct-12.xlsx";
        $target_copy = "excel/".$rand.".xlsx";
        
        copy($target_file, $target_copy);
        
        if(file_exists($target_file)){
            echo "Success: $target_file has been made";
        }else{
            echo "Failure: $target_file does not exist or could not be found";
        }
    }
    
    
    
}
