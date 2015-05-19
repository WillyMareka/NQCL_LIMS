<legend><a href="<?php echo base_url(); ?>supervisors" >Home</a> </legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }




</style>

<table id = "analystable">

    <thead><tr><!--th>No.</th--><th>Lab Reference Number</th><th>Test Name</th><th>View Worksheet</th><th>Status</th><th>Priority</th></tr>
    </thead>

    <tbody>
        
        <?php 
        foreach ($analyst_data as $test) { ?>
 
         

            <tr class="sample_issue">
                    <!--td class="numbering" ><span class="bold number" id="number" ></span></td-->
                <td class="common_data" ><span class="green_bold" id="labref" ><?php echo $test->labref ?> &nbsp; &rArr; &nbsp; <a href="<?php echo base_url()."request_management/make_oos/".$test->labref;?>">Mark as OOS</a></span></td>

                <?php if ($test->repeat_status > 1) { ?>
                    <td class="sample_data"><span class=""><?php echo $test->test_name ?>&nbsp;&nbsp;</span>    <?php 
                        if($test->component =='0' || $test->component ==''){
                         echo "";
                        }else{
                          echo '(<strong>'.$test->component.'</strong>)';  
                        }                           
                            ?></td> 
                    <?php } else {
                    ?>
                    <td class="sample_data"><span class=""><?php echo $test->test_name ?></span>
                        <?php 
                        if($test->component =='0' || $test->component ==''){
                         echo "";
                        }else{
                          echo '(<strong>'.$test->component.'</strong>)';  
                        }                           
                            ?>
                    </td> 

                <?php } ?>
                
                    
                    

                    <td><a href='<?php echo site_url() . $test->test_name . "/" . $test->test_subject . "/" . $test->labref . "/" . $test->repeat_status . "/" . $test->component_no ?>'>View Worksheet </a></td>
                    <?php if($test->approval_status==='0' && $test->micro !='yes'){?>
                    <td style="color:black; font-weight: bolder;background: yellow">Not yet Approved/Rejected</td>
                    <?php }
                      elseif ($test->approval_status==='0' && $test->micro =='yes') {?>
                    <td style="color:black; font-weight: bolder;background: yellow">Not yet Approved | <a href='<?php echo site_url() ."analyst_uploads/" .$test->labref.'_'. $test->test_subject . ".xlsx"  ?>'>Download Worksheet </a> 
                    | <a href='<?php echo site_url() ."supervisors/approve/" .$test->labref.'/'.$test->repeat_status.'/'. $test->test_subject . "/". $test->test_id . "/"  ?>'>Approve </a></td>
                    <?php }elseif ($test->approval_status==='1'  && $test->micro !='yes') {?>
                    <td style="color:black; font-weight: bolder;background: greenyellow">Approved</td>
                    <?php }elseif ($test->approval_status==='1'  && $test->micro =='yes') {?>
                 <td style="color:black; font-weight: bolder;background: greenyellow">Approved | <a href='<?php echo site_url() ."analyst_uploads/" .$test->labref.'_'. $test->test_subject . ".xlsx"  ?>'>Download Worksheet </a> 

                    <?php }else{?>
                    <td style="color:black; font-weight: bolder;background: red">Rejected, Pending repeat</td>
                    <?php } ;?>
                     <?php //if($test->do_count >=2){?>
<!--                     <td style="text-align: center; font-weight: bolder; color: white; text-decoration: blink; background-color: red;">Yes</td>
                     <?php// } else{?>
                     <td style="text-align: center; font-weight: bolder; color: black;">No</td>-->
                     <?php //}?>
                    <?php if($test->priority==='1'){?>
                     <td><span id="high">High</span></td>
                     <?php }else{?>
                      <td><span id="low">Low</span></td>    
                     <?php }?>
                    
            </tr>


        <?php } ?>



    </tbody>

</table>

<script type="text/javascript">
    $(function(){
        
        $('#analystable').dataTable({
            
            "bJQueryUI":true,
            "iDisplayLength":50
            
        }).rowGrouping({
            
            iGroupingColumnIndex: 0,
            sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 0,
            //bExpandableGrouping:true,
            bExpandSingleGroup: true,
            iExpandGroupOffset: -1
            
        })
    })

</script>

