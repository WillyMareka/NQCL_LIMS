<?php 
$attributes = array('id' => 'entry_form');
echo form_open('sample_issue/withdraw_save/',$attributes);
echo validation_errors('<p class="error">', '</p>');
?>

<legend><a href="<?php echo base_url('/'); ?>">Home</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url('sample_issue/issued_listing'); ?>" >Samples Issued Listing</a>&nbsp;&larr;&nbsp;<?php echo $title ?></legend>

<hr />

<table class="withdrawal issues">
	<thead>
	 	<tr>
	 		<th><?php if($w_status == 0){ echo "Samples Issued";} else{ echo "Samples Available";}?></th>
			<th><?php if($w_status == 0){ echo "Samples Returned";} else{ echo "Samples to Issue";}?></th>
			<th>Department</th>
	      	<th>Reasons for withdrawal</th>
	      	<th>Save</th>
	  	</tr>  
	</thead>
	<tbody>
		<tr>
			<td><span id ="s_issue"><?php if($w_status == 0){echo $sample_issues[0]['Samples_no'];} else{ echo $sample_listing[0]['sample_qty']; } ?></span></td>
			<td><input type="text" id = "s_return" name = "samples_returned" required /></td>
			<td><select><option value = "1">Wet Chemistry</option>
				<option value = "2">Microbiological Analysis</option>
				<option value = "3">Medical Devices</option><select></td>
			<td><textarea name = "withdrawreason" ></textarea></td>
			<td><input type="submit" value="Save" class="submit-button" /></td>
		</tr>
	</tbody>
</table>
<!--input type="hidden" name="testid" value="<?php //echo $testid ?>" /-->
<input type="hidden" name="issued_samples" value="<?php echo $sample_issues[0]['Samples_no'] ?>" />
<input type="hidden" name="lab_ref_no" value="<?php echo $sample_issues[0]['Lab_ref_no'] ?>" />
<input type="hidden" name="w_status" value="<?php echo $w_status ?>" />
<input type="hidden" name="request_samples" value="<?php echo $sample_listing[0]['sample_qty'] ?>" />
</form>

<script>
	$(function(){
		$('.withdrawal').dataTable({
		"bPaginate":false,
		"bJQueryUI":true,
		"bSortClasses":false,
		"bSort":false,
		"bFilter":false,
		"sDom":'t',
		"bRetrieve":true

			
		});

		//alert(parseInt($('#s_issue').text()));		


		$('#s_return').keyup(function(){



			if($(this).val() > parseInt($('#s_issue').text())) {

				$(this).val(0);
				alert("Sorry, Samples Returned must be less than Samples Issued.");
			}
			else if($(this).val() < 0 ) {

				$(this).val(0);
				alert("Sorry, Samples Returned must be greater than or equal to zero.");	
			}

			else if($(this).val() == "NaN"){
				$(this).val(0);
				alert("Sorry, only integers i.e 1, 2, 3 e.t.c accepted here.");		
			}

		})

	})
</script>