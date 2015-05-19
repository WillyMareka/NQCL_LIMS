
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' />


         <style type="text/css">
            table{
                border:none;
                width:400px;
                margin:auto;
                border:2px double #000 ;
            }
            td{
                border:#000 solid 1px;
            }
            input[type=number]{
                text-align:center;
                margin:auto;
                width: 50px

            }
            input[type=text]{
                text-align:center;	
                width: 50px

            }
            span.workingweight12{

                margin-right: 100px;
                width: 25px

            }
            input#DM,#workingmgml1,
            #conc,#dmgml1,#dmgml,
            #ingredient,#disstage,#tcreading,#tcmean{
                width: 200px;
            }
            select#apparatus{
                width: 150px;
                margin-right: 40px;
            }
            td{
                margin:auto;
                text-align:center;

            }
            td#b{
                border:thin #000;
            }

            div#a{
                text-align:center;
            }
            td#x{
                text-align:right;
            }
            p{
                margin:center;
            }
            div#a table{
                width:330px;
                border:#000000 1px solid;
                margin:auto;
                text-align: center;
            }
            table#we td, th{
                border:#000000 1px solid;
                margin:0px;	
            }
            input.dissolution-class[type=text]{
                width:250px;
                height:20px;
                text-align: center;
            }
            p#show,#hide{
                float: left;
               
            }
            p#show:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;
               
            }
            p#hide:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;
                
            }
            input#disstage{
                font-weight: bolder;
                font-size: large;
            }

        </style>
    </head>

    <body>
        <!--DISSOLUTION CONDITIONS -->
        <?= form_open('dissolution/#'); ?>
        <p><input type="button" value="Select another Test" id="distest"/><p>
                   <p><input type="button" value="Repeat Dissolution" id=""/><p>
        <center><p><strong><h3>Stage: <input type="text" name="distage" id="disstage" readonly/></h3></strong></p>
            Enter Active Ingredient: <input type="text" name="ingred" id="ingredient" class="stage"/><br />
        </center>
           <p id="hide">-Hide</p> <p id="show">+Show</p>
        <p><center><h3><u>1. Tablets/Capsule Weights</u></h3></center></p>       
        <div id="a">
            <table width="332" border="0" cellpadding="1" cellspacing="0" id="we">
                <tr>
                    <th width="133">No</th>
                    <th width="220">Tablets/Capsule Weights(mg)</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="tc1" id="tc1" class="dissolution-class" required/></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="tc2" id="tc2" class="dissolution-class" required/></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><input type="text" name="tc3" id="tc3" class="dissolution-class" required/></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><input type="text" name="tc4" id="tc4" class="dissolution-class" required/></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><input type="text" name="tc4" id="tc5" class="dissolution-class" required/></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><input type="text" name="tc4" id="tc6" class="dissolution-class" required/></td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>                      
                        <input type="text" name="tcreading" id="tcreading"  />
                    </td>
                </tr>
                <tr>
                    <td><strong>Average</strong></td>

                    <td>
                    <input type="text" name="tcmean" id="tcmean"  />
                    </td>
                </tr>
            </table>
            <center>
                <p><strong></p></strong> </span>
                <input type="hidden" name="tcreading" id="tcreading"  />
                </p></center>
        </div>
        <hr />
        <center><h3><header><u>2. Dissolution Conditions</u></header></h3></center>
        <div id="dissolutio">
            <table width="355" border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2">Tablets/Capsules</td>
                </tr>
                <tr>
                    <td width="201">&nbsp;</td>
                    <td width="191">n Run</td>
                </tr>
                <tr>
                    <td>Dissolution Medium</td>
                    <td><span class="workingweight12">
                            <input type="number" name="DM" placeholder="HCL" value="" id="DM" required="required" />
                        </span></td>
                </tr>
                <tr>
                    <td>Volume Used</td>
                    <td><span class="workingweight12">
                            <input type="number" name="R2" placeholder="900" value="" id="R2" required="required" />&nbsp;<span>mL</span>
                        </span></td>
                </tr>
                <tr>
                    <td>Apparatus</td>
                    <td><select name="apparatus" id="apparatus">
                            <option value="">--Select Apparatus--</option>
                            <option value=1>1</option>
                            <option value=2>2</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Rotations Per Minute</td>
                    <td><span class="workingweight12">
                            <input type="number" name="Rm" placeholder="e.g 100" value="" id="Rm" required="required" />&nbsp;<span>rpm</span>
                        </span></td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td><span class="workingweight12">
                            <input type="number" name="R3" placeholder="e.g 30" value="" id="R3" required="required"  />&nbsp;<select id="time">
                                <option value="">-Select-</option>
                                <option value="">Hrs</option>
                                <option value="">Mins</option>
                            </select>
                        </span></td>
                </tr>
            </table>

        </div>
        <hr />
        <center><h3><u>3. Subsequent Dillution</u></h3></center></p>
        <div id="subsequent">
            <table id="assay">

                <tr id="test1">
                    <td>&nbsp;</td>

                    <td>Label Claim (mg)</td>
                    <td><span>Volume Used</span></td>
                    <td><span>Pipette</span></td>
                    <td><span>Vf</span></td>
                    <td><span>Concentration</span></td>

                </tr>


                <!--=======================SUBSEQUENT  DISSOLUTIONS AFTER DISSOLUTIONS===============================-->	

                <tr>
                    <td class="workingweight" ><strong>Desired Concetration</strong></td>
                    <td class="labelclaim" ><input type="number" name="labelclaim" placeholder="e.g 20mg" value="" id="labelclaim" required /></td>
                    <td class ="vf1" >
                        <input type="number" name="vu" placeholder="e.g 20mg" value="" id="vu" readonly />
                    </td>
                    <td class="workingp1" >
                        <select name="workingp1" id="workingp1"  required >
                            <option value="1"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="workingv1">
                        <select name="workingv" id="workingv" required >
                            <option value="1"></option>
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    <td class="conc" ><input type="number" name="conc" placeholder="e.g 20mg" value="" id="conc" readonly /></td>                   
                </tr>
            </table>
        </div>
        <hr />
        <p></p>
        <div id="sample"> 
            <p><center><h3><u>4. Standard Preparation for Dissolution</u></h3></center></p>
            <table id="assay">               
                <tr id="test">
                    <td>&nbsp;</td>

                    <td><span>Weight</span></td>
                    <td><span>Vf1</span></td>
                    <td><span>Pipette</span></td>
                    <td><span>Vf2</span></td>
                    <td><span>Pipette2</span></td>
                    <td><span>Vf3</span></td>
                     <td><span>Pipette3</span></td>
                    <td><span>Vf4</span></td>
                    <td><span>Concentration</span></td>

                </tr>


                <!--========================SAMPLE PREPARATION FOR DISSOLUTIONS==============================-->	

                <tr>
                    <td class="workingweight" ><strong>Desired Weight</strong></td>
                    <td class="workingweight" ><input type="number" name="workingweight" placeholder="e.g 20mg" value="" id="workingweight" readonly/></td>

                    <td class="workingvf1" >                          
                        <select name="workingvf1" id="workingvf1" required >
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>


                    <td class="workingpipette1" >
                        <select name="workingp11" id="workingp11"  required >
                            <option value="1"></option>
                            <option value="1"></option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="workingvf2">
                        <select name="workingvf2" id="workingvf2" required >
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                     <td class="workingpipette2" >
                        <select name="workingp12" id="workingp12"  required >
                            <option value="1"></option>
                            <option value="1"></option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="workingvf3">
                        <select name="workingvf3" id="workingvf3" required >
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    
                    <td class="workingpipette2" >
                        <select name="workingp13" id="workingp13"  required >
                            <option value="1"></option>
                            <option value="1"></option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="workingvf4">
                        <select name="workingvf4" id="workingvf4" required >
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    
                    <td class="mgml11"><input type="number" name="workingmgml" placeholder="e.g 0.04mg/ml" id ="workingmgml1" readonly  /></td>
                </tr>


                <!----================================================================================================================-->


                <tr>
                    <td colspan="8" class="weight" width="10" >&nbsp;</td>
                </tr>
                <tr>
                    <td class="weight" ><strong>Standard A</strong></td>
                    <td class="weight" ><input type="number" name="u_weight" placeholder="e.g 20mg" value="" id="number" required /></td>
                    <td class ="vf1" >
                        <input type="text" name="v11" id="v11" readonly/>
                    </td>
                    <td class="pipette1" >
                        <input type="text" name="p11" id="p11"  readonly/>

                    </td>
                    <td class="vf2">
                        <input type="text" name="vf11" id="vf11" readonly/>

                    </td>
                    <td class="pipette2" >
                        <input type="text" name="p20" id="p20"  readonly/>

                    </td>
                    <td class="vf3">
                        <input type="text" name="vf3" id="vf3" readonly/>

                    </td>
                    
                     <td class="pipette2" >
                        <input type="text" name="p211" id="p211"  readonly/>

                    </td>
                    <td class="vf3">
                        <input type="text" name="vf4" id="vf4" readonly/>

                    </td>
                    
                    <td class="mgml"><input type="number" name="dmgml" placeholder="e.g 0.04mg/ml" id ="dmgml" value="" required readonly /></td>
                </tr>

                <tr>
                    <td class="weight" ><strong>Standard B</strong></td>
                    <td class="weight" ><input type="number" name="u_weight" placeholder="e.g 20mg" value="" id ="number1"required /></td>
                    <td class ="vf111" ><input type="text"  id="v2" name="v2" size="15"/></td>
                    <td class="pipette11" >
                        <input type="text" id="p2" name="p2" size="15" readonly/> 
                    </td>
                    <td class="vf22">
                        <input type="text" required id="vf2" name="vf2" size="15" readonly/> 
                    </td>
                    
                    <td class="pipette21" >
                        <input type="text" id="p21" name="p21" size="15" readonly/> 
                    </td>
                    <td class="vf23">
                        <input type="text" required id="vf23" name="vf23" size="15" readonly/> 
                    </td>
                    
                    <td class="pipette21" >
                        <input type="text" id="p22" name="p22" size="15" readonly/> 
                    </td>
                    <td class="vf23">
                        <input type="text" required id="vf24" name="vf24" size="15" readonly/> 
                    </td>
                    
                    <td class="mgml1"><input type="number" name="dmgml1" placeholder="e.g 0.04mg/ml" value="" id="dmgml1" required readonly /></td>
                </tr>



            </table>
        </div>
      
        <p>
            <input type="button" value="Save" class="submit-button" id="savedissolution"/>
        </p>
        
       <div id="dialog" title="Dissolution Test Selection">
	<p>Select the type of dissolution test you would like to undertake!.</p>
         <input type="radio" name="d" value="sd" id="d" >Single<br>
         <input type="radio" name="d" value="mu" id="d1">Multiple<br>
         <input type="radio" name="d" value="ms" id="d2">Multistaged<br>
        
</div>
  
        </form>
        </div>        
    </body>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/assay.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>javascripts/zebra_dialog.js'></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/dissolution.min.js"></script>
    <script>
        /*$("#savedissolution").click(function(){
            jQuery(function () {
                $.Zebra_Dialog('<strong>Dissolution</strong>, would you like to save and move to the next stage or just save?', {
                    'type':     'question',
                    'title':    'Dissolution Stage Request',
                    'buttons':  [
                        {caption: 'Save', callback: function() { window.location.href = "<?php echo base_url(); ?>dissolution/save_weights/";}},
                        {caption: 'Save & Move', callback: function() { window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";}},
                        {caption: 'Cancel', callback: function() {}}
                    ]
                })
               
            })
        })*/
        $(document).ready(function(){
            $('p#show').hide();        
            $('p#hide').click(function(){
                $('div#a').slideUp(2000);
                $('p#show').show();  
                $(this).hide(); 
            });       
            $('p#show').click(function(){
                $('div#a').slideDown(2000); 
                $(this).hide(); 
                $('p#hide').show();
            });
        });
        
        
        $(document).ready(function(){
            $.fx.speeds._default = 1000;
            
            $( "#dialog" ).dialog({
                autoOpen: false,
                show: "blind",
                hide: "explode",
                modal:true
                
                
            });
            
            $('#d').click(function(){            
             window.location.href = "<?php echo base_url(); ?>dissolution/worksheet/";
                $( this ).dialog( "close" );
            })
            $('#d1').click('change',function(){  
                 window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";
                $(  this).dialog( "close" );
            })
            $('#d2').click('change',function(){               
                $( '#dialog').dialog( "close" );
            })
                $( "#distest" ).click(function() {
                $( "#dialog" ).dialog( "open" );
                return false;
            });
            
            
        });
         $(document).ready(function(){
        var counter=1;   
        var stage1='ACID';
        var stage2='BUFFER';
        
       $('#disstage').val(stage1);       
       
        $(' #savedissolution').click(function(){
            $('input.stage,input.dissolution-class').each(function() {
                $(this).val('');
                });
                counter++;
                if(counter==2){
                $('#disstage').val(stage2);
                }else{
                 counter=1;
                $('#disstage').val(stage1);  
                }
        });
    });
        
    </script>
</html>
