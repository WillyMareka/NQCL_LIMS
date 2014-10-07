<hr>
<table id = "dispatch" class = "datatable-custom" >
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

var gtable;

$(document).ready(function(){
function getData(){
if (typeof gtable == 'undefined')
{
 gtable = $('#dispatch').dataTable({
 		/*"fnCreatedRow":function(nRow, aData, iDataIndex){
			if(aData.percentage  > 80){
				$('td',nRow).css('background-color', '#d5edcd');
			}
			else{
				$('td',nRow).css('background-color', '#fff3ee');
			}
		},*/

		"fnCreatedRow":function(nRow, aData, iDataIndex){
			$(nRow).live('hover', function(){
				//console.log($(this));
				if($('td', nRow).hasClass('highlighted')){
					$('td', nRow).removeClass('highlighted');
				}
				else{
					$('td', nRow).addClass('highlighted');
				}
			})
		},
		"aoColumnDefs": [{
                "sClass": "center light-blue",
                "aTargets": [6,7,8,9]
        },
        {		"sClass": "center bold light-orange",
        		"aTargets":[10,11,12]
        }],
		"bJQueryUI":true,
		"aoColumns": [

			{"sTitle":" ","mData":"request_id", "bSortable":false,
			"mRender":function(data, type, row){
				return '<a class="show_more" id = '+row.clientid+' >+</a>';
			},
			"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			},
			{"sTitle":"Name", "mData":null,
				"mRender":function(data, type, row){
					return row.name
				}
			},
			{"sTitle":"Type", "mData":null,
				"mRender":function(data, type, row){
					return row.client_type
				}
			},
						{"sTitle":"Email", "mData":null,
				"mRender":function(data, type, row){
					return row.email
				}
			},
			{"sTitle":"Contact Person", "mData":null,
				"mRender":function(data, type, row){
					return row.contact_person
				}
			},
			{"sTitle":"Contact Number", "mData":null,
				"mRender":function(data, type, row){
					return row.contact_phone				}
			},

			{"sTitle":"No. of Samples", "mData":"all_samples"},
			{"sTitle":"Fully Paid", "mData":"fully_paid"},
			{"sTitle":"Partially  Paid", "mData":"partially_paid"},
			{"sTitle":"Unpaid", "mData":"un_paid"},
			{"sTitle":"Total Owed (KES)", "mData":"total_owed",
				"mRender":function(data, type, row){
					return accounting.formatMoney(data, { format: "%v" });
				}
			},
			{"sTitle":"Total Paid (KES)", "mData": "total_paid",
				"mRender":function(data, type, row){
					return accounting.formatMoney(data, { format: "%v" });
				}
			},
			{"sTitle":"Balance (KES)", "mData":"total_balance",
				"mRender":function(data, type, row){
					if(data > 0){
						return accounting.formatMoney(data, { format: "%v" });
					}
					else if(data < 0){
						//Undo minus sign in negative value
						positive_data = data * -1; 
						return accounting.formatMoney(positive_data, { format: "(%v)" });
					}
				}
			},
			{"sTitle":"Payment", "mData":null,
				"mRender":function(data, type, row){
					var billTotal = row.total_balance; 
					return '<a href = "#" id = "'+row.client_id+'" data-owed = "'+row.total_owed+'" data-paid = "'+row.total_paid+'" data-total = "'+billTotal+'" data-cid = "'+row.client_id+'" data-inv = "'+row.invoice_no+'" data-cert = "'+row.cert_no+'" class = "pay" >Pay</a>&nbsp;|&nbsp;<a href = "#" id = "'+row.client_id+'" data-owed = "'+row.total_owed+'" data-paid = "'+row.total_paid+'" data-total = "'+billTotal+'" data-cid = "'+row.client_id+'" data-inv = "'+row.invoice_no+'" data-cert = "'+row.cert_no+'" class = "view" >View</a>'
				},

				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"text-align":"center"});
				}	
			},					
		],
		"sScrollY": "300px",
    	"sScrollX": "100%",
		"bStateSave":true,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"iDisplayLength":20,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/clientDispatchList"?>'	
	})
	
 }
 else {
 	gtable.fnDraw();
	 }
}

getData();

$('.show_more').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == '+'){
							
						   $(this).text("-");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//console.log(id);
						
							$.post("<?php echo site_url('finance_management/showDispatchPerClient'); ?>" + "/" + id , function(more){
								
								gtable.fnOpen(nTr, more, 'more');
							})
							
						}
						
					else{

							gtable.fnClose(nTr);
							$(this).text("+");	
							
						}
		})

$('.pay').live('click', function(e){
    e.preventDefault();
    amount_total = $(this).attr("data-total");
    total_paid = $(this).attr("data-paid");
    total_owed = $(this).attr("data-owed");
   // cid = $(this).attr("data-cid");
    cid = $(this).attr("id");
    inv_id = $(this).attr("data-inv");
    cert_id = $(this).attr("data-cert");
    inv_id_r = inv_id.replace(/\//g, '_');
    cert_id_r = cert_id.replace(/\//g, '_'); 
    inv_id_rs = inv_id_r.replace(/\ /g, '_');
    cert_id_rs = cert_id_r.replace(/\ /g, '_');
    var m_href = '<?php echo base_url()."finance_management/pay/" ?>' + cid + "/" + inv_id_rs + "/" + cert_id_rs + "/" + amount_total + "/" + total_paid + "/" + total_owed;
    console.log(inv_id_rs);
    console.log(m_href);
    $.fancybox.open({
                href:m_href,
                type: 'iframe',
                autoDimensions:false,
                width: 300,
                height: 1000   
                });     
            return true;

})


$('.credits').live('click', function(e){
    e.preventDefault();
    cid = $(this).attr("data-cid");
    var m_href = '<?php echo base_url()."finance_management/deposit_view/" ?>' + cid;
    console.log(m_href);
    $.fancybox.open({
                href:m_href,
                type: 'iframe',
                autoDimensions:false,
                width: 300,
                height: 1000   
                });     
            return true;
})


$('.view').live('click', function(e){
    e.preventDefault();
    cid = $(this).attr("data-cid");
    var m_href = '<?php echo base_url()."finance_management/showReceipt/" ?>' + cid;
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
