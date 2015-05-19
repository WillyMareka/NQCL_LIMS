<head>
    <link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css'?>" type="text/css" rel="stylesheet"/>
</head>
<center><p style="font-weight: bolder; text-decoration: underline;">ALMOST EXPIRING STANDARDS</p></center>
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
    <script type="text/javascript">
var rtable;
function getData(){
	if (typeof rtable == 'undefined') {
		rtable = $('#refsubs').dataTable({
	/*"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
	"oTableTools": {
			"sSwfPath": "<?php echo base_url() . 'Scripts/tabletools/media/swf/copy_csv_xls_pdf.swf' ?>",
			"aButtons":[
			            {
					"sExtends": "copy",
					"mColumns": "all"
				      },
				      {
					"sExtends": "csv",                                        
					"sButtonText": "Excel",
                                        "sButtonId":"print_excel",
                                        "mColumns": "all"
					  }, 
					  {
					 "sExtends": "pdf",
					 "mColumns": [0,4,7] 
					  },
					  {
					 "sExtends": "print",
					 "mColumns": "all"
						      },		 ]
		},*/
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Name", "mData": "name"},
                    {"sTitle": "Standard Type", "mData": "standard_type"},
                    {"sTitle": "Source", "mData": "source"},
                    {"sTitle": "Batch No.", "mData": "batch_no"},
                    {"sTitle": "NQCL No.", "mData": "rs_code"},
                    {"sTitle": "Date Received", "mData": "date_received"},
                    {"sTitle": "Date of Expiry", "mData": "date_of_expiry"},                   
                    {"sTitle": "Potency", "mData": null,
                        "mRender": function(data, type, row) {
                            return row.potency + " " + row.potency_unit;
                        }},
                    {"sTitle": "Quantity", "mData": "quantity"},
                    {"sTitle": "Weight/Volume", "mData": null, "mRender": function(data, type, row) {
                            return row.init_mass + " " + row.init_mass_unit;
                        }},
                    {"sTitle": "Status", "mData": "status"},
                    {"sTitle": "Restandardisation Status", "mData": "restandardisation_status"},
                  
                    
                ],
                /*"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                 
                 if(aData[6] == '1970-01-01'){ 
                 $('td:eq(7)', nRow).css('background-color', 'red');
                 }
                 return nRow;
                 },*/
              
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 16,
                "sAjaxDataProp": "",
                "sAjaxSource": '<?php echo site_url() . "main_dashboard/getAlmostExpiry1/" ?>',
            });
        }
    }
    $(document).ready(function() {
        getData();
    });
</script>