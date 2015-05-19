<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Data Form</title>
<script type="text/javascript">
$(document).ready(function(){  
	
	$(".users1").change(function() {
	    if(this.checked)
		{
			$(".users2").prop("disabled",true);
			$(".users3").prop("disabled",true);
		}
		else
		{
			$(".users2").prop("disabled",false);
			$(".users3").prop("disabled",false);
		}
	})
	
	$(".users2").change(function() {
	    if(this.checked)
		{
			$(".users1").prop("disabled",true);
			$(".users3").prop("disabled",true);
		}
		else
		{
			$(".users1").prop("disabled",false);
			$(".users3").prop("disabled",false);
		}
	});

	$(".users3").change(function() {
	    if(this.checked)
		{
			$(".users1").prop("disabled",true);
			$(".users2").prop("disabled",true);
			$(".users4").prop("disabled",true);
		}
		else
		{
			$(".users1").prop("disabled",false);
			$(".users2").prop("disabled",false);
			$(".users4").prop("disabled",false);
		}
	});

})

</script>
</head>

<body>
<?php //echo validation_errors(); ?>

<h1>EDIT USER DETAILS</h1>

<?php
$attrib=array('id'=>"editForm");
echo form_open('user_registration_supervisor/user_edit/', $attrib);
?>
<table id="table1">

<tr><td>Username</td><td>
<?php echo form_error('uName'); ?>
<input disabled="disabled" name="uName" value= "<?php echo $r[0]->username;?>" type="text" maxlength=""/>
</td></tr>

<tr><td colspan="2"><hr></td><tr>

<tr><td>First Name</td><td>
<?php echo form_error('fName'); ?>
<input name="fName" value= "<?php echo $r[0]->fname;?>" type="text" />
</td></tr>

<tr><td>Last Name</td><td>
<?php echo form_error('lName'); ?>
<input name="lName" value= "<?php echo $r[0]->lname;?>" type="text" />
</td></tr>

<tr><td>Email Address</td><td>
<?php echo form_error('email'); ?>
<input disabled="disabled" name="email" value= "<?php echo $r[0]->email;?>" type="text" />
</td></tr>

<tr><td>Telephone</td><td>
<?php echo form_error('tPhone'); ?>
<input name="tPhone" value= "<?php echo $r[0]->telephone;?>" type="text" maxlength=""/>
</td></tr>

<tr><td colspan="2"><hr></td><tr>

<tr><td>Department ID</td><td>
<select name="deptID">
		<?php echo '<option  value="0"'.($r[0]->department_id=="0"? ' selected' : '').'>Select Department</option>'; ?>
		<?php echo '<option  value="1"'.($r[0]->department_id=="1"? ' selected' : '').'>Wet Chemistry</option>'; ?>
		<?php echo '<option  value="2"'.($r[0]->department_id=="2"? ' selected' : '').'>Microbiological Analysis</option>'; ?>
		<?php echo '<option  value="3"'.($r[0]->department_id=="3"? ' selected' : '').'>Medical Devices</option>'; ?>
		<?php echo '<option  value="4"'.($r[0]->department_id=="4"? ' selected' : '').'>Documentation</option>'; ?>
		<?php echo '<option  value="5"'.($r[0]->department_id=="5"? ' selected' : '').'>Instrumentation</option>'; ?>
		<?php echo '<option  value="6"'.($r[0]->department_id=="6"? ' selected' : '').'>Finance and Administration</option>'; ?>
		<?php echo '<option  value="7"'.($r[0]->department_id=="7"? ' selected' : '').'>Procurement</option>'; ?>
		<?php echo '<option  value="8"'.($r[0]->department_id=="8"? ' selected' : '').'>Quality Assurance</option>'; ?>
		<?php echo '<option  value="9"'.($r[0]->department_id=="9"? ' selected' : '').'>Administration</option>'; ?>
</select>
</td></tr>


<tr><td>User Type</td><td>
<?php echo form_error('userType'); ?>
<input type="checkbox" name="userType[]" value="1" class= "users2" id="frozen" <?php if($r[0]->user_type== 1 || $r[0]->user_type== 6){echo'checked="checked"';} ?>>Analyst</td></tr>        
<tr><td></td><td><input type="checkbox" name="userType[]" value="5" class="users4" id="frozen" <?php echo set_checkbox('userType[]', '2'); ?>>Supervisor<td></tr>
<tr><td></td><td><input type="checkbox" name="userType[]" value="3" class= "users1" id="frozen" <?php if($r[0]->user_type== 3 || $r[0]->user_type== 7){echo'checked="checked"';}?>>Reviewer</td></tr>
<tr><td></td><td><input type="checkbox" name="userType[]" value="4" class= "users1" id= "superuser" <?php if($r[0]->user_type== 4 || $r[0]->user_type== 5){echo'checked="checked"';} ?>>Administrator</td></tr>
<tr><td></td><td><input type="checkbox" name="userType[]" value="8" class= "users3" id="frozen" <?php if($r[0]->user_type== 8 ){echo'checked="checked"';}?>/>Documentation</td></tr></td></tr>

<tr><td colspan="2"><hr></td><tr>

<tr><td>Comment</td><td>
<textarea name="comment"></textarea>
</td></tr>

<tr><td><input type = "hidden" name = "dbid" value ="<?php echo $r[0] -> id ?>" /></td></tr>

<tr><td colspan="2"><hr></td><tr>

<tr><td>Account Status</td><td><input type="radio" name="status" value="1" label="Activate" <?php if($r[0]->acc_status== 1 ){echo'checked="checked"';}?>/>Activate</td>
<tr><td></td><td><input type="radio" name="status" value="0"<?php if($r[0]->acc_status== 0 ){echo'checked="checked"';}?>/>Deactivate</td>

<tr><td align="center" colspan="2"><input type="submit" value="Update"/></td></tr>
</table>
</form>
</body>
</html>