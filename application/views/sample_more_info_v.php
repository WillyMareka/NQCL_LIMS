<html>
    <head>

    </head>
    <body>
        <div id = "sample_info">
            <fieldset>
                <legend>Client</legend>
                <?php foreach($client[0] as $t => $v ) {?>
                    <?php if(!is_array($v) && $t != 'id') {?> 
                        <label><?php $str = str_replace("_", " ", $t); echo ucwords($str); ?></label>&nbsp;:&nbsp;<label class = "bold" ><?php echo $v; ?></label><br>
						<p style = "line-height:1px" >&nbsp;</p>
                    <?php } ?>
                <?php } ?> 
            </fieldset>
            <fieldset>
                <legend>Product</legend>
                <?php foreach($request[0] as $key => $value) { ?>
                    <?php if(!is_array($value) && $key != 'id' ) {?>
                        <label><?php $str = str_replace("_", " ", $key); echo ucwords($str); ?></label>&nbsp;:&nbsp;<label class = "bold"><?php echo $value?></label><br>
						<p style = "line-height:1px" >&nbsp;</p>
				   <?php } ?>
                <?php } ?>
            </fieldset>
            <fieldset>
                <legend>Test(s)</legend>
                <?php foreach($tests as $t) {?>
                    <label class = "bold"><?php echo $t['Name']?></label><br>
					<p style = "line-height:1px" >&nbsp;</p>
				<?php } ?>
            </fieldset>
			<fieldset>
				<legend>Analysis/Supervison/Review Info</legend>
					<style type="text/css">
						.tg, .tk1  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
						.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
						.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
						.tg .tg-ugh9{background-color:#C2FFD6}
						.tk td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
						.tk th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
						.tk .tg-ugh9{background-color:#C2FFD6}
					</style>
					<div id="data_response">
						<table class="tg tj" >
							<tr><td colspan="5"><center><strong><em><br><span id="labr"></span>ACTIVITY LOG</em></strong></center></td></tr>
							<tr><td colspan="5" style="font-weight: bold; color: red;">NB: The table below holds information of old samples</td></tr>

							<tr>
							<tr>
								<th class="tg-031e">Activity</th>
								<th class="tg-031e">By</th>
								<th class="tg-031e">Date Issued </th>
								<th class="tg-031e">Date Returned<br> / COA Drafted & Approved </th>
							</tr>
							  
							<tbody>
								<tr><td colspan="4"></td></tr>
							</tbody>
						</table>
			
					<table class="tk1" >
							<tr><td colspan="4" style="font-weight: bold; color: red;">NB: The table below holds information for worksheets downloaded more than once </td></tr><tr>
							<tr>
								<th class="tg-031e">Test</th>
								<th class="tg-031e">Download Reason</th>
							</tr>
			  
						  <tbody>
                                                      <?php   foreach ($w_res as $e):?>
                                                      
							 <tr><td><?php echo $e->name;?></td><td><?php echo $e->reason;?></td></tr>
                                                  <?php  endforeach;?>
                                                                          
						  </tbody>
					</table>
                                            
                                            	<table class="tk2" >
							<tr><td colspan="2" style="font-weight: bold; color: red;">NB: The table below holds information about sample compliance </td></tr>
                                                 
							<tr>
                                                            <th class="tg-031e " style="text-align: left;">Test</th>
								<th class="tg-031e" style="text-align: left;">Compliance</th>
							</tr>
			  
						  <tbody>
                                                      <?php   foreach ($c_comp as $j):?>
                                                      
							 <tr><td><?php echo $j->test;?></td><td><?php echo $j->compliance;?></td></tr>
                                                  <?php  endforeach;?>
                                                         <tr>
                                                             <td colspan="2">
                                                                 <?php echo $desc[0]->reason;?>
                                                             </td>
                                                         </tr>
                                                                          
						  </tbody>
					</table>
				</div>
			</fieldset>
        </div>
    </body>


<script type="text/javascript">
    $('#sample_info').jWizard({
		menu:false,
		progress:false,
		buttons:{
			finish:{
				type:"close",
				text:"Close"
			}
		}
	});
	
	console.log($(window).load(function(){
    $('#labr,#labr1').text("<?php echo $reqid; ?>" + " " );
    $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>request_management/get_sample_personnel/"+ "<?php echo $reqid; ?>",
        dataType: "json",
        success:function(data_response){
            
             $tbody= $('.tj > tbody tr:last');
     
             $(".tj tbody tr.ai").remove();
    
            $.each(data_response,function(the, data){
              
  row = '<tr class="ai">\n\
    <td class="tg-ugh9">'+data.activity+'</td>\n\
    <td class="tg-ugh9">'+data.by+'</td>\n\
    <td class="tg-ugh9">'+data.date_issued+'</td>\n\
    <td class="tg-ugh9">'+data.date_returned+'</td>\n\
</tr>'; 
    
    $('.tj > tbody tr:last').before(row);
    
  
            });
            
                $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>request_management/get_sample_signatories/"+"<?php echo $reqid; ?>",
        dataType: "json",
        success:function(data_response){
            
             $tbody= $('.tk > tbody tr:last');
     
             $(".tk tbody tr.saved").remove();
    
            $.each(data_response,function(the, data){
              
  row = '<tr class="saved">\n\
    <td class="tg-ugh9">'+data.designation+'</td>\n\
    <td class="tg-ugh9">'+data.signature_name+'</td>\n\
    <td class="tg-ugh9">'+data.date_signed+'</td>\n\\n\
</tr>'; 
    
    $('.tk > tbody tr:last').before(row);
    
  
            });
            
         
        },error:function(){
            alert('An error occured while loading the information, Try again later');
        }
    });          
            
       
        },error:function(){
            alert('An error occured while loading the information, Try again later');
        }
    });
}));

//Clicking jwizard close button closes jwizard	
	$("button[type = 'close']").click(function(){
		parent.$.fancybox.close();
	})
	
</script>

</html>