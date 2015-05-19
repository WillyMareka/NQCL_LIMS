<!DOCTYPE html>
<html lang = "en">
<body>

<hr id ="line1" class = "hidden2">	
<div class = "content">

<legend><a href="<?php echo site_url()."inventory/columnslist"; ?>">Columns List</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Columns</span></legend>


<div class = "content2">
<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>		
<form id ="colums">

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "type">Type</label></td>
			<td><textarea name ="type" type = "text"  class ="validate[required]" placeholder ="e.g BDS Hypersil C18 5micro"></textarea></td>
			<td><label for = "col_no">Column Number</label></td>
			<td><input name ="col_no" type = "text"  class ="validate[required]" placeholder ="e.g 85" /></td>
		</tr>
		<tr>
			<td><label for = "desc">Serial No.</label></td>
			<td><input name ="serial_no" type = "text"  class ="validate[required]" placeholder ="e.g 89UI78" /></td>
			<td><label for = "dimensions">Column Dimensions</label></td>
			<td><input name ="dimensions" class ="validate[required]" placeholder ="e.g 200 x 150" /></td>
		</tr>
		<tr>
			<td><label for = "manufacturer">Manufacturer</label></td>
			<td><input name ="manufacturer" type = "text"   class ="validate[required]" placeholder ="e.g pFizer" /></td>
		</tr>
			<!--td><label for = "date_r">Date Received</label></td-->
			<td><input name ="date_r" type = "hidden" id = "date_r"  class ="validate[required]" value ="<?php echo date('d-M-Y') ?>" /></td>
			<!--td><label for = "status">Status</label></td>
			<td><input name ="status" type = "text" class ="validate[required]" placeholder ="e.g Status" /></td-->
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

$("#colums").validationEngine();

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy"
});



$('#colums').submit(function(e){
	e.preventDefault();
var inputs = $("#columns").find('input').filter(function(){
return this.value === "";
});

if (inputs.length) {

//alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: 'columns_save/',
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
