<?php
/*$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
*/?>

<head></head>

<div class = " popupform" id = "refsub<?php echo $refsub[0] -> id ?>" >
<form id = "editrefsub<?php echo $refsub[0] -> id ?>">
	<div>
		<legend>Edit. <?php echo $refsub[0] -> version_id ?>&nbsp;.&nbsp;<?php  echo $refsub[0]  -> name ?>&nbsp;.&nbsp;<?php  echo $refsub[0]  -> rs_code ?></legend>
		<hr />
	</div>

	<div id = "add_success" class ="hidden2" >
		<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
	</div>	

	<div class = "clear">
	<div class = "left_align">
	<label for = "source">Source</label>
	</div>
	<div class = "right_align">
	<input name = "source" required value = "<?php  echo $refsub[0]  -> source ?>"/>
	</div>
	</div>
	
	<div class = "clear" >
	<div class="left_align" >
	<label for = "batch_no" >Batch/Lot.No</label>
	</div>
	<div class = "right_align" >	
	<input name ="batch_no" required value = "<?php  echo $refsub[0]  -> batch_no ?>" />
	</div>
	</div>

	<div class = "clear">
	<div class = "left_align">
	<label for = "potency">Potency<small><i>&nbsp;(As Such)</i></small></label>
	</div>
	<div class = "right_align">
	<input name = "potency" required value = "<?php  echo $refsub[0]  -> potency ?>"/>
	<select name ="p_unit" class = "p_unit" id = "p_unit<?php echo $refsub[0] -> id ?>" required >
				  	<option value = "%">%</option>
				  	<option value ="&#956;g/g">&#956;g/g</option>
				  	<option value ="mg/g">mg/g</option>
				  	<option value ="iu/mg">iu/mg</option>
				  	<option value ="iu/mL">iu/mL</option>
					<option value = "%:w/w">%:w/w</option>
					<option value = "%:w/v">%:w/v</option>
					<option value = "%:v/v">%:v/v</option>
				</select>
	</div>
	</div>

	<div class = "clear">
	<div class = "left_align">
	<label for = "potency_type">Potency Type</label>
	</div>
	<div class = "right_align">
	<select name ="potency_type" class = "potency_type" id = "potency_type<?php echo $refsub[0] -> id ?>" required >
			<option value = "As Such">As Such</option>
			<option value =" On Dried Basis">On Dried Basis</option>
			<option value ="Anhydrous">Anhydrous</option>
		</select>
	</div>
	</div>

	<div class = "clear">
		<div class = "left_align">
			<label for = "water_content">Water Content</label>
		</div>
		<div class = "right_align">
			<input name = "water_content" required value = "<?php  echo $refsub[0]  -> water_content ?>"/>
		</div>
	</div>

	<div class = "clear" >
	<div class="left_align" >
	<label for = "quantity" >Quantity</label>
	</div>
	<div class = "right_align" >	
	<input name ="quantity" required value = "<?php  echo $refsub[0]  -> quantity ?>" />
	</div>
	</div>

	<div class="clear" >
		<div class = "left_align" >
		<label for = "init_mass" >Weight/Vol.</label>
		</div>
		<div class = "right_align">
		<input name ="init_mass" required value = "<?php  echo $refsub[0]  -> init_mass ?>" />
				<select readonly id = "init_mass<?php echo $refsub[0] -> id ?>" name ="init_mass_unit" class = "validate[required] init_mass">
				  	<option value = "mg">mg</option>
				  	<option value ="mL">mL</option>		
				</select>
	</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align">
	<label for = "application">Application</label>
		</div>
		<div class = "right_align" >
	<select class = "application" name = "application" id = "application<?php echo $refsub[0] -> id ?>" required>
		<option value = "" ></option>
		<option value = "Identification" >Identification</option>
		<option value = "Assay" >Assay</option>
	</select>
	</div>
	</div>


	<div class ="clear" >
	<div class="left_align" >
	<label for = "date_r" >Date Received</label>
	</div>
	<div class = "right_align" >
	<input name ="date_r" class ="date_r" required value = "<?php  echo date('d-M-Y', strtotime($refsub[0]  -> date_received))?>" readonly />
	</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align" >
	<label for = "date_e">Date of Expiry</label>
		</div>
		<div class = "right_align"> 
	<input name = "date_e" class = "date_e" required value = "<?php echo date('d-M-Y', strtotime($refsub[0]  -> date_of_expiry)) ?>" readonly />
		</div>
	</div>
	
	<div class = "clear">
	<div class = "left_align" >
	<label for = "Status">Status</label>
	</div>
	<div class = "right_align"> 
	<select name = "status" class = "status" id = "status<?php echo $refsub[0] -> id ?>" >
		<option value ="" ></option>
		<option value ="In Use" >In Use</option>
		<option value ="Reserved" >Reserved</option>
		<option value ="Almost Exhausted" >Almost Exhausted</option>
		<option value ="Exhausted" >Exhausted</option>
		<option value ="Incinerated" >Incinerated</option>
		<option value ="Expired" >Expired</option>
	</select>
	</div>
	</div>

	<div class = "clear">
		<div class = "left_align" >
			<label for = "comment">Comment</label>
		</div>
		<div class = "right_align"> 
			<textarea name = "comment" class = "comment" required ></textarea>  		
		</div>
	</div>

	<div class = "clear" >
	<div class="left_align clear <?php if($refsub[0] -> restandardisation_status != "Restandardised" ){echo "hidden2";} else{ echo "";} ?>" >
	<label for = "date_res" >Restandardisation Date</label>
	</div>
	<div class = "right_align <?php if($refsub[0] -> restandardisation_status != "Restandardised" ){echo "hidden2";} else{ echo "";} ?> " >
	<input name ="date_res" class ="date_res" value = "<?php if($refsub[0] -> restandardisation_status != "Restandardised") {echo "";} else { echo date('d-M-Y', strtotime($refsub[0]  -> date_of_restandardisation)) ; } ?>" required readonly />
	</div>
	</div>
	
	<div class ="clear left_align">
			<input name ="Save" type = "submit" class = "submit-button" value = "Save" />
	</div>

	<input type = "hidden" id ="dbpunit<?php echo $refsub[0] -> id ?>" value = "<?php echo $refsub[0] -> potency_unit ?>" />
	<input type = "hidden" id ="dbpotency_type<?php echo $refsub[0] -> id ?>" value = "<?php echo $refsub[0] -> potency_type ?>" />
	<input type = "hidden" id ="dbinitmass<?php echo $refsub[0] -> id ?>" value = "<?php echo $refsub[0] -> init_mass_unit ?>" />
	<input type = "hidden" name = "version_id" value = "<?php echo $refsub[0] -> version_id + 1 ?>" />
	<input type = "hidden" id ="dbapp<?php echo $refsub[0] -> id ?>" value = "<?php echo $refsub[0] -> application ?>" />
	<input type = "hidden" id ="dbstatus<?php echo $refsub[0] -> id ?>" value = "<?php echo $refsub[0] -> status ?>" />
	<input type = "hidden" name = "name" value = "<?php echo $refsub[0] -> name ?>" />
	<input type = "hidden" name = "rs_code" value = "<?php echo $refsub[0] -> rs_code ?>" />
	<input type = "hidden" name = "dbid" value = "<?php echo $refsub[0] -> id ?>" />
	</form>
</div>

 <script type="text/javascript">
$("#status<?php echo $refsub[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbstatus<?php echo $refsub[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#potency_type<?php echo $refsub[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbpotency_type<?php echo $refsub[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#p_unit<?php echo $refsub[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbpunit<?php echo $refsub[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})


$("#init_mass<?php echo $refsub[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbinitmass<?php echo $refsub[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#p_unit<?php echo $refsub[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbpunit<?php echo $refsub[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#application<?php echo $refsub[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbapp<?php echo $refsub[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy",
});


//Date Validation

/*date_r = $('.date_r').datepicker('getDate');
date_r_min = new Date(date_r.getTime());
date_r_min.setDate(date_r_min.getDate() + 1); 
$('.date_r').datepicker("option", "maxDate", date_r);
$('.date_e').datepicker("option", "minDate", date_r_min);
$('.date_res').datepicker("option", "minDate", '0');
*/

$(function(){

$('form').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url()."inventory/editrefsubs" ?>',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				parent.$.fancybox.close();
				document.location.href="<?php echo base_url().'inventory/refsubslist' ?>";
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

//}

})

})



</script>