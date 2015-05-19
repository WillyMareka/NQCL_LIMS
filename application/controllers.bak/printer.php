<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Printer extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function printdata(){
        
	/* get the sample text */
	$lipsum = file_get_contents('what.txt');
	
	/* open a connection to the printer */
	$printer = printer_open("PDFCreator");
	printer_start_doc($printer, "Doc");
	printer_start_page($printer);
	
	/* font management */
	$barcode = printer_create_font("Free 3 of 9 Extended", 400, 200, PRINTER_FW_NORMAL, false, false, false, 0);
	$arial = printer_create_font("Arial", 148, 76, PRINTER_FW_MEDIUM, false, false, false, 0);
	
	/* write the text to the print job */
	printer_select_font($printer, $barcode);
	printer_draw_text($printer, "*123456*", 50, 50);
	printer_select_font($printer, $arial);
	printer_draw_text($printer, "123456", 250, 500);
	
	/* font management */
	printer_delete_font($barcode);
	printer_delete_font($arial);
	
	/* close the connection */
	printer_end_page($printer);
	printer_end_doc($printer);
	printer_close($printer);


    }

}

