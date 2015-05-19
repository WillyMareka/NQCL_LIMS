<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Sample_location extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    public function index() {
       // $labref=  $this->uri->segment(3);
        $data['settings_view']='sample_locator_v';
        $data['location']=  $this->getSampleLocation();
        //$data['gps_location']=  $this->gps($labref);
        $this->base_params($data);
    }
    function getSampleLocation(){
        return $this->db->get('worksheet_tracking')->result();
    }
    function gps($labref){
       $query=$this->db->where('labref',$labref)->get('worksheet_tracking')->result();
       echo json_encode($query);
       
    }

    public function base_params($data) {
        $data['title'] = "Sample Locator - GPS";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        $data['link'] = "settings_management";
        $this->load->view('template', $data);
    }


}
?>
