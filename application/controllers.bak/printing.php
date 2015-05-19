<?php

require APPPATH . 'core/MY_Printer.php';
require 'MPDF57/mpdf.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 

*/class Printing extends MY_Printer {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function clients_printer() {
        $this->printClients();
    }

    function column_printer() {
        $this->print_Columns();
    }

    function standards_printer() {
        $this->print_Standards();
    }

    function request_printer() {
        $this->print_request();
    }

    function pdf() {
        $this->pdfPrinter();
    }

    function get_clients() {
        return $this->db->get('clients')->result();
    }

    function client_list() {
        $data['client_info'] = $this->get_clients();
        $this->load->view('dashboard_views/client_list', $data);
    }

    function htmlrender() {
        error_reporting(0);

        $data['render_data'] = $this->getSamples();
        $html = $this->load->view('dashboard_views/request_v_report', $data, TRUE);
        $mpdf = new mPDF('c', 'A4', '', '', 32, 25, 27, 10, 16, 13);
        

        $mpdf->SetDisplayMode('fullpage');
        $mpdf->setAutoTopMargin ='stretch';
        $mpdf->setAutoBottomMargin ='stretch';

        $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
// LOAD a stylesheet
        $mpdf->SetHTMLHeader("<img src=\"images/nqcl_letter_head.png\"/>",'',true);

        $stylesheet = file_get_contents(APPPATH . 'views/dashboard_views/request_v.css');
        $mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text

        $mpdf->WriteHTML($html, 2);
        $mpdf->SetWatermarkImage('images/nqcl_watermark2.png');
        $mpdf->showWatermarkImage = TRUE;
        $mpdf->SetHTMLFooter("<div id=\"footer\">Quality medicines Protect</div>");
      

        $mpdf->Output('NQCL-CLIENT-LIST_'.date('d-m-y'), 'I');
        exit;
    }
    
      function clientsrender() {
        error_reporting(0);
        $data['client_info'] = $this->get_clients();
        $html=$this->load->view('dashboard_views/client_list', $data,TRUE);

        $mpdf = new mPDF('c', 'A4', '', '', 32, 25, 27, 10, 16, 13);
        

        $mpdf->SetDisplayMode('fullpage');
        $mpdf->setAutoTopMargin ='stretch';
        $mpdf->setAutoBottomMargin ='stretch';

        $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
// LOAD a stylesheet
        $mpdf->SetHTMLHeader("<img src=\"images/nqcl_letter_head.png\"/>",'',true);

        $stylesheet = file_get_contents(APPPATH . 'views/dashboard_views/clients_list.css');
        
        $mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text

        $mpdf->WriteHTML($html, 2);
        $page_count=$mpdf->page;
        for($i=1;$i<$page_count;$i++){
        $mpdf->SetWatermarkImage('images/nqcl_watermark2.png',0.3);
        $mpdf->showWatermarkImage = 1;
        }
        $mpdf->SetHTMLFooter("<div id=\"footer\">Quality medicines Protect</div>");
        

        $mpdf->Output('NQCL-CLIENT-LIST_'.date('d-m-y'), 'I');
        exit;
    }

}
