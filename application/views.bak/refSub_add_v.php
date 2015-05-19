<!DOCTYPE html>
<html lang = "en">
<body>

<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded show_ok" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>	

<form id = "refsubs_a">	

<legend><a href="<?php echo site_url('inventory/refSublist'); ?>">Reference Substances List</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Reference Substance</span>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd_i"; ?>">Add Reference Substance to Inventory</a></legend>

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "name">Name</label></td>
			<td>
			<input type = "text" id = "substance_name"  name ="name" class = "validate[required]" autocomplete = "off" />
			</td>
			<!--td><label for = "s_type">Standard Type</label></td>
			<td>
			<select name ="s_type" class ="validate[required">
			<option id ="" selected ></option>
			<option id ="WRS" value ="Working" >Working</option>
			<option id ="PRS" value ="Primary" >Primary</option>
			</select>
			</td-->
		</tr>
		<tr id = "submit_tr" class = "hidden2" >
			<td><input name ="save" id ="substance-save" type = "submit" value = "Save" class = "submit-button"/></td>
		</tr>
	</tbody>
</table>
</form>
</div>
<div class = "hidden2" id = "unavailable" ></div>
</div>


<script type="text/javascript">
$(document).ready(function(){

		$( "#substance_names" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('inventory/refsubSuggestions'); ?>",
				data: { term: $("#substance_name").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
                                    Delay : 200
		});

$("#substance_name").blur(function(){
	substance_name = $(this).val();
	if(substance_name){
			$.ajax({
				type: "POST",
				url:'<?php echo site_url("inventory/refsubCheckAvailability"); ?>' + "/" + substance_name ,
				dataType:"json"						
			}).done(function(response){
				console.log(response)
				if(response.status == "Unavailable" || substance_name == ''){

					if(!$('#unavailablespan').length){

						$("<span id ='unavailablespan' class = 'misc-title small-text padded show_error' >&#10003;'"+response.message+"'</span>").appendTo('#unavailable');

					}
					
					$('#submit_tr').addClass("hidden2");	

					$('#unavailable').slideUp(300).delay(200).fadeIn(400).fadeOut('slow');

					$('form').each(function(){

						this.reset();
					})

						$('#substance-save').attr('disabled', 'disabled');
					}
					else if(response.status == "Available" && substance_name != ''){
						$('#submit_tr').removeClass("hidden2");	
						$('#substance-save').removeAttr('disabled');
					}
				}).fail();

		}	
})


$("#refsubs_a").validationEngine();


$('#refsubs_a').submit(function(e){
	e.preventDefault();
var name = $("#refsubs_a").find('input').filter(function(){
return this.value === "";
});

var s_type = $("#refsubs_a").find('select').filter(function(){
return this.value === "";
});

if (name.length || s_type.length ) {

alert(s_type.length);

}

else {

	$.ajax({
		type: 'POST',
		url: 'refSub_save/',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){
					alert('Reference Substance Saved');
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


});
</script>

</body>
</html>