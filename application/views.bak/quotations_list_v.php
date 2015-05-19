<html>
<head>
</head>
<body>
<?php var_dump($quotations) ?>
<legend>Quotations Listing</legend>
<hr>
<table id = "quotationlist">
<thead>
	<tr>
		<th>Client Number</th>
		<th>Client Name</th>
		<th>Sample Name</th>
		<th>Sample No.</th>
		<th>Quotation Date</th>
		<th>Active Ingredients</th>
		<th>View Proforma</th>
	</tr>
</thead>
<tbody>
	<?php foreach ($quotations as $quotation) { ?>
	<tr>
		<td><span><?php echo $quotation['Client_number'] ?></span></td>
		<td><span><?php echo $quotation['Client_name'] ?></span></td>
		<td><span><?php echo $quotation['Sample_name'] ?></span></td>
		<td><span><?php echo $quotation['Sample_no'] ?></span></td>
		<td><span><?php echo $quotation['Quotation_date'] ?></span></td>
		<td><span><?php echo $quotation['Active_ingredients'] ?></span></td>
		<td><a href = "<?php echo site_url('proforma/getQuotationProforma') . '/' . $quotation['id'] . '/'. $quotation['Client_number'] ?>" >View Proforma</a></td>
	</tr>
	<?php  } ?>
</tbody>
</table>


<script type="text/javascript">
$(document).ready(function(){	
	$('#quotationlist').dataTable({
    "bJQueryUI": true
    })
  })  
</script>
</body>
</html>