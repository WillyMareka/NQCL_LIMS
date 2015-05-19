
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
      //  display: none;
        
    }
    
</style>


<legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>analyst_controller" >Analyst Home</a> | <a href="<?php echo base_url(); ?>analyst_labreference" >Sample Summary Worksheet Upload</a>  </legend>
<hr />
<div class="upload">

<p><?php echo @$error;?></p>

<?php echo form_open_multipart('related_substances/save/'.$labref.'/'.$test_id);?>
    
<p><h2>Kindly only upload <?php echo $labref.'.xlsx';?> file!</h2><p>

<input type="file" name="worksheet" size="20" />

<br /><br />

<input type="submit" value="upload" />
   
</form>
</div>

