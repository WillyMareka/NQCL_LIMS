<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/styleassay.css" type="text/css" media="screen"/>
    <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
    <style type="text/css">
        hr
{
border:none;
border-top:1px #CCCCCC solid;
height: 1px;
}
        input#mgml1,#workingmgml,
        #mgml,#smgml2,#smgml,#smgml3,#smgml1{
            /*            width: 150px;*/
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
    <script type="text/javascript">
        $('input').live("keypress", function(e) {
            /* ENTER PRESSED*/
            if (e.keyCode === 13 || e.keyCode === 40) {
                /* FOCUS ELEMENT */
                var inputs = $(this).parents("form").eq(0).find(":input:visible:not(disabled):not([readonly])");
                var idx = inputs.index(this);

                if (idx === inputs.length - 1) {
                    inputs[0].select();
                } else {
                    inputs[idx + 1].focus(); //  handles submit buttons
                    inputs[idx + 1].select();
                }
                return false;
            }
        });

        showNotification({
            type: "information",
            message: "Hi!, Assay Area!.",
            autoClose: true,
            duration: 2
        });
        
        function prompt_dialog() {
    $("#dialog").lightbox_me({
        closeClick: false,
        centered: true
    });
}

//      $(document).ready(function() {
//          $('form').dumbFormState({
//              persistPasswords: false, // default is false, recommended to NOT do this
//               persistLocal: true, // default is false, persists in sessionStorage or to localStorage
//              skipSelector: null, // takes jQuery selector of items you DO NOT want to persist 
//               autoPersist: true // true by default, false will only persist on form submit
//           });
//
//
//      });

        function generate(type) {

            var today = new Date();
            var cHour = today.getHours();
            var cMin = today.getMinutes();
            var cSec = today.getSeconds();
            var time = cHour + ":" + cMin + ":" + cSec;

            var d = new Date();

            var month = d.getMonth() + 1;
            var day = d.getDate();

            var output = (('' + day).length < 2 ? '0' : '') + day + '/' +
                    (('' + month).length < 2 ? '0' : '') + month + '/' +
                    d.getFullYear();
            var n = noty({
                text: type,
                type: type,
                dismissQueue: true,
                layout: 'topCenter',
                theme: 'defaultTheme',
                timeout: 5000,
                text:'Work Autosaved Temporarily: ' + output + '\t' + time
            });
            console.log('html: ' + n.options.id);
        }

        function generateAll() {

            generate('information');

        }

        $(document).ready(function() {
            
         
  
$('#sendit').click(function() {
    var data = $('#reason').serialize();
    $.ajax({
        type: 'post',
        url: '<?php echo base_url() . 'assay/postRepeatReason/' . $labref; ?>',
        data: data,
        success: function(data) {
         alert('Reason Successfully Saved, Saving Data.....');
      postData = $('#assayFormMultiple').serialize();

        $.ajax({
            type: "POST",
            // url: "<?php echo base_url(); ?>",
            url: "<?php echo base_url(); ?>assay_injection_pi/save_assay_multiple/<?php echo $labref . '/' . $test_id; ?>",
                            data: postData,
                            success: function() {

                                showNotification({
                                    message: "Assay data has been successfully saved! ",
                                    type: "success",
                                    autoClose: true,
                                    duration: 5

                                });
                                // $('#middle_assay,#last_part').slideUp('fast');
                                $('#Export').hide();
                                $('#finish').show();
                                $('#addassay').show();
                                $('#addassaykv').show();
                               // loadComponents();
                                // $('form').dumbFormState('remove');
                            },
                            error: function() {
                                showNotification({
                                    message: "Oops! an error occurred.",
                                    type: "error",
                                    autoClose: true,
                                    duration: 5
                                });
                            }

                        });       
         
         
        },
        error: function() {

        }


    })

    $('#dialog').trigger('close');
});


$('#cancelit').click(function(){
window.location.href="<?php echo base_url().'analyst_controller';?>";
});

$('#closeit').click(function(){
      $('#Export').prop('value', 'Save ' +$('#activeIngredient').val());
       $('#Export').prop('disabled', false);
 $('#dialog').trigger('close');
});
   
         
       $('#activeIngredient').change(function(){
       substance=$(this).val();
       $.ajax({
           type:"GET",
           url:"<?php echo base_url(); ?>assay/refsubs/" + substance,
           dataType:"json",
           success:function(data){
               $('#code').empty();
               $('#aqty').val('');                                                               
               $('#potency').val('');
               $('#codein').val();
               
               $.each(data, function(id, substance){
                 $('#code').text(substance.rs_code);
                  $('#unit').val(substance.init_mass_unit);
                 $('#codein').val(substance.rs_code);
               $('#aqty').val(substance.init_mass+substance.init_mass_unit); 
               pot=parseFloat(substance.potency);                                                  
               $('#potency').val(pot + substance.potency_unit); 
                });
               
           },
           error:function(data){
           }    
       });
       
     });

        });


        //SAVE AND ADD ACTIVE INGREDIENT======================================================================
        $(document).ready(function() {
            loadComponents();
            
            $('#addassay').hide();
            $('#addassaykv').hide();
            $('#finish').hide();
                $('#Export').click(function() {
        $(this).prop('value', 'Processing....');
       $(this).prop('disabled', 'disabled');
        substance=$('#activeIngredient').val();
            $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>assay_injection/check_done/<?php echo $labref; ?>/" + substance,
                    dataType: "json",
                    success: function(data) {
                            if (data.done_state === 1) {
                            prompt_dialog();                  
                            
                            
                            }else{
                            
              postData = $('#assayFormMultiple').serialize();

        $.ajax({
            type: "POST",
            // url: "<?php echo base_url(); ?>",
            url: "<?php echo base_url(); ?>assay_injection_pi/save_assay_multiple/<?php echo $labref . '/' . $test_id; ?>",
                            data: postData,
                            success: function() {

                                showNotification({
                                    message: "Assay data has been successfully saved! ",
                                    type: "success",
                                    autoClose: true,
                                    duration: 5

                                });
                                // $('#middle_assay,#last_part').slideUp('fast');
                                $('#Export').hide();
                                $('#finish').show();
                                $('#addassay').show();
                                $('#addassaykv').show();
                                loadComponents();
                                // $('form').dumbFormState('remove');
                            },
                            error: function() {
                                showNotification({
                                    message: "Oops! an error occurred.",
                                    type: "error",
                                    autoClose: true,
                                    duration: 5
                                });
                            }

                        });
                            
                            
                            }
                    },
                    error: function(data) {
                            console.log(data);
                            }
                         });       
       

                    });

                            
 function register(){
 
 }



function loadComponents() {
var select = $('#activeIngredient').empty();
        $.ajax({
        type: "GET",
        url: "<?php echo base_url(); ?>assay/loadComponents/<?php echo $labref; ?>",
        dataType: "json",
        success: function(data) {
                if (data == "5") {
                new Messi('No more Active Ingredients left to be tested , I\'ll take you Home', {title: 'No More Active Ingredient', modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}], callback: function(val) {

                if (val === 'X')
                window.location.href = "<?php echo base_url() . 'analyst_controller/' ?>";
                }});

                } else {
                        $.each(data, function(i, r) {
                        var opt = (r.name);
                        select.append("<option value=" + opt + ">" + opt + "</option>")
                        });
                        $('#small_data').val(data[0].volume1);
						$('#labelclaim').val(data[0].volume2);
						$('#components_').val(data[0].name);
						$('#unit').text(data[0].unit1);
                        $('#Export').prop('value', 'Save ' + data[0].name);
                        $('#Export_r').prop('value', 'Save ' + data[0].name + ' & Repeat');
                  }
                 

                    },
                    error: function() {

                }
            });

}



function loadRepeatComponents() {
var select = $('#activeIngredient').empty();
$.ajax({
    type: "GET",
    url: "<?php echo base_url(); ?>assay/loadRepeatComponents/<?php echo $labref; ?>",
                    dataType: "json",
                    success: function(data) {

                        $.each(data, function(i, r) {
                            var opt = (r.name);
                            select.append("<option value=" + opt + ">" + opt + "</option>")
                        });
                        
                         active=$('#activeIngredient').find('option').first().val();
            //alert(active);
                        
                    },
                    error: function() {

                    }
                });

            }
            
 

//SAVE AND REPEAT==================================================================================== 
$('#Export_r').click(function() {
    $(this).prop('value', 'Processing....');
    $(this).prop('disabled', 'disabled');
    $('#Export').hide();
    postData = $('#assayFormMultiple').serialize();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>assay_injection_pi/save_assay_multiple/<?php echo $labref.'/'.$test_id; ?>",
                        data: postData,
                        success: function() {
                            loadRepeatComponents();
                            $('.activeIngredient').show();
                            $('#Export_r').prop('value', 'Save');
                            $('#Export_r').prop('disabled', false);
                            // $('form').dumbFormState('remove');
                            repeat();
                            showNotification({
                                message: "The data has been successfully saved! ",
                                type: "success",
                                autoClose: true,
                                duration: 5

                            });


                            $('input[type=number],input[type=text],#workingvf1,#workingp1,#workingvf2,#svf1,#svf2,#sp1,#apparatus').each(function() {
                                $(this).val('');
                            });


                        },
                        error: function() {
                            showNotification({
                                message: "Oops! an error occurred.",
                                type: "error",
                                autoClose: true,
                                duration: 5
                            });
                        }

                    });




                });

                function repeat() {
                    var select = $('#activeIngredient option:selected').val();
                    $('#Export').prop('value', 'Save ' + select);
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assay/loadComponents_lc/<?php echo $labref; ?>/" + select,
                        dataType: "json",
                        success: function(data) {
                            $('#volume').val(data[0].volume);
                       },
                        error: function() {

                        }
                    });
                }

                //========================================================================================================  



                $('#addassay').click(function() {
                    $('input[type=number],input[type=text],#workingvf1,#workingp1,#workingvf2,#svf1,#svf2,#sp1,#apparatus').each(function() {
                        $(this).val('');

                    });
                    $(this).hide();

                    $('#Export').show();
                    $('#Export_r').show();

                    selectItems = $("#activeIngredient option").length;
                    console.log(selectItems);
                    if (selectItems === 1) {
                        $('#Export').prop('value', 'Save' + $('#activeIngredient option:selected').text() + '& Finish');
                    } else {
                        $('#Export').prop('value', 'Save ' + $('#activeIngredient option:selected').text());
                    }
                    $('#Export').prop('disabled', false);
                    // $('.activeIngredient').show();
                    loadComponents();
                    //loadRepeatComponents();
                });
                $('#addassaykv').click(function() {
                    $(this).hide();
                     $('.stdclear1').prop('selectedIndex',0);
                     $('.stdclear').prop('value','');
                    $('#addassay').hide();
                    $('#Export').show();
                    $('#Export_r').show();
                    selectItems = $("#activeIngredient option").length;
                    console.log(selectItems);
                    if (selectItems === 1) {
                        $('#Export').prop('value', 'Save' + $('#activeIngredient option:selected').text() + '& Finish');
                    } else {
                        $('#Export').prop('value', 'Save ' + $('#activeIngredient option:selected').text());
                    }
                    $('#Export').prop('disabled', false);
                    loadComponents();
                });

                $('#finish').click(function() {
                    window.location.href = '<?php echo base_url() ?>analyst_controller';
                });


            });


$(document).ready(function(){
    $('#smgml').keyup(function(){
        val= $(this).val();
       $('#workingmgml').val(val);
       
    });
    
     $('#workingmgml').keyup(function(){
        val= $(this).val();
       $('#smgml').val(val);
       
    });
    
        $('#mwsalt,#mwbase').keyup(function(){
        salt= parseFloat($('#mwsalt').val());
        base= parseFloat($('#mwbase').val());
        convfactor=base/salt;
        $('#convfact').val(convfactor.toFixed(4));
    });
   
    });




    </script>
</head>
<style> 
.tg-table-light { border-collapse: collapse; border-spacing: 0; }
.tg-table-light td, .tg-table-light th { background-color: #fff; border: 1px #bbb solid; color: #333; font-family: sans-serif; font-size: 100%; padding: 0px; vertical-align: top; }
.tg-table-light .tg-even td  { background-color: #eee; }
.tg-table-light th  { background-color: #ddd; color: #333; font-size: 110%; font-weight: bold; }
.tg-table-light tr:hover td, .tg-table-light tr.even:hover td  { color: #222; background-color: #FCFBE3; }
.tg-bf { font-weight: bold; } .tg-it { font-style: italic; }
.tg-left { text-align: left; } .tg-right { text-align: right; } .tg-center { text-align: center; }
    
    input#activeIngredient{
        width: 250px;
        text-align: center;
        font-weight: bold;
    }
    .activeIngredient{
        display: none;
    }
    .refsub{
        width:150px;
        height: 180px;
        background: rgb(180,221,180); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(180,221,180,1) 0%, rgba(131,199,131,1) 10%, rgba(82,177,82,1) 24%, rgba(0,138,0,1) 100%, rgba(0,87,0,1) 100%, rgba(0,36,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(180,221,180,1)), color-stop(10%,rgba(131,199,131,1)), color-stop(24%,rgba(82,177,82,1)), color-stop(100%,rgba(0,138,0,1)), color-stop(100%,rgba(0,87,0,1)), color-stop(100%,rgba(0,36,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4ddb4', endColorstr='#002400',GradientType=0 ); /* IE6-9 */


        position: absolute;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        box-shadow: 5px;
        padding: 5px;
        z-index: 10px;
        color:white;
        margin: 3px;
        font-weight: bolder;
        
    }
    
     .refsub1{
        width:165px;
        height: 280px;
        background: rgb(180,221,180); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(180,221,180,1) 0%, rgba(131,199,131,1) 10%, rgba(82,177,82,1) 24%, rgba(0,138,0,1) 100%, rgba(0,87,0,1) 100%, rgba(0,36,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(180,221,180,1)), color-stop(10%,rgba(131,199,131,1)), color-stop(24%,rgba(82,177,82,1)), color-stop(100%,rgba(0,138,0,1)), color-stop(100%,rgba(0,87,0,1)), color-stop(100%,rgba(0,36,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4ddb4', endColorstr='#002400',GradientType=0 ); /* IE6-9 */


        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        box-shadow: 5px;
        padding: 5px;
        z-index: 10px;
        color:white;
        margin: 3px;
        font-weight: bolder;
        top:140px;
    }
    
         .refsub12{
        width:165px;
        height: 350px;
        background: rgb(180,221,180); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(180,221,180,1) 0%, rgba(131,199,131,1) 10%, rgba(82,177,82,1) 24%, rgba(0,138,0,1) 100%, rgba(0,87,0,1) 100%, rgba(0,36,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(180,221,180,1)), color-stop(10%,rgba(131,199,131,1)), color-stop(24%,rgba(82,177,82,1)), color-stop(100%,rgba(0,138,0,1)), color-stop(100%,rgba(0,87,0,1)), color-stop(100%,rgba(0,36,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4ddb4', endColorstr='#002400',GradientType=0 ); /* IE6-9 */


        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        box-shadow: 5px;
        padding: 5px;
        z-index: 10px;
        color:white;
        margin: 3px;
        font-weight: bolder;
        
    }
      
    .refsub input{
        width:100px;
    }
    .rf{
        display:block;
    }
    #assay_top{
    width:98%;
    height:350px;

    padding: 10px;
}
#middle_assay{
    margin-top: 5px;
    width:98%;
    height:390px;

    padding: 10px;
}
#last_part{
    margin-top: 5px;
    width:98%;
    height:220px;

    padding: 10px;
}
.ref{
    width: 300px;
}

#assay_top,#middle_assay,#last_part{
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
.refsub1.input{
    height: 10px;
}
.mgml1{
    padding: 5px;
}
input.areas{
    width: 150px;
}

    #conversion{
        position: absolute;
        margin-top: 70px;
    }
</style>
<body>
    <p><h3>&#171;<a href='<?php echo base_url() . 'analyst_controller/'; ?>'> Home</a></h3> </p>
    <center><legend>NQCL &#187; Assay Testing  &#187; Sample: <?php echo $labref; ?> </legend></center>

<!--<h4>NB: If you want to use predefined weight, use this <a href='<?php echo base_url() . 'assay/assayMultiplePetition/' . $labref; ?>'> worksheet</a></h4>     -->
<?php $attributes = array('id' => 'assayFormMultiple'); ?>
        <?php echo form_open('assay/save_assay_multiple/' . $labref, $attributes); ?>
<!--input type="button" value="Export to excel" id="Export"/-->
<div class="contentassay">
    <table style="border: 1px #000 solid;">
        <tr>
            <td><select name="labreference" id="labreference" required width="30">
                            <option value="">Select Labref</option> 
                            <?php foreach ($labreference as $refs):?>
                           <option value="<?php echo $refs->labref;?>"><?php echo $refs->labref;?></option> 
                             <?php endforeach;
                             ?>
 }
                           
                        </select></td>
             <td><select name="component" id="component" required width="30">
                            <option value="">Select Component</option>          
                           
                        </select></td>
                        <td>
            <select name="run" id="run" required>
                            <option value="">Run</option>          
                           
                        </select></td>
        </tr>
    </table>
    
        <div id="conversion">
        <table class="convert">
            <tr>
                <td>M.W Salt</td><td><input type="text" name="mwsalt" id="mwsalt" class="mwsalt"></td>
            <tr>
                <td>M.W Base</td><td><input type="text" name="mwbase" id="mwbase" class="mwbase"></td>
            </tr>
            <tr>
                <td>Conv Fact.</td><td><input type="text" name="convfact" id="convfact" class="convfact"></td>
            </tr>
            </tr>
        </table>
    </div>
    <div class="refsub1" style="position:absolute; margin-left: 1050px;">
        <label class="rf">RESPONSE</label><br>
      <table class="tg-table-light">
  <tr>
    <th></th>
  </tr>
   <tr class="tg-even">
    <td> A &dArr;</td>
    <td ></td>

  </tr>
  <tr class="tg-even">
    <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="" id="speaka1" required  class="areas" /></td>

  </tr>
  <tr>
      <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="" id="speaka2" required  class="areas" /></td>

  </tr>
  <tr class="tg-even">
   <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="" id="speaka3" required class="areas"  /></td>
  </tr>
  <tr>
      <td>B &dArr;</td>
    <td ></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="" id="speakb1" required class="areas"  /></td>
  </tr>
  </tr>
  <tr>
    <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="" id="speakab2" required  class="areas" /></td>
  </tr>
  <tr class="tg-even">
    <td class="mgml1"><input type="text" name="speak[]" placeholder="965852" value="" id="speaka3" required  class="areas" /></td>
  </tr>
  
</table>
    </div>
    
    
    <div class="refsub12" style="position:absolute; margin-left: 1000px; top: 500px;">
        <label class="rf">RESPONSE</label><br>
      <table class="tg-table-light">
  <tr>

    <th></th>
  </tr>
   <tr class="tg-even">
          <td> A &dArr;</td>
    <td ></td>

  </tr>
  <tr class="tg-even">
    <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965829" value="" id="smpeak1" required  class="areas" /></td>

  </tr>
  <tr>
      <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak2" required  class="areas" /></td>

  </tr>
  <tr class="tg-even">
      <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak3" required  class="areas" /></td>
  </tr>
  <tr>
         <td> B &dArr;</td>
    <td ></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak4" required  class="areas" /></td>
  </tr>
  </tr>
  <tr>
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak5" required  class="areas" /></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak6" required   class="areas"/></td>
  </tr>
  <tr>
         <td> C &dArr;</td>
  <td ></td>
  </tr>
  <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak7" required class="areas"  /></td>
  </tr>
   <tr >
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak8" required  class="areas" /></td>
  </tr>
   <tr class="tg-even">
  <td class="mgml1"><input type="text" name="smpeak[]" placeholder="965852" value="" id="smpeak9" required  class="areas" /></td>
  </tr>
</table>
    </div>    
    
    
        <div id="assay_top">
<center><h3>Standard </h3></center>
<hr>

<!--    <div class="refsub">
        <label class="rf">Reference Substance</label>
        <label>nqcl code</label><br>
        <label class="rf"></label><span id="code" class="ref"></span><br>
        <input type="hidden" id="codein" name="codein"/>
        <input type="hidden" id="unit" name="unit"/>
        <label class="rf">Available Quantity</label><input type="text" name="aqty" id="aqty" class="ref" readonly/><br>
        <label class="rf">Enter Quantity: </label><input type="text" name="rqty" id="rqty" class="ref"/>
        <label class="rf">Potency: </label><input type="text" name="potency" id="potency" readonly class="ref"/>
       
    </div>-->



    <div id="assay_area"> 
        
        <center>
        <div class="other_details">
        <legend> Assay Data Details</legend>
        <p>Active Ingredient Name</p>
          <select name="heading" id="activeIngredient" >               
         </select><span class='activeIngredient'><a href="<?php echo base_url() . 'assay/worksheet/' . $labref . '/6' ?>">No, I don't want a Repeat!</a></span>
        </div></center>
     
    
           

                <table id="assay" style="margin-left: 50px;">              

                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><form name="form1" method="post" action="">
                            <input type="checkbox" name="dill1" id="dill1">
                            <label for="dill1"></label>
                            Add
                        </form></th>
                    <th colspan="2"><input type="checkbox" name="dill2" id="dill2">
                        <label for="dill2"></label>
                        Add </th>
                    <th colspan="2"><input type="checkbox" name="dill3" id="dill3">
                        <label for="dill3"></label>
                        Add </th>
                    <th>&nbsp;</th>
                </tr>
                <tr id="test">

                    <th><span>&nbsp;</span></th>
                      <th><span>Wt. (mg)</span></th>
                    <th><span>Eq. (mg)</span></th>
                    <th><span>Vf1</span></th>
                    <th><span>P1</span></th>
                    <th><span>Vf2</span></th>
                    <th><span class="vf3head">P2</span></th>
                    <th><span class="vf3head">Vf3</span></th>
                    <th><span class="vf3head4">P3</span></th>
                    <th><span class="vf3head4">Vf4</span></th>
                    <th><span>Conc.</span></th>

                </tr>


                <!--======================================================-->	

                <tr>
                    <td class="workingweight" ><strong>Desired Wt. <br>(mg)</strong></td>
                    <td class="workingweight" ><input type="text" name="workingweight_c" placeholder="e.g 20mg" value="" id="workingnumber_c" required /></td>
                      <td class="workingweight" ><input type="text" name="workingweight" placeholder="e.g 20mg" value="" id="workingnumber" required /></td>

                    <td class ="vf1" >
                        <select name="workingvf1" id="workingvf1" required width="30" class="stdclear1">
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    <td class="dillution1" >
                        <select name="workingpipette1" id="workingp1"  required class="stdclear1">
                            <option value="1"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="dillution1">
                        <select name="workingvf2" id="workingvf2" required class="stdclear1">
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>

                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    <td class="vf3head" >
                        <select name="workingpipette2" id="workingp2"  required class="stdclear1">                            
                            <option value="1"></option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="vf3head">
                        <select name="workingvf3" id="workingvf3" required class="stdclear1">
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>

                    <td class="vf3head4" >
                        <select name="workingp3" id="workingp3"  required class="stdclear1">                            
                            <option value="1"></option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="vf3head4">
                        <select name="workingvf4" id="workingvf4" required class="stdclear1">
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    <td class="mgml11"><input type="text" name="workingmgml" placeholder="e.g 0.04mg/ml" id ="workingmgml" value=""   class="concetrate stdclear"/></td>
                </tr>


                <!----================================================================================================================-->


                <tr>
                    <td colspan="6" class="weight" width="7" >&nbsp;</td>
                </tr>
                <tr>
                    <td class="weight" ><strong> A &rarr;</strong></td>
                    <td class="weight" ><input type="text" name="u_weight_c" placeholder="e.g 20mg" value="" id="number_c" required tabindex="1" /></td>
                    <td class="weight" ><input type="text" name="u_weight" placeholder="e.g 20mg" value="" id="number" required tabindex="1" /></td>

                    <td class ="vf1" >
                        <input type="text" name="vf1" id="vf1" readonly class="stdclear"/>
                    </td>
                    <td class="dillution1" >
                        <input type="text" name="pipette1" id="p1"  readonly class="stdclear"/>

                    </td>
                    <td class="dillution1">
                        <input type="text" name="vf2" id="vf2" readonly class="stdclear">

                    </td>
                    <td class="vf3head" >
                        <input type="text" name="p2" id="p2"  readonly class="stdclear"/>
                    </td>
                    <td class="vf3head">
                        <input type="text" name="vf31" id="vf31" readonly class="stdclear"/>
                    </td>

                    <td class="vf3head4" >
                        <input type="text" name="p321" id="p321"  readonly class="stdclear"/>
                    </td>
                    <td class="vf3head">
                        <input type="text" name="vf32" id="vf32" readonly class="stdclear"/>
                    </td>

                    <td class="mgml"><input type="text" name="mgml" placeholder="e.g 0.04mg/ml" id ="mgml" value="" required readonly  class="concetrate stdclear"/></td>
                </tr>

                <tr>
                    <td class="weight" ><strong> B &rarr;</strong></td>
                  <td class="weight" ><input type="text" name="u_weight1_c" placeholder="e.g 20mg" value="" id ="number1_c" required  tabindex="2"/></td>

                    <td class="weight" ><input type="text" name="u_weight1" placeholder="e.g 20mg" value="" id ="number1" required  tabindex="2"/></td>
                    <td class ="vf111" >
                        <input type="text" required id="vf11" name="vf11" size="15" readonly class="stdclear"/> 
                    </td>
                    <td class="dillution1" >
                        <input type="text" required id="p11" name="ppt" size="15" readonly class="stdclear"/> 
                    </td>
                    <td class="dillution1">
                        <input type="text" required id="vf22" name="vf22" size="15" readonly class="stdclear"/> 
                    </td>
                    <td class="vf3head" >
                        <input type="text" required id="ppt1" name="ppt1" size="15" readonly class="stdclear"/> 
                    </td>
                    <td class="vf3head">
                        <input type="text" required id="vf33" name="vf33" size="15" readonly class="stdclear"/> 

                    <td class="vf3head4" >
                        <input type="text" required id="ppt2" name="ppt2" size="15" readonly class="stdclear"/> 
                    </td>
                    <td class="vf3head4">
                        <input type="text" required id="vf34" name="vf34" size="15" readonly class="stdclear"/> 

                    </td>
                    <td class="mgml1"><input type="text" name="mgml1" placeholder="e.g 0.04mg/ml" value="" id="mgml1" required readonly  class="concetrate stdclear"/></td>
                </tr>



            </table>
    </div>
    </div>

    <div id="middle_assay">
        <div id="sampleassay">

            <p></p>

            <center><h3>Sample</h3></center>


            <center> <div>

                    <table>
                        <tr>

                            <td>Each <strong><span id="unit"></span></strong> contains <label></label><input type="text" name="labelclaim" placeholder="0.04mg/ml" id ="labelclaim" value="" required  /> mg of  <input type="text" value="" id="components_" style="width:130px;"/></td>
                            <td>
							<br>
                                <label for="tabs_caps_average">Avg  Weight: </label>
                                <input type="text" name="" value="Select Average" id="tabs_caps_average" style="position: absolute; margin-left: 0px; width: 103px; font-size: 12px;"/>
                                <select name="tabs_caps_average" id="tabs_caps_average1" style="width:127px;">

                                    <option value="1">Not Available</option>
                                    <?php foreach ($unassay as $assay): ?>                    
                                        <?php echo '<option value=' . $assay->average . '>' . $assay->average . '</option>'; ?>                    
                                    <?php endforeach; ?>
                                </select>
                            </td>

                        </tr>
                    </table>

                </div>
            </center>
            <table id ="sample" style="margin-left: 20px;">		
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><input type="checkbox" name="dillstd1" id="dillstd1">
                        <label for="dillstd1"></label></th>
                    <th colspan="2"><input type="checkbox" name="dillstd2" id="dillstd2">
                        <label for="dillstd2"></label></th>
                    <th colspan="2"><input type="checkbox" name="dillstd3" id="dillstd3">
                        <label for="dillstd3"></label></th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr id="test">
                    <th>                     </th>
                    <th>Powder Wt.<br>(mg)</th>

                    <th><span>Eq. Wt.<br>(mg)</span></th>
                    <th><span>Vf1</span></th>
                    <th><span>P1</span></th>
                    <th><span>Vf2</span></th>
                    <th><span class="vf3head">P2</span></th>
                    <th> <span class="vf3head">vf3</span></th>
                    <th><span class="vf3head">P3</span></th>
                    <th> <span class="vf3head">vf4</span></th>
                    <th><span>Conc.</span></th>
<!--                            <th>LC(mg)</th>		-->
                </tr>




                <tr>
                    <td class="weight" ><strong>Desired Wt.<br>(mg)</br></strong></td>
                    <td class="weight" ><input type="text" name="pwnumber" placeholder="325mg" value="" id="pwnumber" readonly /></td>
                    <td class="weight" ><input type="text" name="aiweight" placeholder="e.g 20mg" value="" id="aiweight"  /></td>
                    <td class ="vf1" >
                        <select name="svf1" id="svf1" required width="30">
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    <td class="dillution1" >
                        <select name="sp1" id="sp1"  required >
                            <option value="1"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="90">90</option>
                            <option value="100">100</option>
                        </select>
                    </td>
                    <td class="dillution1">
                        <select name="svf2" id="svf2" required >
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </td>
                    <td class="vf3head"><select name="pipette2" id="pipette2" required value="1">
                            <option value="1"></option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="90">90</option>
                            <option value="100">100</option>
                        </select></td>
                    <td class="vf3head"><select name="vf3" id="vf3" required value="1">
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select></td>
                    <td class="vf3head4"><select name="pipette3" id="pipette3" required value="1">
                            <option value="1"></option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="90">90</option>
                            <option value="100">100</option>
                        </select></td>
                    <td class="vf3head4"><select name="vf41" id="vf41" required value="1">
                            <option value="1"></option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select></td>
                    <td class="mgml"><input type="text" name="smgml" placeholder="0.04mg/ml" id ="smgml" value="" required  class="concetrate"/></td>
<!--                            <td class="mgml"><input type="text" name="labelclaim" placeholder="0.04mg/ml" id ="labelclaim" value="" required  /></td>-->
                </tr>

                <tr>
                    <td colspan="9" class="weight" >&nbsp;</td>
                <tr>
                    <td class="weight" ><strong> A &rarr;</strong></td>
                    <td class="weight" ><input type="text" name="sampleA" placeholder="e.g 20mg"  id="sampleA" required /></td>
                    <td class="weight" ><input type="text" name="aweightA" placeholder="e.g 20mg"  id ="aweightA" readonly/></td>
                    <td class ="vf111" >
                        <input type="text" required id="svf11" name="svf11" size="15" readonly/> 
                    </td>
                    <td class="dillution1" >
                        <input type="text" required id="sp11" name="sp11" size="15" readonly/> 
                    </td>
                    <td class="dillution1">
                        <input type="text" required readonly id="svf12" name="svf12" size="15"/> 
                    </td>
                    <td class="vf3head"><input type="text" required id="spf1" name="spf1" size="15"  readonly /></td>
                    <td class="vf3head"><input type="text" required id="svf13" name="svf13" size="15"  readonly /></td>

                    <td class="vf3head4"><input type="text" required id="spf21" name="spf21" size="15" readonly /></td>
                    <td class="vf3head4"><input type="text" required id="svf14" name="svf14" size="15"  readonly /></td>
                    <td class="mgml1"><input type="text" name="smgml1" placeholder="e.g 0.04mg/ml" value="" id="smgml1" required readonly  class="concetrate"/></td>
                    <td rowspan="3" class="mgml1">&nbsp;</td>

                


                <tr>
                    <td class="weight" ><strong> B &rarr;</strong></td>
                    <td class="weight" ><input type="text" name="sampleB" placeholder="e.g 20mg" value="" id="sampleB" required /></td> 
                    <td class="weight" ><input type="text" name="aweightB" placeholder="e.g 20mg" value="" id ="aweightB" readonly /></td>

                    <td class ="vf111" >

                        <input type="text" required id="svf111" name="vf111" size="15" readonly/> 
                    </td>
                    <td class="dillution1" >
                        <input type="text" required id="sp112" name="sp112" size="15" readonly/> 
                    </td>
                    <td class="dillution1">
                        <input type="text" readonly required id="svf22" name="svf22" size="15"/> 
                    </td>
                    <td class="vf3head"><input type="text" required id="spf2" name="spf2" size="15"  readonly /></td>
                    <td class="vf3head"><input type="text" required id="svf23" name="svf23" size="15"  readonly /></td>

                    <td class="vf3head4"><input type="text" required id="spf33" name="spf33" size="15"  readonly /></td>
                    <td class="vf3head4"><input type="text" required id="svf241" name="svf241" size="15"  readonly /></td>

                    <td class="mgml1"><input type="text" name="smgml2" placeholder="e.g 0.04mg/ml" value="" id="smgml2" readonly  class="concetrate"/></td>
                </tr>


                <tr>
                    <td class="weight" ><strong> C &rarr;</strong></td>
                    <td class="weight" ><input type="text" name="sampleC" placeholder="e.g 20mg" value="" id="sampleC" required /></td> 
                    <td class="weight" ><input type="text" name="aweightC" placeholder="e.g 20mg" value="" id ="aweightC" readonly/></td>
                    <td class ="vf3" >

                        <input type="text" required id="svf3" name="svf3" size="15" readonly/> 
                    </td>
                    <td class="dillution1" >
                        <input type="text" required id="ssp3" name="ssp3" size="15" readonly/> 
                    </td>
                    <td class="dillution1">
                        <input type="text" readonly required id="svf33" name="svf33" size="15"/> 
                    </td>
                    <td class="vf3head"><input type="text" required id="spf3" name="spf3" size="15" readonly /></td>
                    <td class="vf3head"><input type="text" required id="svf24" readonly name="svf24" size="15" /></td>

                    <td class="vf3head4"><input type="text" required id="spf4" name="spf4" size="15" readonly /></td>
                    <td class="vf3head4"><input type="text" required id="svf25" name="svf25" size="15" readonly /></td>

                    <td class="mgml3"><input type="text" name="smgml3" placeholder="e.g 0.04mg/ml" value="" id="smgml3" required readonly  class="concetrate"/></td>
                </tr>



            </table>
        </div>
    </div>
    <!--                 <div id="last_part">
                        <p><center><h2>Preparation Procedure</h1></h2></center>
                        <hr />
                        <div><center><textarea name="procedure" cols="100" rows="5" placeholder="please describe the procedure you have used"></textarea></center></div>
                        </p>-->
</div>
<center>
    <p class="submit">
        <input type="button" id="Export" value="Save Data & Add Active Ingredient" class=""/>
<!--        &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="Export_r" value="Save & Repeat" class=""/><br />-->
        <input type="button" type="submit" value="Clear Workspace But Keep Weights" id="addassaykv">
        <input type="button" type="submit" value="Clear Workspace " id="addassay">                    
        <input type="button" id="finish" value="Finish"/>
    </p>
</center>
<div id="dialog" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
    <p><form name="" id="reason">
        <h4>State the reason for repeating this test below</h4>
        <p>
            <input type="hidden" name="heading"/>
            <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
            <br/>
            <input type="button" value="submit" id="sendit" /><input type="button" value="Close Dialog" id="closeit"/><input type="button" value="cancel" id="cancelit"/>
    </form></p>
</div>

</form>
<script type="text/javascript" src="<?php echo base_url(); ?>javascripts/assay_pi.js"></script>


</body>

<script>
$(document).ready(function() {
    $('#tabs_caps_average1').change('live', function() {
        selection = $('#tabs_caps_average1 option:selected').val();
        // alert(selection);
        $('#tabs_caps_average').val(selection);
    });

    // $("div#sampleassay").hide();
    //standard preparation
    /*$("#workingp1").attr("disabled", "disabled");
     $("#workingvf2").attr("disabled", "disabled");
     $("#workingp2").attr("disabled", "disabled");
     $("#workingvf3").attr("disabled", "disabled");
     $("#workingp3").attr("disabled", "disabled");
     $("#workingvf4").attr("disabled", "disabled");

     //Sample assay preparation
     $("#sp1").attr("disabled", "disabled");
     $("#svf2").attr("disabled", "disabled");
     $("#pipette2").attr("disabled", "disabled");
     $("#vf3").attr("disabled", "disabled");
     $("#pipette3").attr("disabled", "disabled");
     $("#vf41").attr("disabled", "disabled");*/

    //********************************************************
    //standard preparation
    //*******************************************************

    //$(".dillution1").css("display","none");
    $("#dill1").click(function() {
        if ($("#dill1").is(":checked", true)) {
            // $(".dillution1").show();
            $("#workingp1").attr("disabled", false);
            $("#workingvf2").attr("disabled", false);



        } else {
            // $(".dillution1").hide();
            $("#workingp1").attr("disabled", "disabled");
            $("#workingvf2").attr("disabled", "disabled");
            // $('#workingp1').val($('#workingp1').find("option").first().val());                            

        }
    });
    $("#dill2").click(function() {
        if ($("#dill2").is(":checked", true)) {
            // $(".dillution1").show();
            $("#workingp2").attr("disabled", false);
            $("#workingvf3").attr("disabled", false);



        } else {
            // $(".dillution1").hide();
            $("#workingp2").attr("disabled", "disabled");
            $("#workingvf3").attr("disabled", "disabled");
            // $('#workingp1').val($('#workingp1').find("option").first().val());                            

        }
    });
    $("#dill3").click(function() {
        if ($("#dill3").is(":checked", true)) {
            // $(".dillution1").show();
            $("#workingp3").attr("disabled", false);
            $("#workingvf4").attr("disabled", false);



        } else {
            // $(".dillution1").hide();
            $("#workingp3").attr("disabled", "disabled");
            $("#workingvf4").attr("disabled", "disabled");
            // $('#workingp1').val($('#workingp1').find("option").first().val());                            

        }

    });


    //********************************************************
    //sample preparation preparation
    //*******************************************************

    //$(".dillution1").css("display","none");
    $("#dillstd1").click(function() {
        if ($("#dillstd1").is(":checked", true)) {
            // $(".dillution1").show();
            $("#sp1").attr("disabled", false);
            $("#svf2").attr("disabled", false);



        } else {
            // $(".dillution1").hide();
            $("#sp1").attr("disabled", "disabled");
            $("#svf2").attr("disabled", "disabled");
            // $('#workingp1').val($('#workingp1').find("option").first().val());                            

        }
    });
    $("#dillstd2").click(function() {
        if ($("#dillstd2").is(":checked", true)) {
            // $(".dillution1").show();
            $("#pipette2").attr("disabled", false);
            $("#vf3").attr("disabled", false);



        } else {
            // $(".dillution1").hide();
            $("#pipette2").attr("disabled", "disabled");
            $("#vf3").attr("disabled", "disabled");
            // $('#workingp1').val($('#workingp1').find("option").first().val());                            

        }
    });
    $("#dillstd3").click(function() {
        if ($("#dillstd3").is(":checked", true)) {
            // $(".dillution1").show();
            $("#pipette3").attr("disabled", false);
            $("#vf41").attr("disabled", false);



        } else {
            // $(".dillution1").hide();
            $("#pipette3").attr("disabled", "disabled");
            $("#vf41").attr("disabled", "disabled");
            // $('#workingp1').val($('#workingp1').find("option").first().val());                            

        }

    });

    $('#activeIngredient').change(function() {
        var select = $(this).val();
        $('#Export').prop('value', 'Save ' + select);
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>assay/loadComponents_lc/<?php echo $labref; ?>/" + select,
            dataType: "json",
            success: function(data) {
                $('#labelclaim').val(data[0].volume2);
                $('#components_').val(data[0].name);
                $('#unit').text(data[0].unit1);
                calculate();
            },
            error: function() {

            }
        });
    });
    $('#labreference').change(function() {
        var select = $(this).val();
        component_holder = $('#component');

        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>assay/loadAssayComponents/" + select,
            dataType: "json",
            success: function(data) {
                component_holder.empty();
                component_holder.append('<option value="">Select Component</option>');
                $.each(data, function(i, component) {
                    component_holder.append('<option value="' + component.component + '">' + component.component + '</option>');
                });
            },
            error: function() {

            }
        });
    });

    $('#component').change(function() {
        var labref = $('#labreference').val();
        var component = $(this).val();
        run_holder = $('#run');

        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>assay/loadAssayComponentRuns/" + labref + '/' + component,
            dataType: "json",
            success: function(data) {
                run_holder.empty();
                run_holder.append('<option value="">Select run</option>');
                $.each(data, function(i, run) {
                    run_holder.append('<option value="' + run.repeat_status + '">' + run.repeat_status + '</option>');
                });
            },
            error: function() {

            }
        });
    });


    $('#component,#labreference,#run').change(function() {
        var labref = $('#labreference').val();
        var component = $('#component').val();
        var run = $('#run').val();

        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>assay/loadAssayComponentData/" + labref + '/' + component + '/' + run,
            dataType: "json",
            success: function(data) {
                $('#workingnumber').val(data[0].desired_weight);
                $('#workingvf1').val(data[0].vf1);
                $('#workingp1').val(data[0].pippette1);
                $('#workingvf2').val(data[0].vf2);
                $('#workingp2').val(data[0].pipette2);
                $('#workingvf3').val(data[0].vf3);
                $('#workingp3').val(data[0].pipette3);
                $('#workingvf4').val(data[0].vf4);
                $('#workingmgml').val(data[0].concetration);
                $('#smgml').val(data[0].concetration);

                $.getJSON("<?php echo base_url(); ?>assay/loadAssayComponentStdAB/" + labref + '/' + component + '/' + run, function(data) {
                    $('#number').val(data[0].weight);
                    $('#vf1').val(data[0].vf1);
                    $('#p1').val(data[0].pippette1);
                    $('#vf2').val(data[0].vf2);
                    $('#p2').val(data[0].pipette2);
                    $('#vf31').val(data[0].vf3);
                    $('#p321').val(data[0].pipette3);
                    $('#vf32').val(data[0].vf4);
                    $('#mgml').val(data[0].concetration);


                    $('#number1').val(data[1].weight);
                    $('#vf11').val(data[1].vf1);
                    $('#p11').val(data[1].pippette1);
                    $('#vf22').val(data[1].vf2);
                    $('#ppt1').val(data[1].pipette2);
                    $('#vf33').val(data[1].vf3);
                    $('#ppt2').val(data[1].pipette3);
                    $('#vf34').val(data[1].vf4);
                    $('#mgml1').val(data[1].concetration);


                });
            },
            error: function() {

            }
        });
    });
});


function calculate() {


    //getting the values for powder weight calculations
    var pwnumber1 = 0;
    var pwnumber2 = 0;
    var pwnumber3 = 0;
    var pwnumber4 = 0;
    var answer1 = 0;
    var answer2 = 0;
    var answer3 = 0;
    var active_i;
    var sample_ave = parseFloat($('#tabs_caps_average').val());
//        
//        if( !$('#tabs_caps_average').val() ) {
//            alert('Please select Tablet/Capsule average from the select box! and the label claim');
//        }

    var smgml = parseFloat($('#smgml').val());
    //var concsmgml=$('#smgml').val(smgml);
    // var mgml=parseFloat($('#workingmgml').val());               


    var a = parseFloat($('#svf1').val());
    var b = parseFloat($('#sp1').val());
    var c = parseFloat($('#svf2').val());
    var d = parseFloat($('#pipette2').val())
    var e = parseFloat($('#vf3').val());
    var f = parseFloat($('#pipette3').val());
    var g = parseFloat($('#vf41').val());


    active_i = (smgml * (e / d)) * (c / b) * (g / f) * a;


    $('#aiweight').val(active_i.toFixed(2));





    //var pwnumber=$('#pwnumber').val();
    var aiweight = parseFloat($('#aiweight').val());
    var labelclaim = parseFloat($('#labelclaim').val());

    var sampleA = parseFloat($('#sampleA').val());
    var sampleB = parseFloat($('#sampleB').val());
    var sampleC = parseFloat($('#sampleC').val());


    pwnumber1 = (aiweight * sample_ave) / labelclaim;


    $('#pwnumber').val(pwnumber1);

    pwnumber2 = (sampleA * labelclaim) / sample_ave;
    pwnumber3 = (sampleB * labelclaim) / sample_ave;
    pwnumber4 = (sampleC * labelclaim) / sample_ave;


    $('#aweightA').val(pwnumber2.toFixed(2));
    $('#aweightB').val(pwnumber3.toFixed(2));
    $('#aweightC').val(pwnumber4.toFixed(2));



    //vf1

    a = parseFloat($('#svf1').val());
    $('#svf11').val(a);
    $('#svf111').val(a);
    $('#svf3').val(a);

    //pipette1
    b = parseFloat($('#sp1').val());
    $('#sp11').val(b);
    $('#sp112').val(b);
    $('#ssp3').val(b);

    //vf2
    c = parseFloat($('#svf2').val());
    $('#svf12').val(c);
    $('#svf22').val(c);
    $('#svf33').val(c);


    //pipette2
    d = parseFloat($('#pipette2').val());
    $('#spf1').val(d);
    $('#spf2').val(d);
    $('#spf3').val(d);


    //vf3
    e = parseFloat($('#vf3').val());
    $('#svf13').val(e);
    $('#svf23').val(e);
    $('#svf24').val(e);

    //pipette3

    $('#spf21').val(f);
    $('#spf33').val(f);
    $('#spf4').val(f);

    // vf4
    $('#svf14').val(g);
    $('#svf241').val(g);
    $('#svf25').val(g);

    //get weights
    var weighta = parseFloat($('#aweightA').val());
    var weightb = parseFloat($('#aweightB').val());
    var weightc = parseFloat($('#aweightC').val());


    answer1 = ((weighta / a) * (b / c) * (d / e) * (f / g));
    answer2 = ((weightb / a) * (b / c) * (d / e) * (f / g));
    answer3 = ((weightc / a) * (b / c) * (d / e) * (f / g));



    $('#smgml1').val(answer1.toFixed(6));
    $('#smgml2').val(answer2.toFixed(6));
    $('#smgml3').val(answer3.toFixed(6));

}

</script>

</html>