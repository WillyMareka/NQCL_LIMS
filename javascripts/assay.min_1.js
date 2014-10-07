//==================================================STANDARD PREPARATION================================================//	
$(document).ready(function()
{
        var k= 'test';
    
        $("#workingvf1,#workingp1,#workingvf2,#workingp2,#workingvf3,#workingp3,#workingvf4").change(function()
        {
            
               
            var a1=($('#workingvf1').val());              
            var b1=($('#workingp1').val());               
            var c1=($('#workingvf2').val());
            var d1=($('#workingp2').val());
            var e1=($('#workingvf3').val());
            var f1=($('#workingp3').val());
            var g1=($('#workingvf4').val());
            //alert(1);
               
             
               
            $('#vf1').val(a1);
            $('#vf11').val(a1);
            $('#p1').val(b1);
            $('#p11').val(b1);
            $('#vf2').val(c1);
            $('#vf22').val(c1);
            $('#p2').val(d1);
            $('#ppt1').val(d1);
            $('#vf31').val(e1);
            $('#vf33').val(e1);
            $('#p321').val(f1);
            $('#ppt2').val(f1);
            $('#vf32').val(g1);
            $('#vf34').val(g1);
     
        });
            $('#number,#number_c,#vf1,#p1,#vf2,#p2,#vf31,#p321,#vf32,#number1,#number1_c,#vf11,#p11,#vf22,#ppt1,#vf33,#ppt2,#vf34,#workingvf1,#workingp1,#workingvf2,#workingp2,#workingvf3,#workingp3,#workingvf4').change('live',function() {
           
               var answer=0;
                var answer2=0;
                var weighta=parseFloat($('#number').val());               
                var weightb =parseFloat($('#number1').val());
                var weightb_c =parseFloat($('#number1_c').val());
                 var weight_c=parseFloat($('#number_c').val());
                  
                               
                var a=parseFloat($('#vf1').val());              
                var b=parseFloat($('#p1').val());               
                var c=parseFloat($('#vf2').val());
                var d=parseFloat($('#p2').val());
                var e=parseFloat($('#vf31').val());
                var f=parseFloat($('#p321').val());
                var g=parseFloat($('#vf32').val());
             
                facf=parseFloat($('#convfact').val());               
                n_weight1=weight_c * facf;
                $('#number').val(n_weight1.toFixed(2)); 
                 answer=((weighta/a)*(b/c)*(d/e)*(f/g));
               
                var vf1= parseFloat($('#vf11').val());
                var p1 =parseFloat($('#p11').val());
                var vf2= parseFloat($('#vf22').val());
                var pp2= parseFloat($('#ppt1').val());
                var vf3= parseFloat($('#vf33').val());
                var p3= parseFloat($('#ppt2').val());
                var vf4= parseFloat($('#vf34').val());
                 
               
               
                n_weight12=weightb_c * facf;
                $('#number1').val(n_weight12.toFixed(2)); 
                 answer2=((weightb/vf1)*(p1/vf2)*(pp2/vf3)*(p3/vf4));
               
                $('#mgml').val(answer.toFixed(6));             
                $('#mgml1').val(answer2.toFixed(6));
            // $('#mgml').val(answer.toFixed(2));
        
            });
        });
       
    

     


    


	
	
	