<!DOCTYPE html>
<style>
    .an_su{
        margin: 0 auto 0 auto;
        width: 550px;
        border-radius: 5px;
    }
        
        .success{
            background-color: greenyellow;
            display: none;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:black;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
            z-index: 100;
            opacity: .9;

        }

        .error{
            display: none;
            background-color: red;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:white;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        .selecterror{
            background-color: red;
            width:100%;            
            border-radius: 3px;
            color:white;
            display: none;
            text-align: center;
            padding-top: 1px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        
    }
    .an_su_details{
        width: 250px;
        float: right;
        margin-right: 50px;
    }

</style>
<script>
    $(document).ready(function(){
        $('#analyst').change(function(){
          var analyst=$("#analyst option:selected").text(); 
          $('#analyst_name').val(analyst);
        });
          $('#supervisor').change(function(){
          var supervisor=$("#supervisor option:selected").text(); 
          $('#supervisor_name').val(supervisor);
        });
        
    
    $('#an_su').click(function() {
        var sup = $('#supervisor').val();
        var ana = $('#analyst').val();
        if (sup == '') {
            var message='Kindly select a supervisor';
            $('#selecterror').text(message);
            $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
            return false;
        }
        else if(ana==''){                    
            $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
            return false;             
        }else {
                       
                        var data1 = $('#an_suF').serialize();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>analyst_supervisor/assign",
                            data: data1,
                            success: function(data)
                            {

                                // var content=$('.refsubs');
                                $('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                              

                                return true;
                            },
                            error: function(data) {
                                $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');                        


                                return false;
                            }
                        });
                        return true;
                    }
                });
        
    });
</script>
<?php 
$attr = array('id'=>'an_suF');
echo form_open('analyst_supervisor/assign/',$attr);?>
<fieldset class="an_su_details">
    <legend>Analysts and Assigned Supervisors</legend>
    <table>
        <tr>
            <th>Analyst</th><th></th><th>Supervisor</th><th>Unassign</th>
        </tr>
        <?php        foreach ($all as $yote) :?>
        <tr>
            
            <td><?php echo $yote->analyst_name?></td>
            <td></td>
            <td><?php echo $yote->supervisor_name?></td>
            <td><?php echo anchor("analyst_supervisor/unassign/".$yote->analyst_id."/".$yote->supervisor_id," X");?></td>
        </tr>
        <?php  endforeach;?>
    </table>
</fieldset>
<fieldset class="an_su">
    <legend>Assign Supervisors</legend> 
    <div class="success">Supervisor Assigned</div>
    <div class="error">An error occurred when assigning</div>
    <div class="selecterror">Kindly select an analyst and a supervisor</div>
    <p><strong>Analyst:</strong>&nbsp; <select name="analyst" id="analyst" class="box" required >
            <option value="" selected="selected">--Select Analyst--</option>
             <?php foreach ($analysts as $analyst) :
				echo "<option value=" .$analyst['id'].">".$analyst['fname']. " ".$analyst['lname']. "</option>";
            endforeach;
             ?>
        </select>
        &nbsp; &nbsp;<strong>Supervisor:</strong>&nbsp;
        <select name="supervisor" id="supervisor" class="box" required >
            <option value="" selected="selected">--Select Supervisor--</option>
            <?php foreach ($supervisors as $supervisor) :
				echo "<option value=" .$supervisor['id'].">".$supervisor['fname']. " ".$supervisor['lname']."</option>";
            endforeach;
             ?> 
        </select>
    
        <input type="button" value="Assign" id="an_su"class="submit-button"/>
    </p>
    <input type="hidden" name="analyst_name" id="analyst_name"/>
    <input type="hidden" name="supervisor_name" id="supervisor_name"/>
<?php echo form_close();?>
</fieldset>

