<script src="<?php echo base_url(); ?>dashboard_assets/js/jquery-1.10.2.min.js"></script>
<script language="JavaScript">
    function singleOut(i){
        $.ajax({
            type:"get",
            url:"<?php echo base_url();?>main_dashboard/single_out_standard/"+i,
            dataType:"json",
            success:function(standards){
                $.each(standards, function(i, standard_data){
                        $('.Name').text(standard_data.name);
                        $('.source').text(standard_data.source);
                        $('.batch_no').text(standard_data.batch_no);
                        $('.rs_code').text(standard_data.rs_code);
                        $('.date_r').text(standard_data.date_received);
                        $('.e_date').text(standard_data.effective_date);
                        $('.doe').text(standard_data.date_of_expiry);
                        $('.dor').text(standard_data.date_of_restandardisation);
                        $('.potency').text(parseFloat(standard_data.potency).toFixed(2)+ standard_data.potency_unit);
                        $('.status').text(standard_data.status);
                        $('.avq').text(parseFloat(standard_data.init_mass).toFixed(2)+ standard_data.init_mass_unit);
                        $('.rest_stat').text(standard_data.restandardisation_status);
                        $('.applic').text(standard_data.application);
                        $('.stype').text(standard_data.standard_type);
                        $('.comment').text(standard_data.comment);   
                        $('.rs_code_prefix').text(standard_data.rs_code_prefix);
                        $('.serial_no').text(standard_data.serial_no);      

                    
                    
                });
                $.fancybox({
                    href:"#standards_details"                    
                })
            },error:function(e){
                alert('An error was encountered, please try again later!');
            }
        });
    }
    function drawChart(chartSWF, strXML, chartdiv) {
        //Create another instance of the chart.
        var chart = new FusionCharts(chartSWF, "chart1Id", "1100", "400", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv);
    }


    function drawPieChart(chartSWF, strXML, chartdiv1) {
        //Create another instance of the chart.

        var chart = new FusionCharts(chartSWF, "FactorySum", "520", "300", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv1);
    }
    
     function drawPieChart(chartSWF, strXML, chartdiv2) {
        //Create another instance of the chart.

        var chart = new FusionCharts(chartSWF, "FactorySum1", "520", "300", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv2);
    }

    function updateChart(y,s,st) {
      
        $.get("<?php echo base_url(); ?>main_dashboard/getStandardsData/" + y+"/"+s+"/"+st, function(data) {
            if ($('#changeChart').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div");
            }
        });
    }
    $(document).ready(function() {
     y=$('#changeData').val();
        s=$('#status').val();
          st=$('#standard_type').val();
        //create the chart initially
        $.get("<?php echo base_url(); ?>main_dashboard/getStandardsData/" + y+"/"+s+"/"+st, function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
        });
        
              $.get("<?php echo base_url();?>main_dashboard/getpieData_Standard/",function(data) {
		drawPieChart("<?php echo base_url();?>charts/Pie3D.swf",data, "gen-chart-render");
	});
     
           $.get("<?php echo base_url();?>main_dashboard/getpieData_Standard_type/",function(data) {
		drawPieChart("<?php echo base_url();?>charts/Pie3D.swf",data, "gen-chart-render1");
	});
        //update the chart if the dropdown selection changes
        $('#status,#changeData,#standard_type').change(function() {
           y=$('#changeData').val();
            s=$('#status').val();
            st=$('#standard_type').val();
                    updateChart(y, s,st);
                });
    

 
        $('.analyst_sample').click(function() {
            id = $(this).attr('id');
            $.getJSON("<?php echo base_url(); ?>main_dashboard/getAnalsytLabrefs/" + id, function(samples) {
                $data_area = $('#data_area');
                $data_area.empty();

                $.each(samples, function(i, data) {

                    data_holder = "<li><a href='<?php echo base_url(); ?>request_management/assigned_samples/" + data.lab_ref_no + " target=\"_blank\"'>" + data.lab_ref_no + "</a></li>";
                    $data_area.append(data_holder);
                });

            });


            $.fancybox({
                href: "#analyst_samples"
            });
            console.log(id);
        });
        
        var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
		rtable = $('#refsubs1').dataTable({
	/*"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
	"oTableTools": {
			"sSwfPath": "<?php echo base_url() . 'Scripts/tabletools/media/swf/copy_csv_xls_pdf.swf' ?>",
			"aButtons":[
			            {
					"sExtends": "copy",
					"mColumns": "all"
				      },
				      {
					"sExtends": "csv",                                        
					"sButtonText": "Excel",
                                        "sButtonId":"print_excel",
                                        "mColumns": "all"
					  }, 
					  {
					 "sExtends": "pdf",
					 "mColumns": [0,4,7] 
					  },
					  {
					 "sExtends": "print",
					 "mColumns": "all"
						      },		 ]
		},*/
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Name", "mData": "name"},
                    {"sTitle": "Standard Type", "mData": "standard_type"},
                    {"sTitle": "Source", "mData": "source"},
                    {"sTitle": "Batch No.", "mData": "batch_no"},
                    {"sTitle": "NQCL No.", "mData": "rs_code"},
                    {"sTitle": "Date Received", "mData": "date_received"},
                    {"sTitle": "Date of Expiry", "mData": "date_of_expiry"},                   
                    {"sTitle": "Potency", "mData": null,
                        "mRender": function(data, type, row) {
                            return row.potency + " " + row.potency_unit;
                        }},
                    {"sTitle": "Quantity", "mData": "quantity"},
                    {"sTitle": "Weight/Volume", "mData": null, "mRender": function(data, type, row) {
                            return row.init_mass + " " + row.init_mass_unit;
                        }},
                    {"sTitle": "Status", "mData": "status"},
                    {"sTitle": "Restandardisation Status", "mData": "restandardisation_status"},
                  
                    
                ],
                /*"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                 
                 if(aData[6] == '1970-01-01'){ 
                 $('td:eq(7)', nRow).css('background-color', 'red');
                 }
                 return nRow;
                 },*/
                
                "bDeferRender": true,
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 16,
                "sAjaxDataProp": "",
                "sAjaxSource": '<?php echo site_url() . "main_dashboard/getExpired1/" ?>'
            });
        }
    }
    $(document).ready(function() {
        getData();
    });
        
        
        
        $('.almost_expiry').click(function() {
        $.fancybox.close();
            $.fancybox({
                href:"#almost-expired"
            });
        });
        
        
         $('.expired').click(function() {       
              $.fancybox.close();
            $.fancybox({
                href:"#expired"
            });
        });
        });

</script>
<style>
    div.dataTables_length  {
        width: 100px;
    }
    div.dataTables_length label {
        display: none;
    }
    select{
      width: 100px;  
    }
    .heading{
        font-weight: bolder;
        font-size: 16px;
        text-transform: uppercase;
        
    }
</style>

<div id="analyst_samples" style="width:200px; height: 300px; display: none;">
    <ul id="data_area">

    </ul>
</div>
<div class="row-fluid">

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <div class="boxchart-overlay blue">
            <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
        </div>	
        <span class="title">Standards In Use</span>
        <span class="value"><?php echo $in_use; ?></span>
    </div>

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <div class="boxchart-overlay red">
            <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
        </div>	
        <span class="title">Effective Standards</span>
        <span class="value"><?php echo $effective; ?></span>
    </div>

    <div class="span3 smallstat box mobileHalf noMargin" ontablet="span6" ondesktop="span3">
        <i class="icon-check green"></i>
        <span class="title">Reserved Standards</span>
        <span class="value"><?php echo $reserved; ?></span>
    </div>

    <div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
        <i class="icon-ban-circle yellow"></i>
        <span class="title">Expired Standards</span>
        <span class="value"><?php echo $expired; ?></span>
    </div>

</div>	

<div  class="row-fluid">
    <span class="label label-warning almost_expiry"><?php echo $almost_expiry ?>  Standards Almost Expiring</span> &nbsp &nbsp<span class="label label-important expired"><?php echo $expired ?> &nbsp; Expired Standards</span>
            <div style="float:right; margin-right: 30px"><button class="btn btn-print print-client"><i class="icon-print">Print to Excel</i></button></div>

</div>

<div class="row-fluid">

    <div class="main-chart" style="height:400px;">


        Year Received:<select name="changeData" id="changeData">
            <?php foreach ($years as $every_year): ?>
                <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
            <?php endforeach; ?>	
        </select>
         Standard Status:<select name="status" id="status">
            <option value="In Use">In Use</option>	
            <option value="Effective">Effective</option>	
            <option value="Reserved">Reserved</option>	
            <option value="Expired">Expired</option>	
        </select>      
         Standard Type:<select name="standard_type" id="standard_type">
            <option value="Working">Working</option>	
            <option value="Primary">Primary</option>	
            <option value=""></option>	
           
        </select>
        <select name="changeChart" id="changeChart">
            <option value="3d">3D Version</option>
            <option value="2d">2D Version</option>
        </select><br>
        <div id="chart1div" align="left">Loading Data, Please Wait....</div>


    </div>	

</div>
<div class="row-fluid">
        <div class="box blue span6 noMargin" ontablet="span12" ondesktop="span6">
        <div class="box-header">
            <h2>STANDARD STATUS DISTRIBUTION <?php echo date('Y');?></h2>
        </div>
            <div class="box-content" style="float:left">

   	
                    <div id="gen-chart-render">

                    

                    </div>

        </div>	

    </div><!--/span-->




     <div class="box blue span6 noMargin" ontablet="span12" ondesktop="span6">
        <div class="box-header">
            <h2>STANDARD TYPE DISTRIBUTION <?php echo date('Y');?></h2>
        </div>
        <div class="box-content">

   	
                    <div id="gen-chart-render1">

                        <center>
                       
                        </center>

                    </div>

        </div>	

    </div><!--/span-->

</div>
</div>
<div id="standards_details" style="display:none">
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;margin:0px auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
.tg .tg-vn4c{background-color:#D2E4FC}
</style>
<table class="tg">
  <tr>
      <th class="tg-031e" colspan="4"></th>
    
  </tr>
  <tr>
    <td class="tg-vn4c heading" >Name</td>
    <td class="tg-vn4c Name"></td>
    <td class="tg-vn4c heading">Source</td>
    <td class="tg-vn4c source"></td>
  </tr>
  <tr>
    <td class="tg-031e heading">Batch Number</td>
    <td class="tg-031e batch_no"></td>
    <td class="tg-031e heading">RS Code</td>
    <td class="tg-031e rs_code"></td>
  </tr>
  <tr>
    <td class="tg-vn4c heading">Date Received</td>
    <td class="tg-vn4c date_r"></td>
    <td class="tg-vn4c heading">Effective Date</td>
    <td class="tg-vn4c e_date"></td>
  </tr>
  <tr>
    <td class="tg-031e heading">Date Of Expiry</td>
    <td class="tg-031e doe"></td>
    <td class="tg-031e heading">Date Of Restandardization</td>
    <td class="tg-031e dor"></td>
  </tr>
  <tr>
    <td class="tg-vn4c heading">Potency</td>
    <td class="tg-vn4c potency"></td>
    <td class="tg-vn4c heading">Available Quantity</td>
    <td class="tg-vn4c avq"></td>
  </tr>
  <tr>
    <td class="tg-031e heading ">Restandardization Status</td>
    <td class="tg-031e rest_stat"></td>
    <td class="tg-031e heading">Application</td>
    <td class="tg-031e applic"></td>
  </tr>
  <tr>
    <td class="tg-vn4c heading">Standard Type</td>
    <td class="tg-vn4c stype"></td>
    <td class="tg-vn4c heading">Comment</td>
    <td class="tg-vn4c comment"></td>
  </tr>
  <tr>
    <td class="tg-031e heading">RS Code Prefix</td>
    <td class="tg-031e rs_code_prefix"></td>
    <td class="tg-031e heading">Serial Number</td>
    <td class="tg-031e serial_no"></td>
  </tr>
</table>
</div>
<div id="almost-expired" style="display:none;">
    <?php $this->load->view('dashboard_views/almost_expiry');?>
</div>
<div id="expired" style="display:none; ">
    <center><p style="font-weight: bolder; text-decoration: underline;">EXPIRED STANDARDS</p></center>
<table id = "refsubs1">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>
    
    <script>
  

    $(document).ready(function() {
        $('.btn-print').click(function() {
            labref = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>printing/standards_printer/",             
                success: function(data){
                    window.location.href="<?php echo base_url()?>clients_templates/standards.xlsx";
                
                },
                error: function(data) {
                    return false;
                }
            });
           
        });

    });
</script>

    <link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css'?>" type="text/css" rel="stylesheet"/>







