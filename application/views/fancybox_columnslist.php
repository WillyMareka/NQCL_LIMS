<div class = " popupform" id = "col<?php echo $column[0]['id'] ?>" >
		<form id = "editcol<?php echo $column[0]['id'] ?>" data-formid = "editcol" >
			<div>
				<legend>Edit. <?php echo $column[0]['id'] ?>&nbsp;<?php echo $column[0]['serial_no']  ?></legend>
				<hr />
			</div>
			<div id = "add_success" class ="hidden2" >
				<span class = "misc-title small-text padded" ><?php print_r($_POST) ?></span>
			</div>	

			<div class = "clear">
				<div class = "left_align">
					<label for = "type">Type</label>
				</div>
				<div class = "right_align">
					<textarea name = "type" required ><?php  echo $column[0]['column_type'] ?></textarea>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "serial_no">Serial No.</label>
				</div>
				<div class = "right_align">
					<input name = "serial_no" required value = "<?php  echo $column[0]['serial_no'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "column_dimensions">Dimensions</label>
				</div>
				<div class = "right_align">
					<input name = "column_dimensions" required value = "<?php  echo $column[0]['column_dimensions'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "manufacturer">Manufacturer</label>
				</div>
				<div class = "right_align">
					<input name = "manufacturer" required value = "<?php  echo $column[0]['manufacturer'] ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "date_r">Date Received</label>
				</div>
				<div class = "right_align">
					<input name = "date_r" required value = "<?php  echo $column[0]['date_received'] ?>"/>
				</div>
			</div>
			<div class = "clear <?php if($column[0]['issued_to'] == "0"){ echo "hidden2";} else { echo ""; } ?>  ">
				<div class = "left_align">
					<label for = "issued_to">Issued To</label>
				</div>
				<div class = "right_align">
					<select name = "issued_to" id="issued_to<?php echo $column[0]['id'] ?>" >
						<option value = "0" > </option>
						<?php foreach($analysts as $analyst) { ?>
							<option value = "<?php echo $analyst['id'] ?>" ><?php echo $analyst['fname'] . " " . $analyst['lname']; ?></option>
						<?php } ?>	
					</select>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "status">Status</label>
				</div>
				<div class = "right_align">
					<select name = "status" >
						<option value = "1" >In Use</option>
						<option value = "0" >Decommissioned</option>
					</select>	
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "comment">Comment</label>
				</div>
				<div class = "right_align">
					<textarea name = "comment" ></textarea>	
				</div>
			</div>
			<input type = "hidden" name = "dbid" value = "<?php echo $column[0]['id']  ?>" />
			<input type = "hidden" name ="date_r2" id = "colstatus<?php echo $column[0]['id']  ?>" value ="<?php echo date('d-M-y') ?>" />
			<input type = "hidden" id = "dbissued_to<?php echo $column[0]['id'] ?>" value="<?php echo $column[0]['issued_to'] ?>" />
			<div class = "clear" >
				<div class = "right_align">
					<input type = "submit" value = "Save" class = "submit-button" />
				</div>
			</div>
			     <input type = "hidden" id = "colstatus<?php echo $column[0]['id'] ?>" value ="<?php echo $column[0]['column_status'] ?>" />
			</div>
		</form>
	</div>

<script type="text/javascript">

$(function(){   

$("#issued_to<?php echo $column[0]['id'] ?> option").each(function(){
if($(this).val() == $("#dbissued_to<?php echo $column[0]['id'] ?>").val()){				
		$(this).attr("selected", "selected");
	}
})



$('.edit').fancybox();	
$('.issue').fancybox();
$('.issued').fancybox();

var cols = $('#cols').dataTable({
	"bJQueryUI": true,
	"bDeferRender":true
});

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy",
});


var cols;
 	$('[data-formid = "editcol"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/column_edit/". $column[0]['column_status'] ?>',
		data: $('[data-formid = "editcol"]').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				//$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				console.log(parent.$.fancybox.close());
				//document.location.reload();	
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
	