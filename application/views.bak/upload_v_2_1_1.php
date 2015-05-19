<script>
$(document).ready(function() {

    
    $("input.case").click(assay);
    $("input.dcase").click(dissolution);
    $('#coa_updater').click(function(){
        $(this).prop('value','Updating please wait....');
        $(this).prop('disabled','disabled');
       $.post("<?php echo site_url('upload/post_results/'.$labref.'/'.$test_id);?>",$('#post_results').serialize(), function(){ 
           alert('COA Results successfully updated');
           $(this).prop('value','Update COA Results');
        $(this).prop('disabled',false);
           window.location.href="<?php echo base_url();?>reviewer/";
    }).fail(function(){
        alert('An error has occured when updating COA Results, Try again Later');
        return false;
    });
    
});
});

function assay() {

    var values = [];
    $("input[name='case[]']:checked").closest("tr").each(function () {
        var tds = $(this).children();
        values.push(tds.eq(0).text() + " " + tds.eq(1).text() + "%(RSD = " + tds.eq(2).text() + "% ; n = " + tds.eq(3).text() + ")");
    });

    $('#tassay').text(values.join (" : "));
}

function dissolution() {

    var values = [];
    $("input[name='dcase[]']:checked").closest("tr").each(function () {
        var tds = $(this).children();
        data=parseFloat(tds.eq(1).text())
        values.push( data.toFixed(6)+" EU/mg" );
    });

    $('#tdiss').text(values.join (" : "));
}
     



    

</script>
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
        width: 750px;
        min-height: 350px;
        background: greenyellow;
        border-radius: 5px;
        border: 1px solid black;
        margin-left: 5px;
    }
      .preview{
        float: right;
        width: 300px;
        min-height: 350px;
        background: greenyellow;
        border-radius: 5px;
        border: 1px solid black;
        margin-left: 790px;
        position: absolute;
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
 <form id="post_results" method="post" action="<?php echo site_url('upload/get_data');?>">
<div class="preview ">
    <fieldset>
        <legend>Selection Preview</legend>
        <form>
            <table>
                <tr>
                    Dissolution 
                </tr>
                <tr></tr>
                <tr><textarea cols="32" rows="5" id="tassay" name="ass_r"></textarea></tr>
                <tr></tr>
                <tr>Assay</tr>
                <tr></tr>
                <tr><textarea cols="32" rows="5" id="tdiss" name="diss_r"></textarea></tr>
            <tr></tr>
            <tr>
                <input type="button" value="Update COA Results" id="coa_updater"/>
            </tr>
            </table>
  
    </fieldset> 
</div>
<div class="Result_record">
   
        
    <fieldset>
      
        <table class="summary">
            <tr>
            <th>Component</th>
            <th>Average</th>
            <th>RSD</th>
            <th>n</th>
            <th>Select</th>
            </tr>
            <tbody>
                <tr>
                    <td colspan="3"><center><strong><u>Microbial Assay Test</u></strong></center></td>
        <input type="hidden" value="5" name="assay"/>
                </tr>
                <?php foreach($assay as $as):?>
                <tr class="assay_row">
                    <td><?php echo $as->component;?></td>
                    <td><?php echo round($as->average,2);?></td>
                    <td><?php echo round($as->rsd,2);?></td>
                    <td><?php echo $as->n;?></td>
                     <td><input type="checkbox" name="case[]" class="case" /></td> 
                </tr>
                <?php endforeach;?>
                <tr >
                    <td colspan="3"><center><strong><u>Bacterial Endotoxin Test</u></strong></center></td>
        <input type="hidden" value="2" name="dissolution"/>
                </tr>
                <tr>
                     <?php foreach($dissolution as $ds):?>
                    <td><?php echo $ds->component;?></td>
                    <td><?php echo $ds->average;?></td>                  
                    <td><input type="checkbox" name="dcase[]" class="dcase"/></td>  
                </tr>
                  <?php endforeach;?>
                <tr>
                </tr>
               
            </tbody>
        </table>
    </fieldset>
    
    
</div>
         </form>



