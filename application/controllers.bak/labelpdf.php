<?php 

class Labelpdf extends MY_Controller {

public function index(){
   		
   		if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


    $this->load->library('mpdf');
    $reqid = $this -> input -> post("reqid");
    $prints_no = $this -> input -> post("prints_no");

    
    $labelname = "Label" . $reqid;
    $data['infos'] =Request::getSample($reqid);
    $data['settings_view'] = "tests_label_v";
    $this -> base_params($data);
    //$this->session->set_userdata($data);
    $html = $this->load->view('tests_label_v', $data, TRUE);
    $this->mpdf->WriteHTML($html);
    $this->mpdf->Output();
}

	
}




?>