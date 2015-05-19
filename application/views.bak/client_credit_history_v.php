<div><legend><span class = "link_highlight" >Payment History</span>&nbsp;&rarr;&nbsp;<?php echo $cname ?></legend></div>
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
	 	"bInfo":false,
	 	"bPaginate":false,
	 	"bFilter":false,	
		"aoColumns": [
			{"sTitle":"Amount Paid","mData":"amount_paid"},
			{"sTitle":"Receipt. No.","mData":"receipt_no"},
			{"sTitle":"Cheque No.","mData":"cheque_no"},
			{"sTitle":"Payment Date","mData":"payment_date"}
			],
		"bScrollCollapse":true,
		"bPaginate":false,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/clientCreditHistoryList/$cid"?>' 	
	});
})	 
</script>
