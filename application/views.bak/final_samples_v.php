<?php
error_reporting(0);
$this->load->view('template_v');
foreach ($worksheetInfo as $Info)
    ;
?>
<style>
    fieldset#SampleAssay{
       // width: 480px;

    }
    .peaks{
        float: right;
        width:200px;
    }

    fieldset.weight{
        width:200px;
        margin-left:10px;
        float:left;
    }
    fieldset.tabscaps{
        width:190px;
        margin-left:10px;
        float:left;  
    }

    fieldset.dissoultion{
        width:200px;
        margin-left:10px;
        float:left;
    }
    label{
        font-weight: bold;
        margin-bottom: 3px;
        display:block;
        margin: 5px;
    }
    #head{
        width: 100%;
        height: 40px;
        background-color: black;
        color:white;
        text-align: center;
        line-height: 40px;

    }
    #ExportAssay,#ExportDissolution{
/*        display: none;*/
    }
            form input,select,textarea {
	//width: 70%;
	padding: 5px;
	border: 1px solid #d4d4d4;
	border-bottom-right-radius: 5px;
	border-top-right-radius: 4px;
	
	line-height: 1.5em;
	//float: right;
	
	/* some box shadow sauce :D */
	box-shadow: inset 0px 2px 2px #ececec;
}
form input:focus {
	/* No outline on focus */
	outline: 0;
	/* a darker border ? */
	border: 1px solid #bbb;
}
</style>
<script>
    $(document).ready(function() {
        posting="<?php echo $posting_summary;?>";
            if(posting!=0){
         //$('#Export').hide();
         $('#ExportAssay').show();
         // $('#ExportAssay').show();
            }else{
             $('#Export').show();
         $('#ExportAssay').hide();
          $('#ExportAssay').hide();   
            }
          dataString2 = $('#sampleForm').serialize();
        $(function() {
            $("#DateCompleted").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'd-M-y'
            });

        });


        var nda = 'No data available';
        $(".worksheetInfoData[value='']").val(nda)
        $(".worksheetInfoData[value='']").css("color", "red")
        $(".worksheetInfoData[value='']").attr("disabled", "disabled");
         $(".dissdata[value='']").val(nda)
        $(".dissdata[value='']").css("color", "red")
        $(".dissdata[value='']").attr("disabled", "disabled");
        $(".dissdata[value='0']").val(nda)
        $(".dissdata[value='0']").css("color", "red")
        $(".dissdata[value='0']").attr("disabled", "disabled");
        $('#Export').click(function() {
            $(this).prop('value', 'Exporting, Please Wait...');
            $(this).prop('disabled', true);

          
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('wkstest/getDataToExcel/'.$labref.'/'.$r.'/'.$c); ?>",
                                data: dataString2,
                                success: function() {

                                    $('#Export').prop('value', '');
                                    $('#Export').prop('disabled', false);
                                    $('#Export,.exp1').hide();
                                    $('#href').show();

                                },
                                error: function() {
                                    alert('An internal problem has been experienced, data could not be exported!');
                                }

                            });
                        });

                        $('#ExportAssay').click(function() {

                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>wkstest/postRepeats/<?php echo $labref . "/" . $r . "/" . $c; ?>",
                                                data: dataString2,
                                                success: function() {

                                                    $('#Export').prop('value', '');
                                                    $('#Export').prop('disabled', false);
                                                    $('#Export,.exp1').hide();
                                                    $('#href').show();

                                                },
                                                error: function() {
                                                    alert('An internal problem has been experienced, data could not be exported!');
                                                }

                                            });
                                        });

                                        $('#ExportDissolution').click(function() {

                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo base_url(); ?>wkstest/postRepeats/<?php echo $labref . "/" . $r . "/" . $c; ?>",
                                                                data: dataString2,
                                                                success: function() {

                                                                    $('#Export').prop('value', '');
                                                                    $('#Export').prop('disabled', false);
                                                                    $('#Export,.exp1').hide();
                                                                    $('#href').show();

                                                                },
                                                                error: function() {
                                                                    alert('An internal problem has been experienced, data could not be exported!');
                                                                }

                                                            });

                                                        });
                                                    });

                            
                          


</script>
<div id='head'>
    <?php if ($r > 1) {
        $repeat = $r - 1; ?>

        <h1>Sample: <?php echo $Info->request_id . ' Repeat ' . $repeat . ' for'; ?> <?php echo $component_name[0]->component; ?> </h1>
<?php } else { ?>
        <h1>Sample: <?php echo $Info->request_id; ?> Component Name: <?php echo $component_name[0]->component; ?> </h1>
<?php } ?>
</div>
<?php $attributes = array('id' => 'sampleForm'); ?>
<?php echo form_open('' . $labref . '/' . $r, $attributes); ?>

<input type="text" name="head" value="<?php echo $component_name[0]->component; ?>"/>
<input type="text" name="component_no" value="<?php echo $c; ?>"/>


<?php foreach ($stdweight as $weight)
    ; ?>


   <?php 
 //var_dump($diss_conds_conc);
             foreach ($diss_conds_conc as $diss_conds)
                 
              foreach ($stage_2_conds as $diss_conds_2)  
                
                ?> 


<div class='overallarea'>
    <fieldset class="overall"> 
        <legend></legend><h3>Worksheet & Assay Information </h3>
        <fieldset class="weight">
            <legend></legend><h3>Worksheet Information</h3> 
            <label for="SampleName"> Sample Name :</label>  <input type="text" name="SampleName" value="<?php echo $Info->product_name; ?>" class="worksheetInfoData"/><p></p>
            <label for="LabRef"> Lab Reference No :</label>  <input type="text" name="LabRef" value="<?php echo $Info->request_id; ?>" class="worksheetInfoData"/><p></p>
            <label for="LabelClaim">Label Claim:</label> <textarea class="worksheetInfoData" name="LabelClaim" ><?php echo $Info->label_claim; ?></textarea><p></p>
            <label for="ActiveInng">Active Ingredient</label> <input type="text" name="ActiveInng" value="<?php echo $Info->active_ing; ?>" class="worksheetInfoData"/><p></p>
            <label for="DateCompleted" >Date Completed :</label>  <input type="text" name="DateCompleted"  id="DateCompleted" class="worksheetInfoData"/><p></p>

        </fieldset>  

        <fieldset class="weight">
            <legend></legend><h3>Standard Assay </h3>
            <label for="potency">POTENCY:</label>:  <input type="text" name="potency" value="<?php echo $stddesired->potency."%"; ?>" class="worksheetInfoData"/><p></p>

            <label for="assayDesired">Desired Weight:</label>:  <input type="text" name="assayDesired" value="<?php echo $stddesired->desired_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for="standardA">Standard A: </label><input type="text" name="standardA" value="<?php echo $stdweight['0']->weight; ?>" class="worksheetInfoData"/><p></p>
            <label for="standardB"> Standard B: </label><input type="text" name="standardB" value="<?php echo $stdweight['1']->weight; ?>" class="worksheetInfoData"/>
            <label for="dconcetration"> Desired Concetration: </label><input type="text" name="dconcetration" value="<?php echo $stddesired->concetration; ?>" class="worksheetInfoData"/>

        </fieldset>

     

            <fieldset class="weight">
                <legend><h4>Powder weight</h4></legend>

                <?php
                foreach ($sample_assay as $assay)
                    ;
                ?>

<?php foreach ($sample_assay_desired as $desired)
    ; ?>

                <p>
                    <label for ="sampleDesiredpw">Desired :</label> <input type="text" name="sampleDesiredpw" value="<?php echo $desired->powder_weight; ?>" class="worksheetInfoData"/></p>
                <label for ="sasandarda"> Sample A:</label> <input type="text" name="sastandarda" value="<?php echo $sample_assay [1]->powder_weight; ?>" class="worksheetInfoData"/><p></p>
                <label for ="sasandardb">Sample B:</label> <input type="text" name="sastandardb" value="<?php echo $sample_assay [2]->powder_weight; ?>" class="worksheetInfoData"/><p></p>
                <label for ="sasandardc">Sample C:</label> <input type="text"  name="sastandardc" value="<?php echo $sample_assay [3]->powder_weight; ?>" class="worksheetInfoData"/>
            </fieldset>
            <fieldset class="weight">
                <legend><h4>Eq. Wt.(mg)</h4></legend>
                <label for="ampleDesiredap" >  Desired  :</label> <input type="text" name="sampleDesiredap"value="<?php echo $desired->api_weight; ?>" class="worksheetInfoData"/><p></p>
                <label for ="apstandarda"> Sample A : </label> <input type="text" name="apstandarda" value="<?php echo $sample_assay [1]->api_weight; ?>" class="worksheetInfoData"/><p></p>
                <label for ="apstandardb"> Sample B:</label> <input type="text" name="apstandardb" value="<?php echo $sample_assay [2]->api_weight; ?>" class="worksheetInfoData"/><p></p>
                <label for ="apstandardc">Sample C: </label><input type="text" name="apstandardc" value="<?php echo $sample_assay [3]->api_weight; ?>" class="worksheetInfoData"/><p></p>
                <label for ="sampleconcetration">Sample Concetration: </label><input type="text" name="sampleconcetration" value="<?php echo $sample_assay['0']->concetration; ?>" class="worksheetInfoData"/>
            </fieldset> 
            
            <!--<fieldset>-->
               
            
            <input type="button" value="Export Assay Repeat" id="ExportAssay" class="submit-button"/>
        <!--</fieldset>-->
        <fieldset style="width:450px;">
            <legend>ASSAY PEAK AREAS</legend>
            <fieldset style="width: 160px;float: left;">
                <legend>STD</legend>
                <div class="refsub1" >
        <label class="rf">AREAS / ABSORBANCE</label><br>
            <table class="tg-table-light">
  <tr>
    <th></th>
  </tr>
   <tr class="tg-even">
    <td> A &dArr;</td>
    <td ></td>

  </tr>
  <tr class="tg-even">
    <td class="mgml1"><input type="text" name="speak[]" value="<?php echo $assay_stdpeaks_ab[0]->peak_area;?>" id="speaka1"   class="areas worksheetInfoData" /></td>

  </tr>
  <tr>
      <td class="mgml1"><input type="text" name="speak[]" value="<?php echo $assay_stdpeaks_ab[1]->peak_area;?>" id="speaka2"   class="areas worksheetInfoData" /></td>

  </tr>
  <tr class="tg-even">
   <td class="mgml1"><input type="text" name="speak[]" value="<?php echo $assay_stdpeaks_ab[2]->peak_area;?>" id="speaka3"  class="areas worksheetInfoData"  /></td>
  </tr>
  <tr>
      <td>B &dArr;</td>
    <td ></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="<?php echo $assay_stdpeaks_ab[3]->peak_area;?>" id="speakb1"  class="areas worksheetInfoData"  /></td>
  </tr>
  </tr>
  <tr>
    <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="<?php echo $assay_stdpeaks_ab[4]->peak_area;?>" id="speakab2"   class="areas worksheetInfoData" /></td>
  </tr>
  <tr class="tg-even">
    <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="<?php echo $assay_stdpeaks_ab[5]->peak_area;?>" id="speaka3"   class="areas worksheetInfoData" /></td>
  </tr>
  
</table
    </div>
            </fieldset>
            <fieldset style="width: 170px; float: right;">
                <legend>SAMPLE</legend>
                <table class="tg-table-light">
<tr class="tg-even">
    <td ></td>

  </tr>
  <tr class="tg-even"> 
    <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965829" value="<?php echo $assay_samplepeaks[0]->peak_area;?>" id="smpeak1"   class="areas worksheetInfoData" /></td>

  </tr>
  <tr>
      <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[1]->peak_area;?>" id="smpeak2"   class="areas worksheetInfoData" /></td>

  </tr>
  <tr class="tg-even">
      <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[2]->peak_area;?>" id="smpeak3"   class="areas worksheetInfoData" /></td>
  </tr>
  <tr>
    <td ></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[3]->peak_area;?>" id="smpeak4"   class="areas worksheetInfoData" /></td>
  </tr>
  </tr>
  <tr>
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[4]->peak_area;?>" id="smpeak5"   class="areas worksheetInfoData" /></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[5]->peak_area;?>" id="smpeak6"    class="areas worksheetInfoData"/></td>
  </tr>
  <tr>
  <td ></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[6]->peak_area;?>" id="smpeak7"  class="areas worksheetInfoData"  /></td>
  </tr>
   <tr >
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[7]->peak_area;?>" id="smpeak8"   class="areas worksheetInfoData" /></td>
  </tr>
   <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="<?php echo $assay_samplepeaks[8]->peak_area;?>" id="smpeak9"   class="areas worksheetInfoData" /></td>
  </tr>
</table>
            </fieldset>
        </fieldset>

        <fieldset class="classB">

            <legend><h3>Uniformity of Weight & Dissolution Data</h3></legend>

            <fieldset class="tabscaps">
                <legend><h4>Uniformity of Weight</h4></legend>

                <label for="tabcapssaverage" >  Tabs/Caps Average Weight :</label> <input type="text" name="tabcapssaverage" value="<?php echo @$tabs->average; ?>" class="worksheetInfoData"/><p></p>

            </fieldset>
            <fieldset class="dissoultion">
                <legend><h4>Dissolution Tab Weights</h4></legend>
                <p></p>
                <label for="tab1">Tab 1:</label> <input type="text" name="tab1" value="<?php echo $dissolutionts['0']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
                <label for="tab2">Tab 2:</label>  <input type="text" name="tab2" value="<?php echo $dissolutionts['1']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
                <label for="tab3">Tab 3:</label> <input type="text" name="tab3" value="<?php echo $dissolutionts['2']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
                <label for="tab4">Tab 4:</label> <input type="text" name="tab4" value="<?php echo $dissolutionts['3']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
                <label for="tab5">Tab 5:</label><input type="text" name="tab5" value="<?php echo $dissolutionts['4']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
                <label for="tab6">Tab 6:</label> <input type="text" name="tab6" value="<?php echo $dissolutionts['5']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
            </fieldset>
            <fieldset class="dissoultion">
                <legend><h4>Dissolution Data</h4></legend>
<?php foreach ($dissolutionData as $data)
    ; ?>

                <label for="desiredweight">Desired Weight: </label><input type="text" name="desiredweight"value="<?php echo $data->desired_weight; ?>" class="worksheetInfoData"/><p></p>
                <label for="disstda">Standard A:</label>  <input type="text" name="disstda" value="<?php echo $data->stda; ?>" class="worksheetInfoData"/><p></p>
                <label for="disstdb">Standard B:</label> <input type="text" name="disstdb" value="<?php echo $data->stdb; ?>" class="worksheetInfoData"/><p></p>
                <label for="concetration"> Concetration:</label> <input type="text" name="concetration" value="<?php echo $data->desired_conc; ?>" class="worksheetInfoData"/><p></p>
                <label for="tabverage">Tablets Average: </label><input type="text" name="tabaverage" value="<?php echo $data->tabs_caps_mean; ?>" class="worksheetInfoData"/><p></p>

            </fieldset>
            
            <fieldset>
             <legend>DISSOLUTION </legend>
         
                <table class="tg" id="top-table-right">
                    <tr>
                        <th class="tg-031e" colspan="5"><center>TIME (mins)</center></th>

                    </tr>

                    <tr class="tg-even">
                        <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken; ?>" name="area111" id="area-111" class="dissolution-class1 dissdata tar1 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken2; ?>" name="area121" id="area-121" class="dissolution-class1 dissdata tar2 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken3; ?>" name="area131" id="area-131" class="dissolution-class1 dissdata tar3 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken4; ?>" name="area141" id="area-141" class="dissolution-class1 dissdata tar4 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $diss_conds->time_taken5; ?>" name="area151" id="area-151" class="dissolution-class1 dissdata tar5 worksheetInfoData" readonly tabindex=""/></td>
                    </tr>  
                    <tr>
                        <th class="tg-031e" colspan="5"><center>ABSORBANCES</center></th>

                    </tr>



                    <tr class="tg-even">
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_1;?>" name="area1[]" id="area-11" class="dissolution-class1 dissdata area1 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_2;?>" name="area2[]" id="area-12" class="dissolution-class1 dissdata area2 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_3;?>" name="area3[]" id="area-13" class="dissolution-class1 dissdata area3 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_4;?>" name="area4[]" id="area-14" class="dissolution-class1 dissdata area4 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[0]->area_5;?>" name="area5[]" id="area-15" class="dissolution-class1 dissdata area5 worksheetInfoData" readonly tabindex=""/></td>
                    </tr>
                    <tr>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_1;?>" name="area1[]" id="area-21" class="dissolution-class1 dissdata area1 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_2;?>" name="area2[]" id="area-22" class="dissolution-class1 dissdata area2 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_3;?>" name="area3[]" id="area-23" class="dissolution-class1 dissdata area worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_4;?>" name="area4[]" id="area-24" class="dissolution-class1 dissdata area4 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[1]->area_5;?>" name="area5[]" id="area-25" class="dissolution-class1 dissdata area5 worksheetInfoData" readonly tabindex=""/></td>
                    </tr>
                    <tr class="tg-even">
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_1;?>" name="area1[]" id="area-31" class="dissolution-class1 dissdata area1 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_2;?>" name="area2[]" id="area-32" class="dissolution-class1 dissdata area2 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_3;?>" name="area3[]" id="area-33" class="dissolution-class1 dissdata area3 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_4;?>" name="area4[]" id="area-34" class="dissolution-class1 dissdata area4 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[2]->area_5;?>" name="area5[]" id="area-35" class="dissolution-class1 dissdata area5 worksheetInfoData" readonly tabindex=""/></td>
                    </tr>
                    <tr>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_1;?>" name="area1[]" id="area-41" class="dissolution-class1 dissdata area1 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_2;?>" name="area2[]" id="area-42" class="dissolution-class1 dissdata area2 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_3;?>" name="area3[]" id="area-43" class="dissolution-class1 dissdata area3 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_4;?>"  name="area4[]" id="area-44" class="dissolution-class1 dissdata area4 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[3]->area_5;?>" name="area5[]" id="area-45" class="dissolution-class1 dissdata area5 worksheetInfoData" readonly tabindex=""/></td>
                    </tr>
                    <tr class="tg-even">
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_1;?>" name="area1[]" id="area-51" class="dissolution-class1 dissdata area1 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_2;?>" name="area2[]" id="area-52" class="dissolution-class1 dissdata area2 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_3;?>" name="area3[]" id="area-53" class="dissolution-class1 dissdata area3 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_4;?>" name="area4[]" id="area-54" class="dissolution-class1 dissdata area4 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-z2zr"><input type="text" value="<?php echo $area_absorb[4]->area_5;?>" name="area5[]" id="area-55" class="dissolution-class1 dissdata area5 worksheetInfoData" readonly tabindex=""/></td>
                    </tr>
                    <tr>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_1;?>" name="area1[]" id="area-61" class="dissolution-class1 dissdata area1 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_2;?>" name="area2[]" id="area-62" class="dissolution-class1 dissdata area2 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_3;?>" name="area3[]" id="area-63" class="dissolution-class1 dissdata area3 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[5]->area_4;?>" name="area4[]" id="area-64" class="dissolution-class1 dissdata area4 worksheetInfoData" readonly tabindex=""/></td>
                        <td class="tg-031e"><input type="text" value="<?php echo $area_absorb[4]->area_5;?>" name="area5[]" id="area-65" class="dissolution-class1 dissdata area5 worksheetInfoData" readonly tabindex=""/></td>
                    </tr>
                </table>
            </fieldset>
                
                <div class="refsub1" style="position:absolute; margin-left: 700px; top: 1120px;">
                    <label class="rf">DISSOLUTION STD AREAS</label><br>
                        <table class="tg-table-light">
                            <tr>
                                <th></th>
                            </tr>
                            <tr class="tg-even">
                                <td> A &dArr;</td>
                                <td ></td>

                            </tr>
                            <tr class="tg-even">
                                <td class="mgml1"><input type="text" value="<?php echo $pareas[0]->peak_area;?>" name="speakd[]" placeholder="965852" value="" id="speaka1" readonly  class="areas worksheetInfoData" /></td>

                            </tr>
                            <tr>
                                <td class="mgml1"><input type="text" value="<?php echo $pareas[1]->peak_area;?>" name="speakd[]" placeholder="965852" value="" id="speaka2" readonly  class="areas worksheetInfoData" /></td>

                            </tr>
                            <tr class="tg-even">
                                <td class="mgml1"><input type="text" value="<?php echo $pareas[2]->peak_area;?>" name="speakd[]" placeholder="965852" value="" id="speaka3" readonly class="areas worksheetInfoData"  /></td>
                            </tr>
                            <tr>
                                <td>B &dArr;</td>
                                <td ></td>
                            </tr>
                            <tr class="tg-even">
                                <td class="mgml1"><input type="text" value="<?php echo $pareas[3]->peak_area;?>" name="speakd[]" placeholder="965852" value="" id="speakb1" readonly class="areas worksheetInfoData"  /></td>
                            </tr>
                            </tr>
                            <tr>
                                <td class="mgml1"><input type="text" value="<?php echo $pareas[4]->peak_area;?>" name="speakd[]" placeholder="965852" value="" id="speakab2" readonly  class="areas worksheetInfoData" /></td>
                            </tr>
                            <tr class="tg-even">
                                <td class="mgml1"><input type="text" value="<?php echo $pareas[5]->peak_area;?>" name="speakd[]" placeholder="965852" value="" id="speaka3" readonly  class="areas worksheetInfoData" /></td>
                            </tr>

                        </table>
                </div>
                
                
            </fieldset>
            
       
        <input type="button" value="Export Dissolution Repeat" id="ExportDissolution" class="submit-button"/>
    </fieldset>

    <p class="exp"><input type="button" value="Export Data" id="Export" title='Export Data on this page to Excel file' class="submit-button"></button></p>

</div>