<style type="text/css">
    div.success{
        width: 400px;
        height: 50px;
        background-color: #00ff00;
        color: white;
        margin-top: 50px;
        margin-left: 20px;
    }
    
</style>


<div class="success"><h3>Worksheet: <?php echo $labref.'.xlsx';?> has been successfully uploaded and data exported to the database</h3></div>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>
