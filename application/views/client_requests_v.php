<div class ="content">
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
var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
    rtable = $('#requests').dataTable({
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":" ","mData":"request_id", "bSortable":false,
		"mRender":function(data, type, row){
			return '<a class="show_more" id = '+data+' >+</a>';
		},
		"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
			$(nTd).css({"font-weight":"bold"});
		}
	},
	{"sTitle":"Reference Number","mData":"request_id"},
	{"sTitle":"Date Submitted","mData":null,
		"mRender":function(data, type, row){
			return row.Worksheet_tracking.date;
		}
	},
	{"sTitle":"Product Name","mData":"product_name"},
	{"sTitle":"Batch No.","mData":"Batch_no"},
	{"sTitle":"Quantity","mData":null,
     "mRender":function(data, type, row){
     	return row.sample_qty + " " + row.Packaging.name;
     }},
	{"sTitle":"Activity","mData":null,
		"mRender":function(data, type, row){
			return row.Worksheet_tracking.activity;
		}
	},
	{"sTitle":"Location","mData":null,
		"mRender":function(data, type, row){
			return row.Worksheet_tracking.current_location;
		}
	}
	],
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."client_billing_management/requests_list"?>'
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

$('.show_more').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == '+'){
							
						   $(this).text("-");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('client_billing_management/show_more'); ?>" + "/" + id , function(more){
								
								rtable.fnOpen(nTr, more, 'more');
							})
							
						}
						
					else{

							rtable.fnClose(nTr);
							
							$(this).text("+");	
							
						}
		})
})

</script>