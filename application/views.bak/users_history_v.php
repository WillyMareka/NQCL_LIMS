<html>
<div class ="content">
		<legend><span class ="link_highlight">Users Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $user[0]['fname'] . " " . $user[0]['lname'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "user_history">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>


<script type="text/javascript">
$(function(){
function getData(){
				if (typeof ctable == 'undefined') {
					var ctable = $('#user_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old First Name.","mData":"old_user_log_fname"},
				{"sTitle":"New First Name.","mData":"new_user_log_fname"},
				{"sTitle":"Old Last Name.","mData":"old_user_log_lname"},
				{"sTitle":"New Last Name.","mData":"new_user_log_lname"},
				{"sTitle":"Old Email","mData":"old_user_log_email"},
				{"sTitle":"New Email","mData":"new_user_log_email"},
				{"sTitle":"Old Telephone","mData":"old_user_log_telephone"},
				{"sTitle":"New Telephone","mData":"new_user_log_telephone"},
				{"sTitle":"Old Department Id","mData":"old_user_log_department_id"},
				{"sTitle":"New Department Id","mData":"new_user_log_department_id"},
				{"sTitle":"Old Account Status","mData":"old_user_log_acc_status"},
				{"sTitle":"New Account Status","mData":"new_user_log_acc_status"},
				{"sTitle":"Old Comment","mData":"old_user_log_comment"},
				{"sTitle":"New Comment","mData":"new_user_log_comment"},
				{"sTitle":"Log Date","mData":"log_date"},
				{"sTitle":"Activity","mData":"activity"},	
				{"sTitle":"Who","mData":"who"},	
				],
				"bDeferRender":true,
				"bProcessing":true,
				"bDestroy":true,
				"bLengthChange":true,
				"iDisplayLength":16,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo base_url()."user_registration_supervisor/usrlog_list/" . $uid ?>',	
			});
				}
			else {
				ctable.fnDraw();
				}
			}
		getData();	
		})	
</script>			