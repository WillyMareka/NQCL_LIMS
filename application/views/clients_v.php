<html>
<div id="view_content">
	<a class="action_button" id="new_clients" href="#entry_form" >New Client</a>
	<div align="center">
	<?php //var_dump($client_details) ?>	
		<table id ="clienttable">
			<thead>
				<tr>
					<th>Client Name</th>
					<th>Client Address</th>
					<th>Client Type</th>
					<th>Contact Person</th>
					<th>Contact Phone</th>
					<th>Client Status</th>
					<th>Edit Client</th>
					<th>Edit History</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($client_details as $client_detail){ ?>
				<tr>
					<td><?php echo $client_detail['Name'] ?></td>
					<td><?php echo $client_detail['Address'] ?></td>
					<td><?php echo $client_detail['Client_type'] ?></td>
					<td><?php echo $client_detail['Contact_person'] ?></td>
					<td><?php echo $client_detail['Contact_phone'] ?></td>
					<td><?php if($client_detail['Client_status'] == '1'){ echo "Active"; }else{ echo "Inactive"; } ?></td>
					<td><a class = 'edit' href = "#client<?php echo $client_detail['id'] ?>">Edit</a></td>
					<td>
						<?php if ($client_detail['Edit_status'] != "0"){?>
							<a class = 'history' id ="<?php echo $client_detail['id'] ?>" >Show</a>
						<?php } else {?>
							<span class = "misc_title" >No Edits</span>
						<?php } ?>
						
					</td>
				</tr>

				<div class = " popupform hidden2" id = "client<?php echo $client_detail['id']?>" >
				<form id = "editclient<?php echo $client_detail['id'] ?>" data-formid = "editclient" >
				<div>
				<legend>Edit. <?php echo $client_detail['Name'] ?></legend>
				<hr />
				</div>
				<div id = "add_success" class ="hidden2" >
					<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
				</div>	

				<div class = "clear">
					<div class = "left_align">
						<label for = "cname">Client Name</label>
					</div>
					<div class = "right_align">
						<input name = "cname" required value = "<?php  echo $client_detail['Name'] ?>"/>
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "cadd">Client Address</label>
					</div>
					<div class = "right_align">
						<input name = "cadd" required value = "<?php  echo $client_detail['Address'] ?>"/>
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "ctype">Client Type</label>
					</div>
					<div class = "right_align">
						<select name = "ctype" id = 'ctype<?php echo $client_detail['id'] ?>' required>
							<option>A</option>
							<option>B</option>
							<option>C</option>
							<option>D</option>
						</select> 
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "cperson">Contact Person</label>
					</div>
					<div class = "right_align">
						<input name = "cperson" required value = "<?php  echo $client_detail['Contact_person'] ?>"/>
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "cphone">Client Phone</label>
					</div>
					<div class = "right_align">
						<input name = "cphone" required value = "<?php echo $client_detail['Contact_phone'] ?>"/>
					</div>
				</div>
				<div class = "clear">
					<div class = "left_align">
						<label for = "status">Status</label>
					</div>
					<div class = "right_align">
						<select name = "status" id="activestatus<?php echo $client_detail['id'] ?>" >
							<option value = "1" >Active</option>
							<option value = "0" >Inactive</option>
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
				<div class  = "clear">
						<div class = "right_align">
							<input type = "submit" class = "submit-button" value = "Save" />
						</div>
				</div>

				<input type = "hidden" id = "dbctype<?php echo $client_detail['id'] ?>" name = "dbctype" value = "<?php echo $client_detail['Client_type'] ?>" />	
				<input type = "hidden" name = "cid" value = "<?php echo $client_detail['id'] ?>" />
				<input type = "hidden" id = "dbactivestatus<?php echo $client_detail['id'] ?>" name = "dbactivestatus" value = "<?php echo $client_detail['Edit_status'] ?>" />	

			</div>
			</form>
			<script type="text/javascript">
				$("#ctype<?php echo $client_detail['id'] ?> option").each(function(){
					if($(this).val() == $("#dbctype<?php echo $client_detail['id'] ?>").val()){				
					$(this).attr("selected", "selected");
				}
			})

				$("#activestatus<?php echo $client_detail['id'] ?> option").each(function(){
					if($(this).val() == $("#activestatus<?php echo $client_detail['id'] ?>").val()){				
					$(this).attr("selected", "selected");
				}
			})

			</script>
				<?php } ?>
			</tbody>
		</table>
	</div>
<div id="entry_form" title="New Client" class = "hidden2">
<form class = 'input_form' id = 'clientform'>	
<legend>Add Client</legend>
<fieldset>
	<table>
	<tr>
	<td>Client Name</td>
	<td><input type="text" name="client_name" class ="validate[required]" /></td>
	</tr>

	<tr>
	<td>Client Address</td>
	<td><input type="text" name="client_address" class ="validate[required]" /></td>
	</tr>

	<!--tr>
	<td>Client Number</td>
	<td><input type="text" name="client_number" /></td>
	</tr-->

	<tr>
	<td>Contact Person</td>
	<td><input type="text" name="contact_person" class ="validate[required]" /></td>
	</tr>

	<tr>
	<td>Contact Telephone Number</label></td>
	<td><input type="text" name="contact_phone" class ="validate[required]" /></td>
	</tr>
	<tr>
	<td>Client Type</td>
	<td><select  name="clientT" class ="validate[required]" >
		<option>A</option>
		<option>B</option>
		<option>C</option>
		<option>D</option>
	</select></td>

	</tr>

	<tr>
	<td><input name="submit" type="submit" value="Save Client" class="button"></td>
	</tr>
	</table>
</fieldset>
	</form>
</div>
</div>

<script type="text/javascript">
		$(document).ready(function() {

	$("#clientform").validationEngine();	

		$('#clientform').submit(function(e){

			e.preventDefault();

			var empty_inputs = false;

			$(".input_form input").each(function(){
				if($(this).val() == ''){
					empty_inputs = true;
					console.log(empty_inputs);
				}
			});

			if(empty_inputs){

				alert("Please fill empty fields to continue.")
			}

			else {
	
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "client_management/save" ?>',
		data: $('#clientform').serialize(),
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

 }

})

	

var rtable = 	
$('#clienttable').dataTable({
	"bJQueryUI" : true,
	"sScrollY": "300px",
    "sScrollX": "100%"
})

	$('.edit').fancybox();
	$('#new_clients').fancybox();

	$('[data-formid = "editclient"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "client_management/edit" ?>',
		data: $('[data-formid = "editclient"]').serialize(),
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

})


	$('.history').live("click",function(e){
		e.preventDefault();
		var nTr = this.parentNode.parentNode;
			
			if($(this).text() == 'Show'){
				
			   $(this).text("Hide");
				
				//alert("Under Construction");
				
				var id = $(this).attr("id");
				//var type = $(this).attr("rel");
			
				$.post("<?php echo site_url('client_management/clients_showHistory'); ?>" + "/" + id , function(history){
					
					rtable.fnOpen(nTr, history, 'history');
				})
				
				
			}
			
			
			else{

				rtable.fnClose(nTr);
				
				$(this).text("Show");	
				
			}
			
			
		})

});


</script>

</html>