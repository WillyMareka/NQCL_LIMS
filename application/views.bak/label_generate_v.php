<html>
    <form id = "print_label" class = "methods">
        <h3>Generate Labels</h3>
        <ul>
            <li>
                <fieldset>
                    <legend>Re No., No. of Prints</legend>
                        <li>
                            <label>
                                <span>Lab Ref. No.</span>
                                <input id = "reqid" name="reqid" class ="validate[required]" placeholder ="e.g NDQD2013A123" type="text" />
                            </label>
                        </li>
                        <li>
                            <label>
                                <span>Prints No.</span>
                                <input id = "no_of_prints" name="no_of_prints" class ="validate[required]" placeholder ="e.g 12" type="text" />
                            </label>
                        </li>
                </fieldset>
            </li>
        </ul>   
        <fieldset id = "test_fieldset">
            <legend><span>Tests Selection</span><span id ="ndqno" class = "label_ndqno"><?php echo $reqid ?></span></legend>
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
                                                echo "<tr id =" . $wetchem->id . " ><td>" . $wetchem->Name . "</td><td><input type=checkbox id=" . $wetchem->Alias . " name=test[] value='$wetchem->Name' title =" . $wetchem->Test_type . " /></td></tr>";
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
                                                echo "<tr id =" . $microbiology->id . "><td>" . $microbiology->Name . "</td><td><input type=checkbox id=" . $microbiology->Alias . " name=test[] value= '$microbiology->Name'  title =" . $microbiology->Test_type . " /></td></tr>";
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
                                                <?php echo "<tr id =" . $medical->id . "><td>" . $medical->Name . "</td><td><input type=checkbox id=" . $medical->Alias . " name=test[] value= '$medical->Name'  title =" . $medical->Test_type . " /></td></tr>";
                                                ?>

                                            <?php } ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- End Accrodion--> 
                    </tr>
                    <tr><td><hr /></td></tr>
             </table>
            </fieldset>
        <div class = "clear" >		
            <div class = "left_align">
                <input type ="submit" value="Print" class="submit-button" />
            </div>
        </div>

    </form>	
<script type="text/javascript">
   //window.jQuery(document).ready(function() {
    //Feed tests to <ul> 

    $('#print_label').submit(function(e){
        e.preventDefault();
        
        //Get array of checked tests - Stackoverflow
        var tests = $("#tests_table input:checkbox:checked").map(function(){
            return $(this).val();
        }).get(); // <----
        

        //Convert tests array to string
        var tests_string = JSON.stringify(tests);  

        //Replace commas with forward slashes
        tests_string2 = tests_string.replace(/[,]/g, "/");
        
        //Remove quotation marks and square brackets
        tests_string3 = tests_string2.replace(/[\[\]""]/g, "");

        //Replace spaces with underscores
        tests_string4 = tests_string3.replace(/ /g, "_");
        
        //Show contents of string.
        console.log(tests_string4)

        var gen_label_url = '<?php echo base_url()."request_management/getLabelPdf_standalone/" ?>' + $('#reqid').val() + "/" + $('#no_of_prints').val() + "/" + tests_string4;
        var generated_label_url = '<?php echo base_url()."labels/" ?>' + "Label" + $('#reqid').val() + ".pdf";
        console.log(gen_label_url);
        console.log(generated_label_url);
        $.ajax({
            type:'POST',
            url:gen_label_url,
            data: {testsArray: tests}
        }).done(function(response) {
                console.log(response);
                //parent.$.fancybox.resize();
                parent.$.fancybox.open({
                    href: generated_label_url,
                    type: 'iframe',
                    autoSize: false,
                    height: 842,
                    width: 595 
                });
            })
    })

    var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");
//});
</script>
</html>