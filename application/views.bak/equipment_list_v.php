<div class ="content">
		<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Equipment Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/equipmentadd"; ?>">Add Equipment</a></legend>
	<div>&nbsp;</div>
	
<table id = "equipment">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>	

<script type="text/javascript">

			var rtable;
			function getData(){
				if (typeof rtable == 'undefined') {
					rtable = $('#equipment').dataTable({
				"bJQueryUI": true,
				"aoColumns": [
				{"sTitle":"Name","mData":"name"},
				{"sTitle":"Model","mData":"model"},
				{"sTitle":"Serial No.","mData":"serial_no"},
				{"sTitle":"NQCL No.","mData":"nqcl_no"},
				{"sTitle":"Type","mData":"type"},
				{"sTitle":"Date Acquired","mData":"date_acquired"},
				{"sTitle":"Date of Calibration","mData":"date_of_calibration"},
				{"sTitle":"Date of Next Calibration","mData":"date_of_nxtcalibration"},
				{"sTitle":"Status","mData":"status"},
				{"sTitle":"Edit","mData":"id",
						"mRender":function(data, type, full){
							return '<a class="edit" id = '+data+' >Edit</a>';
						}
					},	
				{"sTitle":"History","mData":"id",
						"mRender":function(data, type, row){
							if(row.edit_status == '1'){
								return '<a class="history" id = '+data+' data-aname = "" >Show</a>';	
							}
							else{
								return 'No Edits';
							}
						}
					}			
				],
				"sScrollY": "300px",
    			"sScrollX": "100%",
				"bDeferRender":true,
				"bProcessing":true,
				"bDestroy":true,
				"bLengthChange":true,
				"iDisplayLength":16,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo site_url()."inventory/qpmntlist"?>',	
			});
				}
			else {
				rtable.fnDraw();
				}
			}

		$(document).ready(function(){
			$('.edit').live("click",function(e){
				e.preventDefault();
				var href = '<?php echo base_url()."inventory/equipment_fancybox/" ?>' + $(this).attr('id')
				console.log(href);
				$.fancybox.open({
					href : href,
					type: 'iframe',
					autoSize: false,
					autoDimensions : false,
					width:400,
					height: 500,
					'beforeClose' : function(){
						getData();
					}
				});
				return(false);
			})
			getData();

			$('.delete').live("click", function(){
				var column_id = $(this).attr('id');
				var name = $(this).attr('data-aname');
				$('<span>Are you sure?</span>').dialog({
					resizable: false,
					height:140,
					modal: true,
					buttons:{
						"Yes":function(){
							$.ajax({
								type: 'POST',
								url: '<?php echo base_url() . "inventory/equipment_delete/"?>' + column_id,
								dataType: "json",
								success:function(){
								},
								error:function(){
								}
							})
							$(this).dialog("close");
							getData();
						},

						"No":function(){
							$(this).dialog("close");
						}

					}
				})
			})
			getData();

			$('.history').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'Show'){
							
						   $(this).text("Hide");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('inventory/equipment_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
											
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})

		getData();			
	})

</script>
