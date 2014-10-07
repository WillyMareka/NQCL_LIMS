<?php

$core_classes = array('Dashboard', 'Standards');
foreach ($core_classes as $dashboard_files):
    require APPPATH . '/core/MY_' . $dashboard_files . '.php';
endforeach;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Main_dashboard extends MY_Dashboard {

    function __construct() {
        parent::__construct();

        $FC = $this->Charts();
    }

    function index() {

        $data['all_clients'] = $this->AllClientsCount();
        $data['all_samples'] = $this->AllSamplesCount();
        $data['all_assigned'] = $this->AllAssignedSamples();
        $data['all_unassigned'] = $this->AllUnassignedSamples();
        $data['years'] = $this->list_years();
        $data['days'] = $this->list_days();
        $data['months'] = $this->list_months();
        $data['weekly'] = $this->getWeekCount();
        $data['yesterday'] = $this->getADayCount();
        $data['today'] = $this->getToday();
        $data['p_client'] = $this->popularClient();
        $data['p_product'] = $this->popularProduct();
        $data['analyst_sample'] = $this->getAnalystSamples();
        $data['location'] = $this->getSampleLocation();
        $data['contents'] = 'dashboard_views/sample_front';
        $this->load_template($data);
    }

    function clients() {

        $data['all_clients'] = $this->AllClientsCount();
        $data['all_samples'] = $this->AllSamplesCount();
        $data['all_assigned'] = $this->AllAssignedSamples();
        $data['all_unassigned'] = $this->AllUnassignedSamples();
        $data['years'] = $this->list_years();
        $data['weekly'] = $this->getWeekCount();
        $data['yesterday'] = $this->getADayCount();
        $data['today'] = $this->getToday();
        $data['p_client'] = $this->popularClient();
        $data['p_product'] = $this->popularProduct();
        $data['analyst_sample'] = $this->getAnalystSamples();
        $data['location'] = $this->getSampleLocation();
        $data['contents'] = 'dashboard_views/clients_v';
        $this->load_template($data);
    }

    function Standards() {
        $data['in_use'] = $this->All_In_Use();
        $data['effective'] = $this->All_Effective();
        $data['reserved'] = $this->All_Reserved();
        $data['expired'] = $this->All_Expired();
        $data['years'] = $this->list_years();
        $data['almost_expiry'] = count($this->getAlmostExpiry());
        $data['expired'] = count($this->getExpired());
        $data['contents'] = 'dashboard_views/standards_v';
        $this->load_template($data);
    }

    function Columns() {
        $data['in_use'] = $this->All_In_Use();
        $data['effective'] = $this->All_Effective();
        $data['reserved'] = $this->All_Reserved();
        $data['expired'] = $this->All_Expired();
        $data['years'] = $this->list_years();
        $data['contents'] = 'dashboard_views/columns_v';
        $this->load_template($data);
    }

    function Equipment() {
        $data['in_use'] = $this->All_In_Use();
        $data['status'] = $this->load_status();
        $data['effective'] = $this->All_Effective();
        $data['reserved'] = $this->All_Reserved();
        $data['expired'] = $this->All_Expired();
        $data['years'] = $this->list_years();
        $data['contents'] = 'dashboard_views/equipment_v';
        $this->load_template($data);
    }

    function load_status() {
        return $this->db->select('status')->group_by('status')->get('equipment')->result();
    }

    function getAllEquipment() {
        $data = $this->db->get('equipment')->result();
        foreach ($data as $results):
            $reply[] = $results;
        endforeach;
        if (!empty($reply)) {
            echo json_encode($reply);
        } else {
            echo '[]';
        }
    }

    function load_analysys_request($Y, $m, $d) {
        $day = $this->s($d);
        $month = $this->s($m);
        $date = $Y .'-'.$month.'-'.$day;
        $data = $this->db->query("SELECT DISTINCT(COUNT(s.labref)) AS Total_samaples,s.id, s.analyst_id,s.analyst_name,s.date_time, td.name
FROM assigned_samples s, test_departments td 
WHERE s.department_id = td.id
AND DATE_FORMAT(s.date_time_tracker,'%Y-%m-%d') = '$date'
GROUP BY s.analyst_id")->result();
        
        foreach ($data as $results):
            $reply[] = $results;
        endforeach;
        if (!empty($reply)) {
            echo json_encode($reply);
        } else {
            echo '[]';
        }
    }

    function more_view($i, $Y, $m, $d) {
        $data['sample_data'] = $this->load_data($i, $Y, $m, $d);
        $this->load->view('dashboard_views/more_data', $data);
    }

    function load_data($i, $Y, $m, $d) {
        $day = $this->s($d);
        $month = $this->s($m);
        return ($this->db->query("SELECT labref ,DATEDIFF(curdate(),`date_time`) AS difference FROM assigned_samples WHERE analyst_id= '$i' AND DATE_FORMAT(date_time_tracker,'%Y-%m-%d') = '$Y-$month-$day'")->result());
    }

    function draw_charts() {

        // $data['all_clients'] = $this->AllClientsCount();
        $data['contents'] = 'dashboard_views/fusion_chart';
        $this->load_template($data);
    }

    function getAnalsytLabrefs($id) {
        $this->load_analyst_samples($id);
    }

    function list_years() {
        $year = date('Y') + 1;
        for ($i = 1; $i <= 5; $i++) {
            $previous[] = $year - $i;
        }
        return $previous;
    }

    function list_days() {
        $end = 31;
        $start = 1;
        $step = 1;
        foreach (range($start, $end, $step) as $days):
            $data[] = $days;
        endforeach;
        return $data;
    }

    function list_months() {
        $end = 12;
        $start = 1;
        $step = 1;
        foreach (range($start, $end, $step) as $month):
            $data[] = $month;
        endforeach;
        return $data;
    }

    public function getData($year = '2014') {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=REGISTERED SAMPLES " . $year . ";xAxisName=Month;yAxisName=Number;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Monthly_Requests($year);
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown->total, "name= $drilldown->month; link=j-singleOut-" . $drilldown->m);
        endforeach;
        print $FC->getXML();
    }

    public function getDataAssigned($year = '2014') {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=ASSIGNED SAMPLES " . $year . ";xAxisName=Month;yAxisName=Number;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Monthly_Requests_Assignment($year);
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown->total, "name= $drilldown->month ;link=j-singleOut-" . $drilldown->m);
        endforeach;
        print $FC->getXML();
    }

    function show() {
        $this->Clients_Data();
    }
    
       public function getDataUrgent($year = '2014') {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=URGENT SAMPLES " . $year . ";xAxisName=Month;yAxisName=Number;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Monthly_Requests_Urgent($year);
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown->total, "name= $drilldown->month ;link=j-singleOut-" . $drilldown->m);
        endforeach;
        print $FC->getXML();
    }

        public function getDataReview($year = '2014') {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=REVIEWED SAMPLES " . $year . ";xAxisName=Month;yAxisName=Number;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Monthly_Requests_Review($year);
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown->total, "name= $drilldown->month ;link=j-singleOut-" . $drilldown->m);
        endforeach;
        print $FC->getXML();
    }
    
        public function getDataDrafting($year = '2014') {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=SAMPLES FOR DRAFT CERTIFICATE " . $year . ";xAxisName=Month;yAxisName=Number;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Monthly_Requests_Drafting($year);
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown->total, "name= $drilldown->month ;link=j-singleOut-" . $drilldown->m);
        endforeach;
        print $FC->getXML();
    }
    
          public function getDataCompleted($year = '2014') {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=ANALYSIS COMPLETED SAMPLES " . $year . ";xAxisName=Month;yAxisName=Number;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Monthly_Requests_Completed($year);
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown->total, "name= $drilldown->month ;link=j-singleOut-" . $drilldown->m);
        endforeach;
        print $FC->getXML();
    }
    
          public function getDataPending($year = '2014') {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=PENDING SAMPLES " . $year . ";xAxisName=Month;yAxisName=Number;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Monthly_Requests_Pending($year);
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown->total, "name= $drilldown->month ;link=j-singleOut-" . $drilldown->m);
        endforeach;
        print $FC->getXML();
    }
   

    public function getClientsData() {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=NQCL CLIENTS AS OF" . date('Y') . ";xAxisName=Type;yAxisName=Number of Clients;decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->Clients_Data();
        foreach ($chartData as $drilldown):
            $FC->addChartData($drilldown['Total'], "name=" . $drilldown['client_type']);
        endforeach;
        print $FC->getXML();
    }

    public function getStandardsData($year, $status, $standard_type) {

        // Instantiate the FusionCharts object 
        $FC = $this->Charts();


        // specify the graph parameters
        $strParam = "caption=Reference Standards As of " . date('Y') . ";xAxisName=Chemical Name;yAxisName=Quantity(mg/mL/iu per mL/);decimalPrecision=0;formatNumberScale=1";
        $FC->setChartParams($strParam);
        $chartData = $this->LoadReferenceSubstances($year, $status, $standard_type);
        foreach ($chartData as $drilldown):

            $FC->addChartData($drilldown->Quantity, "name=$drilldown->name;link=j-singleOut-" . $drilldown->id);


        endforeach;
        print $FC->getXML();
    }

    function getpieData() {
        $FC = $this->Charts();
        $strXML = "caption=Factory Output report; subCaption=By Quantity; pieSliceDepth=30; showBorder=1; formatNumberScale=0; numberSuffix=Units; animation=1";
        $FC->setChartParams($strXML);
        $strQuery = $this->db->get('Factory_Master');
        $result = $strQuery->result();
        if ($result) {
            foreach ($result as $data) {
                $strQuery = $this->db->query("select sum(Quantity) as TotOutput from Factory_Output where FactoryId=$data->FactoryId");
                $result2 = $strQuery->result();
                foreach ($result2 as $ors) {
                    $FC->addChartData($ors->TotOutput, "label=" . $data->FactoryName);
                }
            }
            print $FC->getXML();
        }
    }

    function getpieData_Request() {
        $FC = $this->Charts();
        $strXML = "caption=NQCL 2014 Analysis Request State; subCaption=By Completion; pieSliceDepth=30; showBorder=1; formatNumberScale=0; numberSuffix= Requests; animation=1";
        $FC->setChartParams($strXML);
        $strQuery = $this->db->get('progress_master');
        $result = $strQuery->result();
        if ($result) {
            foreach ($result as $data) {
                $strQuery = $this->db->query("SELECT count(id) as total FROM `worksheet_tracking` WHERE date_added like '%2014%' AND state = $data->id");
                $result2 = $strQuery->result();
                foreach ($result2 as $ors) {
                    $FC->addChartData($ors->total, "label=" . $data->state);
                }
            }
            print $FC->getXML();
        }
    }

    function getpieData_Standard() {
        $FC = $this->Charts();
        $strXML = "caption=NQCL 2014 Standard Status ; subCaption=Distribution; pieSliceDepth=30; showBorder=1; formatNumberScale=0; numberSuffix= Standards; animation=1";
        $FC->setChartParams($strXML);
        $strQuery = array('In Use', 'Effective', 'Reserved', 'Expired');
        $result = $strQuery;
        if ($result) {
            foreach ($result as $data) {
                $strQuery = $this->db->query('SELECT count(id) as total FROM `refsubs` WHERE status = "' . str_replace('%20', ' ', $data) . '"');
                $result2 = $strQuery->result();
                foreach ($result2 as $ors) {
                    $FC->addChartData($ors->total, "label=" . $data);
                }
            }
            print $FC->getXML();
        }
    }

    function getpieData_Standard_type() {
        $FC = $this->Charts();
        $strXML = "caption=NQCL 2014 Standard Types ; subCaption=Distribution; pieSliceDepth=30; showBorder=1; formatNumberScale=0; numberSuffix= Standards; animation=1";
        $FC->setChartParams($strXML);
        $strQuery = array('Working', 'Primary', '');
        $result = $strQuery;
        if ($result) {
            foreach ($result as $data) {
                $strQuery = $this->db->query('SELECT count(id) as total FROM `refsubs` WHERE standard_type = "' . str_replace('%20', ' ', $data) . '"');
                $result2 = $strQuery->result();
                foreach ($result2 as $ors) {
                    $FC->addChartData($ors->total, "label=" . $data);
                }
            }
            print $FC->getXML();
        }
    }

    function getpieData_Clients() {
        $FC = $this->Charts();
        $strXML = "caption=NQCL 2014 Client Propotions ; subCaption=By Type; pieSliceDepth=30; showBorder=1; formatNumberScale=0; numberSuffix= Clients; animation=1";
        $FC->setChartParams($strXML);
        $strQuery = array('A', 'B', 'C', 'D', 'E', '');
        $result = $strQuery;
        if ($result) {
            foreach ($result as $data) {
                $strQuery = $this->db->query('SELECT count(id) as total FROM `clients` WHERE client_type = "' . str_replace('%20', ' ', $data) . '"');
                $result2 = $strQuery->result();
                foreach ($result2 as $ors) {
                    $FC->addChartData($ors->total, "label=" . $data);
                }
            }
            print $FC->getXML();
        }
    }
    
    function getMontylySamples($d) {
        $refsub = $this->db->query("SELECT * FROM request WHERE DATE_FORMAT(designation_date,'%Y-%m') = '$d'")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }
    
        function getMontylySamplesAssigned($d) {
        $refsub = $this->db->query("SELECT * FROM request WHERE DATE_FORMAT(designation_date,'%Y-%m') = '$d' AND assign_status='1'")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }
    

    
    function getMontylyUrgentSamples($d) {
        $refsub = $this->db->query("SELECT * FROM request WHERE DATE_FORMAT(designation_date,'%Y-%m') = '$d' AND urgency='1'")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }
    
    
      function getMontylyRDCSamples($s,$d) {
        $refsub = $this->db->query("SELECT * 
                        FROM request r, worksheet_tracking wt
                        WHERE r.request_id = wt.labref
                        AND DATE_FORMAT(r.designation_date, '%Y-%m') = '$d' 
                        AND wt.stage = '$s' "
                )->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }
    
        function getMontylyAssignedSamples($d) {
        $refsub = $this->db->query("SELECT * FROM request WHERE DATE_FORMAT(designation_date,'%Y-%m') = '$d' AND assign_status='1'")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }
    
        function getMontylyPendingSamples($d) {
        $refsub = $this->db->query("SELECT * FROM request WHERE DATE_FORMAT(designation_date,'%Y-%m') = '$d' AND assign_status='0'")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }
    
    

    function single_out_standard($i) {
        echo json_encode($this->db->where('id', $i)->get('refsubs')->result());
    }

    function getAlmostExpiry() {
        return $this->db->query('SELECT id, name,DATEDIFF(`date_of_expiry`,`date_received`) AS difference FROM refsubs WHERE DATEDIFF(`date_of_expiry`,`date_received`) < 14 AND DATEDIFF(`date_of_expiry`,`date_received`) > 0 ')->result();
    }

    function getExpired() {
        return $this->db->query('SELECT id, name,DATEDIFF(`date_of_expiry`,`date_received`) AS difference FROM refsubs WHERE DATEDIFF(`date_of_expiry`,`date_received`) < 0 ')->result();
    }

    function getAlmostExpiry1() {
        $refsub = $this->db->query('SELECT * FROM refsubs WHERE DATEDIFF(`date_of_expiry`,`date_received`) < 14 AND DATEDIFF(`date_of_expiry`,`date_received`) > 0 ')->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getExpired1() {
        $refsub = $this->db->query('SELECT * FROM refsubs WHERE DATEDIFF(`date_of_expiry`,`date_received`) < 0 ')->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getAllColumns1() {
        $refsub = $this->db->query('SELECT * FROM columns ')->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getAllIssuedColumns($filterx) {
        $filter = $this->rp($filterx);
        $refsub = $this->db->query("SELECT * FROM columns WHERE column_status='$filter'")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getEquipmentFilter($filterx) {
        $filter = $this->rp($filterx);
        $refsub = $this->db->query("SELECT * FROM equipment WHERE status='$filter'")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getAllClients() {
        $refsub = $this->db->query("SELECT id,name,email,address, client_type, contact_phone, discount_percentage FROM clients")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getAllClientType($type) {
        $refsub = $this->db->query("SELECT id,name,email,address, client_type, contact_phone, discount_percentage FROM clients WHERE client_type='$type' ")->result();

        foreach ($refsub as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getColumnHistory($id) {
        $query = $this->db->query("SELECT cu.column_id,cu.request_id, cu.date,u.fname, u.lname, r.product_name "
                        . "FROM columns_usage cu,columns c, user u,request r "
                        . "WHERE cu.column_id = c.id "
                        . "AND cu.user_id = u.id "
                        . "AND cu.column_id=$id "
                        . "GROUP BY cu.request_id"
                )->result();
        foreach ($query as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getEquipmentHistory($id) {
        $query = $this->db->query("SELECT eu.equipment_id,eu.request_id, eu.date,u.fname, u.lname, r.product_name 
FROM equipment_usage eu,equipment e, user u,request r 
           WHERE eu.equipment_id = e.id
             AND eu.user_id = u.id 
               AND eu.equipment_id=$id 
               GROUP BY eu.request_id"
                )->result();
        foreach ($query as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function getEquipmentName($id) {
        echo json_encode($this->db->select('name')->where('id', $id)->get('equipment')->result());
    }

    function load_client_samples($id) {
        $query = $this->db->query("SELECT r.request_id, r.sample_qty, r.product_name,c.name, r.batch_no,d.name FROM request r, clients c , dosage_form d WHERE r.client_id=c.id AND r.dosage_form=d.id AND r.client_id=$id")->result();
        foreach ($query as $r) {
            $data[] = $r;
        }
        if (!empty($data)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }

    function loadClientsDatedData($start, $end) {
        $this->getclients_by_date($start, $end);
    }

    function loadColumn($id) {
        $query = $this->db->query("SELECT u.fname, u.lname, c.column_type,c.column_no "
                        . "FROM columns c, user u "
                        . "WHERE c.`issued_to`= u.id "
                        . "AND c.id=$id")->result();
        echo json_encode($query);
    }

    function load_template($template_data) {
        $this->load->view('dashboard_views/dashboard_template', $template_data);
    }

}
