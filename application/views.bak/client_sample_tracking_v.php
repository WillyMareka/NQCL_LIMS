<hr>
<table id = "client_tracking">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
	 $('#client_tracking').dataTable({
	 	"bJQueryUI":true,	
		"aoColumns": [
			{"sTitle":"Request Id","mData":"labref"},
			{"sTitle":"Activity","mData":"activity"},
			{"sTitle":"Location","mData":"current_location"},
			{"sTitle":"Date Submitted","mData":"date"},
			{"sTitle":"Completion(%)","mData":null,
				"mRender":function(data, type, row){
					var percent = row.stage/11*100
					return percent+"%";
				}
			}
			],
		"bScrollCollapse":true,
		"bPaginate":false,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."client_billing_management/tracking_list/$cid"?>'	
	});
})	 
</script>