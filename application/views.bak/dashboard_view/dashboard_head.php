<?php 
if(!$this->session->userdata('user_id')){
    redirect('user_management/login');
}
$this->load->view('dashboard_view/header_scripts');

?>
<div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <div class="title-name">National Quality Control Laboratory<br>Director / Admin Area</div>  <img src="<?php echo base_url();?>dashboard/img/logo.png" alt="Logo" />                    
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="<?php echo base_url();?>dashboard/img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                           <?php     $userarray = $this->session->userdata;
                    $user_id = $userarray['user_id'];

                    $user_typ = User::getUserType($user_id);
                    $user_name = $user_typ[0]['fname'];
                    $messages = $user_typ[0]['pm_count'];
                    //echo $user_id;
                    ?>
                    
                            <li>Hello <?php echo $user_name;?></li>
                            <li><a href="#">Config</a> | </li>
                            <li><a href="<?php echo base_url();?>user_management/logout">Logout</a></li>
                        </ul>
                        <br />
                        <span class="small grey">Last Login: 3 hours ago</span>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
