<html>
<div class ="content2">
<!--legend>
<a id ="refSubs">Reference Substances</a>&nbsp;|&nbsp;
<a id ="chemicals">Chemicals</a>&nbsp;|&nbsp;
<a id ="equipment">Equipment</a>&nbsp;|&nbsp;
<a id ="columns">Columns</a> &nbsp;|&nbsp;
<a id ="reagents">Reagents</a>
</legend-->
<h3>Equipment</h3>
<legend><a id ="add" >Add</a>&nbsp;|&nbsp;<a id ="list" >List</a></legend>

<div>&nbsp;</div>

<hr class ="hidden2" />

<script type="text/javascript">
$(function(){
$('a').each(function(){

$(this).click(function(){

$('a').removeClass('link_highlight');
$(this).addClass('link_highlight');

	$('.content').remove();

	var ref = $(this).attr("id");

	$.get("equipment" + ref , function(i){
			
	$(i).insertAfter('hr');

})


})

})

})



</script>

</div>
</html>