
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
    
    .Result_record{
        float: left;
        width: 200px;
        height: 350px;
        background: greenyellow;
        border-radius: 5px;
        border: 1px solid black;
    }
    label{
        display: block;
        margin-top: 3px;
        margin-bottom: 5px;
    }
    .add{
        float: right;
        margin-right: 6px;
        margin-top: 5px;
        font-size: 18px;
    }
    
</style>
<div class="Result_record">
    <form method="post" action="<?php echo site_url('upload/get_data');?>">
    <div class="add"><a href="#">+Add</a></div>
    <fieldset>
      
        <legend>Test Results</legend>
        <label>Test Name: </label>
        <select name="test" id="">
            <option value="Assay">Assay</option>
            <option value="Dissolution">Dissolution</option>
        </select>
        <label>Component</label>
          <select name="component" id="">
            <option value="Lamivudine">Lamivudine</option>
            <option value="Zidovudine">Zidovudine</option>
        </select>
        <label>Average (%)</label>
        <input type="text" name="average"/>
        <label>RSD (%)</label>
        <input type="text" name="rsd"/>
        <label>n (%)</label>
        <input type="text" name="n"/>
    </fieldset>
    <input type="submit" value="Send Data"/>
</div>
<div class="upload">

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload_micro/'.$labref.'/'.$test_id);?>
    
<p>
<?php if($test_id =='50'){?>
<h2>Kindly only upload <?php echo $labref.'_microlal.xlsx';?> file!</h2>
<?php } else if($test_id =='49'){?>
 <h2>Kindly only upload <?php echo $labref.'_micro.xlsx';?> file!</h2>   
<?php }else{ ?>
 <h2>Kindly only upload <?php echo $labref.'.xlsx';?> file!</h2>   
<?php } ?>

<input type="file" name="worksheet" size="20" />

<br /><br />

<input type="submit" value="upload" />
   
</form>
</div>

