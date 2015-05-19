<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title></title>
        <meta name="generator" content="libreoffice 4.0.5.2 (linux)">
        <meta name="author" content="alphy">
        <meta name="created" content="20131203;5570000">
        <meta name="changedby" content="alphy">
        <meta name="changed" content="20131203;5580000">
        <meta name="appversion" content="14.0000">
        <meta name="docsecurity" content="0">
        <meta name="hyperlinkschanged" content="false">
        <meta name="linksuptodate" content="false">
        <meta name="scalecrop" content="false">
        <meta name="sharedoc" content="false">
        <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
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
        <script src="<?php echo base_url(); ?>javascripts/sterility.js?1500" type="text/javascript"></script>
        <script>

            $(document).ready(function() {
                $data = "<?php echo Sample_issuance::getCompendiaStatus($labref, $test_id); ?>";
                console.log($data);
                if ($data === '0') {
                    $.fancybox({
                        href: "#dialog-c",
                        modal: true
                    });
                } else {
                }
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
                            postData = $('#sterility_form').serialize();

                            $.ajax({
                                type: "POST",
                                // url: "<?php echo base_url(); ?>",
                                url: "<?php echo base_url(); ?>sterility/save/<?php echo $labref . '/' . $test_id; ?>",
                                                        data: postData,
                                                        success: function() {

                                                            showNotification({
                                                                message: "Sterility data has been successfully saved! ",
                                                                type: "success",
                                                                autoClose: true,
                                                                duration: 5

                                                            });
                                                        //    window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";

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
                                            $('#sterility_form .com').each(function()
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

                                                            postData = $('#sterility_form').serialize();

                                                            $.ajax({
                                                                type: "POST",
                                                                // url: "<?php echo base_url(); ?>",
                                                                url: "<?php echo base_url(); ?>sterility/save/<?php echo $labref . '/' . $test_id; ?>",
                                                                                                data: postData,
                                                                                                success: function() {

                                                                                                    showNotification({
                                                                                                        message: "Sterility data has been successfully saved! ",
                                                                                                        type: "success",
                                                                                                        autoClose: true,
                                                                                                        duration: 5

                                                                                                    });
                                                                                                 //   window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";

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
    </head>
    <div class="body_form">
        <body lang="en-us" dir="ltr">
            <?php echo form_open('sterility/save/' . $labref, array('id' => 'sterility_form')); ?>


            <p class="western" style="margin-bottom: 0in"><center>
            <p> <?php foreach ($active as $name)
                 ?>
                Component Name: <input name="pname" id="activeIngredient" placeholder="<?php echo $name->name; ?>" class="com"/>


            </p>
            <table dir="ltr" width=696 cellpadding=7 cellspacing=0>
                <col width=105>
                <col width=4367>
                <col width=31>
                <col width=25>
                <col width=4367>
                <col width=4367>
                <col width=10>
                <col width=10>
                <col width=10>
                <col width=10>
                <col width=34>
                <col width=94>
                <col width=4367>
                <col width=4367>
                <col width=22>
                <col width=10>
                <col width=22>
                <col width=69>
                <tr>
                    <td colspan=5 width=213 height=4 bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><a name="_goback1"></a><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>MICROBIOLOGY LAB NO.</b></font></font></p>
                    </td>
                    <td colspan=6 width=142 bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>DATE RECEIVED</b></font></font></p>
                    </td>
                    <td colspan=4 width=154 bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>DATE TEST SET</b></font></font></p>
                    </td>
                    <td colspan=3 width=129 bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>DATE OF RESULTS</b></font></font></p>
                    </td>
                </tr>
                <tr style="margin:5px;">
                    <td colspan=5 width=213 height=9 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <input type="text" name="microlab_no" class="micro comcom" id="microlab_no" style="width:100%;" value="<?php echo @$micro_number; ?>"/>

                    </td>
                    <td colspan=6 width=142 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <input type="text" name="date_rec" class="micro com" id="date_rec" value="<?php echo $date[0]->created_at; ?>"style="width:100%;"/>

                    </td>
                    <td colspan=4 width=154 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <input type="text" name="date_set" class="micro com" id="date_set" style="width:100%;"/>

                    </td>
                    <td colspan=3 width=129 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <input type="text" name="date_of_results" class="micro com" id="date_of_results" style="width:100%;"/>

                    </td>
                </tr>
                <tr>
                    <td rowspan=2 colspan=7 width=249 height=9 bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <h1 class="western" style="margin-top: 0in"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><span style="font-weight: normal">METHODOLOGY:
                                Method Used</span></font></font></h1>
                    </td>
                    <td colspan=2 width=34 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <input type="radio" name="filtration" value="Membrane Filtration" class="micro" id="membrane_fitration"/>
                        </p>
                    </td>
                    <td colspan=4 width=178 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <h3 class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><span style="text-decoration: none"><b>Membrane
                                    Filtration </b></span></font></font>
                        </h3>
                    </td>
                    <td rowspan=2 colspan=5 width=177 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt">(</font></font><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>Select
                                as appropriate)</i></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 width=34 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <input type="radio" name="filtration" value="Direct Innoculation" class="micro" id="direct_inoculation"/>
                        </p>
                    </td>
                    <td colspan=4 width=178 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <h3 class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><span style="text-decoration: none"><b>Direct
                                    Inoculation</b></span></font></font></h3>
                    </td>
                </tr>
                <tr>
                    <td colspan=11 width=369 height=9 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><span lang="it-it">Quantity
                                Used per filtration/Per media:</span></font></font></p>
                    </td>
                    <td colspan=7 width=297 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <select name="qty" id="measure" class="micro com">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                        </select>
                        <select name="measure" id="measure" class="micro com">
                            <option value="">-select-</option>
                            <option value="Vials">Vial(s)</option>
                            <option value="Ampules">Ampoule(s)</option>
                            <option value="Bottles">Bottle(s)</option>
                            <option value="Items">Item(s)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan=18 width=680 height=8 bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>SAMPLE PREPARATION</b></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td colspan=18 width=680 height=108 valign=top style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=justify style="margin-bottom: 0in">
                            <textarea name="sample_preparation" id="sample_preparation" style="height:100%; width: 675px"></textarea>
                        </p>

                    </td>
                </tr>
                <tr>
                    <td colspan=18 width=680 height=2 valign=top bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>RESULTS</b></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 width=117 height=11 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><br>
                        </p>
                    </td>
                    <td colspan=2 width=70 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>Sample</b></font></font></p>
                    </td>
                    <td colspan=7 width=154 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>Positive
                                Control</b></font></font></p>
                    </td>
                    <td colspan=3 width=118 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>Negative
                                Control</b></font></font></p>
                    </td>
                    <td colspan=4 width=165 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>Positive
                                Sample Control</b></font></font></p>
                    </td>
                </tr>
                <tr >
                    <td rowspan=2 colspan=2 width=117 height=17 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <h3 class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><span style="text-decoration: none"><b>Fluid
                                    Thioglycolate Medium </b></span></font></font>
                        </h3>
                    </td>
                    <td colspan=2 rowspan="2" width=70 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in; ">
                        <p class="western" align=center>
                            <select name="sample_[]" id="sample1" class="sample1">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td colspan=5 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>B.
                                subtilis (NC10400) </i></font></font>
                        </p>
                    </td>
                    <td colspan=2 width=58 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="pc[]" id="pc1" class="pc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td rowspan=2 colspan=3 width=118 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="neg_control[]" id="neg_control1" class="neg_control">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td colspan=3 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>B.
                                subtilis (NC10400) </i></font></font>
                        </p>
                    </td>
                    <td width=69 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="psc[]" id="psc1" class="psc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                </tr>
                <tr>

                    <td colspan=5 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>P.
                                aeruginosa (NC12924)</i></font></font></p>
                    </td>
                    <td colspan=2 width=58 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="pc[]" id="pc2" class="pc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td colspan=3 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>P.
                                aeruginosa (NC12924)</i></font></font></p>
                    </td>
                    <td width=69 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="psc[]" id="psc2" class="psc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td rowspan=2 colspan=2 width=117 height=21 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>Soya
                                Bean Digest Medium</b></font></font></p>
                    </td>
                    <td colspan=2 rowspan="2" width=70 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="sample_[]" id="sample2" class="sample1">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td colspan=5 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>B.
                                subtilis (NC10400)</i></font></font></p>
                    </td>
                    <td colspan=2 width=58 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="pc[]" id="pc3" class="pc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td rowspan=2 colspan=3 width=118 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="neg_control[]" id="neg_control2" class="neg_control">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td colspan=3 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>B.
                                subtilis (NC10400)</i></font></font></p>
                    </td>
                    <td width=69 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="psc[]" id="psc3" class="psc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                </tr>
                <tr >

                    <td colspan=5 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>C.
                                albicans (NCPF3179)</i></font></font></p>
                    </td>
                    <td colspan=2 width=58 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="pc[]" id="pc4" class="psc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                    <td colspan=3 width=82 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>C.
                                albicans (NCPF3179)</i></font></font></p>
                    </td>
                    <td width=69 bgcolor="#ffffff" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=center>
                            <select name="psc[]" id="psc4" class="psc">
                                <option value=""></option>
                                <option value="Growth">Growth</option>
                                <option value="No Growth">No Growth</option>                              
                            </select>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan=18 width=680 height=13 valign=top style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" style="margin-bottom: 0in"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i><b>key:</b></i></font></font><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i>		</i></font></font><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i><b>(
                                    Growth) -</b></i></font></font><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>
                            </b></font></font><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><i><b>Indicates
                                    turbidity, hence suspected microbial growth;</b></i></font></font></p>
                        <p class="western">		(<i><b> No Growth</b></i><i>) - </i><i><b>Indicates
                                    clear, hence no microbial growth.</b></i></p>
                    </td>
                </tr>

                <tr>
                    <td colspan=18 width=680 height=6 valign=top style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><sup><font face="book antiqua, serif"><font size=2 style="font-size: 11pt">*</font></font></sup><font face="book antiqua, serif"><font size=2 style="font-size: 11pt">Inoculation
                            on Soya Bean Digest Agar &amp; Sabourauds Dextrose Agar</font></font></p>
                    </td>
                </tr>
                <tr valign=top>
                    <td colspan=8 width=273 height=5 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <h6 class="western" style="margin-top: 0in"><br>
                        </h6>
                    </td>
                    <td colspan=4 width=190 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <h6 class="western" align=center style="margin-top: 0in"><font face="book antiqua, serif">Sample</font></h6>
                    </td>
                    <td colspan=6 width=189 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <h6 class="western" align=center style="margin-top: 0in"><font face="book antiqua, serif">Negative</font><font face="book antiqua, serif"><span style="font-weight: normal">
                            </span></font><font face="book antiqua, serif">Control</font></h6>
                    </td>
                </tr>
                <tr valign=top>
                    <td colspan=8 width=273 height=23 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>Soya
                                Bean Digest Agar</b></font></font></p>
                    </td>
                    <td colspan=4 width=190 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                <center> <h6 class="western" style="margin-top: 0in"><br>
                        <select name="sbda[]" id="sbda1" class="sbda">
                            <option value=""></option>
                            <option value="Growth">Growth</option>
                            <option value="No Growth">No Growth</option>                              
                        </select>
                    </h6>
                </center>
                </td>
                <td colspan=6 width=189 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                <center> <h6 class="western" style="margin-top: 0in"><br>
                        <select name="snc[]" id="snc1" class="sbda">
                            <option value=""></option>
                            <option value="Growth">Growth</option>
                            <option value="No Growth">No Growth</option>                              
                        </select>
                    </h6></center>
                </h6>
                </td>
                </tr>
                <tr valign=top>
                    <td colspan=8 width=273 height=20 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>Sabourauds
                                Dextrose Agar</b></font></font></p>
                    </td>
                    <td colspan=4 width=190 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                <center><h6 class="western" style="margin-top: 0in"><br>
                        <select name="sbda[]" id="sbda2" class="sbda">
                            <option value=""></option>
                            <option value="Growth">Growth</option>
                            <option value="No Growth">No Growth</option>                              
                        </select>
                    </h6></center>
                </td>
                <td colspan=6 width=189 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                <center> <h6 class="western" style="margin-top: 0in"><br>
                        <select name="snc[]" id="snc2" class="sbda">
                            <option value=""></option>
                            <option value="Growth">Growth</option>
                            <option value="No Growth">No Growth</option>                              
                        </select>
                    </h6>
                </center>
                </td>
                </tr>
                <tr>
                    <td rowspan=2 colspan=3 width=162 height=20 bgcolor="#c0c0c0" style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=right style="margin-bottom: 0in"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>CONCLUSION</b></font></font><font face="book antiqua, serif"><font size=2 style="font-size: 11pt">:</font></font></p>
                        <p class="western" align=right><font face="book antiqua, serif"><font size=2 style="font-size: 11pt">The Product</font></font></p>
                    </td>
                    <td colspan=3 width=49 valign=top style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=right>
                <center><input type="radio" class="com" name="comply" value="No Microbial Growth"/></center>
                </p>
                </td>
                <td colspan=6 width=238 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                    <h6 class="western" style="margin-top: 0in"><font face="book antiqua, serif">Complies</font></h6>
                </td>
                <td rowspan=2 colspan=6 width=189 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                    <p class="western"><font face="book antiqua, serif"><font size=2 style="font-size: 11pt"><b>With
                            The Requirements of the Sterility Test.</b></font></font></p>
                </td>
                </tr>
                <tr>
                    <td colspan=3 width=49 valign=top style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <p class="western" align=right>
                <center><input type="radio" class="com" name="comply" value="Microbial Growth"/></center>
                </p>
                </td>
                <td colspan=6 width=238 style="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                    <h6 class="western" style="margin-top: 0in"><font face="book antiqua, serif">Does
                        Not Comply</font></h6>
                </td>
                </tr>

            </table>
            <!--                     <div id="compendia_specification">
                            <label>COMPENDIA:</label>
                            <textarea id="compendia" name="compendia" required="required" class="com"></textarea>
                           <label>SPECIFICATION:</label>
                            <textarea id="specification" name="specification" required="required" class="com"></textarea>
                        </div>-->
        </center><br>
        </p>
        <p>
        <center><input type="button" value="Save" id="Save_data"/></center>
    </p> 

</div> 

</div>

</form>

<div id="dialog" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
    <p><form name="" id="reason">
        <h4>State the reason for repeating this test below</h4>
        <p>
            <input type="hidden" name="heading"/>
            <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
            <br/>
            <input type="button" value="submit" id="sendit" /><input type="button" value="Close Dialog" id="closeit"/><input type="button" value="cancel" id="cancelit"/>
    </form>

</body>
</div>

<div id="dialog-c" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px; width:230px;">
<?php $this->load->view('compendia_v_1'); ?>
</div>



</html>