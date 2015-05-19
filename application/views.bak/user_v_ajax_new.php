<html>
<div class ="content">
	<legend><a href="<?php echo site_url()."user_registration/"; ?>">User Registration</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add User</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/user_registration"; ?>">Add Equipment</a></legend>
	<div>&nbsp;</div>
<table id = "newUser">
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>User Name</th>
<th>Email</th>
<th>Telephone</th>
<th>Alias</th>
<th>Edit</th>
</tr>
</thead>
<tbody>

<?php foreach($user as $newUser) {?>	
<tr>
	<td><?php echo $newUser -> fname ?></td>
	<td><?php echo $newUser -> lname?></td>
	<td><?php echo $newUser -> username ?></td>
	<td><?php echo $newUser -> email ?></td>
	<td><?php echo $newUser -> telephone ?></td>
	<td><?php echo $newUser -> alias ?></td>
	<td><a class = "edit" href="#user<?php echo $newUser -> id ?>">Edit</a></td>
</tr>
    <div class = " popupform hidden2" id = "newUser<?php echo $newUser -> id ?>" >
		<form id = "editUser<?php echo $newUser -> id ?>" data-formid = "editUser" >
			<div>
				<legend>Edit. <?php echo $newUser -> lname ?></legend>
				<hr />
			</div>
			<div id = "add_success" class ="hidden2" >
				<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
			</div>	

			<div class = "clear">
				<div class = "left_align">
					<label for = "fname">First Name</label>
				</div>
				<div class = "right_align">
					<input name = "fName" required value = "<?php  echo $newUSer-> fname ?>"/>
				</div>
			</div>
            
 
			<div class = "clear">
					<div class = "left_align">
						<label for = "lName">Last Name</label>
					</div>
					<div class = "right_align">
						<input name = "lName" required value = "<?php  echo $newUser ->  lname?>"/>
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "uName">Username</label>
					</div>
					<div class = "right_align">
						<input name = "uName" required value = "<?php  echo $newUser -> username ?>"/>
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "email">Email</label>
					</div>
					<div class = "right_align">
						<input name = "email" required value = "<?php echo $newUser -> email ?>"/>
					</div>
			</div>
		<div class = "clear">
					<div class = "left_align">
						<label for = "telephone">Telephone</label>
					</div>
					<div class = "right_align">
						<input name = "telephone" required value = "<?php echo $newUSer -> telephone ?>"/>
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "alias">Alias</label>
					</div>
					<div class = "right_align">
						<input name = "alias" required value = "<?php echo $newUser -> alias ?>"/>
					</div>
			</div>

			<input type = "hidden" name = "dbestatus" id = "dbestatus<?php echo $equip -> id ?>" value = "<?php echo $equip -> status ?>" />
			<input type = "hidden" name = "dbid" value ="<?php echo $equip -> id ?>" />
			
			<div class = "clear" >
					<div class = "right_align">
						<input type = "submit" required value = "Update" class ="submit-button"  readonly />
					</div>
			</div>
		</form>
	</div>			

			<script type="text/javascript">
				$("#estatus<?php echo $equip -> id ?> option").each(function(){
						if($(this).val() == $("#dbestatus<?php echo $equip -> id ?>").val()){				
					$(this).attr("selected", "selected");
				}
			})
			</script>
<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">
	$(function(){

	$('#equip').dataTable({
		"bJQueryUI": true
	});

	$('.edit').fancybox();

	$('[name*="date"]').datepicker({
		changeYear:true,
	    dateFormat:"dd-M-yy"
	});

	$('[data-formid = "editequip"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/equipment_edit" ?>',
		data: $('[data-formid = "editequip"]').serialize(),
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

	})
</script>
</html>