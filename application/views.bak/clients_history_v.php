<html>
<div class ="content">
		<legend><span class ="link_highlight">Client Edit Log</span>&nbsp;&rarr;&nbsp;<?php echo $clients[0]['Name'] ?></legend>
	<div>&nbsp;</div>
<span><?php //print_r($columns); ?></span>	
<table id = "client_history">
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
				if (typeof rtable == 'undefined') {
					var rtable = $('#client_history').dataTable({
				"bFilter": false,
				"bSearchable":false,
				"bInfo":false,	
				"aoColumns": [
				{"sTitle":"Old Name","mData":"old_clients_log_name"},
				{"sTitle":"New Name","mData":"new_clients_log_name"},
				{"sTitle":"Old Address","mData":"old_clients_log_address"},
				{"sTitle":"New Address","mData":"new_clients_log_address"},
				{"sTitle":"Old Client Type","mData":"old_clients_log_client_type"},
				{"sTitle":"New Client Type","mData":"new_clients_log_client_type"},
				{"sTitle":"Old Contact Person","mData":"old_clients_log_contact_person"},
				{"sTitle":"New Contact Person","mData":"new_clients_log_contact_person"},
				{"sTitle":"Old Contact Phone","mData":"old_clients_log_contact_phone"},
				{"sTitle":"New Contact Phone","mData":"new_clients_log_contact_phone"},
				{"sTitle":"Old Comment","mData":"old_clients_log_comment"},
				{"sTitle":"New Comment","mData":"new_clients_log_comment"},
				{"sTitle":"Old Status","mData":"old_clients_log_client_status",
					"mRender":function(data, type, full){
							if(data == '1'){
								return 'Active';
							}
							else{
								return 'Inactive';
							}
					}},
				{"sTitle":"New Status","mData":"new_clients_log_client_status",
					"mRender":function(data, type, full){
							if(data == '1'){
								return 'Active';
							}
							else{
								return 'Inactive';
							}
					}},
				{"sTitle":"Action","mData":"action"},
				{"sTitle":"Log Date","mData":"log_date"},
				{"sTitle":"Who","mData":"who"},			
				],
				"sScrollY": "300px",
    			"sScrollX": "100%",
				"bDeferRender":true,
				"bProcessing":true,
				"bDestroy":true,
				"bLengthChange":true,
				"iDisplayLength":16,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo base_url()."client_management/clntslist/" . $cid ?>',	
			});
				}
			else {
				rtable.fnDraw();
				}
			}
		getData();	
		})	
</script>			