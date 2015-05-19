<div class="container_12">
    <?php $this->load->view('dashboard_view/dashboard_head'); ?>
    <?php $this->load->view('dashboard_view/dashboard_main_nav'); ?>
    <?php $this->load->view('dashboard_view/dashboard_sidenav'); ?>
    <?php $this->load->view($contents);?>
    <div class="clear"> </div>
</div>
<?php
$this->load->view('dashboard_view/dashboard_footer');
