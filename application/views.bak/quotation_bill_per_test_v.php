<div><legend><span class = "link_highlight" >Charges Breakdown&nbsp;|&nbsp;<?php echo $rid; ?>&nbsp;|&nbsp;</span><span id = "total" ></span></legend></div>
<hr>
<table id = "breakdown">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">

$(document).ready(function(){
	 $('#breakdown').dataTable({
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
			{"sTitle":"Test Charge (KES) ","mData":"test_charge",
				"mRender":function(data, type, full){
					if(data == 0){
						return 'N/A';
					}
					else{
						return accounting.formatMoney(data, { format: "%v" });
					}
				}
			},
			{"sTitle":"Method Charge (KES)","mData":"method_charge",
				"mRender":function(data, type, full){
					if(data == 0){
						return 'N/A';
					}
					else{
						return accounting.formatMoney(data, { format: "%v" });
					}
				}
			},
			{"sTitle":"Test Total (KES)","mData":null,
				"mRender":function(data, type, row){
					return accounting.formatMoney(parseInt(row.test_charge) + parseInt(row.method_charge), { format: "%v"}); 
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			}],
		"bJQueryUI":true,
		"bScrollCollapse":true,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."quotation/breakdown/$rid"?>',
		"fnFooterCallback":function(nRow, aaData, iStart, iEnd, aiDisplay){
			//Initialize variable to hold total
			var total = 0;

			//Loop through data in table while doing addition of method and tests charges
			for(var i =0; i<aaData.length; i++){
				total += parseFloat(aaData[i].method_charge) + parseFloat(aaData[i].test_charge);
			}
			//Format total as money,currency
			f_total = accounting.formatMoney(total, {symbol : "KES", format: "%s %v" });
			
			//Set total to specified selector
			$('#total').html('<b>'+f_total+'</b>');
		}
	});
})	 
</script>
