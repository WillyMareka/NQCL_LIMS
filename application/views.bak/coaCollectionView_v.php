	<html >	
		<form class = "methods">
			<ul>
				<li>
				<fieldset>
				<legend>Collector Info</legend>
				<?php foreach($collectors as $collector => $value) {?>
					<?php if($collector != 'id') { ?>
					<li>
						<label>
							<span><?php echo ucfirst(str_replace("_", " ", $collector)); ?></span>
							<?php echo $value ?>
						</label>
					</li>
				<?php } ?>
				<?php } ?>	
			</fieldset>
		</li>
	</ul>
		<!--/fieldset-->
	</form>
		<script type="text/javascript"></script>
</html>