<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Pdf extends CI_Controller {

    function __construct() {
        parent::__construct();

        $rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
        $rendererLibrary = 'DOMPDF';
        $rendererLibraryPath = $rendererLibrary;
        if (!PHPExcel_Settings::setPdfRenderer(
                        $rendererName, $rendererLibraryPath
                )) {
            die(
                    'Please set the $rendererName and $rendererLibraryPath values' .
                    PHP_EOL .
                    ' as appropriate for your directory structure'
            );
        }
    }

}
