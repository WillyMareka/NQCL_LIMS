<html>
<div class ="content">

<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Reagents Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/reagentadd"; ?>">Add Reagents</a>
&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/reagentsadd";?>">Add Reagents to Inventory</a></legend>
<div>&nbsp;</div>

<table id = "rgents">
<thead>
<tr>

<th>Name</th>
<!--th>Comment</th-->
<th>Manufacter</th>
<th>Batch No.</th>
<th>Quantity</th>
<th>Date Received</th>
<th>Date Opened</th>
<th>Date of Expiry</th>
<th>Reorder Level</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php foreach($reagents as $reagent) {?>	
<tr>
	<td><?php echo $reagent -> name ?></td>
	<td><?php echo $reagent -> manufacturer ?></td>
	<td><?php echo $reagent -> batch_no ?></td>
	<td><?php echo $reagent -> quantity . " " . $reagent -> volume . $reagent -> qunit . " " . $reagent -> packaging ?></td>
	
	<td><?php echo date('d-M-y', strtotime($reagent -> date_received)) ?></td>
	<td><?php if( $reagent -> date_opened != '1970-01-01'){echo date('d-M-y', strtotime($reagent -> date_opened));} else { echo "Not Opened"; } ?></td>
	<td><?php echo date('d-M-y', strtotime($reagent -> date_of_expiry)) ?></td>
	<td><?php echo $reagent -> reorder_level . " " . $reagent -> packaging ?></td>
	<td><a class = "edit" href = "#reagent<?php echo $reagent -> id ?>" >Edit</a></td>
</tr>

<div class = " popupform hidden2" id = "reagent<?php echo $reagent -> id ?>" >
	<form id = "editreagent<?php echo $reagent -> id ?>" data-formid = "editreagent" >
		<div>
			<legend>Edit. <?php echo $reagent -> name ?></legend>
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
				<input name = "name" required value = "<?php  echo $reagent -> name ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "manufacturer">Manufacturer</label>
			</div>
			<div class = "right_align">
				<input name = "manufacturer" required value = "<?php  echo $reagent -> manufacturer ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "batch_no">Batch No.</label>
			</div>
			<div class = "right_align">
				<input name = "batch_no" required value = "<?php  echo $reagent -> batch_no ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "no_of_units">No of Units</label>
			</div>
			<div class = "right_align">
				<input name = "no_of_units" required value = "<?php  echo $reagent -> quantity ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "quantity">Quantity</label>
			</div>
			<div class = "right_align">
				<input name = "quantity" required value = "<?php echo $reagent -> volume ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "qunit">Unit</label>
			</div>
			<div class = "right_align">
				<select name = "qunit" id = "qunit<?php echo $reagent -> id ?>">
					<option value= " ">&nbsp;</option>
					<option value = "mg" >Mg</option>
			  		<option value = "mL" >mL</option>
				</select>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "packaging">Packaging</label>
			</div>
			<div class = "right_align">
				<select name = "packaging" id = "packaging<?php echo $reagent -> id  ?>">
				<option value= " ">&nbsp;</option>
				<option value = "Bottles" >Bottles</option>
			  	<option value = "Packets" >Packets</option>
				</select>
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "r_level">Reorder Level<span class = "smalltext gray_out italics">(<?php echo $reagent -> packaging ?>)</span></label>
			</div>
			<div class = "right_align">
				<input name = "r_level" required value = "<?php echo $reagent -> reorder_level ?>" />
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "date_r">Date Received</label>
			</div>
			<div class = "right_align">
				<input name = "date_r" required value = "<?php echo date('d-M-y', strtotime($reagent -> date_received)) ?>" />
			</div>
		</div>
		<div class = "clear">
			<div class = "left_align">
				<label for = "date_e">Date of Expiry</label>
			</div>
			<div class = "right_align">
				<input name = "date_e" required value = "<?php echo date('d-M-y', strtotime($reagent -> date_of_expiry)) ?>" />
			</div>
		</div>
		<div class = "clear">
			<div class = "right_align">
				<input type = "submit" class = "submit-button" required value = "Update" />
			</div>
		</div>
		<input type = "hidden" name = "reagent_id" value ="<?php echo $reagent -> id ?>"  />
	</form>
</div>
<input type = "hidden" id = "dbqunit<?php echo $reagent -> id ?>" value = "<?php echo $reagent -> qunit  ?>" />
<input type = "hidden" id = "dbpackaging<?php echo $reagent -> id ?>" value = "<?php echo $reagent -> packaging  ?>" />
	
<script type="text/javascript">
		$("#qunit<?php echo $reagent -> id ?> option").each(function(){
		if($(this).val() == $("#dbqunit<?php echo $reagent -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})

		$("#packaging<?php echo $reagent -> id ?> option").each(function(){
		if($(this).val() == $("#dbpackaging<?php echo $reagent -> id ?>").val()){				
		$(this).attr("selected", "selected");
	}
})		

		$('form[id = "editreagent<?php echo $reagent -> id ?>"]').submit(function(e){
					e.preventDefault();
					$.ajax({
					type: 'POST',
					url: '<?php echo site_url() . "inventory/reagents_edit" ?>',
					data: $('form[id = "editreagent<?php echo $reagent -> id ?>"]').serialize(),
					dataType: "json",
					success:function(response){
					if(response.status === "success"){
						$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
						parent.$.fancybox.close();
						document.location.reload();
						//$('.issue').text("Issued");
			}
					else if(response.status === "error"){
						alert(response.message);
			}
		},
		error:function(){
		}
		})

	})

</script>
<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">
$('#rgents').dataTable({
	"bJQueryUI": true
});

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"dd-M-yy"
});

$('.edit').fancybox();

</script>
</html>