<div><legend><span class = "link_highlight" >Charges Table | <a href="<?php echo base_url().'finance_management/dispatchregister' ?>">Dispatch Register</a></span></legend></div>
<hr>
<table id = "charges">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">
var ftable;
$(document).ready(function(){
 ftable = $('#charges').dataTable({
		"bJQueryUI":true,
		"aoColumns": [
			{"sTitle":"Client", "mData":"clients.Name"},
				{"sTitle":" ","mData":"request_id", "bSortable":false,
					"mRender":function(data, type, row){
					 return '<a class="show_more" id = '+data+' >+</a>';
		},
					"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
			}
		},
		{"sTitle":"Lab Reference Number", "mData":"request_id"}],
		"bScrollCollapse":true,
		"bPaginate":false,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/charges_list"?>'	
	}).rowGrouping({bExpandableGrouping: true});
})	 


$('.show_more').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == '+'){
							
						   $(this).text("-");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('finance_management/show_more'); ?>" + "/" + id , function(more){
								
								ftable.fnOpen(nTr, more, 'more');
							})
							
						}
						
					else{

							ftable.fnClose(nTr);
							
							$(this).text("+");	
							
						}
		})



</script>
