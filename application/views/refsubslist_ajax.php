<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url()."inventory/refSublist"; ?>">Reference Substances List</a>&nbsp;|&nbsp;<span class ="link_highlight">Reference Substances Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd"; ?>">Add Reference Substance</a>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd_i"; ?>">Add Reference Substance to Inventory</a></legend>
<div>&nbsp;</div>
<script>
    $(document).ready(function(){
        
 $('#print_data').click(function(){
     $(this).hide();
    $('#selector').slideDown('slow');
    });
    $('#get_report').click(function(){
        status=$('#status_data').val();
        $.ajax({
            type:"get",
            url:"<?php echo base_url() ?>refsubs_printer/generate/"+status,
            success:function(success){
                window.location.href="<?php echo base_url(); ?>refsubs_template/"+status+"_standards.xlsx";
            },error:function(e){
                alert('An error Occurred')
                    }


                });
            })
        });
    

    </script>
    
<div id="selector" class = "hidden2" >
    <select name="status" id="status_data">
        <option value="">--Select Status--</option>
        <option value="Primary">PRS</option>
        <option value="Working">WRS</option>
        <option value="Expired">Expired</option>
    </select><br>
    <button id="get_report" class = "submit-button">Print</button>
</div>
<table id = "refsubs">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>

<div id = "confirm" class = "hidden2" >Are you sure?</div>


<script type="text/javascript">
var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
	rtable = $('#refsubs').DataTable({
		dom:'T<"clear">lfrtip',
		tableTools:{
			"sRowSelect": "multi",
			"aButtons":[
				{
					"sExtends":"text",
					"sButtonText": "Print labels of selected.",
					"fnClick": function(nButton, oConfig, oFlash) {
							var data = TableTools.fnGetInstance('refsubs');
							
							//Get data from the selected rows
							var selected_data = data.fnGetSelectedData();
							
							//Initialize array to hold refsub ids
							refsub_ids = [];

							//Loop through the selected data
							for(var i=0;i<selected_data.length;i++){

								//Push ids of selected refsubs into above initialized array
								refsub_ids.push(selected_data[i].id);
							}

							//Conver array of ids into a string
							var ids = JSON.stringify(refsub_ids);

							//Replace,remove forward slashes, quotation marks and square brackets and underscores from new string
							sanitized_ids = ids.replace(/[,]/g, "/").replace(/[\[\]""]/g, "").replace(/ /g, "_");
							
							//Remove back slashes to produce single string , to be used as unique identifier for the label.
							label_id = sanitized_ids.replace(/\//g, '');
							
							console.log(label_id);

							//Url to generate pdf
							gen_labels_url = '<?php echo base_url()."refsubs_management/printPdfLabel" ?>' + '/' + selected_data.length +  "/" + label_id + "/" + sanitized_ids
							generated_labels_url = '<?php echo base_url()."labels/refsubs" ?>' + '/' + '<?php echo "Label".date('Ymd'); ?>' + label_id + '.pdf'
							console.log(generated_labels_url);

							//Ajax function to pass ids to above gen url
							$.ajax({
								type:'POST',
								url:gen_labels_url
							}).done(function(response){
								parent.$.fancybox.open({
									href: generated_labels_url,
									type: 'iframe',
									autoSize: false,
									height: 842,
									width: 595
								})
							})
					}
				},
				{
					"sExtends":"text",
					"sButtonText":"Export to Excel",
					"fnClick":function(nButton, oConfig, oFlash){
						$.fancybox.open({
							href:'#selector'
						});
					}
				},
				{
					"sExtends":"text",
					"sButtonText":"Delete selected.",
					"fnClick":function(nButton, oConfig, oFlash){
						var data = TableTools.fnGetInstance('refsubs');
							
						//Get data from the selected rows
						var selected_data = data.fnGetSelectedData();
							
													//Initialize array to hold refsub ids
							refsub_ids = [];

							//Loop through the selected data
							for(var i=0;i<selected_data.length;i++){

								//Push ids of selected refsubs into above initialized array
								refsub_ids.push(selected_data[i].id);
							}

							//Conver array of ids into a string
							var ids = JSON.stringify(refsub_ids);

							//Replace,remove forward slashes, quotation marks and square brackets and underscores from new string
							sanitized_ids = ids.replace(/[,]/g, "/").replace(/[\[\]""]/g, "").replace(/ /g, "_");

							//Url to generate pdf
							delete_url = '<?php echo base_url()."refsubs_management/delete" ?>' + "/" + sanitized_ids

							console.log(delete_url);

							//Confirm
							console.log($('#confirm').dialog({
								resizable:false,
								modal:true,
								title: "Delete standards.",
								buttons:{
									"Yes":function(){
										$(this).dialog("close");

											//Ajax function to pass ids to above gen url
												$.ajax({
													type:'POST',
													url:delete_url
												}).done(function(response){
													noty({
														text: selected_data.length + ' standards deleted successfully.',
														type: 'success',
														timeout:true
													})
												})

											},
									"No":function(){
										$(this).dialog("close");
									}
								}

						}));

					}

				}
			]
		},		
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"Name","mData":"name"},
	{"sTitle":"Standard Type","mData":"standard_type"},
	{"sTitle":"Source","mData":"source"},
	{"sTitle":"Batch No.","mData":"batch_no"},
	{"sTitle":"NQCL No.","mData":"rs_code"},
	{"sTitle":"Date Received","mData":"date_received"},
	{"sTitle":"Effective Date","mData":"effective_date"},
	{"sTitle":"Date of Expiry","mData":"date_of_expiry",
		"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
			var date_of_expiry = $.datepicker.parseDate("yy-mm-dd", sData);
			//var today = $.datepicker.formatDate("yy-mm-dd", new Date());
			today = new Date();	
			monthBeforeExpiry = new Date();
			monthBeforeExpiry.setDate(date_of_expiry.getDate() - 30); 
				if(monthBeforeExpiry <= today ){
						$(nTd).css({"background-color":"#FF885B", "color":"white"});
					}
				if(today > date_of_expiry){
						$(nTd).css({"background-color":"#FF3C00", "color":"white"});
					}
			}
		},
	{"sTitle":"Date of Restandardisation","mData":"date_of_restandardisation"},
	{"sTitle":"Potency","mData":null,
		"mRender":function(data, type, row){
			return row.potency + " " + row.potency_unit;
		}},
	{"sTitle":"Quantity","mData":"quantity"},	
	{"sTitle":"Weight/Volume","mData":null, "mRender":function(data, type, row){
			return row.init_mass + " " + row.init_mass_unit;
	}},
	{"sTitle":"Status","mData":"status"},
	{"sTitle":"Restandardisation Status","mData":"restandardisation_status"},
	{"sTitle":"Application","mData":"application"},
	{"sTitle":"Edit","mData":"id",
		"mRender":function(data, type, full){
			return '<a class="edit" id = '+data+' >Edit</a>';
		}
	},
	{"sTitle":"Edit History","mData":"id",
		"mRender":function(data, type, row){
			if(row.edit_status == '1'){
				return '<a class="history" id = '+data+' >Show</a>';	
			}
					else{
				return 'No Edits';
			}
		}
	}
	],
    /*"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

        if(aData[6] == '1970-01-01'){ 
				$('td:eq(7)', nRow).css('background-color', 'red');
        }
        return nRow;
      },*/
	"sScrollY": "300px",
    "sScrollX": "100%",
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."inventory/crslist"?>'	
});
	}
else {
		console.log(rtable.draw(false));
	}



}


$(document).ready(function(){


	$('.edit').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."inventory/refsublist_fancybox/" ?>' + $(this).attr('id')
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:400,
			height: 500,
			'beforeClose' : function(){
				window.location = '<?php echo base_url()."inventory/refSubslist" ?>';
			}
		});
		return(false);
	})
	console.log(getData());
})


$('.history').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'Show'){
							
						   $(this).text("Hide");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('inventory/refsubs_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
						
						
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})
</script>