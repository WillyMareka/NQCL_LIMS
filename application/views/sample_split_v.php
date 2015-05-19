<html lang ="en">
	
<legend><a href="<?php echo site_url()."sample_issue/listing"; ?>" >Samples Listing</a>
&nbsp;&rarr;&nbsp;Sample Split & / Issue&nbsp;&rarr;&nbsp;<?php $reqid = $this -> uri -> segment(3); echo $reqid; ?></legend>

<hr />
<!-- If sample had already been issued show info about to whom had issued -->
  <fieldset>
    <legend>Assignments</legend>
    <table id = "assignment_table" >
      <thead>
        <tr>
        </tr>
      </thead>
      <tbody>
        <tr>
        </tr>
      </tbody>
    </table>
  </fieldset>

<!-- Loop through array of all units/departments -->
<?php foreach ($all_units as $units) {
	//If department is not in array of those that have this sample assigned, show assignment form, else don't.
if(in_array($units['id'], $assigned_units) && !in_array($units['id'], $already_assigned_units)){	
?>
	<legend id="unit" data-tableid = "<?php echo $units["id"] ?>" ><?php echo $units['name']; ?></legend>

<table id="tests" data-tableid="<?php echo $units["id"]?>" >
	
<tr><td colspan="4" ><hr></td></tr>	

<tr>
  <th>Samples Available</th>
  <th>Samples to Issue</th>
  <?php if($units["id"] == 2 ){ echo "<th>Tests</th>"; } ?>
  <th>Analyst</th>
  <th>Assign</th>
</tr>

<form id = "sample_issue<?php echo $units["id"] ?>" data-dept = "<?php echo $units["id"] ?>" class = "sample_issue">
	<tr class="unitrows" id = "<?php echo $units["id"] ?>">
		<td class="samples_available"><span><?php echo $sample_listing[0]['sample_qty']; ?></span></td>
		<td class ="samples2issue"><input type="text" id="samples2issue" name="samples_no" class = "validate[required]" /></td>
      <?php if($units["id"] == 2){ ?>
        <td class = "microbio_tests nowrap left-text" >
          <ul class = "no_style">
            <?php foreach($microbio as $m) {?>
              <li>
                <label><input type = "checkbox"  class="microbio_tests" id="microbio<?php echo $m["id"] ?>" name = "microbio_tests[]" value = "<?php echo $m["id"] ?>" />&nbsp;<span class = "smalltext" ><?php echo $m["Name"] ?></span></label>
              </li>
            <?php }?>
          </ul>
        </td>
      <?php } ?>
		<td>
			<span>
				<select name="analyst_id" id="analyst<?php echo $units["id"] ?>">
	                            <option value="" >Select Analyst</option>
					<?php foreach($analysts as $analyst){?>
            <?php if(!in_array($analyst['id'], $analysts_assigned)){?>
						  <option value="<?php echo $analyst['id']; ?>"><?php echo $analyst['fname'] ." ".$analyst['lname']; ?></option>
					<?php } } ?>	
				</select>
			</span>
		</td>
	  <input type="hidden" name="analyst_name" id="analyst_name<?php echo $units['id'] ?>" value=""/>
    <input type="hidden" name="department_name" id="department<?php echo $units['id'] ?>" value="<?php echo $units['name'] ?>"/>
		<input type="hidden" name="dept_id" value="<?php echo $units["id"] ?>"/>
		<input type="hidden" name="lab_ref_no" value="<?php echo $reqid ?>"/>
		<input type="hidden" name="upd_samples_qty" value="<?php echo $sample_listing[0]['sample_qty']?>"/>
		<input type="hidden" name="status_id" value= "2"/>
		<td><span><input type ="submit" name="sample_assign" id="assign_button" class="submit-button" value="Assign"/> </span></td>	
	</tr>
</form>
</table>

<!--Include script inside PHP for loop so as to have form id unique -->
<script type="text/javascript">

$('#analyst<?php echo $units["id"] ?>').change(function(){
    analyst_name=$('#analyst<?php echo $units["id"] ?> option:selected').text();
    $('#analyst_name<?php echo $units["id"] ?>').val(analyst_name);
});


$('#sample_issue<?php echo $units["id"] ?>').submit(function(e){
e.preventDefault();

console.log($(this).attr("id"));
  //Check if there are empty fields with required field
  var valid;
  

  //Loop through required fields, if any empty, set validity false
  $('tr#<?php echo $units["id"] ?> input[type="text"]').each(function(){
    var el = $(this);
      if(el.val() == ""){
        valid = false;
      }
  })

if(valid != false){
  console.log(valid)
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url() . "sample_issue/save" ?>',
		data: $('#sample_issue<?php echo $units["id"] ?>').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){
        //Reload DataTable Ajax when assignment successful
        $('#assignment_table').DataTable().ajax.reload();

        console.log(response.post_data.samples_no);
        console.log(response.test_array);
        // Generate success message from post data
        unit = '<?php echo $units['id']?>';

        if(unit != 2){
          var success_message = "<b>" + response.post_data.samples_no + " <?php echo $sample_listing[0]['Packaging']['name']; ?> " + "</b>" + "issued to " + "<b>" + response.post_data.analyst_name + "</b>" + " - <b>" + response.post_data.department_name + "</b>";
        }
        else{
          var success_message = "<b>" + response.post_data.samples_no + " <?php echo $sample_listing[0]['Packaging']['name']; ?> " + "</b>" + "issued to " + "<b>" + response.post_data.analyst_name + "</b>" + " - <b>" + response.post_data.department_name + "</b>";
        }
        tbls = $('table').length; 
        
        //console.log(tbls);
        if(tbls == 1 ){
        //Use noty to alert successful assign.
         noty({ text: success_message,
                  type: 'success',
            });
          //Delay closing of fancybox, to allow noty-fication of successful assignment of last remaining department/unit 
         setTimeout("parent.$.fancybox.close()", 1000);
        }
        else{ 

        //Save unit number in a variable
        unit = '<?php echo $units["id"]; ?>'      
          
          if(unit!= 2){
             $('[data-tableid = "<?php echo $units["id"]; ?>"]').remove();
          }
          else{
            
            //console.log($('input[type="checkbox"][class="microbio_tests"][disabled="disabled"]').length)
            //Loop through test assigned, Disabled reassignment of the same,
            //If no. of tests, already assigned is greater than one
            if(($('input[type="checkbox"][class="microbio_tests"]').not('[disabled="disabled"]').length) > 1){  
              $.each(response.test_array ,function(key, value){
                if(value.id == $('[id = "microbio'+value.id+'"]').val()){
                  $('[id = "microbio'+value.id+'"]').attr('disabled', 'disabled');
                }    
              })

            //Remove analysts already assigned
            console.log($('select[id="analyst'+unit+'"] option[value ="'+response.post_data.analyst_id+'"]').remove())
            }
            else{
              $('[data-tableid = "<?php echo $units["id"]; ?>"]').remove();
            }

          }
           //Use noty to alert successful assign.
           noty({ text: success_message,
                  type: 'success',
            });
        }
			}
			else if(response.status === "error"){
				   //Use noty to alert unsuccessful assign.
           noty({ text: 'Assign unsuccessful. Check selection of Analyst.',
                  type: 'error',
                  timeout: true,
            });

        	//alert(response.message);
			}
		},
		error:function(){
		}
	})
}
else{
    //Define noty variable
      var n = noty({
        text:"Please enter number of samples to issue.",
        type:'error',
        timeout: false,
        modal:true
      })

      //Noty initialize
      n;
}
})
</script>



<?php } ?> <!-- Closes second if statement -->
<?php } ?> <!-- Closes for loop -->


<script>
$(document).ready(function(){


//apply validationEngine to all forms
console.log($('form.sample_issue').validationEngine());


  var table = $('#assignment_table').DataTable({
    "aoColumns":[
    {"sTitle":"Analyst Name","mData": null,
      "mRender":function(data, type, row){
        return row.fname + " " + row.lname
      }
    },
    {"sTitle":"Department", "mData":"department"},
    {"sTitle":"Quantity", "mData":null,
      "mRender":function(data, type, row){
        return row.quantity + " " + row.packaging;
      }
    },
    {"sTitle":"Date Assigned", "mData":"created_at"},
    {"sTitle":"Withdrawal", "mData":null,
      "mRender":function(data, type, row){
        return '<a class = "withdrawal" data-name = "'+row.fname+" "+row.lname+'"  id = "'+row.Analyst_id+'" data-qty="'+row.quantity+'"  data-packaging = "'+row.packaging+'" data-deptname = "'+row.department+'" data-dept = "'+row.Department_id+'" data-test = "'+row.Test_id+'" >Withdraw</a>';
      }
     }
    ],
    "bJQueryUI":true,
    "bRetrieve":false,
    "bSearchable":false,
    "bLengthChange":true,
    "bInfo":false,
    "bFilter":false,
    "bPaginate":false,
    "bSort":false,
    "sAjaxDataProp": "",
    "sAjaxSource":'<?php echo base_url()."sample_issue/getSampleAssignments/".$reqid;?>'
  });

  //Initialize table
  table;

  $('.unitrows').each(function(i){
  	
  $('.samples2issue input').eq(i).keyup(function(){
  	
  	var s_avail = $('.samples_available span').eq(i).text();
  	
    var samples_a = parseInt(s_avail);
  	
  	if($(this).val() > samples_a ) {
  	
  	alert("Samples to Issue must be less than Samples Available.");
  	
  	$(this).val("");
  	
  	}
  	
  	else if ($(this).val() <= 0) {
  		
  	alert("Samples to Issue must be greater than zero.");
  		
  	$(this).val("");
  	
  	}	
  	
  	else
    {
    	var diff = $('.samples_available span').eq(i).text() - $(this).val();
    	if($('.unitrows').length == 2){
     
     $('.samples_available span').eq(i+1).text(diff);
     $('.samples_available span').eq(i-1).text(diff); 	
  	}
  	
  	
  	else if ($('.unitrows').length == 3) {
  	
  	$('.samples_available span').eq(i+1).text(diff);
  	$('.samples_available span').eq(i+2).text(diff);
    $('.samples_available span').eq(i-1).text(diff); 	
  	$('.samples_available span').eq(i-2).text(diff);
  	}	
  		
  	}
  	
  	});
	});
    

  //On clicking the withdraw button
$('#assignment_table tbody').on("click",".withdrawal", function(){
  
  //Prevent Default anchor action
  console.log("SDfslfjlsdjf");

  //Get name of analyst
  name = $(this).attr("data-name");

  //Get quantity, department, test respectively
  qty = $(this).attr("data-qty");
  dept_id = $(this).attr("data-dept");
  analyst_id = $(this).attr("id");
  packaging = $(this).attr("data-packaging");
  dept_name = $(this).attr("data-deptname");
  //test_id = $(this).attr("data-test");

  //uri segments
  uri = qty+"/"+dept_id+"/"+analyst_id;

  //Withdrawal Url
  url = '<?php echo base_url()."sample_issue/withdrawSample/".$reqid."/" ?>'+qty+"/"+dept_id+"/"+analyst_id+"/"

  if(dept_id == 1 || dept_id == 2){

    //Pop up fancy box
   


    //confirm withdrawal jQuery Dialog
    $('<div><span>Withdraw from <b>'+name+'</b>?</span></div>').dialog({
      resizable:false,
      title: "Withdrawal Confirmation",
      modal:true,
      buttons:{
        "Yes":function() {
          $.ajax({
            type:'POST',
            url:url
          }).done(function(response){
            if(response){
              //Construct success msg
              withdrawal_msg = '<b>'+qty+'&nbsp;'+packaging+'&nbsp;</b>withdrawn</b> from <b>'+name+'-'+dept_name+'</b>'
               
              //Noty-fy Success
                n = noty({
                  text:withdrawal_msg,
                  type:'success',
                  timeout:false
                })

                //Initialize noty
                n;

              //Reload DataTable
              $('#assignment_table').DataTable().ajax.reload();
            }
            else{
                //Noty-fy Success
                n = noty({
                  text:"<b>Withdrawal</b> unsuccessful.",
                  type:'error',
                  timeout:false
                })

                //Initialize noty
               n;               
            }
          })
          
          //Close dialog
          $(this).dialog("close");
        },
        "No":function(){
          $(this).dialog("close");
        }
      }
    })

  }
  else{
     var tr = $(this).closest('tr');
     var row = table.row(tr);

     var sec_table = '<table>\n<thead>\n<tr>\n</tr>\n</thead>\n<tbody>\n<tr>\n</tr>\n</tbody>\n</table>';
     var url_2 = '<?php echo base_url()."sample_issue/testsList/".$reqid."/" ?>'+uri+''
     console.log(url_2);

     function format(s){
     //Initialize array to hold tests
     s = $(sec_table).DataTable({
        "bJQueryUI":true,
        "aoColumns":[
          {"sTitle":"Test", "mData":"test_name"},
          {"sTitle":"Action", "mData":null,
            "mRender":function(data, type, row){
              return '<a class = "withdrawal" data-dept = "1">Withdraw</a>';
            }
        }],
        "sAjaxDataProp": "",
        "sAjaxSource": url_2
     })

     return s;
   }

     if(row.child.isShown()){
       row.child.hide();
       tr.removeClass('show');
     }
     else{
       row.child( format(row.data())).show();
       tr.addClass('shown');
     }
  }
})


})	



</script>


</html>
