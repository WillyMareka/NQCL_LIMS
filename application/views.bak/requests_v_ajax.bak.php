<div class ="content">
<a href = "<?php echo base_url().'request_management/add' ?>" ><h2>Add New</h2></a>
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
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"Reference Number","mData":"request_id"},
	{"sTitle":"Product Name","mData":"product_name"},
	{"sTitle":"Batch No.","mData":"Batch_no"},
	{"sTitle":"Client", "sClass":"client","mData":"Clients.Name"},
	{"sTitle":"Manufacturer","mData":"Manufacturer_Name"},
	{"sTitle":"Date of Manufacture","mData":"Manufacture_date"},
	{"sTitle":"Date of Expiry","mData":"exp_date"},
	{"sTitle":"Quantity","mData":null,
     "mRender":function(data, type, row){
     	return row.sample_qty + " " + row.Packaging.name;
     }},
	{"sTitle":"Edit","mData":"id",
		"mRender":function(data, type, row){
				return '<a class="edit" id = '+data+' >Edit</a>';
		}
	},
	{"sTitle":"Print Label","mData":"id",
		"mRender":function(data, type, row){
			return '<a class = "label" id = '+data+' data-printsno = '+row.sample_qty+' data-reqid ='+row.request_id+' >Label</a>';
		}
	},
	{"sTitle":"Assign","mData":"id",
		"mRender":function(data, type, row){
			if(row.assign_status == "0"){
				return '<a class = "assign" id = '+data+' data-reqid ='+row.request_id+' >Assign</a>';
			}
			else if(row.assign_status == "1"){
				return '<a class = "assigned" id = '+row.request_id+'  >Assigned </span>'
			}
		}
	},
	],
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."request_management/requests_list"?>',	
});
	}
else {
	rtable.fnDraw();
	}
}

$(document).ready(function(){
	$('.edit').live("click",function(e){
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


$('.label').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."labels/" ?>' + "Label" + $(this).attr('data-reqid') + ".pdf"; 
	$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})

$('.assign').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."sample_issue/sample_split/" ?>' + $(this).attr('data-reqid');
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