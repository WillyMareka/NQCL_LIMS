<!DOCTYPE html>
<html lang = "en">
<body>

<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = " show_ok misc-title small-text padded" >&#10003;</span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>	

<form id = "refsubs">	

<legend><a href="<?php echo site_url('inventory/refSubslist'); ?>">Reference Substances Inventory</a>&nbsp;&larr;&nbsp;<span class = "link_highlight">Add Reference Substance to Inventory</span>&nbsp;|&nbsp;<a href="<?php echo site_url('inventory/refSubsadd'); ?>">Add Reference Substance</a></legend>

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "Name">Name</label></td>
			<td>
			<input type = "text" name ="name" id ="name" class = "validate[required]" />
			</td>
			<td><label for = "wrs_code">WRS Code</label></td>
			<td>
			<select name ="rs_code" id ="code" class ="validate[required">
			<option id ="def" selected ></option>
			</select>
			</td>
		</tr>
		<tr>
			<td><label for = "source">Source</label></td>
			<td><input name ="source" type = "text" id="source" class ="validate[required]" placeholder = "e.g Cipla" /></td>
			<td><label for = "source">Batch/Lot.No</label></td>
			<td><input name ="batch_no" type = "text" class ="validate[required]" placeholder = "e.g JK89PER" /></td>	
		</tr>

		<tr>
			<td><label for = "potency">Potency</label></td>
			<td><input name ="potency" type = "text" placeholder = "e.g 100" class = "potency"  />&nbsp;&nbsp;
				<select name ="p_unit" class = "potency" >
				  	<option></option>
				  	<option value = "%">%</option>
				  	<option value ="&#956;g/g">&#956;g/g</option>
					<option value ="&#956;g/g">&#956;g/mg</option>
				  	<option value ="mg/g">mg/g</option>
				  	<option value ="iu/mg">iu/mg</option>
				  	<option value ="iu/mL">iu/mL</option>
					<option value = "%:w/w">%:w/w</option>
					<option value = "%:w/v">%:w/v</option>
					<option value = "%:v/v">%:v/v</option>
				</select>
			</td>
			<td><label for = "potency_db">Potency Type</label></td>
			<td>
				<select name ="potency_type" class = "validate[required]" >
					<option></option>
				  	<option value = "As Such">As Such</option>
				  	<option value ="On Dried Basis">On Dried Basis</option>
					<option val
					ue ="Anhydrous">Anhydrous</option>
				</select>
			</td>
			
		</tr>
		<tr>
			<td><label for = "water_content" >Water Content (%)</label></td>
			<td><input name = "water_content" type ="text" placeholder = "e.g 78" /></td>
		</tr>
		<tr>
			<td><label for = "quantity">Quantity</label></td>
			<td><input name ="quantity" type = "text" class ="validate[required]" placeholder = "e.g 3" value = "1" /></td>
			<td><label for = "init_mass">Initial Weight/Volume</label></td>
			<td><input name ="init_mass" type = "text" class ="validate[required]" placeholder = "e.g 300mg" />&nbsp;&nbsp;
				<select name ="init_mass_unit" class = "validate[required]">
				  	<option value = "mg">mg</option>
				  	<option value ="mL">mL</option>		
				</select>
				<!--select name ="q_unit" class = "validate[required]">
				  	<option value = "Vials">Vials</option>
				  	<option value ="Packets">Packets</option>		
				</select-->
			</td>
		</tr>

		<tr>
			<td><label for = "application">Application</label></td>	
			<td><select name ="application" class ="validate[required]">
				<option value = ""></option>
				<option value = "Identification">Identification</option>
				<option value = "Assay">Assay</option>
			</select></td>
			<!--td><label for = "status">Status</label></td>	
			<td><select name ="status" class ="validate[required]">
				<option value = ""></option>
				<option value = "In Use">In Use</option>
				<option id ="Reserved" value = "reserved">Reserved</option>
			</select></td-->
			<td><label for = "date_r">Date Received</label></td>
			<td><input name ="date_r" type = "text" id = "date_r" class ="validate[required] datepicker" readonly  /></td>
		</tr>

		<tr>
			<td><label for = "date_e">Date of Expiry</label></td>
			<td id = "doe" ><input name ="date_e" type = "text" id = "date_e" class ="validate[required] datepicker" placeholder = "e.g 02-OCT-2015" readonly /></td>
			<td><label for = "storage_conditions">Storage Conditions</label></td>
			<td id = "sc_td"><textarea name = "storage_conditions" id = "storage_conditions" placeholder = "e.g Cool Dry Place" ></textarea></td>
		</tr>


			<input type = "hidden" name = "version_id" value ="1" />


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

/*$('#date_r').datepicker("option", "setDate", new Date());
$('#date_r').datepicker("option", "maxDate", '0');

$('#date_r').change(function(){
date_r = $(this).datepicker('getDate');
date_e_min = new Date(date_r.getTime());
date_e_max = new Date(date_r.getTime());
date_e_max.setDate(date_e_max.getDate() + 732)
date_e_min.setDate(date_e_min.getDate() + 186); 

$('#date_e').datepicker("option", "minDate", date_e_min);
$('#date_e').datepicker("option", "maxDate", date_e_max);
$('#date_res').datepicker("option", "minDate", date_r);
})*/

$('#date_e').change(function(){
date_e =  $(this).datepicker('getDate');
$('#date_res').datepicker("option", "maxDate", date_e);
})


//$('#date_e').datepicker({
//minDate:




//})
//If WRSR Code is selected, means the standard has been restandardised the4 unhide date of restandardisation

$('.dor').hide();

$('#code').change(function(){

val = $(this).val();

if(val.indexOf("NQCL-WRSR-") >= 0){

$('.dor').show();

}

else {

$('.dor').hide();

}

})




$("#refsubs").validationEngine();

$( "#source" ).autocomplete({
	source: function(request, response) {
		$.ajax({ url: "<?php echo site_url('inventory/sourceSuggestions'); ?>",
		data: { term: $("#source").val()},
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
var inputs = $("#refsubs").find('input').not(':hidden').not('.potency').filter(function(){
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