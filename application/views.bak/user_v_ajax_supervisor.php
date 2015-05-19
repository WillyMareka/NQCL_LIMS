<div class ="content">
<p><a id ="gohome" href = "<?php echo base_url()."request_management" ?>" ><b>Home</b></a>&nbsp;&larr;&nbsp;<a id ="adduser" data-usertype = "<?php echo $user_type ?>"><b>Add New User</b></a></p>
<table id = "users">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>

</div>

<div id = "deactivation_dialog" class = "hidden2" >
	<span id = "confirm_message">Deactivate&nbsp;<span id = "user" ></span></span>
</div>

<script type="text/javascript">

var rtable;

function getData(){
	if (typeof rtable == 'undefined') {
		rtable = $('#users').dataTable({
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"First Name","mData":null,
		"mRender":function(data, type, row){
			return row.title + " " + row.fname
		}
	},
	{"sTitle":"Surname","mData":"lname"},
	{"sTitle":"Other Names","mData":"other_names"},
	{"sTitle":"User Name","mData":"username"},
	{"sTitle":"Email", "mData":"email"},
	{"sTitle":"Telephone","mData":"telephone"},
	{"sTitle":"Department","mData":null,
		"mRender":function(data, type, row){
			if(row.Departments != null){
				return row.Departments.Name
			}
			else{
				return 'Dept not set'
			}
		}
	},
	{"sTitle":"User Type","mData":null,
		"mRender":function(data, type, row){
			if(row.Users_types != null){
				var typesLength = row.Users_types.length;
				var types = new Array();
					if(typesLength > 1){
						for(i=0;i<typesLength;i++){
							types.push(row.Users_types[i].User_type[0].name);
					}
					return types;
				}
					else{
						return row.Users_types[0].User_type[0].name;
					}	
			}
			else{
				return 'User type not set'
			}
			
		}
	},
	{"sTitle":"Status","mData":"acc_status",
		"mRender":function(data, type, full){
			if(data == '0'){
				return 'Deactivated'
			}
			else if(data == '1'){
				return 'Activated'
			}
		}
	},
	{"sTitle":"Edit", "mData":null,
	"mRender":function(data, type, row){
		return '<a class = "edit" id = "'+row.id+'" >Edit</a>';
		}},
		{"sTitle":"","mData":"id", 
	"mRender":function(data, type, row){
			return '<a class="reset_password" href="<?php echo site_url()."user_registration/user_password_reset/"?>'+row.email+'" id = '+row.email+' >Reset Password</a>';
		} },	
	{"sTitle":"Edit History","mData":null,
		"mRender":function(data, type, row){
			if(row.edit_status == '1'){
				return '<a class="history" id = '+row.id+' >Show</a>';
			}
			else{
				return 'No Edits';
			}
		}
	},
	{"sTitle":"Deactivate", "mData":null,
		"fnCreatedCell":function(nTd, sData, oData, iRow, iCol) {
			if(oData.acc_status == "1"){
				$(nTd).html('<button class = "deactivate action_button2" id = '+oData.id+' data-fname = '+oData.fname+' data-lname = '+oData.lname+' >Deactivate</button>');
			}
			else{
				$(nTd).html('<button class = "action_button3" >Deactivated</span>');
			}
		}
	}
	],
	"sScrollY": "300px",
    "sScrollX": "100%",
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."user_registration_supervisor/requests_list"?>',	
});
	}
else {
	rtable.fnDraw();
	}
}

$(document).ready(function(){
	$('.edit').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."user_registration/users_edit/" ?>' + $(this).attr('id')
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			enableEscapeButton: true,
			width:400,
			height: 500,
			'beforeClose' : function(){
				getData();
			},
			'afterClose':function () {
        		window.location.reload();
   			}
		});
		return(false);
	})
	getData();

		$('.history').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'Show'){
							
						   $(this).text("Hide");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('user_registration_supervisor/users_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
						
						
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})



})

$(".reset_password").live("click",function(event){
   event.stopPropagation();
   if(confirm("Reset User Password?")) {
    this.click;
	user_id=$(this).attr('id');
	
	$.ajax({
		type:"POST",
		url:"<?php echo base_url()."user_registration/user_password_reset/"?>"+user_id,
		success:function(message){
			message='Password Reset Successfully';
			alert(message);
			window.location.href = '<?php echo base_url()."user_registration_supervisor/" ?>';
		},
		error:function(message){
			alert('An error occured');
		}
		
		
		})
      // window.location = $(this).attr('href');
	//  
   }       
   event.preventDefault();
})



$(".deactivate").live("click",function(e){
   e.preventDefault();
   var user_name = $(this).attr("data-fname") + " " + $(this).attr("data-lname");
   var user_id = $(this).attr("id");
   var save_href = "<?php echo base_url()."user_registration/deactivate_user/"?>"+user_id
   //var dialog_content = ;
   var dialog = ($('#deactivation_dialog').html("Deactivate <b>" + user_name + "</b>?")); 
               $(dialog).dialog({
                resizable: false,
                modal: true,
                //title: "Confirm User Deactivation",
                buttons: {
                    "Yes": function() {
                        $(this).dialog("close");
                        	$.ajax({
								type:"POST",
								url:save_href,
								success:function(message){
									message='User Deactivated';
									//$()

									window.location.href = '<?php echo base_url()."user_registration_supervisor/" ?>';
								},
								error:function(message){
									alert('An error occured');
								}

		})
                    },
                    "No": function() {
                        $(this).dialog("close");
                    }
                }
            });
})






$('#adduser').live("click", function(e){
	e.preventDefault();
	var usertype = $(this).attr("data-usertype");
	console.log(usertype);
	var href = '<?php echo base_url()."user_registration/users_fancybox/" ?>' + usertype
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:400,
			height: 500,
			afterClose : function(){
				parent.location.reload(true);
			}
		});
		return(false)
})

</script>
</script>