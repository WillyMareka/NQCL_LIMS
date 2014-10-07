<html>
<?php $this -> load -> view("document_header_v"); ?>
	<h2>Quotation</h2>
	<table>
		<tr><td colspan = "2" ><hr></td></tr>
		<tr>
			<td>Date</td>
			<td class  ="plain_bold_inline" ><?php echo date('j<\s\u\p>S</\s\u\p> F Y'); ?></td>
		</tr>
		<tr>
			<td>Quotation No.</td>
			<td class  ="plain_bold_inline" ><?php echo $i_data[0]["Q_No"]; ?></td>
		</tr>
		<tr>
			<td>Client Name</td>
			<td class = "plain_bold_inline" ><?php echo $i_data[0]["Client_Name"] ?></td>
		</tr>
		<tr>
			<td>Client Email</td>
			<td class = "plain_bold_inline" ><?php echo $i_data[0]["Client_Email"] ?></td>
		</tr>
	</table>

	<table id ="sample_info_table" class = "reducedtext" >
		<tr><td colspan = "6">&nbsp;</td></tr>
		<tr class = "plain_bold_inline gray centered" >
			<td>Sample Name</td>
			<td>Tests</td>
			<td>No. of Batches</td>
			<td>Unit Cost (KES)</td>	
			<td>Total Cost (KES)</td>
		</tr>
		<?php $key1 = 1; $key2 = 1; foreach($i_data as $v) { ?>
		<tr class = "<?php if($key2%2){ echo "zebra_striping";} ?> centered ">
			<td><?php echo $v["Sample_Name"]; ?></td>
			<td><?php foreach($v["Q_request_details"] as $t) {
				//echo json_encode($t);
					if($key1%2){
							if($key1 != count($v["Q_request_details"])){
								$append = ", ";
							}
							else{
								$append = "";
							}
						echo $t["Tests"][0]["Name"].$append;
					}
					else{
						echo $t["Tests"][0]["Name"]. "<br/>";
					}
					$key1++;
			} ?>
			</td>
			<td><?php echo $v["No_Of_Batches"]; ?></td>
			<td><?php echo $v["Unit_Cost"]; ?></td>
			<td><?php echo $v["Total_Cost"]; ?></td>
		</tr>
		<?php $key2++; } ?>
		<tr>
			<td colspan = "2"></td>
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
				<td colspan = "5" class = "plain_bold_inline"><hr></td>
			</tr>
			<?php $this -> load -> view("document_footer_v"); ?>
	</table>
</html>