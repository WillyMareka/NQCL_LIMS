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

</style>
<script>
    $(document).ready(function() {
loadComponents();
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
            $('#input1').each(function()
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
                dataString2 = $('#Titration').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>assay/save_titration/<?php echo $labref . '/' . $test_id; ?>",
                                        data: dataString2,
                                        success: function() {
                                            $('#Save').prop('value', 'Save Titration Assay Data');
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
                                        // alert(data);
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
        
        function loadComponents() {
var select = $('#activeIngredient').empty();
        $.ajax({
        type: "GET",
        url: "<?php echo base_url(); ?>assay/loadComponents/<?php echo $labref; ?>",
        dataType: "json",
        success: function(data) {
                if (data == "5") {
                new Messi('No more Active Ingredients left to be tested , I\'ll take you Home', {title: 'No More Active Ingredient', modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}], callback: function(val) {

                if (val === 'X')
                window.location.href = "<?php echo base_url() . 'analyst_controller/' ?>";
                }});

                } else {
                        $.each(data, function(i, r) {
                        var opt = (r.name);
                        select.append("<option value=" + opt + ">" + opt + "</option>")
                        });
                        $('#labelclaim').val(data[0].volume).trigger('change');
                        $('#Export').prop('value', 'Save ' + data[0].name);
                        $('#Export_r').prop('value', 'Save ' + data[0].name + ' & Repeat');
                  }


                    },
                    error: function() {

                }
            });

}
                            

                        });
</script>
<link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' /></script>
<script src="<?php echo base_url(); ?>javascripts/nqcl.js?1500" type="text/javascript"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>javascripts/zebra_dialog.js'></script>
<form name="" action="<?php echo base_url(); ?>'uniformity/save_capsule_weights/'<?php //echo $labrefuri;    ?>" id="Titration">
    <center>
        <div class="uniformity">
            <legend>  &#171; <?php echo anchor('analyst_controller', 'Back') ?></legend>
            <legend><h4>&#8801; NQCL &#187; TITRATION ASSAY DATA FORM &#187; SAMPLE : <?php echo $labref; ?> </h4></legend>
            <hr>
              <div class="other_details">
                    <legend> </legend>
                    <p>Active Ingredient Name</p>
                    <select name="heading" id="activeIngredient" >               
                    </select>
                </div>
            <p>Standardization of Titrant Solution</p>
            <hr>
            <table class="tg-table-light">              
                <tr class="tg-even">
                    <td>Titrant</td>
                    <td><input type="text" id="titra1" name="titra"  class="titranta" required value="" size="50" tabindex="1"/></td>                    
                </tr>
                <tr>
                    <td>Primary Standard</td>
                    <td><input type="text" id="pris1" name="pstd" class="titranta"  required value="" size="50" tabindex="3"/></td>

                </tr>
                <tr class="tg-even">
                    <td>Indicator/Endpoint Determination</td>
                    <td><input type="text" id="ined1" name="ied"  class="titranta"  required value="" size="50" tabindex="5"/></td>

                </tr>
                <tr>
                    <td>Equivalence</td>
                    <td><textarea id="eq1" name="eqv" class="titranta"  required value="" cols="59" tabindex="7"/></textarea></td>

                </tr>

            </table>

            <p></p>


            <table class="tg-table-light">
                <tr>
                    <th>Std</th>
                    <th>Weight<br>(mg)</th>
<!--                    <th>Expected<br>(mL)</th>-->
                    <th>Final Vol.<br>(mL)</th>
                    <th>Initial Vol.<br>(mL)</th>
                    <th>Titre Vol.<br>(mL)</th>
<!--                    <th>Normality<br>Factor</th>-->
                </tr>
                <tr class="tg-even">
                    <td>A</td>
                    <td><input type="text" id="utcsv1" name="stdw[]"  class="unum" required value="" tabindex="1"/></td>
<!--                    <td><input type="text" id="uecsv1" name="stde[]"  class="unum1" value="" required tabindex="2"/></td>-->
                    <td><input type="text" id="ucsvc1" name="stdf[]"  class="unum2" value="" required /></td>
                    <td><input type="text" id="udfm1"name="stdi[]"  class="unum3" value="" required/></td>
                    <td><input type="text" id="udfm1"name="stdt[]"  class="unum3" value="" required/></td>
<!--                    <td><input type="text" id="udfm1"name="stdn[]"  class="unum3" value="" required/></td>-->
                </tr>
                <tr>
                    <td>B</td>
                    <td><input type="text" id="utcsv2" name="stdw[]" class="unum"  required value="" tabindex="3"/></td>
<!--                    <td><input type="text" id="uecsv2" name="stde[]" class="unum1"  required value="" tabindex="4"/>-->
                    <td><input type="text" id="ucsvc2" name="stdf[]"  class="unum2"required value=""/></td>
                    <td><input type="text" id="udfm2" name="stdi[]"  class="unum3" required value=""/></td>
                    <td><input type="text" id="udfm1"name="stdt[]"  class="unum3" value="" required/></td>
<!--                    <td><input type="text" id="udfm1"name="stdn[]"  class="unum3" value="" required/></td>-->
                </tr>
                <tr class="tg-even">
                    <td>C</td>
                    <td><input type="text" id="utcsv3" name="stdw[]"  class="unum"  required value="" tabindex="5"/></td>
<!--                    <td><input type="text" id="uecsv3" name="stde[]" class="unum1"  required value="" tabindex="6"/></td>-->
                    <td><input type="text"  id="ucsvc3" name="stdf[]" class="unum2"  required value="" /></td>
                    <td><input type="text" id="udfm3" name="stdi[]"  class="unum3" required value=""/></td>
                    <td><input type="text" id="udfm1"name="stdt[]"  class="unum3" value="" required/></td>
<!--                    <td><input type="text" id="udfm1"name="stdn[]"  class="unum3" value="" required/></td>-->
                </tr>
           
     

            </table>

 <hr>
 <p>Summary of Procedure</p>
   <hr>
 <p>
                       <td><textarea id="eq1" name="eqv" class="titranta"  required value="" cols="90" tabindex="7"/></textarea></td>
  
 </p>


            <p></p>
            <hr>
            Determination of Content of Active Ingredient in Sample
            <hr>
            <table class="tg-table-light">
                <tr>
                    <th>Std</th>
                    <th><select name="">
                            <option>Weight</option>
                            <option>Volume</option>
                            
                        </select><select name="">
                            <option>g</option>
                            <option>mg</option>
                            <option>mL</option>
                        </select></th>
<!--                    <th>Expected<br>(mL)</th>-->
                    <th>Final Vol.<br>(mL)</th>
                    <th>Initial Vol.<br>(mL)</th>
                    <th>Titre Vol.<br>(mL)</th>
<!--                    <th>Actual<br>(mg)</th>-->
<!--                    <th>% Content</th>-->
                </tr>
                <tr class="tg-even">
                    <td>A</td>
                    <td><input type="text" id="utcsv1" name="wv[]"  class="unum" required value="" tabindex="1"/></td>
<!--                    <td><input type="text" id="uecsv1" name="ev[]"  class="unum1" value="" required tabindex="2"/></td>-->
                    <td><input type="text" id="ucsvc1" name="fv[]"  class="unum2" value="" required /></td>
                    <td><input type="text" id="udfm1"name="iv[]"  class="unum3" value="" required/></td>
                    <td><input type="text" id="udfm1"name="tv[]"  class="unum3" value="" required/></td>
<!--                    <td><input type="text" id="udfm1"name="av[]"  class="unum3" value="" required/></td>-->
<!--                     <td><input type="text" id="udfm1"name=" dfm1"  class="unum3" value="" required/></td>-->
                </tr>
                <tr>
                    <td>B</td>
                    <td><input type="text" id="utcsv2" name="wv[]" class="unum"  required value="" tabindex="3"/></td>
<!--                    <td><input type="text" id="uecsv2" name="ev[]" class="unum1"  required value="" tabindex="4"/>-->
                    <td><input type="text" id="ucsvc2" name="fv[]"  class="unum2"required value=""/></td>
                    <td><input type="text" id="udfm2" name="iv[]"  class="unum3" required value=""/></td>
                    <td><input type="text" id="udfm1"name="tv[]"  class="unum3" value="" required/></td>
<!--                    <td><input type="text" id="udfm1"name="av[]"  class="unum3" value="" required/></td>-->
<!--                  <td><input type="text" id="udfm1"name=" dfm1"  class="unum3" value="" required/></td>-->

                </tr>
                <tr class="tg-even">
                    <td>C</td>
                    <td><input type="text" id="utcsv3" name="wv[]"  class="unum"  required value="" tabindex="5"/></td>
<!--                    <td><input type="text" id="uecsv3" name="ev[]" class="unum1"  required value="" tabindex="6"/></td>-->
                    <td><input type="text"  id="ucsvc3" name="fv[]" class="unum2"  required value="" /></td>
                    <td><input type="text" id="udfm3" name=" iv[]"  class="unum3" required value=""/></td>
                    <td><input type="text" id="udfm1"name="tv[]"  class="unum3" value="" required/></td>
<!--                    <td><input type="text" id="udfm1"name="av[]"  class="unum3" value="" required/></td>-->
<!--                     <td><input type="text" id="udfm1"name=" dfm1"  class="unum3" value="" required/></td>-->

                </tr>

            
                <tr>
                    <td></td>
                    <td></td>
                    <td>Blank Titre (mL)</td>
                    <td><input type="text" id="udfm1"name=" ev[]"  class="unum3" value="" required/></td>
                    <td></td>
<!--                    <td>RSD:</td>-->
<!--                    <td><input type="text" id="udfm1"name="av[]"  class="unum3" value="" required/></td>-->
<!--                      <td><input type="text" id="udfm1"name=" dfm1"  class="unum3" value="" required/></td>-->

                </tr>

            </table>
            <p><input type="button" value="Save Titration Assay  Data" id="Save"/></p>

        </div>
    </center>
</form>
