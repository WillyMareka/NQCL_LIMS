<head>
        <script src="<?php echo  base_url();?>dashboard_assets/js/jquery-1.10.2.min.js"></script>

    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css' ?>" type="text/css" rel="stylesheet"/>
</head>
<script type="text/javascript">

    $(document).ready(function() {
       var coaData= $('.datatable').dataTable({
            "bJQueryUI": true,
              "scrollY": 200,
        "scrollX": true
        })
        
   



     /*   $('.coa_changes').live("click", function(e) {
            e.preventDefault();
            var nTr = this.parentNode.parentNode;

            if ($(this).text() === 'View Changes') {

                $(this).text("Hide");
                var href=$(this).attr("href");
                //alert("Under Construction");

                var id = $(this).attr("id");
                //var type = $(this).attr("rel");

                $.post(href, function(history) {

                    coaData.fnOpen(nTr, history, 'history');
                })


            }


            else {

                coaData.fnClose(nTr);

                $(this).text("View Changes");

            }


        });
        
        
         $('.coa').live("click", function(e) {
            e.preventDefault();
            var nTr = this.parentNode.parentNode;

            if ($(this).text() === 'View COA') {

                $(this).text("Hide");
                var href=$(this).attr("href");
                //alert("Under Construction");

                var id = $(this).attr("id");
                //var type = $(this).attr("rel");

                $.post(href, function(history) {

                    coaData.fnOpen(nTr, history, 'history');
                })


            }


            else {

                coaData.fnClose(nTr);

                $(this).text("View COA");

            }


        })*/
    });
</script>
<div class="row-fluid">

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <div class="boxchart-overlay blue">
            <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
        </div>	
        <span class="title">Clients</span>
        <span class="value"><?php echo $all_clients; ?></span>
    </div>

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <div class="boxchart-overlay red">
            <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
        </div>	
        <span class="title">Analysis Request</span>
        <span class="value"><?php echo $all_samples; ?></span>
    </div>

    <div class="span3 smallstat box mobileHalf noMargin" ontablet="span6" ondesktop="span3">
        <i class="icon-check green"></i>
        <span class="title">Assigned Samples</span>
        <span class="value"><?php echo $all_assigned; ?></span>
    </div>

    <div class="span3 smallstat mobileHalf box" ontablet="span6" ondesktop="span3">
        <i class="icon-ban-circle yellow"></i>
        <span class="title">Un-assigned Samples</span>
        <span class="value"><?php echo $all_unassigned; ?></span>
    </div>

</div>	


<div class="grid_10" style="overflow-x: scroll">
    <div class="box round first grid">
        <h2>
           Samples Seeking Approval</h2>
        <div class="block">



            <table class="data display datatable" id="example">
                <thead>
                    <tr>
<!--                        <th>File Name</th>-->
                        <th>Lab Reference </th>
<!--                        <th>Download </th> -->
                        <th>COA</th>
                        <th>COA Changes</th>
                        <th>Status</th>
                        <th>Approve</th>
                        <th>Reject</th>
                        <th>Priority</th>
              
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (@$worksheets as $sheet): ?>
                        <tr>
<!--                            <td><?php echo $sheet->folder . '.xlsx'; ?></td>-->
                            <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>
<!--                            <td>Worksheet: <?php echo anchor('COA/' . $sheet->folder . '_COA.xlsx', 'Download'); ?> &nbsp; | &nbsp;COA: <?php echo anchor('COA/' . $sheet->folder . '_COA.xlsx', 'Download'); ?></td>-->
                            <td><a id="<?php echo $sheet->folder; ?>" class="coa btn btn-orange" href='<?php echo base_url() . 'coa/generateCoa_dash/' . $sheet->folder;?>' >View</a></td>
                  <td><a id="<?php echo $sheet->folder; ?>" class="coa_changes btn btn-info" href='<?php echo base_url() . 'main_dashboard/changes_made/' . $sheet->folder;?>'>View </a></td>

                            <?php if ($sheet->approval_status === '1') { ?>
                                <td style="background: yellow; color: black; font-weight: bold; border-radius: 2px;">Not yet Checked</td>
                            <?php } else if ($sheet->approval_status === '2') { ?>
                                <td style="background: yellowgreen; color: white; font-weight: bold;">APPROVED</td>
                            <?php } else if ($sheet->approval_status === '3') { ?>
                                <td style="background: #FF0000; color: white; font-weight: bold; border-radius: 2px;">REJECTED</td> 
                            <?php } ?>
                            <td><?php echo anchor('directors/approve_d/' . $sheet->folder, 'Approve', 'class="btn btn-primary"'); ?></td>
                            <td><?php echo anchor('directors/reject_d/' . $sheet->folder, 'Reject', 'class="btn btn-danger"'); ?></td>
                            <?php if ($sheet->priority === '1') { ?>
                                <td  id="high">High</td>
                            <?php } else { ?>
                                <td class="btn btn-orange" id="low">Low</td>    
                            <?php } ?>                                
                                  
         
                            
                        <?php endforeach; ?>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
