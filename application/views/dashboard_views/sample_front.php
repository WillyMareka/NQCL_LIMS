<script src="<?php echo base_url(); ?>dashboard_assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>javascripts/moments.js"></script>

<script src='<?php echo  base_url();?>dashboard_assets/js/jquery.dataTables.min.js'></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.css" media="screen" />
        <style>
           table {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
table td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
table th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
table td{background-color:#C2FFD6}
.date_diff{color:springgreen};
        </style>
<script language="JavaScript">

    function loadtable(month,name){
     // $('.datatable').dataTable().fnDestroy();  
     
     arl = "";
     active_tab =$("#tabs > ul>.ui-tabs-active").attr('aria-controls');
     active_name =$("#tabs > ul>.ui-tabs-active").text();
       year = $('.changeData').val();
        if(active_tab ==='tabs-1'){
            $('#qTitle').text('NQCL ' + active_name + ' SAMPLES');
            $('#qDate').text(name + ' ' +year);
      url= "<?php echo site_url('main_dashboard/getMontylySamples') ?>/"+month;
    }else if(active_tab ==='tabs-2'){
          $('#qTitle').text('NQCL ' + active_name + ' SAMPLES');
           $('#qDate').text(name + ' ' +year);
       url= "<?php echo site_url('main_dashboard/getMontylySamplesAssigned') ?>/"+month;
    }else if(active_tab ==='tabs-7'){
         $('#qTitle').text('NQCL ' + active_name + ' SAMPLES');
          $('#qDate').text(name + ' ' +year);
         url= "<?php echo site_url('main_dashboard/getMontylyUrgentSamples') ?>/"+month;        
    }else if(active_tab ==='tabs-3'){
         $('#qTitle').text('NQCL ' + active_name + ' SAMPLES');
          $('#qDate').text(name + ' ' +year);
        url= "<?php echo site_url('main_dashboard/getMontylyRDCSamples/7') ?>/"+month;   
        
    }else if(active_tab ==='tabs-4'){
         $('#qTitle').text('NQCL ' + active_name + ' SAMPLES');
     url= "<?php echo site_url('main_dashboard/getMontylyPendingSamples') ?>/"+month;  
    }else if(active_tab ==='tabs-5'){
         $('#qTitle').text('NQCL ' + active_name + ' SAMPLES');
          $('#qDate').text(name + ' ' +year);
         url= "<?php echo site_url('main_dashboard/getMontylyDraftCSamples/8') ?>/"+month; 
    }else if(active_tab ==='tabs-6'){
         $('#qTitle').text('NQCL ' + active_name + ' SAMPLES');
          $('#qDate').text(name + ' ' +year);
       url= "<?php echo site_url('main_dashboard/getMontylyDraftCompletedSamples/11') ?>/"+month; 
    }
     
          if(active_tab ==='tabs-2'){
              $table1= $('#example3').dataTable({     
      
                "sPagination": "full_numbers",
                "bJQueryUI": true,
                "aoColumnsDefs": [
           { "sClass": "date_diff", "aTargets": [5] }
           ],
                "aoColumns": [
                    {"sTitle": "Request ID", "mData": "labref"},
                    {"sTitle": "Client Name", "mData": "name"},
                    {"sTitle": "Product Name.", "mData": "product_name"},
                    {"sTitle": "Date Received.", "mData": "designation_date"},   
                    {"sTitle": "Analyst Name", "mData": "by"}, 
                     {"sTitle": "How long", "mData": "date_issued",
                        "mRender": function(data, type, full) {        

                       var start = moment(full.date_returned);
                      var end = moment(full.date_issued);
                   
                            return start.diff(end,'days') +' Days';
                        }
                    },
                    {"sTitle": "More Info", "mData": "labref",
                        "mRender": function(data, type, full) {
                            return '<button class="show-data btn btn-small btn-primary" id = ' + data + ' >View</button>';
                        }
                    },
                ],
                "bDeferRender": true,
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 10,
                "sAjaxDataProp": "",
                "sAjaxSource": url,
                "aaSorting": [[3, "asc"]]
            });

            
            $('#example3').css('width','100%');
            
                     $.fancybox({
                href:"#drill-down3"
            })   
            
         $('.show-data').live('click',function(){
  
      
           var nTr = this.parentNode.parentNode;

                if ($(this).text() == 'view') {

                    $(this).text("close");

                    //alert("Under Construction");

                    var id = $(this).attr("id");
                    //console.log(id);

                    $.post("<?php echo site_url('main_dashboard/more_view_samples'); ?>" + "/" + id , function(more) {

                        $table1.fnOpen(nTr, more, 'more');
                    })

                }

                else {

                    $table1.fnClose(nTr);
                    $(this).text("view");
                }
        });
              
    }else{
      
             $table= $('#example1').dataTable({
      
      
                "sPagination": "full_numbers",
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Request ID", "mData": "request_id"},
                    {"sTitle": "Client Name", "mData": "name"},
                    {"sTitle": "Product Name.", "mData": "product_name"},
                    {"sTitle": "Date Received.", "mData": "designation_date"}, 
                      {"sTitle": "Batch No", "mData": "batch_no"},            
                                  
                    {"sTitle": "More Info", "mData": "request_id",
                        "mRender": function(data, type, full) {
                            return '<button class="show-data btn btn-small btn-primary" id = ' + data + ' >View</button>';
                        }
                    },
                ],
                "bDeferRender": true,
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 10,
                "sAjaxDataProp": "",
                "sAjaxSource": url,
                "aaSorting": [[3, "asc"]]
            });
            
            $('#example1').css('width','100%');
            
                     $.fancybox({
                href:"#drill-down1"
            });
            
                 $('.show-data').live('click',function(){
  
        $
           var nTr = this.parentNode.parentNode;

                if ($(this).text() == 'view') {

                    $(this).text("close");

                    //alert("Under Construction");

                    var id = $(this).attr("id");
                    //console.log(id);

                    $.post("<?php echo site_url('main_dashboard/more_view_samples'); ?>" + "/" + id , function(more) {

                        $table.fnOpen(nTr, more, 'more');
                    })

                }

                else {

                    $table.fnClose(nTr);
                    $(this).text("view");
                }
        });
            
           
         
            
        }
   }
    
    function drawChart(chartSWF, strXML, chartdiv) {
        //Create another instance of the chart.
        var chart = new FusionCharts(chartSWF, "chart1Id", "800", "400", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv);
    }
    
  

    function singleOut(i) {       
        year = $('.changeData').val();
        month = i;
        montyly = year +"-"+i; 
      month=GetMonthName(i);      
       loadtable(montyly,month);       
            
    }
    
    function GetMonthName(monthNumber) {
  var months = ['January', 'February', 'March', 'April', 'May', 'June',
  'July', 'August', 'September', 'October', 'November', 'December'];
  return months[monthNumber-1];
} 
    

  


    function drawPieChart(chartSWF, strXML, chartdiv1) {
        //Create another instance of the chart.

        var chart = new FusionCharts(chartSWF, "FactorySum", "600", "300", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv1);
    }

    function updateChart() {
        //call the CI data url
        $.get("<?php echo base_url(); ?>main_dashboard/getData/" + $('.changeData').val(), function(data) {
            if ($('#changeChart').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div");
            }
        });
    }
    $(document).ready(function() {

        getData();
        $("#tabs").tabs();
        $.get("<?php echo base_url(); ?>main_dashboard/getData/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
        });
         $.get("<?php echo base_url(); ?>main_dashboard/getDataAssigned/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div1");
        });
          $.get("<?php echo base_url(); ?>main_dashboard/getDataUrgent/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div6");
        });
          $.get("<?php echo base_url(); ?>main_dashboard/getDataPending/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div3");
        });
          $.get("<?php echo base_url(); ?>main_dashboard/getDataDrafting/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div4");
           });
          $.get("<?php echo base_url(); ?>main_dashboard/getDataCompleted/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div5");
        });
          $.get("<?php echo base_url(); ?>main_dashboard/getDataReview/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div2");
        });
        //update the chart if the dropdown selection changes
        $('.changeChart').change(function() {
            updateChart();
        });
        $('.changeData').change(function() {
            updateChart();
        });

        $.get("<?php echo base_url(); ?>main_dashboard/getpieData_Request/", function(data) {
            drawPieChart("<?php echo base_url(); ?>charts/Pie3D.swf", data, "gen-chart-render");
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



        $('#year1,#month,#day').change(function() {
            y = $('#year1').val();
            m = $('#month').val();
            d = $('#day').val();
            $("#example > tbody").empty();
            $('#example').dataTable().fnDestroy();


            $('#example').dataTable({
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Action", "mData": null, "sClass": "details-control",
                        "mRender": function(data, type, row) {
                            return "<a class='detail_controls' href='#' id='" + row.user_id + "'>+</a>";
                        }},
                    {"sTitle": "ANALYST NAME", "mData": "by"},
                   // {"sTitle": "DEPARTMENT", "mData": "name"},
                    {"sTitle": "MONTHLY SAMPLES", "mData": "Total_samaples"}

                ],
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 16,
                "sAjaxDataProp": "",
                "sAjaxSource": "<?php echo site_url('main_dashboard/load_analysys_request'); ?>/" + y + '/' + m
            });
            $('#example').css('width', '100%');

        });





        function getData() {
       // alert(1);
            var table;
            y = $('#year1').val();
            m = $('#month').val();
            d = $('#day').val();
            table = $('#example').dataTable({
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Action", "mData": null, "sClass": "details-control",
                        "mRender": function(data, type, row) {
                            return "<a class='detail_controls' href='#' id='" + row.user_id + "'>+</a>";
                        }},
                    {"sTitle": "ANALYST NAME", "mData": "by"},
                   // {"sTitle": "DEPARTMENT", "mData": "name"},
                    {"sTitle": "MONTHLY SAMPLES", "mData": "Total_samaples"}




                ],
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 16,
                "sAjaxDataProp": "",
                "sAjaxSource": "<?php echo site_url('main_dashboard/load_analysys_request'); ?>/" + y + '/' + m,
            });
            $('.detail_controls').live("click", function(e) {
                e.preventDefault();
                y = $('#year1').val();
                m = $('#month').val();
                d = $('#day').val();
                var nTr = this.parentNode.parentNode;

                if ($(this).text() == '+') {

                    $(this).text("-");

                    //alert("Under Construction");

                    var id = $(this).attr("id");
                    //console.log(id);

                    $.post("<?php echo site_url('main_dashboard/more_view'); ?>" + "/" + id + "/" + y + "/" + m , function(more) {

                        table.fnOpen(nTr, more, 'more');
                    })

                }

                else {

                    table.fnClose(nTr);
                    $(this).text("+");
                }
            });

        }
        
   


    });

</script>
<style>
    td.detail_controls {
        background: url('details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.detail_controls{
        background: url('details_close.png') no-repeat center center;
    }
</style>
<style>
    #gps_information{
        display: none;
        width: 290px;
        height: 220px;

    }
    label{
        font-weight: bold;
        display: block;
    }
    #an-sup{
        background: -webkit-linear-gradient(orange, yellow); /* For Safari */
        background: -o-linear-gradient(orange, yellow); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(orange, yellow); /* For Firefox 3.6 to 15 */
        background: linear-gradient(orange, yellow); /* Standard syntax (must be last) */
        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:18%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #an-doc{
        background: -webkit-linear-gradient(yellow,blue); /* For Safari */
        background: -o-linear-gradient(yellow,blue); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(yellow,blue); /* For Firefox 3.6 to 15 */
        background: linear-gradient(yellow,blue); /* Standard syntax (must be last) */
        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:37%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #sup{
        background: yellow; /* Standard syntax (must be last) */
        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:28%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }
    #doc{
        background: blue;/* Standard syntax (must be last) */
        text-align: center; 
        color: white; 
        font-weight: bolder; 
        width:45%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #rev{
        background: indigo; /* Standard syntax (must be last) */
        text-align: center; 
        color: white; 
        font-weight: bolder; 
        width:55%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }
    #doc2{
        background: violet;/* Standard syntax (must be last) */
        text-align: center; 
        color: white; 
        font-weight: bolder; 
        width:63%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
    }

    #ddir{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:72%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: turquoise;
    }
    #sddir{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:82%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: skyblue;
    }
    #doc3{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:100%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: yellowgreen;
    }
    #doc31{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:100%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: lime;
    }

    #sec{

        text-align: center; 
        color: black; 
        font-weight: bolder; 
        width:10%; 
        height: 30px; 
        border-radius: 3px; 
        padding-top: 8px;
        background: orange;
    }
    ul > li{
        font-size: 10px;
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
        <span class="title">Clients</span>
        <span class="value"><?php echo $all_clients; ?></span>
    </div>

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <div class="boxchart-overlay red">
            <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
        </div>	
        <span class="title">Analysis Request</span>
        <span class="value"><?php echo $all_samples; ?></span>
    </div>

    <div class="span3 smallstat box mobileHalf noMargin" ontablet="span6" ondesktop="span3">
        <i class="icon-check green"></i>
        <span class="title">Assigned Samples</span>
        <span class="value"><?php echo $all_assigned; ?></span>
    </div>

    <div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
        <i class="icon-ban-circle yellow"></i>
        <span class="title">Un-assigned Samples</span>
        <span class="value"><?php echo $all_unassigned; ?></span>
    </div>

</div>	

<div class="row-fluid">
    <div style="float:right; margin-right: 30px"><button class="btn btn-print print-client"><i class="icon-print">Print to Excel</i></button></div>


    <div id="tabs">
        <ul class="tabs">
            <li><a href="#tabs-1">RECEIVED SAMPLES</a></li>
            <li><a href="#tabs-2">ASSIGNED </a></li>
             <li><a href="#tabs-7">URGENT </a></li>
            <li><a href="#tabs-3">REVIEWED </a></li>
            <li><a href="#tabs-4">PENDING </a></li>
            <li><a href="#tabs-5">FOR DRAFT CERTIFICATE </a></li>
            <li><a href="#tabs-6">COMPLETED </a></li>
        </ul>
             <p></p><br>
                    <p> <select name="changeData" class="changeData">
<?php foreach ($years as $every_year): ?>
                        <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
                    <?php endforeach; ?>	
                </select>   

                <select name="changeChart" class="changeChart">
                    <option value="3d">3D Version</option>
                    <option value="2d">2D Version</option>
                </select>  <div><button id="tot" class="btn btn-siccess btn-arrow-right"><i class="icon-arrow-right"></i>View Analyst Turn Around Time</button></div><br>
               
        <div id="tabs-1">
            <p>
            <div id="chart1div" align="left">Loading Data, Please Wait....</div>
            </p>
        </div>
        <div id="tabs-2">
            <p> <div id="chart1div1" align="left">Loading Data, Please Wait....</div></p>
        </div>
                       <div id="tabs-7">
            <p> <div id="chart1div6" align="left">Loading Data, Please Wait....</div></p>
        </div>
        <div id="tabs-3">
            <p> <div id="chart1div2" align="left">Loading Data, Please Wait....</div></p>
        </div>
        <div id="tabs-4">
            <p> <div id="chart1div3" align="left">Loading Data, Please Wait....</div></p>
        </div>
        <div id="tabs-5">
            <p> <div id="chart1div4" align="left">Loading Data, Please Wait....</div></p>
        </div>
        <div id="tabs-6">
            <p> <div id="chart1div5" align="left">Loading Data, Please Wait....</div></p>
        </div>
    </div>  



    <!--    <div class="main-chart" style="height:400px;">
    
    
            <select name="changeData" id="changeData">
<?php foreach ($years as $every_year): ?>
                        <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
    <?php endforeach; ?>	
            </select>   
    
            <select name="changeChart" id="changeChart">
                <option value="3d">3D Version</option>
                <option value="2d">2D Version</option>
            </select>  <div><button id="tot" class="btn btn-siccess btn-arrow-right"><i class="icon-arrow-right"></i>View Analyst Turn Around Time</button></div><br>
            <div id="chart1div" align="left">Loading Data, Please Wait....</div>
    
    
        </div>	-->

</div>

<div class="row-fluid">

    <div class="span6" ontablet="span12" ondesktop="span6">

        <div class="row-fluid">
            <div class="span12 multi-stat-box box" style="width: 550px; height: 360px ">
                <div class="header row-fluid">
                    <div class="left">
                        <h2>Analysis Request Overview</h2>
                        <a class="icon-chevron-down"></a>
                    </div>
                    <div class="right">
                        <h2>Request State <?php echo date('Y'); ?></h2>
<!--                        <div class="percent"><i class="icon-double-angle-up"></i> 22%</div>-->
                    </div>
                </div>
                <div class="content row-fluid">	
                    <div class="left" style=" height: 360px ">
                        <ul>
                            <li>
                                <span class="date">Registered So Far</span>
                                <span class="value"><?php echo $all_samples; ?></span>
                            </li>
                            <li class="active">
                                <span class="date">This week</span>
                                <span class="value"><?php echo $weekly[0]->perweek; ?></span>
                            </li>
                            <li>
                                <span class="date">Yesterday</span>
                                <span class="value"><?php echo $yesterday[0]->perweek; ?></span>
                            </li>
                            <li>
                                <span class="date">Today</span>
                                <span class="value"><?php echo $today[0]->perweek; ?></span>
                            </li>
                        </ul>	
                    </div>

                    <div class="right" style=" height: 360px ">
                        <ul>
                            <li>
                                <span class="date">Popular Client:</span><br>
                                <span class="value"><u><strong><i><?php echo $p_client[0]->client_name; ?></i></strong></u></span><br>
                                <span class="date"><?php echo $p_client[0]->total; ?>  Analysis Requests so far in <?php echo date('Y'); ?></span><br>
                            </li>
                            <li class="active">
                                <span class="value"><u><strong><i><?php echo $p_product[0]->product_name; ?></i></strong></u></span><br>
                                <span class="date"><?php echo $p_product[0]->total; ?>  Products Registered so far in <?php echo date('Y'); ?></span><br>
                            </li>

                        </ul>	
                    </div>
                </div>	
            </div>



        </div>	

    </div>				

    <div class="box blue span6 noMargin" ontablet="span12" ondesktop="span6">
        <div class="box-header">
            <h2>REQUEST STATE <?php echo date('Y'); ?></h2>
        </div>
        <div class="box-content">


            <div id="gen-chart-render">

                <center>

                </center>

            </div>

        </div>	

    </div><!--/span-->

</div>

<div class="row-fluid">

    <div class="span7" ontablet="span12" ondesktop="span7" style="width:550px; ">



        <div class="row-fluid">

            <div class="box calendar span12">
                <div class="calendar-details">
                    <div class="day"><?php echo date('j\<\s\u\p\>S\<\/\s\u\p\> M, Y'); ?></div>
                    <div class="date"></div>
                    <ul class="events">
                        <!--                        <li>MAY 22, 19:30 Meeting</li>
                                                <li>MAY 22, 19:30 Meeting</li>-->
                    </ul>
                    <div class="add-event">
                        <i class="icon-plus"></i>
                        <input type="text" class="new event" value="" />
                    </div>		
                </div>	
                <div class="calendar-small"></div>
                <div class="clearfix"></div>
            </div><!--/span-->

        </div>


    </div>






</div>


<div id="dialog" title="ANALYST TURNOVER TIME DETAILS" style="width:1100px; height:200px">
<!--    <select id="day" style="width:60px;" selected="selected">
        <option value="<?php echo sprintf("%02s", date('d')); ?>"><?php echo date('d'); ?></option>
<?php foreach ($days as $every_day): ?>
            <option value="<?php echo $every_day; ?>" ><?php echo $every_day; ?></option>
        <?php endforeach; ?>
    </select>-->
    <select id="month" style="width:120px;" selected="selected">
        <option value="<?php echo date('m'); ?>"><?php echo date('F'); ?></option>
<?php foreach ($months as $every_month): ?>
            <option value="<?php echo $every_month; ?>" ><?php echo date('F', mktime(0, 0, 0, $every_month, 10)); ?></option>
        <?php endforeach; ?>
    </select>
    <select id="year1" style="width:70px;">
        <?php foreach ($years as $every_year): ?>
            <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
        <?php endforeach; ?>
    </select><br>
    <div style="width:500px;" id="drill-down">
        <table id="example" class="display" cellspacing="0" width="" class="datatable bootstrap-datatable" >
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
    
     <div style="width:1150px;" id="drill-down1">
         <div id="info_area" style="width: 100%; height: 50px; margin: 5px; background: #1E8FC6;">
             <center> <table style="color:white; font-weight: bolder;">
                 <tr>
                     <td id="qTitle" style="text-align: center;"></td>
                 </tr>
                 <tr>
                     <td id="qDate" style="text-align: center; text-transform: uppercase;"></td>
                 </tr>
             </table>
             </center>
         </div>
        <table id="example1" class="display" cellspacing="0" width="" class="datatable bootstrap-datatable" >
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
    
    
       <div style="width:1150px;" id="drill-down2">           
               
           
        <table id="example2" class="display" cellspacing="0" width="" class="datatable bootstrap-datatable" >
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
           <div style="width:1150px;" id="drill-down3">           
               
           
        <table id="example3" class="display" cellspacing="0" width="" class="datatable bootstrap-datatable" >
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div id="details" style="width:545px; height:500px;"></div>
    
    <div style="width:545px; height:500px; margin-left: 520px; background: yellowgreen; position: absolute; top:50px;">

    </div>

</div>
<style>
    td.detail-controls {
        background: blue;
        cursor: pointer;
    }
    tr.shown td.detail-controls {
        background: url('details_close.png') no-repeat center center;
    }
</style>

<script>


    $(function() {
        $("#dialog").dialog({
            autoOpen: false,
            height: 600,
            width: 1100,
            modal: true,
            show: {
                effect: "slide",
                duration: 1000
            },
            hide: {
                effect: "slide",
                duration: 1000
            }
        });
        $("#tot").click(function() {
            $("#dialog").dialog("open");
        });
    });


    $(document).ready(function() {
        $('.pop').click(function() {
            labref = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>sample_location/gps/" + labref,
                dataType: "json",
                success: function(data)
                {

                    $.each(data, function(id, info)
                    {

                        $('#gps_information').html("<label>CURRENT LOCATION</label>" + info.current_location + "<br><br><label> SAMPLE:</label> " + info.labref + "<br><br><label> ACTIVITY:</label> " + info.activity + "<br><br><label> FROM:</label>  " + info.from + "<br><br> <label>TO:</label>  " + info.to + "<br><br> <label>DATE:</label> " + info.date);


                        $.fancybox({
                            href: '#gps_information'

                        });


                    });


                    return true;
                },
                error: function(data) {



                    return false;
                }
            });
            return false;
        });

    });
</script>

<script>


    $(document).ready(function() {
        $('.btn-print').click(function() {
            labref = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>printing/request_printer/",
                success: function(data) {
                    window.location.href = "<?php echo base_url() ?>clients_templates/requests.xlsx";

                },
                error: function(data) {
                    return false;
                }
            });

        });

    });
</script>


</div>	

</div>


