
<div id = "jwizard" >
	
	<div title = "Client Details" >
		<table>
			<tr>
				<td>Client Name</td>
				<td>
					<input name="client_name" id="applicant_name" value="<?php echo $client -> Name ?>" required />	
					<input type="hidden" name="client_id" id="clientid" value="<?php echo $client -> Clientid ?>"/>
				</td>
			</tr>
			<tr>
				<td>Client Address</td>
				<td><input type="text" name="client_address" id="applicant_address" value="<?php echo $client -> Address; ?>" required/></td>
			</tr>
			<tr>
				<td>Client Email</td>
				<td><input type="text" name="client_email" id="applicant_address" value="<?php echo $client -> Email; ?>" required/></td>
			</tr>
			<tr>
				<td>Contact Name</td>
				<td><input type="text" id="contact_name" name="contact_person" value="<?php echo $client -> Contact_person; ?>" required ></label></td>
			</tr>
			<tr>
				<td>Contact Telephone</td>
				<td><input type="text" name="contact_phone" id="contact_phone" value="<?php  echo $client -> Contact_phone; ?>" required /></td>
			</tr>
			<tr>
				<td>Client Type</td>
				<td>
					<select id="clientT" name="clientT">
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
					<option value="D">D</option>
					<option value="E">E</option>
					</select>
					<input type="hidden" id="db_clientype" value="<?php echo $client -> Client_type ?>" />
				</td>
			</tr>
		</table>	
	</div>
	
	<div title = "Product Details" >
			<table>
				<tr>
					<td>Dosage Form</td>
					<td><select name="dosage_form" id="dosage_form" required />
					<option value=""></option>
					<?php foreach ($dosageforms as $dosageform) {?>	
					<option value="<?php echo $dosageform -> id ?>" selected ="<?php if($dosageform -> id == $request[0]['Dosage_Form']) { echo "selected";} ?>"><?php echo $dosageform -> name ?></option>
					<?php } ?>
					</select>
					<input type="hidden" id="dform" name="df" value="<?php echo $request[0]['Dosage_Form'] ?>"
					</td>
				</tr>

				<tr>
					<td>Product Name</td>
					<td><input type="text" name="product_name"  value="<?php echo $request[0]['product_name']; ?>" required /></td>
				</tr>
			
				<tr>
					<td>Label Claim</td>
					<td>
					<textarea name="label_claim" required ><?php echo $request[0]['label_claim'] ?></textarea>
					</td>
				</tr>
				<tr>
					<td>Manufacturer Name</td>
					<td><input type="text" name="manufacturer_name" value="<?php echo $request[0]['Manufacturer_Name'] ?>" required /></td>
				</tr>
				<tr>
					<td>Manufacturer Address</td>
					<td><input type="text" name="manufacturer_address" value="<?php echo $request[0]['Manufacturer_add'] ?>" required /></td>
				</tr>

				<tr>
					<td>Batch/Lot Number</td>
					<td><input type="text" name="batch_no" value="<?php echo $request[0]['Batch_no']; ?>" required /></td>
				</tr>
				<tr>
					<td>Quantity Submitted</td>
					<td><input type="text" name="quantity" value="<?php echo $request[0]['sample_qty']; ?>" required /></td>
				</tr>

				<tr>
					<td>Active Ingredients</td>
					<td><textarea name="active_ingredients" required ><?php echo $request[0]['active_ing']; ?></textarea></td>
					</textarea></td>
				</tr>
				<tr>
					<td id="ref_no_td">Client Sample Reference Number</td>
					<td><input type="text" name="client_ref_no" id="appl_ref_no" value="<?php echo $request[0]['clientsampleref']; ?>" required /></td>
				</tr>
		</table>
	</div>
	
	<div title = "Dates" >
		<table>
			<tr id = "dateformatitle">
				<td><span class = "misc-title smalltext gray_out">Choose Date of Manufacture & Date of Expiry Date Format</span></td>
			</tr>

			<tr id="dateformat">
				<td id = "dmy"><span>Day-Month-Year</span></td>
				<td><input type= "checkbox" name = "dateformat" id = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "dmy" /></td>
				<td id = "my"><span>Month-Year</span></td>
				<td><input type= "checkbox" name = "dateformat" id = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "my" /></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
			</tr>

			<tr id="dmy" class = "<?php if($request[0]['dateformat'] == "dmy"){echo " " ;} else{ echo "hidden2" ;} ?>" >
				<td>Manufacture Date</td>
				<td><input type = "text" id = "date_m" name ="date_m" readonly class = "validate[required] datepicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['Manufacture_date']))  ?>" /></td>
			</tr>

			<tr>
				<td>Expiry Date</td>
				<td><input type = "text" id = "date_e" name = "date_e" readonly class = "validate[required] datepicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['exp_date']))  ?>" /></td>
			</tr>

			<tr id="my" class = "<?php if($request[0]['dateformat'] == "my"){echo " " ;} else{ echo "hidden2"; } ?>" >
				<td>Manufacture Date&nbsp;</td>
				<td><input type = "text" id = "m_date" 	name ="m_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['Manufacture_date']))  ?>" /></td>
			</tr>
			<tr>
				<td>Expiry Date</td>
				<td><input type = "text" id = "e_date" name = "e_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['exp_date']))  ?>" /></td>
			</tr>
		</table>
	</div>
	
	<div title = "Other Details" >
		<table>
			
		</table>
	</div>
	
</div>


<script type="text/javascript">
<!--
$("#jwizard").jWizard({
	menu:false,
	
});
//-->
</script>