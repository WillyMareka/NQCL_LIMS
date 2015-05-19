<?php $this->load->view('template_v');?>
<style>
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
	border: 1px solid #bbb;
}
</style>
<script>
         $(document).ready(function(){             
             $('#component').hide();
                 if ($('#repeat').val() === "") {
                     alert('Kindly select run number from the left pane first');
                     return false;
                 } else {


                     $('#submit_result').click(function() {
                         dataString2 = $('#Ide').serialize();
                         $.ajax({
                             type: "POST",
                             url: "<?php echo base_url(); ?>wkstest/exportIdentificationExcel_t/<?php echo $labref; ?>",
                                                 data: dataString2,
                                                 success: function() {
                                                     alert('Data exported successfully');
                                                 },
                                                 error: function() {
                                                     alert('An error occured');
                                                 }
                                             });
                                         });
                                     }
                                     return true;
                                 });

            
    
</script>

<p> <center><legend><h2>NQCL Identification Results</h2></legend></center></p>

  
<?php echo form_open('identification/approve/' . $labref . '/' . $r,array('id'=>'Ide')); ?>
  

<center><div>

        <h4>Procedure</h4>
        <textarea name="identification" readonly cols="50" rows="5"><?php echo $identification[0]->description ?></textarea>
        <p></p>
         <h4>Finding</h4>
                <textarea name="specification" readonly cols="50" rows="5"><?php echo $identification[0]->specification ?></textarea>
                <p></p>
                 <h4>Specification</h4>
                <textarea name="value3" readonly cols="50" rows="5"><?php echo $identification[0]->value3 ?></textarea>

    </div></center>
 <p><input type="button" value="Submit Result" id="submit_result" style="background-color: #33ff33;color: #ffffff;"/></p>
</form>

