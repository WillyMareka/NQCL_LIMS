<?php
error_reporting(1);
if (isset($_REQUEST['csvdata'])) {
////download to excel
    header('Content-Type: application/force-download');
    header('Content-disposition: attachment; filename=csv_excel.xls');
    header("Pragma: ");
    header("Cache-Control: ");
    echo $_REQUEST['csvdata'];
    exit();
}
?>
<script>
    /*
var th = ['','thousand','million', 'billion','trillion'];
var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine'];
var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];
var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];
function toWords(s){s = s.toString();s = s.replace(/[\, ]/g,'');if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');if (x == -1) x = s.length;if (x > 15) return 'too big';var n = s.split('');
    var str = '';var sk = 0;for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' ';i++;sk=1;} 
            else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' ';
            if ((x-i)%3==0) str += 'hundred ';sk=1;}if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';
            sk=0;}}if (x != s.length) {var y = s.length;str += 'point ';for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';}
    return str.replace(/\s+/g,' ');}      

   
    $('.num').live('keyup',function () {
        var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.num[value!=""]').length;
        $('.num').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(4);
            answer=sum1/boxes;
            answer1=answer.toFixed(4);
        });
        
        $('input#totals').val(sum1);
        $('input#av1').val(answer1);
     
    });



var tma1;
       
var tma2;
        
var tma3;
       
var tma4;
       
var tma5;
        
var tma6;
       
var tma7;
        
var tma8;
        
var tma9;
        
var tma10;
        
var tma11;
        
var tma12;
       
var tma13;
       
var tma14;
       
var tma15;
      
var tma16;
       
var tma17;
       
var tma18;
        
var tma19;
        
var tma20;
   function hide(){
            approved="<?php echo $done;?>";
            if(approved > 1){
                $('.Inline,#Inline').hide();
            }else{
                $('.Inline,#Inline').show();  
            }
            }     

$(document).ready(function(){ 
    hide();
             $('input[type=text],input[type=number],textarea').attr("readonly", "readonly");

        var a=$('#tcsv1').val();
        var b=$('#tcsv2').val();
        var c=$('#tcsv3').val();
        var d=$('#tcsv4').val();
        var e=$('#tcsv5').val();
        var f=$('#tcsv6').val();
        var g=$('#tcsv7').val();
        var h=$('#tcsv8').val();
        var i=$('#tcsv9').val();
        var j=$('#tcsv10').val();
        var k=$('#tcsv11').val();
        var l=$('#tcsv12').val();
        var m=$('#tcsv13').val();
        var n=$('#tcsv14').val();
        var o=$('#tcsv15').val();
        var p=$('#tcsv16').val();
        var q=$('#tcsv17').val();
        var r=$('#tcsv18').val();
        var s=$('#tcsv19').val();
        var t=$('#tcsv20').val();
        
        if( a == "" || b == "" || c== "" || d== "" || e== "" || f== "" || g== "" || h== "" || i== "" || j== "" || k== "" || l== "" || m== "" || n== "" || o== "" || p== "" || q== "" || r== "" || s== "" || t== ""  ){
            
            alert("Please fill in the required fields first before calculating the deviations!");
        }
        else{
    
            var span_text=parseFloat($('input#av1').val());
          
            a=parseFloat($('#tcsv1').val());
            b=parseFloat($('#tcsv2').val());
            c=parseFloat($('#tcsv3').val());
            d=parseFloat($('#tcsv4').val());
            e=parseFloat($('#tcsv5').val());
            f=parseFloat($('#tcsv6').val());
            g=parseFloat($('#tcsv7').val());
            h=parseFloat($('#tcsv8').val());
            i=parseFloat($('#tcsv9').val());
            j=parseFloat($('#tcsv10').val());
            k=parseFloat($('#tcsv11').val());
            l=parseFloat($('#tcsv12').val());
            m=parseFloat($('#tcsv13').val());
            n=parseFloat($('#tcsv14').val());
            o=parseFloat($('#tcsv15').val());
            p=parseFloat($('#tcsv16').val());
            q=parseFloat($('#tcsv17').val());
            r=parseFloat($('#tcsv18').val());
            s=parseFloat($('#tcsv19').val());
            t=parseFloat($('#tcsv20').val());
         
            tma1 =((a-span_text)/span_text)*100;
            $('input#dfm1').val( tma1.toFixed(2));
            tma2 =((b-span_text)/span_text)*100;
            $('input#dfm2').val( tma2.toFixed(2));
            tma3 =((c-span_text)/span_text)*100;
            $('input#dfm3').val( tma3.toFixed(2));
            tma4 =((d-span_text)/span_text)*100;
            $('input#dfm4').val( tma4.toFixed(2));
            tma5 =((e-span_text)/span_text)*100;
            $('input#dfm5').val( tma5.toFixed(2));
            tma6 =((f-span_text)/span_text)*100;
            $('input#dfm6').val( tma6.toFixed(2));
            tma7 =((g-span_text)/span_text)*100;
            $('input#dfm7').val( tma7.toFixed(2));
            tma8 =((h-span_text)/span_text)*100;
            $('input#dfm8').val( tma8.toFixed(2));
            tma9 =((i-span_text)/span_text)*100;
            $('input#dfm9').val( tma9.toFixed(2));
            tma10 =((j-span_text)/span_text)*100;
            $('input#dfm10').val( tma10.toFixed(2));
            tma11 =((k-span_text)/span_text)*100;
            $('input#dfm11').val( tma11.toFixed(2));
            tma12 =((l-span_text)/span_text)*100;
            $('input#dfm12').val( tma12.toFixed(2));
            tma13 =((m-span_text)/span_text)*100;
            $('input#dfm13').val( tma13.toFixed(2));
            tma14 =((n-span_text)/span_text)*100;
            $('input#dfm14').val( tma14.toFixed(2));
            tma15 =((o-span_text)/span_text)*100;
            $('input#dfm15').val( tma15.toFixed(2));
            tma16 =((p-span_text)/span_text)*100;
            $('input#dfm16').val( tma16.toFixed(2));
            tma17 =((q-span_text)/span_text)*100;
            $('input#dfm17').val( tma17.toFixed(2));
            tma18 =((r-span_text)/span_text)*100;
            $('input#dfm18').val( tma18.toFixed(2));
            tma19 =((s-span_text)/span_text)*100;
            $('input#dfm19').val( tma19.toFixed(2));
            tma20 =((t-span_text)/span_text)*100;
            $('input#dfm20').val( tma20.toFixed(2));
            var red = 0;
            var green=0;
            var space=", ";
            var holder,holderr,holder1,holderR,holder2;
            var oncer, once1;
            var passed="#complies";
        var failed="#dcomply";
        var DNC='Sample Does Not Comply';
        var C='Sample Complies';
            for(var kj = 1;kj<21;kj++){
            
                var div = "#span"+kj+"1";
                var div2 = "#span"+kj+"2";
                var div3="#span"+kj+"3";
                if(window["tma"+kj]<0){
                    var val=window['tma'+kj]*-1;
                }else{
                    val=window["tma"+kj];
                }
                
                if(span_text<=80){
    
                    if(val>=10.5 && val<=20.5){
                        $(div2).show();
                
                    }
                    else if(val<=10.5 && val>=0.5){
                        $(div3).show();
                        green++;                 
                        holder= window['tma'+kj].toFixed(2)+'%'+space;                        
                        once1+=holder.toString();                         
                        holder1=once1.replace("undefined","");
                        holder1 = holder1.substring(0,holder1.length - 2);
                    }
                    else{
                        $(div).show(); 
                        red++
                        holderr= window['tma'+kj].toFixed(2)+'%'+space;                       
                        oncer+=holderr.toString();                             
                        holderR=oncer.replace("undefined","");
                         holderR = holderR.substring(0,holderR.length - 2);
                        
                    }
                }else if(span_text>80 && span_text<250){
                    
                 
                    if(val>=7.5 && val<=15){
                        $(div3).show();
                        green++;                 
                        holder= window['tma'+kj].toFixed(2)+'%'+space;               
                        once1+=holder.toString();                         
                        holder1=once1.replace("undefined","");
                        holder1 = holder1.substring(0,holder1.length - 2);
                
                    }
                    else if(val<=7.5 && val>=0){
                        $(div2).show();                        
                    }
                    else{
                        $(div).show(); 
                        red++
                        holderr= window['tma'+kj].toFixed(2)+'%'+space;                 
                        oncer+=holderr.toString();                             
                        holderR=oncer.replace("undefined","");
                         holderR = holderR.substring(0,holderR.length - 2);
                    }
                }else{
                    if(span_text>=250){
             
                        if(val>=5.5 && val<=10.5){
                            $(div3).show();
                            green++;                 
                            holder= window['tma'+kj].toFixed(2)+'%'+space;                        
                            once1+=holder.toString();                         
                            holder1=once1.replace("undefined","");
                            holder1 = holder1.substring(0,holder1.length - 2);
                           
                        }
                        else if(val<=5.5 && val>=0){
                            $(div2).show();
                            
                        }
                        else{
                            $(div).show(); 
                            red++
                            holderr= window['tma'+kj].toFixed(2)+'%'+space;                        
                            oncer+=holderr.toString();                             
                            holderR=oncer.replace("undefined","");
                            holderR = holderR.substring(0,holderR.length - 2);
                        }
                    
                    }
                }
            }  
        }
       
       if(green!=0 && red!=0){
             $(failed).show(); 
           var n1= parseInt(green)+parseInt(red);
           var total= toWords(n1);
                //var redwords =toWords(red);
                $('#com').val( total+ "deviate ("+holder1+ ", "  +holderR+")"); 
            }
            if(green!=0 && red==0){              
                var  greenwords= toWords(green);                 
                $('#com').val(greenwords+ "deviate ("+holder1+")"); 
                  if(green>1){                       
                      $('#tabStatus').val(DNC);
                    $(failed).show(); 
                }else{
                    $('#tabStatus').val(C);
                    $(passed).show(); 
                }
            }
            if(red!=0 && green==0){
                 var  redwords= toWords(red); 
                $(failed).show(); 
                $('#tabStatus').val(DNC);
                $('#com').val(redwords+ "deviate ("+holderR+")");  
            }
             
            if(green==0 &&red==0){
                $(passed).show();
                $('#tabStatus').val(C);
                $('#com').val("None Deviates");  
            }
          
/* if(green==0 && red>0 ||green>=2 && red==0||green<2 && red>0){
                $(failed).show(); 
            } else{
              $(passed).show();   
            }    
    
        
});

 */ 


$(document).ready(function(){
    $('#FormSubmit').click(function(){       
        
        var a=$('#dfm1').val();
        var b=$('#dfm2').val();
        var c=$('#dfm3').val();
        var d=$('#dfm4').val();
        var e=$('#dfm5').val();
        var f=$('#dfm6').val();
        var g=$('#dfm7').val();
        var h=$('#dfm8').val();
        var i=$('#dfm9').val();
        var j=$('#dfm10').val();
        var k=$('#dfm11').val();
        var l=$('#dfm12').val();
        var m=$('#dfm13').val();
        var n=$('#dfm14').val();
        var o=$('#dfm15').val();
        var p=$('#dfm16').val();
        var q=$('#dfm17').val();
        var r=$('#dfm18').val();
        var s=$('#dfm19').val();
        var t=$('#dfm20').val();
        
        if( a == "" || b == "" || c== "" || d== "" || e== "" || f== "" || g== "" || h== "" || i== "" || j== "" || k== "" || l== "" || m== "" || n== "" || o== "" || p== "" || q== "" || r== "" || s== "" || t== ""  ){
            
            alert("Please click the deviation label to fill in the percentages first!");
            return false;
        }else{
            return true;
        }
        
    });


});
$().ready(function(){
      $('#Refresh').hide();
$('#Refresh').click(function(){    
    location.reload();
    $('#calculate').show();
});
});

  $(document).ready(function() {
                $('.reject').hide();
                
                $("#Inline").fancybox({
           

                });
            });

        
        



</script>
<div id="main_wrapper"> 
    <head>
        <style type="text/css">
            table{
                border:  1px solid black;
                padding: 0px;
            }
            td{
                border: #000000 1px solid;
                margin: 0 auto 0 auto;

            }
            input[type=text]{
                text-align: center;
            }
            span#complies{
                font-family: sans-serif;
                color: white;
                background-color: blue;
                font-weight: bold;

            }
            span#dcomply{
                font-family: sans-serif;
                color: white;
                background-color: red;
                font-weight: bold;
            }
            span.span11{
                background-color: #F93;
                color: #F93;                
                width: 10px;
            }
            span.span12{
                background-color: #33ff33;
                color:#33ff33;
                width: 10px;
            }
            span.span13{
                background-color: #0FF;
                color:#0FF;
                width: 10px;
            }
            div#comments{
                text-align: left;
                background-color: white;
                //border: 1px solid #000000;    
                width :41%;
                margin: 0 auto 0 auto;

            }
            .num,.num3{
                width: 60px;
                margin: 0px;
            }
            .num4{
                width: 83px;
            }
        </style>
        <script>


            /*$(document).ready(function(){
             $('#FormSubmit').click(function(){        
             dataString2=$('#tabsForm').serialize();        
             $.ajax({
             type: "POST",
             url: "<?php echo base_url(); ?>/tabs/save_tablet_weights/",
             data: dataString2,
             success: function() {
             alert("Data Saved");
             },
             error: function(){
             alert('An internal problem has been experienced!');
             }
     
             })
             }); */


            $('#Export').click(function() {
                dataString2 = $('#tabsForm').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>/tabs/exportabs_to_excel/",
                    data: dataString2,
                    success: function() {
                        alert("Successfully Exported to Excel Worksheet");
                    },
                    error: function() {
                        alert('An internal problem has been experienced, data could not be exported!');
                    }

                })
            });


            // });


        </script>



        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/jquery.validate.css?1500" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/style1.css?1500" />

        </script>

        <script src="<?php echo base_url(); ?>javascripts/jquery.validate.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>javascripts/jquery.validation.functions.js?1500" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>javascripts/tabs.js?1500" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/toword.js"></script>



    </head>
      < <<legend><a href="<?php echo site_url() ."supervisors/home/".$labref.'/'; ?>">... BACK</a></legend>
    <h1>Tablets: Uniformity Of Weight Results</h1>
    <p>
    <p>
    <center><legend><h2>Sample: <?php echo $labref; ?> </h2></legend></center>
</p>
</p>
<p>Run No.</p>
<?php
foreach ($no_of_pages as $page_repeats):
    echo anchor('uniformity/tabs_r/' . $labref . '/' . $page_repeats . '/' . $r, '<strong>' . $page_repeats . "    " . '</strong>');
endforeach;
?>
    </p>
<div id="Individual_box">

    <?php echo form_open('tabs/approve/'.$labref.'/'.$r); ?> 
    <table id="TabsTabeUniformity" width="230" border="0" align="center" cellpadding="0" cellspacing="0" value="" class="dave-table">

        
        

        <tr>
            <td width="60" height="53"><div align="center">No.</div></td>
            <td width="80" align="center" valign="middle"><p align="center">Tablets (mg)</p></td>
<!--            <td width="90" <label  value="" class="submit-button">%deviation</label></td>-->
        <span></span>

        </tr>
        <tr>
            <td><div align="center">1</div></td>
            <td><input type="text" id="tcsv1" name="tcsv1" size="25" value="<?php echo $tabs_results[0]->tcsv; ?>" class="num"  /></td>               
<!--            <td><input type="text" id="dfm1"name=" dfm1" size="25" value="<?php echo $tabs_results[0]->percent_deviation; ?>" class="num3"  readonly="readonly"/></td>
            <td><span id="span11" style="display:none" value="" class="span11">A</span><span id="span12" style="display:none"  value="" class="span12">N</span>
                <span id="span13" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">2</div></td>
            <td><input type="text" id="tcsv2" name="tcsv2" value="<?php echo $tabs_results[1]->tcsv; ?>" class="num" size="25"  /></td>
<!--            <td><input type="text" id="dfm2" name=" dfm2" size="25" value="<?php echo $tabs_results[1]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span21" size="25" style="display:none" value="" class="span11">A</span><span id="span22" style="display:none" size="25"  value="" class="span12">N</span><span id="span23" style="display:none"  value="" class="span13">O</span></td>-->

        </tr>
        <tr>
            <td><div align="center">3</div></td>
            <td><input type="text" id="tcsv3" name="tcsv3"  value="<?php echo $tabs_results[2]->tcsv; ?>" class="num" size="25"  /></td>
<!--            <td><input type="text" id="dfm3" name=" dfm3" size="25" value="<?php echo $tabs_results[2]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span31" size="25" style="display:none" value="" class="span11">A</span><span id="span32" style="display:none" size="25"  value="" class="span12">N</span><span id="span33" style="display:none"  value="" class="span13">O</span></td>-->

        </tr>
        <tr>
            <td><div align="center">4</div></td>
            <td><input type="text" id="tcsv4" name="tcsv4" value="<?php echo $tabs_results[3]->tcsv; ?>" class="num" size="25"  /></td>
<!--            <td><input type="text" id="dfm4" name=" dfm4" size="25" value="<?php echo $tabs_results[3]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span41" size="25" style="display:none" value="" class="span11">A</span><span id="span42" style="display:none" size=" 25" value="" class="span12">N</span>
                <span id="span43" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">5</div></td>
            <td><input type="text" id="tcsv5" name="tcsv5" size="25" value="<?php echo $tabs_results[4]->tcsv; ?>" class="num"  /></td>
<!--
            <td><input type="text" id="dfm5" name=" dfm5" size="25" value="<?php echo $tabs_results[4]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span51" size="" style="display:none" value="" class="span11">A</span><span id="span52" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span53" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">6</div></td>
            <td><input type="text" id="tcsv6" name="tcsv6" size="25" value="<?php echo $tabs_results[5]->tcsv; ?>" class="num"  /></td>                
<!--            <td><input type="text" id="dfm6" name=" dfm6" size="25" value="<?php echo $tabs_results[5]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span61" size="" style="display:none" value="" class="span11">A</span><span id="span62" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span63" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">7</div></td>
            <td><input type="text" id="tcsv7" name="tcsv7" size="25" value="<?php echo $tabs_results[6]->tcsv; ?>" class="num"  /></td>

<!--            <td><input type="text" id="dfm7" name=" dfm7" size="25" value="<?php echo $tabs_results[6]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span71" size="" style="display:none" value="" class="span11">A</span><span id="span72" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span73" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">8</div></td>
            <td><input type="text" id="tcsv8" name="tcsv8" size="25" value="<?php echo $tabs_results[7]->tcsv; ?>" class="num"   /></td>

<!--            <td><input type="text" id="dfm8" name=" dfm8" size="25" value="<?php echo $tabs_results[7]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span81" size="" style="display:none" value="" class="span11">A</span><span id="span82" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span83" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">9</div></td>
            <td><input type="text" id="tcsv9" name="tcsv9" size="25" value="<?php echo $tabs_results[8]->tcsv; ?>" class="num"   /></td>

<!--            <td><input type="text" id="dfm9" name=" dfm9" size="25" value="<?php echo $tabs_results[8]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span91" size="" style="display:none" value="" class="span11">A</span><span id="span92" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span93" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">10</div></td>
            <td><input type="text" id="tcsv10"  name="tcsv10" value="<?php echo $tabs_results[9]->tcsv; ?>" class="num" size="25"  /></td>

<!--            <td><input type="text" id="dfm10" name=" dfm10" size="25" value="<?php echo $tabs_results[9]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span101" size="" style="display:none" value="" class="span11">A</span><span id="span102" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span103" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">11</div></td>
            <td><input type="text" id="tcsv11" name="tcsv11" value="<?php echo $tabs_results[10]->tcsv; ?>" class="num" size="25"  /></td>
<!--
            <td><input type="text" id="dfm11" name=" dfm11" size="25" value="<?php echo $tabs_results[10]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span111" size="" style="display:none" value="" class="span11">A</span><span id="span112" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span113" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">12</div></td>
            <td><input type="text" id="tcsv12" name="tcsv12" value="<?php echo $tabs_results[11]->tcsv; ?>" class="num" size="25"  /></td>

<!--            <td><input type="text" id="dfm12" name=" dfm12" size="25" value="<?php echo $tabs_results[11]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span121" size="" style="display:none" value="" class="span11">A</span><span id="span122" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span123" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">13</div></td>
            <td><input type="text" id="tcsv13"  name="tcsv13" size="25" value="<?php echo $tabs_results[12]->tcsv; ?>" class="num"  /></td>

<!--            <td><input type="text" id="dfm13" name=" dfm13" size="25" value="<?php echo $tabs_results[12]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span131" size="" style="display:none" value="" class="span11">A</span><span id="span132" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span133" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">14</div></td>
            <td><input type="text" id="tcsv14" name="tcsv14" size="25"  value="<?php echo $tabs_results[13]->tcsv; ?>" class="num" /></td>

<!--            <td><input type="text" id="dfm14" name=" dfm14" size="25" value="<?php echo $tabs_results[13]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span141" size="" style="display:none" value="" class="span11">A</span><span id="span142" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span143" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">15</div></td>
            <td><input type="text" id="tcsv15" name="tcsv15" size="25"  value="<?php echo $tabs_results[14]->tcsv; ?>" class="num" /></td>

<!--            <td><input type="text" id="dfm15" name=" dfm15" size="25" value="<?php echo $tabs_results[14]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span151" size="" style="display:none" value="" class="span11">A</span><span id="span152" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span153" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">16</div></td>
            <td><input type="text" id="tcsv16" name="tcsv16" size="25"  value="<?php echo $tabs_results[15]->tcsv; ?>" class="num" /></td>

<!--            <td><input type="text" id="dfm16" name=" dfm16" size="25" value="<?php echo $tabs_results[15]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span161" size="" style="display:none" value="" class="span11">A</span><span id="span162" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span163" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">17</div></td>
            <td><input type="text" id="tcsv17"name="tcsv17" size="25"  value="<?php echo $tabs_results[16]->tcsv; ?>" class="num" /></td>
<!--
            <td><input type="text" id="dfm17" name=" dfm17" size="25" value="<?php echo $tabs_results[16]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span171" size="" style="display:none" value="" class="span11">A</span><span id="span172" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span173" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">18</div></td>
            <td><input type="text" id="tcsv18" name="tcsv18" size="25" value="<?php echo $tabs_results[17]->tcsv; ?>" class="num"  /></td>

<!--            <td><input type="text" id="dfm18" name=" dfm18" size="25" value="<?php echo $tabs_results[17]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span181" size="" style="display:none" value="" class="span11">A</span><span id="span182" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span183" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">19</div></td>
            <td><input type="text"id="tcsv19" name="tcsv19" size="25"  value="<?php echo $tabs_results[18]->tcsv; ?>" class="num" /></td>

<!--            <td><input type="text" id="dfm19" name=" dfm19" size="25" value="<?php echo $tabs_results[18]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span191" size="" style="display:none" value="" class="span11">A</span><span id="span192" style="display:none" size=""  value="" class="span12">N</span>
                <span id="span193" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">20</div></td>
            <td><input type="text"id="tcsv20"  name="tcsv20" size="25"  value="<?php echo $tabs_results[19]->tcsv; ?>" class="num" /></td>

<!--            <td><input type="text" id="dfm20" name=" dfm20" size="25" value="<?php echo $tabs_results[19]->percent_deviation; ?>" class="num3" readonly="readonly" /></td>
            <td><span id="span201" size="" style="display:none" value="" class="span11">A</span><span id="span202" style="display:none" size="" value="" class="span12">N</span>
                <span id="span203" style="display:none"  value="" class="span13">O</span></td>-->
        </tr>
        <tr>
            <td><div align="center">Total</div></td>
            <td><input type="text" id="totals" name="totalss"  class="num4" value="<?php echo $tabs_ta[0]->total?>"/></td>


        </tr>
        <tr>
            <td><div align="center">Average</div></td>
            <td><input type="text" id="av1" name="average"  class="num4"  value="<?php echo $tabs_ta[0]->average?>"/></td>

        </tr>
        <input type="hidden" name="tabStatus" id="tabStatus"/>
        <td colspan="5"> Sample:<strong><?php echo $tabs_ta[0]->tstatus;?></strong></td>
    </table>

    <center><div id="comments">

        </div>                </center>
    <p>  
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><label for="comment"></label> </strong>                 
<!--    </p><div align="center"><textarea name="comment" cols="90" id="com" ><?php echo $tabs_ta[0]->comment;?></textarea></div>-->
    <center>   <p><input type="submit" value="Approve" style="background-color: #33ff33;color: #ffffff;" class="Inline"/>&nbsp;&nbsp;<a href="#rejectSample" id="Inline" style="background-color: #F00; color: #ffffff;">Reject</a></p></center>


    </form>
</div>  
 <div class="reject">
        <div id="rejectSample">
        <?php $this->load->view('compose_v_1');?>
        </div>
    </div>
