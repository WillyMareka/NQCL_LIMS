
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
<script>
    $(document).ready(function(){
        var success1 = $(".success");
        var error1 = $(".error");
        
        success1.hide();
        error1.hide();
        
        datastring=$('#uploads').serialize();
        $('#uploads').submit(function(e){
            e.preventDefault();    
        
            $.ajax({
                type:"POST",
                url:"<?php echo base_url() . 'analyst_uploads/do_upload/' . $labref; ?>",
                data:datastring,
                dataType:"JSON",
                success:function(msg){
                    alert('uploaded')  
                },
                error:function(msg){
                    alert('error');   
                }
            
            });
       
       
        });
    });




</script>
<input type="hidden" name="mysupersvisor_id" value="<?php echo $supervisor[0]->supervisor_id?>"/>
<legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>analyst_controller" >Analyst Home</a> | <a href="<?php echo base_url(); ?>analyst_labreference" >Sample Summary Worksheet Upload</a><div style="float:right">My supervisor:&nbsp;<?php echo $supervisor[0]->supervisor_name;?></div>  </legend>
<hr />
<div class="upload">

<div class="error" ><?php echo $error;?></div>

<?php echo form_open_multipart('analyst_uploads/do_upload/'.$labref);?>
    
<p><h2>Kindly only upload <?php echo $labref.'.xlsx';?> file!</h2><p>

<input type="file" name="worksheet" size="20" />

<br /><br />

<input type="submit" value="upload" />
   
</form>
</div>

