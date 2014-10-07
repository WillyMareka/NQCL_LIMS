<script>
    $(document).ready(function() {

        labref = '';
        test_id = '';
        worksheet = '';
        created_at = '';
        product_name = '';

        $('#sheets').click(function() {
            $.fancybox({
                href: "#labrefs"
            });

            $('#labref_picker').change('live', function() {
                value = $('#labref_picker option:selected').val();
                $('#lab').val(value);
                if (value !== "") {
                    $.fancybox.close();

                    $.fancybox({
                        href: "#worksheet"
                    });
                } else {
                    alert('Kindly pick a labref first');
                    return false;
                }
            });

            $('.worksheet-Download').click(function() {
                labref = $('#lab').val();
                pdf_name = $(this).attr('id');
                $.ajax({
                    type: 'get',
                    url: "<?php echo base_url() . 'analyst_controller/checkIfWorksheetExists_extra/'; ?>" + labref + '/' + pdf_name,
                    success: function() {
                        window.location.href = "<?php echo base_url() . 'generated_custom_sheets/' ?>" + labref + '_' + pdf_name + '.pdf';
                    }, error: function(e) {
                        alert('an error occured ' + e);
                    }
                });

            });
        });


        $('.download').click(function() {

            labref = $(this).attr('id');
            test_id = $(this).attr('data-test_id');
            worksheet = $(this).attr('data-worksheet');
            created_at = $(this).attr('data-time');
            product_name = $(this).attr('data-product');  
            $('#rid').val(labref);
            $('#tid').val(test_id);
           
            
            $.ajax({
                type:"post",
                url: "<?php echo base_url()?>Sample_issue/getCompendiaStatus/"+labref+"/"+test_id,
                dataType:'json',
                            success: function(response) {

                                if (response.status === '0') {
                                    $.fancybox({
                                        href: "#dialog-c1",
                                        modal: true
                                    });
                                } else {
                                    $.ajax({
                                        type: "post",
                                        url: "<?php echo base_url(); ?>Sample_issue/getSampleInsuanceStatus/" + labref + "/" + test_id,
                                        dataType: 'json',
                                        success: function($data) {
                                            console.log($data.rows);
                                            if ($data.rows === '0') {
                                                $.fancybox({
                                                    href: "#dialog-c",
                                                    modal: true
                                                });
                                            } else {
                                            }
                                        }, error: function() {

                                        }
                                    });
                                }

                            }, error: function() {

                            }
                        });
            
                  
          
            

            $.getJSON("<?php echo base_url() . 'analyst_controller/getmicronumber/'; ?>" + labref, function(number) {
                $('#micro_lab_number').val('BIOL/' + number[0].number + '/' + number[0].year);
            });


            $('#sample_name').val(product_name);
            $('#date_recieved').val(created_at);
            $('#test_id').val(test_id);
            
      

            $.fancybox({
                href: "#Micro_details"
            });
   
});
        $('#Save_data').click(function() {
            $(this).prop('value','Preparing Download, Please Wait....');
               $(this).prop('disabled','disabled');
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>analyst_controller/checkMicrobiology/" + labref + "/" + worksheet,
                data: $('#micro_details').serialize(),
                success: function(data) {
                    if (test_id == '50') {
                        window.location.href = "<?php echo base_url(); ?>microbio_worksheets/" + labref + "_microlal.xlsx";
                    } else {
                        window.location.href = "<?php echo base_url(); ?>microbio_worksheets/" + labref + "_micro.xlsx";
                    }

                   // setInterval(function() {
                        //  window.location.href="<?php echo base_url(); ?>microbio_worksheets/"+labref+"_micro.xlsx";
                        //window.location.href = "<?php echo base_url(); ?>analyst_controller/";
                  //  }, 1000);
                },
                error: function() {

                }

            });
        });

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

            value = 1;
            year = new Date().getFullYear();
            padded_id = addLeadingZeros(value, 3);
            nqcl_ = "BIOL/" + padded_id + "/" + year;
            // $('#micro_lab_number').val(nqcl_);
            //  console.log(nqcl_);

            $("#date_test_set").datepicker({
                dateFormat: "d/m/yy",
                minDate: 0
            });

            $('#no_of_days').focusout(function() {
                days = parseInt($(this).val());
                new_date = moment().add('d', days).format("DD/MM/YYYY");
                $('#date_of_result').val(new_date);
            });

            $('#component').keyup(function() {
                $('#labelclaim').val($(this).val());
            });







        });

    });
</script>
<legend><a href="<?php echo base_url(); ?>" ></a>  <a href="<?php echo base_url(); ?>analyst_labreference" ><span class="blink_me">Download Workbook</span></a> || <a href="<?php echo base_url(); ?>analyst_controller/loadfinal/" >Completed Test</a> || <a href="<?php echo base_url() . 'final_certificate/'; ?>"> View COA</a><div style="float: right;"><a href="#labrefs" id="sheets">Download Custom Worksheet</a></div></legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }
    label{
        display: block;
    }
    #Micro_details{
        width:500px;
        height: Auto;
        display: none;
    }
    #unit,#qty{
        width:50px;
        text-align: center;
    }
    input[type=text]{
        width:300px;
    }

.blink_me {
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
    
    -moz-animation-name: blinker;
    -moz-animation-duration: 1s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;
    
    animation-name: blinker;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@-moz-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}



</style>
<div id="dialog-c" style="width: 200px; height: 200px; display: none;">
    What
</div>

                   <div id="dialog-c1" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px; width:230px;">
<?php $this->load->view('compendia_v_1_1'); ?>
</div>


<div id="Micro_details">
    <form id="micro_details" name="">

        <label>SAMPLE NAME :</label>
        <input type="text" name="sample_name" id="sample_name"/>
        <p></p>
        <label>MICROBIOLOGY LAB No:</label>
        <input type="text" name="micro_lab_number" id="micro_lab_number"/>
        <p></p>
        <label>ACTIVE INGREDIENT:</label>
        <input type="text" name="component" id="component"/>
        <p></p>
        <label>LABEL CLAIM:</label>
        <input type="text" name="labelclaim" id="labelclaim"/>
        <p></p>
        <label>DATE RECEIVED:</label>
        <input type="text" name="date_recieved" id="date_recieved"/>
        <p></p>        
        <label>DATE TEST SET:</label>
        <input type="text" name="date_test_set" id="date_test_set"/>
        <p></p>
        <label>No of Days:</label>
        <input type="number" name="no_of_days" id="no_of_days"/>
        <p></p>
        <label>DATE OF RESULTS:</label>
        <input type="text" name="date_of_result" id="date_of_result"/>
        <input type="hidden" name="test_id" id="test_id"/>

        <p>
            <input type="button" value="Submit" id="Save_data"/>
        </p>
    </form>

</div>

<div id="labrefs" style="display: none; width: auto; height: 50px;">
    <select name="labref" id="labref_picker">
        <option value="">-Select Labref No.-</option>
        <?php foreach ($labrefs as $labref): ?>
            <option value="<?php echo $labref->lab_ref_no; ?>"><?php echo $labref->lab_ref_no; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<input type="hidden" name="lab" id="lab"/>
<div id="worksheet" style="display: none; width: 850px; height: auto;">
    <form>
        <table id = "sheets_table">

            <thead><tr><!--th>No.</th-->
                    <th>Worksheet Name</th>
                    <th>Download</th>
                </tr>
            </thead>
            </tbody>
            <?php foreach ($sheets as $sheet): ?>
                <tr>          
                    <td><?php echo $sheet->name; ?></td><td><a href="#custom-worksheet" class="worksheet-Download" id="<?php echo ucfirst($sheet->alias); ?>">Download</a></td>            
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>

<table id = "analystable">

    <thead><tr><!--th>No.</th-->
            <th>Lab Reference Number</th>
            <th>Test Name</th>
            <th>View Worksheet</th>
            <th>Status</th>
            <th>Repeat Download</th>
            <th>Upload Repeat</th>
<!--            <th>is OOS?</th>-->
<!--            <th>priority</th>-->
<!--            <th>Review Status</th>-->
        </tr>
    </thead>

    <tbody>
        <?php $session = $this->session->userdata('data');
        ?>


        <?php foreach ($tests_assigned as $test) { ?>


            <?php
            $test_id = $test->Test_id;
            $lab_ref_no = $test->Lab_ref_no;
            $done_status = $test->done_status;
            $priority = $test->priority;
            $oos = $test->do_count;
            $review_status = $test->review_status;
            $worksheet = Tests::getWorksheet($test_id);
            $upload_status = $test->upload_status;
            $worksheet_name = $worksheet[0]['Alias'];


            $products = Request::getProducts($lab_ref_no);

            $product_name = $products[0]['product_name'];

            $status_check = Sample_issuance::getStatus($lab_ref_no, $test_id);

            $status = $status_check[0]['Status_id'];

            if ($status != 3) {
                ?>

                <tr class="sample_issue">
                        <!--td class="numbering" ><span class="bold number" id="number" ></span></td-->
                    <td class="common_data" ><span class="green_bold" id="labref" ><?php echo $test->Lab_ref_no ?>  &#187 Product Name: <?php echo $product_name ?>  &#187 Quantity Issued: <?php echo $test->Samples_no ?> &#187 Date & Time Issued: <?php echo $test->created_at ?></span> &#187 <?php if ($priority === '1') { ?>
                        - Priority &#187 <span id="high" class="blink_me" style="background: red; font-weight: bolder; color: white;">High</span>
                        <?php } else { ?>
                            - Priority &#187   <span id="low">Low</span> 
                        <?php } ?></td>
                    <td><span><?php echo ucfirst(str_replace("_", " ", $worksheet_name)) ?></span></td>
                    <td><a href='<?php echo site_url() . $worksheet_name . "/worksheet/" . $lab_ref_no . "/" . $test_id ?>' class = '<?php
                        if ($test->desc_status == '0') {
                            echo "view";
                        } else if ($test->desc_status == '1') {
                            if ($test_id == '2' || $test_id == '5' || $test_id == "1" || $test_id == "26") {
                                if ($test->component_status == "0") {
                                    echo "components";
                                } else if ($test->component_status == "1") {
                                    if ($test->method_status == "0") {
                                        echo "methods";
                                    } else {
                                        if ($test->equip_status == "0") {
                                            echo "equip";
                                        } else {
                                            if ($test->chroma_status == "0") {
                                                echo "chroma";
                                            } else {
                                                if ($test->compendia_status == "0") {
                                                    echo "compendia";
                                                } else {
                                                    echo "";
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    if ($test->equip_status == "0") {
                                        echo "equip";
                                    } else {
                                        if ($test->compendia_status == "0") {
                                            echo "compendia";
                                        } else {
                                            echo "";
                                        }
                                    }
                                }
                            }
                        }
                        ?>' data-labref = '<?php echo $test->Lab_ref_no ?>' data-test ='<?php echo $worksheet_name ?>' data-testid = '<?php echo $test_id; ?>'  ><?php
                        if ($test->desc_status == "1") {
                            if ($test->component_status == "0") {
                                echo "Specify Components";
                            } else {
                                if ($test_id > 30) {
                                    echo "";
                                } else {
                                    echo 'View Worksheet';
                                }
                            }
                        } else {
                            echo "Add Description";
                        }
                        ?></a></td>
                               <?php if ($done_status == '1') { ?>
                                   <?php if (($test_id == '12' && $upload_status == '0') || ($test_id == '22' && $upload_status == '0') || ($test_id == '26' && $upload_status == '0') || ($test_id == '28' && $upload_status == '0')) { ?>
                            <td style="background: yellow; font-weight: bold; text-decoration: blink;"  ><a href="<?php echo base_url() . $worksheet_name . '/uploadSpace/' . $lab_ref_no . '/' . $test_id; ?>">Upload Worksheet</a></td>
                                   <?php } else if (($test_id == '12' && $upload_status == '1') || ($test_id == '22' && $upload_status == '1') || ( $test_id == '26' && $upload_status == '1') || ($test_id == '28' && $upload_status == '1')) { ?>
                            <td style="background: greenyellow; font-weight: bold;">Done</td>
                                <?php } else if (($test_id > '30' && $upload_status == '1')) { ?>
                            <?php if($test_id=='49'){ ?>
                            <td style="background: greenyellow; font-weight: bold;">Done | &#187 <a class="download " href="#<?php //echo base_url() . 'analyst_controller/checkIfWorksheetExists_extra/' . $lab_ref_no . '/' . $worksheet_name . '/' . $test_id; ?>" id="<?php echo $lab_ref_no; ?>" data-worksheet="<?php echo $worksheet_name; ?>" data-test_id="<?php echo $test_id; ?>" data-product="<?php echo $product_name; ?>" data-time="<?php echo $test->created_at ?>">Download</a> | &#187 <a href="<?php echo base_url() . 'analyst_controller/upload_microbial_assay/' . $lab_ref_no . '/' . $test_id; ?>">Upload Microbial Assay Worksheet</a></td>
                            <?php } else if($test_id=='50'){?>  
                           <td style="background: greenyellow; font-weight: bold;">Done | &#187 <a class="download " href="#<?php //echo base_url() . 'analyst_controller/checkIfWorksheetExists_extra/' . $lab_ref_no . '/' . $worksheet_name . '/' . $test_id; ?>" id="<?php echo $lab_ref_no; ?>" data-worksheet="<?php echo $worksheet_name; ?>" data-test_id="<?php echo $test_id; ?>" data-product="<?php echo $product_name; ?>" data-time="<?php echo $test->created_at ?>">Download</a> | &#187 <a href="<?php echo base_url() . 'analyst_controller/upload_micro_be/' . $lab_ref_no . '/' . $test_id; ?>">Upload Bacterial Endotoxin Worksheet</a></td>

                            <?php } ?>
                                <?php } else { ?>
                            <td style="background: greenyellow; font-weight: bold;">Done</td>
                        <?php } ?>

                    <?php } else { ?>
                        <td style="background: yellow; font-weight: bold; "><strong>(Not Done Yet) <?php if ($test_id == '12' || $test_id == '22' || $test_id == '26' || $test_id == '28') { ?>
                                    &#187 <a href="<?php echo base_url() . 'analyst_controller/checkIfWorksheetExists/' . $lab_ref_no . '/' . $worksheet_name . '/' . $test_id; ?>">Download</a>                     
                        <?php } else if ($test_id > '30') { ?> 
                                    &#187 <a class="download " href="#<?php //echo base_url() . 'analyst_controller/checkIfWorksheetExists_extra/' . $lab_ref_no . '/' . $worksheet_name . '/' . $test_id; ?>" id="<?php echo $lab_ref_no; ?>" data-worksheet="<?php echo $worksheet_name; ?>" data-test_id="<?php echo $test_id; ?>" data-product="<?php echo $product_name; ?>" data-time="<?php echo $test->created_at ?>">Downloadk</a> </td>                     
                            <?php
                            echo '';
                        }
                        ?>
                        </strong></td>
                    <?php } ?>
                    <?php
                    if ($done_status == '1') {
                        if (($test_id != '12' && $upload_status == '0') || ($test_id != '22' && $upload_status == '0') || ($test_id != '26' && $upload_status == '0') || ($test_id != '28' && $upload_status == '0')) {
                            ?>
                            <td>  &#187 <a href="<?php echo base_url() . 'analyst_controller/checkIfWorksheetExists/' . $lab_ref_no . '/' . $worksheet_name . '/' . $test_id; ?>">Download</a>                     
                            </td>
                            <td style="background: yellow; font-weight: bold; text-decoration: blink;"  ><a href="<?php echo base_url() . $worksheet_name . '/uploadSpace/' . $lab_ref_no . '/' . $test_id; ?>">Upload Worksheet</a></td>
                        <?php } else { ?>
                            <td></td>
                            <td></td>
            <?php } ?>

                    <?php } else { ?>
                        <td></td>  
                        <td></td>  

                    <?php }; ?>


                </tr>


    <?php } ?>

<?php } ?>

    </tbody>

</table>





<div id = "fancybox_desc" class = "hidden2" >
    <fieldset class = "noborder" >
        <div><legend>Sample Information&nbsp;&rarr;&nbsp;<span id = "labrefno1" ></span></legend></div>
        <div class = "clear">&nbsp;</div>
        <div><hr></div>
        <div id = "sample_info" class = "clear" >

            <span class = "hidden2"  id = "worksheet" ></span>
            <span class = "hidden2"  id = "test_id" ></span>

            <div class = "clear graybg" >
                <div class = "left_align" >
                    <label class = "misc_title" >Lab Reference No.</label>
                </div>
                <div class = "right_align" >
                    <span id = "labrefno"></span>
                </div>
            </div>
            <div class = "clear" >
                <div class = "left_align" >
                    <label class = "misc_title" >Product Name</label>
                </div>
                <div class = "right_align" >
                    <span id = "product_name"></span>
                </div>
            </div>
            <div class = "clear graybg" >
                <div class = "left_align" >
                    <label class = "misc_title" >Dosage Form</label>
                </div>
                <div class = "right_align" >
                    <span id = "dosage_form"></span>
                </div>
            </div>
            <div class = "clear" >
                <div class = "left_align" >
                    <label class = "misc_title" >Label Claim</label>
                </div>
                <div class = "right_align" >
                    <span id = "label_claim"></span>
                </div>
            </div>
            <div class = "clear graybg " >
                <div class = "left_align" >
                    <label class = "misc_title" >Active Ingredients</label>
                </div>
                <div class = "right_align" >
                    <span id = "active_ing"></span>
                </div>
            </div>
            <div class = "clear graybg" >
                <div class = "left_align" >
                    <label class = "misc_title" >Manufacturer Name</label>
                </div>
                <div class = "right_align" >
                    <span id = "manf_name"></span>
                </div>
            </div>
            <div class = "clear" >
                <div class = "left_align" >
                    <label class = "misc_title" >Manufacturer Address</label>
                </div>
                <div class = "right_align" >
                    <span id = "manf_address"></span>
                </div>
            </div>
            <div class = "clear graybg" >
                <div class = "left_align" >
                    <label class = "misc_title" >Manufacture Date</label>
                </div>
                <div class = "right_align" >
                    <span id = "manf_date"></span>
                </div>
            </div>
            <div class = "clear" >
                <div class = "left_align" >
                    <label class = "misc_title" >Expiry Date</label>
                </div>
                <div class = "right_align" >
                    <span id = "exp_date"></span>
                </div>
                <input id = "testid" type = "hidden"  />
                <input id = "labref" type = "hidden"  />
            </div>
        </div>
        <div class = "clear">&nbsp;</div>
        <div><hr></div>
        <form id = "prod_presentation" >
            <fieldset>
                <legend>Add Product Presentation and Product Description</legend>
                <div class = "clear" >  
                    <label class = "misc_title" >Product Description</label>
                </div>
                <div class ="clear">
                    <textarea name="description" class = "chromaconditions" id="product_desc" title="Describe how product looks like"  ></textarea>
                </div>
                <div class = "clear">
                    <label class = "misc_title" >Product Presentation</label>
                </div>
                <div class = "clear" >
                    <textarea type="text" name="presentation" class = "chromaconditions"  title="Describe how product is presented, Viles, Tablets e.t.c"   ></textarea>
                </div>
            </fieldset>
    </fieldset>
    <div class = "left_align" >
        <input type="submit" class="submit-button left_align" value="Save" />   
    </div>
    <input type = "hidden" name = "worksheet_url" id ="worksheet_url"  />
</form>
</div>

   

<script src="<?php echo base_url(); ?>javascripts/moments.js?1500" type="text/javascript"></script>



<script type="text/javascript">
    $(function() {

        $('#analystable').dataTable({
            "bLengthChange": false,
            "bPaginate": false,
              stateSave: true,
            "bJQueryUI": true
        }).rowGrouping({
            bExpandableGrouping: true,
            bExpandSingleGroup: false,
            iExpandGroupOffset: -1,
            asExpandedGroups: [""]
        });

        $('#sheets_table').dataTable({
            "bJQueryUI": true
        });

        $('.view').live('click', function(e) {
            e.preventDefault();
            var labref = $(this).attr("data-labref");
            test = $(this).attr("data-test");
            test_id = $(this).attr("data-testid");
            worksheet_url = $(this).attr("href");
            $('#worksheet').text(test)
            $('#testid').val(test_id);
            $('#labref').val(labref);
            $('#worksheet_url').val(worksheet_url);
            //$.sessionStorage('worksheet_url', {data:worksheet_url});

            $.getJSON('<?php echo base_url() ?>' + "request_management/getRequest/" + labref, function(request_data) {
                $("#product_name").text(request_data[0].product_name);
                $("#labrefno").text(request_data[0].request_id);
                $("#labrefno1").text(request_data[0].request_id);
                $("#dosage_form").text(request_data[0].Packaging.name);
                $("#label_claim").text(request_data[0].label_claim);
                $("#active_ing").text(request_data[0].active_ing);
                $("#manf_name").text(request_data[0].Manufacturer_Name);
                $("#manf_address").text(request_data[0].Manufacturer_add);
                $("#manf_date").text(request_data[0].Manufacture_date);
                $("#exp_date").text(request_data[0].exp_date);
            })

            $.fancybox.open('#fancybox_desc');
        })

        $('.methods').live('click', function(e) {
            e.preventDefault();
            labref = $(this).attr("data-labref");
            test_id = $(this).attr("data-testid")
            var m_href = '<?php echo base_url() . "request_management/showComponents/" ?>' + labref + "/" + test_id;
            console.log(m_href);
            $.fancybox.open({
                href: m_href,
                type: 'iframe',
                autosize: false,
                beforeClose: function() {
                    //Close fancyBox and redirect to Method Worksheet
                    $('.fancybox-inner').unwrap();
                    href1 = '<?php echo base_url() ?>' + $('#worksheet').text() + "/" + "worksheet/" + $('#labrefno').text();
                    +"/" + $('#test_id').text();
                    //window.location.href = href1;
                },
                onClosed: function() {
                    alert("Do this on closed.");
                }
            });
            return true;

        })

        $('.components').live('click', function(e) {
            e.preventDefault();
            labref = $(this).attr("data-labref");
            test_id = $(this).attr("data-testid")
            var m_href = '<?php echo base_url() . "tests_controller/methods/" ?>' + test_id + "/" + labref
            console.log(m_href);
            $.fancybox.open({
                href: m_href,
                type: 'iframe',
                autosize: false,
                beforeClose: function() {
                    //Close fancyBox and redirect to Method Worksheet
                    $('.fancybox-inner').unwrap();
                    href1 = '<?php echo base_url() ?>' + $('#worksheet').text() + "/" + "worksheet/" + $('#labrefno').text();
                    +"/" + $('#test_id').text();
                    //window.location.href = href1;
                },
                onClosed: function() {
                    alert("Do this on closed.");
                }
            });
            return true;

        })

        $('.chroma').live('click', function(e) {
            e.preventDefault();
            labref = $(this).attr("data-labref");
            test_id = $(this).attr("data-testid");
            test_name = $(this).attr("data-test");
            var m_href = '<?php echo base_url() . "chroma_conditions/columns/" ?>' + test_id + "/" + labref + "/" + test_name;
            console.log(m_href);
            $.fancybox.open({
                href: m_href,
                type: 'iframe',
                scrolling: 'no',
                width: 340,
                autoScale: true,
                beforeClose: function() {
                    //Close fancyBox and redirect to Method Worksheet
                    $('.fancybox-inner').unwrap();
                    href1 = '<?php echo base_url() ?>' + $('#worksheet').text() + "/" + "worksheet/" + $('#labrefno').text();
                    +"/" + $('#test_id').text();
                    //window.location.href = href1;
                },
                onClosed: function() {
                    alert("Do this on closed.");
                }
            });
            return true;

        })

        $('.compendia').live('click', function(e) {
            e.preventDefault();
            labref = $(this).attr("data-labref");
            test_id = $(this).attr("data-testid");
            test_name = $(this).attr("data-test");
            var m_href = '<?php echo base_url() . "chroma_conditions/compendia/" ?>' + test_id + "/" + labref + "/" + test_name;
            console.log(m_href);
            $.fancybox.open({
                href: m_href,
                type: 'iframe',
                scrolling: 'no',
                width: 340,
                autoScale: true,
                beforeClose: function() {
                    //Close fancyBox and redirect to Method Worksheet
                    $('.fancybox-inner').unwrap();
                    href1 = '<?php echo base_url() ?>' + $('#worksheet').text() + "/" + "worksheet/" + $('#labrefno').text();
                    +"/" + $('#test_id').text();
                    window.location.href = href1;
                },
                onClosed: function() {
                    alert("Do this on closed.");
                }
            });
            return true;

        })


        $('.equip').live('click', function(e) {
            e.preventDefault();
            labref = $(this).attr("data-labref");
            test_id = $(this).attr("data-testid")
            test_name = $(this).attr("data-test");
            redirect_href = $(this).attr("href");
            var m_href = '<?php echo base_url() . "chroma_conditions/itemsUsed/" ?>' + labref + "/" + test_id + "/" + test_name;
            console.log(m_href);
            $.fancybox.open({
                href: m_href,
                type: 'iframe',
                autosize: false,
                beforeClose: function() {
                    //Close fancyBox and redirect to Method Worksheet
                    $('.fancybox-inner').unwrap();
                    //href1 = '<?php echo base_url() ?>' + $('#worksheet').text() + "/" + "worksheet/" + $('#labrefno').text(); + "/" + $('#test_id').text() ;
                    //window.location.href = href1;
                },
                onClosed: function() {
                    alert("Do this on closed.");
                }
            });
            return true;

        })



        $('#prod_presentation').submit(function(e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "request_management/setPresentationDescription/" ?>' + $('#labrefno').text();
            var testid = $("#testid").val();
            var lbref = $("#labref").val();
            console.log(testid);
            $.ajax({
                type: 'POST',
                url: href,
                data: $('#prod_presentation').serialize(),
                dataType: "json",
                success: function() {
                    $.fancybox.close('#fancybox_desc');

                    //Set href to get test methods
                    methods_href = '<?php echo base_url() . "tests_controller/methods/" ?>' + testid + "/" + lbref
                    console.log(methods_href);

                    //Open jWizard-formatted page (from a different page) in a fancyBox overlay
                    $.fancybox.open({
                        href: methods_href,
                        type: 'iframe',
                        autosize: false,
                        beforeClose: function() {
                            //Close fancyBox and redirect to Method Worksheet
                            $('.fancybox-inner').unwrap();
                            href1 = '<?php echo base_url() ?>' + $('#worksheet').text() + "/" + "worksheet/" + $('#labrefno').text();
                            +"/" + $('#test_id').text();
                            //window.location.href = href1;
                        },
                        onClosed: function() {
                            alert("Do this on closed.");
                        }
                    });
                    return true;
                }
            })
        })




    });





</script>

