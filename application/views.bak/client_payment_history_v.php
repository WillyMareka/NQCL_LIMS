<div><legend><span class = "link_highlight" >Payment History</span>&nbsp;&rarr;&nbsp;</legend></div>
<hr>
<table id = "payment_history">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
	 $('#payment_history').dataTable({
	 	"bJQueryUI":true,	
		"aoColumns": [
			{"sTitle":"Request Id","mData":"request_id"},
			{"sTitle":"Amount Paid","mData":"amount_paid"},
			{"sTitle":"Balance","mData":"balance"},
			{"sTitle":"Receipt. No.","mData":"receipt_no"},
			{"sTitle":"Status","mData":"status"}
			],
		"bScrollCollapse":true,
		"bPaginate":false,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."client_billing_management/payments_list"?>'	
	});
})	 
</script>
