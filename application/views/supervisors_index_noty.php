<legend><a href="<?php echo base_url(); ?>supervisors" >Home</a> | <a href="<?php echo base_url();?>supervisors/notifications/">Notifications (<?php echo $noty;?>)</a>  </legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }




</style>

<table id = "analystable">

    <thead><tr><th>Lab Reference</th><th>Message</th><th>Action</th></tr></thead>

    <tbody>
        <?php foreach ($getnoty as $test) { ?>
            <tr class="sample_issue">
                  
                <td class="common_data" ><span class="green_bold " id="<?php echo $test->labref;?>" ><a href="#" class="linked"><?php echo $test->labref;?></a></span></td>
              
                <td><?php echo $test->reason; ?></td>
                <td><a href="<?php echo site_url('supervisors/approve_it/'.$test->labref);?>" id="<?php echo $test->labref;?>" class="approve">Approve</a> | <a href="#reject" id="<?php echo $test->labref;?>" class="reject">Reject</a></td>
            </tr>
         <?php } ?>
 </tbody>

</table>

<script type="text/javascript">
    $(document).ready(function(){
      $('a.linked').click(function(){
          id=$(this).attr('id');
          alert(id);
         return false; 
      }) 
    });
    $(function() {

        $('#analystable').dataTable({
            "bJQueryUI": true
        }).rowGrouping({
            //iGroupingColumnIndex: 0,
            //sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 0
            //bExpandableGrouping:true,
          //  bExpandSingleGroup: false,
          //  iExpandGroupOffset: -1

        });
    });

</script>

