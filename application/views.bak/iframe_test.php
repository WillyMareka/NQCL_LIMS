<link href="<?php echo base_url().'CSS/style.css'?>" type="text/css" rel="stylesheet"/> 
<script src="<?php echo base_url().'Scripts/migrate.js'?>"></script>
<script src="<?php echo base_url().'Scripts/jquery-1.10.2.js'?>"></script>
<style>
    #what{
        width: 200px;
        height: 200px;
        background: blue;
    }
</style>
<script>
          $(document).ready(function(){
          $('#what').click(function(){
            alert('you clickt me');  
          });
        })
</script>
<div id="what">
    
</div>