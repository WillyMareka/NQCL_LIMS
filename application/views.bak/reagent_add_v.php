<!DOCTYPE html>
<html lang = "en">
<body>
<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded show_ok" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>	

<form id ="reagents">

<legend><a href="<?php echo site_url()."inventory/reagentslist"; ?>">Reagents Inventory List</a>&nbsp;<span class = "link_highlight" >|</span>&nbsp;<a href="<?php echo site_url()."inventory/reagentlist"; ?>">Reagent Episodes List</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Reagents</span>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/reagentsadd";?>">Add Reagents to Inventory</a></legend>

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "Name">Name</label></td>
			<td><input name ="name" id = "reagent_name" type = "text" class ="validate[required]" placeholder ="e.g Paracetamol" /></td>
			<!--td><label for = "description">Description</label></td>
			<td><textarea name ="description" type = "text" class ="validate[required]" placeholder ="e.g One Litre Bottles" ></textarea></td-->
		</tr>
		<tr id = "submit_tr" class ="hidden2" >
			<td><input name ="save" id ="reagent_save" type = "submit" value = "Save" class = "submit-button"/></td>
		</tr>
	</tbody>	
	
</table>
</form>
</div>
<div class = "hidden2" id = "unavailable" ></div>

<script type="text/javascript">
$(document).ready(function(){

});

$("#reagents").validationEngine();

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"yy-mm-dd"
});


$("#reagent_name").blur(function(){
	reagent_name = $(this).val();
	if(reagent_name){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url("inventory/reagentCheckAvailability"); ?>' + "/" + reagent_name ,
				dataType:"json"						
			}).done(function(response){
				console.log(response)
				if(response.status == "Unavailable" || reagent_name == ''){

					if(!$('#unavailablespan').length){

						$("<span id ='unavailablespan' class = 'misc-title small-text padded show_error' >&#10003;'"+response.message+"'</span>").appendTo('#unavailable');

					}
					
					$('#submit_tr').addClass("hidden2");	

					$('#unavailable').slideUp(300).delay(200).fadeIn(400).fadeOut('slow');

					$('form').each(function(){

						this.reset();
					})

						$('#reagent-save').attr('disabled', 'disabled');
					}
					else if(response.status == "Available" && reagent_name != ''){
						$('#submit_tr').removeClass("hidden2");	
						$('#reagent-save').removeAttr('disabled');
					}
				}).fail();

		}	
})


$('#reagents').submit(function(e){
	e.preventDefault();
var inputs = $("#reagents").find('input').filter(function(){
return this.value === "";
});

if (inputs.length) {

//alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: 'reagent_save/',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');

				$('form').each(function(){

					this.reset();
				})

				$('#submit_tr').addClass("hidden2");

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