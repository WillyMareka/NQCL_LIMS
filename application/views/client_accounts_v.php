<div><legend><span class = "link_highlight" >Client Accounts</span></legend></div>
<hr>
<table id = "accounts">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">
var ftable;
$(document).ready(function(){
ftable = $('#accounts').dataTable({
		"bJQueryUI":true,
		"aoColumns": [

		{"sTitle":" ","mData":"id", "bSortable":false,
			"mRender":function(data, type, row){
				return '<a class="show_more" id = '+data+' data-name = '+row.Name+' >+</a>';
		},
			"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
			}
		},
		{"sTitle":"Client Name", "mData":"Name"},
		{"sTitle":"Contact Person", "mData":"Contact_person"},
		{"sTitle":"Contact Phone", "mData":"Contact_phone"},
		{"sTitle":"Credit (Kshs.)", "mData":"credit",
			"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
			}
		},
		{"sTitle":"Actions", "mData":"id",
			"mRender":function(data, type, row){
				if(row.Dispatch_register!=null){
				 if(row.Dispatch_register.balance == 0){
				 	return '<a class="add_credit" id = '+data+' title = "Credit Account" data-name = '+row.Name+' >Credit</a>&nbsp;|&nbsp;<a class="pay" id = '+data+' title = "Pay for Sample" data-name = '+row.Name+' >Pay</a>'
				 }
				
				else{
					return '<a class="add_credit" id = '+data+' title = "Credit Account" data-name = '+row.Name+' >Credit</a>&nbsp;|&nbsp;Paid'
				}
			}
			else{
				return 'N/A';
			}
		}
	}
		],
		"bScrollCollapse":true,
		"bPaginate":true,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"bLengthChange":true,
		"iDisplayLength": "25",
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/clientsAccountList"?>'	
		})

})	 


$('.show_more').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == '+'){
							
						   $(this).text("-");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('finance_management/showClientPaymentHistory'); ?>" + "/" + id , function(more){
								
								ftable.fnOpen(nTr, more, 'more');
							})
							
						}
						
					else{

							ftable.fnClose(nTr);
							
							$(this).text("+");	
							
						}
		})



$('.add_credit').live('click', function(e){
    e.preventDefault();
    clientid = $(this).attr("id");
    client_name = $(this).attr("data-name");
    var m_href = '<?php echo base_url()."finance_management/add_credit/" ?>' + clientid + "/" + client_name;
    $.fancybox.open({
                href:m_href,
                type: 'iframe',
                autoDimensions:false,
                width: 300,
                height: 1000   
                });     
            return true;

})


$('.pay').live('click', function(e){
    e.preventDefault();
    clientid = $(this).attr("id");
    client_name = $(this).attr("data-name");
    var m_href = '<?php echo base_url()."finance_management/paySample/" ?>' + clientid + "/" + client_name;
    $.fancybox.open({
                href:m_href,
                type: 'iframe',
                autoDimensions:false,
                width: 300,
                height: 1000   
                });     
            return true;

})



</script>
