<!--div><legend><span class = "link_highlight" >Payments Table</span></legend></div-->
<html style = "overflow-x:hidden">
<title>Payments</title>
<head></head>
<legend>Payments&nbsp;|&nbsp;<?php echo $name[0]['Name']; ?></legend>
<hr>
<table id = "payments">
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
 ftable = $('#payments').dataTable({
		"aoColumns": [
			{"sTitle":"Amount Paid (KES)", "mData":"amount_paid",
				"mRender":function(data, type, row){
					return accounting.formatMoney(data, { format: "%v" });
				}
			},
			{"sTitle":"Receipt No.", "mData":"receipt_no"},
			{"sTitle":"Name", "mData":"name"},
			{"sTitle":"ID No.", "mData":"id_no"},
			{"sTitle":"Phone No.", "mData":"phone_no"},
			{"sTitle":"Payment Date", "mData":"payment_date"}
		],
		bJQueryUI:true,
		//"bSearchable":false,
		//"bInfo":false,
		//"bFilter":false,
		//"bSort":false,
		//"bPaginate":false,
		"bDeferRender":true,
		//"bProcessing":true,
		//"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/payments_list_per_client/$cid"?>'	
	})
})	 

</script>
</html>
