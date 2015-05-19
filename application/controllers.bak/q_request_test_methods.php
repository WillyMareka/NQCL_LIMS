<?php
class Quotation extends MY_Controller {

	function __construct() {
		parent::__construct();
	}


	public function index(){

		Quotation::generate();

	}


		public function save() {


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
                'message'=> 'Data added successfully',
                'array' => json_encode($_POST)
            ));
            }

        $Analysistype = $this -> input -> post("analysistype");    
        $Analysistype_mid = $this -> input -> post("analysistypemid");   
        $id_multic = $this -> input -> post("id_mc");   
        $Multic_mid = $this -> input -> post("Multicomponentmid");
        $Multis_mid = $this -> input -> post("Multistagemid");   
        $Multistage = $this -> input -> post("Multistage");
        $Multicomponent = $this -> input -> post("Multicomponent");
       	$aas_no = $this -> input -> post("aas_no");
        $method_type = $this -> input -> post("methdids");
        $multi_no2 = $this -> input -> post("multi_no2"); 
        $testids = $this -> input -> post("testids");
		$charge = $this -> input -> post("charge");	    
        $multi_no = $this -> input -> post("multi_no");    
        $method_types = $this -> input -> post("method_type");   
        $method_test = $this -> input -> post("method_test");  
		$methods = $this -> input -> post("methods");
		
		$client_number = $this -> input -> post("client_number");
		$test =$this -> input -> post("test");
		$sample_no = $this -> input -> post("sample_no");
		$sample_name = $this -> input -> post("sample_name");
		$client_name = $this -> input -> post("client_name");
		$active_ingredients = $this -> input -> post("active_ingredients");
		$dosage_form = $this -> input -> post("dosage_form");
		$quotation_date = $this -> input -> post("quotation_date");

		$quotation = new Quotations();
		$quotation -> Dosage_Form = $dosage_form;
		$quotation -> Active_ingredient = $active_ingredients;
		$quotation -> Sample_name = $sample_name;
		$quotation -> Client_name = $client_name;
		$quotation -> Quotation_date = $client_name;
		$quotation -> Sample_no = $sample_no;
		$quotation -> Client_number = $client_number;
		$quotation -> save();
		

		for($i=0;$i<count($test);$i++){
			$request = new Q_request_details();
			$request -> test_id = $test[$i];
			$request -> request_id = $client_number;
			$request -> save();
		}


		for($j = 0; $j<count($methods); $j++ ){
			if($methods[$j] != 0 ){
			$request = new Q_request_test_methods();
			$request -> method_id = $methods[$j];
			$request -> client_number = $client_number;
			$request -> save();
			}
		}

		for($k = 0; $k < count($Multicomponent); $k++){
			$request = new Q_test_multic();
			$request -> client_number = $client_number;
			$request -> components_no = $Multicomponent[$k];
			$request -> method_id = $Multic_mid[$k];
			$request -> save();
		}

		
		for($l = 0; $l < count($Multistage); $l++){
			$request = new Q_test_multis();
			$request -> client_number = $client_number;
			$request -> stages_no = $Multistage[$l];
			$request -> method_id = $Multis_mid[$l];
			$request -> save();
			}

		for($m = 0; $m < count($Analysistype); $m++){
			$request = new Q_analysis_type();
			$request -> client_number = $client_number;
			$request -> analysis_type = $Analysistype[$m];
			$request -> method_id = $Analysistype_mid[$m];
			$request -> save();
                        
			}
                }
                

	public function generate(){
		$data['lastclientno'] = Quotations::getLastId();
		$data['dosageforms'] = Dosage_form::getAll();
		$data['tests'] = Tests::getAll();
		$data['wetchemistry'] = Tests::getWetChemistry();
		$data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
		$data['medicaldevices'] = Tests::getMedicalDevices();
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("jquery.ui.core.js","jquery.ui.datepicker.js","jquery.ui.widget.js");		
		$data['styles'] = array("jquery.ui.all.css");
		$data['settings_view'] = "generate_quotation_v";
		$this -> base_params($data);
	}

	public function listing(){

	}

	public function show(){
	$data['settings_view'] = "show_quotation_v";
	$this -> base_params($data);	
	}

	public function base_params($data) {
		$data['title'] = "Request Management";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "quotation";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";
		$this -> load -> view('template', $data);
	}//end base_params

}






?>