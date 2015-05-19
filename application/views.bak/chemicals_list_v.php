<html>
<div class ="content">
		<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Chemicals Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/chemicalsadd"; ?>">Add Chemicals</a></legend>
	<div>&nbsp;</div>
<table id = "chems">
<thead>
<tr>
<th>Item Description</th>
<th>Unit of Issue</th>
<th>Physical</th>
<th>Value</th>
<th>Ledger</th>
<th>Variation</th>
</tr>
</thead>
<tbody>
<?php foreach($chemicals as $chem) {?>	
<tr>
	<td><?php echo $chem -> item_description ?></td>
	<td><?php echo $chem -> unit_of_issue ?></td>
	<td><?php echo $chem -> physical ?></td>
	<td><?php echo $chem -> value ?></td>
	<td><?php echo $chem -> ledger ?></td>
	<td><?php echo $chem -> variation ?></td>

</tr>
<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">
$('#chems').dataTable({
	"bJQueryUI": true
});
</script>
</html>