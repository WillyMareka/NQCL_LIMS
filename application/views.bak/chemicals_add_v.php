<!DOCTYPE html>
<html lang = "en">
<body>
<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>		

<form id ="chemicals" >

<legend><a href="<?php echo site_url()."inventory/chemicalslist"; ?>">Chemicals List</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Chemicals</span></legend>	

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "i_desc">Item Description</label></td>
			<td><input name = "i_desc" type = "text" class ="validate[required]" placeholder ="e.g Item Desc"  /></td>
			<td><label for = "u_issue"> Unit of Issue</label></td>
			<td><input name ="u_issue" type ="text" class ="validate[required]" placeholder ="e.g Unit of Issue" /></td>
		</tr>
		<tr>
			<td><label for = "physical">Physical</label></td>
			<td><input name ="physical" type = "text"  class ="validate[required]" placeholder ="e.g Physical" /></td>
			<td><label for = "value">Value</label></td>
			<td><input name ="value" type = "text" class ="validate[required]" placeholder ="e.g Value" /></td>
		</tr>
		<tr>
			<td><label for = "variation">Variation</label></td>
			<td><input name ="variation" type = "text" class ="validate[required]" placeholder ="e.g Variation" /></td>
			<td><label for = "ledger">Ledger</label></td>
			<td><input name ="ledger" type = "text" class ="validate[required]" placeholder ="e.g Ledger" /></td>
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

$("#chemicals").validationEngine();

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"yy-mm-dd"
});



$('#chemicals').submit(function(e){
	e.preventDefault();
var inputs = $("#chemicals").find('input').filter(function(){
return this.value === "";
});

if (inputs.length) {

//alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: 'chemicals_save/',
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