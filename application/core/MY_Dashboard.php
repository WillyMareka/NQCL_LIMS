<?php
//require 'FusionCharts.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('FusionCharts');
    }

    function Charts() {
        $FC = new FusionCharts();
        return $FC;
    }

    function checkString($data, $year) {
        $years = strpos($data, $year) != false;
        return $years;
    }

    function AllClientsCount() {
        return $this->db->count_all_results('clients');
    }

    function AllSamplesCount() {
        return $this->db->where("DATE_FORMAT(designation_date, '%Y')=".date('Y'))->count_all_results('request');
    }
      function AllSamplesCountJ($y) {
          $array=array('count'=>$this->db->where("DATE_FORMAT(designation_date, '%Y')=".$y)->count_all_results('request'));
          echo json_encode($array);
    }
       

    function AllAssignedSamples() {
        return $this->db->where("activity", 'Analysis')->where("DATE_FORMAT(date_issued, '%Y')=".date('Y'))->get('sample_details')->num_rows();
    }

    function AllUnassignedSamples() {
        return $this->AllSamplesCount() - $this->AllAssignedSamples();
    }
    
       function All_In_Use() {
        return $this->db->where('status','In Use')->count_all_results('refsubs');
    }

    function All_Effective() {
        return $this->db->where('status','Effective')->count_all_results('refsubs');
    }

    function All_Reserved() {
        return $this->db->where("status", 'Reserved')->get('refsubs')->num_rows();
    }

    function All_Expired() {
        return $this->db->where("status", 'Expired')->get('refsubs')->num_rows();
    }
    
    function load_analyst_samples($id){
        echo json_encode($this->db->select('lab_ref_no')->where('analyst_id',$id)->get('sample_issuance')->result());
    }

    
    function LoadReferenceSubstances($year,$status,$standard_type) {
        $status1 = str_replace('%20', " ", $status);
        $standard_type1 = str_replace('%20', " ", $standard_type);
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
      return $this->db->query("SELECT FORMAT(SUM(`init_mass`),2) as Quantity, name,id FROM `refsubs` WHERE status='$status1' AND DATE_FORMAT(date_received, '%Y') = '$year' AND standard_type='$standard_type1' GROUP BY name")->result();

     
    }
    
    function Monthly_Requests($year) {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT MONTHNAME(designation_date) as month, YEAR(designation_date) as year, DATE_FORMAT(designation_date, '%m') as m,
                                    COUNT(id) as 'total'
                                    FROM request
                                    WHERE DATE_FORMAT(designation_date, '%Y') = '$year'
                                    GROUP BY MONTHNAME(designation_date)
                                    ORDER BY MONTH(designation_date) ASC");

        return $result = $query2->result();
    }
      function Monthly_Requests_Assignment($year) {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT DISTINCT(labref), MONTHNAME(date_issued) as month, YEAR(date_issued) as year,DATE_FORMAT(date_issued, '%m') as m,
                                    COUNT(id) as 'total'
                                    FROM sample_details
                                    WHERE DATE_FORMAT(date_issued, '%Y') = '$year' 
                                    AND activity='Analysis'
                                    GROUP BY MONTHNAME(date_issued)
                                    ORDER BY MONTH(date_issued) ASC");

        return $result = $query2->result();
    }
       function Monthly_Requests_Urgent($year) {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT MONTHNAME(designation_date) as month, YEAR(designation_date) as year,DATE_FORMAT(designation_date, '%m') as m,
                                    COUNT(id) as 'total'
                                    FROM request
                                    WHERE DATE_FORMAT(designation_date, '%Y') = '$year' AND urgency = '1'
                                    GROUP BY MONTHNAME(designation_date)
                                    ORDER BY MONTH(designation_date) ASC");

        return $result = $query2->result();
    }
    
          function Monthly_Requests_Pending($year) {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT MONTHNAME(designation_date) as month, YEAR(designation_date) as year,DATE_FORMAT(designation_date, '%m') as m,
                                    COUNT(id) as 'total'
                                    FROM request
                                    WHERE DATE_FORMAT(designation_date, '%Y') = '$year' AND assign_status = '0'
                                    GROUP BY MONTHNAME(designation_date)
                                    ORDER BY MONTH(designation_date) ASC");

        return $result = $query2->result();
    }
            function Monthly_Requests_Review($year='2014') {
        $query2 = $this->db->query("SELECT DISTINCT(labref), MONTHNAME(date_issued) as month, YEAR(date_issued) as year,DATE_FORMAT(date_issued, '%m') as m,
                                    COUNT(id) as 'total'
                                    FROM sample_details
                                    WHERE DATE_FORMAT(date_returned, '%Y') = '$year' 
                                    AND activity='Review'
                                    GROUP BY MONTHNAME(date_returned)
                                    ORDER BY MONTH(date_returned) ASC ");

        return $result = $query2->result();
    }
    
          function Monthly_Requests_Drafting($year='2014') {
        $query2 = $this->db->query("SELECT DISTINCT(labref), MONTHNAME(date_issued) as month, YEAR(date_issued) as year,DATE_FORMAT(date_issued, '%m') as m,
                                    COUNT(id) as 'total'
                                    FROM sample_details
                                    WHERE DATE_FORMAT(date_returned, '%Y') = '$year' 
                                    AND activity='Draft COA'
                                    GROUP BY MONTHNAME(date_returned)
                                    ORDER BY MONTH(date_returned) ASC ");

        return $result = $query2->result();
    }
    
    
           function Monthly_Requests_Completed($year='2014') {
        $query2 = $this->db->query("SELECT DISTINCT(labref), MONTHNAME(date_issued) as month, YEAR(date_issued) as year,DATE_FORMAT(date_issued, '%m') as m,
                                    COUNT(id) as 'total'
                                    FROM sample_details
                                    WHERE DATE_FORMAT(date_returned, '%Y') = '$year' 
                                    AND activity='COA Approval'
                                    GROUP BY MONTHNAME(date_returned)
                                    ORDER BY MONTH(date_returned) ASC");

        return $result = $query2->result();
    }
       function Clients_Data() {
           error_reporting(0);
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT COUNT(*) AS Total, coalesce(client_type, 'All') AS client_type FROM `clients` GROUP BY client_type with Rollup ");
            
         return $result = $query2->result_array();
         /*/var_dump($result);
         foreach($result as $totals):
             $total_sum =$total_sum+$totals['Total'];
         endforeach;
         
         $total_array = array(
             'Total'=>$total_sum
         );
         
         $merged=array_merge($result,array($total_array));
         var_dump($merged);*/
        
    }
    

    function Completed_Requests($year = '2014') {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT count(id) as total FROM `worksheet_tracking` WHERE date_added like '%$year%' AND stage < 11");

        return $result = $query2->result();
    }

    function In_Progress($year = '2014') {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
        $query2 = $this->db->query("SELECT count(id) as total FROM `worksheet_tracking` WHERE date_added like '%$year%' AND stage = 11 ");

        return $result = $query2->result();
    }

    function getWeekCount() {
        return $this->db->query("select count(id) as perweek from request
   where designation_date between date_sub(now(),INTERVAL 1 WEEK) and now()")->result();
    }

    function getADayCount() {
        return $this->db->query("select count(id) as perweek from request where designation_date= CURDATE() -INTERVAL 1 DAY")->result();
    }

    function getToday() {
        return $this->db->query("select count(id) as perweek from request where designation_date= CURDATE()")->result();
    }

    function popularClient() {
        return $this->db->query("SELECT COUNT(r.client_id) as total, c.name as client_name
                                    FROM request r, clients c
                                    WHERE r.client_id = c.id
                                    GROUP BY r.client_id
                                    ORDER BY total DESC
                                    LIMIT 1")->result();
    }

    function popularProduct() {
        return $this->db->query("SELECT COUNT(r.product_name) as total, r.product_name
                                    FROM request r
                                    GROUP BY r.product_name
                                    ORDER BY total DESC
                                    LIMIT 1")->result();
    }

    function getAnalystSamples() {
        return $this->db->query("SELECT COUNT( si.analyst_id) as total, si.analyst_id as analyst_id, td.name as department, u.title, u.fname, u.lname
                                    FROM sample_issuance si, user u,test_departments td
                                    where si.analyst_id= u.id
                                    AND u.department_id = td.id
                                    AND YEAR(si.created_at)=2014 AND MONTH(si.created_at)=6
                                    GROUP BY si.analyst_id ")->result();
    }
    
    function getAllColumns(){
        
    }
    
    function getclients_by_date($start,$end){
        $query = $this->db->query("SELECT * FROM clients WHERE created_at between '$start' AND  '$end'")->result();
        foreach ($query as $data):
            $return[]=$data;
        endforeach;
           if(!empty($return)){
              echo json_encode($return); 
           }else{
             echo '[]';  
           }
    }
    
         function getSampleLocation(){
        return $this->db->get('worksheet_tracking')->result();
    }
    
    function rp($param){
      return str_replace("%20"," ", $param);  
    }
    
    function s($param){
        
      return str_pad($param, 2, '0', STR_PAD_LEFT);
    }

}
