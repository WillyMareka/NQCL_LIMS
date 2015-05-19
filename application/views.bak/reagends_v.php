<head>
    <style type="text/css">
        table{
            width:734;
            border:#000000 1px solid;
            margin:auto;

        }
        td,th{
            border:#000 1px solid;
        } 

    </style>
    <script>
        $(document).ready(function(){
            $.ajax({  
                url:'<?php echo base_url(); ?>/reagends/get_reagend_names/',
                type:'POST',  
                dataType: 'json',
                success: function( json ) {        
                    $.each(json,function(key,val) {
                        $('select.rname').append('<option value="'+ key + '">' + val + '</option>');
                    });
                }
            });
            
              $.ajax({  
                url:'<?php echo base_url(); ?>/reagends/get_reagend_manufacture/',
                type:'POST',  
                dataType: 'json',
                success: function( json ) {        
                    $.each(json,function(key,val) {
                        $('select.mnfgname').append('<option value="'+ key + '">' + val + '</option>');
                    });
                }
            });
   
    
        });
        
    
        $(function() {
            $( "input.date" ).datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
</head>

<div class="reagends">
    <form name="" action="" method="">
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="7"><center><strong>REAGENT USED</strong></center></td>
            </tr>
            <tr>
                <td width="49">No.</td>
                <td width="126">Reagent Name </td>
                <td width="101">Manufacturer</td>
                <td width="89">Lot/Batch No.</td>
                <td width="118">Opened Date</td>
                <td width="91">Expiry date</td>
                <td width="128">Remarks</td>
            </tr>
            <tr>
                <td>1</td>
                <td><select name="rname1" id="rname1" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname1" id="mnfgname1" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch1" id="lbatch1" /></td>
                <td><input type="text" name="opdate1" id="opdate1" class="date" /></td>
                <td><input type="text" name="edate1" id="edate1" class="date" /></td>
                <td><input type="text" name="remarks1" id="remarks1" /></td>
            </tr>
            <tr>
                <td>2</td>
                <td><select name="rname2" id="rname2" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname2" id="mnfgname2" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch2" id="lbatch2" /></td>
                <td><input type="text" name="opdate2" id="opdate2" class="date"/></td>
                <td><input type="text" name="edate2" id="edate2" class="date"/></td>
                <td><input type="text" name="remarks2" id="remarks2" /></td>
            </tr>
            <tr>
                <td>3</td>
                <td><select name="rname3" id="rname3" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname3" id="mnfgname3" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch3" id="lbatch3" class="rname" /></td>
                <td><input type="text" name="opdate3" id="opdate3" class="date" /></td>
                <td><input type="text" name="edate3" id="edate3"  class="date"/></td>
                <td><input type="text" name="remarks3" id="remarks3" /></td>
            </tr>
            <tr>
                <td height="24">4</td>
                <td><select name="rname4" id="rname4" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname4" id="mnfgname4" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch4" id="lbatch4" /></td>
                <td><input type="text" name="opdate4" id="opdate4" class="date" /></td>
                <td><input type="text" name="edate4" id="edate4" class="date" /></td>
                <td><input type="text" name="remarks4" id="remarks4" /></td>
            </tr>
            <tr>
                <td>5</td>
                <td><select name="rname5" id="rname5" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname5" id="mnfgname5" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch5" id="lbatch5" /></td>
                <td><input type="text" name="opdate5" id="opdate5" class="date" /></td>
                <td><input type="text" name="edate5" id="edate5" class="date"/></td>
                <td><input type="text" name="remarks5" id="remarks5" /></td>
            </tr>
            <tr>
                <td>6</td>
                <td><select name="rname6" id="rname6" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname6" id="mnfgname6" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch6" id="lbatch6" /></td>
                <td><input type="text" name="opdate6" id="opdate6" class="date" /></td>
                <td><input type="text" name="edate6" id="edate6" class="date" /></td>
                <td><input type="text" name="remarks6" id="remarks6" /></td>
            </tr>
            <tr>
                <td>7</td>
                <td><select name="rname7" id="rname7" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname7" id="mnfgname7" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch7" id="lbatch7" /></td>
                <td><input type="text" name="opdate7" id="opdate7" class="date" /></td>
                <td><input type="text" name="edate7" id="edate7" class="date" /></td>
                <td><input type="text" name="remarks7" id="remarks7" /></td>
            </tr>
            <tr>
                <td>8</td>
                <td><select name="rname8" id="rname8" class="rname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><select name="mnfgname8" id="mnfgname8" class="mnfgname">
                        <option value="">-Select Name-</option>
                    </select></td>
                <td><input type="text" name="lbatch8" id="lbatch8" /></td>
                <td><input type="text" name="opdate8" id="opdate8" class="date" /></td>
                <td><input type="text" name="edate8" id="edate8"  class="date"/></td>
                <td><input type="text" name="remarks8" id="remarks8" /></td>
            </tr>
        </table>

        <input type="submit" value="Save" class="submit-button"/>
    </form>
</div>
<div id="items">Data</div>

