<html>
		<table class="" id="requests" >
			<thead>
			<tr>
				<th>Client id</th>
				<th>Request id</th>
				<th>Product_name</th>
				<th>Batch_no</th>
				<th>Time of Update</th>
				<th>Quantity</th>
				<!--th>Edit Request </th>
				<th>Add Sample Information</th-->
			</tr>
			</thead>
			
		<tbody>
			<?php			
			foreach ($info as $infos) {
				echo "<tr><td>" . $infos['client_id'] . "</td><td>" . $infos['request_id'] 
				. "</td><td>" . $infos['product_name'] .  "</td><td>" . $infos['Batch_no'] . "</td><td>" . $infos['updated_at'] . 
				"</td><td>" . $infos['sample_qty'] ."</td>";
			}
			?>
		</tbody>
		</table>
	
	
	
	<script>
	$(document).ready(function() {
    $('#requests').dataTable({
    	"bJQueryUI": true,
    	"asStripClasses": null
    });
		} );
	</script>
	
</html>