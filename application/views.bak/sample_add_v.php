<link href="<?php echo base_url();?>stylesheets/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.23.custom.min.js"></script>
<div class="view_content">
	
	
<?php
$attributes = array('id' => 'entry_form');
echo form_open('sample_controller/save',$attributes);
echo validation_errors('
<p class="error">', '</p>
');
?>


<table class="dave-table">
	
	<fieldset class="no_border">
		
		<legend><a href="<?php echo site_url('sample_issue/listing'); ?>">Samples Listing</a>&nbsp;&larr;&nbsp;&nbsp;Sample Information&nbsp;&rarr;&nbsp;<?php echo $mylist[0]['request_id'] ?></legend>	
	
	<hr>
	
	<tr>
		<td><label>Date Sample Submitted</label></td><td><input type="text" name="submission_date" value="<?php echo date('d-M-Y',strtotime($mylist[0]['Designation_date'])); ?>" required readonly /></td>
		<td><label>Laboratory Reference No.</label></td><td><input type="text" name="lab_ref_no" value="<?php echo $mylist[0]['request_id']; ?>" required readonly /></td>
	</tr>
	
	<tr> 
		<td><label>Product Generic/Brand Name</label></td><td><input type="text" name="generic_brand_name" value="<?php echo $mylist[0]['product_name'];?>" required readonly /></td>
		<td><label>Product Chemical Name</label></td><td><input type="text" name="chemical_name" placeholder="e.g Amoxicillin Trihydrate" value="<?php echo $mylist[0]['active_ing']; ?>" required /></td>
		<td></td>
	</tr>
	
	<tr>
		<td><label>Product Description</label></td><td><textarea name="description" title="Describe how product looks like" required  ></textarea></td>
		<td><label>Product Presentation</label></td><td><textarea type="text" name="presentation" title="Describe how product is presented, Viles, Tablets e.t.c" required></textarea></td>
	</tr>
	
	
	<tr>
		<td><label>Label Claim</label></td><td><textarea name="label_claim" placeholder="e.g Label Claim" required readonly ><?php echo $mylist[0]['label_claim'];  ?></textarea></td>
	</tr>
	
	
	<tr>
		<td><label>Batch/Lot No</label></td><td><input type="text" name="batch_no" value="<?php echo $mylist[0]['Batch_no'];?>" required readonly /></td>
		<td><label>Product License No</label></td><td><input type="text" name="product_lic_no" placeholder="e.g Raj./ No .1640" required /></td>
	</tr>
	
	<tr>
		<td><label>Date of manufacture</label></td><td><input type="text" name="manufacture_date" value="<?php echo $mylist[0]['Manufacture_date'];?>" required readonly /></td>
		<td><label>Date of expiry</label></td><td><input type="text" name="expiry_date" value="<?php echo $mylist[0]['exp_date'];?>" required readonly /></td>
	</tr>
	
	<tr>
		<td><label>Manufacturer</label></td><td><input type="text" name="manufacturer" value="<?php echo $mylist[0]['Manufacturer_Name'];?>" required readonly /></td>
		<td><label>Country of Origin</label></td><td><input type="text" name="country_of_origin" placeholder="e.g India" required  id="country_of_origin"/></td>
	</tr>
	
	<tr>
		<td><label>Client Name</label></td><td><input type="text" name="client_name" value="<?php echo $clientinfo -> Name; ?>" required readonly /></td>
		<td><label>Client Address</label></td><td><input type="text" name="client_address" value="<?php echo $clientinfo -> Address;?>" required readonly /></td>
	</tr>
	
	<tr>
		<td><label>Client Reference Number</label></td><td><input type="text" name="client_reference" placeholder="e.g KEMSA/09/03/A" title="Optional - Fill only if provided" value="<?php echo $clientinfo -> Ref_number ?>" /></td>
	</tr>
	
	<tr>
		<input name="version_id" type ="hidden" value= 1 />
		<td><input type="submit" value="sample information" class="submit-button" name="submit"/></td>
	</tr>
	
	</fieldset>
	
</table>	


</div>
<script type="text/javascript">
$(document).ready(function() {
	$(function() {
		$( "#country_of_origin" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('sample_controller/suggestions'); ?>",
				data: { term: $("#country_of_origin").val()},
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
	});
});
</script>

<?php echo form_close();?>
