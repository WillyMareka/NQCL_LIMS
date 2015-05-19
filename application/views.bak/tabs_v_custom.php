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
                 i=1; 
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
                            url: "<?php echo base_url(); ?>tabs/save_new_tablet_weights/<?php echo $labref.'/'.$test_id; ?>",
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

$('.num').live('keyup',function () {
    average();
    });

                             

        $('#addRow').click(function(){
          
        table= $('#TabsTabeUniformity > tbody');
        newRow =  "<tr><td><div align='center'>"+i+"</div></td>\n\
                       <td><input type='text' id='tcsv1' name='tabdata[]' size='25' class='num' required tabindex='1'/></td>\n\
                       <td><button id='remRow'>-Remove</button></td>\n\
                   </tr>";
                             i++;         
           

        $('#TabsTabeUniformity > tbody tr:last').before( $(newRow) );


         
           return false;

        });
        
        $(document).on('click','#remRow', function(){
          $(this).closest('tr').remove();
          average();
          i-1;
            return false;
        });
        
        average=function findaverage(){
             var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.num[value!=""]').length;
        $('.num').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(4);
            answer=sum1/boxes;
            answer1=answer.toFixed(4);
        });
        $('input#av1').val(answer1);
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
    </head>
sdsd
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
            <tbody>
            <tr>
                <td height="53"><div align="center">No.</div></td>
                <td  align="center" valign="middle"><p align="center">Tablets (mg)</p></td>
                <td><button id="addRow">+ Add Row</button></td>
            </tr>
           <tr>
                <td><div align="center">Average</div></td>
                <td><input type="text" id="av1" name="average" readonly/></td>

            </tr>
            </tbody>
           
            <input type="hidden" name="tablet" id="tabStatus"/>          
        </table>
            
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