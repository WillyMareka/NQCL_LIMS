<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');




require_once APPPATH . "/third_party/docx/classes/CreateDocx.inc";

class Docx extends CreateDocx {

    function __construct() {
        parent::__construct();
    }

}
