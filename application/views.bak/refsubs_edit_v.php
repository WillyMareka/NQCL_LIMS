<!DOCTYPE html>
<html lang = "en">
<body>

<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>	

<form id = "refsubs">	

<legend><a href="<?php echo site_url('inventory/refSubslist'); ?>">Reference Substances Inventory</a>&nbsp;&larr;&nbsp;<span class = "link_highlight">Add Reference Substance to Inventory</span>&nbsp;|&nbsp;<a href="<?php echo site_url('inventory/refSubsadd'); ?>">Add Reference Substance</a></legend>

<table>

	<tr><td colspan = 4><hr></td></tr>


	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "Name">Name</label></td>
			<td>
			<input type = "text" name ="name" id ="name" class = "validate[required]" value ="<?php echo $refsub -> name ?>" readonly />
			</td>
			<td><label for = "wrs_code">WRS Code</label></td>
			<td>
			<select name ="rs_code" id ="code" class ="validate[required" value = "<?php echo $refsub -> wrs_code ?>" >
			<option id ="def" selected ></option>
			</select>
			</td>
		</tr>
		<tr>
			<td><label for = "source">Source</label></td>
			<td><input name ="source" type = "text" class ="validate[required]" placeholder = "e.g Cipla" value = "<?php echo $refsub -> source ?>" /></td>
			<td><label for = "source">Batch/Lot.No</label></td>
			<td><input name ="batch_no" type = "text" class ="validate[required]" placeholder = "e.g JK89PER" value = "<?php echo $refsub -> batch_no ?>" /></td>	
		</tr>

		<tr>
			<td><label for = "potency">Potency</label></td>
			<td><input name ="potency" type = "text" class ="validate[required]" placeholder = "e.g 100" value = "<?php echo $refsub -> potency ?>" />&nbsp;&nbsp;
				<select name ="p_unit" class = "validate[required]" >
				  	<option value = "%">%</option>
				  	<option value ="&#956;g/g">&#956;g/g</option>
				  	<option value ="mg/g">mg/g</option>
				  	<option value ="iu/mg">iu/mg</option>
				  	<option value ="iu/mL">iu/mL</option>
					<option value = "%:w/w">%:w/w</option>
					<option value = "%:w/v">%:w/v</option>
					<option value = "%:v/v">%:v/v</option>
				</select></td>
			<td><label for = "init_mass">Initial Weight/Volume</label></td>
			<td><input name ="init_mass" type = "text" class ="validate[required]" value = "<?php echo $refsub -> init_mass ?>"  placeholder = "e.g 300mg" />&nbsp;&nbsp;
				<select name ="init_mass_unit" class = "validate[required]">
				  	<option value = "mg">mg</option>
				  	<option value ="mL">mL</option>		
				</select>
			</td>	
		</tr>
		<tr>
			<td><label for = "water_content" >Water Content</label></td>
			<td><input name = "water_content" type = "text" value = "<?php echo $refsub -> water_content ?>" placeholder = "e.g 78" ></td>
		</tr>
	
			<!--td><label for = "status">Status</label></td>	
			<td><select name ="status" class ="validate[required]">
				<option value = ""></option>
				<option value = "In Use">In Use</option>
				<option id ="Reserved" value = "reserved">Reserved</option>
			</select></td-->
			<td><label for = "date_r">Date Received</label></td>
			<td><input name ="date_r" type = "text" id = "date_r" class ="validate[required]"  value = "<?php echo $refsub -> date_received ?>"  /></td>
		</tr>

		<tr>
			<td><label for = "date_e">Date of Expiry</label></td>
			<td id = "doe" ><input name ="date_e" type = "text" id = "date_e" class ="validate[required]" placeholder = "e.g 02-OCT-2015"  value = "<?php echo $refsub -> date_of_expiry ?>"  /></td>
			<td><label for = "storage_conditions">Storage Conditions</label></td>
			<td id = "sc_td"><textarea name = "storage_conditions" id = "storage_conditions" placeholder = "e.g Cool Dry Place" ><?php echo $refsub -> storage_conditions ?></textarea></td>
		</tr>

		<!--tr id ="dor" >
			<td><label for = "date_o">Date Opened</label></td>
			<td><input name ="date_o" type = "text" id = "date_o"  placeholder = "e.g 02-OCT-2010" /></td>			
		</tr-->		
		<tr>
			<td><input name ="save" type = "submit" value = "Save" class = "submit-button"/></td>
		</tr>
	</tbody>	
	
</table>
</form>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
//By default, on page load have reserved option selected on Status
$('#reserved').attr('selected', 'selected');  



$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy"
});
//If WRSR Code is selected, means the standard has been restandardised the4 unhide date of restandardisation

$('.dor').hide();

$('#code').change(function(){

if($(this).val() == "NQCL-WRSR-A6-"){

$('.dor').show();

}

else {

$('.dor').hide();

}

})




$("#refsubs").validationEngine();

$( "#name" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('inventory/suggestions'); ?>",
				data: { term: $("#name").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
		select: function(e, ui){
			//alert(ui.item.value);
			$.getJSON("getCodes/" + ui.item.value , function(codes){
				
				$('#code option').remove();

				var codesarray = codes;
				for(var i = 0; i < codesarray.length; i++){
						var object = codesarray[i];
						for(var key in object){

							var attrName = key;
							var attrValue = object[key];

							if (attrName == "code"){

								$("<option id = '"+i+"' value = '"+attrValue+"'>"+attrValue+"</option>").appendTo('#code');

								//$('#code option').remove("<option value = '"+attrValue+"'>"+attrValue+"</option>")
							}

						}				

				}
				
					
				})
		},
        Delay : 200
		})


$('#refsubs').submit(function(e){
	e.preventDefault();
var inputs = $("#refsubs").find('input').not(':hidden').filter(function(){
return this.value === "";
});

if (inputs.length) {

//alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: 'refSubs_save/',
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

})

</script>

</body>
</html>