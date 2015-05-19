<html>
<?php $this -> load -> view("document_header_v"); ?>
<h2>Proforma Invoice</h2>
<table id = "client_info_table">
	<tr><td colspan = "2" ><hr></td></tr>
	<tr>
		<td>Proforma No.</td>
		<td class = "plain_bold_inline" ><?php echo $proforma_no; ?></td>
	</tr>
	<tr><td>Date</td><td class = "plain_bold_inline"><?php echo date('j<\s\u\p>S</\s\u\p> F Y'); ?> </td></tr>
	<?php foreach($invoice_data[0]["Clients"] as $key => $value) { if($key!='id') {  ?>
		<tr>
			<td><?php echo str_replace("_", " ", $key); ?></td>
			<td class = "plain_bold_inline"><?php echo $value; ?></td>
		</tr>
	<?php } } ?>
</table>

<table id ="sample_info_table"  class = "reducedtext" >
	<tr><td colspan = "6">&nbsp;</td></tr>
	<tr class = "plain_bold_inline gray centered" >
		<td>Lab Ref No.</td>
		<td>Sample Name</td>
		<td>Batch No.</td>
		<td>Tests</td>
		<td>Total (KES)</td>
		<td>80% (KES) </td>
	</tr>
	<?php $key1 = 1; $key2 = 1; foreach($invoice_data as $v) { ?>
	<tr class = "<?php if($key2%2){ echo "zebra_striping";} ?> centered">
		<td><?php echo $v["LABORATORY_REF_NO"] ; ?></td>
		<td><?php echo $v["PRODUCT"]; ?></td>
		<td><?php echo $v["BATCH_NO"]; ?></td>
		<td><?php foreach($v["Request_details"]["Tests"] as $t) {
			 //echo json_encode($t);
				if($key1%2){
						if($key1 != count($v["Request_details"]["Tests"])){
							$append = ", ";
						}
						else{
							$append = "";
						}
					echo $t["Name"].$append;
				}
				else{
					echo $t["Name"]. "<br/>";
				}
				$key1++;
		} ?>
		</td>
		<td><?php echo $v["Dispatch_register"]["amount"] + $v["Dispatch_register"]["discount"];  ?></td>
		<td><?php echo (0.8 * ($v["Dispatch_register"]["amount"] + $v["Dispatch_register"]["discount"])); ?></td>
	</tr>
	<?php $key2++; } ?>
	<tr>
		<td colspan = "3"></td>
		<td colspan = "3"><hr></td>
	</tr>
	
		<tr class = "plain_bold_inline centered" >
			<td colspan = "3" ></td>
			<td>Total Cost (KES)</td>
			<?php foreach($tr_array as $k => $v){ ?>
				<td ><?php echo $v; ?></td>
			<?php }?>
		</tr>
		<tr>
			<td colspan = "6" class = "plain_bold_inline"><hr></td>
		</tr>

		<?php $this -> load -> view("document_footer_v"); ?>

</table>

</html>