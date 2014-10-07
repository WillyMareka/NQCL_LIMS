<style type="text/css">
    div.success{
        width: 400px;
        height: 50px;
        background-color: #00ff00;
        color: white;
        margin-top: 50px;
        margin-left: 20px;
        border: 2px solid #0066cc;
         -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }
    
</style>

<legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>analyst_controller" >Analyst Home</a> | <a href="<?php echo base_url(); ?>analyst_labreference" >Sample Worksheet Upload</a>  </legend>
<hr />
<div class="success"><h3>Worksheet: <?php echo $labref.'.xlsx';?> has been successfully uploaded and data exported to the database</h3></div>


