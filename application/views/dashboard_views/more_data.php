<style>
    td{
        text-align: center;
    }
</style>
<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
    <tr>
        <th>LAB REF No:</th>
        <th>DATE ISSUED</th>
        <th>DATE RETURNED</th>
        <th>ANALYSIS STATUS</th>
        <th>DURATION AFTER ISSUANCE</th>
        
    </tr> 
    <tbody>
        <?php foreach ($sample_data as $details): ?>
            <tr>
                <td><?php echo $details->labref ?></td>
                <td><?php echo $details->date_issued ?></td>
                <td><?php echo $details->date_returned ?></td>
                <td><?php 
                
                if($details->date_returned =='------' ){
                    echo 'Analysis in progress';
                }else{
                    echo 'Completed';
                }
                        
                        ?> </td> 
                <td><?php 
                if($details->date_returned==='------'){
               echo $details->difference .' Day(s) Ago';
                }else{
                  echo 'N/A';  
                }
?> </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>