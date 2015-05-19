<script>
$(document).ready(function(){
        $('#addFirstPosition').click(function(){
            var $tr = $('<tr><td>3</td><td>3</td></tr>');
            //var $myTable = $('#myTable');
            //$myTable.append($tr);
            $("#myTable > tbody").append($tr);
        });
        });
</script>
<input id="addFirstPosition" type="button" value="AddFirst" />
<input id="addMiddlePosition" type="button" value="AddMiddle" />
<input id="addLastPosition" type="button" value="AddLast" />
<br />
<input id="deleteFirstPosition" type="button" value="DelFirst" />
<input id="deleteMiddlePosition" type="button" value="DelMiddle" />
<input id="deleteLastPosition" type="button" value="DelLast" />
<br />
<br />
<table id="myTable" border="1px">
    <tbody>
        <tr>
            <td>
                1
            </td>
            <td>
                1
            </td>
        </tr>
        <tr>
            <td>
                2
            </td>
            <td>
                2
            </td>
        </tr>
    </tbody>
</table>
