<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Testing {
  var $CI;
  
    function sample_issuance($labref){
        $CI =& get_instance();
        $CI->load->database(); 
       return $this->db->get('sample_issuance');
   }
   function tests_done($labref){
       
   }

}
?>
