   <div class = " popupform" id = "equip<?php echo $equipment[0] -> id ?>" >
		<form id = "editequip<?php echo $equipment[0] -> id ?>" data-formid = "editequip" >
			<div>
				<legend>Edit. <?php echo $equipment[0] -> name ?></legend>
				<hr />
			</div>
			<div id = "add_success" class ="hidden2" >
				<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
			</div>	

			<div class = "clear">
				<div class = "left_align">
					<label for = "ename">Equipment Name</label>
				</div>
				<div class = "right_align">
					<input name = "ename" required value = "<?php  echo $equipment[0] -> name ?>"/>
				</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "esno">Equipment Serial No.</label>
					</div>
					<div class = "right_align">
						<input name = "esno" required value = "<?php  echo $equipment[0] -> serial_no ?>"/>
					</div>
			</div>

			<div class = "clear">
					<div class = "left_align">
						<label for = "model">Model</label>
					</div>
					<div class = "right_align">
						<input name = "model" required value = "<?php  echo $equipment[0] -> model ?>"/>
					</div>
			</div>

			<div class = "clear">
					<div class = "left_align">
						<label for = "date-acq">Date Acquired</label>
					</div>
					<div class = "right_align">
						<input name = "date-acq" required value = "<?php echo $equipment[0] -> date_acquired ?>" />
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "date-cal">Date of Calibration</label>
					</div>
					<div class = "right_align">
						<input name = "date-cal" required value = "<?php echo $equipment[0] -> date_of_calibration ?>" />
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "date-nxtcal">Date of Next Calibration</label>
					</div>
					<div class = "right_align">
						<input name = "date-nxtcal" required value = "<?php echo $equipment[0] -> date_of_nxtcalibration ?>" />
					</div>
			</div>

			<div class = "clear">
					<div class = "left_align">
						<label for = "Type">Type</label>
					</div>
					<div class = "right_align">
						<select name = "type" id="type<?php echo $equipment[0] -> id ?>" >
							<option value = "Lab">Lab</option>
							<option value = "Other">Other</option>
						</select>
					</div>
			</div>

			<div class = "clear">
					<div class = "left_align">
						<label for = "status">Status</label>
					</div>
					<div class = "right_align">
						<select name="status" id = "estatus<?php echo $equipment[0] -> id ?>">
							<option value = "Calibrated" >Calibrated</option>
							<option value = "Pending Calibration" >Pending Calibration</option>
							<option value = "Out of Service">Out of Service</option>
							<option value = "Decommissioned">Decommissioned</option>	
						</select>
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "comment">Comment</label>
					</div>
					<div class = "right_align">
						<textarea name = "comment" required ></textarea>
					</div>
			</div>
			<input type = "hidden" name = "dbestatus" id = "dbestatus<?php echo $equipment[0] -> id ?>" value = "<?php echo $equipment[0] -> status ?>" />
			<input type = "hidden" name = "dbid" value ="<?php echo $equipment[0] -> id ?>" />
			<input type = "hidden" name = "dbtype" id = "dbtype<?php echo $equipment[0] -> id ?>" value = "<?php echo $equipment[0] -> type ?>" />

			<div class = "clear" >
					<div class = "right_align">
						<input type = "submit" required value = "Update" class ="submit-button"  readonly />
					</div>
			</div>
		</form>
	</div>			

<script type="text/javascript">

$(function(){   

	$("#estatus<?php echo $equipment[0] -> id ?> option").each(function(){
			if($(this).val() == $("#dbestatus<?php echo $equipment[0]-> id ?>").val()){
		$(this).attr("selected", "selected");
	}
})

	$("#type<?php echo $equipment[0] -> id ?> option").each(function(){
			if($(this).val() == $("#dbtype<?php echo $equipment[0]-> id ?>").val()){
		$(this).attr("selected", "selected");
	}
})	



var cols = $('#cols').dataTable({
	"bJQueryUI": true,
	"bDeferRender":true
});

$('input[name*="date"]').datepicker({
});


var cols;
 	$('[data-formid = "editequip"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/equipment_edit/". $equipment[0]['id'] ?>',
		data: $('[data-formid = "editequip"]').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				//$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				console.log(parent.$.fancybox.close());
				document.location.href="<?php echo base_url().'inventory/refsubslist' ?>";
				
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

})


})

</script>
	