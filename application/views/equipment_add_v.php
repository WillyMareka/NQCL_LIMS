<!DOCTYPE html>
<html lang = "en">
<body>
<div class = "content">

<legend><a href="<?php echo site_url()."inventory/equipmentlist"; ?>">Equipment List</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Equipment</span></legend>

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>		

<form id = "equipment" >		
<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "name">Name</label></td>
			<td><input name ="name" type = "text" class ="validate[required]" placeholder ="e.g Dry Fog Machine" /></td>
		</tr>
		
		<tr>
			<td><label for = "serial_no">Serial No.</label></td>
			<td><input name ="serial_no" type = "text" class ="validate[required]" placeholder ="e.g S09TY" /></td>
			<td><label for = "model">Model</label></td>
			<td><input name ="model" type = "text" class ="validate[required]" placeholder ="e.g B2 Model" /></td>
		</tr>
		
		<tr>
			<td><label for = "type">Type</label></td>
			<td>
				<select name = "type">
					<option value = "Lab" >Lab</option>
					<option value = "Other" >Other</option>
				</select>
			</td>
			<td><label for = "date_a">Date Acquired</label></td>
			<td><input name ="date_a" type = "text" id = "date_a" class ="validate[required]" placeholder ="e.g 2012-09-09" /></td>
		</tr>
		<tr>
			<td><label for = "date_c1">Date of Calibration</label></td>
			<td><input name ="date_c1" type = "text" id ="date_c1" class ="validate[required]" placeholder ="e.g 2012-09-09" /></td>
			<td><label for = "date_cn">Date of Next Calibration</label></td>
			<td><input name ="date_cn" type = "text" id = "date_cn" class ="validate[required] datepicker" placeholder ="e.g 2012-09-09" /></td>
		</tr>
		<tr>
			<td><label for = "status">Status</label></td>
			<td><select name = "status" class = "validate[required]">
				 <option value = " " >&nbsp;</option>
                 <option value = "Calibrated" >Calibrated</option>
				 <option value = "Pending Calibration" >Pending Calibration</option>
				 <option value = "Out of Service">Out of Service</option>
				 <option value = "Decommissioned">Decommissioned</option> 
			</select></td>
		</tr>
		<tr>
			<td><input name ="save" type = "submit" value = "Save" class = "submit-button"/></td>
		</tr>
	</tbody>	
	
</table>
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){

});

$("#equipment").validationEngine();

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy"
});



$('#equipment').submit(function(e){
	e.preventDefault();
var inputs = $("#equipment").find('input').filter(function(){
return this.value === "";
});

if (inputs.length) {

//alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: 'equipment_save/',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');

				$('form').each(function(){

					this.reset();
				})
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

}

})

</script>

</body>
</html>
