<html>
	<title>Label for <?php echo $code ?></title>
	<head></head>
		<form class = "methods" id = "refsub_label" >
			<h3>Print label for <?php echo $code ?></h3>
			<ul>
				<li>
					<fieldset>
						<legend>Standard Details</legend>
						<?php foreach ($refsub[0] as $key => $value) { ?>
						<li>
							<label>
								<span><?php echo $key; ?></span>
									  <?php echo $value; ?>	
							</label>
						</li>
						<?php } ?>
					</fieldset>
				</li>
				<li>
					<fieldset>
						<legend>No. of Labels</legend>
						<li>
							<label>
								<span>Labels No.</span>
								<input id = "labels_no" name = "labels_no" placeholder = "e.g 2" type = "text" />
							</label>
						</li>
					</fieldset>
				</li>
				<li>
					<input value="Print" type="submit" class = "submit-button leftie" />
				</li>
			</ul>
		</form>
		<script type="text/javascript">
		    $('#refsub_label').submit(function(e) {
		            e.preventDefault();

		            
		            
		            var href = '<?php echo base_url() . "refsubs_management/printPdfLabel/$code" ?>' + "/" + $('#labels_no').val() + "/" + <?php echo $id; ?>;
		            var href2 ='<?php echo base_url() . "labels/refsubs/Label$code" ?>' + ".pdf";
		            $.ajax({
		                type: 'POST',
		                url: href,
		                data: $('#refsub_label').serialize()
		            }).done(function() {
		                //parent.$.fancybox.resize();
		                parent.$.fancybox.open({
		                    href: href2,
		                    type: 'iframe',
		                    autoSize: false,
		                    height: 842,
		                    width: 595
		                    //content: '<embed src = "'+href2+'#nameddest=self&page=1&view=FitH, 0&zoom=80,0,0" type="application/pdf" height="99%" width="100%" />', 
		                });
		            })

		        })
		</script>
</html>