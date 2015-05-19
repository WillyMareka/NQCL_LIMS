
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
    div.error{
        color: red;
        font-family: sans-serif;
        font-weight: bolder;
        text-decoration-style: solid;
        
    }
    
</style>
<legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>analyst_controller" >Analyst Home</a> | <a href="<?php echo base_url(); ?>labreference" >Sample Summary Worksheet Upload</a>  </legend>
<hr />
<div class="upload">

<div class="error" ><?php echo $error;?></div>

<?php echo form_open_multipart('upload/do_upload_repeated/'.$labref);?>
<p><h2>REPEATED TEST FOR SAMPLE: <?php echo $labref;?>!</h2></p>  
<p><h2>Kindly select a worksheet to upload e.g. <?php echo $labref;?>_R*.xlsx </h2><p>

<input type="file" name="worksheet" size="20" />

<br /><br />

<input type="submit" value="upload" />
   
</form>
</div>

