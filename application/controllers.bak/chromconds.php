<?php

class Chromconds extends MY_Controller {

    public function index() {

        $data = array();
        $data['settings_view'] = "chromconds_v";
        $this->base_params($data);
    }    
        public function get_column_number() {
        $Q = $this->db->get('column_data');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['column_no'];
                // $data[$row['id']] = $row['id'];
                
            }
        }
        $Q->free_result();
       echo json_encode( $data);
    }
    
         public function get_column_type() {
          $column_no=$this->input->post('columno');
             //$this->input->post('columno');
      //  $Q = $this->db->get('column_data');
          $res=  mysql_query("SELECT column_type FROM column_data WHERE column_no='$column_no'");
          while ($row = mysql_fetch_array($res)) {
              $data =$row['column_type'];
          }
         echo json_encode(data);
    }   

    public function base_params($data) {
        $data['title'] = "Column Details";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        //$data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}

?> 