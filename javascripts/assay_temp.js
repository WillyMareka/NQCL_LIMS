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
 
});



$(document).ready(function()
{
    $("#vf1,#p1,#vf2,#p2,#ppt1").change(function()
    {
               
        var a=$('#vf1').val();
        var vf1= $('#vf11').val(a);
        var b=$('#p1').val();
        var p1 =$('#p11').val(b);
        var c=$('#vf2').val();
        var vf2= $('#vf22').val(c);
        
    });
    $(document).ready(function(){
        $('#vf2,#vf1,#number,#p1,#number1,#p2,#ppt1,#vf31,#vf33,#p321,#vf32,#ppt2,#vf34').change(function() {
            var answer=0;
            var answer2=0;
            var weighta=parseFloat($('#number').val());
            var weightb =parseFloat($('#number1').val());
                  
                                   
            var a=parseFloat($('#vf1').val());              
            var b=parseFloat($('#p1').val());               
            var c=parseFloat($('#vf2').val());
            var d=parseFloat($('#p2').val());
            var e=parseFloat($('#vf31').val());
            var f=parseFloat($('#p321').val());
            var g=parseFloat($('#vf32').val());
          
            answer=((weighta/a)*(b/c)*(d/e)*(f/g));
         
               
            var vf1= parseFloat($('#vf11').val());
            var p1 =parseFloat($('#p11').val());
            var vf2= parseFloat($('#vf22').val());
            var pp2= parseFloat($('#ppt1').val());
            var vf3= parseFloat($('#vf33').val());
            var p3= parseFloat($('#ppt2').val());
            var vf4= parseFloat($('#vf34').val());
               
            answer2=((weightb/vf1)*(p1/vf2)*(pp2/vf3)*(p3/vf4));
               
               
               
            $('#mgml').val(answer.toFixed(6));             
            $('#mgml1').val(answer2.toFixed(6));
        // $('#mgml').val(answer.toFixed(2));
        });
    });
});
     
$(document).ready(function(){
    $('#workingvf2,#workingvf1,#workingmgml,#workingp1,#workingp2, #workingvf3,#workingp3,#workingvf4').live('change',function() {
        var answer=0;
        var answer2=0;
        var smgml=$('#workingmgml').val();
        var concsmgml=$('#smgml').val(smgml);
        var mgml=parseFloat($('#workingmgml').val());               
                  
                                   
        var a=parseFloat($('#workingvf1').val());              
        var b=parseFloat($('#workingp1').val());               
        var c=parseFloat($('#workingvf2').val());
        var d=parseFloat($('#workingp2').val());
        var e=parseFloat($('#workingvf3').val());
        var f=parseFloat($('#workingp3').val());
        var g=parseFloat($('#workingvf4').val());
               
        answer=(mgml  *(e/d)*(c/b)*(g/f))*a
               
        $('#workingnumber').val(answer.toFixed(2));
        var k = parseFloat($('#workingnumber').val());
        if(k>0){
            $("div#sampleassay").show();
        }else{
            $("div#sampleassay").hide();  
        }
               
                
    });
});

     
//==============================================SAMPLE PREPARATION====================================//
$(document).ready(function(){
    $("#svf1,#sp1,#svf2,#pwnumber,#aiweight,#aiweightA,#aiweightB,#aiweightC,#sampleA,#sampleB,#sampleC,#svf11,#svf111,#svf3,#svf13,#svf23,#svf24,#sp11,#sp112,#spf1,#spf2,#spf3,#p3,#svf12,#svf22,#svf33,#labelclaim,#vf3,#pipette2").live('change',function()
    {
        //getting the values for powder weight calculations
        var pwnumber1=0;
        var pwnumber2=0;
        var pwnumber3=0;
        var pwnumber4=0;
        var answer1=0;
        var answer2=0;
        var answer3=0;
        var active_i;
        var sample_ave=650;
        
        var smgml=parseFloat($('#smgml').val());
        //var concsmgml=$('#smgml').val(smgml);
        // var mgml=parseFloat($('#workingmgml').val());               
                  
                                   
        var a=parseFloat($('#svf1').val());              
        var b=parseFloat($('#sp1').val());               
        var c=parseFloat($('#svf2').val());
        var d= parseFloat($('#pipette2').val())
        var e=parseFloat($('#vf3').val());
       
               
        active_i=(smgml  *(e/d))*(c/b)*a;
         
               
        $('#aiweight').val(active_i.toFixed(2));
        
        
        
        
        
        //var pwnumber=$('#pwnumber').val();
        var aiweight=parseFloat($('#aiweight').val());
        var labelclaim=parseFloat($('#labelclaim').val());
                
        var sampleA=parseFloat($('#sampleA').val());
        var sampleB=parseFloat($('#sampleB').val());
        var sampleC=parseFloat($('#sampleC').val());
                
                
        pwnumber1 =(aiweight*sample_ave)/labelclaim;
                                
                
        $('#pwnumber').val(pwnumber1);
              
        pwnumber2 =(sampleA*labelclaim)/sample_ave;        
        pwnumber3 =(sampleB*labelclaim)/sample_ave;
        pwnumber4 =(sampleC*labelclaim)/sample_ave;
              
              
        $('#aweightA').val(pwnumber2.toFixed(2));
        $('#aweightB').val(pwnumber3.toFixed(2));
        $('#aweightC').val(pwnumber4.toFixed(2));
      
   
               
        //vf1
        
        a=parseFloat($('#svf1').val());
        var svf11= $('#svf11').val(a);
        var svf111= $('#svf111').val(a);
        var svf3= $('#svf3').val(a);
               
        //pipette1
        b=parseFloat($('#sp1').val());
        var sp11=$('#sp11').val(b);
        var sp112 =$('#sp112').val(b);
        var sp3 =$('#ssp3').val(b);
          
        //vf2
        c=parseFloat($('#svf2').val());
        var svf12= $('#svf12').val(c);
        var svf22= $('#svf22').val(c);
        var svf33= $('#svf33').val(c);
        
        
        //pipette2
        d=parseFloat($('#pipette2').val());
        var spf1= $('#spf1').val(d);
        var spf2= $('#spf2').val(d);
        var spf3= $('#spf3').val(d);
        
        
        //vf3
        e=parseFloat($('#vf3').val());
        var svf2= $('#svf13').val(e);
        var svf4= $('#svf23').val(e);
        var svf5= $('#svf24').val(e);
       
        //get weights
        var weighta  =parseFloat($('#aweightA').val());
        var weightb=parseFloat($('#aweightB').val());
        var weightc=parseFloat($('#aweightC').val());
        
               
        answer1=((weighta/a)*(b/c)*(d/e));
        answer2=((weightb/a)*(b/c)*(d/e));
        answer3=((weightc/a)*(b/c)*(d/e));
               
               
               
        $('#smgml1').val(answer1.toFixed(6));             
        $('#smgml2').val(answer2.toFixed(6));
        $('#smgml3').val(answer3.toFixed(6));
               
    });
});

    


	
	
	