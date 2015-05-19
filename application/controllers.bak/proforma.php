<?php
class Proforma extends MY_Controller {

function __construct() {
		parent::__construct();	
}

public function index() {
		$this -> getProforma();
}

public function getProforma(){
    $reqid = $this -> uri -> segment(4);
    $data['sample'] = Request::getSample($reqid);
    $data['tests'] = Request_details::getTestsNames($reqid);
    $data['settings_view'] = "proforma_v";
    $this -> base_params($data);
}

public function getProformaPdf(){
    $this->load->library('mpdf');
    $reqid = $this -> uri -> segment(4);
    $data['sample'] = Request::getSample($reqid);
    $data['tests'] = Request_details::getTestsNames($reqid);
    $data['settings_view'] = "proforma_v";
    $this -> base_params($data);
    //$this->session->set_userdata($data);
    $html = $this->load->view('proforma_v', $data, TRUE);
    $this->mpdf->WriteHTML($html);
    $this->mpdf->Output();
}

public function getQuotationProforma(){
    $reqid = $this -> uri -> segment(4);
    $data['sample'] = Quotations::getSample($reqid);
    $data['tests'] = Q_request_details::getTestsNames($reqid);
    $data['settings_view'] = "q_proforma_v";
    $this -> base_params($data);
}

public function base_params($data) {
		$data['title'] = "Proforma Invoice";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "proforma";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "Proforma Invoice";
		$data['link'] = "settings_management";
		$this -> load -> view('template', $data);
	}

public function pdf(){
	 $this->load->helper(array('dompdf', 'file'));
	 $this ->load->helper('file');
     // page info here, db calls, etc.     
     //$data = "123456789";
     $html = "<html><head></head><body><p>Dom PDF</p></body></html>"; 
     //this->load->view('proforma_v',$data, true);
     //pdf_create($html, 'proforma');
     //or
     $data = pdf_create($html, '', false);
     write_file('pdfdom', $data);
     //if you want to write it to disk and/or send it as an attachment 
}	

}

?>