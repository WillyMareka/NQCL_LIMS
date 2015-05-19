<script>
jQuery(document).ready(function() {
    $('#submitted-home').click(function() {

        $('.contact-form form .nameLabel').html('Name');
        $('.contact-form form .emailLabel').html('Email');
        $('.contact-form form .messageLabel').html('Message');

        var postdata = $('.contact-form form').serialize();
        host = window.location.protocol+'//'+window.location.host+'/holmanbrothers/welcome/sendemail/';
        $.ajax({
            type: 'POST',
            url: host,
            data: postdata,
            dataType: 'json',
            success: function(json) {           
                    $('.contact-form form, #info').fadeOut('fast', function() {
                        $('.contact-form').append('<p><span class="violet">Thanks for contacting us!</span> We will get back to you very soon.</p>');
                    });
                },error:function(){
                alert('An error occured, Please Try Again Later!');
            }
        });
        return false;
    });
});

</script>
<style>

</style>

<!-- End WOWSlider.com HEAD section -->
</head>
<body>
   
    <div class="container">
        <div class="row" style="margin-top:10px; ">
            
            
         	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/engine1/style.css" />
	<script type="text/javascript" src="<?php echo base_url()?>assets/engine1/jquery.js"></script>
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
<li><img src="<?php echo base_url()?>assets/img/slider/gasitaly_g_38...png" alt="We provide the full range of industrial and mining compressors." title="We provide the full range of industrial and mining compressors." id="wows1_0"/></li>
<li><img src="<?php echo base_url()?>assets/img/slider/image1.jpg" alt="We provide full range of earth moving equipment from world’s leading brands" title="We provide full range of earth moving equipment from world’s leading brands" id="wows1_1"/></li>
<li><img src="<?php echo base_url()?>assets/img/slider/image2.jpg" alt="We provide the full range of mobile cranes." title="We provide the full range of mobile cranes." id="wows1_2"/></li>
<li><img src="<?php echo base_url()?>assets/img/slider/image3.jpg" alt="We provide full range of earth moving equipment from world’s leading brands" title="We provide full range of earth moving equipment from world’s leading brands" id="wows1_3"/></li>
<li><img src="<?php echo base_url()?>assets/img/slider/image4.jpg" alt="We provide the full range of industrial and mining compressors. " title="We provide the full range of industrial and mining compressors. " id="wows1_4"/></li>
<li><img src="<?php echo base_url()?>assets/img/slider/image5.jpg" alt="We are east Africa’s leading agricultural equipment dealer " title="We are east Africa’s leading agricultural equipment dealer " id="wows1_5"/></li>
<li><img src="<?php echo base_url()?>assets/img/slider/open.jpg" alt="Open Broadcrown Generator" title="Open Broadcrown Generator" id="wows1_6"/></li>
<li><img src="<?php echo base_url()?>assets/img/slider/closed.jpg" alt="Closed Broadcrown Generator" title="Closed Broadcrown Generator" id="wows1_7"/></li>
</ul></div>
<div class="ws_bullets"><div>
<a href="#" title="We provide the full range of industrial and mining compressors.">1</a>
<a href="#" title="We provide full range of earth moving equipment from world’s leading brands">2</a>
<a href="#" title="We provide the full range of mobile cranes.">3</a>
<a href="#" title="We provide full range of earth moving equipment from world’s leading brands">4</a>
<a href="#" title="We provide the full range of industrial and mining compressors. ">5</a>
<a href="#" title="We are east Africa’s leading agricultural equipment dealer ">6</a>
<a href="#" title="Open Broadcrown Generator">7</a>
<a href="#" title="Closed Broadcrown Generator">8</a>
</div></div><span class="wsl"><a href="http://wowslider.com/vs">jquery slideshow</a> by WOWSlider.com v6.1</span>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="<?php echo base_url()?>assets/engine1/wowslider.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
            
            
      
              
        
    </div>


    <!-- Site Description -->
    <div class="presentation container about">
        <h2>We are Holman Brothers (EA) Ltd, the number one  equipment variety's dealer.</h2>
        <p style="color:#1B4388;">We deal in Compressor, Generator, Construction, Agricultural Equipment. <a href="<?php echo base_url() ?>welcome/products">See our products page</a></p>
    </div>


    <!-- Latest Work -->
    <div class="portfolio container">
        <div class="portfolio-title">
            <h3>Our Latest Equipment</h3>
        </div>
        <div class="row">
            <div class="work span3">
                <img src="<?php echo base_url() ?>assets/img/portfolio/image1.jpg" alt="">
                <h4>LANDINI TRACTOR</h4>
                <p>Description</p>
                <div class="icon-awesome">
                    <a href="<?php echo base_url() ?>assets/img/portfolio/image1.jpg" rel="prettyPhoto"><i class="icon-search"></i></a>
                    <a href="#"><i class="icon-link"></i></a>
                </div>
            </div>
            <div class="work span3">
                <img src="<?php echo base_url() ?>assets/img/portfolio/image2.jpg" alt="">
                <h4>SANY MOBILE CRANE</h4>
                <p>Description</p>
                <div class="icon-awesome">
                    <a href="<?php echo base_url() ?>assets/img/portfolio/image2.jpg" rel="prettyPhoto"><i class="icon-search"></i></a>
                    <a href="#"><i class="icon-link"></i></a>
                </div>
            </div>
            <div class="work span3">
                <img src="<?php echo base_url() ?>assets/img/portfolio/image3.jpg" alt="">
                <h4>SANY MOTOR GRADER</h4>
                <p>Description</p>
                <div class="icon-awesome">
                    <a href="<?php echo base_url() ?>assets/img/portfolio/image3.jpg" rel="prettyPhoto"><i class="icon-search"></i></a>
                    <a href="#"><i class="icon-link"></i></a>
                </div>
            </div>
            <div class="work span3">
                <img src="<?php echo base_url() ?>assets/img/portfolio/image4.jpg" alt="">
                <h4>ELGI COMPRESSOR</h4>
                <p>Description</p>
                <div class="icon-awesome">
                    <a href="<?php echo base_url() ?>assets/img/portfolio/image4.jpg" rel="prettyPhoto"><i class="icon-search"></i></a>
                    <a href="#"><i class="icon-link"></i></a>
                </div>
            </div>
            
                <div class="work span3">
                <img src="<?php echo base_url() ?>assets/img/portfolio/dt175.jpg" alt="">
                <h4>ELGI PORTABLE COMPRESSOR</h4>
                <p>Description</p>
                <div class="icon-awesome">
                    <a href="<?php echo base_url() ?>assets/img/portfolio/image4.jpg" rel="prettyPhoto"><i class="icon-search"></i></a>
                    <a href="#"><i class="icon-link"></i></a>
                </div>
            </div>
            
                <div class="work span3">
                <img src="<?php echo base_url() ?>assets/img/portfolio/encaps.png" alt="">
                <h4>ELGI ENCAP SERIES</h4>
                <p>Description</p>
                <div class="icon-awesome">
                    <a href="<?php echo base_url() ?>assets/img/portfolio/encaps.png" rel="prettyPhoto"><i class="icon-search"></i></a>
                    <a href="#"><i class="icon-link"></i></a>
                </div>
            </div>
            
                <div class="work span3">
                <img src="<?php echo base_url() ?>assets/img/portfolio/elgis.png" alt="">
                <h4>ELGI SCREW COMPRESSOR</h4>
                <p>Description</p>
                <div class="icon-awesome">
                    <a href="<?php echo base_url() ?>assets/img/portfolio/elgis.png" rel="prettyPhoto"><i class="icon-search"></i></a>
                    <a href="#"><i class="icon-link"></i></a>
                </div>
            </div>
            
        </div>
    </div>

    
</body>
