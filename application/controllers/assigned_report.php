<?php
 require_once("application/helpers/dompdf/dompdf_config.inc.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Assigned_report extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function getReport($start,$end,$dept) {
		//$this->load->view('');
        $css='<!doctype><html><head><title>Analyst Sample Assignment Report</title>';
        $css.= '<style type="text/css">
          .tg{width:900px;};
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:30px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6; width:300px;}
.tg .tg-031e .e12{background-color:#C2FFD6; width:300px;}
.he{ font-weight: bold;}
p{width:100%;
height: 5px;}
</style>


<script>
$(document).ready(function(){
	alert(1);
});
</script>
';
       

        $css.='</head><body>';
        $css.='<p><center><strong><u>Samples Assigned to Analyst</u></strong></center></p>';
        
        $query = $this->db->query("SELECT * FROM assigned_samples WHERE date_time_tracker BETWEEN '$start%' AND '$end%' AND department_id='$dept' GROUP BY analyst_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="4">' . $q->analyst_name . '</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Quantity Issued</td><td class="tg-ugh9 he">Date Issued</td></tr>';
            $query1 = $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging 
			FROM `assigned_samples` a_s 
			left join sample_issuance si on a_s.labref = si.lab_ref_no
			left join request r on a_s.labref = r.request_id
			left join packaging p on r.packaging = p.id
                        WHERE si.analyst_id ='$q->analyst_id'
                        AND a_s.date_time_tracker BETWEEN '$start%' 
                        AND '$end%' 
						AND a_s.department_id='$dept'
			group by a_s.labref")->result();
            $i = 1;
            foreach ($query1 as $q1):
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->labref . '</td>
    <td class="tg-ugh9">' . $q1->quantity_issued . " " . $q1->sample_packaging . '</td> '
                        . ' <td class="tg-031e e12">' . $q1->date_time_tracker . '</td></tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;       
           echo $css;   
        /*$this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->load_html($css);
        $dompdf->render();
        file_put_contents('assigned_samples_report/Assigned_Sample_Report.pdf', $dompdf->output());*/
        
    }

}
