<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<body> 
 <legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>reviewer" >Refresh</a> | <?php echo anchor('reviewer/samples_for_review/'.$reviewer_id,'Worksheets Uploaded For Review'); ?> </legend>
 <hr />
<!-- Menu Start --> 

</div> 

<!-- End Menu --> 
<div>
    <table id = "refsubs">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Lab Reference No</th>
                    <th>Download </th>                
                    <th>Status</th>
                     <th>Upload</th>

                </tr>
            </thead>
            <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            </tbody>
        </table>

<script type="text/javascript">
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
    </script>

  
</div>

 
</body> 
</html> 
