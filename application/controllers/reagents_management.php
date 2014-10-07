<?php 

class Reagents_management extends CI_Controller {
    
    public function index(){

    	$this -> list_inventory();
    	
    }

    public function add_inventory(){
        $data['rgs'] = Reagent::getAll();
        $data['view'] = "reagents_add_v";
        $this -> load -> view("reagents_template",$data);
        //$this -> base_params($data);
        
    }

    public function add_episode(){

        $data['view'] = "reagent_add_v";
        $this -> base_params($data);
        
    }



    public function list_inventory(){

        $data['view'] = "reagents_list_ajax_v";
        $data['reagents'] = Reagents::getAll();  
        $this -> base_params($data);
        
    }

     public function list_episodes(){

        $data['view'] = "reagent_list_v";
        $data['reagent'] = Reagent::getAll();    
        $this -> base_params($data);
        
    }

    public function edit_fancybox(){
        
    }

     public function save_inventory(){

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


        
        $name = $this -> input -> post("name");
        $comment = $this -> input -> post("comment");
        $mfctrer = $this -> input -> post("manufacturer");
        $batch_no = $this -> input -> post("batch_no");
        $date_r = $this -> input -> post("date_r");
        $date_o = $this -> input -> post("date_o");
        $date_e = $this -> input -> post("date_e");
        $quantity = $this -> input -> post("quantity");
        $qunit = $this -> input -> post("qunit");
        $r_level = $this -> input -> post("reorder_l");
        $rl_unit = $this -> input -> post("rlunit");
        $packaging = $this -> input -> post("packaging");
        $no_of_units = $this -> input -> post("no_of_units");
        $form = $this -> input -> post("form");
        $reagentid = $this -> input -> post("reagentid");
        

        $reagent =  new Reagents();

            $reagent -> name = $name;
            $reagent -> comment = $comment;
            $reagent -> manufacturer = $mfctrer;
            $reagent -> batch_no = $batch_no;
            $reagent -> date_of_expiry = date('y-m-d',strtotime($date_e));
            $reagent -> date_received =date('y-m-d',strtotime($date_r));
            $reagent -> date_opened = date('y-m-d',strtotime($date_o));
            $reagent -> reorder_level = $r_level;
           // $reagent -> r_level_unit = $rl_unit;
            $reagent -> volume = $quantity;
            $reagent -> qunit = $qunit;
            $reagent -> packaging = $packaging;
            $reagent -> quantity = $no_of_units;
            $reagent -> save();

            if(date('y-m-d') > date('y-m-d',strtotime($date_e))){
                $status = "Expired";
            }
            else{

                $status = "Effective";
            }


            $r_tracking = new Reagents_log();
            $r_tracking -> batch_no = $batch_no;
            $r_tracking -> quantity = $quantity;
            $r_tracking -> qunit = $qunit;
            $r_tracking -> status = $status;  
            $r_tracking -> save();  

    }

     public function edit_inventory(){

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


        
        $name = $this -> input -> post("name");
        $mfctrer = $this -> input -> post("manufacturer");
        $batch_no = $this -> input -> post("batch_no");
        $date_r = $this -> input -> post("date_r");
        $date_e = $this -> input -> post("date_e");
        $quantity = $this -> input -> post("quantity");
        $qunit = $this -> input -> post("qunit");
        $r_level = $this -> input -> post("r_level");
        $packaging = $this -> input -> post("packaging");
        $no_of_units = $this -> input -> post("no_of_units");
        $reagent_id = $this -> input -> post("reagent_id");

        $reagent_update = array(
            'name' => $name,
            'manufacturer' => $mfctrer,
            'batch_no' => $batch_no,
            'date_received' => date('y-m-d',strtotime($date_r)),
            'date_of_expiry' => date('y-m-d',strtotime($date_e)),
            'reorder_level' => $r_level,
            'packaging' => $packaging,
            'quantity' => $quantity,
            'qunit' => $qunit,
            'no_of_units' => $no_of_units
            );

        $this -> db -> where('id',$reagent_id);
        $this -> db -> update('reagents', $reagent_update);  

    }


    public function save_episode(){

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


        
        $name = $this -> input -> post("name");
        //$description = $this -> input -> post("description");
        $code = "NQCL-RG-";
        $alias = str_replace(' ', '_', $name);

        $reagent =  new Reagent();

            $reagent -> name = $name;
            $reagent -> code =  $code;
            $reagent -> alias = $alias;
            $reagent -> save();

    }
        public function base_params($data) {
		$data['title'] = "Reagents";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");		
		//$data['content_view'] = "reagents_template";
		$this -> load -> view('reagents_template', $data);   
    }

}
?>