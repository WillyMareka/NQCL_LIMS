	<html>
<div class ="content">
		<legend><span class ="link_highlight">Reagents Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $reagents[0]['name'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "reagents_history">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>


<script type="text/javascript">
function getData(){
				if (typeof ctable == 'undefined') {
					var ctable = $('#reagents_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old Name","mData":"old_reagents_log_name"},
				{"sTitle":"New Name","mData":"new_reagents_log_name"},
				{"sTitle":"Old Batch No.","mData":"old_reagents_log_batch_no"},
				{"sTitle":"New Batch No.","mData":"new_reagents_log_batch_no"},
				{"sTitle":"Old Manufacturer","mData":"old_reagents_log_manufacturer"},				
				{"sTitle":"New Manufacturer","mData":"new_reagents_log_manufacturer"},								
				{"sTitle":"Old Date Received","mData":"old_reagents_log_date_received"},
				{"sTitle":"New Date Received","mData":"new_reagents_log_date_received"},
				{"sTitle":"Old Date of Expiry","mData":"old_reagents_log_date_of_expiry"},
				{"sTitle":"New Date of Expiry","mData":"new_reagents_log_date_of_expiry"},
				{"sTitle":"Old Reorder Level","mData":"old_reagents_log_reorder_level"},
				{"sTitle":"New Reorder Level","mData":"new_reagents_log_reorder_level"},
				{"sTitle":"Old Quantity","mData":"old_reagents_log_quantity"},
				{"sTitle":"New Quantity","mData":"new_reagents_log_quantity"},				
				{"sTitle":"Old Packaging","mData":null,
					"mRender":function(data, type, row){
						if(row.old_reagents_log_volume != null){
							return row.old_reagents_log_volume + " " + row.old_reagents_log_qunit + " " + row.old_reagents_log_packaging
						}
						else{
							return '';
						}
					}
				},
				{"sTitle":"New Packaging","mData":null,
					"mRender":function(data, type, row){
						return row.new_reagents_log_volume + " " + row.new_reagents_log_qunit + " " + row.new_reagents_log_packaging
					}
				},
				{"sTitle":"Old Form","mData":"old_reagents_log_form"},
				{"sTitle":"New Form","mData":"new_reagents_log_form"},
				{"sTitle":"Old Form","mData":"old_reagents_log_status"},
				{"sTitle":"New Form","mData":"new_reagents_log_status"},
				{"sTitle":"Old Comment","mData":"old_reagents_log_comment"},
				{"sTitle":"New Comment","mData":"new_reagents_log_comment"},
				{"sTitle":"Activity","mData":"action"},
				{"sTitle":"Log Date","mData":"log_date"},
				{"sTitle":"Who","mData":"who"},			
				],
        		"bScrollCollapse": true,
        		"bPaginate": false,
				"sScrollX": "100%",
				"bDeferRender":true,
				"iDisplayLength":23,
				"bProcessing":true,
				"bDestroy":true,
				"bLengthChange":true,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo base_url()."inventory/rgntlog_list/" . $rid ?>',	
			});
				}
			else {
				ctable.fnDraw();
				}
			}
		getData();	
</script>			