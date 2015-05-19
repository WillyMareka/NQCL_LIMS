
<div class ="content">

<legend><a href="<?php echo site_url()."inventory/reagentslist"; ?>">Reagents Inventory List</a>&nbsp;<span class = "link_highlight" >|</span>&nbsp;<a href="<?php echo site_url()."inventory/reagentlist"; ?>">Reagent Episodes List</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url()."inventory/reagentadd"; ?>">Add Reagents</a>
&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/reagentsadd";?>">Add Reagents to Inventory</a></legend>

<div>&nbsp;</div>
<table id = "rgnts">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>
<script type="text/javascript">

var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
		rtable = $('#rgnts').dataTable({
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"Name","mData":"name"},
	{"sTitle":"Manufacturer","mData":"manufacturer"},
	{"sTitle":"Batch No.","mData":"batch_no"},
	{"sTitle":"Date Received","mData":"date_received","bVisible":false},
	{"sTitle":"Date Opened.","mData":"date_opened","bVisible":false},
	{"sTitle":"Date of Expiry","mData":"date_of_expiry"},
	{"sTitle":"Reorder Level","mData":"reorder_level"},
	{"sTitle":"Quantity","mData":"quantity"},
	{"sTitle":"Packaging","mData":null,
		"mRender":function(data, type, row){
			return row.volume + row.qunit + " "+ row.packaging;
		}},
	{"sTitle":"Form","mData":"form"},
	{"sTitle":"Status","mData":"status"},
	{"sTitle":"Edit","mData":"id",
		"mRender":function(data, type, full){
			return '<a class="edit" id = '+data+' >Edit</a>';
		}
	},
	{"sTitle":"Edit History","mData":null,
		"mRender":function(data, type, row){
			if(row.edit_status == '1'){
				return '<a class="history" id = '+row.id+' >Show</a>';
			}
			else{
				return 'No Edits';
			}
		}
	}
	],
	"sScrollY":"300px",
	"sScrollX": "100%",
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."inventory/rgntlist"?>',	
});
	}
else {
	rtable.fnDraw();
	}
}


$(document).ready(function(){
	$('.edit').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."inventory/reagents_fancybox/" ?>' + $(this).attr('id')
		console.log(href);
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

		$('.history').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'Show'){
							
						   $(this).text("Hide");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('inventory/reagents_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
						
						
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})

getData();

})
</script>