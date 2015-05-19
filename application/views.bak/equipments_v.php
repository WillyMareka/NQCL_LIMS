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
                url:'<?php echo base_url(); ?>/equipments/get_equipment_names/',
                type:'POST',  
                dataType: 'json',
                success: function( json ) {        
                    $.each(json,function(key,val) {
                        $('select.ename').append('<option value="'+ key + '">' + val + '</option>');
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
                <td colspan="7"><center>
                <strong>EQUIPMENTS USED</strong>
              </center></td>
            </tr>
            <tr>
                <td width="49">No.</td>
                <td width="126"><strong>Equipment  Name</strong></td>           
                <td width="89"><strong>NQCL  No./Code</strong></td>
                <td width="118"><strong>Date  of Last Calibration</strong></td>
                <td width="91"><strong>Date  of Next Calibration</strong></td>
                <td width="128">Remarks</td>
            </tr>
            <tr>
                <td>1</td>
                <td><select name="ename1" id="ename1" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
                
                <td><input type="text" name="enqcl_no1" id="enqcl_no1" /></td>
                <td><input type="text" name="lcdate1" id="lcdate1" class="date" /></td>
                <td><input type="text" name="ncdate1" id="ncdate1" class="date" /></td>
                <td><input type="text" name="remarks1" id="remarks1" /></td>
            </tr>
            <tr>
                <td>2</td>
                <td><select name="ename2" id="ename2" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
                
                <td><input type="text" name="enqcl_no2" id="enqcl_no2" /></td>
                <td><input type="text" name="lcdate2" id="lcdate2" class="date"/></td>
                <td><input type="text" name="ncdate2" id="ncdate2" class="date"/></td>
                <td><input type="text" name="remarks2" id="remarks2" /></td>
            </tr>
            <tr>
                <td>3</td>
                <td><select name="ename3" id="ename3" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
              
                <td><input type="text" name="enqcl_no3" id="enqcl_no3" class="ename" /></td>
                <td><input type="text" name="lcdate3" id="lcdate3" class="date" /></td>
                <td><input type="text" name="ncdate3" id="ncdate3"  class="date"/></td>
                <td><input type="text" name="remarks3" id="remarks3" /></td>
            </tr>
            <tr>
                <td height="24">4</td>
                <td><select name="ename4" id="ename4" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
                
                <td><input type="text" name="enqcl_no4" id="enqcl_no4" /></td>
                <td><input type="text" name="lcdate4" id="lcdate4" class="date" /></td>
                <td><input type="text" name="ncdate4" id="ncdate4" class="date" /></td>
                <td><input type="text" name="remarks4" id="remarks4" /></td>
            </tr>
            <tr>
                <td>5</td>
                <td><select name="ename5" id="ename5" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
             
                <td><input type="text" name="enqcl_no5" id="enqcl_no5" /></td>
                <td><input type="text" name="lcdate5" id="lcdate5" class="date" /></td>
                <td><input type="text" name="ncdate5" id="ncdate5" class="date"/></td>
                <td><input type="text" name="remarks5" id="remarks5" /></td>
            </tr>
            <tr>
                <td>6</td>
                <td><select name="ename6" id="ename6" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
               
                <td><input type="text" name="enqcl_no6" id="enqcl_no6" /></td>
                <td><input type="text" name="lcdate6" id="lcdate6" class="date" /></td>
                <td><input type="text" name="ncdate6" id="ncdate6" class="date" /></td>
                <td><input type="text" name="remarks6" id="remarks6" /></td>
            </tr>
            <tr>
                <td>7</td>
                <td><select name="ename7" id="ename7" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
            
                <td><input type="text" name="enqcl_no7" id="enqcl_no7" /></td>
                <td><input type="text" name="lcdate7" id="lcdate7" class="date" /></td>
                <td><input type="text" name="ncdate7" id="ncdate7" class="date" /></td>
                <td><input type="text" name="remarks7" id="remarks7" /></td>
            </tr>
            <tr>
                <td>8</td>
                <td><select name="ename8" id="ename8" class="ename">
                        <option value="">-Select Name-</option>
                    </select></td>
          
                <td><input type="text" name="enqcl_no8" id="enqcl_no8" /></td>
                <td><input type="text" name="lcdate8" id="lcdate8" class="date" /></td>
                <td><input type="text" name="ncdate8" id="ncdate8"  class="date"/></td>
                <td><input type="text" name="remarks8" id="remarks8" /></td>
            </tr>
        </table>

        <input type="submit" value="Save" class="submit-button"/>
    </form>
</div>
<div id="items">Data</div>

