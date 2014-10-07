<?php

class Request_Management extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->listing();
    }

    function GetAutocomplete($options = array()) {
        $this->db->distinct();
        $this->db->select('name');
        $this->db->like('name', $options['name'], 'after');
        $query = $this->db->get('clients');
        return $query->result();
    }

    //Function to feed quote form lightbox - where documentation enter quoted amount.
    function quote(){
        $data['reqid'] = $this -> uri -> segment(3);
        $data['request'] = Request::getSingleHydrated($data['reqid']);
        $data['content_view'] = "quote_form_v";
        $this->load->view("template1", $data);
    }

    //Function to save quoted amount to Dispatch Register
    function saveQuote(){
       $quoted_amount = $this -> input -> post('quoted_amount'); 
       $negative_credit = -1 * $quoted_amount ;
       $reqid = $this -> uri -> segment(3);
       $clientid = $this -> uri -> segment(4);
       $quotation_status = "1"; 
       $quotedamountUpdate = array('quotation_status' => $quotation_status,
                                    'amount' => $quoted_amount);
       $this -> updateDispatchRegister($reqid, $quotedamountUpdate, $quotation_status, $clientid, $quoted_amount);
    }

    //Function to update Dispatch Register
    function updateDispatchRegister($reqid, $quotedamountUpdate, $quotation_status, $clientid, $negative_credit){

        //Update Dispatch Register
        $this->db->where('request_id', $reqid);
        $this->db->update('dispatch_register', $quotedamountUpdate);
        
        //Update Request
        $this -> db -> where('request_id', $reqid);
        $this -> db -> update('request', array('quotation_status' => $quotation_status));

        //Update Client Credit
        $this -> db -> where('Clientid', $clientid);
        $this -> db -> update('clients', array('credit' => $negative_credit));

    
    }

    function GetAutocompleteActiveIngredients($options = array()) {
        $this->db->distinct();
        $this->db->select('active_ing');
        $this->db->like('active_ing', $options['active_ing'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function active_ingredient_suggestions() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetAutocompleteActiveIngredients(array('active_ing' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->active_ing);

        echo json_encode($keywords);
    }

    function GetAutocompleteManufacturer($options = array()) {
        $this->db->distinct();
        $this->db->select('manufacturer_name');
        $this->db->like('manufacturer_name', $options['manufacturer_name'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function manufacturer_suggestions() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetAutocompleteManufacturer(array('manufacturer_name' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->manufacturer_name);

        echo json_encode($keywords);
    }

    function GetAuthorizer($options = array()) {
        $this->db->distinct();
        $this->db->select('dsgntr');
        $this->db->like('dsgntr', $options['dsgntr'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function Authorizer_suggestions() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetAuthorizer(array('dsgntr' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->dsgntr);

        echo json_encode($keywords);
    }

    function GetDesignation($options = array()) {
        $this->db->distinct();
        $this->db->select('dsgntn');
        $this->db->like('dsgntn', $options['dsgntn'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function Designation_suggestions() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetDesignation(array('dsgntn' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->dsgntn);

        echo json_encode($keywords);
    }

    function suggestions() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetAutocomplete(array('name' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->name);

        echo json_encode($keywords);
    }

    function GetAutocompleteManufacturerAddress($options = array()) {
        $this->db->distinct();
        $this->db->select('manufacturer_add');
        $this->db->like('manufacturer_add', $options['manufacturer_add'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function suggestions1() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetAutocompleteManufacturerAddress(array('manufacturer_add' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->manufacturer_add);

        echo json_encode($keywords);
    }

    function GetLabelClaim($options = array()) {
        $this->db->distinct();
        $this->db->select('label_claim');
        $this->db->like('label_claim', $options['label_claim'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function suggestions2() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetLabelClaim(array('label_claim' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->label_claim);

        echo json_encode($keywords);
    }

    function GetProductName($options = array()) {
        $this->db->distinct();
        $this->db->select('product_name');
        $this->db->like('product_name', $options['product_name'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function suggestions3() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetProductName(array('product_name' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->product_name);

        echo json_encode($keywords);
    }

    function getCodes() {
        $ref = $this->uri->segment(3);
        $ref = str_replace('%20', '_', $ref);
        $codes = Clients::getClientDetails($ref);
        echo json_encode($codes);
    }

    function pushCodes() {
        $codes = $this->getCodes();
        $codes_array = array();

        foreach ($codes as $code)
            array_push($codes_array, $code->code);
        echo json_encode($codes_array);
    }

    //Get Manufacturer Details

     function getManufacturerDetails() {
        //Pass Manufacturer Name at end of Uri
        $ref = $this->uri->segment(3);

        //Replace Spaces with Underscore
        $ref = str_replace('%20', '_', $ref);

        //Get Array of Manufacturer Details from Request Table
        $codes = Request::getManufacturerDetail($ref);

        //Encode received array into json
        echo json_encode($codes);
    }

    function getAuthorizerDetails() {
        //Pass Manufacturer Name at end of Uri
        $ref = $this->uri->segment(3);

        //Replace Spaces with Underscore
        $ref = str_replace('%20', '_', $ref);

        //Get Array of Manufacturer Details from Request Table
        $codes = Request::getAuthorizerDetail($ref);

        //Encode received array into json
        echo json_encode($codes);
    }


    function getProductDetails() {
        //Pass Manufacturer Name at end of Uri
        $ref = $this->uri->segment(3);

        //Replace Spaces with Underscore
        $ref = str_replace('%20', '_', $ref);

        //Get Array of Manufacturer Details from Request Table
        $codes = Request::getProductDetail($ref);

        //Encode received array into json
        echo json_encode($codes);
    }




    function pushManufacDetails() {
        $codes = $this->getCodes();
        $codes_array = array();

        foreach ($codes as $code)
            array_push($codes_array, $code->code);
        echo json_encode($codes_array);
    }    

    function suggestions4() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetProductDescription(array('description' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->description);

        echo json_encode($keywords);
    }

    function GetProductDescription($options = array()) {
        $this->db->distinct();
        $this->db->select('description');
        $this->db->like('description', $options['description'], 'after');
        $query = $this->db->get('request');
        return $query->result();
    }

    function make_oos($labref) {
        $this->db->where('request_id', $labref)->update('request', array('oos' => '1'));
        redirect('supervisors/home/' . $labref);
    }

    public function test_methods() {
        $reqid = $this->uri->segment(3);
        $data['tests'] = Request_details::getTests($reqid);
        $data['settings_view'] = "tests_methods_v";
        $this->base_params($data);
    }

    public function coPackageSave() {

        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        $reqid = $this->uri->segment(3);
        $no_of_packs = $this->input->post("no_of_packs", TRUE);


        for ($i = 1; $i <= $no_of_packs; $i++) {
            $copack = new Copackages();
            $copack->request_id = $reqid;
            $copack->pack_no = $i;
            $copack->no_of_packs = $no_of_packs;
            $copack->save();
        }
    }

    public function label_form(){
        $data['reqid'] = $this -> uri -> segment(3);
        $data['tests'] = Request_details::getTestHistory($data['reqid']);
        $data['content_view'] = "label_form_v";
        $this->load->view("template1", $data);
    }

    public function generate_label(){
        $data['title'] = "Generate Label";
        $data['wetchemistry'] = Tests::getWetChemistry();
        $data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
        $data['medicaldevices'] = Tests::getMedicalDevices();
        $data['reqid'] = $this -> uri -> segment(3);
        $data['tests'] = Request_details::getTestHistory($data['reqid']);
        $data['content_view'] = "label_generate_v";
        $this->load->view("template1", $data);
    }

    public function coPackageDetailsSave() {
        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        $reqid = $this->uri->segment(3);
        $name = $this->input->post('cp_name', TRUE);
        $batch_no = $this->input->post('cp_batch_no', TRUE);
        $exp_date = $this->input->post('cp_exp_date', TRUE);
        $mfg_date = $this->input->post('cp_mfg_date', TRUE);
        $quantity = $this->input->post('cp_quantity', TRUE);
        $unit = $this->input->post('cp_unit', TRUE);


        $copack = new Copackages();
        $copack->name = $name;
        $copack->request_id = $reqid;
        $copack->batch_no = $batch_no;
        $copack->exp_date = date('y-m-d', strtotime($exp_date));
        $copack->mfg_date = date('y-m-d', strtotime($mfg_date));
        $copack->quantity = $quantity;
        $copack->unit = $unit;
        $copack->save();
    }

    public function getTestMethods() {
        $testid = $this->uri->segment(3);
        $methods = Test_methods::getMethods($testid);
        echo json_encode($methods);
    }

    public function getMethodTypes() {
        $types = Test_methods_types::getAll();
        echo json_encode($types);
    }

    public function history() {

        $reqid = $this->uri->segment(3);
        $version_id = $this->uri->segment(4);
        //$data['row_count'] = Request::getRowCount();
        $data['history'] = Request::getHistory($reqid, $version_id);
        //$this -> view -> load('history_table');
        //$data['test_history'] = Request_details::testHistory($reqid, $version_id);
        //$data['settings_view'] = "history";
        $this->load->view('history', $data);
    }

    public function other_history() {

        $reqid = $this->uri->segment(3);
        $version_id = $this->uri->segment(4);
        //$data['row_count'] = Request::getRowCount();
        $data['chistory'] = Clients::getHistory($reqid, $version_id);
        $data['thistory'] = Request_details::getTestHistory($reqid, $version_id);
        //$this -> view -> load('history_table');
        //$data['test_history'] = Request_details::testHistory($reqid, $version_id);
        //$data['settings_view'] = "history";
        $this->load->view('other_history', $data);
    }

    public function getLabelPdf_standalone(){

        //DOMpdf initialization
        require_once("application/helpers/dompdf/dompdf_config.inc.php");
        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->set_paper(array(0, 0, 316.8, 432));

        //Initialize Array to hold tests
        $tests = [];

        //Get array of all uri segments
        $t_array = $this -> uri -> segment_array();

        /*Loop through said array above, if index of array element is greater than 4 (where tests uri start)
        push element into tests[] array */
        
        foreach ($t_array as $key => $value) {
            if ($key > 4) {
                array_push($tests, $value);
            }    
        }

        //Variable assignment
        $saveTo = './labels';
        $data['tests'] = $tests;
        $data['reqid'] = $this-> uri -> segment(3);
        $reqid = $data['reqid'];
        $data['prints_no'] = $this -> uri -> segment(4); 
        $labelname = "Label" . $data['reqid'] . ".pdf";
        $data['settings_view'] = "label_view_standalone";
        $this->base_params($data);
        $html = $this->load->view('label_view_standalone', $data, TRUE);
        $dompdf->load_html($html);
        $dompdf->render();
        write_file($saveTo . "/" . $labelname, $dompdf->output());
        $this -> setLabelStatus($reqid, $saveTo, $labelname);
        //$this -> output -> enable_profiler(TRUE);
    }

    public function getLabelPdf() {

        require_once("application/helpers/dompdf/dompdf_config.inc.php");

        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        $dompdf = new DOMPDF();
		$dompdf->set_paper(array(0, 0, 316.8, 432));

        $saveTo = './labels';
        $data['reqid'] = $this->uri->segment(3);
        $reqid = $data['reqid'];
        $data['prints_no'] = $this->uri->segment(4);
        $labelname = "Label" . $data['reqid'] . ".pdf";
        $data['infos'] = Request::getSample($data['reqid']);
        $data['settings_view'] = "label_view2";
        $this->base_params($data);
        $html = $this->load->view('label_view2', $data, TRUE);

        $dompdf->load_html($html);
        $dompdf->render();
        write_file($saveTo . "/" . $labelname, $dompdf->output());
        $this -> setLabelStatus($reqid, $saveTo, $labelname);
    }

    public function setLabelStatus($reqid, $saveTo, $labelname){
        $file = $saveTo ."/".$labelname;
        if (file_exists($file)) {
           $label_status = "1";
        }
        else{
            $label_status = "0";
        }

        //Update request table with label status
        $this->db->where('request_id', $reqid);
        $this->db->update('request', array('label_status' => $label_status));
    }

    public function edit_view() {
        $data['requests'] = Request::getAll();
        $this->load->view("requests_v_ajax", $data);
    }

    public function requests_list() {
        $request = Request::getAllHydrated();
        foreach ($request as $r) {
            $data[] = $r;
        }
        echo json_encode($data);
    }

    public function oos_requests_list() {
        $request = Request::getAllHydrated_Oos();
        foreach ($request as $r) {
            $data[] = $r;
        }
        echo json_encode($data);
    }

    public function getRequest() {
        $reqid = $this->uri->segment(3);
        $request = Request::getSingleHydrated($reqid);
        echo json_encode($request);
    }

   public function setPresentationDescription() {
        $reqid = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $presentation = $this->input->post("presentation");
        $description = $this->input->post("description");
        $worksheet_url = $this->input->post("worksheet_url");

        $desc_status = '1';

        $this->session->set_userdata('wksht_url', $worksheet_url);
        $presentation_description_update = array(
            'description' => $description,
            'presentation' => $presentation
        );

        $sample_issuance_update = array(
            'desc_status' => $desc_status
        );

        $s_array = array(
            'lab_ref_no' => $reqid
        );

        $this->db->where($s_array);
        $this->db->update('sample_issuance', $sample_issuance_update);

        $this->db->where('request_id', $reqid);
        $this->db->update('request', $presentation_description_update);

        //Get all tests
        $all_tests = Request_details::getTestIds($reqid);

        //Get Client Id
        $client_id_info = Request::getClientId($reqid);
        $client_id = $client_id_info[0]['client_id'];

        //Loop through tests gotten and save an entry per iteration in the invoice billing table.
        foreach($all_tests as $test){

            //Get charges for tests that do not require specification of method
            $test_charges = Tests::getCharges($test['test_id']);

            //Make entries in Invoice Billing Table
            $cb = new Invoice_billing();
            $cb->request_id = $reqid;
            $cb->client_id = $client_id;
            $cb->test_id = $test['test_id'];
            if (!empty($test_charges)) {
                $cb->test_charge = $test_charges[0]['Charge'];
            }
            if($test['test_id'] == 6){
                $cb->method_charge = 2000;
                $cb->method_id = 31;
            }
            $cb->save();
        }

    }
   
   

    public function getClientInfo() {
        $id = $this->uri->segment(3);
        $id = Clients::getClientInfo($id);
        echo json_encode($id);
    }

    function Assigned_samples() {
        $data['settings_view'] = "request_v_ds";
        $data['info'] = $this->getAssigned();
        $data['title'] = "Assigned Samples";
        $this->base_params($data);
    }

    function Review_samples() {
        $data['settings_view'] = "request_v_rs";
        $data['info'] = $this->getReview();
        $data['title'] = "Review Samples";
        $this->base_params($data);
    }
    
       function Draft_certificate_samples() {
        $data['settings_view'] = "request_v_ds_1";
        $data['info'] = $this->getDraftCert();
        $data['title'] = "Draft Certificate Samples";
        $this->base_params($data);
    }
    
      function getDraftCert() {
        return $this->db->where('stat', 0)->get('draft_samples')->result();
    }

    function getAssigned() {
        return $this->db->where('stat', 0)->get('assigned_samples')->result();
    }

    function getReview() {
        return $this->db->where('stat', 0)->get('review_samples')->result();
    }

    function complete($labref) {
        $this->db->where('labref', $labref)->update('assigned_samples', array('a_stat' => 1));

        $supervisor = $this->getSupervisor($labref);
        $from = $supervisor[0]->analyst_name;
        $date = date('d-M-Y H:i:s');
        $activity = 'Documentation - Awaiting review';
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => 'Documentation',
            'date' => $date,
            'stage' => '6',
            'current_location' => 'Documentation'
        );
        $this->db->where('labref', $labref)->update('worksheet_tracking', $array_data);
        $this->db->where('labref', $labref)->update('assigned_samples', array('date_time_returned' => $date));
        redirect('request_management/assigned_samples');
    }
    
    function confirm_completion($labref){   
        $date = date('d-M-Y H:i:s');
      $this->db->where('labref', $labref)->update('draft_samples', array('a_stat' => 3,'date_time_completed'=>$date));
              $supervisor = $this->getSupervisor($labref);
        $from = $supervisor[0]->analyst_name;
        
        $activity = 'Printed and Archieved';
        $array_data = array(
            'activity' => $activity,
            'from' => 'Documentation',
            'to' => 'Documentation',
            'date_added' => $date,
            'stage' => '12',
            'current_location' => 'Documentation'
        );
        $this->db->where('labref', $labref)->update('worksheet_tracking', $array_data);
         redirect('request_management/Draft_certificate_samples/');

  
    }

    public function getSupervisor($labref) {
        // $user_id = $this->session->userdata('user_id');
        $this->db->select('analyst_name');
        $this->db->where('labref', $labref);
        $query = $this->db->get('assigned_samples');
        return $result = $query->result();
    }

    public function SendToReviewer() {

        $labref = $this->uri->segment(3);
        $reviewer_name = $this->input->post('reviewer');

        $data = array(
            'labref' => $labref,
            'analyst_name' => $reviewer_name,
            'date_time' => date('d-m-Y H:i:s'),
        );
        $this->db->insert('review_samples', $data);
        $this->db->where('labref', $labref)->update('assigned_samples', array('stat' => 1));
        //redirect('request_management/assigned_samples');
    }
    
        public function SendToReviewer_r() {

        $labref = $this->uri->segment(3);
        $reviewer_name = $this->input->post('reviewer');

        $data = array(
            'labref' => $labref,
            'analyst_name' => $reviewer_name,
            'date_time' => date('d-m-Y H:i:s'),
        );
        $this->db->insert('review_samples', $data);
        $this->db->where('labref', $labref)->update('review_samples', array('stat' => 1));
        //redirect('request_management/assigned_samples');
    }

    public function listing() {
        //$data = array();
        $data['title'] = "Request Management";
        $data['settings_view'] = "requests_v_ajax";
        $data['info'] = Request::getAll();
        $this->base_params($data);
    }

//end listing

    function ajax_loader() {
        $this->db->select_max('id');
        $query = $this->db->get('request');
        $data = $query->result();
        echo json_encode($data);
    }

    function ajax_client_loader() {
        $this->db->select_max('id');
        $query = $this->db->get('clients');
        $data = $query->result();
        return $data;
    }

    public function add() {
        $data['new_clientid'] = $this->ajax_client_loader();
        $data['months'] = Months::getAll();
        $data['title'] = "Add New Request";
        $data['last_req_id'] = Request::getLastRequestId();
        $data['lastClient'] = Clients::getLastId();
        //var_dump($data['last_req_id']);
        $data['dosageforms'] = Dosage_form::getAll();
        $data['packages'] = Packaging::getAll();
        $data['usertypes'] = User_type::getAll();
        $data['clients'] = Clients::getAll();
        $data['sample_id'] = Sample_Information::getAll();
        $data['wetchemistry'] = Tests::getWetChemistry();
        $data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
        $data['medicaldevices'] = Tests::getMedicalDevices();
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("jquery.ui.core.js", "jquery.ui.datepicker.js", "jquery.ui.widget.js");
        $data['styles'] = array("jquery.ui.all.css");
        $data['settings_view'] = "request_v";
        $this->base_params($data);
    }

//end add

    public function edit() {
        $reqid = $this->uri->segment(3);
        $data['reqid'] = $this->uri->segment(3);
        $data['tests_checked'] = Request_details::getTestsNames($reqid);
        $data['title'] = "Edit Request";
        $data['tests_issued'] = Sample_issuance::getIssuedTests2($reqid);
        $data['months'] = Months::getAll();
        $data['packages'] = Packaging::getAll();
        $data['dosageforms'] = Dosage_form::getAll();
        $data['wetchemistry'] = Tests::getWetChemistry();
        $data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
        $data['medicaldevices'] = Tests::getMedicalDevices();
        $data['client'] = Clients::getClient2($reqid);
        $data['request'] = Request::getSingleHydrated($reqid);
        $data['settings_view'] = "edit_request_v";
        $data['info'] = Request::getAll();
        $this->base_params($data);
    }

    public function edit_save(){

        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        $reqid = $this -> input -> post("lab_ref_no");
        $dateformat = $this->input->post("dateformat");
        $test = $this->input->post("test");
        $cid = $this->input->post("client_id");
        $product_name = $this->input->post("product_name");
        $dosage_form = $this->input->post("dosage_form");
        $manufacturer_name = $this->input->post("manufacturer_name");
        $manufacturer_address = $this->input->post("manufacturer_address");
        $batch_no = $this->input->post("batch_no");
        if ($dateformat == 'dmy') {
            $expiry_date = $this->input->post("date_e");
            $manufacture_date = $this->input->post("date_m");
        } else if ($dateformat == 'my') {
            $ed = "31 " . $this->input->post("e_date");
            $md = "01 " . $this->input->post("m_date");
            $expiry_date = str_replace(' ', '-', $ed);
            $manufacture_date = str_replace(' ', '-', $md);
        }
        $label_claim = $this->input->post("label_claim");
        $active_ingredients = $this->input->post("active_ingredients");
        $quantity = $this->input->post("quantity");
        $applicant_reference_number = $this->input->post("applicant_reference_number");
        $client_number = $this->input->post("ndqno");
        $designator_name = $this->input->post("designator_name");
        $designation = $this->input->post("designation");
        $designation_date = $this->input->post("designation_date");
        $urgency = $this->input->post("urgency");
        $edit_notes = $this->input->post("edit_notes");
        $country_of_origin = $this->input->post("country_of_origin");
        $product_lic_no = $this->input->post("product_lic_no");
        $presentation = $this->input->post("presentation");
        $description = $this->input->post("description");
        $clientsampleref = $this->input->post("client_ref_no");
        $packaging = $this->input->post("packaging");

        //Request Update Array
        $request_update_array = array(
            'client_id' => $cid,
            'sample_qty' => $quantity,
            'product_name' => $product_name,
            'label_claim' => $label_claim,
            'active_ing' => $active_ingredients,
            'Dosage_form' => $dosage_form,
            'Manufacturer_name' => $manufacturer_name,
            'Manufacturer_add' => $manufacturer_address,
            'Batch_no' => $batch_no,
			'exp_date' => date('Y-m-d', strtotime($expiry_date)),
            'Manufacture_date' =>  date('Y-m-d', strtotime($manufacture_date)),
            'Designator_Name' => $designator_name,
            'Designation_date' => date('Y-m-d', strtotime($designation_date)),
            'Urgency' => $urgency,
            'edit_notes' => $edit_notes,
            'clientsampleref' => $clientsampleref
        );


        //Update main request table
        $this -> db -> where(array('request_id' => $reqid));
        $this -> db -> update('request', $request_update_array);


        //Delete existing tests
        $this -> db -> where(array('request_id' => $reqid));
        $this -> db -> delete('request_details');

        //Update new tests
        for ($i = 0; $i < count($test); $i++) {
            //Save tests selected.

            $request = new Request_details();
            $request->test_id = $test[$i];
            $request->request_id = $reqid;
            $request->save();

            //Check to see department the test belongs to
            $dept = Tests::getDepartments($test[$i]);

            //Push department of test into an array depts
            //$depts[] = $dept[0]['Department'];
        }

    }

    public function getTestName() {
        $test_id = $this->uri->segment(3);
        $test = Tests::getTestName3($test_id);
        foreach ($test as $t) {
            $data[] = $t;
        }
        echo json_encode($data);
    }

    public function save() {


        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        $dsgntr = $this->input->post("dsgntr");
        $dsgntn = $this->input->post("dsgntn");
        $moa = $this->input->post("moa");
        $crs = $this->input->post("crs");

        $dateformat = $this->input->post("dateformat");
        $test = $this->input->post("test");
        $cid = $this->input->post("clientid");

        if (!empty($cid)) {
            $clientid = $this->input->post("clientid");
        } else {
            $cid = Clients::getLastId();
            $clientid = $cid[0]['max'] + 1;
        }

        $product_name = $this->input->post("product_name");
        $dosage_form = $this->input->post("dosage_form");
        $manufacturer_name = $this->input->post("manufacturer_name");
        $manufacturer_address = $this->input->post("manufacturer_address");
        $batch_no = $this->input->post("batch_no");
        if ($dateformat == 'dmy') {
            $expiry_date = $this->input->post("date_e");
            $manufacture_date = $this->input->post("date_m");
        } else if ($dateformat == 'my') {
            $ed = "31 " . $this->input->post("e_date");
            $md = "01 " . $this->input->post("m_date");
            $expiry_date = str_replace(' ', '-', $ed);
            $manufacture_date = str_replace(' ', '-', $md);
        }
		else if($dateformat == ''){
			$expiry_date = '';
			$manufacture_date = '';
		}
        $label_claim = $this->input->post("label_claim");
        $active_ingredients = $this->input->post("active_ingredients");
        $quantity = $this->input->post("quantity");
        $applicant_reference_number = $this->input->post("applicant_reference_number");
        $client_number = $this->input->post("ndqno");
        $designator_name = $this->input->post("designator_name");
        $designation = $this->input->post("designation");
        $designation_date = $this->input->post("designation_date");
        $urgency = $this->input->post("urgency");
        $edit_notes = $this->input->post("edit_notes");
        $country_of_origin = $this->input->post("country_of_origin");
        $product_lic_no = $this->input->post("product_lic_no");
        $presentation = $this->input->post("presentation");
        $description = $this->input->post("description");
        $clientsampleref = $this->input->post("applicant_reference_number");
        $packaging = $this->input->post("packaging");
        //$full_details_status = 0;
        //Loop through tests, saving each in row of its own in request_details table
        for ($i = 0; $i < count($test); $i++) {
            //Save tests selected.

            $request = new Request_details();
            $request->test_id = $test[$i];
            $request->request_id = $client_number;
            $request->save();

            //Check to see department the test belongs to
            $dept = Tests::getDepartments($test[$i]);

            //Push department of test into an array depts
            $depts[] = $dept[0]['Department'];
        }

        //filter array to include only unique departments
        $dpts = array_unique($depts);

        //Check to see if tests selected are in more than 1 department - this determines the split status
        //If length of the depts array is greater than one, then Sample is split else set to 0, sample is not split.

        if (count($dpts) > 1) {
            $split_status = "1";
            foreach ($dpts as $key => $value) {
                $split = new Split();
                $split->request_id = $client_number;
                $split->dept = $value;
                $split->save();
            }
        } else {
            $split_status = "0";
            foreach ($dpts as $key => $value) {
                $split = new Split();
                $split->request_id = $client_number;
                $split->dept = $value;
                $split->save();
            }
        }

        $request = new Request();
        $request->dsgntn = $dsgntn;
        $request->dsgntr = $dsgntr;
        $request->moa = $moa;
        $request->crs = $crs;
        $request->clientsampleref = $clientsampleref;
        $request->dateformat = $dateformat;
        $request->description = $description;
        $request->presentation = $presentation;
        $request->product_lic_no = $product_lic_no;
        $request->country_of_origin = $country_of_origin;
        $request->client_id = $clientid;
        $request->product_name = $product_name;
        $request->Dosage_Form = $dosage_form;
        $request->Manufacturer_Name = $manufacturer_name;
        $request->Manufacturer_add = $manufacturer_address;
        $request->Batch_no = $batch_no;
        //$request -> full_details_status = $full_details_status;
        $request->exp_date = date('Y-m-d', strtotime($expiry_date));
        $request->Manufacture_date = date('Y-m-d', strtotime($manufacture_date));
        $request->label_claim = $label_claim;
        $request->Urgency = $urgency;
        $request->active_ing = $active_ingredients;
        $request->sample_qty = $quantity;
        $request->request_id = $client_number;
        $request->Designator_Name = $designator_name;
        $request->Designation = $designation;
        $request->Designation_date = date('y-m-d', strtotime($designation_date));
        $request->edit_notes = $edit_notes;
        $request->packaging = $packaging;
        $request->split_status = $split_status;
        $request->save();
        $this->run_overal_micro();
        $this->create_sample_folder($client_number);
        $this->create_coa_folder($client_number);
        $this->addSampleTrackingInformation($clientid);


        for ($i = 0; $i < count($test); $i++) {
            $coa = new Coa_body();
            $coa->test_id = $test[$i];
            $coa->labref = $client_number;
            $coa->save();
        }

        $no = "  ";
        $dr = new Dispatch_register();
        $dr->client_id = $clientid;
        $dr->date = date('y-m-d');
        $dr->cert_no = "CAN" . "/" . $no . "/" . date('y');
        $dr->request_id = $client_number;
        $dr->invoice_no = $no . "/" . date('y');
        $dr->save();

        for ($i = 0; $i < count($test); $i++) {
            $test_charges = Tests::getCharges($test[$i]);
            $test_methods = Test_methods::getMethodsHydrated($test[$i]);
            //$method_charges = Test_methods_charges::getMethodCharge($test[$i]);
            $cb = new Client_billing();
            $cb->request_id = $client_number;
            $cb->client_id = $clientid;
            $cb->test_id = $test[$i];
            if (!empty($test_charges)) {
                $cb->test_charge = $test_charges[0]['Charge'];
                $tcharges[] = $test_charges[0]['Charge'];
            }
            //$coa -> total_test_charge = $test_charges[0]['charge'] + $method_charges[0]['charge'];
            $cb->save();
        }

        //Make Entry in Payments table
        $cl = new Payments();
        $cl -> client_id = $clientid;
        $cl -> save();

        $this->saveClientAsUser($clientid);
        //$this-> output->enable_profiler();

    }

    public function testCh() {
        $t = $this->uri->segment(3);
        $test_charges = Tests_charges::getTestCharge($t);
        if (empty($test_charges)) {
            $test_methods = Test_methods::getMethodsHydrated($t);
        }
        var_dump($test_methods[0]['charge']);
    }

    public function checkUserExistsThenSendorError() {
        $user_is = $this->input->post('clientid');
        $this->db->select('id');
        $this->db->where('id', $user_is);
        $query = $this->db->get('clients');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    public function setComponents() {
        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        $multicomponent_status = $this->input->post("multicomponent");
        $components = $this->input->post("component");
        $component_volume1 = $this->input->post("volume1");
        $component_volume1 = $this->input->post("volume1");
        $component_volume2 = $this->input->post("volume2");        
        $component_unit1 = $this->input->post("unit1");
        $component_unit2 = $this->input->post("unit2");
      
        $multistage_status = $this->input->post("multistage");
        $stages_no = $this->input->post("multistage_no");
        //$this->output->enable_profiler();
        //$testid = $this->uri->segment(4);
        $request_id = $this->uri->segment(3);
        //$dissolution_id = '2';

        $stage = new Stages();
        //$stage->test_id = $testid;
        $stage->stages_no = $stages_no;
        $stage->stage_status = $multistage_status;
        $stage->request_id = $request_id;
        $stage->save();

        //Update Multicomponent and Multistage Statuses in the Client Billing Table
        if(empty($component_volume1)){
             $component_status = 0;
        }
        else{
             $component_status = 1;
        }
       
        $component_status_updateArray = array('component_status' => $component_status);
        $cb_cstatus_updateArray = array('component_status' => $multicomponent_status);
        $cb_mstatus_updateArray = array('stage_status' => $multistage_status);
        $dissolution_where_array = array('request_id' => $request_id);
        $component_where_array = array('lab_ref_no' => $request_id);

        $this->db->where($component_where_array);
        $this->db->update('sample_issuance', $component_status_updateArray);

        $this->db->where('request_id', $request_id);
        $this->db->update('client_billing', $cb_cstatus_updateArray);

        $this->db->where($dissolution_where_array);
        $this->db->update('client_billing', $cb_mstatus_updateArray);

        //if($multicomponent_status == '1'){
        for ($i = 0; $i < count($components); $i++) {
            $component = new Components();
            $component->name = $components[$i];

            //If array is not empty then assign to model variables
            if(!empty($component_volume1)){
                $component->volume1 = $component_volume1[$i];
                $component->volume2 = $component_volume2[$i];
                $component->unit1 = $component_unit1[$i];
                $component->unit2 = $component_unit2[$i];
            }
            
            $component->request_id = $request_id;
            $component->save();
        }

        if($multicomponent_status == 1){
            $multi_tests = array(2,5);

            for($j=0; $j < count($multi_tests); $j++){
                for ($i=0; $i < count($components); $i++) {
                    $component = new Invoice_components();
                    $component->component = $components[$i];
                    $component->test_id = $multi_tests[$j];
                    $component->request_id = $request_id;
                    $component->save(); 
                }
            }
            
            //Update multicomponent status in Sample Issuance Table
            $m_status_array = array('multicomponent_status' => $multicomponent_status);

            //Update Sample Issuance with status on whether its multicomponent / not.
            $this->db->where($component_where_array);
            $this->db->update('sample_issuance', $m_status_array);

        }


        //Loop through array of components, saving each to own row in quotations_components table


    }

    public function showComponents() {
        $data['test_name'] = $this->uri->segment(5);
        $data['reqid'] = $this->uri->segment(3);
        $data['test_id'] = $this->uri->segment(4);
        $data['component_status'] = $this->uri->segment(5);
        $data['components'] = Components::getComponents($data['reqid']);
        $data['last_component'] = Components::getLastComponent($data['reqid'], $data['test_id']);
        $data['methods'] = Test_methods::getMethods($data['test_id']);
        $data['content_view'] = "componentsWizard_v";
        $this->load->view('template1', $data);
    }

    public function updateComponents() {

        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        $componentName = $this->input->post("component_name");
        $methodName = $this->input->post("name");
        $methodId = $this->input->post("id");
        $reqid = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);

        $componentsUpdateArray = array(
            'method_id' => $methodId,
            'method_name' => $methodName
        );

        $this->db->where('request_id', $reqid);
        $this->db->insert('components', $componentsUpdateArray);
    }

    public function updateMethods() {

        if (is_null($_POST)) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data was not posted.'
            ));
        } else {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data added successfully',
                'array' => json_encode($_POST)
            ));
        }

        $reqid = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $component_ids = $this->input->post("component_ids");
        $method_status = "1";
        $data['components'] = Components::getComponents($reqid, $test_id);

        //Initialize array to hold method values separated by colon
        $methodsColonArray = array();

        for ($i = 0; $i < count($component_ids); $i++) {
            $post_index = "component" . $component_ids[$i];
            $method_name = $this->input->post($post_index);
            $method_charges = Test_methods::getMethodChargeHydrated($method_name, $test_id);
            if (empty($method_charges)) {
                $method_charge = '0';
                $method_id = '0';
            } else {
                $method_charge = $method_charges[0]['charge'];
                $method_id = $method_charges[0]['id'];
            }

            //Push methods to array
            array_push($methodsColonArray, $method_name);
            
            /*
            /$method_id = $method_charges[0]['id'];	
            /*$methodsUpdateArray = array(
                'method' => $this->input->post($post_index)
            );*/

            $methodsUpdateArray2 = array(
                'method_name' => $this->input->post($post_index)
            );

            $m_array = array(
                'labref' => $reqid,
                'test_id' => $test_id
            );

            $m_array3 = array(
                'request_id' => $reqid,
                'test_id' => $test_id
            );

            $clientBillingWhereArray = array(
                'test_id' => $test_id,
                'request_id' => $reqid
            );

            $clientBillingUpdateArray = array(
                'method_id' => $method_id,
                'method_charge' => $method_charge
            );

            $this->db->where($m_array3);
            $this->db->update('components', $methodsUpdateArray2);

            if(count($component_ids) < 2){
                $this->db->where($clientBillingWhereArray);
                $this->db->update('invoice_billing', $clientBillingUpdateArray);
            }

            if($test_id == 5 || $test_id == 2){

                //Get Component Name
                $c_name = Components::getComponentName($component_ids[$i]);
                $component_name = $c_name[0]['name'];

                $invoice_component_where_array = array(
                    'component' => $component_name,
                    'test_id' => $test_id,
                    'request_id' => $reqid
                );

                $this ->db->where($invoice_component_where_array); 
                $this ->db->update('invoice_components',$clientBillingUpdateArray);
            }
        }

        //Concatenate array elements with colon as separator and assign result to new string variable
        $implodedColonArray = implode(":", $methodsColonArray); 

        //Update method column with newly generated string
        $methodsUpdateArray4 = array(
         'method' => $implodedColonArray
        );

        //Set variable arrays to include update where parameters
        $m_array2 = array(
            'lab_ref_no' => $reqid,
            'test_id' => $test_id
        );
        $m_array3 = array(
            'labref' => $reqid,
            'test_id' => $test_id
        );

        //Update COA Body table.
        $this->db->where($m_array3);
        $this->db->update('coa_body', $methodsUpdateArray4);

        $m_status_array = array('method_status' => $method_status);

        $this->db->where($m_array2);
        $this->db->update('sample_issuance', $m_status_array);
    }

    public function quotation() {

        $reqid = $this->uri->segment(4);
        $methodIdArray = Request_test_methods::getMethods($reqid);
        $testIdArray = Request_details::getTests($reqid);

        foreach ($methodIdArray as $methodArray) {
            $data['method_charges'][] = Test_methods_charges::getCharges($methodArray['test_id']);
        }

        foreach ($testIdArray as $testArray) {
            $data['test_charges'][] = Tests::getCharges($testArray['test_id']);
        }

        /* for($i = 0; $i < count($testIdArray); $i++){
          $data['test_charges'][] = Tests_charges::getCharges($testIdArray[$i]['id']);
          } */

        //var_dump($testIdArray);
        $data['settings_view'] = 'invoice_v';
        $this->base_params($data);
    }

    public function getMethodCharges() {
        $mid = $this->uri->segment(3);
        $data['mcharges'] = Test_methods_charges::getMethodCharges($mid);
        $data['settings_view'] = "mcharges_v";
    }

    public function update() {


        //Variables storing the analysis request variables
        //variable storing the class instance

        $tests = $this->input->post("test");
        $clientid = $this->input->post("client_id");
        $product_name = $this->input->post("product_name");
        $dosage_form = $this->input->post("dosage_form");
        $manufacturer_name = $this->input->post("manufacturer_name");
        $manufacturer_address = $this->input->post("manufacturer_address");
        $batch_no = $this->input->post("batch_no");
        $dateformat = $this->input->post("dateformat");
        $expiry_date = $this->input->post("date_e");
        $manufacture_date = $this->input->post("date_m");
        $label_claim = $this->input->post("label_claim");
        $active_ingredients = $this->input->post("active_ingredients");
        $quantity = $this->input->post("quantity");
        $applicant_reference_number = $this->input->post("client_ref_no");
        $client_number = $this->input->post("lab_ref_no");
        $designator_name = $this->input->post("designator_name");
        $designation = $this->input->post("designation");
        $designation_date = $this->input->post("designation_date");
        $edit_notes = $this->input->post("edit_notes");
        $country_of_origin = $this->input->post("country_of_origin");
        $product_lic_no = $this->input->post("product_lic_no");
        $presentation = $this->input->post("presentation");
        $description = $this->input->post("description");
        $tests_issued = Sample_issuance::getIssuedTests2($client_number);

        //$client_id =  $this -> input -> post("client_id");
        //Variables hold client information
        $client_name = $this->input->post("client_name");
        $client_address = $this->input->post("client_address");
        $client_type = $this->input->post("clientT");
        $contact_person = $this->input->post("contact_person");
        $contact_phone = $this->input->post("contact_phone");
        $client_ref_no = $this->input->post("client_ref_no");

        //Analysis update array holds above variables , later to
        //be passed to update() function (CodeIgniter.)

        $analysis_update_array = array(
            'client_id' => $clientid,
            'product_name' => $product_name,
            'Dosage_form' => $dosage_form,
            'Manufacturer_Name' => $manufacturer_name,
            'Manufacturer_add' => $manufacturer_address,
            'Batch_no' => $batch_no,
            'dateformat' => $dateformat,
            'exp_date' => $expiry_date,
            'Manufacture_date' => $manufacture_date,
            'label_claim' => $label_claim,
            'active_ing' => $active_ingredients,
            'sample_qty' => $quantity,
            'clientsampleref' => $applicant_reference_number,
            'request_id' => $client_number,
            'Designation_date' => $designation_date,
            'edit_notes' => $edit_notes,
            'country_of_origin' => $country_of_origin,
            'product_lic_no' => $product_lic_no,
            'presentation' => $presentation,
            'description' => $description);

        //Array stores client details to be updated
        $client_update_array = array(
            'Name' => $client_name,
            'Address' => $client_address,
            'Client_type' => $client_type,
            'Contact_person' => $contact_person,
            'Contact_phone' => $contact_phone
        );

        //For loop , iterates through array of test ids, updating
        //each accordingly

        for ($i = 0; $i < count($tests); $i++) {

            foreach ($tests_issued as $tests_i) {
                if ($tests[$i] != $tests_i['Test_id']) {
                    $request = new Request_details();
                    $request->test_id = $test[$i];
                    $request->request_id = $client_number;
                    $request->save();
                }
            }
        }

        //Codeigniter where() and update() methods update tables accordingly.
        $this->db->where('request_id', $client_number);
        $this->db->update('request', $analysis_update_array);

        $this->db->where('clientid', $clientid);
        $this->db->update('clients', $client_update_array);

        //User is redirected to the requests listing page.
        redirect("request_management/listing");
    }

    public function edit_history() {
        $reqid = $this->uri->segment(3);
        $data['title'] = "Requests Edit History";
        $data['settings_view'] = "requests_edit_history_v";
        $data['info'] = Request::getHistory($reqid);
        //$data['requestInformation'] = $requestInformation;
        $this->base_params($data);
    }

    public function requests($id) {
        $data['title'] = "Request Information";
        $data['settings_view'] = "requests_v";
        $requestInformation = Request::getRequest($id);
        $data['requestInformation'] = $requestInformation;
        $this->base_params($data);
    }

    public function create_sample_folder($labref) {
        $workbooks = "Workbooks";
        if (is_dir($workbooks)) {
            mkdir($workbooks . "/" . $labref, 0777, true);
            $this->create_workbook($labref);
        }
    }
    
    function checkIfMicroPresence(){
        $tests= $this->input->post('test');
        for($i=0;$i<count($tests);$i++){
            $testid[]=$tests[$i];     
        }
        foreach($testid as $test):
         if($test=='8' ||$test=='9' ||$test=='10' ||$test=='14' ||$test=='15' ||$test=='49'||$test=='50'){
               $data = '1'; 
            }else{
                $data ='0';
            }
        endforeach;
        
        return $data;        
    }
    
    public function registerMicroNumber(){
        $labref = $this->input->post('ndqno');
        $year=date('Y');
        $data =  $this->db->select_max('number')->where('year',$year)->get('microbiology_tracking')->result();
        if(\is_null($data[0]->number)){
            $this->db->insert('microbiology_tracking',array('labref'=>$labref,'year'=>$year,'number'=>001));
        }else{
           $this->db->insert('microbiology_tracking',array('labref'=>$labref,'year'=>$year,'number'=>str_pad($data[0]->number+1, 3, '0', STR_PAD_LEFT)));
        }
    }
    
    function run_overal_micro(){
        $determiner=  $this->checkIfMicroPresence();
        if($determiner =='1'){
            $this->registerMicroNumber();
        }else{
            //echo 'No Microbiology Test Found';
        }
    }

    public function create_workbook($labref) {
        $workbooks = "Workbooks";
        $target = "original_workbook/Template1.xlsx";
        $destination = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        if (is_dir($workbooks . "/" . $labref)) {
            copy($target, $destination);
        }
        //redirect("request_management/listing");
    }

    public function add_sample_to_priority_table() {
        $data = array(
            'labref' => $this->input->post("ndqno"),
            'priority' => 'High'
        );
        $this->db->insert('priority_table', $data);
    }

    public function create_coa_folder($labref) {
        $certificates = "certificates";
        if (is_dir($certificates)) {
            mkdir($certificates . "/" . $labref, 0777, true);
            $this->create_coa($labref);
        }
    }

    public function create_coa($labref) {
        $certificates = "certificates";
        $target2 = "original_coa/coa_template.xlsx";
        $destination2 = "certificates/" . $labref . "/" . $labref . "_COA.xlsx";
        if (is_dir($certificates . "/" . $labref)) {
            copy($target2, $destination2);
        }
        //redirect("request_management/listing");
    }

    public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function addSampleTrackingInformation($clientid) {
        $userInfo = $this->getUsersInfo();
        $client = $this->input->post("client_name");
        $activity = 'Samples Recieving';
        $labref = $this->input->post("ndqno");
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $client . '- Client';
        $to = $names . '- Documentation';
        $date = date('d-M-Y H:i:s');

        $array_data = array(
            'labref' => $labref,
            'client_id' => $clientid,
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date_added' => $date,
            'state' => '1',
            'current_location' => 'Documentation'
        );
        $this->db->insert('worksheet_tracking', $array_data);
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

//end base_params
}
