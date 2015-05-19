<div id="main_wrapper"> 
    <head>
        <style type="text/css">
            table{
                border: #000000 1px solid;
                padding: 0px;
            }
            td{
                border: #000000 1px solid;

            }
            ul {
                list-style: none;
            }
            input[type=text]{
                text-align: center;
            }
            span#complies{
                font-family: sans-serif;
                color: white;
                background-color: blue;
                font-weight: bold;

            }
            span#dcomply{
                font-family: sans-serif;
                color: white;
                background-color: red;
                font-weight: bold;
            }
            span.span11{
                background-color: #F93;
                color: #F93;                
                width: 10px;
            }
            span.span12{
                background-color: #33ff33;
                color:#33ff33;
                width: 10px;
            }
            span.span13{
                background-color: #0FF;
                color:#0FF;
                width: 10px;
            }
            div#comments{
                text-align: left;
                background-color: white;
                border: 1px solid #000000;    
                width :41%;
                margin: 0 auto 0 auto;

            }
            .num,.num3,#av1,#totals,#calculatetabs{
                width: 100px;
                text-align: center;
                margin: 0 auto;
            }
            form input,select,textarea {
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
            #Individual_box{
                background: rgb(246,248,249); /* Old browsers */
                /* IE9 SVG, needs conditional override of 'filter' to 'none' */
                background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y2ZjhmOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjIwJSIgc3RvcC1jb2xvcj0iI2U1ZWJlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNWY3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
                background: -moz-linear-gradient(top,  rgba(246,248,249,1) 0%, rgba(229,235,238,1) 20%, rgba(245,247,249,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(20%,rgba(229,235,238,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-8 */
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 1px solid black;
                box-shadow: 3px;
            }


            /* Super! */
        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                
                $data = "<?php echo Sample_issuance::getCompendiaStatus($labref, $test_id);?>";
                console.log($data);
                if($data==='0'){
                    $.fancybox({
                        href:"#dialog-c",
                        modal:true
                    });
                }else{
                }

                $('input').live("keypress", function(e) {
                    /* ENTER PRESSED*/
                    if (e.keyCode === 13 || e.keyCode === 40) {
                        /* FOCUS ELEMENT */
                        var inputs = $(this).parents("form").eq(0).find(":input:visible:not(disabled):not([readonly])");
                        var idx = inputs.index(this);

                        if (idx === inputs.length - 1) {
                            inputs[0].select();
                        } else {
                            inputs[idx + 1].focus(); //  handles submit buttons
                            inputs[idx + 1].select();
                        }
                        return false;
                    }
                });


                repeat_no =<?php echo $repeat_no; ?>;
                if (repeat_no === 1) {
                    prompt_dialog();

                }


                $('#Export').click(function() {

                    var bad = 0;
                    $('#tabsForm :text').each(function()
                    {
                        if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                            bad++;
                    });
                    if (bad > 0) {
                        $.prompt(bad + ' value(s) are missing, ensure all fields are filled and that deviations have been calculated if they\n\
                    have not been calculated');
                    }
                    else {
                        $('#Export').prop('value','Saving, Please Wait....');
                         $('#Export').prop('disabled','disabled');
                        dataString2 = $('#tabsForm').serialize();

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>tabs/save_tablet_weights/<?php echo $labref.'/'.$test_id; ?>",
                                                data: dataString2,
                                                success: function() {
                                                    $.prompt("Saving Success!, Do you want to repeat this test?", {
                                                        title: "Repeat Request",
                                                        buttons: {"Yes, I want to repeat": 1, "No, Lets proceed": false},
                                                        focus: 1,
                                                        submit: function(e, v, m, f) {
                                                            // use e.preventDefault() to prevent closing when needed or return false. 
                                                            // e.preventDefault(); 
                                                            repeat_no =<?php echo $repeat_no; ?>;
                                                            if (v === 1) {

                                                                $('input:text').val('');
                                                                $("#com").attr("value", "");
                                                                $('span').css('display', 'none');
                                                                $('#Export').prop('value','Save Assay');
                                                                $('#Export').prop('disabled',false);
                                                                prompt_dialog();


                                                            } else {
                                                                $.prompt("Proceeding to Assay!");
                                                                window.location.href = "<?php echo base_url() . 'analyst_controller/' ?>";
                                                            }

                                                            console.log("Value clicked was: " + v);
                                                        }
                                                    });
                                                    //alert('Data Saved to the database and exported to the database');
                                                    // window.location.href="<?php echo base_url() . 'assay/assay_page/' . $labref; ?>";
                                                },
                                                error: function() {
                                                    $.prompt('An internal problem has been experienced, data could not be exported!');
                                                }



                                            });

                                        }

                                    });

                                    $('#sendit').click(function() {
                                        var data = $('#reason').serialize();
                                        $.ajax({
                                            type: 'post',
                                            url: '<?php echo base_url() . 'tabs/postRepeatReason/' . $labref; ?>',
                                            data: data,
                                            success: function(data) {
                                                alert(data);
                                            },
                                            error: function() {

                                            }


                                        })

                                        $('#dialog').trigger('close');
                                    });
                                    $('#cancelit').click(function() {
                                        window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";
                                    });

                                    function prompt_dialog() {
                                        $("#dialog").lightbox_me({
                                            closeClick: false,
                                            centered: true
                                        });
                                    }



                                });

        </script>


        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/jquery.validate.css?1500" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/style1.css?1500" />

        </script>

        <script src="<?php echo base_url(); ?>javascripts/jquery.validate.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>javascripts/jquery.validation.functions.js?1500" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>javascripts/tabs.js?1500" type="text/javascript"></script>
    </head>

    <p>
        <br>
         <br>
          <br>
           <br>
    <legend>  &#187; <?php echo anchor(base_url().'analyst_controller','Back')?></legend>
    <p>
    <center><legend><h2>NQCL &#187; Uniformity Testing - Tablets &#187; Sample: <?php echo $labref; ?> </h2></legend></center><hr>
    <div id="Individual_box">
        <?php $attributes = array('id' => 'tabsForm'); ?>
        <?php echo form_open('tabs/save_tablet_weights/' . $labrefuri, $attributes); ?> 
        <table id="TabsTabeUniformity"  border="0" align="center" cellpadding="0" cellspacing="0" class="dave-table">

            <tr>
                <td height="53"><div align="center">No.</div></td>
                <td  align="center" valign="middle"><p align="center">Tablets (mg)</p></td>
                <td valign="middle" colspan="2"><label id="calculatetabs" class="submit-button">Calc % dev</label></td>

            </tr>
            <tr>
                <td><div align="center">1</div></td>
                <td><input type="text" id="tcsv1" name="tcsv1" size="25" class="num" required tabindex="1" /></td>               
                <td><input type="text" id="dfm1"name=" dfm1" size="25" class="num3"  readonly="readonly"/></td>
                <td><span id="span11" style="display:none" class="span11">A</span><span id="span12" style="display:none"  class="span12">N</span>
                    <span id="span13" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">2</div></td>
                <td><input type="text" id="tcsv2" name="tcsv2" class="num" size="25" required tabindex="2" /></td>
                <td><input type="text" id="dfm2" name=" dfm2" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span21" size="25" style="display:none" class="span11">A</span><span id="span22" style="display:none" size="25"  class="span12">N</span><span id="span23" style="display:none"  class="span13">O</span></td>

            </tr>
            <tr>
                <td><div align="center">3</div></td>
                <td><input type="text" id="tcsv3" name="tcsv3"  class="num" size="25" required  tabindex="3"/></td>
                <td><input type="text" id="dfm3" name=" dfm3" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span31" size="25" style="display:none" class="span11">A</span><span id="span32" style="display:none" size="25"  class="span12">N</span><span id="span33" style="display:none"  class="span13">O</span></td>

            </tr>
            <tr>
                <td><div align="center">4</div></td>
                <td><input type="text" id="tcsv4" name="tcsv4" class="num" size="25" required tabindex="4"/></td>
                <td><input type="text" id="dfm4" name=" dfm4" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span41" size="25" style="display:none" class="span11">A</span><span id="span42" style="display:none" size=" 25" class="span12">N</span>
                    <span id="span43" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">5</div></td>
                <td><input type="text" id="tcsv5" name="tcsv5" size="25" class="num" required tabindex="5"/></td>

                <td><input type="text" id="dfm5" name=" dfm5" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span51" size="" style="display:none" class="span11">A</span><span id="span52" style="display:none" size=""  class="span12">N</span>
                    <span id="span53" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">6</div></td>
                <td><input type="text" id="tcsv6" name="tcsv6" size="25" class="num" required tabindex="6"/></td>                
                <td><input type="text" id="dfm6" name=" dfm6" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span61" size="" style="display:none" class="span11">A</span><span id="span62" style="display:none" size=""  class="span12">N</span>
                    <span id="span63" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">7</div></td>
                <td><input type="text" id="tcsv7" name="tcsv7" size="25" class="num" required tabindex="7"/></td>

                <td><input type="text" id="dfm7" name=" dfm7" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span71" size="" style="display:none" class="span11">A</span><span id="span72" style="display:none" size=""  class="span12">N</span>
                    <span id="span73" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">8</div></td>
                <td><input type="text" id="tcsv8" name="tcsv8" size="25" class="num"  required tabindex="8"/></td>

                <td><input type="text" id="dfm8" name=" dfm8" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span81" size="" style="display:none" class="span11">A</span><span id="span82" style="display:none" size=""  class="span12">N</span>
                    <span id="span83" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">9</div></td>
                <td><input type="text" id="tcsv9" name="tcsv9" size="25" class="num"  required tabindex="9"/></td>

                <td><input type="text" id="dfm9" name=" dfm9" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span91" size="" style="display:none" class="span11">A</span><span id="span92" style="display:none" size=""  class="span12">N</span>
                    <span id="span93" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">10</div></td>
                <td><input type="text" id="tcsv10"  name="tcsv10" class="num" size="25" required tabindex="10"/></td>

                <td><input type="text" id="dfm10" name=" dfm10" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span101" size="" style="display:none" class="span11">A</span><span id="span102" style="display:none" size=""  class="span12">N</span>
                    <span id="span103" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">11</div></td>
                <td><input type="text" id="tcsv11" name="tcsv11" class="num" size="25" required tabindex="11"/></td>

                <td><input type="text" id="dfm11" name=" dfm11" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span111" size="" style="display:none" class="span11">A</span><span id="span112" style="display:none" size=""  class="span12">N</span>
                    <span id="span113" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">12</div></td>
                <td><input type="text" id="tcsv12" name="tcsv12" class="num" size="25" required tabindex="12"/></td>

                <td><input type="text" id="dfm12" name=" dfm12" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span121" size="" style="display:none" class="span11">A</span><span id="span122" style="display:none" size=""  class="span12">N</span>
                    <span id="span123" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">13</div></td>
                <td><input type="text" id="tcsv13"  name="tcsv13" size="25" class="num" required tabindex="13"/></td>

                <td><input type="text" id="dfm13" name=" dfm13" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span131" size="" style="display:none" class="span11">A</span><span id="span132" style="display:none" size=""  class="span12">N</span>
                    <span id="span133" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">14</div></td>
                <td><input type="text" id="tcsv14" name="tcsv14" size="25" required class="num" tabindex="14"/></td>

                <td><input type="text" id="dfm14" name=" dfm14" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span141" size="" style="display:none" class="span11">A</span><span id="span142" style="display:none" size=""  class="span12">N</span>
                    <span id="span143" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">15</div></td>
                <td><input type="text" id="tcsv15" name="tcsv15" size="25" required class="num" tabindex="15"/></td>

                <td><input type="text" id="dfm15" name=" dfm15" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span151" size="" style="display:none" class="span11">A</span><span id="span152" style="display:none" size=""  class="span12">N</span>
                    <span id="span153" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">16</div></td>
                <td><input type="text" id="tcsv16" name="tcsv16" size="25" required class="num" tabindex="16"/></td>

                <td><input type="text" id="dfm16" name=" dfm16" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span161" size="" style="display:none" class="span11">A</span><span id="span162" style="display:none" size=""  class="span12">N</span>
                    <span id="span163" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">17</div></td>
                <td><input type="text" id="tcsv17"name="tcsv17" size="25" required class="num" tabindex="17"/></td>

                <td><input type="text" id="dfm17" name=" dfm17" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span171" size="" style="display:none" class="span11">A</span><span id="span172" style="display:none" size=""  class="span12">N</span>
                    <span id="span173" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">18</div></td>
                <td><input type="text" id="tcsv18" name="tcsv18" size="25" class="num" required tabindex="18"/></td>

                <td><input type="text" id="dfm18" name=" dfm18" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span181" size="" style="display:none" class="span11">A</span><span id="span182" style="display:none" size=""  class="span12">N</span>
                    <span id="span183" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">19</div></td>
                <td><input type="text"id="tcsv19" name="tcsv19" size="25" required class="num" tabindex="19"/></td>

                <td><input type="text" id="dfm19" name=" dfm19" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span191" size="" style="display:none" class="span11">A</span><span id="span192" style="display:none" size=""  class="span12">N</span>
                    <span id="span193" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">20</div></td>
                <td><input type="text"id="tcsv20"  name="tcsv20" size="25" required class="num" tabindex="20"/></td>

                <td><input type="text" id="dfm20" name=" dfm20" size="25" class="num3" readonly="readonly" /></td>
                <td><span id="span201" size="" style="display:none" class="span11">A</span><span id="span202" style="display:none" size="" class="span12">N</span>
                    <span id="span203" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">Total</div></td>
                <td><input type="text" id="totals" name="totalss" readonly/></td>


            </tr>
            <tr>
                <td><div align="center">Average</div></td>
                <td><input type="text" id="av1" name="average" readonly/></td>

            </tr>
            <input type="hidden" name="tablet" id="tabStatus"/>          
            <td colspan="5"> <strong>Sample:</strong> <span id="complies" style="display:none">Complies</span><span id="dcomply" style="display:none">Does not comply</span></td>
        </table>

        <center><div id="comments">
            </div>                </center>
        <p>  
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><label for="comment">comments:</label> </strong>                 
        </p><div align="center"><textarea name="comment" cols="90" id="com" ></textarea></div>
        <p><input type="button" value="Save Uniformity" class="submit-button" id="Export"></input></p>

        </form>
    </div>  
    <div id="dialog" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
        <p><form name="" id="reason">
            <h4>State the reason for repeating this test below</h4>
            <p>
                <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
                <br/>
                <input type="button" value="submit" id="sendit" /><input type="button" value="cancel" id="cancelit"/>
        </form></p>
    </div>
       <div id="dialog-c" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
       <?php $this->load->view('compendia_v_v');?>
    </div> 
  
    <script>
                                $(document).ready(function() {
                                    //        $('form').dumbFormState({
                                    //            persistPasswords: false, // default is false, recommended to NOT do this
                                    //            persistLocal: true, // default is false, persists in sessionStorage or to localStorage
                                    //            skipSelector: null, // takes jQuery selector of items you DO NOT want to persist 
                                    //            autoPersist: true // true by default, false will only persist on form submit
                                    //        });
                                });
                                function generate(type) {

                                    var today = new Date();
                                    var cHour = today.getHours();
                                    var cMin = today.getMinutes();
                                    var cSec = today.getSeconds();
                                    var time = cHour + ":" + cMin + ":" + cSec;

                                    var d = new Date();

                                    var month = d.getMonth() + 1;
                                    var day = d.getDate();

                                    var output = (('' + day).length < 2 ? '0' : '') + day + '/' +
                                            (('' + month).length < 2 ? '0' : '') + month + '/' +
                                            d.getFullYear();
                                    var n = noty({
                                        text: type,
                                        type: type,
                                        dismissQueue: true,
                                        layout: 'topCenter',
                                        theme: 'defaultTheme',
                                        timeout: 5000,
                                        text:'Work Autosaved Temporarily: ' + output + '\t' + time
                                    });
                                    console.log('html: ' + n.options.id);
                                }

                                function generateAll() {

                                    generate('information');

                                }

                                $(document).ready(function() {

                                    //  setInterval(generateAll, 20000);

                                });
    </script>