<legend>Payments, Requests & Tracking Info&nbsp;<span class = "misc_title" >|</span>&nbsp;<span class = "misc_title" ><?php echo $name; ?></span></legend>
<hr>
<table id = "dispatch" class = "datatable-custom" >
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">

var gtable;

$(document).ready(function(){
function getData(){
if (typeof gtable == 'undefined')
{
 gtable = $('#dispatch').dataTable({
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
                "aTargets": [1,2,3,4]
        },
        {		"sClass": "center bold light-orange",
        		"aTargets":[5,6,7]
        }],
		"bJQueryUI":true,
		"aoColumns": [

			{"sTitle":" ","mData":"request_id", "bSortable":false,
			"mRender":function(data, type, row){
				return '<a class="show_more" id = '+row.client_id+' >+</a>';
			},
			"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
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
					return accounting.formatMoney(data, { format: "%v" });
				}
			},
			{"sTitle":"Payments", "mData":null,
				"mRender":function(data, type, row){
					var billTotal = row.total_balance; 
					return '<a href = "#" id = "'+row.client_id+'" data-owed = "'+row.total_owed+'" data-paid = "'+row.total_paid+'" data-total = "'+billTotal+'" data-cid = "'+row.client_id+'" data-inv = "'+row.invoice_no+'" data-cert = "'+row.cert_no+'" class = "view" >View</a>'
				},

				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"text-align":"center"});
				}	
			},				
		],
		"bStateSave":true,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"iDisplayLength":20,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."client_billing_management/paymentsPerClient/$id"?>'	
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
