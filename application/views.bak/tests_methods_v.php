<html>
<legend>Select Test Methods&nbsp;&rarr;&nbsp;<?php echo $this -> uri -> segment(3) ?></legend>
<hr />
<div>
<?php foreach($tests as $test) { ?>

	<?php echo $test['Name'] ?>

<?php } ?>
</div>
</html>