<script src="<?php echo base_url(); ?>dashboard_assets/js/jquery-1.10.2.min.js"></script>
<link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css' ?>" type="text/css" rel="stylesheet"/>
<script language="JavaScript">
    function drawChart(chartSWF, strXML, chartdiv) {
        //Create another instance of the chart.
        var chart = new FusionCharts(chartSWF, "chart1Id", "550", "350", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv);
    }

    function singleOut() {

    }


    function drawPieChart(chartSWF, strXML, chartdiv1) {
        //Create another instance of the chart.

        var chart = new FusionCharts(chartSWF, "FactorySum", "500", "300", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv1);
    }

    function updateChart() {
        //call the CI data url
        $.get("<?php echo base_url(); ?>main_dashboard/getClientsData/" + $('#changeData').val(), function(data) {
            if ($('#changeChart').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div");
            }
        });
    }
    $(document).ready(function() {
   
        $('#end').prop('disabled', true);
        $('#end').prop('disabled', true);
        $('#filter').prop('disabled', true);
        $('#error').hide();
        //create the chart initially
        $.get("<?php echo base_url(); ?>main_dashboard/getClientsData/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
        });
        //update the chart if the dropdown selection changes
        $('#changeChart').change(function() {
            updateChart();
        });
        $('#changeData').change(function() {
            updateChart();
        });

        $.get("<?php echo base_url(); ?>main_dashboard/getpieData_Clients/", function(data) {
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

    });

    $(document).ready(function() {


        draw();
        getData();


        function draw() {
            var rtable = $('.table-striped').dataTable({
                "sPagination": "full_numbers",
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Name", "mData": "name"},
                    {"sTitle": "Email Address.", "mData": "email"},
                    {"sTitle": "Address", "mData": "address"},
                    //{"sTitle": "Status.", "mData": "status"},
                    {"sTitle": "Client Type.", "mData": "client_type"},
                    {"sTitle": "Contact Person", "mData": "contact_phone"},
                    {"sTitle": "Contact Phone", "mData": "contact_phone"},
                    {"sTitle": "Customer Discount", "mData": "discount_percentage"},
                    {"sTitle": "View", "mData": "id",
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
                "sAjaxSource": '<?php echo site_url() . "main_dashboard/getAllClients/" ?>',
                "aaSorting": [[3, "asc"]]
            });

        }


        $('#data_changer').change(function() {
            $(".table-stripedtbody").empty();
            $('.table-striped').dataTable().fnDestroy();
            if ($(this).val() === '') {
                draw();
                $('.table-striped').css('width', '100%');
            } else {

                $('.table-striped').dataTable({
                    "bJQueryUI": true,
                    "bautoWidth": false,
                    "aoColumns": [
                        {"sTitle": "Name", "mData": "name"},
                        {"sTitle": "Email Address.", "mData": "email"},
                        {"sTitle": "Address", "mData": "address"},
                        //{"sTitle": "Status.", "mData": "status"},
                        {"sTitle": "Client Type.", "mData": "client_type"},
                        {"sTitle": "Contact Person", "mData": "contact_phone"},
                        {"sTitle": "Contact Phone", "mData": "contact_phone"},
                        {"sTitle": "Customer Discount", "mData": "discount_percentage"},
                        {"sTitle": "View", "mData": "id",
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
                    "sAjaxSource": '<?php echo site_url() . "main_dashboard/getAllClientType/"; ?>' + $(this).val(),
                    "aaSorting": [[3, "asc"]]



                });
                $('.table-striped').css('width', '100%');
            }
        });

        $('#filter').click(function() {
            start = $('#start').val();
            end = $('#end').val();
            $(".table-stripedtbody").empty();
            $('.table-striped').dataTable().fnDestroy();

            $('.table-striped').dataTable({
                "bJQueryUI": true,
                "bautoWidth": false,
                "aoColumns": [
                    {"sTitle": "Name", "mData": "name"},
                    {"sTitle": "Email Address.", "mData": "email"},
                    {"sTitle": "Address", "mData": "address"},
                    //{"sTitle": "Status.", "mData": "status"},
                    {"sTitle": "Client Type.", "mData": "client_type"},
                    {"sTitle": "Contact Person", "mData": "contact_phone"},
                    {"sTitle": "Contact Phone", "mData": "contact_phone"},
                    {"sTitle": "Customer Discount", "mData": "discount_percentage"},
                    {"sTitle": "View", "mData": "id",
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
                "sAjaxSource": '<?php echo site_url() . "main_dashboard/loadClientsDatedData/"; ?>' + start + '/' + end,
                "aaSorting": [[3, "asc"]]



            });
            $('.table-striped').css('width', '100%');

        });
        
        $(document).on('click','.show-data',function(){
        id=$(this).attr('id');
        getData(id);
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
          $("#dialog").dialog("open");
        });



        $("#start").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            changeDay: true
        });

        $("#end").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            maxDate: new Date
        });
        $('#start').change(function() {
            if ($(this).val() !== '') {
                $('#end').prop('disabled', false);
                $('#filter').prop('disabled', false);
            }
        });

        $('#start,#end').change(function() {

            if ($('#start').val() === $('#end').val())
            {
                $('#filter').prop('disabled', true);
                $('#error').slideDown('slow');
                $('#end').val('');
            } else {
                $('#filter').prop('disabled', false);
                $('#error').slideUp('slow');
            }
        });
        
    
        
        
        
        function getData(id){
    var table;
	   y=$('#year1').val();
         m=$('#month').val();
          d=$('#day').val();
		table = $('#example').dataTable({
	
                "bJQueryUI": true,
                "aoColumns": [
                        {"sTitle": "Action", "mData": null, "sClass":"details-control",
                        "mRender": function(data, type, row) {
                            return "<a class='detail_controls' href='#' id='"+row.request_id+"'>+</a>";
                        }} ,
                    {"sTitle": "REQUEST ID", "mData": "request_id"},
                    {"sTitle": "SAMPLE QTY", "mData": "sample_qty"},
                    {"sTitle": "PRODUCT NAME", "mData": "product_name"},
                    {"sTitle": "BATCH NUMBER", "mData": "batch_no"},  
                    {"sTitle": "DOSAGE FORM", "mData": "name"}  
                                    
                        
                  
                    
                ],
           
              
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 16,
                "sAjaxDataProp": "",
                "sAjaxSource": "<?php echo site_url('main_dashboard/load_client_samples'); ?>/"+id,
            });
$('.detail_controls').live("click",function(e){
            e.preventDefault();
              y=$('#year1').val();
         m=$('#month').val();
          d=$('#day').val();
            var nTr = this.parentNode.parentNode;

                    if($(this).text() == '+'){

                       $(this).text("-");

                            //alert("Under Construction");

                            var id = $(this).attr("id");
                            //console.log(id);

                            $.post("<?php echo site_url('main_dashboard/more_view'); ?>" + "/" + id+"/"+y+"/"+m+"/"+d , function(more){

                                    table.fnOpen(nTr, more, 'more');
                            })

                    }

            else{

                            table.fnClose(nTr);
                            $(this).text("+");	
   }
});

    }
  

    });

    




</script>
<style>
    div.dataTables_length  {
        width: 100px;
    }
    div.dataTables_length label {
        display: none;
    }
</style>
<style>

</style>
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
    <div id="time_selector">
        <span id="error" style="background: red; color:white;">Start and end Date cannot be the same.</span><br>
        <input type="text" id="start"  style="width:100px;"/>
        <input type="text" id="end"  style="width:100px;"/>
        <input type="button" value="Filter" id="filter"/>
    </div>

    <select id="data_changer" style="float:right; margin-right: 30px;" >
        <option>Select Client Type</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
    </select>

    <table class="table table-striped table-bordered ">
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
<div style="width: 100%; height: 20px;"></div>

<div class="row-fluid">
    <div class="box blue span6 noMargin" ontablet="span12" ondesktop="span6">
        <div class="box-header">
            <h2>CLIENT NUMBERS <?php echo date('Y'); ?></h2>
        </div>
        <div class="box-content" style="float:left">




            <select name="changeData" id="changeData">
                <?php foreach ($years as $every_year): ?>
                    <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
                <?php endforeach; ?>	
            </select>
            <select name="changeChart" id="changeChart">
                <option value="3d">3D Version</option>
                <option value="2d">2D Version</option>
            </select><br>
            <div id="chart1div" align="left">Loading Data, Please Wait....</div>


        </div>
    </div>	





    <div class="box blue span6 noMargin" ontablet="span12" ondesktop="span6">
        <div class="box-header">
            <h2>CLIENT TYPES DISTRIBUTION <?php echo date('Y'); ?></h2>
        </div>
        <div class="box-content">


            <div id="gen-chart-render">

                <center>

                </center>

            </div>

        </div>	

    </div><!--/span-->

</div>



<div id="dialog" title="CLIENT SAMPLES" style="width:1100px; height:200px">
    <select id="day" style="width:60px;" selected="selected">
        <option value="<?php echo sprintf("%02s", date('d')); ?>"><?php echo date('d'); ?></option>
        <?php foreach ($days as $every_day): ?>
            <option value="<?php echo $every_day; ?>" ><?php echo $every_day; ?></option>
        <?php endforeach; ?>
    </select>
    <select id="month" style="width:90px;" selected="selected">
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
    <div style="width:100%;">
        <table id="example" class="display" cellspacing="0" width="" class="datatable bootstrap-datatable" style="width:100%" >
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

</div>





<script>


    $(document).ready(function() {
        $('.btn-print').click(function() {
            labref = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>printing/clients_printer/",
                success: function(data) {
                    window.location.href = "<?php echo base_url() ?>clients_templates/clients.xlsx";

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


