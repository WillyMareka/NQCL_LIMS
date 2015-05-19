	<html>
<div class ="content">
		<legend><span class ="link_highlight">refsub Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $refsub[0]['name'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "refsub_history">
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
					var ctable = $('#refsub_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old Name","mData":"old_refsub_log_name"},
				{"sTitle":"New Name","mData":"new_refsub_log_name"},
				{"sTitle":"Old Standard Type","mData":"old_refsub_log_s_type"},
				{"sTitle":"New Standard Type","mData":"new_refsub_log_s_type"},
				{"sTitle":"Old Code","mData":"old_refsub_log_code"},				
				{"sTitle":"New Code","mData":"new_refsub_log_code"},
				{"sTitle":"Old Alias","mData":"old_refsub_log_alias"},
				{"sTitle":"New Alias","mData":"new_refsub_log_alias"},
				{"sTitle":"Old Comment","mData":"old_refsub_log_comment"},
				{"sTitle":"New Comment","mData":"new_refsub_log_comment"},
				{"sTitle":"Activity","mData":"action"},
				{"sTitle":"Log Date","mData":"log_date"},
				{"sTitle":"Who","mData":"who"}			
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
				"sAjaxSource": '<?php echo base_url()."inventory/rfsblog_episode_list/" . $rid ?>',	
			});
				}
			else {
				ctable.fnDraw();
				}
			}
		getData();	
</script>			