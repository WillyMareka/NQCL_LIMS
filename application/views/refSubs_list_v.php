<html>
<div class ="content">
	<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url()."inventory/refSublist"; ?>">Reference Substances List</a>&nbsp;|&nbsp;<span class ="link_highlight">Reference Substances Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd"; ?>">Add Reference Substance</a>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd_i"; ?>">Add Reference Substance to Inventory</a></legend>
	<div>&nbsp;</div>
<table id = "refsubs">
<thead>
	<tr>
		<th>Name</th>
		<th>Standard Type</th>
		<th>Source</th>
		<th>Batch No.</th>
		<th>NQCL No.</th>
		<th>Potency</th>
		<th>Weight/Volume</th>
		<th>Status</th>
		<th>Date Received</th>
		<th>Effective Date</th>
		<th>Date of Expiry</th>
		<th>Date of Restandardisation</th>
		<th>Edit</th>
	</tr>
</thead>
<tbody>
	
	<?php foreach($refsubs as $refsub) {?>	
	
	<tr>
		<td><?php echo $refsub -> name ?></td>
		<td><?php echo $refsub -> standard_type ?></td>
		<td><?php echo $refsub -> source ?></td>
		<td><?php echo $refsub -> batch_no ?></td>
		<td><?php echo $refsub -> rs_code ?></td>
		<td><?php echo $refsub -> potency . " " . $refsub -> potency_unit ?></td>
		<td><?php echo $refsub -> init_mass . " " . $refsub -> init_mass_unit ?></td>
		<td><?php  
				if(date('y-m-d') < $refsub -> date_of_expiry){
	        	echo $refsub -> status;
	        }

	        else{

	        	echo "Expired";

	        }

		?></td>
		<td><?php echo date('d-M-Y', strtotime($refsub -> date_received)) ?></td>
		<td><?php if($refsub -> effective_date != '1970-01-01' && $refsub -> effective_date != '0000-00-00' ){ echo date('d-M-y', strtotime($refsub -> effective_date)); } else { echo "Not Opened"; } ?></td>
		<td><?php echo date('d-M-Y', strtotime($refsub -> date_of_expiry)) ?></td>
		<td><?php if($refsub -> date_of_restandardisation != '1970-01-01' && $refsub -> date_of_restandardisation != '0000-00-00' ){ echo date('d-M-Y', strtotime($refsub -> date_of_restandardisation)); } else { echo "Not Restandardised"; } ?></td>
		<td><a class ="edit" id = "<?php echo $refsub -> id ?> " rel = "<?php echo $refsub -> id ?> "  href = "<?php echo "#refsub" . $refsub -> id ;  ?> " >Edit</a></td>

<div class = " popupform hidden2" id = "refsub<?php echo $refsub -> id ?>" >
<form id = "editrefsub<?php echo $refsub -> id ?>">
	<div>
		<legend>Edit. <?php echo $refsub -> version_id ?>&nbsp;.&nbsp;<?php  echo $refsub  -> name ?>&nbsp;.&nbsp;<?php  echo $refsub  -> rs_code ?></legend>
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
	<input name = "source" required value = "<?php  echo $refsub  -> source ?>"/>
	</div>
	</div>
	
	<div class = "clear" >
	<div class="left_align" >
	<label for = "batch_no" >Batch/Lot.No</label>
	</div>
	<div class = "right_align" >	
	<input name ="batch_no" required value = "<?php  echo $refsub  -> batch_no ?>" />
	</div>
	</div>

	<div class = "clear">
	<div class = "left_align">
	<label for = "potency">Potency</label>
	</div>
	<div class = "right_align">
	<input name = "potency" required value = "<?php  echo $refsub  -> potency ?>"/>
	<select name ="p_unit" class = "p_unit" id = "p_unit<?php echo $refsub -> id ?>" required >
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

	<div class="clear" >
		<div class = "left_align" >
		<label for = "init_mass" >Weight/Vol.</label>
		</div>
		<div class = "right_align">
		<input name ="init_mass" required value = "<?php  echo $refsub  -> init_mass ?>" />
				<select id = "init_mass<?php echo $refsub -> id ?>" name ="init_mass_unit" class = "validate[required] init_mass">
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
	<select class = "application" name = "application" id = "application<?php echo $refsub -> id ?>" required>
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
	<input name ="date_r" class ="date_r" required value = "<?php  echo date('d-M-Y', strtotime($refsub  -> date_received))?>" readonly />
	</div>
	</div>
	
	<div class = "clear">
		<div class = "left_align" >
	<label for = "date_e">Date of Expiry</label>
		</div>
		<div class = "right_align"> 
	<input name = "date_e" class = "date_e" required value = "<?php echo date('d-M-Y', strtotime($refsub  -> date_of_expiry)) ?>" readonly />
		</div>
	</div>
	
	<div class = "clear">
	<div class = "left_align" >
	<label for = "Status">Status</label>
	</div>
	<div class = "right_align"> 
	<select name = "status" class = "status" id = "status<?php echo $refsub -> id ?>" >
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

	<div class = "clear" >
	<div class="left_align clear <?php if($refsub -> restandardisation_status != "Restandardised" ){echo "hidden2";} else{ echo "";} ?>" >
	<label for = "date_res" >Restandardisation Date</label>
	</div>
	<div class = "right_align <?php if($refsub -> restandardisation_status != "Restandardised" ){echo "hidden2";} else{ echo "";} ?> " >
	<input name ="date_res" class ="date_res" value = "<?php if($refsub -> restandardisation_status != "Restandardised") {echo "";} else { echo date('d-M-Y', strtotime($refsub  -> date_of_restandardisation)) ; } ?>" required readonly />
	</div>
	</div>
	
	<div class ="clear left_align">
			<input name ="Save" type = "submit" class = "submit-button" value = "Save" />
	</div>

	<input type = "hidden" id ="dbpunit<?php echo $refsub -> id ?>" value = "<?php echo $refsub -> potency_unit ?>" />
	<input type = "hidden" id ="dbinitmass<?php echo $refsub -> id ?>" value = "<?php echo $refsub -> init_mass_unit ?>" />
	<input type = "hidden" id ="dbapp<?php echo $refsub -> id ?>" value = "<?php echo $refsub -> application ?>" />
	<input type = "hidden" id ="dbstatus<?php echo $refsub -> id ?>" value = "<?php echo $refsub -> status ?>" />
	<input type = "hidden" name = "version_id" value = "<?php echo $refsub -> version_id + 1 ?>" />
	<input type = "hidden" name = "name" value = "<?php echo $refsub -> name ?>" />
	<input type = "hidden" name = "rs_code" value = "<?php echo $refsub -> rs_code ?>" />
	</form>
</div>
</tr>

<script type="text/javascript">
$("#status<?php echo $refsub -> id ?> option").each(function(){
if($(this).val() == $("#dbstatus<?php echo $refsub -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#p_unit<?php echo $refsub -> id ?> option").each(function(){
if($(this).val() == $("#dbpunit<?php echo $refsub -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})


$("#init_mass<?php echo $refsub -> id ?> option").each(function(){
if($(this).val() == $("#dbinitmass<?php echo $refsub -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#p_unit<?php echo $refsub -> id ?> option").each(function(){
if($(this).val() == $("#dbpunit<?php echo $refsub -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

$("#application<?php echo $refsub -> id ?> option").each(function(){
if($(this).val() == $("#dbapp<?php echo $refsub -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

</script>


<?php } ?>

</tbody>
</table>
</div>

<script type="text/javascript">
$('#refsubs').dataTable({
	"bJQueryUI": true,
	"sDom": "S",
	"bDeferRender":true		
});

$('.edit').fancybox({});

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy",
});


//Date Validation

date_r = $('.date_r').datepicker('getDate');
date_r_min = new Date(date_r.getTime());
date_r_min.setDate(date_r_min.getDate() + 186); 
$('.date_r').datepicker("option", "maxDate", date_r);
$('.date_e').datepicker("option", "minDate", date_r_min);
$('.date_res').datepicker("option", "minDate", '0');


$(function(){

$('form').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: 'editrefsubs/',
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
</html>