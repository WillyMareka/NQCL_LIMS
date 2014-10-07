<html>
    <head>
        <?php $this->load->view('template_v'); ?>
        <title>Sample Details to excel</title>
  
        <style type="text/css">
            .Final_submission{
                width: 100%;
                min-height: 1024px;
                background: blue;
            }

            .LSideFS{
                width: 240px;
                min-height: 1000px;
                background: #00CC33;
                margin-top: 5px;
                position: absolute;
                margin-left: 4px;
            }

            .FSTRepeats{
                width: 228px;
                min-height: 400px;
                background:  white;
                margin-left: 6px;
                border-radius: 3px;
            }

            .Nav{
                margin-left: 10px;
            }

            .RSideFS{
                width: 1054px;
                min-height: 1000px;
                background: white;
                margin-top: 5px;
                position: absolute;
                margin-left: 249px;

            }
            .RSideFSIframe{
                width:100%;
                min-height: 1000px;
            }
            fieldset#SampleAssay{
                width: 480px;

            }
            .peaks{
                float: right;
                width:200px;
            }

            fieldset.weight{
                width:200px;
                margin-left:10px;
                float:left;
            }
            fieldset.tabscaps{
                width:190px;
                margin-left:10px;
                float:left;  
            }

            fieldset.dissoultion{
                width:200px;
                margin-left:10px;
                float:left;
            }
            label{
                font-weight: bold;
                margin-bottom: 3px;
                display:block;
                margin: 5px;
            }
            intput[type=text]{
                margin-top: 2px;
                display: block;
                font-weight: bold;
            }
            #Export{
                background-color: transparent; /* make the button transparent */
                background-repeat: no-repeat;  /* make the background image appear only once */
                background-position: 0px 0px;  /* equivalent to 'top left' */
                border: none;           /* assuming we don't want any borders */
                cursor: pointer;        /* make the cursor like hovering over an <a> element */
                height: 50px;           /* make this the size of your image */
                padding-left: 16px;     /* make text start to the right of the image */
                vertical-align: middle; /* align the text vertically centered */
                background-image: url(<?php echo base_url() . 'img/excel_2007.png' ?>); /* 16px x 16px */
                /*   float:right;*/
                margin-right: 400px;
            }
            .overallarea{
                height:100%;
                width:1024px;
                margin-left:250px;
            }
            #sidepannel{
                width: 200px;
                height:400px;
                border: 1px solid #33ff33;
                position: absolute;
            }
            #st{
                margin: 5px;
            }
            #head{
                width: 100%;
                height: 40px;
                background-color: black;
                color:white;
                text-align: center;
                line-height: 40px;

            }
            #download{
                width:180px;
                height:40px;
                background-color: lightgreen;
                text-align: center;
                line-height: 40px;
                font-weight: bolder;
                color:black;
                font-size: 15px;
                -moz-border-radius: 5px;
                border-radius: 5px;

            }
            #a,#b,#c{
                width: 10px;
                background-color: mediumaquamarine;
                width:180px;
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
        </style>
        <script>
            $(document).ready(function() {
               
               $.ajax({
                    type: "get",
                    url: "<?php echo base_url() . 'sample_requests/project/'; ?>",
                    success: function() {
                        $('.RSideFSIframe').attr('src', '<?php echo base_url() . 'sample_requests/homepage/'; ?>');
                        loadComponents();
                    },
                    error: function() {

                    }
                });
                 $('#repeat_Assay').change(function() {
                                    repeat = $(this).val();
                                    component_no = $('#component').val();
                                    // test_name = $(this).attr('class');
                                    n = "<?php echo base_url(); ?>sample_requests/samples/<?php echo $labref; ?>/" + repeat + "/" + component_no;
                                    $('.RSideFSIframe').attr('src', n);
                                    // alert(n)
                                    $.ajax({
                                        type: "POST",
                                        url: n,
                                        // dataType:"json",             
                                        success: function(data) {                                           
                                            $('.RSideFSIframe').attr('src', n);
                                            $('#Export,.exp1').show();

                                            //  $('.RSideFSIframe').attr('src', n);
                                        },
                                        error: function() {

                                        }
                                    });

                                });  
                                
                                   $('#repeat_Dissolution').change(function() {
                                    repeat = $(this).val();
                                    component_no = $('#component').val();
                                    // test_name = $(this).attr('class');
                                    n = "<?php echo base_url(); ?>sample_requests/samples/<?php echo $labref; ?>/" + repeat + "/" + component_no;
                                    $('.RSideFSIframe').attr('src', n);
                                    // alert(n)
                                    $.ajax({
                                        type: "POST",
                                        url: n,
                                        // dataType:"json",             
                                        success: function(data) {

                                            console.log(data);
                                            $('.RSideFSIframe').attr('src', n);


                                            //  $('.RSideFSIframe').attr('src', n);
                                        },
                                        error: function() {

                                        }
                                    });

                                });
                     

                      
                                function loadComponents() {
                                    var select = $('#component').empty();
                                    // test_name = $('#repeat').attr('class');
                                    $.ajax({
                                        type: "GET",
                                        url: "<?php echo base_url(); ?>sample_requests/components/<?php echo $labref; ?>",
                                                        dataType: "json",
                                                        success: function(data) {
                                                            select.append("<option value=''>-Select-</option>");
                                                            $.each(data, function(i, r) {

                                                                select.append("<option value=" + r.component_no + ">" + r.component + "</option>");
                                                            });
                                                        },
                                                        error: function() {

                                                        }
                                                    });

                                                }

                                                $('#component').change(function() {
                                                $('#href').hide();
                                                    var assay = $('#repeat_Assay').empty();
                                                  var dissolution = $('#repeat_Dissolution').empty();
                                                    component_no = $(this).val();
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "<?php echo base_url(); ?>sample_requests/getRepeats_Assay/<?php echo $labref; ?>/" + component_no,
                                                        dataType: "json",
                                                        success: function(data) {
                                                            assay.append("<option value=''>-Select-</option>");
                                                            $.each(data, function(i, r) {
                                                                var opt = (r.repeat_status);
                                                                assay.append("<option value=" + opt + ">" + opt + "</option>");

                                                                $.ajax({
                                                                    type: "GET",
                                                                    url: "<?php echo base_url(); ?>sample_requests/getRepeats_Dissolution/<?php echo $labref; ?>/" + component_no,
                                                                    dataType: "json",
                                                                    success: function(data) {
                                                                           var dissolution = $('#repeat_Dissolution').empty();
                                                                        //dissolution.append("<option value=''>-Select-</option>");
                                                                        $.each(data, function(i, r) {
                                                                            var opt = (r.repeat_status);
                                                                            dissolution.append   ("<option value=" + opt + ">" + opt + "</option>");
                                                                        });
                                                                    },
                                                                    error: function() {

                                                                    }
                                                                });

                                                            });
                                                        },
                                                        error: function() {

                                                        }
                                                    });
                                                    });
             });
        </script>

    </head>
    <body>
    <legend><a href="<?php echo base_url() . "sample_requests"; ?>">< < Back</a> &nbsp; || &nbsp;<a href="<?php echo site_url() . "analyst_controller/"; ?>">My Home</a></legend>        

    <?php
    foreach ($worksheetInfo as $Info)
        ;
    ?>

    <div class="Final_submission">
        <div class='LSideFS'>
            <div class='FSTRepeats'>
                <div class='Nav'>
                    <div class='labels'>
                        <p><label>component</label><select id='component'></select></p>
                        <p><label>Assay Run</label><select id='repeat_Assay'></select></p>
                                <p><label>Dissolution Run</label><select id='repeat_Dissolution'>
                                        <option value=""></option>
                                        <option value="1">1</option>
                            </select></p>
                        <p><a id="href"  href='<?php echo base_url() ?>analyst_labreference'><p id='download'><img src='<?php echo base_url() ?>img/dowload.ico'/>Download Worksheet </p></a></p>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="RSideFS">
            <iframe class="RSideFSIframe" src=""  frameborder=0 scrolling=auto ></iframe>
        </div>
    </div>
</body>

</html>