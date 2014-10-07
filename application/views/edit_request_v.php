<div id ="fancybox_label" class = "hidden2" >
    <form id = "print_label">
        <input type = "hidden" name="ndqno" id ="label_ndqno" class = "label_ndqno" />	
        <div>
            <fieldset>
                <legend><span>Label for </span><span id ="ndqno" class = "label_ndqno"></span></legend>
                <ul id = "testlist"></ul>
            </fieldset>
        </div>
        <div class = "clear">
            <div class = "left_align">
                <label for = "no_of_prints">No. of Prints</label>
            </div>
        </div>

        <div class = "clear" >
            <div class = "left_align">
                <input type ="text" id="no_of_prints" name="no_of_prints" class="validate[required]" />
            </div>
        </div>
        <div class = "clear" >		
            <div class = "left_align">
                <input type ="submit" value="print" class="submit-button" />
            </div>
        </div>	
    </form>	
</div>

<form id = "analysisreq" >

<?php //var_dump($tests_issued[0]['Test_id'])  

foreach($tests_issued as $tests_i){
			
		$tests_ids[] = $tests_i['Test_id'];	  

		}

		//var_dump($tests_ids) ;
?>

<input type="hidden" name="lab_ref_no" id="lab_ref_no" value="<?php echo $request[0]['request_id'] ?>" />

<input type="hidden" name="client_type" id="client_type" value="<?php echo $client -> Client_type ?>" />

<p class="labrefno">Analysis Request Register&nbsp;&rarr;&nbsp;<label class="labrefno" id="labref_no"><a href="<?php echo site_url('/request_management/edit_history/')."/".$reqid;?>" ><?php echo $request[0]['request_id'] ?></a></label>
	&nbsp;&nbsp;<!--label id="urgent">Urgency</label><input type = "checkbox" name= "urgency" value="1" <?php //if($request['Urgency'] == 1){ echo "checked";} else{ echo ""; } ?> /-->
</p>

<table id="tests" class="">
<!--tr>
	<th style="font-size: 13px">ANALYSIS REQUEST REGISTER</th>
</tr-->

<legend><hr /></legend>

<tr></tr>
<?php echo ($client -> id) . $request[0]['request_id']; ?>
<tr>
<td>Client Name</td>
<td>
	<input name="client_name" id="applicant_name" value="<?php echo $client -> Name ?>" required />	
	<input type="hidden" name="client_id" id="c_id" value="<?php echo $client -> id ?>"/>
</td>

<td>Client Address</td>
<td><input type="text" name="client_address" id="applicant_address" value="<?php echo $client ->Address; ?>" required readonly/></td>
</tr>

<tr>
<td>Contact Name</td>
<td><input type="text" id="contact_name" name="contact_person" value="<?php echo $client -> Contact_person; ?>" required readonly ></label>
</td>

<td>Contact Telephone</td>
<td><input type="text" name="contact_phone" id="contact_phone" value="<?php  echo $client -> Contact_phone; ?>" required readonly /></td>
</tr>


<tr>
	<td>Client Type</td>
	<td><select id="clientT" name="clientT" readonly >
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="D">D</option>
	<option value="E">E</option>
	</select>
	<input type="hidden" id="db_clientype" value="<?php echo $client -> Client_type ?>" />
</td>
<td>Client Email</td>
<td><input type="text" id="client_email" name="client_email" value="<?php echo $client -> email ?>" readonly ></td>
</tr>

<td>Dosage Form</td>
<td><select name="dosage_form" id="dosage_form" required />
	<option value=""></option>
	<?php foreach ($dosageforms as $dosageform) {?>	
	<option value="<?php echo $dosageform -> id ?>" selected ="<?php if($dosageform -> id == $request[0]['Dosage_Form']) { echo "selected";} ?>"><?php echo $dosageform -> name ?></option>
	<?php } ?>
	</select>
	<input type="hidden" id="dform" name="df" value="<?php echo $request[0]['Dosage_Form'] ?>"
</td>


</tr>

<tr>
	<td>Product Name</td>
<td><input type="text" name="product_name"  value="<?php echo $request[0]['product_name']; ?>" required /></td>
	
	<td>Label Claim</td>
	<td>
	<textarea name="label_claim" required ><?php echo $request[0]['label_claim'] ?></textarea>
	</td>
	
</tr>

<tr>
<td>Manufacturer Name</td>
<td><input type="text" name="manufacturer_name" value="<?php echo $request[0]['Manufacturer_Name'] ?>" required /></td>

<td>Manufacturer Address</td>
<td><input type="text" name="manufacturer_address" value="<?php echo $request[0]['Manufacturer_add'] ?>" required /></td>
</tr>

<tr>
<td>Batch/Lot Number</td>
<td><input type="text" name="batch_no" value="<?php echo $request[0]['Batch_no']; ?>" required /></td>
<td>Quantity Submitted</td>
<td><input type="text" name="quantity" value="<?php echo $request[0]['sample_qty']; ?>" required /></td>
   <td><select name = "packaging" id = "packaging" >
    	<option value=""></option>
                    <?php foreach ($packages as $package) { ?>	
                        <option value="<?php echo $package->id ?>" data-text = "<?php echo $package ->name ?>" ><?php echo $package->name ?></option>
                    <?php } ?></select>
                <input type="hidden" id="db_packaging" name="df" value="<?php echo $request[0]['packaging'] ?>"    
                </td>
</tr>

<tr>
<td>Active Ingredients</td>
<td><textarea name="active_ingredients" required ><?php echo $request[0]['active_ing']; ?></textarea></td>
</textarea></td>

<td id="ref_no_td">Client Sample Reference Number</td>
<td><input type="text" name="client_ref_no" id="appl_ref_no" value="<?php echo $request[0]['clientsampleref']; ?>" /></td>
</tr>

<tr id = "dateformatitle">
<td><span class = "misc-title smalltext gray_out">Choose Date of Manufacture & Date of Expiry Date Format</span></td>
</tr>

<tr id="dateformat">
<td id = "dmy"><span>Day-Month-Year</span></td>
<td><input type= "checkbox" name = "dateformat" id = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "dmy" /></td>
<td id = "my"><span>Month-Year</span></td>
<td><input type= "checkbox" name = "dateformat" id = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "my" /></td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr id="dmy" class = "<?php if($request[0]['dateformat'] == "dmy"){echo " " ;} else{ echo "hidden2" ;} ?>" >
<td>Manufacture Date</td>
<td><input type = "text" id = "date_m" name ="date_m" readonly class = "validate[required] datepicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['Manufacture_date']))  ?>" /></td>


<td>Expiry Date</td>
<td><input type = "text" id = "date_e" name = "date_e" readonly class = "validate[required] datepicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['exp_date']))  ?>" /></td>
<tr>

<tr id="my" class = "<?php if($request[0]['dateformat'] == "my"){echo " " ;} else{ echo "hidden2"; } ?>" >
<td>Manufacture Date&nbsp;</td>
<td><input type = "text" id = "m_date" 	name ="m_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['Manufacture_date']))  ?>" /></td>


<td>Expiry Date</td>
<td><input type = "text" id = "e_date" name = "e_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" value = "<?php echo date('d-M-Y', strtotime($request[0]['exp_date']))  ?>" /></td>
<tr>

<tr>
<td>Designation Date</td>
<td><input type = "text" name="designation_date" id="designation_date" value="<?php echo date('d-M-Y', strtotime($request[0]['Designation_date'])) ?>"/></td>
</tr>

</table>

<table>
<tr>
<legend>Departmental Tests</legend>
<hr />

<label class="misc_title" >Tests Selected:</label>
<tr><span class="lightbg" id="testspan" >
	<?php 
	//var_dump($tests_checked);
	foreach($tests_checked as $test_checked){
		echo " " . $test_checked['Alias']. " ";	
	
	} ?>
	
	
	</span>
</tr>


</tr>

<tr>
<!--Accrodion-->
<td>
<div class="Accordion" id="sampleAccordion" tabindex="0">
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Wet Chemistry Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php
				foreach ($wetchemistry as $wetchem) {
					//$checked = in_array($wetchem -> Alias,$tests_checked) ? 'checked="checked"' : "";
					echo "<tr><td>" . $wetchem -> Name . "</td><td><input type=checkbox id=" . $wetchem -> Alias . " value=" . $wetchem -> id. " name=test[]/></td></tr>";
				}
			?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Biological Analysis Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($microbiologicalanalysis as $microbiology) {
					echo "<tr><td>" . $microbiology -> Name . "</td><td><input type=checkbox id=" . $microbiology -> Alias . " name=test[] value=" . $microbiology -> id . " /></td></tr>";
				}
				?>
			</table>
		</div> 
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Medical Devices Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
			<?php
			
			foreach ($medicaldevices as $medical) {
			
				echo "<tr><td>" . $medical -> Name . "</td><td><input type=checkbox id=" . $medical -> Alias . " name=test[] value=" . $medical -> id . " /></td></tr>";
			}
			?>
			</table>
		</div>
	</div>
</div>
</td>
<!-- End Accrodion-->
<td>Full Monograph <input type="checkbox" name="fullmonograph" id="fullmonograph" value="fullmonograph" /></td>
</tr>
</table>

<table>

<legend>Reasons for edit</legend>
<hr />
<tr>
<td>
<textarea name="edit_notes" class="chromaconditions" required ><?php echo $request[0]['edit_notes'] ?></textarea>
</td>
</tr>

<input type="hidden" name="designator_name" value="<?php 

$userarray = $this->session->userdata;
$user_id = $userarray['user_id'];

$user_typ = User::getUserType($user_id);
$user_name = $user_typ[0]['username'];
$usertype = $user_typ[0]['user_type'];

echo $user_name ?>" /> 

<input type ="hidden" name="designation" value="<?php echo $usertype; ?>"/>

<input type = "hidden" name = "dbdateformat" id = "dbdateformat" value = "<?php echo $request[0]['dateformat'] ?>"

<!--label></label-->
<tr>
	<td><input class="submit-button" name="submit" type="submit" value="Update Request"></td>
</tr>

</table>

</form>

</div>

<script>

	$("#clientT").change(function() {
	
		var str = "";
		
		$("#clientT option:selected").each(function() {
			str += $(this).val() + "";
		});
		
		//Find out how to go through list and change particular character.
		
		//$("#labref_no").text("NDQ" + str + <?php echo date('Y') ?>  + "<?php echo date('m')?>"  + "<?php //echo $last_req_id -> id + 1; ?>");
		//var label_contents = $("#labref_no").html();
		//$("#lab_ref_no").val(label_contents);
	}).trigger('change');
</script>






<script>
	$(function(){

	//if($("#dbdateformat").val() == $("#dateformat").val() ){	
 		dfmt =	$("#dbdateformat").val() 			
		console.log($('input[value = "'+dfmt+'"]').attr("checked", true ));
	//}

		

$('#date_m, #date_e, #designation_date').datepicker({
changeYear:true,
dateFormat:"dd-M-yy"
});

$('#date_m').datepicker("option", "maxDate", '0');
$('#m_date').datepicker("option", "maxDate", '0');
$('#designation_date').datepicker("option", "maxDate", '0');


$('input[data-month = "monthpicker"]').datepicker({
	dateFormat: 'M yy',
	changeMonth:true,
	changeYear: true,
	showButtonPanel: true,

	onClose: function(dateText, inst){
		var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
		var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		$(this).val($.datepicker.formatDate('M yy', new Date(year, month, 1)));
	}
});

$("#m_date, #e_date").focus( function() {
	$(".ui-datepicker-calendar").hide();
	$("#ui-datepicker-div").position({
		my: "center top",
		at: "center bottom",
		of: $(this)
	})
})





$('input[data-rename ="dateformat"]').live('click', function(){
fmt = $(this).val();
console.log(fmt);
if($(this).is(':checked')){
	console.log($('tr[id = "'+fmt+'"]').show());
	if(fmt == 'dmy'){
		$('input[value = "my"]'). hide();
		$('td[id = "my"]').hide();
	}
	else if(fmt == 'my'){
		$('input[value = "dmy"]').hide();
		$('td[id = "dmy"]').hide();
	}
}
else{
	$('tr[id = "'+fmt+'"]').hide();
	if(fmt == 'dmy'){
		$('input[value = "my"]'). show();
		$('td[id = "my"]').show();
	}
	else if(fmt == 'my'){
		$('input[value = "dmy"]').show();
		$('td[id = "dmy"]').show();
	}
}

})


		$("#dosage_form option").each(function(){
			
			if($(this).val() == $("#dform").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})


		$("#packaging option").each(function(){
			
			if($(this).val() == $("#db_packaging").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		$("#clientT option").each(function(){
			
			if($(this).val() == $("#db_clientype").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		$("#expiryMonth option").each(function(){
			
			if($(this).val() == $("#e_date_month").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		$("#manufactureMonth option").each(function(){
			
			if($(this).val() == $("#m_date_month").val()){
				
				$(this).attr("selected", "selected");
			}
			
		})
		
		
		var checkboxarray = <?php echo json_encode($tests_checked) ?>;
		
		$.each(checkboxarray, function (i, elem){
			
			//alert(elem.Alias)
		
		    if($('#' + elem.Alias) != 'undefined'){
			
			$('#' + elem.Alias).attr('checked', true);
			
		  }
		
		})


		        $("#applicant_name").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('request_management/suggestions'); ?>",
                    data: {term: $("#applicant_name").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(e, ui) {
                //alert(ui.item.value);
                $.getJSON("<?php echo base_url().'request_management/getCodes/'; ?>" + ui.item.value, function(codes) {
                    var codesarray = codes;
                    for (var i = 0; i < codesarray.length; i++) {
                        var object = codesarray[i];
                        for (var key in object) {

                            var attrName = key;
                            var attrValue = object[key];

                            switch (attrName) {

                                case 'id':

                                    //var dat=$('#clientid_old').val(attrValue);

                                    $('#c_id').val(attrValue);


                                    break;

                                case 'Address':

                                    $('#applicant_address').val(attrValue);

                                    break;

                                case 'Client_type':

                                    $('#clientT').val(attrValue);
                                    break;

                                case 'Contact_person':

                                    $('#contact_name').val(attrValue);

                                    break;

                                case 'Contact_phone':

                                    $('#contact_telephone').val(attrValue);

                                    break;

                                case 'email':

                                    $('#client_email').val(attrValue);    

                                    break;
                            }

                        }

                    }


                })
            },
            Delay: 200
        })


		
        $('#analysisreq').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url() . "request_management/edit_save" ?>',
                data: $('#analysisreq').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {

                        $('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
                        $('form').each(function() {

                            this.reset();
                        })
                        //console.log(response.array);
                        requestdata = $.parseJSON(response.array);
                        $(".label_ndqno").text(requestdata.ndqno);
                        $("#label_ndqno").val(requestdata.ndqno);
                        for (var i = 0; i < requestdata.test.length; i++) {
                            $.getJSON("<?php echo base_url() . 'request_management/getTestName/' ?>" + requestdata.test[i], function(data) {
                                //sdata = $.parseJSON(JSON.stringify(data));
                                console.log(data[0].Name);
                                $("<li><span>" + data[0].Name + "</span></li>").appendTo("#testlist");
                            })
                        }

                        $.fancybox({
							href:'#fancybox_label',
							closeClick: false,
							helpers: {
							overlay:{closeClick:false}
								}
						});

                    }
                    else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function() {
                }
            })


        })

        $('#print_label').submit(function(e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "request_management/getLabelPdf/" ?>' + $('#lab_ref_no').text() + "/" + $('#no_of_prints').val();
            var href2 = '<?php echo base_url() . "labels/" ?>' + "Label" + $('#lab_ref_no').text() + ".pdf";
            $.ajax({
                type: 'POST',
                url: href,
                data: $('#print_label').serialize()
            }).done(function() {
                console.log(href2);
                console.log(href);
                console.log($().jquery);
                $.fancybox.open({
                    href: href2,
                    type: 'iframe',
                    autoSize: false,
					closeClick: false,
					helpers: {
						overlay:{closeClick:false}
					},
                    //content: '<embed src = "'+href2+'#nameddest=self&page=1&view=FitH, 0&zoom=80,0,0" type="application/pdf" height="99%" width="100%" />', 
                    beforeClose: function() {
                        $('.fancybox-inner').unwrap();
                        window.location.href = "<?php echo site_url() ?>request_management/listing";
                    },
					'afterClose':function () {
						window.location.href = "<?php echo base_url() ?>request_management";
					}
                });
            })

        })


	
	});
</script>




<script language="JavaScript" type="text/javascript">
		var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

		$(function() {
			$("#fullmonograph").change(function() {
				if($('#fullmonograph').is(':checked')) {
					document.getElementById("identification").checked = true;
					document.getElementById("dissolution").checked = true;
					document.getElementById("disintegration").checked = true;
					document.getElementById("friability").checked = true;
					document.getElementById("assay").checked = true;
					document.getElementById("uniformity").checked = true;
					document.getElementById("ph").checked = true;
					document.getElementById("contamination").checked = true;
					document.getElementById("sterility").checked = true;
					document.getElementById("endotoxin").checked = true;
					document.getElementById("integrity").checked = true;
					document.getElementById("viscosity").checked = true;
					document.getElementById("microbes").checked = true;
					document.getElementById("efficacy").checked = true;
					document.getElementById("melting").checked = true;
					document.getElementById("relativity").checked = true;
					document.getElementById("condom").checked = true;
					//document.getElementById("syringe").checked = true;
					document.getElementById("needle").checked = true;
					document.getElementById("glove").checked = true;
					document.getElementById("refractivity").checked = true;
				}
				
			});
		});

	</script>

</html>