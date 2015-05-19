<div><legend><span class = "link_highlight" >Charges Breakdown&nbsp;&rarr;&nbsp;<?php echo $rid; ?></span></legend></div>
<head>
<script src="<?php echo base_url(); ?>bower_components/accounting/accounting.js" type="text/javascript"></script> 
</head>

<table id = "breakdown">
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
$(document).ready(function(){
	 $('#breakdown').dataTable({
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
			{"sTitle":"Test Total (Kshs.)","mData":null,
				"mRender":function(data, type, row){
					return accounting.formatMoney(parseInt(row.test_charge) + parseInt(row.method_charge), { format: "%v"}); 
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
		"sAjaxSource": '<?php echo base_url()."finance_management/breakdown/$rid"?>',
		"fnFooterCallback":function(nRow, aaData, iStart, iEnd, iDisplay){
			//Initialize variable to hold total
			var total = 0;

			//Loop through data in table while doing addition of method and tests charges
			for(var i =0; i<aaData.length; i++){
				total += parseFloat(aaData[i].method_charge) + parseFloat(aaData[i].test_charge);
			}
			//Format total as money,currency
			f_total = accounting.formatMoney(total, {symbol : "KES", format: "%s %v" });
			
			//Set total to specified selector
			$('#total').html(f_total);
		}	
	});
})	 
</script>
