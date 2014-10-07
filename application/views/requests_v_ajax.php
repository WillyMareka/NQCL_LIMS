<div class ="content">
<div id = "nav_left_container">
	<ul id = "nav_ul_left" >
		<li class = "first">
			<span><legend><a href = "<?php echo base_url().'request_management/add' ?>" >Add New</a></legend></span>
		</li>
		<li class = "role" >
			<legend><a id ="gen_label" href = "<?php echo base_url().'request_management/add' ?>" >Generate Label</a></legend>
		</li>
		<li class = "role">
			<legend><a id ="gen_quotation">Generate Quotation</a></legend>
		</li>	
                <li class = "role">
			<legend><a id ="gen_req_data">Generate Request Report</a></legend>
		</li>
	</ul>
</div>
<table id = "requests">
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
<div class = "hidden2" id = "fancybox_label" ></div>

<script type="text/javascript">
function getData(){
	if (typeof rtable == 'undefined') {
		var rtable = $('#requests').dataTable({
		/*"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.split_status == "1" && aData.assign_status == "2"){
				$('td',nRow).css('background-color', '#f8b88e');
			}
			else if(aData.split_status == "1" && aData.assign_status == "0"){
				$('td',nRow).css('background-color', '#f9ddca');	
			}
			console.log(aData.assign_status);
		},*/
		
		//If Sample is already assigned, colour code entry a light green.
		"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.assign_status == "1" ){
				$('td',nRow).css('background-color', '#d5edcd');
			}
		},		
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"Reference Number","mData":"request_id"},
	{"sTitle":"Product Name","mData":"product_name"},
	{"sTitle":"Batch No.","mData":"Batch_no"},
	{"sTitle":"Client", "sClass":"client","mData":"Clients.Name"},
	{"sTitle":"Manufacturer","mData":"Manufacturer_Name"},
	{"sTitle":"Date of Manufacture","mData":"Manufacture_date"},
	{"sTitle":"Date of Expiry","mData":"exp_date"},
	{"sTitle":"Assign Status","mData":"assign_status",
		"bVisible":false,
		"mRender":function(data,type,row){
			if(data == "0"){
				return 'Unassigned';
			}
			else if(data == "1"){
				return 'Fully Assigned';
			}
			else if(data == "2"){
				return 'Partially Assigned'
			}
		},
	},
	{"sTitle":"Quantity","mData":null,
	     "mRender":function(data, type, row){
	     	if(row.packaging == '0'){
	     		return row.sample_qty;
	     	}
	     	else{
	     		return row.sample_qty + " " + row.Packaging.name;
	     	}
	     }
	 },
    {"sTitle":"Quote","mData":null,
     "mRender":function(data, type, row){
	     	if(row.quotation_status == '0'){
	     		if(row.component_status == '0' ){
	     			return '<a class="quote" id = '+row.request_id+' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = '+row.client_id+' >Quote</a>';
	     		}
	     		else{
	     			if(row.coa_done_status  == '0'){
	     				return '<a class="set_components" id = '+row.request_id+' >Quote</a>';
	     			}
	     		}
	     			
	     	}
	     	else{
	     		return '<a class="quoted" id = '+row.request_id+' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = '+row.client_id+' >View</a>';
	     	}
    	 }
 	},
	{"sTitle":"Edit","mData":"id",
		"mRender":function(data, type, row){
			//if(row.assign_status == "0" && row.quotation_status == "0"){
				return '<a class="edit" href = "<?php echo base_url()."request_management/edit/" ?>'+row.request_id+'" id = '+row.request_id+' >Edit</a>';
			/*}
			else{
				return 'N/A';
			}*/
		}
	},
	{"sTitle":"Print Label","mData":"id",
		"mRender":function(data, type, row){
			if(row.label_status == "0"){	
				return '<a class = "labels" id = '+data+' data-labelstatus = '+row.label_status+' data-printsno = '+row.sample_qty+' data-reqid ='+row.request_id+' >Print</a>';
			}
			else{
				return '<a class = "labels" id = '+data+' data-labelstatus = '+row.label_status+' data-printsno = '+row.sample_qty+' data-reqid ='+row.request_id+' >View</a>';
			}
		}
	},
	{"sTitle":"Assign","mData":"id",
		"mRender":function(data, type, row){
			return '<a class = "assign" id = '+data+' data-reqid ='+row.request_id+' data-client = '+row.client_id+' >Assign</a>';
		}
	},
	{"sTitle":"Invoice","mData":"id",
		"mRender":function(data, type, row){
			if(row.coa_done_status == 1){
				return '<a class = "invoice" id = '+data+' data-reqid ='+row.request_id+' data-client = '+row.client_id+' data-table1 = "invoice" data-table2 = "tests" data-table3 = "request_details" >Show</a>';		
			}
			else{
				return '<span class = "gray_out" >Pending</span>';
			}
		}
	},
	],
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"stateSave":true,
	"iDisplayLength":900,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."request_management/requests_list"?>',		
		});
	}
else {
	rtable.fnDraw();
	}
}

$(document).ready(function(){
	$('.edits').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."request_management/edit/" ?>' + $(this).attr('id')
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:400,
			height: 500,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})
	getData();


	$('.set_components').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."tests_management/testsMethodsWizard/" ?>' + $(this).attr('id') + "/" + "request" + "/" + "tests" + "/" + "request_details" + "/" + "quotation_components";
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height:490,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


	$('.quote').live("click",function(e){
		e.preventDefault();
		client_id = $(this).attr('data-client');
		var href = '<?php echo base_url()."quotation/stateComponents/" ?>' + $(this).attr('id') + "/" + "request" + "/" + "tests" + "/" + "request_details" + "/" + client_id;
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:600,
			height:250,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


$('.quoted').live("click",function(e){
		e.preventDefault();
		//Get unique id
		id = $(this).attr('id');

		//Get tables
		table1 = $(this).attr('data-table1');
		table2 = $(this).attr('data-table2');
		table3 = $(this).attr('data-table3');

		//Get Client Id
		client_id = $(this).attr('data-client');
		
		//Get href
		var href = '<?php echo base_url()."client_billing_management/showBillPerTest/" ?>' + id + "/" + table1 + "/" + table2 + "/" + table3 + "/" + client_id;
		
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height:400,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


$('.invoice').live("click",function(e){
		e.preventDefault();
		//Get unique id
		id = $(this).attr('data-reqid');

		//Get tables
		table1 = $(this).attr('data-table1');
		table2 = $(this).attr('data-table2');
		table3 = $(this).attr('data-table3');

		//Get Client Id
		client_id = $(this).attr('data-client');
		
		//Get href
		var href = '<?php echo base_url()."quotation/showInvoiceBeforePrint/" ?>' + id + "/" + table1 + "/" + table2 + "/" + table3 + "/" + client_id;
		
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height:400,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


$('.labels').live("click", function(e){
	e.preventDefault();
	label_status = $(this).attr("data-labelstatus");
	console.log(label_status);
		if(label_status == "0"){
			var href  =  '<?php echo base_url()."request_management/label_form/" ?>' + $(this).attr('data-reqid');
			var hght = 200;
			var wdth= 300; 
		}
		else if(label_status == "1"){
			var href = '<?php echo base_url()."labels/" ?>' + "Label" + $(this).attr('data-reqid') + ".pdf";
			var hght = 842;
			var wdth = 595;		
		}
	$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions:false,
			width:wdth,
			height:hght,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})

$('.assign').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."sample_issue/sample_split/" ?>' + $(this).attr('data-reqid') + "/" + $(this).attr('data-client');
	$.fancybox.open({
		href : href,
		type: 'iframe',
		autoSize: false,
		width: 600,
		height: 500,
		autoDimensions: false,
		'beforeClose' : function(){
			getData();
		}
	})
})


     $('#gen_req_data').click(function(){           
            $.post("<?php echo base_url() . 'Sample_request_details/generate/'; ?>", function(data) {
                 window.location.href="<?php echo base_url() . 'sample_report/Report.xlsx'; ?>"; 
       
      });
    
      });
      

$('#gen_label').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."request_management/generate_label" ?>';
	$.fancybox.open({
		href:href,
		type: 'iframe',
		autoSize:false,
		autoDimensions:false,
		width:350,
		'beforeClose':function(){
			getData();
		}
	})
})


$('#gen_quotation').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."quotation/generate" ?>';
	$.fancybox.open({
		href:href,
		type: 'iframe',
		autoSize:false,
		autoDimensions:false,
		width:360,
		'beforeClose':function(){
			getData();
		}
	})
})

$('.assigned').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."sample_issue/show_assigned_to/" ?>' + $(this).attr('id');
	$.fancybox.open({
		href : href,
		type: 'iframe',
		autoSize: false,
		width: 600,
		height: 500,
		autoDimensions: false,
		'beforeClose' : function(){
			getData();
		}
	})
})


})

</script>