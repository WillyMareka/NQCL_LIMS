<p><h3><center>ASSAY DATA FORM</center><h3></p>
        <p><strong><?php echo "NQCL/WKS/".date('Y')."/". $lastworksheet;?></strong></p>
<hr />
<?php echo form_open('uniformity/save_assay_data/')?>
  <p><strong>Standard Preparation for Assay:</strong><p>
  <p>
    <textarea name="sppa" id="sppa" cols="100" rows="5" required></textarea>
  </p>  
    <p><strong>Sample Preparation for Assay:</strong><p>
  <p>
    <textarea name="spp" id="spp" cols="100" rows="5" required></textarea>
  </p>

  <p><input type="submit" value="Save Assay Data" class="submit-button" id="FormSubmit"></input></p>
</form>
</body>
</html>