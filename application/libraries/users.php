<?php

class Users {
    var $CI;
    function __construct() {
        parent::__construct();
        $this->CI=&get_instance();
        }
        function confirm($labref,$user_id){
            $labref=  $this->uri->segment(3);
            $user_id=  $this->session->userdata('user_id');
            if($this->Signature_table->getuser($labref,$user_id)){
                return true;
            }
            return false;
        }

}
?>
