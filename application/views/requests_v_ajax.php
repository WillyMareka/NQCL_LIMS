        <script src="<?php echo base_url() . 'javascripts/jquery.editable.select.min.js' ?>" type="text/javascript"></script>

<style type="text/css">
.tg,.tig, .tk  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg ,.tig,td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg ,.tig,th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg, .tig,.tg-ugh9{background-color:#C2FFD6}
.tk,.tig, td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tk,.tig, th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tk ,.tig,.tg-ugh9{background-color:#C2FFD6}
.other{
    display: none;
}
</style>
<div id="sample_update_1" style="display: none;">
  <form id="request_update">
<table class="tg" id="table_update" style="width:1000px; ">
  
     <tr>
         <td colspan="5"><center><strong>Sample Number: <select name="sample_req" id="sample_req" > 
                     <?php foreach ($request as $req):?>
                       <option value="<?php echo $req->request_id;?>" ><?php echo $req->request_id;?></option>
                       <?php endforeach;?>
             </select></center></td>
    </tr>
    <tr>
        <th class="tg-031e">Activity / CAN </th>
        <th class="tg-031e">By</th>
        <th class="tg-031e">Date Issued </th>
        <th class="tg-031e">Date Returned / COA Drafted & Approved/ CAN No. </th>
        <th class="tg-031e"><a href="#add" id="add_row"> +Add Row</a> </th>
    </tr>
   
    <tbody>
        <tr><td colspan="3"></td><td></td><td colspan="3"></td></tr>
    </tbody>
</table>
      <div id="table_sample_details">
 
      </div>
      
</form>
</div>

<div id="data_response" style="display: none;">
    <table class="tg tj" >
        <tr><td colspan="5"><center><strong><em><br><span id="labr"></span>ACTIVITY LOG</em></strong></center></td></tr>
      <tr><td colspan="5" style="font-weight: bold; color: red;">NB: The table below holds information of old samples</td></tr>

    <tr>
      <tr>
        <th class="tg-031e">Activity</th>
        <th class="tg-031e">By</th>
        <th class="tg-031e">Date Issued </th>
        <th class="tg-031e">Date Returned<br> / COA Drafted & Approved </th>
    </tr>
  
  <tbody>
              <tr><td colspan="4"></td></tr>

  </tbody>
</table>
    
        <table class="tk" >
        
        <tr><td colspan="4" style="font-weight: bold; color: red;">NB: The table below holds information of this sample's personnel signatures </td></tr>

        <tr>
      <tr>
        <th class="tg-031e">Designation</th>
        <th class="tg-031e">Designator</th>
<!--        <th class="tg-031e">Date Issued </th>-->
        <th class="tg-031e">Date Signed </th>
    </tr>
  
  <tbody>
              <tr><td colspan="3"></td></tr>

  </tbody>
</table>
</div>
</div>
<div class ="content">
<div id = "nav_left_container">
	<ul id = "nav_ul_left" >
		<li class = "first">
			<span><legend><a href = "<?php echo base_url().'request_management/add' ?>" >Add New</a></legend></span>
		</li>
		<li class = "role" >
			<legend><a id ="gen_label" href = "<?php echo base_url().'request_management/add' ?>" >Generate Label</a></legend>
		</li>
		<li class = "role">
			<legend><a id ="gen_quotation">Generate Quotation</a></legend>
		</li>	
                <li class = "role">
			<legend><a id ="gen_req_data">Generate Request Report</a></legend>
		</li>
	</ul>
</div>
<table id = "requests">
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
<div class = "hidden2" id = "fancybox_label" ></div>

<script type="text/javascript">

unit = '<?php echo $this -> session -> userdata('user_unit') ?>';

  $loadpeople= function(){
         $.ajax({
           type: 'post',
           url:'<?php echo site_url('request_management/loadpeople/')?>',
           dataType:'json',
           success: function(data){
               by = $('.by');
               $.each(data, function(i, people){
                names = people.title + " " +people.fname+ " " +people.lname;
                opt = '<option value="'+names+'">'+names+'</option>';
                by.append(opt);
            });
           }, error: function(){
               
           }
       }); 
  }
  
                   $pick_date = function() {
$( ".date" ).datepicker({
     changeMonth: true,
changeYear: true,
dateFormat: 'yy-mm-dd'
});
}
function getData(){
      db_data =''; 
	if (typeof rtable == 'undefined') {
		var rtable = $('#requests').DataTable({
		/*"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.split_status == "1" && aData.assign_status == "2"){
				$('td',nRow).css('background-color', '#f8b88e');
			}
			else if(aData.split_status == "1" && aData.assign_status == "0"){
				$('td',nRow).css('background-color', '#f9ddca');	
			}
			console.log(aData.assign_status);
		},*/
		
		//If Sample is already assigned, colour code entry a light green.
		"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(aData.assign_status == "1" ){
				$('td',nRow).css('background-color', '#d5edcd');
			}
		},
		"fnCreatedRow":function(nRow, aData, iDataIndex) {
			if(unit != '5'){
				$('td a', nRow).not('.more_info, .s_u, .s_ue,.s_uee,.a_detail').replaceWith('<span>N/A</span>');
			}
		},	
	"dom": 'C<"clear">lfrtip',		
	"bJQueryUI": true,
	"scrollX": true,
	"aoColumns": [
	{"sTitle":"Reference Number","mData":"request_id"
        ,"mRender":function(data, type, row){
			//if(row.assign_status == "0" && row.quotation_status == "0"){
				return '<a class="a_detail" href = "#'+row.request_id+'" id = '+row.request_id+' >'+row.request_id+'</a>';
			/*}
			else{
				return 'N/A';
			}*/
		}},
	{"sTitle":"Product Name","mData":"product_name"},
	{"sTitle":"Active Ingredient","mData":"active_ing"},
	{"sTitle":"Batch No.","mData":"Batch_no"},
	{"sTitle":"Client Ref No.","mData":"clientsampleref"},
	{"sTitle":"Client", "sClass":"client","mData":"Clients.Name"},
	{"sTitle":"Manufacturer","mData":"Manufacturer_Name"},
	{"sTitle":"Date of Manufacture","mData":"Manufacture_date"},
	{"sTitle":"Date of Expiry","mData":"exp_date"},
	{"sTitle":"Date Received","mData":"Designation_date"},
	{"sTitle":"UpdateSample Details","mData":null, 
            	"fnCreatedRow":function(nRow, aData, iDataIndex) {
                 
//                        $.ajax({
//        type:"get",
//        url: "<?php echo base_url(); ?>request_management/check_su_stat/",
//        dataType: "json",
//        success:function(d){
//            alert(
//          $.each(d, function(i, row){
//            if(row.labref == aData[0]){
//                 $(nRow).css("background","yellow");	
//            }else{
//                 $(nRow).css("background","green");	
//            }
//          })
//     
//    },error:function(){
//    }
//    });
                    
		   				
			},
		"mRender":function(data, type, row){
			//if(row.assign_status == "0" && row.quotation_status == "0"){
				//<a class="s_u" href = "#sample_update" id='+row.request_id+' >+Add </a> || 
				return '<a class="s_ue" href = "#Edit_log" id='+row.request_id+' >+Add</a> || <a class="s_uee" href = "#Edit_log_1" id='+row.request_id+' >Edit</a>';
                                
			/*}
			else{
				return 'N/A';
			}*/
		}
	},
        
	{"sTitle":"Assign Status","mData":"assign_status",
		"bVisible":false,
		"mRender":function(data,type,row){
			if(data == "0"){
				return 'Unassigned';
			}
			else if(data == "1"){
				return 'Fully Assigned';
			}
			else if(data == "2"){
				return 'Partially Assigned'
			}
		},
	},
	{"sTitle":"Quantity","mData":null,
	     "mRender":function(data, type, row){
	     	if(row.Packaging != null){
	     		return row.sample_qty + " " + row.Packaging.name;
	     	}
	     	else{
	     		return " ";
	     	}
	     }
	 },
    {"sTitle":"Quote","mData":null,
     "mRender":function(data, type, row){
	     	if(row.quotation_status == '0'){
	     		if(row.component_status == '0' ){
	     			return '<a class="quote" id = '+row.request_id+' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = '+row.client_id+' >Quote</a>';
	     		}
	     		else{
	     			if(row.coa_done_status  == '0'){
	     				return '<a class="set_components" id = '+row.request_id+' >Quote</a>';
	     			}
	     		}
	     			
	     	}
	     	else{
	     		return '<a class="quoted" id = '+row.request_id+' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = '+row.client_id+' >View</a>';
	     	}
	     }

    	 

 	},
	{"sTitle":"Edit","mData":"id",

		"mRender":function(data, type, row){
			if(row.assign_status == "0" && row.quotation_status == "0"){
				return '<a class="edit" href = "<?php echo base_url()."request_management/edit/" ?>'+row.request_id+'" id = '+row.request_id+' >Edit</a>';
			}
			else{
				return 'N/A';
			}
		}
	},

	{"sTitle":"More Info","mData":"id",
		"mRender":function(data, type, row){
			return '<a class="more_info" href = "<?php echo base_url()."request_management/more_info/" ?>'+row.request_id+'" id = '+row.request_id+' >More Info</a>';
		}
	},
            	{"sTitle":"Compliance","mData":"compliance"},
	


	{"sTitle":"Print Label","mData":"id",
		"mRender":function(data, type, row){
			if(row.label_status == "0"){	
				return '<a class = "labels" id = '+data+' data-labelstatus = '+row.label_status+' data-printsno = '+row.sample_qty+' data-reqid ='+row.request_id+' >Print</a>';
			}
			else{
				return '<a class = "labels" id = '+data+' data-labelstatus = '+row.label_status+' data-printsno = '+row.sample_qty+' data-reqid ='+row.request_id+' >View</a>';
			}
		}
	},
	{"sTitle":"Assign","mData":"id",
		"mRender":function(data, type, row){
			if(row.coa_done_status != 1){
				return '<a class = "assign" id = '+data+' data-reqid ='+row.request_id+' data-client = '+row.client_id+' >Assign</a>';
			}
			else{
				return 'N/A';
			}
		}
	},
	{"sTitle":"Invoice","mData":"id",
		"mRender":function(data, type, row){
			if(row.invoice_status != 1){
				return '<a class = "invoice" id = '+data+' data-reqid ='+row.request_id+' data-client = '+row.client_id+' data-table1 = "invoice" data-table2 = "tests" data-table3 = "request_details" >Show</a>';		
			}
			else{
				return '<span class = "gray_out" >Pending</span>';
			}
		}
	},
	],
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"bStateSave":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."request_management/requests_list"?>',		
		});
	}
else {
	rtable.fnDraw();
	}

	//colvis initialization
	var colvis = new $.fn.dataTable.ColVis(rtable);
	$( colvis.button() ).insertAfter('div.info');



}

$(document).ready(function(){
$(document).on('click','.a_detail',function(){
	console.log($(this).attr('class'));
    id= $(this).attr('id');
    $('#labr,#labr1').text(id + " " );
    $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>request_management/get_sample_personnel/"+id,
        dataType: "json",
        success:function(data_response){
            
             $tbody= $('.tj > tbody tr:last');
     
             $(".tj tbody tr.ai").remove();
    
            $.each(data_response,function(the, data){
              
  row = '<tr class="ai">\n\
    <td class="tg-ugh9">'+data.activity+'</td>\n\
    <td class="tg-ugh9">'+data.by+'</td>\n\
    <td class="tg-ugh9">'+data.date_issued+'</td>\n\
    <td class="tg-ugh9">'+data.date_returned+'</td>\n\
</tr>'; 
    
    $('.tj > tbody tr:last').before(row);
    
  
            });
            
                $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>request_management/get_sample_signatories/"+id,
        dataType: "json",
        success:function(data_response){
            
             $tbody= $('.tk > tbody tr:last');
     
             $(".tk tbody tr.saved").remove();
    
            $.each(data_response,function(the, data){
              
  row = '<tr class="saved">\n\
    <td class="tg-ugh9">'+data.designation+'</td>\n\
    <td class="tg-ugh9">'+data.signature_name+'</td>\n\
    <td class="tg-ugh9">'+data.date_signed+'</td>\n\\n\
</tr>'; 
    
    $('.tk > tbody tr:last').before(row);
    
  
            });
            
         
        },error:function(){
            alert('An error occured while loading the information, Try again later');
        }
    });          
            
            
            $.fancybox({
                href:"#data_response"
            });
        },error:function(){
            alert('An error occured while loading the information, Try again later');
        }
    });
});

//$('#save_su').hide();
$('#add_row').click(function(){
    $('save_su').show();
    $tbody= $('.tg > tbody tr:last');
  row = '<tr class="saved">\n\
    <td class="tg-ugh9">\n\
<select name="activity[]" class="activity">\n\
<option  value="">-- Select Activity --</option>\n\
<option  value="Analysis">Analysis</option>\n\
<option  value="Supervision">Supervision</option>\n\
<option  value="Review">Review</option>\n\
<option  value="Draft COA">Draft COA</option>\n\
<option  value="Draft COA Review">Draft COA Review</option>\n\
<option  value="COA Approval">COA Approval</option>\n\
<option  value="CAN No.">CAN No.</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<select name="by[]" class="by">\n\
<option  value="">-- Select By --</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<input type="text" class="date di" name="datei[]"/>\n\
</td>\n\
\n\<td class="tg-ugh9">\n\
<input type="text" class="date dr" name="dater[]"/>\n\
</td>\n\
\n\
<td><a href="#remove_row" id="remove_row"> -Remove</a></td>\n\
</tr>'; 
    
    $('.tg > tbody tr:last').before(row);
     $loadpeople();
     $pick_date();
     
    return false;
  
    });
	
	
	
	    $(document).on('click','.s_uee',function(){
                 $(".compliance").editableSelect();
        $.fancybox({
                href:"#sample_update_1",
				modal:true,
				closeBtn: 'true',
            });
     
    $('save_su').show();
      id =$(this).attr('id');
  
            $('#sample_req').val(id);
                  $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>request_management/get_sample_signatories_1/"+id,
        dataType: "json",
        success:function(data_response){
            
             
     
           $(".tg tbody tr.saved").remove();
    
            $.each(data_response,function(the, data){             

  row = '<tr class="saved">\n\
    <td class="tg-ugh9">\n\
<select name="activity[]" class="activity" selected="selected">\n\
<option  value="'+data.activity+'">'+data.activity+'</option>\n\
<option  value="Analysis">Analysis</option>\n\
<option  value="Supervision">Supervision</option>\n\
<option  value="Review">Review</option>\n\
<option  value="Draft COA">Draft COA</option>\n\
<option  value="Draft COA Approval">Draft COA Approval</option>\n\
<option  value="COA Approval">COA Approval</option>\n\
<option  value="CAN No.">CAN No.</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<select name="by[]" class="by" selected="selected">\n\
<option  value="'+data.by+'">'+data.by+'</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<input type="text" class="date di" value="'+data.date_issued+'" name="datei[]"/>\n\
</td>\n\
\n\<td class="tg-ugh9">\n\
<input type="text" class="date dr" value="'+data.date_returned+'" name="dater[]"/>\n\
</td>\n\
\n\
<td><a href="#remove_row" id="remove_row"> -Remove</a></td>\n\
</tr>'; 
    
    
 $('.tg > tbody tr:last').before(row);  
    
    
            });
         
      rowdata = new Array();
	  //load_tests_done/
            $.getJSON("<?php echo base_url(); ?>request_management/load_tests_done/"+id,function(data){
                 $('.tig > tbody tr:nth-last-child(2)').empty();
              $.each(data, function(i, row){
				  //row.test
              rowdata.push('<tr>\n\
                           <td>'+row.test+'<input type="hidden" name="tests[]" class="tests" value="'+row.test+'"/></td>\n\
                          <td>\n\
                          <select name="compliance[]" class="compliance" >\n\
                          <option value="'+row.compliance+'">'+row.compliance+'</option>\n\
						  <option value=""></option>\n\
                          <option value="COMPLIES">COMPLIES</option>\n\
                          <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                          <option value="Other">Other</option>\n\
                          </select>                          <textarea  cols="100" class="other"></textarea>\n\
</td>\n\
                          </tr>');
                         
             
             });
             rowdata.push('<tr><td>Compliance</td><td></td></tr>');
             rowdata.push('<tr><td colspan="2"><textarea name="reason_of_nonc" cols="100" id="conc"></textarea></td></tr>');
             rowdata.push('<tr><td colspan="2"><input type="button" id="save_su" value="Submit" class="submit-button" /> <input type="button" id="cancel" value="Cancel" class="submit-button" /></td><td></td></tr>');
           $('#table_sample_details').html('<table class="tig" id="table_update_12" style="width:1000px; "> <tr> <th class="tg-031e">Test Name </th> <th class="tg-031e">Compliance</th>  </tr> <tbody>'+rowdata+'</tbody> </table>');
            });
            
                  $.getJSON("<?php echo base_url(); ?>request_management/load_tests_reason/"+id,function(data){
                      
                 $('#conc').val(data[0].reason);
              
            });
            
           
       $loadpeople();
     $pick_date();
     
       
  
            
         
        },error:function(){
            alert('An error occured while loading the information, Try again later');
        }
    }); 
 
            
           
    });
          
            $(document).on('click','.compliance',function(){
                svalue = $('.compliance option:selected').val();
                $('.compliance').prop('name','');
                if(svalue=='Other'){
                     $('.other').prop('name','compliance[]');
               $('.other').show(); 
                }else{
                     $('.compliance').prop('name','compliance[]');
                     $('.other').prop('name','');
                    $('.other').hide();  
                }
            });
        
	
	
	
    
    $(document).on('click','.s_ue',function(){
        $.fancybox({
                href:"#sample_update_1",
				modal:true,
				closeBtn: 'true',
            });
     
    $('save_su').show();
      id =$(this).attr('id');
  
            $('#sample_req').val(id);
                  $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>request_management/get_sample_signatories_1/"+id,
        dataType: "json",
        success:function(data_response){
            
             
     
           $(".tg tbody tr.saved").remove();
    
            $.each(data_response,function(the, data){             

  row = '<tr class="saved">\n\
    <td class="tg-ugh9">\n\
<select name="activity[]" class="activity" selected="selected">\n\
<option  value="'+data.activity+'">'+data.activity+'</option>\n\
<option  value="Analysis">Analysis</option>\n\
<option  value="Supervision">Supervision</option>\n\
<option  value="Review">Review</option>\n\
<option  value="Draft COA">Draft COA</option>\n\
<option  value="Draft COA Approval">Draft COA Approval</option>\n\
<option  value="COA Approval">COA Approval</option>\n\
<option  value="CAN No.">CAN No.</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<select name="by[]" class="by" selected="selected">\n\
<option  value="'+data.by+'">'+data.by+'</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<input type="text" class="date di" value="'+data.date_issued+'" name="datei[]"/>\n\
</td>\n\
\n\<td class="tg-ugh9">\n\
<input type="text" class="date dr" value="'+data.date_returned+'" name="dater[]"/>\n\
</td>\n\
\n\
<td><a href="#remove_row" id="remove_row"> -Remove</a></td>\n\
</tr>'; 
    
    
 $('.tg > tbody tr:last').before(row);  
    
    
            });
         
      rowdata = new Array();
	  //load_tests_done/
            $.getJSON("<?php echo base_url(); ?>request_management/load_tests/"+id,function(data){
                 $('.tig > tbody tr:nth-last-child(2)').empty();
              $.each(data, function(i, row){
				  //row.test
              rowdata.push('<tr>\n\
                           <td>'+row.name+'<input type="hidden" name="tests[]" class="tests" value="'+row.name+'"/></td>\n\
                          <td>\n\
                          <select name="compliance[]" class="compliance" >\n\
                          <option value="'+row.compliance+'">'+row.compliance+'</option>\n\
						   <option value=""></option>\n\
                          <option value="COMPLIES">COMPLIES</option>\n\
                          <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                           <option value="Other">Other</option></select><textarea  cols="100" class="other"></textarea>\n\
                          </td>\n\
                          </tr>');
                         
             
             });
             rowdata.push('<tr><td>Compliance</td><td></td></tr>');
             rowdata.push('<tr><td colspan="2"><textarea name="reason_of_nonc" cols="100" id="conc"></textarea></td></tr>');
             rowdata.push('<tr><td colspan="2"><input type="button" id="save_su" value="Submit" class="submit-button" /> <input type="button" id="cancel" value="Cancel" class="submit-button" /></td><td></td></tr>');
           $('#table_sample_details').html('<table class="tig" id="table_update_12" style="width:1000px; "> <tr> <th class="tg-031e">Test Name </th> <th class="tg-031e">Compliance</th>  </tr> <tbody>'+rowdata+'</tbody> </table>');
            });
            
                  $.getJSON("<?php echo base_url(); ?>request_management/load_tests_reason/"+id,function(data){
                      
                 $('#conc').val(data[0].reason);
              
            });
            
           
       $loadpeople();
     $pick_date();
     
       
  
            
         
        },error:function(){
            alert('An error occured while loading the information, Try again later');
        }
    }); 
 
            
           
    });
    
    
    
     $(document).on('click','#remove_row', function(){
          $(this).closest('tr').remove();       
            return false;
        });
		
		 $(document).on('click','#cancel', function(){
          $.fancybox.close();    
            return false;
        });
        $(document).on('click','.s_u',function(){
            id =$(this).attr('id');
              
    $.ajax({
        type:"get",
        url: "<?php echo base_url(); ?>request_management/check_su_stat/"+id,
        dataType: "json",
        success:function(d){
          
            if(d.stat=='1'){
            alert('Sample Activity Log for this sample is already updated, Kindly Use the Edit link instead');
            return false;
        }else{
            $('#sample_req').val(id);
          rowdata = new Array();
            $.getJSON("<?php echo base_url(); ?>request_management/load_tests/"+id,function(data){
                 $('.tig > tbody tr:nth-last-child(2)').empty();
              $.each(data, function(i, row){
              rowdata.push('<tr>\n\
                           <td>'+row.name+'<input type="hidden" name="tests[]" class="tests" value="'+row.name+'"/></td>\n\
                          <td>\n\
                          <select name="compliance[]" class="compliance compliance1" >\n\
                          <option value="">--Select--</option>\n\
                          <option value="COMPLIES">COMPLIES</option>\n\
                          <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                          </select>\n\
                          </td>\n\
                          </tr>');
                         
             
             });
             rowdata.push('<tr><td>Compliance</td><td></td></tr>');
             rowdata.push('<tr><td colspan="2"><textarea name="reason_of_nonc" cols="100" id="conc"></textarea></td></tr>');
               rowdata.push('<tr><td colspan="2"><input type="button" id="save_su" value="Submit" class="submit-button" /> <input type="button" id="cancel" value="Cancel" class="submit-button" /></td><td></td></tr>');
           $('#table_sample_details').html('<table class="tig" id="table_update_12" style="width:1000px; "> <tr> <th class="tg-031e">Test Name </th> <th class="tg-031e">Compliance</th>  </tr> <tbody>'+rowdata+'</tbody> </table>');
            });
            
          
            
            $(".tg tbody tr.saved").remove();
            $.fancybox({
                href:"#sample_update_1",
				modal:true,
				closeBtn: 'true',
            });
               return true;
    }
    },error:function(){
    }
    });
        });
        
        
               
            complies ='COMPLIES: The sample complies with the specifications of the tests perfomed.';
            does_not_comply ='DOES NOT COMPLY: The sample does not comply with the specifications of the tests perfomed.';

            $(document).on('change','.compliance', function() {
                var selectedVals = $('.compliance').map(function() {
                    return this.value;
                }).get().join(',');
                var data = selectedVals;
             //   alert(data)
                if ($.inArray('DOES NOT COMPLY', data.replace(/,\s+/g, ',').split(',')) >= 0) {
                   
                      $('#conc').val(does_not_comply);
                      $('#conc').css('background','red');
                      $('#conc').css('color','white');
                       $('#conc').css('font-weight','bolder');
                    }else{
                         $('#conc').val(complies); 
                         $('#conc').css('background','greenyellow');
                         $('#conc').css('color','black');
                         $('#conc').css('font-weight','bolder');
                    }
                  


            });
      
         $(document).on('click','#remove_row', function(){
          $(this).closest('tr').remove();       
            return false;
        });
     $(document).on('change', '.activity', function() {
			value = $(this).val();
			if ( value==='Supervision') {
				$(this).closest('tr').find('.di').prop('readonly', 'readonly').val('-------');
                                $(this).closest('tr').find('.di').removeClass('hasDatepicker');
			} else {
				$(this).closest('tr').find('.di').prop('readonly', false).val('');
                                 $(this).closest('tr').find('.di').addClass('hasDatepicker');
			}
		});
        
        $(document).on('click','#save_su',function(e){
            e.preventDefault();
           // $(this).prop('disabled','disabled');
           // $(this).prop('value','Saving....');
            
            $.ajax({
                type:"post",
                url:"<?php echo base_url();?>request_management/saveSampleDetails/",
                data:$('#request_update').serialize(),
                success:function(){
                    alert('Sample Update Complete')
                    $.fancybox.close();
                },error:function(e){
                    alert('An error occured');
                  //  $(this).prop('disabled',false);
           // $(this).prop('value','Try Again...');
                }
            });
        });

	$('.edits').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."request_management/edit/" ?>' + $(this).attr('id')
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:400,
			height: 500,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})
	getData();
       

	$('.set_components').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."tests_management/testsMethodsWizard/" ?>' + $(this).attr('id') + "/" + "request" + "/" + "tests" + "/" + "request_details" + "/" + "quotation_components";
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height:490,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


//Get all the information for a single analyis request entry
	$('.more_info').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."request_management/getMoreSampleInfo/" ?>' + $(this).attr('id');
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height:490,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


	$('.quote').live("click",function(e){
		e.preventDefault();
		client_id = $(this).attr('data-client');
		var href = '<?php echo base_url()."quotation/stateComponents/" ?>' + $(this).attr('id') + "/" + "request" + "/" + "tests" + "/" + "request_details" + "/" + client_id;
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:600,
			height:250,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


$('.quoted').live("click",function(e){
		e.preventDefault();
		//Get unique id
		id = $(this).attr('id');

		//Get tables
		table1 = $(this).attr('data-table1');
		table2 = $(this).attr('data-table2');
		table3 = $(this).attr('data-table3');

		//Get Client Id
		client_id = $(this).attr('data-client');
		
		//Get href
		var href = '<?php echo base_url()."client_billing_management/showBillPerTest/" ?>' + id + "/" + table1 + "/" + table2 + "/" + table3 + "/" + client_id;
		
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height:400,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


$('.invoice').live("click",function(e){
		e.preventDefault();
		//Get unique id
		id = $(this).attr('data-reqid');

		//Get tables
		table1 = $(this).attr('data-table1');
		table2 = $(this).attr('data-table2');
		table3 = $(this).attr('data-table3');

		//Get Client Id
		client_id = $(this).attr('data-client');
		
		//Get href
		var href = '<?php echo base_url()."quotation/showInvoiceBeforePrint/" ?>' + id + "/" + table1 + "/" + table2 + "/" + table3 + "/" + client_id;
		
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:700,
			height:400,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})


$('.labels').live("click", function(e){
	e.preventDefault();
	label_status = $(this).attr("data-labelstatus");
	console.log(label_status);
		if(label_status == "0"){
			var href  =  '<?php echo base_url()."request_management/label_form/" ?>' + $(this).attr('data-reqid');
			var hght = 200;
			var wdth= 300; 
		}
		else if(label_status == "1"){
			var href = '<?php echo base_url()."labels/" ?>' + "Label" + $(this).attr('data-reqid') + ".pdf";
			var hght = 842;
			var wdth = 595;		
		}
	$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions:false,
			width:wdth,
			height:hght,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})

$('.assign').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."sample_issue/sample_split/" ?>' + $(this).attr('data-reqid') + "/" + $(this).attr('data-client');
	$.fancybox.open({
		href : href,
		type: 'iframe',
		autoSize: false,
		width: 800,
		height: 500,
		autoDimensions: false,
		'beforeClose' : function(){
			getData();
		}
	})
})


     $('#gen_req_data').click(function(){           
            $.post("<?php echo base_url() . 'Sample_request_details/generate/'; ?>", function(data) {
                 window.location.href="<?php echo base_url() . 'sample_report/Report.xlsx'; ?>"; 
       
      });
    
      });
      

$('#gen_label').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."request_management/generate_label" ?>';
	$.fancybox.open({
		href:href,
		type: 'iframe',
		autoSize:false,
		autoDimensions:false,
		width:350,
		'beforeClose':function(){
			getData();
		}
	})
})


$('#gen_quotation').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."quotation/generate" ?>';
	$.fancybox.open({
		href:href,
		type: 'iframe',
		autoSize:false,
		autoDimensions:false,
		width:360,
		'beforeClose':function(){
			getData();
		}
	})
})

$('.assigned').live("click", function(e){
	e.preventDefault();
	var href = '<?php echo base_url()."sample_issue/show_assigned_to/" ?>' + $(this).attr('id');
	$.fancybox.open({
		href : href,
		type: 'iframe',
		autoSize: false,
		width: 600,
		height: 500,
		autoDimensions: false,
		'beforeClose' : function(){
			getData();
		}
	})
})


})

</script>