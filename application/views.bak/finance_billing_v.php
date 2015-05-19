<div><legend><span class = "link_highlight" >Charges Total</span>&nbsp;&rarr;&nbsp;<?php echo $rid; ?></legend></div>
<hr>
<table id = "totals">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">
var dtable;
$(document).ready(function(){
	dtable =  $('#totals').dataTable({
		"bSearchable":false,
		"bInfo":false,
		"bFilter":false,
		"aoColumns": [
			{"sTitle":" ","mData":"request_id", "bSortable":false,
			"mRender":function(data, type, row){
				return '<a class="show_more2" id = '+data+' >+</a>';
			},
			"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				$(nTd).css({"font-weight":"bold"});
				}
			},
			{"sTitle":"Total (Kshs.)","mData":null,
				"mRender":function(data, type, row){
					return row.sum 
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			}],
		"bScrollCollapse":true,
		"bPaginate":false,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/totals_list/$rid"?>'	
	});

	 $('.show_more2').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == '+'){
							
						   $(this).text("-");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('finance_management/show_breakdown'); ?>" + "/" + id , function(more){
								
								dtable.fnOpen(nTr, more, 'more');
							})
							
						}
						
					else{

							dtable.fnClose(nTr);
							
							$(this).text("+");	
							
						}
		})
})	 
</script>
