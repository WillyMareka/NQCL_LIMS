<p><h1><center>pH MEASUREMENTS 2</center></h1></p>
<legend><a href="<?php echo base_url() ?>analyst_controller">Analyst Home</a>&nbsp;&rarr;&nbsp;pH Measurements 2</legend>
<hr />
<?php echo form_open('pH/pH_appendix_save/'.$labref."/".$test_id)?>
  <p><strong>Describe in Summary the reagent preparation procedures including mobile phase and buffers.:</strong><p>
  <p>
    <textarea name="phprep" id="phprep" cols="100" rows="5" required></textarea>
  </p>  
    <p><strong>Report any other tests carried out on the sample.:</strong><p>
  <p>
  <p>
    <textarea name="phprep1" id="phprep1" cols="100" rows="5" required></textarea>
  </p>
  <p><input type="submit" value="Save Appendix & Send" class="submit-button" id="FormSubmit"></input></p>
</form>
</body>
</html>