
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
    <HEAD>
        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
        <TITLE></TITLE>
        <META NAME="GENERATOR" CONTENT="LibreOffice 4.0.5.2 (Linux)">
        <META NAME="AUTHOR" CONTENT="Alphy Poxy">
        <META NAME="CREATED" CONTENT="20140505;16570000">
        <META NAME="CHANGEDBY" CONTENT="Alphy Poxy">
        <META NAME="CHANGED" CONTENT="20140505;16580000">
        <META NAME="AppVersion" CONTENT="15.0000">
        <META NAME="DocSecurity" CONTENT="0">
        <META NAME="HyperlinksChanged" CONTENT="false">
        <META NAME="LinksUpToDate" CONTENT="false">
        <META NAME="ScaleCrop" CONTENT="false">
        <META NAME="ShareDoc" CONTENT="false">
        <STYLE TYPE="text/css">
            input{
                width: 100px;
            }
            .len{
                width:200px;
            }

            <!--
            @page { size: 8.5in 11in; margin: 1in }
            P { margin-bottom: 0.08in; direction: ltr; line-height: 100%; widows: 0; orphans: 0 }
            P.western { font-family: "Times New Roman", serif; font-size: 12pt }
            P.cjk { font-family: "Times New Roman"; font-size: 12pt }
            P.ctl { font-family: "Times New Roman"; font-size: 12pt }
            -->
        </STYLE>
        
   <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>       
        <SCRIPT>
            $(document).ready(function(){
                
                              $data = "<?php echo Sample_issuance::getCompendiaStatus($labref, $test_id); ?>";
                console.log($data);
                if ($data === '0') {
                    $.fancybox({
                        href: "#dialog-c",
                        modal: true
                    });
                } else {
                }

                
        tinymce.init({
   // selector: ".textarea"
 });
            $('.ab0').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab0').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab0').each(function() {
            sum += Number($(this).val());
            $('.avg0').val(sum / boxes);
       });
   });
   
            $('.ab00').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab00').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab00').each(function() {
            sum += Number($(this).val());
            $('.avg00').val(sum / boxes);
       });
   });
            $('.ab000').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab000').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab000').each(function() {
            sum += Number($(this).val());
            $('.avg000').val(sum / boxes);
       });
   });
       
            $('.ab0000').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab0000').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab0000').each(function() {
            sum += Number($(this).val());
            $('.avg0000').val(sum / boxes);
       });
   });
   
  //===========================================================================================// 
   
          $('.ab7').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab7').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab7').each(function() {
            sum += Number($(this).val());
            $('.avg7').val(sum / boxes);
       });
   });
   
            $('.ab77').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab77').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab77').each(function() {
            sum += Number($(this).val());
            $('.avg77').val(sum / boxes);
       });
   });
            $('.ab777').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab777').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab777').each(function() {
            sum += Number($(this).val());
            $('.avg777').val(sum / boxes);
       });
   });
       
            $('.ab7777').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab7777').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab7777').each(function() {
            sum += Number($(this).val());
            $('.avg7777').val(sum / boxes);
       });
   });
   
   //===========================================================================================// 
   
          $('.ab4').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab4').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab4').each(function() {
            sum += Number($(this).val());
            $('.avg4').val(sum / boxes);
       });
   });
   
            $('.ab44').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab44').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab44').each(function() {
            sum += Number($(this).val());
            $('.avg44').val(sum / boxes);
       });
   });
            $('.ab444').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab444').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab444').each(function() {
            sum += Number($(this).val());
            $('.avg444').val(sum / boxes);
       });
   });
       
            $('.ab4444').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab4444').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab4444').each(function() {
            sum += Number($(this).val());
            $('.avg4444').val(sum / boxes);
       });
   });
   
   //===========================================================================================// 
   
          $('.ab8').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab8').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab8').each(function() {
            sum += Number($(this).val());
            $('.avg8').val(sum / boxes);
       });
   });
   
            $('.ab88').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab88').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab88').each(function() {
            sum += Number($(this).val());
            $('.avg88').val(sum / boxes);
       });
   });
            $('.ab888').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab888').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab888').each(function() {
            sum += Number($(this).val());
            $('.avg888').val(sum / boxes);
       });
   });
       
            $('.ab8888').keyup(function(){
            var sum = 0;
                    var answer = 0;
                    boxes = $('.ab8888').filter(function() {
            return (this.value.length);
            }).length;
                    $('.ab8888').each(function() {
            sum += Number($(this).val());
            $('.avg8888').val(sum / boxes);
       });
   });
   
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
    //$('#microlab_no').val(nqcl_);
   // console.log(nqcl_);




$("#date_of_results").datepicker({
    dateFormat: "dd-M-yy", 
});

  
    $("#date_set").datepicker({
        dateFormat: "dd-M-yy", 
        minDate:  0,
        onSelect: function(){
            var date2 = $('#date_set').datepicker('getDate');
            date2.setDate(date2.getDate()+3);
            $('#date_of_results').datepicker('setDate', date2);
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
      $('#Save_data').prop('disabled',false ); 
      
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
      postData = $('#preservative_efficacy').serialize();

        $.ajax({
            type: "POST",
            // url: "<?php echo base_url(); ?>",
            url: "<?php echo base_url(); ?>preservative_efficacy/save/<?php echo $labref . '/' . $test_id; ?>",
                            data: postData,
                            success: function() {

                                showNotification({
                                    message: "preservative Efficacy data has been successfully saved! ",
                                    type: "success",
                                    autoClose: true,
                                    duration: 5

                                });
                                window.location.href="<?php echo base_url() . 'analyst_controller'; ?>";

                                      $('#Save_data').prop('disabled',false);
                                       $('#Save_data').prop('value','Save');
                         
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

$('#cancelit').click(function(){
window.location.href="<?php echo base_url() . 'analyst_controller'; ?>";
});

$('#closeit').click(function(){
      $('#Save_data').prop('value', 'Save ' +$('#activeIngredient').val());
       $('#Save_data').prop('disabled', false);
 $('#dialog').trigger('close');
});


    
    $('#Save_data').click(function() {
	  var bad = 0;
            $('#preservative_efficacy .com').each(function()
            {
                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                    bad++;
            });
            if (bad > 0) {
                $('.com').css('border','1px solid red');
                $.prompt(bad + ' value(s) are missing, ensure all fields are filled!');
            }
            else {
	
        $(this).prop('value', 'Processing....');
       $(this).prop('disabled', 'disabled');
        substance=$('#activeIngredient').val();
            $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>sterility/check_done/<?php echo $labref; ?>/" + substance,
                    dataType: "json",
                    success: function(data) {
                            if (data.done_state === 1) {
                            prompt_dialog();                  
                            
                            
                            }else{
                            
              postData = $('#preservative_efficacy').serialize();

        $.ajax({
            type: "POST",
            // url: "<?php echo base_url(); ?>",
            url: "<?php echo base_url(); ?>preservative_efficacy/save/<?php echo $labref . '/' . $test_id; ?>",
                            data: postData,
                            success: function() {

                                showNotification({
                                    message: "preservative Efficacy data has been successfully saved! ",
                                    type: "success",
                                    autoClose: true,
                                    duration: 5

                                });
                                window.location.href="<?php echo base_url() . 'analyst_controller'; ?>";

                                // $('#middle_assay,#last_part').slideUp('fast');
                                $('#Save_data').show();
                                $('#Save_data').prop('disabled',false);
                             
                              
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
            <?php echo form_open('preservative_efficacy/save/' . $labref,array('id'=>'preservative_efficacy')); ?>
           

        <P CLASS="western" STYLE="margin-bottom: 0in">
        <CENTER>
              <p>
                         Sample Name: <input name="active_ingredient" id="activeIngredient" class="com"/>
                          
                    </p>
                    <br>
            <TABLE DIR="LTR" WIDTH=850 CELLPADDING=7 CELLSPACING=0>
                <COL WIDTH=148>
                <COL WIDTH=22>
                <COL WIDTH=25>
                <COL WIDTH=43>
                <COL WIDTH=58>
                <COL WIDTH=46>
                <COL WIDTH=46>
                <COL WIDTH=22>
                <COL WIDTH=9>
                <COL WIDTH=47>
                <COL WIDTH=57>
                <TR>
                    <TD COLSPAN=2 HEIGHT=4 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">MICROBIOLOGY
                                    LAB NO.</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">DATE
                                    RECEIVED</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">DATE
                                    TEST SET</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=3 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">DATE
                                    OF RESULTS</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=2 HEIGHT=23 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="microlab_no" class="micro" id="microlab_no" style="width:100%;" value="<?php echo @$micro_number;?>"/>
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="date_rec" class="micro" id="date_rec" style="width:100%; " value="<?php echo $date[0]->created_at;?>"/>
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="date_set" class="micro" id="date_set" style="width:100%;" value=""/>
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER>
                            <input type="text" name="date_of_results" class="micro" id="date_of_results" style="width:100%;" value=""/>
                            <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">INNOCULUM
                                    PREPARATION (if any)</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 HEIGHT=61 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><span class="western" style="margin-bottom: 0in">
                                <textarea name="sp" class="textarea" id="sample_preparation" style="height:100%; width: 1050px"></textarea>
                            </span><BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>RESULTS</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD WIDTH=233 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Incubation
                                        Time (Days)</B></FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=10 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Inoculum
                                        Count (CFU)</B></FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=4 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><BR>
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism1" class="microrganism1 len" id="date_rec2" style="width:100%; " value="" placeholder="First Microorganism"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism2" class="microrganism2 len" id="date_rec3" style="width:100%; " value="" placeholder="Second Microorganism"/>
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism3" class="microrganism3 len" id="date_rec4" style="width:100%; " value="" placeholder="Third Microorganism"/>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="microrganism4" class="microrganism4 len" id="date_rec5" style="width:100%; " value="" placeholder="Fourth Microorganism"/>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">A</FONT></FONT></P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">B</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>0</B></FONT></FONT></P>
                    </TD>
                    <TD height="26" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; ">
                        <P CLASS="western">
                            <input type="text" name="A1[]" id="textfield" class="ab0">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B1[]" id="textfield2" class="ab0">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A2[]" id="textfield" class="ab00">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B2[]" id="textfield" class="ab00">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A3[]" id="textfield" class="ab000">
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B3[]" id="textfield" class="ab000">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A4[]" id="textfield" class="ab0000">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B4[]" id="textfield" class="ab0000">
                            <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average[]" id="textfield47"  class="avg0">
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average2[]" id="textfield47" class="avg00">				</P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average3[]" id="textfield47" class="avg000">
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average4[]" id="textfield47" class="avg0000">				</P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>7</B></FONT></FONT></P>
                    </TD>
                    <TD height="25" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><input type="text" name="A1[]" id="textfield" class="ab7"><BR>
                        </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B1[]" id="textfield"  class="ab7">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A2[]" id="textfield"  class="ab77">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B2[]" id="textfield"  class="ab77">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A3[]" id="textfield"  class="ab777">
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B3[]" id="textfield"  class="ab777">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A4[]" id="textfield"  class="ab7777">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B4[]" id="textfield"  class="ab7777">
                            <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average[]" id="textfield47" class="avg7">
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average2[]" id="textfield47" class="avg77">
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average3[]" id="textfield47" class="avg777">				</P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average4[]" id="textfield47" class="avg7777">
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>14</B></FONT></FONT></P>
                    </TD>
                    <TD height="27" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A1[]" id="textfield"  class="ab4">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B1[]" id="textfield" class="ab4">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A2[]" id="textfield" class="ab44">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B2[]" id="textfield" class="ab44">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A3[]" id="textfield" class="ab444">
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B3[]" id="textfield" class="ab444">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A4[]" id="textfield" class="ab4444">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B4[]" id="textfield" class="ab4444">
                            <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average[]" id="textfield47" class="avg4">
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average2[]" id="textfield47"  class="avg44">
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average3[]" id="textfield47"  class="avg444">
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average4[]" id="textfield47"  class="avg4444">
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 WIDTH=233 HEIGHT=8 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>28</B></FONT></FONT></P>
                    </TD>
                    <TD height="33" COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A1[]" id="textfield" class="ab8">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=71 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B1[]" id="textfield"  class="ab8">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=91 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A2[]" id="textfield"  class="ab88">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B2[]" id="textfield"  class="ab88">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=111 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A3[]" id="textfield"  class="ab888">
                            <BR>
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B3[]" id="textfield"  class="ab888">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=63 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="A4[]" id="textfield"  class="ab8888">
                            <BR>
                        </P>
                    </TD>
                    <TD WIDTH=64 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western">
                            <input type="text" name="B4[]" id="textfield"  class="ab8888">
                            <BR>
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average[]" id="textfield47"  class="avg8">
                        </P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg</B></FONT></FONT>
                            <input type="text" name="average2[]" id="textfield47"  class="avg88">
                        </P>
                    </TD>
                    <TD COLSPAN=3 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average3[]" id="textfield47"  class="avg888">				</P>
                    </TD>
                    <TD COLSPAN=2 VALIGN=TOP STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Avg:</B></FONT></FONT>
                            <input type="text" name="average4[]" id="textfield47"  class="avg8888">
                        </P>
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=11 HEIGHT=9 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>Comments:</B></FONT></FONT>
                            <textarea name="com" class="textarea" id="comments" style="height:100%; width: 1050px"></textarea>
                        </P>
                    </TD>
                </TR>
                <TR>
                <TR>
                    <TD COLSPAN=14 HEIGHT=23 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>NI:
                                    </B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">No
                                    increase </FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>NR</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:
                                    No recovery</FONT></FONT></P>
                    </TD>
                </TR>
                <TR>
                    <TD ROWSPAN=2 COLSPAN=2 HEIGHT=29 BGCOLOR="#c0c0c0" STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        <P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><B>CONCLUSION</B></FONT></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">:
                                </FONT></FONT>
                        </P>
                        <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt">The
                                    Product </FONT></FONT>
                        </P>
                    </TD>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">

                        <input type="radio" name="comply" id="radio" value="COMPLIES">

                    </TD>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        Complies
                    </TD>
                    <TD ROWSPAN=2 COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        With the requirements of the Preservative Efficacy Test
                    </TD>
                </TR>
                <TR>
                    <TD COLSPAN=2 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">

                        <input type="radio" name="comply" id="radio2" value="DOES NOT COMPLY">


                    </TD>
                    <TD COLSPAN=5 STYLE="border: 1px solid #00000a; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0.08in">
                        Does Not Comply
                    </TD>
                </TR>

            </TABLE>
<!--                               <div id="compendia_specification">
                <label>COMPENDIA:</label>
                <textarea id="compendia" name="compendia" required="required" class="com"></textarea>
               <label>SPECIFICATION:</label>
                <textarea id="specification" name="specification" required="required" class="com"/></textarea>
            </div>-->
        </CENTER>
       <BR>
         <center><input type="button" value="Save" id="Save_data"/></center>
    </form>
    </P>
    
                
                            <div id="dialog" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
    <p><form name="" id="reason">
        <h4>State the reason for repeating this test below</h4>
        <p>
            <input type="hidden" name="heading"/>
            <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
            <br/>
            <input type="button" value="submit" id="sendit" /><input type="button" value="Close Dialog" id="closeit"/><input type="button" value="cancel" id="cancelit"/>
    </form>
</DIV>
    
                     <div id="dialog-c" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px; width:230px;">
<?php $this->load->view('compendia_v_1'); ?>
</div>  
    
</BODY>

</HTML>