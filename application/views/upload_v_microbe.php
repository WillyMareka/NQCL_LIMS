
<style type="text/css">
    div.upload{
        width: 400px;
        height: 200px;
        background-color: #E5E5E5;
        margin: auto;
        padding-top: 50px;
        padding-left: 80px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: 3px solid;
        border-color: #009900;

    }
    div.upload1{
        margin: auto;
    }
    h2{
        margin: auto;
        color:green;
    }
    
</style>
<div class="upload">
    <center><strong>BACTERIAL ENDOTOXIN WORKSHEET UPLOAD AREA</strong></center>
<?php echo $error;?>

<?php echo form_open_multipart('analyst_uploads/do_upload_be/'.$labref.'/'.$test_id);?>
    
<p><h3>Kindly only upload <?php echo $labref.'_microlal.xlsx and ' .$labref.".pdf" ;?> Workbook!</h3><p>

<input type="file" name="worksheet" size="20" />

<br /><br />

<input type="submit" value="upload" />
   
</form>
</div>

