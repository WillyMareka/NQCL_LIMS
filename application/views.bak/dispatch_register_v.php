<hr>
<table id = "dispatch">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>

<script type="text/javascript">

$(document).ready(function(){
var ftable;
function getData(){
if (typeof ftable == 'undefined')
{
 ftable = $('#dispatch').dataTable({
 		/*"fnCreatedRow":function(nRow, aData, iDataIndex){
			if(aData.percentage  > 80){
				$('td',nRow).css('background-color', '#d5edcd');
			}
			else{
				$('td',nRow).css('background-color', '#fff3ee');
			}
		},*/
		"bJQueryUI":true,
		"aoColumns": [
			{"sTitle":" ","mData":"request_id", "bSortable":false,
			"mRender":function(data, type, row){
				return '<a class="show_more" id = '+data+' >+</a>';
			},
			"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			},
			{"sTitle":"Date", "mData":"date"},
			{"sTitle":"Certificate No.", "mData":"cert_no"},

			{"sTitle":"Lab Reference No.", "mData":"request_id"},
			{"sTitle":"Product Name", "mData": null,
				"mRender":function(data, type, row){
					return row.Request[0].product_name
				}
			},
			{"sTitle":"Client", "mData":null,
				"mRender":function(data, type, row){
					return row.Clients.Name
				}
			},
			{"sTitle":"Invoice No.", "mData":"invoice_no"},
			{"sTitle":"Final Invoice Amount (KES)", "mData": null,
				"mRender":function(data, type, row){
					if(row.invoiced_amount != null){
						return accounting.formatMoney(row.invoiced_amount, {format: "%v"});
					}
					else{
						return "Not Invoiced";
					}
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}	
			},
			{"sTitle":"Collection", "mData":null,
				"mRender":function(data, type, row){
					//condition to determine action of the anchor
					if(row.Request[0].coa_collection_status == 0){ action = "Add" } else { action = "View" }
					if(row.Coa_number != null){
						coa_no = row.Coa_number[0].full_number
					}
					else{
						coa_no = 0;
					}		
					//return anchor
					return '<a class = "collect" data-coa_no = "'+coa_no+'" data-reqid = "'+row.request_id+'" >'+action+'</a>';
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
		"sAjaxSource": '<?php echo base_url()."finance_management/dispatchList"?>'	
	})
	
 }
 else {
 	ftable.fnDraw();
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
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('finance_management/show_more_dispatch'); ?>" + "/" + id , function(more){
								
								ftable.fnOpen(nTr, more, 'more');
							})
							
						}
						
					else{

							ftable.fnClose(nTr);
							
							$(this).text("+");	
							
						}
		})


$('.pay').live('click', function(e){
    e.preventDefault();
    amount_total = $(this).attr("data-total");
    cid = $(this).attr("data-cid");
    labref = $(this).attr("id");
    inv_id = $(this).attr("data-inv");
    cert_id = $(this).attr("data-cert");
    inv_id_r = inv_id.replace(/\//g, '_');
    cert_id_r = cert_id.replace(/\//g, '_'); 
    inv_id_rs = inv_id_r.replace(/\ /g, '_');
    cert_id_rs = cert_id_r.replace(/\ /g, '_');
    var m_href = '<?php echo base_url()."finance_management/pay/" ?>' + labref + "/" + inv_id_rs + "/" + cert_id_rs + "/" + cid + "/" + amount_total;
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




$('.collect').live('click', function(e){
    e.preventDefault();
    action = $(this).text();
    id = $(this).attr("data-reqid");
    coa_no = $(this).attr("data-coa_no");
    var m_href = '<?php echo base_url()."finance_management/coaCollection" ?>' +action+"/"+id+"/"+coa_no;
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


})	


</script>
