	<html>
<div class ="content">
		<legend><span class ="link_highlight">Standards Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $refsubs[0]['name'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "refsubs_history">
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
					var ctable = $('#refsubs_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old Name","mData":"old_refsubs_log_name"},
				{"sTitle":"New Name","mData":"new_refsubs_log_name"},
				{"sTitle":"Old Batch No.","mData":"old_refsubs_log_batch_no"},
				{"sTitle":"New Batch No.","mData":"new_refsubs_log_batch_no"},
				{"sTitle":"Old Source","mData":"old_refsubs_log_source"},				
				{"sTitle":"New Source","mData":"new_refsubs_log_source"},
				{"sTitle":"Old Application","mData":"old_refsubs_log_application"},				
				{"sTitle":"New Application","mData":"new_refsubs_log_application"},
				{"sTitle":"Old Date Received","mData":"old_refsubs_log_date_received"},
				{"sTitle":"New Date Received","mData":"new_refsubs_log_date_received"},		
				{"sTitle":"Old Date of Expiry","mData":"old_refsubs_log_date_of_expiry"},
				{"sTitle":"New Date of Expiry","mData":"new_refsubs_log_date_of_expiry"},
				{"sTitle":"Old Potency","mData":null,
					"mRender":function(data, type, row){
						if(row.old_refsubs_log_potency != null){
								return row.old_refsubs_log_potency + " " + row.old_refsubs_log_potency_unit
						}
						else{
							return " ";
						}
					}
				},
				{"sTitle":"New Potency","mData":null,
					"mRender":function(data, type, row){
						return row.new_refsubs_log_potency + " " + row.new_refsubs_log_potency_unit
					}
				},
				{"sTitle":"Old Quantity","mData":"old_refsubs_log_quantity"},
				{"sTitle":"New Quantity","mData":"new_refsubs_log_quantity"},				
				{"sTitle":"Old Weight/Volume","mData":null,
					"mRender":function(data, type, row){
							if(row.old_refsubs_log_init_mass != null){
								return row.old_refsubs_log_init_mass + " " + row.old_refsubs_log_init_mass_unit
							}
							else{
								return " ";
							}
					}
				},
				{"sTitle":"New Weight/Volume","mData":null,
					"mRender":function(data, type, row){
						return row.new_refsubs_log_init_mass + " " + row.new_refsubs_log_init_mass_unit
					}
				},
				{"sTitle":"Old Status","mData":"old_refsubs_log_status"},
				{"sTitle":"New Status","mData":"new_refsubs_log_status"},
				{"sTitle":"Old Comment","mData":"old_refsubs_log_comment"},
				{"sTitle":"New Comment","mData":"new_refsubs_log_comment"},
				{"sTitle":"Activity","mData":"activity"},
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
				"sAjaxSource": '<?php echo base_url()."inventory/rfsbslog_list/" . $rid ?>',	
			});
				}
			else {
				ctable.fnDraw();
				}
			}
		getData();	
</script>			