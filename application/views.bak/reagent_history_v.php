	<html>
<div class ="content">
		<legend><span class ="link_highlight">Reagent Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $reagent[0]['name'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "reagent_history">
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
					var ctable = $('#reagent_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old Name","mData":"old_reagent_log_name"},
				{"sTitle":"New Name","mData":"new_reagent_log_name"},
				{"sTitle":"Old Alias","mData":"old_reagent_log_alias"},				
				{"sTitle":"New Alias","mData":"new_reagent_log_alias"},
				{"sTitle":"Old Comment","mData":"old_reagent_log_comment"},
				{"sTitle":"New Comment","mData":"new_reagent_log_comment"},
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
				"sAjaxSource": '<?php echo base_url()."inventory/rgntlog_episode_list/" . $rid ?>',	
			});
				}
			else {
				ctable.fnDraw();
				}
			}
		getData();	
</script>			