<head> 
    

    <title><?php echo $title;?></title>
    <script src="<?php echo base_url() . 'Scripts/jquery-1.10.2.js' ?>"></script>
    <script src="<?php echo base_url() . 'Scripts/migrate.js' ?>"></script>
    <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
<script src="<?php echo base_url().'Scripts/jquery-ui.js'?>" type="text/javascript"></script> 
    <script type="text/javascript">
        $(document).ready(function() {
            $('textarea,select,input').prop('readonly','readonly');
             $('textarea,select,input').prop('disabled','disabled');
            user_type = "<?php echo $this->session->userdata('usertype_id'); ?>";
                  determnined_class = $('select.det');
            complies ='The sample complies with the specifications of the tests perfomed.';
            does_not_comply ='The sample does not comply with the specifications of the tests perfomed.';

            $('select.det').change( function() {
                var selectedVals = $(determnined_class).map(function() {
                    return this.value;
                }).get().join(',');
                var data = selectedVals;
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
                  


            }).trigger('change');
          
            
              coa_status = "<?php echo $coa_stat;?>";
           if(coa_status =='1'){
               $('#genCOA').prop('disabled', true);
           }

            var i = 1;
            var temp_array = new Array();
            temp_array[1] = "method";
            temp_array[2] = "compedia";
            temp_array[3] = "specification";
            temp_array[4] = "determined";
            temp_array[5] = "complies";

            // $.each(temp_array,function(k,v){

            // });

            $('.addNew').live('click', function() {
                var count_val = 1;
                $(this).closest('tr').find('td').each(function(i, v) {
                    var count = parseFloat($(this).closest('td').parent()[0].sectionRowIndex) - 1;
                    if (i > 2) {
                        $('<textarea class="clone"  id="p_new' + i + '" rows="1" cols="10" name=' + temp_array[count_val] + '_' + count + '[]" value="" placeholder="I am New" ></textarea><a href="#" class="remNew">-</a>').appendTo(v);
                        count_val++;
                    }
                });

                // $('<tr class="clone"><td><textarea  id="p_new' + i + '" rows="1" cols="10" name="determined_'+count+'[]" value="" placeholder="I am New" ></textarea><a href="#" class="remNew">-</a><td> </tr>').appendTo($(this).parent('td'));


                return false;
            });

            $('.remNew').live('click', function() {
                $(this).closest('tr').find('.clone').each(function(i, v) {
                    //if(i>0){
                    v.remove();
                    // $("._rows").current().find(".clone").remove();
                    //}
                });
                //return false;
            });
            //  tinymce.init({ selector: "textarea"});


            $('#genCOA').click(function() {
                $(this).prop('value', 'Processing....');
                $(this).prop('disabled', 'disabled');
                postData = $('#COAF').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Successfully Generated ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                        $('#genCOA').prop('value', 'Generate');
                                        $('#genCOA').prop('disabled', false);
                                      
                                    window.location.href = "<?php echo base_url() . 'directors/superDirector'; ?>";                                        return true;
             
                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
                            $('#Back').click(function() {

                                
                                

                                    window.location.href = "<?php echo base_url() . 'analyst_controller/'; ?>";
                               
                            });

                        });
          
                        
                        $(function() {
        $(".methods").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('coa/method_suggestions'); ?>",
                    data: {term: $(".methods").val()},
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
        $("#findings").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/Findings_suggestions'); ?>",
                    data: {term: $("#findings").val()},
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
        $("#procedure").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/procedure_suggestions'); ?>",
                    data: {term: $("#procedure").val()},
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
    </script>
    <style type="text/css">
        #conc{
            width:700px;
            height:40px;
        }
        #COA_BODY{
            margin-top: 120px;
        }
        #COA{
            padding-right:25px;
            padding-left:25px;

        }
        #temp_table td{
            border: 1px solid black;
        }

        #side{
            background-color:#CCCCCC;
            font-size:11px;

        }
        #top_row{
            background-color:#CCCCCC;
        }
        table { 
            border-collapse:collapse;

        }
        p{
            margin-bottom: 0px;
            font-weight: bolder;
        }
        #label_name{
            font-size:11px;
        }
        #wording{
            font-size: 10px;
        }
        textarea {
            vertical-align:middle;
            font-size: 12px;

        }
        .det{
            font-weight: bold;
        }

        #hes{
            font-type: Book Antiqua;
            font-weight: bolder;
            font-size: 12px;
        }
        #signatories{
            font-size: 10px;
        }
        textarea { 
            font-type:Book Antiqua;
            font-size: 12px;
            width: 130px;
            height: 60px;
        } 

        #COA_AREA{
            width:99.5%;
            height: auto;
            background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* IE10+ */
            background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid black;
            box-shadow: 3px;
            font-size: 12px;
            font-type:Book Antiqua;

        }
        #content{
            margin: 10px;
        }

        form input,select,textarea,button {
            //width: 70%;
            padding: 5px;
            border: 1px solid #d4d4d4;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 4px;

            line-height: 1.5em;
            //float: right;

            /* some box shadow sauce :D */
            box-shadow: inset 0px 2px 2px #ececec;
        }
        form input:focus {
            /* No outline on focus */
            outline: 0;
            /* a darker border ? */
            border: 1px solid #bbb;
        }
        #coa_top{
            // background-color: blue;
            width:867.5px;
            height:300px;
        }
        #coa_top_table{
            width:784px;
            height: 300px;
        }
        #top_head{
            width:100px;
        }
        #middle_head{
            width:100px;

        }
        #top_row{
            height: 50px;
        }
        #p_name{
            float: right;
            margin-right: 50px;
        }
        .left_c{
            width:100px;
            margin-left: 5px;
           
        }

    </style>
</head>

<div id="COA_AREA">
    <form action="" id="COAF" method="post">   
        <center><div id="content">
                <center><p><?php echo 'CERTIFICATE OF ANALYSIS'; ?></p><br></center>
                <center><?php echo 'CERTIFICATE No: CAN/' . date('Y') . '/' . $coa_number[0]->number; ?></center>
                <p></p>
                <p>
                <div id="coa_top">

                    <table id="coa_top_table">
                        <tr id="top_row">
                            <td id="top_head" height="25" align="center" valign="middle"><span >PRODUCT</span></td>
                            <td id="middle_head" align="left" colspan="2"><?php echo $information[0]->product_name; ?><span id="p_name">REF. NO: &nbsp;<?php echo $information[0]->request_id; ?></span></td>
    
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>DATE RECEIVED</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>LABEL CLAIM</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="labelclaim"><?php echo $information[0]->label_claim; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><?php echo $information[0]->designation_date; ?></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>BATCH NO.</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>PRESENTATION</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="presentation"><?php echo $information[0]->presentation; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><?php echo $information[0]->batch_no; ?></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"> <span>MGF. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>MANUFACTURER</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="manufacturer"><?php echo $information[0]->manufacturer_name; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><?php echo $information[0]->manufacture_date; ?></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>EXP. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>ADDRESS</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="address"><?php echo $information[0]->manufacturer_add; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><?php echo $information[0]->exp_date; ?></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side">&nbsp;</td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>CLIENT</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="client"><?php echo $information[0]->name . " " . $information[0]->address; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><span>CLIENT REF NO</span></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" valign="middle" id="side"><?php echo $information[0]->clientsampleref; ?></td>
                            <td align="left" valign="bottom" id="label_name"><span>TEST(S) REQUESTED</span></td>
                            <td align="left" valign="bottom" id="wording"><?php echo $tests_requested; ?></td>
                        </tr>
                    </table>
                </div>

                <p></p>
                <p></p><br>
                
                <p></p>
                <div id="COA_BODY">
                    <center> <p>
                        <strong>RESULTS</strong>
                    </p></center>
                    <table width="490" height="278" border="1" id="temp_table">
                        <tr align="center" valign="middle">
                            <td height="34" align="center" valign="middle" id="side"><span>TEST</span></td>
                            <td align="center" valign="middle"><span id="hes">METHOD</span></td>
                            <td align="center" valign="middle"><span id="hes">COMPEDIA</span></td>
                            <td align="center" valign="middle"><span id="hes">SPECIFICATION</span></td>
                            <td align="center" valign="middle"><span id="hes">DETERMINED</span></td>
                            <td align="center" valign="middle" id="side"><span>REMARKS</span></td>
                        </tr>

                        <?php
                        for ($i = 0; $i < count($trd); $i++) {

                            foreach ($coa_details as $coa) {

                                if ($coa->test_id == $trd[$i]->test_id) {
                                    $determined = $coa->determined;
                                    $remarks = $coa->verdict;
                                }
                            }
                            ?>

                            <tr class="_rows">
                                <?php if($trd[$i]->test_id==2){?>
                                <td height="56"  rowspan="<?php count($determined);?>" align="center" valign="middle" id="side"><?php echo $trd[$i]->name ?>
                                    <input type="hidden" name="tests[]" value="<?php echo $trd[$i]->test_id ?>"/>
                                </td>
                                <?php }else{?>                                
                                  <td height="56"  align="center" valign="middle" id="side"><?php echo $trd[$i]->name ?>
                                    <input type="hidden" name="tests[]" value="<?php echo $trd[$i]->test_id ?>"/>
                                </td>
                                <?php } ?>

                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->methods);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="method_' . $i . '[]" value="" class="det methods" placeholder="Input Value" >' . trim($option)
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>
                                </td>
                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->compedia);

                                    foreach ($myvals as $option) {
                                        //$newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="compedia_' . $i . '[]" value="" class="det" placeholder="Input Value" >' . trim($option)
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>
                                </td>

                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->specification);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="specification_' . $i . '[]" value="" class="det" placeholder="Input Value" >' . $option
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>
                                </td>
                                <td align="center" valign="middle" id="addinput">

                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->determined);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="determined_' . $i . '[]" value="" class="det" placeholder="Input Value" >' . $option
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>



                                </td>
                                <td align="center" valign="middle" id="side">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->complies);

                                    foreach ($myvals as $option) {
                                        ?>

                                        <select  id="<?php echo $j; ?>" name="complies_<?php echo $i; ?>[]"  class="det" selected="selected" >
                                            <option value="<?php echo str_replace("_", " ", $option); ?>"><?php echo str_replace("_", " ", $option); ?></option>
                                            <option value="COMPLIES">COMPLIES</option>
                                            <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>
                                        </select>
                                        <?php
                                        $j++;
                                    }
                                    ?>
                                </td>
                            </tr>
                            </tr>
<?php }; ?>

                    </table>
                </div>

                <p>
                    <label>Conclusion: &nbsp;</label><label id="side"><input type="text" id="conc" name="conclusion" value="<?php echo $conclusion[0]->conclusion; ?>"/></label>
                </p>
                <p>
                <table id="signatories" >
<?php foreach ($signatories as $signatures): ?>            
                        <tr>            
                            <td><?php echo $signatures->designation; ?>:</td>
                            <td><?php echo $signatures->signature_name; ?></td>
                            <td><?php echo $signatures->sign; ?></td>
                            <td>DATE: <?php echo $signatures->date_signed; ?></td>
                        </tr>
<?php endforeach; ?>
                </table>
                <input type="button" value="Back" id="Back" name="genBack"/>
            
        </center>        
    </form>
    <br>

</div>




