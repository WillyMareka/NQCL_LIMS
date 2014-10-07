<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once APPPATH."third_party/FPDF/fpdf17/fpdf.php"; 

class Fpdf_l extends FPDF{

    function __construct() {
        parent::__construct();
        }

}

