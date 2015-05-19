<head><script src="<?php echo base_url(); ?>bower_components/accounting/accounting.js" type="text/javascript"></script></head>

<table id = "sample_dispatch">
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
var ftable;
function getData(){
if (typeof ftable == 'undefined')
{
 ftable = $('#sample_dispatch').dataTable({
 		"fnCreatedRow":function(nRow, aData, iDataIndex){
			if(aData.percentage  > 80){
				$('td',nRow).css('background-color', '#d5edcd');
			}
			else{
				$('td',nRow).css('background-color', '#fff3ee');
			}
		},
		"aoColumns": [
			{"sTitle":"Date", "mData":"date"},
			{"sTitle":"Certificate Number", "mData":null,
				"mRender":function(data, type, row){
					if(row.Request[0].coa_done_status != 0){
						return '<a class = "cert" >'+row.cert_no+'</a>'
					}
					else{
						return '<span class = "gray_out" >Pending</span>'
					}
				}
			},
			{"sTitle":"Lab Reference Number","mData":"request_id", "bSortable":false,
				"mRender":function(data, type, row){
					var billTotal = row.amount; 
						return '<a href = "#" id = "'+row.request_id+'" data-total = "'+billTotal+'" data-cid = "'+row.Clients.id+'" data-inv = "'+row.invoice_no+'" data-cert = "'+row.cert_no+'" class = "tracking" >'+row.request_id+'</a>'
				},
			"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			},
			{"sTitle":"Product Name", "mData": null,
				"mRender":function(data, type, row){
					return row.Request[0].product_name
				}
			},
			{"sTitle":"Batch No.", "mData": null,
				"mRender":function(data, type, row){
					return row.Request[0].Batch_no
				}
			},
			{"sTitle":"Quoted Amount (KES)", "mData": "amount",
				"mRender":function(data, type, row){			
					return accounting.formatMoney(data, { format: "%v" });
			},

				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			},
			{"sTitle":"Discount (KES)", "mData": "discount",
				"mRender":function(data, type, row){			
					return accounting.formatMoney(data, { format: "%v" });
			},

				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			},
			{"sTitle":"Pre-payment (KES)", "mData":"amount_paid",
				"mRender":function(data, type, row){			
					return accounting.formatMoney(data, { format: "%v" });
				},

				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}			
			},
			{"sTitle":"Pro-forma Balance (KES)", "mData":"balance",
				"mRender":function(data, type, row){			
					return accounting.formatMoney(data, { format: "%v" });
				},

				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}	
			},
			{"sTitle":"Percentage of Quoted", "mData":"percentage",
				"mRender":function(data, type, row){
					return data + "%"
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold","font-style":"oblique"});
				}	
			},
			{"sTitle":"Final Invoice Amount (KES)", "mData": null,
				"mRender":function(data, type, row){
					if(row.invoiced_amount != null){
						return accounting.formatMoney(row.invoiced_amount, { format: "%v" });
					}
					else{
						return "Not Invoiced";
					}
				}	
			},
			{"sTitle":"Final Invoice Balance (KES)", "mData":null,
							"mRender":function(data, type, row){
					if(row.invoiced_amount != null){
						return accounting.formatMoney(row.invoiced_amount, { format: "%v" });
					}
					else{
						return "Not Invoiced";
					}
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}	
			},
			{"sTitle":"Proforma Number", "mData":null,
				"mRender":function(data, type, row){
					if(row.Request[0].proforma_no != null){
						return '<a class = "proforma" id = "'+row.Request[0].proforma_no+'" data-reqid = "'+row.Request[0].request_id+'" >'+row.Request[0].proforma_no+'</a>'
					}
					else{
						return 'N/A'
					}
				}
			},
			{"sTitle":"Invoice Number", "mData":null,
				"mRender":function(data, type, row){
					if(row.Request[0].invoice_status != 0){
						return '<a class = "invoice" >'+row.invoice_no+'</a>'
					}
					else{
						return '<span class = "gray_out" >Pending</span>'
					}
				}
			}
			/*{"sTitle":"Tracking", "mData":null,
				"mRender":function(data, type, row){
					var billTotal = row.amount; 
					return '<a href = "#" id = "'+row.request_id+'" data-total = "'+billTotal+'" data-cid = "'+row.Clients.id+'" data-inv = "'+row.invoice_no+'" data-cert = "'+row.cert_no+'" class = "tracking" >View</a>'
				}
			},*/					
		],
		"bInfo":false,
		"bStateSave":false,
		"bFilter":false,
		"bPaginate":false,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/dispatchListPerSample/$rid"?>'	
	})
	
 }
 else {
 	ftable.fnDraw();
	 }
}

getData();

$('.show_breakdown').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == '+'){
							
						   $(this).text("-");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//console.log(id);
						
							$.post("<?php echo site_url('finance_management/show_breakdown'); ?>" + "/" + id , function(more){
								
								ftable.fnOpen(nTr, more, 'more');
							})
							
						}
						
					else{

							ftable.fnClose(nTr);
							$(this).text("+");	
							
						}
		})

	$('.tracking').live('click', function(e){
    	e.preventDefault();
    	id = $(this).attr("id");
    	var m_href = '<?php echo base_url()."client_billing_management/sampleTracking/" ?>' + id;
   		console.log(m_href);
    $.fancybox.open({
        href:m_href,
        type: 'iframe',
        height:1000,
        scrolling:'no'  
    });     
    return true;
})

$('.proforma').live('click', function(e){
    	e.preventDefault();
    	id = $(this).attr("id");
    	reqid = $(this).attr("data-reqid");
    	var m_href = '<?php echo base_url()."proformas/" ?>'+'Proforma_'+ reqid + '.pdf';
   		console.log(m_href);
    $.fancybox.open({
        href:m_href,
        type: 'iframe',
        height:1000,
        scrolling:'no'  
    });     
    return true;
})

})
</script>
