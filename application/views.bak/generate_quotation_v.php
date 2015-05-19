<html>
    <form id = "quotation" class = "methods">
        <h3>Generate Quotation</h3>
        <ul id = "quotation_ul">
            <li>
                <fieldset>
                    <legend>Client Info</legend>
                        <li>
                            <label>
                                <span>Client Name</span>
                                <input id = "client_name" name="client_name" class ="validate[required]" placeholder ="e.g Kenya Pharma" type="text" />
                            </label>
                        </li>
                        <li>
                            <label>
                                <span>Client Email</span>
                                <input id = "client_email" name="client_email" class ="validate[required]" placeholder ="client@email.com" type="text" />
                            </label>
                        </li>
                    </fieldset>
                </li>
                <li id = "quotation_select" style = "list-style-type: none;" ></li>
                <li>
                    <fieldset>
                        <legend>Product Info</legend>
                        <li>
                            <label>
                                <span>Product Name</span>
                                <input id = "sample_name" name="sample_name" class ="validate[required]" placeholder ="e.g Panadol" type="text" />
                            </label>
                        </li>
                        <!--li>
                            <label>
                                <span>Active Ing.</span>
                                <input id = "active_ing" name="active_ing" class ="validate[required]" placeholder ="e.g Paracetamol" type="text" />
                            </label>
                        </li-->
                        <li>
                            <label>
                                <span>No. of Batches</span>
                                <input id = "no_of_batches" name="no_of_batches" class ="validate[required]" placeholder ="e.g 50" type="text" />
                            </label>
                        </li>
                        <!--li>
                            <label>
                                <span>Dosage Form</span>
                                <select name = "dosage_form" id = "dosage_form" class = "validate[required]" >
                                    <option value = " "></option>
                                    <?php //foreach ($dosageforms as $dosageform) {?> 
                                    <option value="<?php //echo $dosageform -> id ?>"><?php //echo $dosageform -> name ?></option>
                                    <?php //} ?>
                                </select>
                            </label>
                        </li-->
                </fieldset>
            </li> 
            <li>
                <fieldset id = "test_fieldset">
                    <legend><span>Tests Info</span></legend>
                        <table id ="tests_table">
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
                                                        echo "<tr id =" . $wetchem->id . " ><td>" . $wetchem->Name . "</td><td><input type=checkbox id=" . $wetchem->Alias . " name=test[] value='$wetchem->id' title =" . $wetchem->Test_type . " /></td></tr>";
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
                                                        echo "<tr id =" . $microbiology->id . "><td>" . $microbiology->Name . "</td><td><input type=checkbox id=" . $microbiology->Alias . " name=test[] value= '$microbiology->id'  title =" . $microbiology->Test_type . " /></td></tr>";
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
                                                        <?php echo "<tr id =" . $medical->id . "><td>" . $medical->Name . "</td><td><input type=checkbox id=" . $medical->Alias . " name=test[] value= '$medical->id'  title =" . $medical->Test_type . " /></td></tr>";
                                                        ?>

                                                    <?php } ?>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!-- End Accrodion--> 
                            </tr>
                     </table>
                    </fieldset>
                </li>
            </ul>
            <input name = "client_id" type = "hidden" id = "client_id" />   
        <div class = "clear" >		
            <div class = "left_align">
                <input type ="submit" value="Save" class="submit-button" />
            </div>
        </div>
    </form>	


<script language="JavaScript" type="text/javascript">
    
$('#quotation').validationEngine();

var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

$(function() {
    $('#quotation').submit(function(e){
    e.preventDefault();
    
    var client = $('#client_name').val();
    var product = $('#sample_name').val();
    var tests =  $('input[type = "checkbox"]:checked').val();
    var no_of_batches = $('#no_of_batches').val();
    console.log(tests);

    var inputs = $("#quotation").find('input').not(':hidden').filter(function(){
         return this.value === "";
    });

    if (inputs.length) {

    //alert(inputs.length + " fields empty. Please fill to continue.");

    }

        else {
            $('<div><ul class = "no_style"><li>Confirm</li><b><li>'+client+'</li><li>'+product+'</li><li>'+tests+'</li></b><li>&nbsp;?</li></ul></div>').dialog({
            resizable:false,
            title: "Quote Confirmation " + client,
            modal:true,
            buttons:{
                "Yes":function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url()."quotation/save" ?>',
                data: $('#quotation').serialize(),
                dataType: "json",
                success:function(response){
                    if(response.status === "success"){

                        $('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');

                        $('form').each(function(){

                            this.reset();
                        })

                       // requestdata = $.parseJSON(response.array);
                       //parent.$.fancybox.close('#quotation');
                       //window.location.href =  "<?php echo site_url() ?>quotation/listing/";

                       //Open fancybox with tests methods.
                        var href = '<?php echo base_url()."quotation/stateComponents/".$quotation_no."/"; ?>' + "quotations" + "/" + "tests" + "/" + "q_request_details"
                        parent.$.fancybox.open({
                            href:href,
                            type: 'iframe',
                            autoSize:false,
                            autoDimensions:false,
                            width:700,
                            height:490,
                            'beforeClose':function(){
                                //getData();
                            }
                         })

                    }
                    else if(response.status === "error"){
                            alert(response.message);
                    }
                },
                error:function(){
                }
            })

            $(this).dialog("close");
        },
                "No":function(){
                    $(this).dialog("close");
                }
            }

        })         

        }
    })


    $(function() {
        $("#client_name").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('request_management/suggestions'); ?>",
                    data: {term: $("#client_name").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(e, ui) {
                var href = '<?php echo base_url()."request_management/getCodes/"; ?>'
                //console.log(href);
                $.getJSON( href + ui.item.value, function(codes) {
                    var codesarray = codes;
                    console.log(codesarray);
                    for (var i = 0; i < codesarray.length; i++) {
                        var object = codesarray[i];
                        for (var key in object) {

                            var attrName = key;
                            var attrValue = object[key];

                            switch (attrName) {

                                case 'id':

                                $('#client_id').val(attrValue);

                                 var options_href = '<?php echo base_url()."quotation/getQuotationNos/"; ?>'+ attrValue
                                    console.log(options_href);
                                        $.getJSON(options_href, function(options){

                                            var options_array = options;
                                            console.log(options_array);
                                            var o_array = ["<option value = 'New' >New</option>"];
                                            for(var i = 0; i < options_array.length; i++){
                                                o_array.push("<option value ='"+options_array[i].Quotation_no+"'>"+options_array[i].Quotation_no+"</option>");
                                            }

                                            select_elem = "<select name = 'quotation_no' >"+o_array+"</select>";
                                            li_elem = "<li><fieldset><legend>Quotation No.</legend><li><label><span>Quotation No</span>"+select_elem+"</label></li></fieldset></li>";
                                            
                                            console.log(li_elem);

                                            $('#quotation_ul > li:eq(1)').html(li_elem);
                                    })

                                break;

                                case 'email':

                                $('#client_email').val(attrValue);

                                break;

                            }
                        }        
                    }
                })        
            }
        })
    })

})
</script>
</html>