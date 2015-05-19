
<table class="histable" >
	<thead>
		<tr>
			<th></th>
			<th>Product Name</th>
			<th>Batch Number</th>
			<th>Quantity</th>
			<th>Active Ingredient</th>
			<th>Label Claim</th>
			<th>Dosage Form</th>
			<th>Manufacturer Name</th>
			<th>Manufacturer Address</th>
			<th>Manufacture Date</th>
			<th>Expiry Date</th>
			<th>Edit Notes</th>
			<th>Update Date</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($history as $hist){ ?>
		<tr>
				<?php 
				$df_id = $hist['Dosage_Form'];
				$df_name = Dosage_form::getDosageName($df_id)  
				?>
			<td><a class ="plushist" name ="<?php echo $hist['request_id'] ?>" id ="<?php echo $hist['client_id'] ?>" rel="<?php echo $hist['version_id']?>" >+</a></td>
			<td><span><?php echo $hist['product_name'] ?></span></td>
			<td><span><?php echo $hist['Batch_no'] ?></span></td>
			<td><span><?php echo $hist['sample_qty'] ?></span></td>
			<td><span><?php echo $hist['active_ing'] ?></span></td>
			<td><span><?php echo $hist['label_claim'] ?></span></td>
			<td><span><?php echo $df_name[0]['name'] ?></span></td>
			<td><span><?php echo $hist['Manufacturer_Name'] ?></span></td>
			<td><span><?php echo $hist['Manufacturer_add'] ?></span></td>
			<td><span><?php echo $hist['Manufacture_date'] ?></span></td>
			<td><span><?php echo $hist['exp_date'] ?></span></td>
			<td><span><?php echo $hist['edit_notes'] ?></span></td>
			<td><span><?php echo $hist['updated_at'] ?></span></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<script>
	$(document).ready(function() {
		
	
	 h_table =	 $('.histable').dataTable({

			
			"sDom": 't'
    	
    	})  
    	
    var h_table;
		$('.plushist').click(function(){
			
			//alert($(this).html());
			var nTr = this.parentNode.parentNode;
			
			if($(this).text() == '+'){
				
				$(this).text("-");
				
				var reqid = $(this).attr("name");
				var versionid = $(this).attr("rel");
				
				$.get("request_management/other_history/" + reqid + "/" + versionid, function(other_history){
					
					h_table.fnOpen(nTr, other_history, 'other_history');
				})
				
				
			}
			
			
			else{
				
				$(this).text("+");
				
				
				h_table.fnClose(nTr);
				
			}
			
			
		})
	
	})		
    	
    	
</script>