<style>
    label{
        display: block;
    }
    #ide{
        margin: 0 aut0 auto;
    }
          form input,select,textarea {
	//width: 70%;
	padding: 5px;
	border: 1px solid #d4d4d4;
	border-bottom-right-radius: 5px;
	border-top-right-radius: 4px;
	
	line-height: 1.5em;
	//float: right;
	
	/* some box shadow sauce :D */
	box-shadow: inset 0px 2px 2px #ececec;
}
form input:focus {
	/* No outline on focus */
	outline: 0;
	/* a darker border ? */
	border: 1px solid #bbb;
}
#ide{
       background: rgb(246,248,249); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y2ZjhmOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjIwJSIgc3RvcC1jb2xvcj0iI2U1ZWJlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNWY3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(246,248,249,1) 0%, rgba(229,235,238,1) 20%, rgba(245,247,249,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(20%,rgba(229,235,238,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-8 */
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
border: 1px solid black;
box-shadow: 3px;
}  

</style>
<script>
    $("input").bind("keydown", function(event) {
        if (event.which === 13) {
            event.stopPropagation();
            event.preventDefault();
            $(this).nextAll("input").eq(0).focus();
        }
    });
    
      $(function() {
        $("#specification").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/Specifications_suggestions'); ?>",
                    data: {term: $("#specification").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });
    
          $(function() {
        $("#findings").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/Findings_suggestions'); ?>",
                    data: {term: $("#findings").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
        
        $('#cancel').click(function(){
        window.location.href= '<?php echo base_url()?>analyst_controller';
        });
    });
    
          $(function() {
        $("#procedure").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('identification/procedure_suggestions'); ?>",
                    data: {term: $("#procedure").val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            Delay: 200
        });
    });
</script>
<body id="identificaton">
<p></p>
<center><legend>NQCL IDENTIFICATION TESTING</legend>
    <hr>
    <div id="ide">
        <p>
        <form action="<?php echo base_url() . 'identification/saveDescription/' . $labref.'/'.$test_id ?>" method="post">
            <label><h4>Describe the procedure Used</h4></label>
            <div class="identify" ><textarea id="procedure" name="description" cols="50" rows="5" required></textarea></div>
            <label><h4>State the Specification</h4></label>
            <div class="identify"><textarea id="specification" name="value3" cols="50" rows="5" required></textarea></div>
            <label><h4>Describe Findings</h4></label>
            <div class="identify"><textarea id="findings" name="specification" cols="50" rows="5" required></textarea></div>
            
            </p>
                        <p><input type="submit" value="Submit"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Cancel" id="cancel"/></p>

        </form>
    </div>

</center>
</body>