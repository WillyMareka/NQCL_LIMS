<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
    <HEAD>
        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
        <TITLE></TITLE>
        <META NAME="GENERATOR" CONTENT="LibreOffice 4.0.5.2 (Linux)">
        <META NAME="AUTHOR" CONTENT="Alphy Poxy">
        <META NAME="CREATED" CONTENT="20140425;22250000">
        <META NAME="CHANGEDBY" CONTENT="Alphy Poxy">
        <META NAME="CHANGED" CONTENT="20140426;3520000">
        <META NAME="AppVersion" CONTENT="15.0000">
        <META NAME="DocSecurity" CONTENT="0">
        <META NAME="HyperlinksChanged" CONTENT="false">
        <META NAME="LinksUpToDate" CONTENT="false">
        <META NAME="ScaleCrop" CONTENT="false">
        <META NAME="ShareDoc" CONTENT="false">
        <STYLE TYPE="text/css">
            <!--
            @page { size: 8.5in 11in; margin: 1in }
            P { margin-bottom: 0in; direction: ltr; line-height: 100%; widows: 2; orphans: 2 }
            P.western { font-family: "Times New Roman", serif; font-size: 12pt; font-weight: bold }
            P.cjk { font-family: "Times New Roman"; font-size: 12pt; font-weight: bold }
            P.ctl { font-family: "Times New Roman"; font-size: 12pt; font-weight: bold }
            H1 { margin-bottom: 0.04in; direction: ltr; line-height: 100%; widows: 0; orphans: 0 }
            H1.western { font-family: "Arial", serif; font-size: 16pt }
            H1.cjk { font-family: "Times New Roman"; font-size: 16pt }
            H1.ctl { font-family: "Arial"; font-size: 16pt }
            H6 { margin-bottom: 0.04in; direction: ltr; line-height: 100%; widows: 0; orphans: 0; page-break-after: auto }
            H6.western { font-size: 11pt }
            H6.cjk { font-family: "Times New Roman"; font-size: 11pt }
            H6.ctl { font-family: "Times New Roman"; font-size: 11pt }
            -->
        </STYLE>
        <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
        <SCRIPT>

            $(document).ready(function() {
                /* $('#average1,#average2,#average_neg,#average_neg_2,#average_cfu,#average_cfu_cont').prop('readonly', 'readonly');
                 function check(){
                 a = parseFloat($('#average2').val());
                 b = parseFloat($('#average_neg_2').val());
                 totalc = a + b;
                 console.log(totalc)
                 if (totalc == 'NaN'){
                 $('#radio').attr('checked',false);
                 $('#radio2').attr('checked',false);
                 } else if (totalc <= 0){
                 $('#radio').attr('checked','checked');
                 } else if (totalc > 0){
                 $('#radio2').attr('checked','checked');
                 }
                 
                 }
                 
                 
                 $('.cfu').live('keyup', function() {
                 var sum = 0;
                 var answer = 0;
                 boxes = $(".cfu").filter(function() {
                 return (this.value.length);
                 }).length;
                 $('.cfu').each(function() {
                 sum += Number($(this).val());
                 });
                 $('input#average1').val(sum / boxes);
                 check();
                 
                 });
                 $('.cfu1').live('keyup', function() {
                 var sum = 0;
                 var answer = 0;
                 boxes = $(".cfu1").filter(function() {
                 return (this.value.length);
                 }).length;
                 $('.cfu1').each(function() {
                 sum += Number($(this).val());
                 
                 });
                 $('input#average2').val(sum / boxes);
                 check();
                 });
                 $('.cfu11').live('keyup', function() {
                 var sum = 0;
                 var answer = 0;
                 boxes = $(".cfu11").filter(function() {
                 return (this.value.length);
                 }).length;
                 $('.cfu11').each(function() {
                 sum += Number($(this).val());
                 check();
                 
                 });
                 $('input#average_neg').val(sum / boxes);
                 check();
                 });
                 $('.cfu12').live('keyup', function() {
                 var sum = 0;
                 var answer = 0;
                 boxes = $(".cfu12").filter(function() {
                 return (this.value.length);
                 }).length;
                 $('.cfu12').each(function() {
                 sum += Number($(this).val());
                 
                 });
                 $('input#average_neg_2').val(sum / boxes);
                 check();
                 });
                 $('.cfu,.cfu1').on('change', function(){
                 averagea = parseFloat($('#average1').val());
                 averageb = parseFloat($('#average2').val());
                 total = (averagea + averageb)/ 2 * 100;
                 console.log(averagea + averageb);
                 if (total == 'NaN'){
                 $('#average_cfu').val('');
                 } else if (total <100){
                 $('#average_cfu').val('< 100').css('background', 'greenyellow');
                 } else{
                 $('#average_cfu').val(total).css('background', 'red'); ;
                 }
                 check();
                 });
                 $('.cfu11,.cfu12').on('change', function(){
                 averagea = parseFloat($('#average_neg').val());
                 averageb = parseFloat($('#average_neg_2').val());
                 total = (averagea + averageb)/ 2 * 100;
                 console.log(averagea + averageb);
                 if (total == 'NaN'){
                 $('#average_cfu_cont').val('');
                 } else if (total < 100){
                 $('#average_cfu_cont').val('< 100').css('background', 'greenyellow');
                 $('#determined').val(' Less Than 100 CFU');
                 } else{
                 $('#average_cfu_cont').val(total).css('background', 'red');
                 $('#determined').val(' More Than 100 CFU');
                 }
                 
                 
                 check();
                 
                 
                 });*/

                $data = "<?php echo Sample_issuance::getCompendiaStatus($labref, $test_id); ?>";
                console.log($data);
                if ($data === '0') {
                    $.fancybox({
                        href: "#dialog-c",
                        modal: true
                    });
                } else {
                }

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
                $('#micro_no').val(nqcl_);
                // console.log(nqcl_);




                $("#date_of_result").datepicker({
                    dateFormat: "dd-M-yy",
                });


                $("#date_set").datepicker({
                    dateFormat: "dd-M-yy",
                    minDate: 0,
                    onSelect: function() {
                        var date2 = $('#date_set').datepicker('getDate');
                        date2.setDate(date2.getDate() + 3);
                        $('#date_of_result').datepicker('setDate', date2);
                    }
                });

            });
        </SCRIPT>
        <style type="text/css">
            <!--
            @page { size: 8.5in 11in; margin: 1in }
            p { margin-bottom: 0.08in; direction: ltr; line-height: 100%; widows: 0; orphans: 0 }
            p.western { font-family: "times new roman", serif; font-size: 12pt }
            p.cjk { font-family: "times new roman"; font-size: 12pt }
            p.ctl { font-family: "times new roman"; font-size: 12pt }
            h1 { margin-bottom: 0.04in; direction: ltr; line-height: 100%; widows: 0; orphans: 0 }
            h1.western { font-family: "arial", serif; font-size: 16pt }
            h1.cjk { font-family: "times new roman"; font-size: 16pt }
            h1.ctl { font-family: "arial"; font-size: 16pt }
            h3 { margin-top: 0in; margin-bottom: 0in; direction: ltr; line-height: 100%; widows: 2; orphans: 2; text-decoration: underline }
            h3.western { font-size: 12pt; font-weight: normal }
            h3.cjk { font-family: "times new roman"; font-size: 12pt; font-weight: normal }
            h3.ctl { font-family: "times new roman"; font-size: 12pt; font-weight: normal }
            h6 { margin-bottom: 0.04in; direction: ltr; line-height: 100%; widows: 0; orphans: 0; page-break-after: auto }
            h6.western { font-size: 11pt }
            h6.cjk { font-family: "times new roman"; font-size: 11pt }
            h6.ctl { font-family: "times new roman"; font-size: 11pt }
            -->

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
                border: 2px solid greenyellow;
            }
            .body_form{
                margin: 0 auto;
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
                width: 99.5%;
            }
            input[type=text]{
                text-align: center;
            }
            #massses table{

                border: 1px solid black;

            }
            #Save{
                background: rgb(180,227,145); /* Old browsers */
                background: -moz-linear-gradient(-45deg,  rgba(180,227,145,1) 0%, rgba(97,196,25,1) 50%, rgba(180,227,145,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(180,227,145,1)), color-stop(50%,rgba(97,196,25,1)), color-stop(100%,rgba(180,227,145,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(-45deg,  rgba(180,227,145,1) 0%,rgba(97,196,25,1) 50%,rgba(180,227,145,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(-45deg,  rgba(180,227,145,1) 0%,rgba(97,196,25,1) 50%,rgba(180,227,145,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(-45deg,  rgba(180,227,145,1) 0%,rgba(97,196,25,1) 50%,rgba(180,227,145,1) 100%); /* IE10+ */
                background: linear-gradient(135deg,  rgba(180,227,145,1) 0%,rgba(97,196,25,1) 50%,rgba(180,227,145,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4e391', endColorstr='#b4e391',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
                color: black;
                font-weight: bolder;
            }

            #compendia_specification{
                // position: absolute;
                //  width:250px;
                //height:300px;
                margin-left: 10px;

            }
        </style>
        <script>

            $(document).ready(function() {
                $('#Save_data').prop('disabled', false);

                function prompt_dialog() {
                    $("#dialog").lightbox_me({
                        closeClick: false,
                        centered: true
                    });
                }

                $('#sendit').click(function() {
                    var data = $('#reason').serialize();
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url() . 'assay/postRepeatReason/' . $labref; ?>',
                        data: data,
                        success: function(data) {
                            alert('Reason Successfully Saved, Saving Data.....');
                            postData = $('#microbial_load_form').serialize();

                            $.ajax({
                                type: "POST",
                                // url: "<?php echo base_url(); ?>",
                                url: "<?php echo base_url(); ?>microbial_load/save/<?php echo $labref . '/' . $test_id; ?>",
                                                        data: postData,
                                                        success: function() {

                                                            showNotification({
                                                                message: "Microbial Load data has been successfully saved! ",
                                                                type: "success",
                                                                autoClose: true,
                                                                duration: 5

                                                            });
                                                            //window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";

                                                            $('#Save_data').prop('disabled', false);
                                                            $('#Save_data').prop('value', 'Save');

                                                        },
                                                        error: function() {
                                                            showNotification({
                                                                message: "Oops! an error occurred.",
                                                                type: "error",
                                                                autoClose: true,
                                                                duration: 5
                                                            });
                                                        }

                                                    });


                                                },
                                                error: function() {

                                                }


                                            })

                                            $('#dialog').trigger('close');
                                        });

                                        $('#cancelit').click(function() {
                                            window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";
                                        });

                                        $('#closeit').click(function() {
                                            $('#Save_data').prop('value', 'Save ' + $('#activeIngredient').val());
                                            $('#Save_data').prop('disabled', false);
                                            $('#dialog').trigger('close');
                                        });



                                        $('#Save_data').click(function() {
                                            var bad = 0;
                                            $('#microbial_load_form .com').each(function()
                                            {
                                                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                                                    bad++;
                                            });
                                            if (bad > 0) {
                                                $('.com').css('border', '1px solid red');
                                                $.prompt(bad + ' value(s) are missing, ensure all fields are filled!');
                                            }
                                            else {

                                                $(this).prop('value', 'Processing....');
                                                $(this).prop('disabled', 'disabled');
                                                substance = $('#activeIngredient').val();
                                                $.ajax({
                                                    type: "GET",
                                                    url: "<?php echo base_url(); ?>sterility/check_done/<?php echo $labref; ?>/" + substance,
                                                    dataType: "json",
                                                    success: function(data) {
                                                        if (data.done_state === 1) {
                                                            prompt_dialog();


                                                        } else {

                                                            postData = $('#microbial_load_form').serialize();

                                                            $.ajax({
                                                                type: "POST",
                                                                // url: "<?php echo base_url(); ?>",
                                                                url: "<?php echo base_url(); ?>microbial_load/save/<?php echo $labref . '/' . $test_id; ?>",
                                                                                                data: postData,
                                                                                                success: function() {

                                                                                                    showNotification({
                                                                                                        message: "Microbial Load data has been successfully saved! ",
                                                                                                        type: "success",
                                                                                                        autoClose: true,
                                                                                                        duration: 5

                                                                                                    });
                                                                                                    window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";

                                                                                                    // $('#middle_assay,#last_part').slideUp('fast');
                                                                                                    $('#Save_data').show();
                                                                                                    $('#Save_data').prop('disabled', false);


                                                                                                },
                                                                                                error: function() {
                                                                                                    showNotification({
                                                                                                        message: "Oops! an error occurred.",
                                                                                                        type: "error",
                                                                                                        autoClose: true,
                                                                                                        duration: 5
                                                                                                    });
                                                                                                }

                                                                                            });


                                                                                        }
                                                                                    },
                                                                                    error: function(data) {
                                                                                        console.log(data);
                                                                                    }
                                                                                });
                                                                            }

                                                                        });


                                                                    });

        </script>


    </HEAD>
           <BODY LANG="en-US" DIR="LTR">   


    <div class="body_form">
        <CENTER>
      
                <?php echo form_open('microbial_load/save/' . $labref, array('id' => 'microbial_load_form')); ?>

                <p>
                    Sample Name: <input name="pname" typ="text" style="width:250px;" placeholder="Enter sample Name" class="com"/>
                </p>
                <INPUT type="hidden" name="determined" id="determined"/>
                <br>
                <TABLE WIDTH=708 CELLPADDING=7 CELLSPACING=0 STYLE="page-break-before: always">
                    <COL WIDTH=73>
                    <COL WIDTH=75>
                    <COL WIDTH=37>
                    <COL WIDTH=4367>
                    <COL WIDTH=11>
                    <COL WIDTH=57>
                    <COL WIDTH=4>
                    <COL WIDTH=16>
                    <COL WIDTH=44>
                    <COL WIDTH=35>
                    <COL WIDTH=25>
                    <COL WIDTH=7>
                    <COL WIDTH=10>
                    <COL WIDTH=30>
                    <COL WIDTH=73>
                    <TR>
                        <TD COLSPAN=3 HEIGHT=4 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>MICROBIOLOGY
                                            LAB NO.</B></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=5 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>DATE
                                            RECEIVED</B></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>DATE
                                            TEST SET</B></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>DATE
                                            OF RESULTS</B></FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=3 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <H1 CLASS="western" STYLE="margin-top: 0in">
                                <input type="text" autocomplete="off" class="com" name="micro_no" id="micro_no" value="<?php echo @$micro_number; ?>">
                                <BR>
                            </H1>
                        </TD>
                        <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="margin-top: 0in">
                                    <input type="text" autocomplete="off" class="com" name="date_received" id="date_received" value="<?php echo $date[0]->created_at; ?>">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="margin-top: 0in">
                                    <input type="text" autocomplete="off" class="com" name="date_test_set" id="date_set">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="margin-top: 0in">
                                    <input type="text" autocomplete="off"  class="com" name="date_of_result_determined" id="date_of_result">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=15 HEIGHT=8 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>SAMPLE
                                            PREPARATION</B></FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD WIDTH=148 HEIGHT=21 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Smp</FONT></FONT></P>
                        </TD>
                        <TD WIDTH=72 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Unit</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Diluent</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">V</FONT></FONT><SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">1
                                        </FONT></FONT></SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><I>(ml)</I></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">P</FONT></FONT><SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">1
                                        </FONT></FONT></SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><I>(ml)</I></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">V</FONT></FONT><SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">2
                                        </FONT></FONT></SUB><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><I>(ml)</I></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plating
                                        Vol</FONT></FONT></P>
                        </TD>
                        <TD WIDTH=88 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Replicates</FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD WIDTH=148 HEIGHT=21 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <input type="text" autocomplete="off"  class="com"autocomplete="off" name="smp" id="textfield">
                                <BR>
                            </P>
                        </TD>
                        <TD WIDTH=72 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <select name="unit" id="select2" class="com">
                                    <option value=""></option>
                                    <option value="g">g</option>
                                    <option value="ml">ml</option>
                                    <option value="mg">mg</option>

                                </select>
                                <BR>
                            </P>
                        </TD>
                        <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" autocomplete="off" class="com" autocomplete="off" name="diluent" id="textfield3">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text"  class="com" autocomplete="off" autocomplete="off" name="v1" id="textfield4">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="p1" id="textfield5">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text"  class="com" autocomplete="off" autocomplete="off" name="v2" id="textfield6">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="plating" id="textfield7">
                                </span><BR>
                            </P>
                        </TD>
                        <TD WIDTH=88 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in"><select name="replicate" id="replicate" class="com">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select></TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=15 HEIGHT=2 VALIGN=TOP BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>RESULTS</B></FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD COLSPAN=2 HEIGHT=11 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <BR>
                            </P>
                        </TD>
                        <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CFU
                                            X 100</B></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Negative
                                            Control</B></FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR>
                        <TD ROWSPAN=3 COLSPAN=2 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Nutrient
                                            Agar</B></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=5 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                        1</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" name="cfu-1[]" id="" class="cfu">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text"  class="com" autocomplete="off" autocomplete="off" name="cfu1[]" class="cfu11">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                        2</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" name="cfu-1[]" class="cfu"/>
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="cfu1[]" class="cfu11">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=RIGHT STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Average
                                            (A)</B></FONT></FONT>:</P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text"  class="com" name="cfu-1[]" id="average1">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=JUSTIFY STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="cfu1[]" id="average_neg">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD COLSPAN=2 HEIGHT=10 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western"><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="widows: 0; orphans: 0"><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CFU
                                            X 100</B></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Negative
                                            Control</B></FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR>
                        <TD ROWSPAN=3 COLSPAN=2 HEIGHT=8 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Sabourauds
                                        Dextrose </FONT></FONT>
                            </P>
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Agar</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=5 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                        1</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" name="cfu-1[]" id="" class="cfu1">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="cfu1[]" class="cfu12">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">Plate
                                        2</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="cfu-1[]" class="cfu1">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="cfu1[]" class="cfu12">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD height="24" COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=RIGHT STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Average
                                            (B)</B></FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=RIGHT STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" autocomplete="off" name="cfu-1[]" id="average2"/>
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" name="cfu1[]" id="average_neg_2">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR VALIGN=TOP>
                        <TD COLSPAN=7 HEIGHT=11 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=RIGHT STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Total
                                            CFU</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">
                                        (Sum of Averages A and B)</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=RIGHT STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" name="cfu-1[]" id="average_cfu"/>
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="widows: 0; orphans: 0"><span class="western" style="font-weight: normal; widows: 0; orphans: 0">
                                    <input type="text" class="com" autocomplete="off" name="cfu1[]" id="average_cfu_cont">
                                </span><BR>
                            </P>
                        </TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=15 HEIGHT=30 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>NB</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:
                                        Where no CFU are found, report the number as Less Than 100 CFU
                                        (Colony Forming Units).</FONT></FONT></P>
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Limits:
                                            Not More Than 5 x 10</B></FONT></FONT><SUP><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>2</B></FONT></FONT></SUP><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>
                                            CFU per mL/g</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">.</FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR>
                        <TD ROWSPAN=2 COLSPAN=2 HEIGHT=22 VALIGN=TOP BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CONCLUSION</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:</FONT></FONT></P>
                            <P CLASS="western" ALIGN=CENTER STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">The
                                        Product</FONT></FONT></P>
                        </TD>
                        <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=RIGHT STYLE="widows: 0; orphans: 0">
                                <input type="radio" name="radio" id="radio" value="No Microbial Count">
                                <BR>
                            </P>
                        </TD>
                        <TD COLSPAN=6 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <H6 CLASS="western" STYLE="margin-top: 0in"><FONT FACE="Book Antiqua, serif">Complies</FONT></H6>
                        </TD>
                        <TD ROWSPAN=2 COLSPAN=5 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
                                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">With
                                        the requirements of the Microbial Limit Test.</FONT></FONT></P>
                        </TD>
                    </TR>
                    <TR>
                        <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <P CLASS="western" ALIGN=RIGHT STYLE="widows: 0; orphans: 0"><span class="western" style="widows: 0; orphans: 0">
                                    <input type="radio" name="radio" id="radio2" value="Microbial Count">
                                </span><BR>
                            </P>
                        </TD>
                        <TD COLSPAN=6 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                            <H6 CLASS="western" STYLE="margin-top: 0in"><FONT FACE="Book Antiqua, serif">Does
                                    Not Comply</FONT></H6>
                        </TD>
                    </TR>

                </TABLE>
                <P CLASS="western" STYLE="font-weight: normal; widows: 0; orphans: 0">
<!--                <div id="compendia_specification">
                    <label>COMPENDIA:</label>
                    <textarea id="compendia" name="compendia" required class="com"></textarea>
                    <label>SPECIFICATION:</label>
                    <textarea id="specification" name="specification" required class="com"></textarea>
                </div>-->
                </P>
                <center><input type="button" value="Save" id="Save_data"/></center> 
                </form>
           
        </CENTER>
    </DIV>
   

    <div id="dialog" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
        <p><form name="" id="reason">
            <h4>State the reason for repeating this test below</h4>
            <p>
                <input type="hidden" name="heading"/>
                <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
                <br/>
                <input type="button" value="submit" id="sendit" /><input type="button" value="Close Dialog" id="closeit"/><input type="button" value="cancel" id="cancelit"/>
        </form>
    </div> 
               
                   <div id="dialog-c" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px; width:230px;">
<?php $this->load->view('compendia_v_1'); ?>
</div>

      </BODY>
</HTML>
