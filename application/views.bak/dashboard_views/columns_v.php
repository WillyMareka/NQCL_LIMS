<script src="<?php echo base_url(); ?>dashboard_assets/js/jquery-1.10.2.min.js"></script>
 <link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css'?>" type="text/css" rel="stylesheet"/>
<script>        
        $(document).ready(function(){
            draw();
     
            
        function draw(){
        var rtable = $('#refsubs1').dataTable({
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Type", "mData": "column_type"},
                    {"sTitle": "Serial No.", "mData": "serial_no"},
                {"sTitle": "Manufacturer", "mData": "manufacturer"},
                //{"sTitle": "Status.", "mData": "status"},
                {"sTitle": "Column Number.", "mData": "column_no"},
                {"sTitle": "Reserved For", "mData": "reserved_for"},
                {"sTitle": "Date of Expiry", "mData": "date_received"},
                {"sTitle":"View","mData":"id",
		"mRender":function(data, type, full){
			return '<button class="edit btn btn-small btn-primary" id = '+data+' >View</button>';
		}
	       },
            ],
            "bDeferRender": true,
            "bProcessing": true,
            "bDestroy": true,
            "bLengthChange": true,
            "iDisplayLength": 10,
            "sAjaxDataProp": "",
            "sAjaxSource": '<?php echo site_url() . "main_dashboard/getAllColumns1/" ?>',
            "aaSorting": [[ 3, "asc" ]]
        });
        
        }
        
       


      
        $('#data_changer').change(function(){  
             $("#refsubs1 tbody").empty();
           $('#refsubs1').dataTable().fnDestroy();
            if($(this).val()===''){
                draw();
                 $('#refsubs1').css('width','100%');
            }else{
           
           $('#refsubs1').dataTable({
                "bJQueryUI": true,
                "bautoWidth":false,
                "aoColumns": [
                    {"sTitle": "Type", "mData": "column_type"},
                    {"sTitle": "Serial No.", "mData": "serial_no"},
                {"sTitle": "Manufacturer", "mData": "manufacturer"},
                //{"sTitle": "Status.", "mData": "status"},
                {"sTitle": "Column Number.", "mData": "column_no"},
                {"sTitle": "Reserved For", "mData": "reserved_for"},
                {"sTitle": "Date of Expiry", "mData": "date_received"},
                   {"sTitle":"View","mData":"id",
		"mRender":function(data, type, full){
			return '<button class="edit btn btn-small btn-primary" id = '+data+' >View</button>';
		}
	       },
               
            ],
            "bDeferRender": true,
            "bProcessing": true,
            "bDestroy": true,
            "bLengthChange": true,
            "iDisplayLength": 10,
            "sAjaxDataProp": "",
            "sAjaxSource": '<?php echo site_url() . "main_dashboard/getAllIssuedColumns/";?>'+$(this).val(),
            "aaSorting": [[ 3, "asc" ]]
            
            
            
        });
        $('#refsubs1').css('width','100%');
          }
        });
        
        
    });
    
          $(document).ready(function(){ 
         $(document).on('click','.btn-primary',function(){
            id=$(this).attr('id');
            $.ajax({
            type:"get",
            url:"<?php echo base_url();?>main_dashboard/loadColumn/"+id,
            dataType:"json",
            success:function(standards){
                 $('.dimension').text('');
                         $('.issued_to').text('');
                $.each(standards, function(i, standard_data){               
                        
                        if(standard_data.length < '1'){
                            $('.dimension').text('None - Available In store');
                        $('.issued_to').text('None - Available In store'); 
                    }else{
                        $('.issued_to').text(standard_data.fname +' '+ standard_data.lname) 
                        $('.dimension').text(standard_data.column_type);
                    }
                    
                var rtable = $('#history_table').dataTable({
                "bJQueryUI": true,
                "aoColumns": [
                  
                       {"sTitle":"Name","mData":null,
		"mRender":function(data, type, full){
			return full.fname +" "+ full.lname;
		}
	       },
               {"sTitle": "Request ID", "mData": "request_id"},
               {"sTitle": "Product", "mData": "product_name"}, 
               {"sTitle": "Date Issued", "mData": "date"}, 
             
            ],
            "bDeferRender": true,
            "bProcessing": true,
            "bDestroy": true,
            "bLengthChange": true,
            "iDisplayLength": 10,
            "sAjaxDataProp": "",
            //"bServerSide": true,
            "sAjaxSource": '<?php echo site_url() . "main_dashboard/getColumnHistory/" ?>'+id,
            "aaSorting": [[ 3, "asc" ]]
        });              
                $('#history_table').css('width','100%'); 
                 
                });
                $.fancybox({
                    href:"#standards_details"                    
                });
            },error:function(e){
                alert('An error was encountered, please try again later!');
            }
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
    td{
        text-align: center;
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

<div class="row-fluid">
        <div style="float:right; margin-right: 30px"><button class="btn btn-print print-client"><i class="icon-print">Print to Excel</i></button></div>

    <select id="data_changer" style="float:right; margin-right: 30px;">
        <option></option>
        <option value="Issued">Issued</option>
    </select>
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


    </div>	
<div class="clearfix" style="height:20px; width: 100%;"></div>

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
<div style="text-align: center; text-decoration: underline;font-weight: bolder">CURRENT COLUMN HOLDER</div>
<table class="tg">
  <tr>
      <th class="tg-031e" colspan="4"></th>
    
  </tr>
  <tr>
    <td class="tg-vn4c heading" >Column Type</td>
    <td class="tg-vn4c dimension"></td>
    <td class="tg-vn4c heading">Issued To</td>
    <td class="tg-vn4c issued_to"></td>
  </tr>
  
</table>
<div style="text-align: center; text-decoration: underline;font-weight: bolder; padding-top:5px; ">COLUMN ISSUANCE AND SAMPLE USAGE RECORDS</div>

<div style="width:100%; height: 20px;"></div>
<table id = "history_table">
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

<script>
  

    $(document).ready(function() {
        $('.btn-print').click(function() {
            labref = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>printing/column_printer/",             
                success: function(data){
                    window.location.href="<?php echo base_url()?>clients_templates/columns.xlsx";
                
                },
                error: function(data) {
                    return false;
                }
            });
           
        });

    });
</script>






