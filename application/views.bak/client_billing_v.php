<div><legend><span class = "link_highlight" >Charges Table</span>&nbsp;&rarr;&nbsp;<?php echo $rid; ?></legend></div>
<hr>
<table id = "charges">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
	 $('#charges').dataTable({
		"bSearchable":false,
		"bInfo":false,
		"bFilter":false,
		"aoColumns": [
			{"sTitle":"Test","mData":"tests[].Name"},
			{"sTitle":"Method","mData":"test_methods[].name",
				"mRender":function(data, type, full){
					if(data == ''){
						return 'N/A';
					}
					else{
						return data;
					}
				}
			},
			{"sTitle":"Test Charge (Kshs.) ","mData":"test_charge",
				"mRender":function(data, type, full){
					if(data == 0){
						return 'N/A';
					}
					else{
						return data;
					}
				}
			},
			{"sTitle":"Method Charge (Kshs.)","mData":"method_charge",
				"mRender":function(data, type, full){
					if(data == 0){
						return 'N/A';
					}
					else{
						return data;
					}
				}
			},
			{"sTitle":"Test Total (Kshs.)","mData":null,
				"mRender":function(data, type, row){
					return parseInt(row.test_charge) + parseInt(row.method_charge) 
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			}],
		"bScrollCollapse":true,
		"bPaginate":false,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."client_billing_management/charges_list/$rid"?>'	
	});
})	 
</script>
