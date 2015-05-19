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
<form name="" action="" method="post" id="RdForm">
    <center>
        <div class="uniformity">
            <legend>  &#171; <?php echo anchor('analyst_controller', 'Back') ?></legend>
            <legend><h4>&#8801; NQCL &#187; RESULTS FOR DETERMINATION OF SAMPLE MELTING POINT &#187; SAMPLE : <?php echo $labref; ?> </h4></legend>
            <hr>
            <table class="tg-table-light">
                <tr>
                    <th colspan="2" rowspan="2">Samples</th>                                  
                    <th colspan="2">Range</th>
                    <th>Final readings</th>

                </tr>
                <tr class="tg-even">                    
                    <td><center>Start</center></td>
                <td><center>End</center></td>
                <td></td>

                </tr>
                <tr>
                    <td rowspan="3" valign="middle" > Calibration</td>  
                    <td>Vanillin Melting Point Standard</td>
                    <td><input type="text" id="pykwater2" name="smp1" class="pykwater rd"  required value="<?php echo $rda[0]->start; ?>" tabindex="4"/>
                    <td><input type="text" id="pyksample2" name="sen1"  class="pyksample rd" required value="<?php echo $rda[0]->end; ?>"/></td>
                    <td><input type="text" id="pyksample2" name="sfr1"  class="pyksample rd" required value="<?php echo $rda[0]->final_reading ?>"/></td>

                </tr>
                <tr class="tg-even"> 

                    <td>Phenacetin Melting Point Standard</td>
                    <td><input type="text" id="pykwater" name="smp2" class="pykwater rd"  required value="<?php echo $rda[1]->start; ?>" tabindex="6"/></td>
                    <td><input type="text"  id="pyksample3" name="sen2" class="pyksample rd" required  value="<?php echo $rda[1]->end; ?>" /></td>
                    <td><input type="text" id="pyksample2" name="sfr2"  class="pyksample rd" required value="<?php echo $rda[1]->final_reading; ?>"/></td>
                </tr>
                <tr>

                    <td>Caffeine Melting Point Standard</td>
                    <td><input type="text" id="pykwater" name="smp3" class="pykwater rd"  required value="<?php echo $rda[2]->start; ?>" tabindex="8"/></td>
                    <td><input type="text" id="pyksample4" name="sen3" class="pyksample rd"  required value="<?php echo $rda[2]->end; ?>"  /></td>
                    <td><input type="text" id="pyksample2" name="sfr3"  class="pyksample rd" required value="<?php echo $rda[2]->final_reading; ?>"/></td>
                </tr>
                <tr class="tg-even">
                    <td colspan="2"><center>Samples</center></td>                    
                <td><input type="text" id="meanofwater" name="smp4"   class="meanofwater rd" required value="<?php echo $rda[3]->start; ?>"  /></td>
                <td><input type="text" id="meanofsample" name="sen4" class="meanofsample rd" required value="<?php echo $rda[3]->end; ?>"/></td>
                <td><input type="text" id="meanofsample" name="sfr4" class="meanofsample rd"  required value="<?php echo $rda[3]->final_reading; ?>"/></td>
                </tr> 
            </table>

            <div id="massses">
                <table>
                    <tr>
                        <td>
                            <label>Melting Point of Sample: </label></td>
                        <td><input type="text" id="maw" name="sm_p" class="maw rd "   required value="<?php echo $rdb[0]->sample_melting_point; ?>"/>
                        </td>

                    </tr>
                </table>

            </div>
                     <p><input type="button" value="Submit Result" id="submit_result" style="background-color: #33ff33;color: #black;"/></p>    
        </div>
    </center>
</form>

<script>
    $(document).ready(function(){
           $('#submit_result').click(function(){        
                    dataString2 = $('#RdForm').serialize();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>wkstest_1/melting_point/<?php echo $labref; ?>",
                                    data: dataString2,
                                    success: function() {
                                    alert('Data exported successfully');
                                        },
                                    error: function(){
                                        alert('An error occured');
                                    }               
                          })
                });
    });
    </script>