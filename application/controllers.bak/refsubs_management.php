<?php

class Refsubs_management extends CI_Controller {

        public function printPdfLabel(){

            //DOMpdf initialization
            require_once("application/helpers/dompdf/dompdf_config.inc.php");
            $this->load->helper('dompdf', 'file');
            $this->load->helper('file');

            //DOMpdf configuration
            $dompdf = new DOMPDF();
            $dompdf->set_paper(array(0, 0, 316.8, 432));

            //Initialize Array to hold tests
            $refsubs_data = [];

            //Get array of all uri segments
            $rsid_array = $this -> uri -> segment_array();

            /*Loop through said array above, if index of array element is greater than 4 (where tests uri start)
            push element into tests[] array */
            
            foreach ($rsid_array as $key => $value) {
                if ($key > 4) {

                    //Get data for each individual standard
                    $data = Refsubs::getRefSubArray($value);

                    //Push gotten data into new array
                    array_push($refsubs_data, $data);
                }    
            }

            //Variable assignment
            $saveTo = './labels/refsubs/';
            $id = $this -> uri -> segment(5);
            $data['refsub'] = $refsubs_data;
            $data['prints_no'] = $this -> uri -> segment(3);
            $label_id = $this -> uri -> segment(4);
            $labelname = "Label".date('Ymd').$label_id.".pdf";
            $data['settings_view'] = "refsub_label";
            $this->base_params($data);
            $html = $this->load->view('refsub_label', $data, TRUE);
            $dompdf -> load_html($html);
            $dompdf -> render();
            write_file($saveTo . "/".$labelname, $dompdf->output());
            //$this -> setLabelStatus($reqid, $saveTo, $labelname);
        }


        public function delete(){
            
            //Get array of all uri segments
            $rsid_array = $this -> uri -> segment_array();

            foreach ($rsid_array as $key => $value) {
                
                //If the key is greater than 2 i.e is one of the the ids
                if ($key > 2) {

                    //Run delete
                    $this -> db -> delete('refSubs', array('id' => $value));

                }    
            }

        }

        public function printLabelView(){
            $data['id'] = $this -> uri -> segment(3);
            $id = $data['id']; 
            $data['code'] = $this -> uri -> segment(4);
            $data['content_view'] = "refsub_label_view";
            $data['refsub'] = Refsubs::getRefSubArray($id);
            $this -> load -> view ("template1", $data);
        }

        public function base_params($data) {

            $data['styles'] = array("jquery-ui.css");
            $data['scripts'] = array("jquery-ui.js");
            $data['scripts'] = array("SpryAccordion.js");
            $data['styles'] = array("SpryAccordion.css");
            $data['quick_link'] = "request";
            $data['content_view'] = "settings_v";
            $data['banner_text'] = "NQCL Settings";
            $data['link'] = "settings_management";
            $this->load->view('template', $data);
        }
}
?>