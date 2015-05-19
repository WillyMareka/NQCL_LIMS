<?php $this->load->view('template_v');?>
<html lang="en">
    <head>
        <title>Assay Standard and Sample</title>
        <script type="text/javascript" href="<?php echo base_url()?>javascript/jquery.min.js"></script>
<script>

$(document).ready(function(){
   
   $('#AssayForm').submit(function(){
  var theInputs = $(this).find('input');
  $.each(theInputs, function(i,obj){
        obj.prop('readonly',true);
  });
});
   
   
      var nda='No Value';
       $(".assay_data[value='0']" ).val(nda);
        $(".assay_data[value='1']" ).val(nda);
         $(".assay_data[value='0']" ).css("color", "white");
        $(".assay_data[value='1']").css("color", "white");
        $(".assay_data[value='0']").attr("disabled", "disabled");
        $(".assay_data[value='1']").attr("disabled", "disabled");
        $(".assay_data").attr("readonly", "readonly");
         $(".assay_data").css("background-color", "white");
         $('input[type=text],input[type=number],textarea').attr("readonly", "readonly");

   
        $('#submit_result').click(function(){        
                    dataString2 = $('#AssayForm').serialize();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>wkstest/exportAssayToExcel_t/<?php echo $labrefuri; ?>",
                                    data: dataString2,
                                    success: function() {
                                    alert("Data exported successfully");
                                        },
                                    error: function(){
                                        alert("An Error Occured");
                                    }               
                          })
                });
          });
</script>

    </head>
    <style type="text/css">
        input[type=text]{  
            width: 70px;
            border: 1px solid #000;
        }
        input[type=number]{    
            width: 70px;
            border: 1px solid #000;
        }
        table{
            margin: 0 auto 0 auto;

        }
		
		input.concetrate{
			width:250px;
		}
                .assay_data{
                    width:100px;
                }
    </style>
 
    <p><center><legend><h2>NQCL Assay Results</h2></legend></center></p>
        <?php if($r > 1) { $repeat = $r-1 ?>
<p><center><legend><h2>Sample Results: <?php echo $labref;?>&nbsp;|&nbsp;Component: <?php echo $component_name[0]->component;?> &nbsp; <?php echo 'Repeat '. $repeat;?> &nbsp;|&nbsp;Posted: <?php echo $sample_assay_desired_weight[0]->date_time;?>  </h2></legend></center></p>
     <?php } else{ ?>
<p><center><legend><h2>Sample Results: <?php echo $labref;?>&nbsp;|&nbsp;Component: <?php echo $component_name[0]->component;?> &nbsp;|&nbsp;Posted: <?php echo $sample_assay_desired_weight[0]->date_time;?>  </h2></legend></center></p>
      <?php  } ?>
    </p>
    <hr /> 
      <?php echo form_open('assay/approve/'.$labref.'/'.$r, array('id'=>'AssayForm')); ?>
    <center><h2>Standard Preparation for Assay</h2></center>
    <hr /> 	
    <div>
      <input type="hidden" value="<?php echo $component_name[0]->component; ?>" name="heading"/>
            <table id="assay">              
                     
                <tr>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  
                 
                  <th>&nbsp;</th>
                </tr>
                <tr id="test">
                
                    <th><span>&nbsp;</span></th>

                     <th><span>Weight</span></th>
                     <th><span>Vf1</span></th>
                     <th><span>Pipette1</span></th>
                     <th><span>Vf2</span></th>
                    <th><span class="vf3head">Pipette2</span></th>
                    <th><span class="vf3head">Vf3</span></th>
                    <th><span class="vf3head4">Pipette3</span></th>
                    <th><span class="vf3head4">Vf4</span></th>
                     <th><span>Concentration</span></th>

                </tr>


                <!--======================================================-->	

                <tr>
                    <td class="workingweight" ><strong>Desired Weight</strong></td>
                    <td class="workingweight" ><input type="text"  value="<?php echo $assay_desired_weight[0]->desired_weight;?>" class="assay_data" class="assay_data" name="workingweight" placeholder="e.g 20mg"  id="workingnumber" required /></td>
                    <td class ="vf1" >
                        <input type="text" readonly value="<?php echo $assay_desired_weight[0]->vf1;?>" class="assay_data" name="workingvf1" id="workingvf1" required width="30">

                    </td>
                    <td class="dillution1" >
                        <input type="text" readonly value="<?php echo $assay_desired_weight[0]->pippette1;?>" class="assay_data" class="assay_data" name="workingpipette1" id="workingp1"  required />

                    </td>
                    <td class="dillution1">
                        <input type="text" readonly value="<?php echo $assay_desired_weight[0]->vf2;?>" class="assay_data" name="workingvf2" id="workingvf2" required/>

                    </td>
                    <td class="vf3head" >
                        <input type="text" readonly value="<?php echo $assay_desired_weight[0]->pipette2;?>" class="assay_data" name="workingpipette2" id="workingp2"  required/>                            

                    </td>
                    <td class="vf3head">
                        <input type="text"  readonly value="<?php echo $assay_desired_weight[0]->vf3;?>" class="assay_data" name="workingvf3" id="workingvf3" required />

                    </td>

                    <td class="vf3head4" >
                        <input type="text" value="<?php echo $assay_desired_weight[0]->pipette3;?>" class="assay_data" name="workingp3" id="workingp3"  required />                            

                    </td>
                    <td class="vf3head4">
                        <input type="text" value="<?php echo $assay_desired_weight[0]->vf4;?>" class="assay_data" name="workingvf4" id="workingvf4" required />

                    </td>
                    <td class="mgml11"><input type="text" value="<?php echo $assay_desired_weight[0]->concetration;?>" class="assay_data" name="workingmgml" placeholder="e.g 0.04mg/ml" id ="workingmgml"    class="concetrate"/></td>
                </tr>


   <!----================================================================================================================-->


                <tr>
                    <td colspan="6" class="weight" width="7" >&nbsp;</td>
                </tr>
                <tr>
                    <td class="weight" ><strong>Standard A</strong></td>
                    <td class="weight" ><input type="text" value="<?php echo $assay_standard_ab[0]->weight;?>" class="assay_data" name="u_weight" placeholder="e.g 20mg"  id="number" required /></td>
                    <td class ="vf1" >
                        <input type="text" value="<?php echo $assay_standard_ab[0]->vf1;?>" class="assay_data" name="vf1" id="vf1" readonly/>
                    </td>
                    <td class="dillution1" >
                        <input type="text" value="<?php echo $assay_standard_ab[0]->pippette1;?>" class="assay_data" name="pipette1" id="p1"  readonly/>

                    </td>
                    <td class="dillution1">
                        <input type="text" value="<?php echo $assay_standard_ab[0]->vf2;?>" class="assay_data" name="vf2" id="vf2" readonly/>

                    </td>
                    <td class="vf3head" >
                        <input type="text" value="<?php echo $assay_standard_ab[0]->pipette2;?>" class="assay_data" name="p2" id="p2"  readonly/>
                    </td>
                    <td class="vf3head">
                        <input type="text" value="<?php echo $assay_standard_ab[0]->vf3;?>" class="assay_data" name="vf31" id="vf31" readonly/>
                    </td>

                    <td class="vf3head4" >
                        <input type="text" value="<?php echo $assay_standard_ab[0]->pipette3;?>" class="assay_data" name="p321" id="p321"  readonly/>
                    </td>
                    <td class="vf3head">
                        <input type="text" value="<?php echo $assay_standard_ab[0]->vf4;?>" class="assay_data" name="vf32" id="vf32" readonly/>
                    </td>

                    <td class="mgml"><input type="text" value="<?php echo $assay_standard_ab[0]->concetration;?>" class="assay_data" name="mgml" placeholder="e.g 0.04mg/ml" id ="mgml"  required readonly  class="concetrate"/></td>
                </tr>

                <tr>
                    <td class="weight" ><strong>Standard B</strong></td>
                    <td class="weight" ><input type="text" value="<?php echo $assay_standard_ab[1]->weight;?>" class="assay_data" name="u_weight1" placeholder="e.g 20mg"  id ="number1" required /></td>
                    <td class ="vf111" >
                        <input type="text" required id="vf11" value="<?php echo $assay_standard_ab[1]->vf1;?>" class="assay_data" name="vf11" size="15" readonly/> 
                    </td>
                    <td class="dillution1" >
                        <input type="text" required id="p11" value="<?php echo $assay_standard_ab[1]->pippette1;?>" class="assay_data" name="ppt" size="15" readonly/> 
                    </td>
                    <td class="dillution1">
                        <input type="text" required id="vf22" value="<?php echo $assay_standard_ab[1]->vf2;?>" class="assay_data" name="vf22" size="15" readonly/> 
                    </td>
                    <td class="vf3head" >
                        <input type="text" required id="ppt1" value="<?php echo $assay_standard_ab[1]->pipette2;?>" class="assay_data" name="ppt1" size="15" readonly/> 
                    </td>
                    <td class="vf3head">
                        <input type="text" required id="vf33" value="<?php echo $assay_standard_ab[1]->vf3;?>" class="assay_data" name="vf33" size="15" readonly/> 

                    <td class="vf3head4" >
                        <input type="text" required id="ppt2" value="<?php echo $assay_standard_ab[1]->pipette3;?>" class="assay_data" name="ppt2" size="15" readonly/> 
                    </td>
                    <td class="vf3head4">
                        <input type="text" required id="vf34" value="<?php echo $assay_standard_ab[1]->vf4;?>" class="assay_data" name="vf34" size="15" readonly/> 

                    </td>
                    <td class="mgml1"><input type="text" value="<?php echo $assay_standard_ab[1]->concetration;?>" class="assay_data" name="mgml1" placeholder="e.g 0.04mg/ml"  id="mgml1" required readonly  class="concetrate"/></td>
                </tr>
            </table>

<!--==================================================================================================================================================-->
        
<div id="sampleassay">

    <p></p>
    <hr/>
    <center><h2>Sample Assay Preparation</h2></center>
    <hr />    	
    <div>
        <h3><label for="tabs_caps_average">Tablet or Capsule Weight: </label></h3>
        <input type="text" value="<?php echo $sample_assay_desired_weight[0]->uniformity_weight;?>" class="assay_data" name="tabs_caps_average" id="tabs_caps_average" />

        <table id ="sample">		
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <tr id="test">
                <th>                     </th>
                <th>Powder Weight</th>

                <th><span>API Weight</span></th>
                <th><span>Vf1</span></th>
                <th><span>Pipette1</span></th>
                <th><span>Vf2</span></th>
                <th><span class="vf3head">Pipette2</span></th>
                <th> <span class="vf3head">vf3</span></th>
                <th><span class="vf3head">Pipette3</span></th>
                <th> <span class="vf3head">vf4</span></th>
                <th><span>Concentration</span></th>
                <th>Label Claim(mg)</th>		
            </tr>




            <tr>
                <td class="weight" ><strong>Desired Weight</strong></td>
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_desired_weight[0]->powder_weight;?>" class="assay_data" name="pwnumber" placeholder="325mg"  id="pwnumber" readonly /></td>
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_desired_weight[0]->api_weight;?>" class="assay_data" name="aiweight" placeholder="e.g 20mg"  id="aiweight"  /></td>
                <td class ="vf1" >
                    <input type="text" value="<?php echo $sample_assay_desired_weight[0]->vf1;?>" class="assay_data" name="svf1" id="svf1" required width="30"/>

                </td>
                <td class="dillution1" >
                    <input type="text" value="<?php echo $sample_assay_desired_weight[0]->pipette1;?>" class="assay_data" name="sp1" id="sp1"  required/>

                </td>
                <td class="dillution1">
                    <input type="text" value="<?php echo $sample_assay_desired_weight[0]->vf2;?>" class="assay_data" name="svf2" id="svf2" required />

                </td>
                <td class="vf3head">
                    <input type="text" value="<?php echo $sample_assay_desired_weight[0]->pipette2;?>" class="assay_data" name="pipette2" id="pipette2" required />
                </td>
                <td class="vf3head"><input type="text" value="<?php echo $sample_assay_desired_weight[0]->vf3;?>" class="assay_data" name="vf3" id="vf3" required />
                </td>
                <td class="vf3head4"><input type="text" value="<?php echo $sample_assay_desired_weight[0]->pipette3;?>" class="assay_data" name="pipette3" id="pipette3" required />
                </td>
                <td class="vf3head4"><input type="text" value="<?php echo $sample_assay_desired_weight[0]->vf4;?>" class="assay_data" name="vf41" id="vf41" required />
                </td>
                <td class="mgml"><input type="text" value="<?php echo $sample_assay_desired_weight[0]->concetration;?>" class="assay_data" name="smgml" placeholder="0.04mg/ml" id ="smgml"  required readonly  class="concetrate"/></td>
                <td class="mgml"><input type="text" value="<?php echo $sample_assay_desired_weight[0]->labelclaim;?>" class="assay_data" name="labelclaim" placeholder="0.04mg/ml" id ="labelclaim"  required  /></td>
            </tr>

            <tr>
                <td colspan="9" class="weight" >&nbsp;</td>
            <tr>
                <!--=================================================================================================================-->
                
                
                <td class="weight" ><strong>Sample A</strong></td>
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_standars_abc[0]->powder_weight;?>" class="assay_data" name="sampleA" placeholder="e.g 20mg"  id="sampleA" required /></td>
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_standars_abc[0]->api_weight;?>" class="assay_data" name="aweightA" placeholder="e.g 20mg"  id ="aweightA" readonly/></td>
                <td class ="vf111" >
                    <input type="text" required id="svf11" value="<?php echo $sample_assay_standars_abc[0]->vf1;?>" class="assay_data" name="svf11" size="15" readonly/> 
                </td>
                <td class="dillution1" >
                    <input type="text" required id="sp11" value="<?php echo $sample_assay_standars_abc[0]->pipette1;?>" class="assay_data" name="sp11" size="15" readonly/> 
                </td>
                <td class="dillution1">
                    <input type="text" required readonly id="svf12" value="<?php echo $sample_assay_standars_abc[0]->vf2;?>" class="assay_data" name="svf12" size="15"/> 
                </td>
                <td class="vf3head"><input type="text" required id="spf1" value="<?php echo $sample_assay_standars_abc[0]->pipette2;?>" class="assay_data" name="spf1" size="15"  readonly /></td>
                <td class="vf3head"><input type="text" required id="svf13" value="<?php echo $sample_assay_standars_abc[0]->vf3;?>" class="assay_data" name="svf13" size="15"  readonly /></td>

                <td class="vf3head4"><input type="text" required id="spf21" value="<?php echo $sample_assay_standars_abc[0]->pippette3;?>" class="assay_data" name="spf21" size="15" readonly /></td>
                <td class="vf3head4"><input type="text" required id="svf14" value="<?php echo $sample_assay_standars_abc[0]->vf4;?>" class="assay_data" name="svf14" size="15"  readonly /></td>
                <td class="mgml1"><input type="text" value="<?php echo $sample_assay_standars_abc[0]->concetration;?>" class="assay_data" name="smgml1" placeholder="e.g 0.04mg/ml"  id="smgml1" required readonly  class="concetrate"/></td>
                <td rowspan="3" class="mgml1">&nbsp;</td>

<!--==================================================================================================================================-->


            <tr>
                <td class="weight" ><strong>Sample B</strong></td>
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_standars_abc[1]->powder_weight;?>" class="assay_data" name="sampleB" placeholder="e.g 20mg"  id="sampleB" required /></td> 
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_standars_abc[1]->api_weight;?>" class="assay_data" name="aweightB" placeholder="e.g 20mg"  id ="aweightB" readonly /></td>

                <td class ="vf111" >

                    <input type="text" required id="svf111" value="<?php echo $sample_assay_standars_abc[1]->vf1;?>" class="assay_data" name="vf111" size="15" readonly/> 
                </td>
                <td class="dillution1" >
                    <input type="text" required id="sp112" value="<?php echo $sample_assay_standars_abc[1]->pipette1;?>" class="assay_data" name="sp112" size="15" readonly/> 
                </td>
                <td class="dillution1">
                    <input type="text" readonly required id="svf22" value="<?php echo $sample_assay_standars_abc[1]->vf2;?>" class="assay_data" name="svf22" size="15"/> 
                </td>
                <td class="vf3head"><input type="text" required id="spf2" value="<?php echo $sample_assay_standars_abc[1]->pipette2;?>" class="assay_data" name="spf2" size="15"  readonly /></td>
                <td class="vf3head"><input type="text" required id="svf23" value="<?php echo $sample_assay_standars_abc[1]->vf3;?>" class="assay_data" name="svf23" size="15"  readonly /></td>

                <td class="vf3head4"><input type="text" required id="spf33" value="<?php echo $sample_assay_standars_abc[1]->pippette3;?>" class="assay_data" name="spf33" size="15"  readonly /></td>
                <td class="vf3head4"><input type="text" required id="svf241" value="<?php echo $sample_assay_standars_abc[1]->vf4;?>" class="assay_data" name="svf241" size="15"  readonly /></td>

                <td class="mgml1"><input type="text" value="<?php echo $sample_assay_standars_abc[1]->concetration;?>" class="assay_data" name="smgml2" placeholder="e.g 0.04mg/ml"  id="smgml2" readonly  class="concetrate"/></td>
            </tr>
<!--============================================================================================================================================-->
            <tr>
                <td class="weight" ><strong>Sample C</strong></td>
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_standars_abc[2]->powder_weight;?>" class="assay_data" name="sampleC" placeholder="e.g 20mg"  id="sampleC" required /></td> 
                <td class="weight" ><input type="text" value="<?php echo $sample_assay_standars_abc[2]->api_weight;?>" class="assay_data" name="aweightC" placeholder="e.g 20mg"  id ="aweightC" readonly/></td>
                <td class ="vf3" >

                    <input type="text" required id="svf3" value="<?php echo $sample_assay_standars_abc[2]->vf1;?>" class="assay_data" name="svf3" size="15" readonly/> 
                </td>
                <td class="dillution1" >
                    <input type="text" required id="ssp3" value="<?php echo $sample_assay_standars_abc[2]->pipette1;?>" class="assay_data" name="ssp3" size="15" readonly/> 
                </td>
                <td class="dillution1">
                    <input type="text" readonly required id="svf33" value="<?php echo $sample_assay_standars_abc[2]->vf2;?>" class="assay_data" name="svf33" size="15"/> 
                </td>
                <td class="vf3head"><input type="text" required id="spf3" value="<?php echo $sample_assay_standars_abc[2]->pipette2;?>" class="assay_data" name="spf3" size="15" readonly /></td>
                <td class="vf3head"><input type="text" required id="svf24" readonly value="<?php echo $sample_assay_standars_abc[2]->vf3;?>" class="assay_data" name="svf24" size="15" /></td>

                <td class="vf3head4"><input type="text" required id="spf4" value="<?php echo $sample_assay_standars_abc[2]->pippette3;?>" class="assay_data" name="spf4" size="15" readonly /></td>
                <td class="vf3head4"><input type="text" required id="svf25" value="<?php echo $sample_assay_standars_abc[2]->vf4;?>" class="assay_data" name="svf25" size="15" readonly /></td>

                <td class="mgml3"><input type="text" value="<?php echo $sample_assay_standars_abc[2]->concetration;?>" class="assay_data" name="smgml3" placeholder="e.g 0.04mg/ml"  id="smgml3" required readonly  class="concetrate"/></td>
            </tr>


        </table>
        
        <?php echo form_close(); ?>

         <p><input type="button" value="Submit Result" id="submit_result" style="background-color: #33ff33;color: #ffffff;"/></p>    

    </div>
</div>
 </html>