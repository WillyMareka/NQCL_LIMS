<script>
    $(document).ready(function() {
        function addLeadingZeros(n, length)
        {
            var str = (n > 0 ? n : -n) + "";
            var zeros = "";
            for (var i = length - str.length; i > 0; i--)
                zeros += "0";
            zeros += str;
            return n >= 0 ? zeros : "-" + zeros;
        }
        setInterval(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>request_management/ajax_loader",
                dataType: "JSON",
                success: function(actual) {
                    var lastid = parseInt(actual[0].id) + 1;
                    var padded_id = addLeadingZeros(lastid, 3);
                    var saffix = 'NDQ';
                    var year = "<?php echo date('Y'); ?>";
                    var month = "<?php echo date('m'); ?>";
                    var client = $('#clientT').val();
                    var full_labref = saffix + client + year + month + padded_id;
                    $('#labref_no').text(full_labref);
                    $('#lab_ref_no').val(full_labref);
                    $('#clientT').change(function() {
                        $('#labref_no').text(full_labref);
                        var client = $('#clientT').val();
                        var full_labref1 = saffix + client + year + month + padded_id;
                        $('#lab_ref_no').val(full_labref1);
                    });

                },
                error: function(data) {
                    // alert('An error occured, kindly try later');
                }
            });
        }, 500);
    });

</script>


<script>

    $(function() {
        $('#clientform').submit(function(e) {
            e.preventDefault();

            var empty_inputs = $("#clientform").find('input').not('#crn').filter(function() {
                return this.value === "";
            });

            var empty_textarea = $('#clientform').find('textarea').filter(function() {
                return this.value === "";
            })

            var empty_select = $("#clientform").find('select').filter(function() {
                return this.value === "";
            });

            if (empty_inputs.length || empty_select.length || empty_textarea.length) {

                alert("Please fill all required fields to proceed.");

            }

            else {

                form_url = '<?php echo site_url() . "client_management/save"; ?>'
                $.ajax({
                    type: 'POST',
                    url: form_url,
                    data: $('#clientform').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            $("#entry_form, #neworreturning").dialog("close");
                            var clientdata = $.parseJSON(response.array);
                            $('#applicant_name').val(clientdata.client_name);
                            $('#applicant_address').val(clientdata.client_address);
                            $('#contact_name').val(clientdata.contact_person);
                            $('#contact_telephone').val(clientdata.contact_phone);
                            $('#appl_ref_no').val(clientdata.client_ref_no);
                            $('#c_id').val(clientdata.clientid);
                        }
                        else if (response.status === "error") {
                            alert(response[0].message);
                        }
                    },
                    error: function() {
                    }
                })

            }

        })


        $("#clientform").validationEngine('attach', {promptPosition: "bottomLeft", scroll: true});

    })

</script>

<form id = "analysisreq" action = "<?php echo site_url("request_management/save") ;  ?>" >

    <input type="hidden" name="client_type" id="client_types" value="<?php echo end($lastClient) ?>" />

    <p class="labrefno">Analysis Request Register&nbsp;&rarr;&nbsp;<!--label class="labrefno" id="labref_no"></label--><label id = "labref_no">Lab Reference Number</label>
            &nbsp;<!--label id="urgent">Urgent</label>&nbsp;&rarr;&nbsp;<input type = "checkbox" name= "urgency" value="1" /-->
    </p>

    <table id="tests" class="">
        <!--tr>
                <th style="font-size: 13px">ANALYSIS REQUEST REGISTER</th>
        </tr-->

        <legend><hr /></legend>

        <tr></tr>

        <input type ="text" id = "c_id" name = "clientid" />

        <input type = "hidden" name = "lab_ref_no" id = "lab_ref_no" />

        <tr>
            <td>Applicant Name</td>
            <td><textarea name = "applicant_name" id = "applicant_name" class = "validate[required]" ></textarea></td>
            <td>Applicant Address</td>
            <td><textarea name="applicant_address" id="applicant_address" class = "validate[required]" ></textarea></td>
        </tr>
        <td>Client Type</td>
        <td><select id="clientT" name="clientT"  class = "validate[required]">
                <option value="">-Select Type-</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
            </select>
        </td>
        <tr>
            <td>Contact Name</td>
            <td><input type="text" id="contact_name" name="contact_name" class = "validate[required]" ></label>
            </td>

            <td>Contact Telephone</td>
            <td><input type="text" name="contact_telephone" id="contact_telephone" class = "validate[required]" /></td>
        </tr>

        <tr>
            <td>Product Name</td>
            <td><input type="text" name="product_name" id="product_name" class = "validate[required]" /></td>

            <td>Dosage Form</td>
            <td><select name="dosage_form" id="dosage_form" class = "validate[required]" />
        <option value=""></option>
        <?php foreach ($dosageforms as $dosageform) { ?>	
            <option value="<?php echo $dosageform->id ?>"><?php echo $dosageform->name ?></option>
        <?php } ?>
        </select>
        </td>
        </tr>	

        <tr>
            <td><label>Product Description</label></td><td><textarea name="description" title="Describe how product looks like"  ></textarea></td>
            <td><label>Product Presentation</label></td><td><textarea type="text" name="presentation" title="Describe how product is presented, Viles, Tablets e.t.c"   ></textarea></td>
        </tr>

        <tr>
            <td>Label Claim</td>
            <td>
                <textarea name="label_claim" id="label_claim"  ></textarea>
            </td>
            <td>Active Ingredients</td>
            <td><textarea name="active_ingredients"  ></textarea></td>
        </tr>

        <tr>
            <td>Manufacturer Name</td>
            <td><input type="text" name="manufacturer_name" class = "validate[required]" /></td>

            <td>Manufacturer Address</td>
            <td><textarea name="manufacturer_address" id="manufacturer_address"" class = "validate[required]" ></textarea></td>
        </tr>

        <tr>
            <td><label>Product License No</label></td>
            <td><input type="text" name="product_lic_no" placeholder="e.g Raj./ No .1640"  /></td>	
            <td><label>Country of Origin</label></td>
            <td><input type="text" name="country_of_origin" placeholder="e.g India"  class = "validate[required]"  id="country_of_origin"/></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr id = "dateformatitle">
            <td><span class = "misc-title smalltext gray_out">Choose Date of Manufacture & Date of Expiry Date Format</span></td>
        </tr>

        <tr id="dateformat">
            <td id = "dmy"><span>Day-Month-Year</span></td>
            <td><input type= "checkbox" name = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "dmy" /></td>
            <td id = "my"><span>Month-Year</span></td>
            <td><input type= "checkbox" name = "dateformat" class = "validate[required]" data-rename = "dateformat" value = "my" /></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr id="dmy" class = "hidden2" >
            <td>Manufacture Date</td>
            <td><input type = "text" id = "date_m" name ="date_m" readonly class = "validate[required] datepicker" /></td>


            <td>Expiry Date</td>
            <td><input type = "text" id = "date_e" name = "date_e" readonly class = "validate[required] datepicker" /></td>
        <tr>

        <tr id="my" class = "hidden2" >
            <td>Manufacture Date&nbsp;</td>
            <td><input type = "text" id = "m_date" 	name ="m_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" /></td>


            <td>Expiry Date</td>
            <td><input type = "text" id = "e_date" name = "e_date" readonly class = "validate[required] datepicker" data-month = "monthpicker" /></td>
        <tr>


            <td>Quantity Submitted</td>
            <td><input type="text" name="quantity" class = "validate[required]" /></td>
            <td><select name = "packaging">
                    <option value=""></option>
                    <?php foreach ($packages as $package) { ?>	
                        <option value="<?php echo $package->id ?>"><?php echo $package->name ?></option>
                    <?php } ?></select></td>
        </tr>

        <tr>
            <td>Batch/Lot Number</td>
            <td><input type="text" name="batch_no" /></td>
        </tr>

        <tr>
            <td id="date_of_receipt">Date of Receipt</td>
            <td><input type="text" name="designation_date" id="designation_date" class = "validate[required] datepicker"  /></td>
            <td id="ref_no_td">Client Sample Reference Number</td>
            <td><input type="text" name="applicant_reference_number" id="appl_ref_no"  /></td>
        </tr>

        <tr><td><span class = "misc-title smalltext gray_out">Other things submitted</span></td></tr>

        <tr>
            <td>Method of Analysis</td>
            <td><input type ="checkbox" name ="moa" value ="moa"/></td>
            <td>Chemical Reference Substance</td>
            <td><input type ="checkbox" name ="crs" value ="crs" /></td>
        </tr>

    </table>



    <table>
        <tr>
        <legend>Departmental Tests</legend>
        <hr />

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
                                    echo "<tr id =" . $wetchem->id . " ><td>" . $wetchem->Name . "</td><td><input type=checkbox id=" . $wetchem->Alias . " name=test[] value=" . $wetchem->id . " title =" . $wetchem->Test_type . " /></td></tr>";
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
                                    echo "<tr id =" . $microbiology->id . "><td>" . $microbiology->Name . "</td><td><input type=checkbox id=" . $microbiology->Alias . " name=test[] value=" . $microbiology->id . " title =" . $microbiology->Test_type . " /></td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="AccordionPanel">
                        <div class="AccordionPanelTab"><b>Medical Devices Unit</b></div>
                        <div class="AccordionPanelContent">
                            <table>
<?php foreach ($medicaldevices as $medical) { ?>
                                    <?php echo "<tr id =" . $medical->id . "><td>" . $medical->Name . "</td><td><input type=checkbox id=" . $medical->Alias . " name=test[] value=" . $medical->id . " title =" . $medical->Test_type . " /></td></tr>";
                                    ?>

                                <?php } ?>

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

        <hr />

        <input type="hidden" name="designator_name" value="<?php
                                $userarray = $this->session->userdata;
                                $user_id = $userarray['user_id'];

                                $user_typ = User::getUserType($user_id);
                                $user_name = $user_typ[0]['username'];
                                $usertype = $user_typ[0]['user_type'];

                                echo $user_name
                                ?>" /> 

        <input type ="hidden" name="designation" value="<?php echo $usertype; ?>"/>




        <tr>
            <td><input class="submit-button" name="submit" type="submit" value="Save Request"/></td>
        </tr>

    </table>

</form>
<form action="<?php echo base_url(); ?>user_management/dance">
    <input type="submit" value="save"/>
</form>

<div id = 'diffsys' class = 'hidden2' >
    <div><span>Specify other method.</span></div>
</div>

<script language="JavaScript" type="text/javascript">

    $('input[data-rename ="dateformat"]').live('click', function() {
        fmt = $(this).val();
        console.log(fmt);
        if ($(this).is(':checked')) {
            console.log($('tr[id = "' + fmt + '"]').show());
            if (fmt == 'dmy') {
                $('input[value = "my"]').hide();
                $('td[id = "my"]').hide();
            }
            else if (fmt == 'my') {
                $('input[value = "dmy"]').hide();
                $('td[id = "dmy"]').hide();
            }
        }
        else {
            $('tr[id = "' + fmt + '"]').hide();
            if (fmt == 'dmy') {
                $('input[value = "my"]').show();
                $('td[id = "my"]').show();
            }
            else if (fmt == 'my') {
                $('input[value = "dmy"]').show();
                $('td[id = "dmy"]').show();
            }
        }

    })



    $('#analysisreq').validationEngine();

    var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

    $(function() {
        $("#country_of_origin").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('sample_controller/suggestions'); ?>",
                    data: {term: $("#country_of_origin").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });

    $(function() {
        $("#manufacturer_address").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('request_management/suggestions1'); ?>",
                    data: {term: $("#manufacturer_address").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });

    $(function() {
        $("#label_claim").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('request_management/suggestions2'); ?>",
                    data: {term: $("#label_claim").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 100
        });
    });
    $(function() {
        $("#product_name").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('request_management/suggestions3'); ?>",
                    data: {term: $("#product_name").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 100
        });
    });






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
            $.getJSON("getCodes/" + ui.item.value, function(codes) {
                var codesarray = codes;
                for (var i = 0; i < codesarray.length; i++) {
                    var object = codesarray[i];
                    for (var key in object) {

                        var attrName = key;
                        var attrValue = object[key];

                        switch (attrName) {

                            case 'Clientid':

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


                        }

                    }

                }


            })
        },
        Delay: 200
    })


    $("#fullmonograph").change(function() {
        if ($('#fullmonograph').is(':checked')) {
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

    $('#date_m, #date_e, #designation_date').datepicker({
        changeYear: true,
        dateFormat: "dd-M-yy"
    });

    $('#date_m').datepicker("option", "maxDate", '0');
    $('#m_date').datepicker("option", "maxDate", '0');
    $('#designation_date').datepicker("option", "maxDate", '0');


    $('input[data-month = "monthpicker"]').datepicker({
        dateFormat: 'M yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('M yy', new Date(year, month, 1)));
        }
    });

    $("#m_date, #e_date").focus(function() {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        })
    })



//$('#date_e').datepicker("option", "minDate", '0');

    /*$('#date_m').change(function(){
     date_m = $(this).datepicker('getDate');
     date_e_min = new Date(date_m.getTime());
     date_e_max = new Date(date_m.getTime());
     date_e_max.setDate(date_e_max.getDate() + 732)
     date_e_min.setDate(date_e_min.getDate() + 186); 
     $('#date_e').datepicker("option", "minDate", date_e_min);
     $('#date_e').datepicker("option", "maxDate", date_e_max);
     })*/

    $('#analysisreq').submit(function() {   

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "request_management/save" ?>',
            data: $('#analysisreq').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {

                    $('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');

                    $('form').each(function() {

                        this.reset();
                    })


                    requestdata = $.parseJSON(response.array);

                    window.location.href = "<?php echo site_url() ?>request_management/listing/";
                }
                else if (response.status === "error") {
                    alert(response.message);
                }
            },
            error: function() {
            }
        });


    });

</script>