<html>
<div class ="content">
		<legend><span class ="link_highlight">Equipment Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $equipment[0]['name'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "equipment_history">
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
					var ctable = $('#equipment_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old Name","mData":"old_equipment_log_name"},
				{"sTitle":"New Name","mData":"new_equipment_log_name"},
				{"sTitle":"Old Model","mData":"old_equipment_log_model"},
				{"sTitle":"New Model","mData":"new_equipment_log_model"},
				{"sTitle":"Old Serial No.","mData":"old_equipment_log_serial_no"},
				{"sTitle":"New Serial No.","mData":"new_equipment_log_serial_no"},
				{"sTitle":"Old Nqcl No.","mData":"old_equipment_log_nqcl_no"},
				{"sTitle":"New Nqcl No.","mData":"new_equipment_log_nqcl_no"},
				{"sTitle":"Old Type","mData":"old_equipment_log_type"},
				{"sTitle":"New Type","mData":"new_equipment_log_type"},
				{"sTitle":"Old Date Acquired","mData":"old_equipment_log_date_acquired"},
				{"sTitle":"New Date Acquired","mData":"new_equipment_log_date_acquired"},
				{"sTitle":"Old Date of Calibration","mData":"old_equipment_log_date_of_calibration"},
				{"sTitle":"New Date of Calibration","mData":"new_equipment_log_date_of_calibration"},
				{"sTitle":"Old Date of Next Calibration","mData":"old_equipment_log_date_of_nxtcalibration"},
				{"sTitle":"New Date of Next Calibration","mData":"new_equipment_log_date_of_nxtcalibration"},				
				{"sTitle":"Old Status","mData":"old_equipment_log_status"},
				{"sTitle":"New Status","mData":"new_equipment_log_status"},
				{"sTitle":"Old Comment","mData":"old_equipment_log_comment"},
				{"sTitle":"New Comment","mData":"new_equipment_log_comment"},
				{"sTitle":"Activity","mData":"action"},
				{"sTitle":"Log Date","mData":"log_date"},
				{"sTitle":"Who","mData":"who"},			
				],
				"sScrollY": "300px",
    			"sScrollX": "100%",
				"bScrollCollapse": true,
				"bDeferRender":true,
				"iDisplayLength":20,
				"bProcessing":true,
				"bDestroy":true,
				"bLengthChange":true,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo base_url()."inventory/qpmntlog_list/" . $eid ?>',	
			});
				}
			else {
				ctable.fnDraw();
				}
			}
		getData();	
		})	
</script>			