<?php

class Testpdf extends MY_Controller {

public function mpdf(){
	$this->load->library('mpdf');
	$html = $this->load->view('requests_made', TRUE);
	$this->mpdf->WriteHTML($html);
	$this->mpdf->Output();
}

}
?>