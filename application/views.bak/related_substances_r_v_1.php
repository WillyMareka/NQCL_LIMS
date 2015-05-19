<?php $this->load->view('template_v');?>
<style type="text/css">

    .tg-table-light 
    { border-collapse: collapse;
      border-spacing: 0;

    }
    .tg-table-light td, .tg-table-light th { 
        background-color: #fff; 
        border: 1px #bbb solid; 
        color: #333; font-family: sans-serif; 
        font-size: 100%; 
        padding: 10px; 
        vertical-align: top; 
    }
    .tg-table-light .tg-even td  { 
        background-color: #eee;
    }
    .tg-table-light th  { 
        background-color: #ddd; 
        color: #333; 
        font-size: 110%; 
        font-weight: bold;
    }
    .tg-table-light tr:hover td, .tg-table-light tr.even:hover td  { 
        color: #222; 
        background-color: #FCFBE3;
    }
    .tg-bf { 
        font-weight: bold;
    } 
    .tg-it 
    { 
        font-style: italic;
    }
    .tg-left {
        text-align: left; 
    } 
    .tg-right { 
        text-align: right; 
    } 
    .tg-center { 
        text-align: center;
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
        border: 2px solid greenyellow;
    }
    .uniformity{
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

</style>
<script>
    $(document).ready(function() {
        $('.ph').live('keyup', function() {
            var sum = 0;
            var sum1 = 0;
            var answer = 0;
            var answer1 = 0;
            boxes = $(".ph").filter(function() {
                return (this.value.length);
            }).length;
            $('.ph').each(function() {
                sum += Number($(this).val());
                sum1 = sum.toFixed(2);
                answer = sum1 / boxes;
                answer1 = answer.toFixed(2);
            });

            //$('input#utotals').val(sum1);
            $('.phmean').val(answer1);

        });
    });
</script>
<form name="" action="" method="post" id="pHform">
    <center>
        <div class="uniformity">
             <p><center><legend><h3>&#8801; NQCL RELATED SUBSTANCES RESULTS</h3></legend></center></p>
            <?php if ($r > 1) {
                $repeat = $r - 1 ?>
                <p><center><legend><h2>Sample Results &#187 <?php echo $labref; ?>&nbsp; &#187 &nbsp; <?php echo 'Repeat ' . $repeat; ?> &nbsp;|&nbsp;Posted &#187 <?php echo $rs[0]->date_time; ?>  </h2></legend></center></p>
            <?php } else { ?>
                <p><center><legend><h2>Sample Results &#187 <?php echo $labref; ?>&nbsp; &#187 &nbsp; Posted &#187 <?php echo $rs[0]->date_time; ?>  </h2></legend></center></p>
            <?php } ?>
            </p>
                   <center><h3></h3></center>
               <hr>
                    <div id="massses">
                <table>
                    <tr>
                        <td>
                            <label>Determined Value for Related Substances:  </label></td>
                        <td><input type="text" id="phmeanc" name="sampleph" class="phmean"  readonly value="<?php echo $rs[0]->run;?>"/>
                        </td>
                    </tr>

                </table>

            </div>
            <hr>
            <p></p>
            <h3>Remarks</h3>
            <hr>
            <div id="comments_area">
                <textarea id="comments" cols="100" rows="5" name="comments" readonly class="phd"><?php echo $rs[0]->remarks;?></textarea>
            </div>
            <p>
            <p style="float: left; font-weight: bold; color: black;">NB: These results have already been posted to corresponding excel sheet, Kindly confirm if they are right.</p>

            </p>
           
    

      

        </div>
    </center>
</form>
<script>
    $(document).ready(function() {

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

        /* repeat_no =<?php echo $repeat_no; ?>;
         if (repeat_no === 1) {
         prompt_dialog();
         }*/

        $('#Save').click(function() {
            var bad = 0;
            $('#pHform .phd').each(function()
            {
                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                    bad++;
            });
            if (bad > 0) {
                $.prompt(bad + ' compulsory field(s) has/have not been fillled ');
            }
            else {
                $('#Save').prop('value', 'Saving, Please Wait....');
                $('#Save').prop('disabled', 'disabled');
                dataString2 = $('#pHform').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>viscosity/save/<?php echo $labref; ?>",
                                        data: dataString2,
                                        success: function() {
                                            $('#Save').prop('value', 'Save Viscosity Data');
                                            $('#Save').prop('disabled', false);
                                            $.prompt("Saving Success!, Do you want to repeat this test?", {
                                                title: "Repeat Request",
                                                buttons: {"Yes, I want to repeat": true, "No, Lets proceed": false},
                                                submit: function(e, v, m, f) {

                                                    if (v === true) {

                                                        $('input:text, textarea').val('');
                                                        $("#com").attr("value", "");
                                                        $('span').css('display', 'none');
                                                        prompt_dialog();



                                                    } else {
                                                        $.prompt("Proceeding to Analyst Home!");
                                                        window.location.href = "<?php echo base_url() . 'analyst_controller/'; ?>"
                                                    }

                                                    console.log("Value clicked was: " + v);
                                                }
                                            });
                                            // alert('Data Saved to the database and exported to the database');
                                            // window.location.href="<?php echo base_url() . 'assay/assay_page/' . $labref; ?>";
                                        },
                                        error: function() {
                                            $.prompt('An internal error has occurred, data could not be Saved at this time!');
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

                        });
</script>