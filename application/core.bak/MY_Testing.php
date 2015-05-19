<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
class MY_Testing extends CI_Controller {
var $name;
    function __construct() {
        $this->name='Alphy';   
    }
     public function showname(){
        return $this->name;
    }

}
?>
