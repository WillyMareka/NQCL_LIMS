<?php



class Analyst_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('excel', 'Word'));
    }

    public function index() {
	// error_reporting(0);
        if ($this->checkIfHasASupervisor() === '1') {
            $data = array();
            $data['settings_view'] = "analyst_v";

            $userarray = $this->session->userdata;
            $user_id = $userarray['user_id'];

            $data['tests_assigned'] = Sample_issuance::getTests($user_id);
            $data['testnames'] = Tests::getTestNames($user_id);
            $data['labrefs']=  $this->loadLabref();
            $data['sheets']=  $this->loadSheets();

            //$results=$this->get_tests();
            //var_dump($results);
            $this->base_params($data);
        } else {
            // $this->checkIfHasASupervisor();
            $data['settings_view'] = "analyst_v_error";
            $this->base_params($data);
        }
    }
    
    function save($labref){
        echo 'yes';
    }

    function loadfinal() {
        $data['final_submission'] = $this->retrieveFinalSubmission();
        $data['settings_view'] = 'final_submission_v';
        $this->base_params($data);
    }

    
    function getMicroNumber($labref){
       echo json_encode( $this->db->where('labref',$labref)->get('microbiology_tracking')->result());
      
    }
    function checkIfWorksheetExists($labref, $sheetName) {

        $data = $this->getLastWorksheet();
        $worksheetIndex = $data[0]->no_of_sheets;

        $sanitized_sheet = str_replace("_", " ", $sheetName);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
        $sheets = $objPHPExcel->getSheetNames();
        if (in_array($sanitized_sheet, $sheets, true)) {
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
        } else {
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->setTitle($sanitized_sheet);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $this->updateWorksheetNo();
            $test_id = $this->uri->segment(5);
            $this->setDoneStatus($labref, $test_id);
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
            //redirect('analyst_controller');
        }
    }
    
    function loadLabref(){
        $analyst_id=  $this->session->userdata('user_id');
        return $this->db->select('lab_ref_no')->where('analyst_id',$analyst_id)->group_by('lab_ref_no')->get('sample_issuance')->result();
    }
    
     function loadsheets(){
       
        return $this->db->where('w_chem',1)->get('tests')->result();
    }

    function checkIfWorksheetExists_extra($labref, $sheet_name) {
       $analyst_id=  $this->session->userdata('user_id');
        $query = $this->db->where('labref', $labref)->where('sheet_name', $sheet_name)->get('custom_sheets')->num_rows();
        if ($query == '0') {
            $this->db->insert('custom_sheets', array('labref' => $labref, 'sheet_name' => $sheet_name, 'analyst_id' => $analyst_id));
            $this->stamp($labref, $sheet_name);
        } else {
            $this->stamp($labref, $sheet_name);
        }
    }
    
    function checkMicrobiology($labref,$sheet_name){
        $analyst_id=  $this->session->userdata('user_id');
        $query = $this->db->where('labref', $labref)->where('sheet_name', $sheet_name)->get('custom_sheets')->num_rows();
        if ($query == '0') {
            $this->db->insert('custom_sheets', array('labref' => $labref, 'sheet_name' => $sheet_name, 'analyst_id' => $analyst_id));
        $this->postData($labref, $sheet_name);
        }else{
        $this->postData($labref, $sheet_name);
 
        }
        
    }
    
    function upload_microbial_assay(){  
        $data['test_name'] = $this->uri->segment(2);
        $data['labref'] = $this->uri->segment(3);
        $data['test_id'] = $this->uri->segment(4);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v_micro';
        $this->base_params($data);
    }
    
      function upload_micro_be(){  
        $data['test_name'] = $this->uri->segment(2);
        $data['labref'] = $this->uri->segment(3);
        $data['test_id'] = $this->uri->segment(4);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v_microbe';
        $this->base_params($data);
    }
    
    
    function postData($labref, $sheet_name) {

        $component = $this->input->post('component');
        $sample_name = $this->input->post('sample_name');
        $micro_lab_number = $this->input->post('micro_lab_number');
        $date_recieved = $this->input->post('date_recieved');
        $date_test_set = $this->input->post('date_test_set');
        $date_of_result = $this->input->post('date_of_result');
        $label_claim = $this->input->post('labelclaim');
        $qty = $this->input->post('qty');
        $unit = $this->input->post('unit');
        $test_id=  $this->input->post('test_id');


        $download = $this->getDownloadCount($labref, $sheet_name);
        $analyst_id = $this->session->userdata('user_id');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;
        $footer = $labref . ' / ' . ucfirst(str_replace('_', ' ', $sheet_name)) . ' / Download ' . $download . '  /  Analyst - ' . $full_names . ' /  Date ' . date('d-m-Y');


        $sanitized_sheet = str_replace("_", " ", $sheet_name);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("microbiology_custom_worksheets/" . $sheet_name . ".xlsx");
        $objPHPExcel->getActiveSheet(0);
        $objPHPExcel->getActiveSheet()
                ->setCellValue('B13', ucfirst($component) . " Microbial Assay")
                ->setCellValue('B14', ucwords($sample_name))
                ->setCellValue('B15', $labref)
                ->setCellValue('B16', ucfirst($component))
                ->setCellValue('B17', ucfirst('Each '.$unit.' ml contains' .$qty.' mg of '.$label_claim))
                ->setCellValue('B18', $date_test_set)
                ->setCellValue('B19', $date_of_result)
                ->setCellValue('A12', 'MICOBIOLOGY NO.')
                ->setCellValue('B12', $micro_lab_number)
                ->setCellValue('C12', 'DATE RECEIVED')
                ->setCellValue('D12', $date_recieved);
        $objPHPExcel->getActiveSheet()->setTitle($labref);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B ' . $footer . " " . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
        if($test_id =='50'){
        $objWriter->save("microbio_worksheets/" . $labref . "_microlal.xlsx");
        }else if($test_id =='49'){
           $objWriter->save("microbio_worksheets/" . $labref . "_micro.xlsx");  
        }

        $this->updateDownloadCount($labref, $sheet_name);
        $this->updateUploadStatus($labref, $test_id);
       $this->setDoneStatus($labref, $test_id);

       
       // redirect("microbio_worksheets/" . $labref . '_' . $sheet_name . ".xlsx");
    }

    function getSheet(){
        
           $data = $this->getLastWorksheet();
        $worksheetIndex = $data[0]->no_of_sheets;

        $sanitized_sheet = str_replace("_", " ", $sheetName);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
        $sheets = $objPHPExcel->getSheetNames();
        if (in_array($sanitized_sheet, $sheets, true)) {
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
        } else {
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->setTitle($sanitized_sheet);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $this->updateWorksheetNo();
            $test_id = $this->uri->segment(5);
            $this->setDoneStatus($labref, $test_id);
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
            //redirect('analyst_controller');
        }
        
    }
    
    

    function stamp($labref, $sheet_name) {
         $download =  $this->getDownloadCount($labref, $sheet_name);
        $analyst_id = $this->session->userdata('user_id');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;

        $full_name = 'custom_worksheets/' . $sheet_name . '.pdf';

        $pdf = new FPDI('P', 'mm', 'A4');
        $pdf->AliasNbPages();

$pagecount = $pdf->setSourceFile($full_name);

$i = 1;
do {
    // add a page
    $pdf->AddPage();
    // import page
    $tplidx = $pdf->ImportPage($i);

     $pdf->useTemplate($tplidx, 10, 10, 200);
     
     $pdf->SetFont('Arial');
     $pdf->SetTextColor(0,0,0);
     $pdf->SetFontSize(7);

     $pdf->SetXY(30, 265);
     $pdf->Write(1,  $labref . ' / ' . ucfirst(str_replace('_', ' ', $sheet_name)) . ' / Download ' .$download.'  /  Analyst - ' . $full_names .' /  Date ' . date('d-m-Y'));
     $pdf->SetXY(160, 265);
     $pdf->Write(1, 'Page '. $pdf->PageNo() . ' of {nb}');



     $i++;

} while($i <= $pagecount);
        $pdf->Output('generated_custom_sheets/' . $labref . '_' . $sheet_name . '.pdf', 'F');
        $this->updateDownloadCount($labref, $sheet_name);

        redirect('generated_custom_sheets/' . $labref . '_' . $sheet_name . '.pdf');

        /* $PHPWord = new PHPWord();
          $document = $PHPWord->loadTemplate('custom_worksheets/'.$sheet_name.'.docx');
          $footer = $document->addFooter();
          $footer->addPreserveText('Page {PAGE} of {NUMPAGES}'.' - '. $labref.'/' .ucfirst(str_replace('_',' ',$sheet_name)).' / Download x : author - ' .$full_names , array('align' => 'center'), array('align' => 'center'));
          $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
          $objWriter->save('generated_custom_sheets/'.$labref.'_'.$sheet_name.'.docx');
          redirect('generated_custom_sheets/'.$labref.'_'.$sheet_name.'.docx'); */
    }
    
    function updateDownloadCount($labref, $sheet_name){
      $repeat = $this->getDownloadCount($labref, $sheet_name);
      $repeat_status = $repeat + 1;
      $this->db->update('custom_sheets',array('repeat_status'=>$repeat_status));
    }
    
    function getDownloadCount($labref, $sheet_name){
       $query= $this->db->select('repeat_status')->where('labref',$labref)->where('sheet_name',$sheet_name)->get('custom_sheets')->result(); 
       $pre= $query[0]->repeat_status;
       if($pre == '0'){
           return $pre + 1;
       }else{
           return $pre;
       }
    }

    public function getAnalyst($analyst_id) {
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function uploadSpace() {

        $data['test_id'] = $this->uri->segment(4);
        $data['labref'] = $this->uri->segment(3);

        $data['settings_view'] = "worksheet_upload_v";
        $data['error'] = "";
        $this->base_params($data);
    }

    function do_upload() {
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $filename = "workbooks/" . $labref . '/' . $labref . '.xlsx';
        unlink($filename);

        $config['upload_path'] = "workbooks/" . $labref;
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('worksheet')) {
            $data['error'] = $this->upload->display_errors();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_analyst_v';
            $this->base_params($data);
        } else {
            $this->updateUploadStatus($labref, $test_id);
            redirect('analyst_controller');
        }
    }

    function retrieveFinalSubmission() {
        $user_id = $this->session->userdata('user_id');
        return $this->db
                        ->select('lab_ref_no')
                        ->where('analyst_id', $user_id)
                        ->group_by('lab_ref_no')
                        ->get('sample_issuance')
                        ->result();
    }

    function checkIfHasASupervisor() {
        $this->db->where('analyst_id', $this->session->userdata('user_id'));
        $query = $this->db->get('analyst_supervisor');
        if ($query->num_rows() > 0) {
            return '1';
        }
        return '0';
    }

    function checkForDoneUniformity() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('test_name');
        $this->db->from('test_done td');
    }

    function validateURL() {
        $user_id = $this->session->userdata('user_id');
        $tests_assigned = Sample_issuance::getTests($user_id);
        foreach ($tests_assigned as $test):
            $worksheet = Tests::getWorksheet($test->Test_id);
            $test = site_url() . $worksheet[0]['Alias'];
            $this->url_exists($test);
        endforeach;
        //  $first=  $this->uri->segment(1);
        //  $this->url_exists($first);
    }

    function createClass() {
        $myFile = "test.php";
        $fh = fopen($myFile, 'w');
        $stringData = "<?php \n";
        $myvar = fwrite($fh, $stringData);
        $stringData = "class xyz extends MY_Controller{\n"
                . "function __construct(){\n"
                . "parent::__construct();\n"
                . "}\n"
                . "}";
        fwrite($fh, $stringData);
        fclose($fh);
        echo 'succes';
    }

    public function base_params($data) {
        $data['title'] = "Analyst";
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
