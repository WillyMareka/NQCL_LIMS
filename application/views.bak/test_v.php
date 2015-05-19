<script>
    $(document).ready(function(){
      load=['Lamuvidine','Zidovudine','Alkaline','Meline','Sadoline'];
      $('#show').click(function() {
        var index = ($.inArray($(this).attr('class'), load) + 1) % load.length;
        $(this).text(load[index]);
    });
    });
</script>
<div class="show" style="color:yellow; width: 200px; height: 200px;">uhhhhjhjhh</div>