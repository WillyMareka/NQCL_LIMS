<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Excel_reading extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
        
    }

    public function index() {
       
       $labref= $this->uri->segment(2);
      //$objReader = new PHPExcel_Reader_Excel2007();
      //$objPHPExcel = $objReader->load("excel/'$labref'/'$labref'.xlsx");

       echo $labref; 
    }


}
