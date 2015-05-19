<div><legend><span class = "link_highlight" >Charges Breakdown&nbsp;|&nbsp;<?php echo $rid; ?>&nbsp;|&nbsp;</span><span id = "total" ></span>&nbsp;|&nbsp;<span id = "discount" ></span>&nbsp;|&nbsp;<span id = "discounted" ></span></legend></div>
<hr>
					<table id = "breakdown">
						<thead>
							<tr></tr>
						</thead>
						<tbody>
							<tr></tr>
						</tbody>
					</table>
	<form class = "methods">
		<ul>
			<li>
				<fieldset>
					<legend>Signatory Selection</legend>
					<li>
						<label>
							<span>Signatory</span>
							<select id = "signatory_name" name = "signatory_name">
								<?php foreach($signatories as $s) { ?>
									<option value = "<?php echo $s["fname"].' '.$s["lname"]; ?>" data-title = "<?php echo $s["Users_types"][0]["User_type"][0]["name"]; ?>" ><?php echo $s["fname"].' '.$s["lname"]; ?></option>
								<?php } ?>	
							</select>
						</label>
					</li>
				</fieldset>
			</li>
			<li>
				<fieldset>
					<legend>Print</legend>
						<li>
							<label>
								<input type = "button" id = "print_invoice" class = "submit-button leftie" value = "Print" data-table = "<?php echo $table; ?>" />
							</label>
						</li>
				</fieldset>
			</li>
		</ul>
	</form>
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
		"sAjaxSource": '<?php echo base_url()."finance_management/breakdown/$rid/$table/$table2/$table3/$client_id"?>',
		"fnFooterCallback":function(nRow, aaData, iStart, iEnd, aiDisplay){
			//Initialize variable to hold total
			var total = 0;
			var table = "<?php echo $table ?>";

			//Loop through data in table while doing addition of method and tests charges
			for(var i =0; i<aaData.length; i++){
				total += parseFloat(aaData[i].method_charge) + parseFloat(aaData[i].test_charge);
			}
			//Format total as money,currency
			f_total = accounting.formatMoney(total, {symbol : "KES", format: "%s %v" });
			
			if(table == "request"){
				//Set total to specified selector
				$('#total').html(f_total);

				discount =10;

				$('#discount').html('10%');

				discounted_f = total*90/100;

				discounted = accounting.formatMoney(discounted_f, {symbol : "KES", format: "%s %v" });

				$('#discounted').html('<b>'+discounted+'</b>');
			}
			else{
				$('#total').html('<b>'+f_total+'</b>');
				$('#discount').html('0%');
				$('#discounted').html('<b>'+f_total+'</b>');
			}
		}
	});
})

$('#print_invoice').live("click", function(){

	table = $(this).attr("data-table");

	//Get Signatories
	signatory = $('#signatory_name').val();
	signatory_title = $('#signatory_name option:selected').attr("data-title");

	if(table == 'request'){
		//Url to generate pdf function
		gen_invoice_href = '<?php echo base_url()."quotation/printProforma/$rid/$table/$table2/$table3/$client_id/"; ?>' + signatory_title + "/" + signatory 
		
		//Url to show pdf function
		show_invoice_href = '<?php echo base_url()."proformas/" ?>' + "Proforma_" + '<?php echo $rid; ?>' + ".pdf"; 
	    
	}
	else if(table == 'quotations'){
		gen_invoice_href = '<?php echo base_url()."quotation/printQuotation/$rid/$table/$table2/$table3"; ?>' + signatory_title + "/" + signatory 
		show_invoice_href = '<?php echo base_url()."quotations/" ?>' + "Quotation_" + '<?php echo $rid; ?>' + ".pdf";
	}
	else if(table == "invoice"){
		gen_invoice_href = '<?php echo base_url()."quotation/printInvoice/$rid/$table/$table2/$table3"; ?>' + signatory_title + "/" + signatory 
		show_invoice_href = '<?php echo base_url()."invoices/" ?>' + "Invoice_" + '<?php echo $rid; ?>' + ".pdf";
	}
	    $.ajax({
            type:'POST',
            url:gen_invoice_href
        }).done(function(response) {
                console.log(response);
                //parent.$.fancybox.resize();
                parent.$.fancybox.open({
                    href: show_invoice_href,
                    type: 'iframe',
                    autoSize: false,
                    height: 842,
                    width: 595 
                });
            }) 
})

</script>
