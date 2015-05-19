<?php
if ($is_director[0]->user_type != 8) {
    $error = 'Unauthorized User: ACCESS DENIED!';
    echo '<div style="color:red; text-align:center;">' . $error . '</div>';
} else {
    ?>
    <!--
    To change this template, choose Tools | Templates
    and open the template in the editor.
    -->

    <body> 
    <legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>directors" >Refresh</a> | <?php  anchor('directors/samplesD/', 'Worksheets and COAs Submitted for Approval'); ?> </legend>
    <hr />


    </div> 

    <!-- End Menu --> 
    <div>
        <table id = "refsubs">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Lab Reference No</th>
                      <th>Download </th> 
                    <th>View</th>
                    <th>Status</th>
                    <th>Approve</th>
                    <th>Reject</th>
                    <th>Priority</th>


                </tr>
            </thead>
            <tbody>

    <?php foreach ($worksheets as $sheet): ?>
                    <tr>
                      
                        <td><?php echo $sheet->folder . '.xlsx'; ?></td>
                        <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>   
                         <td>Worksheet: <?php echo anchor('director/'.$sheet->folder.'.xlsx', 'Download');?> &nbsp; | &nbsp;COA: <?php echo anchor('COA/'.$sheet->folder.'_COA.xlsx', 'Download');?></td>
                                        <td><?php echo anchor('coa/generateCoa/' . $sheet->folder, 'View COA') ?></td>

                        <?php if($sheet->approval_status==='0'){?>
                        <td style="background-color: yellow;"><span style=" color: black; font-weight: bold; border-radius: 2px;">Not yet Approved</span></td>
                        <?php } else if ($sheet->approval_status==='1') {?>
                        <td style="background-color: yellowgreen;"><span style=" color: white; font-weight: bold; border-radius: 2px;">Approved</span ></td>
                        <?php } else if ($sheet->approval_status==='2') {?>
                          <td style="background-color: #FF0000;"><span style=" color: white; font-weight: bold; border-radius: 2px;">Rejected</span></td> 
                        <?php } ?>
                        <td><?php echo anchor('directors/approve_d/' . $sheet->folder, 'Approve'); ?></td>
                        <td><?php echo anchor('directors/reject_d/' . $sheet->folder, 'Reject'); ?></td>
                        <?php if ($sheet->priority === '1') { ?>
                            <td><span id="high">High</span></td>
                        <?php } else { ?>
                            <td><span id="low">Low</span></td>    
                        <?php } ?>
    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>

        <script type="text/javascript">
            $(document).ready(function(){
            $('#refsubs').dataTable({
                "bJQueryUI": true
            }).rowGrouping({

                iGroupingColumnIndex: 1,
                sGroupingColumnSortDirection: "asc",
                iGroupingOrderByColumnIndex: 1,
                //bExpandableGrouping:true,
                //bExpandSingleGroup: true,
                iExpandGroupOffset: -1

            });
            
         $.ajax({
                type:"GET",
                url:"<?php echo base_url();?>coa/setBackNavigationData/",
                success:function(){
                  console.log('session set');  
                },
                error:function(){
                     console.log('session not set'); 
                }
            })
        });
            
        </script>


    </div>


    </body> 
    </html> 
<?php } ?>
