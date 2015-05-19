<html>
	
<legend><a href="<?php echo base_url('/'); ?>">Home</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url('sample_issue/listing') ?>" >Sample Listing</a>&nbsp;&larr;&nbsp;Samples Issued Listing</legend>

<hr />	
	
	
	<table id="samples_issued">
			<thead>
				<tr>
				<th>Lab Reference Number</th>
				<th>Test</th>
				<th>Samples Issued</th>
				<th>Analyst</th>
				<th>Department</th>
				<th>Date Issued</th>
				
				</tr>
			</thead>
			<tbody>
				<?php foreach ($sample_issues as $sample_issue) {?>
					<?php
				$test_id = $sample_issue -> Test_id;
				$test_names = Tests::getTestName3($test_id);
				
				$dept_id = $sample_issue -> Department_id;
				$dept_names = Departments::getDeptName($dept_id);
				
				$analyst_id = $sample_issue -> Analyst_id;
				$analyst_names = User::getAnalyst3($analyst_id);
				
				$reqid = $sample_issue -> Lab_ref_no;
				$product_names = Request::getAll5($reqid);
				
				?>
					
				<tr>
					
					<td><span class = "plain_bold <?php if( $sample_issue -> Withdrawal_status == 1) {echo "gray_out";} else { echo " ";}  ?>"><?php echo $sample_issue -> Lab_ref_no . "&rarr;&nbsp;" . $product_names[0]['product_name'] . "&rarr;&nbsp;". $product_names[0]['active_ing'] ."&nbsp;"?></span>
						<a class = "<?php if( $sample_issue -> Withdrawal_status == 1) {echo "hidden2";} else { echo " ";}  ?>" id = "" href= "<?php if($sample_issue -> Withdrawal_status == 0){ echo site_url('sample_issue/edit') . "/" . $sample_issue -> Lab_ref_no  ;} else{ echo "#" ;} ?>">
							Edit</a>&nbsp;&nbsp;<?php echo "|"; ?>&nbsp;<a class="withdraw" href="<?php echo site_url('sample_issue/withdraw') . "/" . $reqid . "/" . $sample_issue -> Withdrawal_status ?>" rel ="" title= "">
							<?php if($sample_issue -> Withdrawal_status == 0 ) {echo "Withdraw";} else{ echo "Undo Withdraw";} ?></a></td>
					<td><span><?php echo $test_names[0]['Name']?></span><label class="smalltext gray_out italics">&nbsp;<?php if($sample_issue -> Withdrawal_status == 1 ) { echo "(Withdrawn)" ;} else { echo "";} ?></label></td>
					<td><span><?php echo $sample_issue -> Samples_no ?></span></td>
					<td><span><?php echo $analyst_names[0]['fname'] . " " . $analyst_names[0]['lname'] ?></span></td>
					<td><span><?php echo $dept_names[0]['Name'] ?></span></td>
					<td><span><?php echo date('d-M-Y', strtotime($sample_issue -> created_at)) ?></span></td>
					
				</tr>
				<input type="hidden" class="withdrawal_status" name="withdrawal_status" value="<?php echo $sample_issue -> Withdrawal_status ?>" />
				<?php }?>
			</tbody>
		</tr>
	</table>
	
	
	
	<script>
	$(document).ready(function() {
    issuesTable = $('#samples_issued').dataTable({
    	"bJQueryUI": true,
    	"asStripClasses": null
    		}).rowGrouping({
    			
    									//iGroupingColumnIndex: 0,
            							sGroupingColumnSortDirection: "asc",
            							iGroupingOrderByColumnIndex: 0,
            							//bExpandableGrouping:true,
            							bExpandSingleGroup: true,
            							iExpandGroupOffset: -1
    			
    		});
		});
		
	var issuesTable;

	
	$('.withdraw').click(function(){
			
			alert($(this).html());
			var nTr = this.parentNode.parentNode;
			
			if($(this).text() == 'Withdraw'){
				
				$(this).text("Cancel");
				
				var reqid = $(this).attr("rel");
				var versionid = $(this).attr("id");
				var testid = $(this).attr("name");
				var w_status = $(this).attr("title");
				
				$.get("withdraw/" + reqid + "/" + versionid + "/" + testid + "/" + w_status, function(withdraw){
					
					issuesTable.fnOpen(nTr, withdraw, 'withdraw');
				})
				
				
			}
			
			
			else{
				
			
				$(this).text("Withdraw");
				
				
				issuesTable.fnClose(nTr);
				
			}
			
			
		})
	
	$('.undo_withdraw').click(function(){
			
			//alert($(this).html());
			var nTr = this.parentNode.parentNode;
			
			if($(this).text() == 'Undo Withdraw'){
				
				$(this).text("Cancel");
				
				var reqid = $(this).attr("rel");
				var versionid = $(this).attr("id");
				var testid = $(this).attr("name");
				var w_status = $(this).attr("title");
				
				$.get("withdraw/" + reqid + "/" + versionid + "/" + testid + "/" + w_status, function(withdraw){
					
					issuesTable.fnOpen(nTr, withdraw, 'withdraw');
				})
				
				
			}
			
			
			else{
				
			
				$(this).text("Undo Withdraw");
				
				
				issuesTable.fnClose(nTr);
				
			}
			
			
		})
	
	
	
		
		
	</script>
</html>