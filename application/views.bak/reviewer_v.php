<?php error_reporting(0);?>
<style>
    #rej{
        display:none;
    }
</style>
<script>
    $(document).ready(function(){
      $('.reject').on('click',function(){
        $.fancybox.open({
          href:'#rej',
          width:600,
          height:500
       });
      });
      
      $('#rejecting').click(function(){
        $.ajax({
            type:'post',
            url:"<?php echo base_url();?>reviewer/reject/"+$('#labref').val()+"/"+$('#level').val(),
            data:$('#reasons').serialize(),
            success:function(){
               window.location.href='<?php echo base_url();?>reviewer/';
            },
            error:function(){
              alert('Notice: You have already posted a rejection reason for this sample!');  
               window.location.href='<?php echo base_url();?>reviewer/';
            }
        });
      });
       $('#canceling').click(function(){
          alert('a');
      });
      
      $('.reason').on('mouseover',function(){          
          id=$(this).prop('id');
          
           $.ajax({
            type:'get',
            url:"<?php echo base_url();?>reviewer/reject_reason/"+id+"/Reviewer/",
            dataType:'json',
            success:function(data){
               alert(data[0].reject_reason);
            },
            error:function(){
              alert('An error occured when attempting to retrieve Rejection reason!');  
              
            }
        });
        
          
    });
    });
</script>

<body> 
<legend><a href="<?php echo base_url(); ?>" ></a>  <a href="<?php echo base_url(); ?>reviewer" >Home</a>   </legend>
<hr />
<!-- Menu Start --> 

</div> 
<?php $user_id = $this->session->userdata('user_id'); ?>
<!-- End Menu --> 
<div>
    <table id = "refsubs">
        <thead>
            <tr>

                <th>Lab Reference No</th>
           
                <th>Download </th>                
                   <th>Upload Edits</th>
                      <th>Commit COA Results</th>
                <th>Acceptance Status</th>                    
             
                <th>Reject</th>
                <th>Priority</th>


            </tr>
        </thead>
        <tbody>
            <?php 
      
            foreach ($worksheets as $sheet): ?>
                <tr> 
                    <input type="hidden" id="level" value="Reviewer"/>
                    <input type="hidden" id="labref" value="<?php echo $sheet->folder;?>"/>
                  
                    <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>
                 
                    <td><?php echo anchor('reviewer_uploads/'.$sheet->folder.'.xlsx','Download Workbook'); ?></td>
                    
              
                    
                    <td><?php echo anchor('upload/reviewer_uploads/' . $sheet->folder.'/'.$sheet->microbiology.'/'.$sheet->test_id , 'Upload Edited Workbook'); ?></td>

                     <?php if ($sheet->microbiology == '1') { ?>
                          <td><?php echo anchor('upload/worksheet/' . $sheet->folder.'/'.$sheet->microbiology.'/'.$sheet->test_id , 'Update COA'); ?></td>
                     <?php }else{?>
                    <td><?php echo anchor('upload/worksheet/' . $sheet->folder, 'Upload'); ?></td>

                     <?php } ?>
                    <?php if ($sheet->status == '0') { ?>
                        <td><span style="background-color: yellow; color: black; font-weight: bold; border-radius: 2px;">Not yet Reviewed</span></td>
                    <?php } elseif ($sheet->status == '1') { ?>
                        <td><span style="background-color: yellowgreen; color: white; font-weight: bold; border-radius: 2px;">Reviewed</span ></td>
                    <?php } elseif ($sheet->status == '2') { ?>
                        <td><span style="background-color: #FF0000; color: white; font-weight: bold; border-radius: 2px;">Rejected : <a href="" class="reason" id="<?php echo $sheet->folder;?>">Why?</a></span></td> 
                    <?php } ?>
                    
                    <td style="background: cyan;"><a href="#rej" class="reject">Reject</a></td>

                    <?php if ($sheet->priority === '1') { ?>
                        <td><span id="high">High</span></td>
                    <?php } else { ?>
                        <td><span id="low">Low</span></td>    
                    <?php } ?>

                <?php endforeach; ?>
            </tr>
        </tbody>
        <div id="rej">
            <?php $this->load->view('rejections_v'); ?>
        </div>
    </table>


    <script type="text/javascript">
        $('#refsubs').dataTable({
            "bJQueryUI": true
        })
    </script>


</div>


</body> 
</html> 
