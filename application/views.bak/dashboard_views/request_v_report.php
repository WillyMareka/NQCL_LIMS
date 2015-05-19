<body>
    <table class="tg">
        <tr>
            <th class="tg-031e">REQUEST ID</th>
            <th class="tg-031e">CLIENT NAME</th>
            <th class="tg-031e">PRODUCT NAME</th>
            <th class="tg-031e">ACTIVE INGREDIENT</th>
            <th class="tg-031e">DESIGNATION DATE</th>
            <th class="tg-031e">MANUFACTURER NAME</th>
            <th class="tg-031e">BATCH NUMBER</th>
            <th class="tg-031e">EXPIRY DATE</th>
        </tr>
        <?php foreach ($render_data as $render):?>
        <tr>
            <td class="tg-ugh9"><?php echo $render->request_id; ?></td>
            <td class="tg-ugh9"><?php echo $render->name; ?></td>
            <td class="tg-ugh9"><?php echo $render->product_name; ?></td>
            <td class="tg-ugh9"><?php echo $render->active_ing; ?></td>
            <td class="tg-ugh9"><?php echo $render->designation_date; ?></td>
            <td class="tg-ugh9"><?php echo $render->manufacturer_name; ?></td>
            <td class="tg-ugh9"><?php echo $render->batch_no; ?></td>
            <td class="tg-ugh9"><?php echo $render->exp_date; ?></td>
        </tr>
        <?php endforeach;?>
    </table> 
</body>