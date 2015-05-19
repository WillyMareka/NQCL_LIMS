<html>
<div class ="content">
		<legend><span class ="link_highlight">Column Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $column[0]['column_type'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "column_history">
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
					var ctable = $('#column_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old Serial No.","mData":"old_columns_log_serial_no"},
				{"sTitle":"New Serial No.","mData":"new_columns_log_serial_no"},
				{"sTitle":"Old Column Dimensions","mData":"old_columns_log_column_dimensions"},
				{"sTitle":"New Column Dimensions","mData":"new_columns_log_column_dimensions"},
				{"sTitle":"Old Manufacturer","mData":"old_columns_log_manufacturer"},
				{"sTitle":"New Manufacturer","mData":"new_columns_log_manufacturer"},
				{"sTitle":"Old Date Received","mData":"old_columns_log_date_received"},
				{"sTitle":"New Date Received","mData":"new_columns_log_date_received"},
				{"sTitle":"Old Issued To","mData":"old_columns_log_issued_to"},
				{"sTitle":"New Issued To","mData":"new_columns_log_issued_to"},
				{"sTitle":"Old Comment","mData":"old_columns_log_comment"},
				{"sTitle":"New Comment","mData":"new_columns_log_comment"},
				{"sTitle":"Old Status","mData":"old_columns_log_status",
					"mRender":function(data, type, row){
						if(data == '1'){
							return 'Active'	
						}
						else if (data == '0'){
							return 'Decommissioned'
						}
					}
				},
				{"sTitle":"New Status","mData":"new_columns_log_status",
					"mRender":function(data, type, row){
						if(data == '1'){
							return 'Active'	
						}
						else if (data == '0'){
							return 'Decommissioned'
						}
					}
				},
				{"sTitle":"Activity","mData":"activity"},
				{"sTitle":"Log Date","mData":"log_date"},
				{"sTitle":"Who","mData":"who"},			
				],
				"sScrollX": "100%",
				"bDeferRender":true,
				"bProcessing":true,
				"bDestroy":true,
				"bLengthChange":true,
				"iDisplayLength":16,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo base_url()."inventory/clmnlog_list/" . $cid ?>',	
			});
				}
			else {
				ctable.fnDraw();
				}
			}
		getData();	
		})	
</script>			