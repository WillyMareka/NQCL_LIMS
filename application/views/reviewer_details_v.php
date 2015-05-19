<?php echo $reqid; ?>
<div id = "reviewer_details">
	<table id = "reviewer_details_table">
		<thead>
			<tr>
			</tr>
		</thead>
		<tbody>
			<tr>
			</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var rtable;
	function getData(){
		if(typeof rtable == 'undefined'){
			rtable = $('#reviewer_details_table').DataTable({
				"aoColumns":[
					{"sTitle":"Reviewer", "mData": null,
						"mRender":function(data, type, row){
							return row.fname + " " + row.lname;
						}
					},
					{"sTitle": "Time Issued", "mData": null,
						"mRender":function(data, type, row){
							return row.time_done;
						}
					}
					],
					"bJQueryUI":true,
					"sAjaxDataProp": "",
					"sAjaxSource":'<?php echo base_url()."assign/getReviewerDetails/".$reqid; ?>'
				})
			}
		}
	getData();
</script>