<head>
    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css' ?>" type="text/css" rel="stylesheet"/>
</head>
<script type="text/javascript">

    $(document).ready(function() {
       var coaData= $('.datatable').dataTable({
            "bJQueryUI": true,
           // "sScrollX": "100%"
        }).rowGrouping({
            iGroupingColumnIndex: 1,
            sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 1,
            //bExpandableGrouping:true,
            //bExpandSingleGroup: true,
            iExpandGroupOffset: -1
        });
        
   



        $('.coa_changes').live("click", function(e) {
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


        })
    });
</script>

<div class="grid_10" style="overflow-x: scroll">
    <div class="box round first grid">
        <h2>
            COA Review</h2>
        <div class="block">



            <table class="data display datatable" id="example">
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
                        <th>Changes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (@$worksheets as $sheet): ?>
                        <tr>
                            <td><?php echo $sheet->folder . '.xlsx'; ?></td>
                            <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>
                            <td>Worksheet: <?php echo anchor('COA/' . $sheet->folder . '_COA.xlsx', 'Download'); ?> &nbsp; | &nbsp;COA: <?php echo anchor('COA/' . $sheet->folder . '_COA.xlsx', 'Download'); ?></td>
                            <td><a id="<?php echo $sheet->folder; ?>" class="coa" href='<?php echo base_url() . 'coa/generateCoa_dash/' . $sheet->folder;?>'>View COA</a></td>

                            <?php if ($sheet->approval_status === '0') { ?>
                                <td style="background: yellow; color: black; font-weight: bold; border-radius: 2px;">Not yet Checked</td>
                            <?php } else if ($sheet->approval_status === '1') { ?>
                                <td style="background: yellowgreen; color: white; font-weight: bold;">APPROVED</td>
                            <?php } else if ($sheet->approval_status === '2') { ?>
                                <td style="background: #FF0000; color: white; font-weight: bold; border-radius: 2px;">REJECTED</td> 
                            <?php } ?>
                            <td><?php echo anchor('directors/approve/' . $sheet->folder, 'Approve', 'class="btn btn-green"'); ?></td>
                            <td><?php echo anchor('directors/reject/' . $sheet->folder, 'Reject', 'class="btn btn-red"'); ?></td>
                            <?php if ($sheet->priority === '1') { ?>
                                <td  id="high">High</td>
                            <?php } else { ?>
                                <td class="btn btn-orange" id="low">Low</td>    
                            <?php } ?>                                
                                  
                                <td><a id="<?php echo $sheet->folder; ?>" class="coa_changes" href='<?php echo base_url() . 'dashboard_control/changes_made/' . $sheet->folder;?>'>View Changes</a></td>
         
                            
                        <?php endforeach; ?>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
