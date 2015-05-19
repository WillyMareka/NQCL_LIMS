<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Standards extends CI_Controller {

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
        return $this->db->count_all_results('request');
    }

    function AllAssignedSamples() {
        return $this->db->where("assign_status", 1)->get('request')->num_rows();
    }

    function AllUnassignedSamples() {
        return $this->db->where("assign_status", 0)->get('request')->num_rows();
    }
    
    function load_analyst_samples($id){
        echo json_encode($this->db->select('lab_ref_no')->where('analyst_id',$id)->get('sample_issuance')->result());
    }

    function LoadReferenceSubstances() {
        // echo $query =  $this->db->where('YEAR(designation_date)',date('Y'))->group_by('MONTH(designation_date)')->get('request')->num_rows();
      return $this->db->query("SELECT FORMAT(SUM(`init_mass`),2) as Quantity, name FROM `refsubs` GROUP BY name")->result();

     
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
         function getSampleLocation(){
        return $this->db->get('worksheet_tracking')->result();
    }

}
