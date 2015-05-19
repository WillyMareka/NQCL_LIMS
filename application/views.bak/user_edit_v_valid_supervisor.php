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
	}
	else
	{
		$(".users2").prop("disabled",false);
	}
	})
	
	$(".users2").change(function() {
    if(this.checked)
	{
		$(".users1").prop("disabled",true);
	}
	else
	{
		$(".users1").prop("disabled",false);
	}
	})
})

</script>
</head>

<body>
<?php //echo validation_errors(); ?>

<h1>EDIT USER DETAILS</h1>
<h2>Please refill the marked form fields:</h2>

<?php echo form_open('user_registration_supervisor/user_edit/');?>
<table id="table1">

<tr><td>First Name:</td><td>
<?php echo form_error('fName'); ?>
<input name="fName" value= "<?php echo set_value('fName');?>" type="text" />
</td></tr>

<tr><td>Last Name:</td><td>
<?php echo form_error('lName'); ?>
<input name="lName" value= "<?php echo set_value('lName');?>" type="text" />
</td></tr>

<tr><td>Telephone:</td><td>
<?php echo form_error('tPhone'); ?>
<input name="tPhone" value= "<?php echo set_value('tPhone');?>" type="text" maxlength=""/>
</td></tr>

<tr><td>Email Address:</td><td>
<?php echo form_error('email'); ?>
<input name="email" value= "<?php echo set_value('email');?>" type="text" />
</td></tr>

<tr><td colspan="2"><hr></td><tr>

<tr><td>Department:</td><td>
<?php echo form_error('deptID'); ?>
<select name="deptID">
		<option <?php echo set_select('deptID', '0'); ?>>Select Department</option>
        <option value="1" <?php echo set_select('deptID', '1'); ?>>Wet Chemistry</option>
        <option value="2" <?php echo set_select('deptID', '2'); ?>>Microbiological Analysis</option>
        <option value="3" <?php echo set_select('deptID', '3'); ?>>Medical Devices</option>
        <option value="4" <?php echo set_select('deptID', '4'); ?>>Documentation</option>
        <option value="5" <?php echo set_select('deptID', '5'); ?>>Instrumentation</option>
        <option value="6" <?php echo set_select('deptID', '6'); ?>>Finance and Administration</option>
        <option value="7" <?php echo set_select('deptID', '7'); ?>>Procurement</option>
        <option value="8" <?php echo set_select('deptID', '8'); ?>>Quality Assurance</option>
        <option value="9" <?php echo set_select('deptID', '8'); ?>>Administration</option>
        </select>
</td></tr>

<tr><td>User Type:</td><td>
<?php echo form_error('userType[]'); ?>
<input type="checkbox" name="userType[]" value="1" class= "users2" <?php echo set_checkbox('userType[]', '1'); ?>  >Analyst</td></tr>        
<tr><td></td><td><input type="checkbox" name="userType[]" value="5" class="users4"<?php echo set_checkbox('userType[]', '2'); ?>>Supervisor<td></tr>
<tr><td></td><td><input type="checkbox" name="userType[]" value="3" class= "users1"<?php echo set_checkbox('userType[]', '3'); ?>>Reviewer</td></tr>
<tr><td></td><td><input type="checkbox" name="userType[]" value="8" class= "users3" <?php echo set_checkbox('userType[]', '6'); ?>>Documentation</td></tr>

<tr><td colspan="2"><hr></td><tr>

<tr><td>Account Status</td><td><input type="radio" name="status" value="1" <?php echo set_radio('acc_status', '1'); ?>/>Activate</td>
<tr><td></td><td><input type="radio" name="status" value="0" <?php echo set_radio('acc_status', '0'); ?>/>Deactivate</td>


<tr><td><input type = "hidden" name = "dbid" value ="<?php echo set_value('dbid',$_POST['dbid']); ?>" /></td></tr>

<tr><td colspan="2"><hr></td><tr>

<tr><td align="center" colspan="2"><input type="submit" value="Update"/></td></tr>
</table>
</form>
</body>
</html>
