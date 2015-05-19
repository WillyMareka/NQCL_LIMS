<?php
/*$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
*/?>

<head></head>
<div class = " popupform" id = "refsub<?php echo $reagent[0] -> id ?>" >
<form id = "editrefsub<?php echo $reagent[0] -> id ?>">
	<div>
		<legend>Edit. <?php echo $reagent -> id ?>&nbsp;.&nbsp;<?php  echo $reagent[0]  -> name ?></legend>
		<hr />
	</div>

	<div id = "add_success" class ="hidden2" >
		<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
	</div>	

	<div class = "clear">
	<div class = "left_align">
	<label for = "name">Name</label>
	</div>
	<div class = "right_align">
	<input name = "name" required value = "<?php  echo $reagent[0]  -> name ?>" />
	</div>
	</div>

	<div class = "clear">
	<div class = "left_align">
	<label for = "manufacturer">Manufacturer</label>
	</div>
	<div class = "right_align">
	<input name = "manufacturer" required value = "<?php  echo $reagent[0]  -> manufacturer ?>"/>
	</div>
	</div>

	<div class="clear" >
		<div class = "left_align" >
		<label for = "batch_no" >Batch No.</label>
		</div>
		<div class = "right_align">
		<input name ="batch_no" required value = "<?php  echo $reagent[0]  -> batch_no ?>" />
	</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align">
	<label for = "date_r">Date Received</label>
		</div>
		<div class = "right_align" >
		<input name ="date_r" class ="date_r" required value = "<?php echo date('d-M-Y', strtotime($reagent[0] -> date_received)) ?>" readonly />
	</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align" >
	<label for = "date_e">Date of Expiry</label>
		</div>
		<div class = "right_align"> 
	<input name = "date_e" class = "date_e" required value = "<?php echo date('d-M-Y', strtotime($reagent[0]  -> date_of_expiry)) ?>" readonly />
		</div>
	</div>
	
	<div class = "clear">
	<div class = "left_align" >
	<label for = "r_level">Re-order Level</label>
	</div>
	<div class = "right_align"> 
	<input type = "text" name = "r_level" required value = "<?php echo $reagent[0] -> reorder_level ?>" />	
	</div>
	</div>

	<div class = "clear">
	<div class = "left_align" >
	<label for = "quantity">Quantity</label>
	</div>
	<div class = "right_align"> 
	<input type = "text" name = "quantity" required value = "<?php echo $reagent[0] -> quantity ?>" />	
	</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align" >
		<label for = "volume">Volume</label>
		</div>
		<div class = "right_align"> 
		<input name = "volume" required value="<?php echo $reagent[0] -> volume ?>" >
		<select name ="qunit" required id="qunit<?php echo $reagent[0] -> id ?>" >
			<option value = "g" >g</option>
			<option value = "L" >L</option>
		</select>
		<select name ="packaging" required id="packaging<?php echo $reagent[0] -> id ?>" >
			<option value = "Bottles" >Bottles</option>
			<option value = "Packets" >Packets</option>
		</select>
			
		</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align" >
			<label for = "form">Form</label>
		</div>
		<div class = "right_align"> 
			<select name = "form" required id ="form<?php echo $reagent[0] -> id ?>" >
				<option value = "Solid" >Solid</option>
				<option value = "Liquid" >Liquid</option>
			</select>
		</div>
	</div>

	<div class = "clear">
		<div class = "left_align" >
			<label for = "status">Status</label>
		</div>
		<div class = "right_align"> 
			<select name = "status" required id ="status<?php echo $reagent[0] -> status ?>" >
				<option value = "Effective" >Effective</option>
				<option value = "Expired" >Expired</option>
			</select>
		</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align" >
			<label for = "comment">Comment</label>
		</div>
		<div class = "right_align"> 
			<textarea name = "comment" ></textarea>
		</div>
	</div>
		
	<div class ="clear left_align">
			<input name ="Save" type = "submit" class = "submit-button" value = "Save" />
	</div>

	<input type = "hidden" id ="dbqunit<?php echo $reagent[0] -> id ?>" value = "<?php echo $reagent[0] -> qunit ?>" />
	<input type = "hidden" id ="dbpackaging<?php echo $reagent[0] -> id ?>" value = "<?php echo $reagent[0] -> packaging ?>" />
	<input type = "hidden" id ="dbform<?php echo $reagent[0] -> id ?>" value = "<?php echo $reagent[0] -> form ?>" />
	<input type = "hidden" name = "reagent_id" value = "<?php echo $reagent[0] -> id ?>" />
	</form>
</div>

 <script type="text/javascript">
$("#qunit<?php echo $reagent[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbqunit<?php echo $reagent[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#packaging<?php echo $reagent[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbpackaging<?php echo $reagent[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#form<?php echo $reagent[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbform<?php echo $reagent[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#status<?php echo $reagent[0] -> id ?> option").each(function(){
if($(this).val() == $("#dbstatus<?php echo $reagent[0] -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy",
});


//Date Validation

date_r = $('.date_r').datepicker('getDate');
date_r_min = new Date(date_r.getTime());
date_r_min.setDate(date_r_min.getDate() + 1); 
$('.date_r').datepicker("option", "maxDate", date_r);
$('.date_e').datepicker("option", "minDate", date_r_min);
$('.date_res').datepicker("option", "minDate", '0');


$(function(){

$('form').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url()."inventory/reagents_edit" ?>',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				parent.$.fancybox.close();
				document.location.reload();	
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