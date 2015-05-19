<script>
$(document).ready(function(){
    i=2;
      $('#addRow').click(function(){
          
        table= $('#comp_table > tbody');
        newRow =  "<tr>\n\
                     <td><strong>Component No. "+i+"</strong> (<a id='remRow' href='#remove'>-Remove</a>)</td>\n\
                    <td> <textarea name = 'compendia[]' placeholder='Enter Commpendia'required ></textarea></td>\n\
                   <td><textarea name = 'specification[]' placeholder='Enter Specification' required ></textarea></td>\n\
                   </tr>";
                               
           
                   i++;
        $('#comp_table > tbody tr:last').after( $(newRow) );


         
           return false;

        });
        
        $(document).on('click','#remRow', function(){
          $(this).closest('tr').remove();
          
          i-1;
            return false;
        });
});
</script>

<style>
    table td{
        display: block;
    }
    </style>

<html style = "overflow-x: hidden">
    <title>Add Compendia</title>
    <head></head>
 
    <form class = "methods" id = "<?php echo $formname ?>" >

        <table id='comp_table'>
            <label><a id="addRow" href="#add">+Add</a></label>
            <tbody>
              
            <tr>
                <td><strong>Component No. 1</strong></td>
                <td>                   
                    <textarea id="com_" name = "compendia[]" placeholder="Enter Commpendia" required ></textarea>
                </td> <br>
                 <td>
                     <textarea id="spec_"  name = "specification[]" placeholder="Enter Specification" required ></textarea>
                </td>
            </tr>
              
        </tbody>
        </table>
        <input name = "request_id" type = "hidden" value = "<?php echo $reqid ?>" >
        <input name = "test_id" type = "hidden" value = "<?php echo $test_id ?>" >
        <input id = "submit" type = "submit" class = "submit-button leftie" value = "Save" >
        <input id = "cancel" type = "submit" class = "submit-button leftie" value = "Cancel" >
    </form>

    <script type="text/javascript">

        //Validate with Validation Engine (JS)
        $('#<?php echo $formname ?>').validationEngine({
            promptPosition: "topRight",
            'custom_error_messages': {
                'required': {
                    'message': "* Required."
                }
            },
            autoPositionUpdate: true,
            scroll: false
        });

        //Save
        $('#<?php echo $formname ?>').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . $save_url . "/compendia_save/" ?>',
                data: $('#<?php echo $formname ?>').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        //parent.$.fancybox.close();
                        $('#submit').remove();
                        var wksht_url = '<?php echo base_url() . $worksheet_name . "/" . "worksheet" . "/" . $reqid . "/" . $test_id ?>'
                        console.log(wksht_url)
                        parent.document.location = wksht_url;
                    }
                    else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function() {
                }
            })
        });
        
        $('#cancel').click(function(){
        alert('Compendia and Specification Must be added, Taking you home....');
        window.location.href="<?php echo base_url();?>analyst_controller/";
        });

    </script>

</html>