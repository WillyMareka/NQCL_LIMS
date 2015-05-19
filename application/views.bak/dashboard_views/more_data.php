<style>
    td{
        text-align: center;
    }
</style>
<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
    <tr>
        <th>LAB REF No:</th>
        <th>DURATION OF ISSUANCE</th>
        <th>SAMPLE STATUS</th>
    </tr> 
    <tbody>
        <?php foreach ($sample_data as $details): ?>
            <tr>
                <td><?php echo $details->labref ?></td> <td><?php echo $details->difference ?> Days Ago</td><td>N/A<td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>