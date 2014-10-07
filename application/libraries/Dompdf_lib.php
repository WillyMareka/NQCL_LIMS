<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once("dompdf/dompdf_config.inc.php");
 
class Dompdf_lib extends Dompdf{
     
    function __construct() {
        parent::__construct();
    }
       
 
}
?>