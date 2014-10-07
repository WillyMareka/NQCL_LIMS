$(document).ready(function(){    
    
        $('.dissolution-class').live('keyup',function () {
        var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.dissolution-class[value!=""]').length;
        $('.dissolution-class').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(2);
            answer=sum1/boxes;
            answer1=answer.toFixed(2);
        });
        $('#tcreading').val(sum1);
        $('#tcmean').val(answer1);
       
       
    });
    
      $('#R2').keyup(function(){
       
       vu=$(this).val(); 
       $('#vu').val(vu);
    });
        $('#Rv21').keyup(function(){
         
       vu2=$(this).val(); 
       $('#vu2').val(vu2);
    });
    
    
        
 $("#R2,#vu,#labelclaim,#actveIngredient,#workingp1,#workingv,#workingp2,#workingv2,#workingp3,#workingv3,#workingp4,#workingv4,#workingmgml,#conc").live('change',function()
    {
        var working_concetration =0;
        //volume mapped to subsequent disolutions    
        var r2=($('#R2').val()); 
        var vu=$('#vu').val(r2);       
        
        var labelclaim=parseFloat($('#labelclaim').val());
        
             var wp1=parseFloat($('#workingp1').val());               
            var wv1=parseFloat($('#workingv').val());
        
            var wp2=parseFloat($('#workingp2').val());               
            var wv2=parseFloat($('#workingv2').val());
        
            var wp3=parseFloat($('#workingp3').val());               
            var wv3=parseFloat($('#workingv3').val());
        
            var wp4=parseFloat($('#workingp4').val());               
            var wv4=parseFloat($('#workingv4').val());
        
        
        var volume =parseFloat($('#vu').val());
        
        var lv =((labelclaim/volume));
        var wv =((wp1/wv1)*(wp2/wv2)*(wp3/wv3)*(wp4/wv4));
        working_concetration=(lv*wv);
      
        $('#conc').val(working_concetration.toFixed(6));
        $('#workingmgml1').val(working_concetration.toFixed(6)); 
  
    });
    
     $("#Rv21,#vu2,#labelclaim1,#workingp1_2,#workingv_2,#workingp2_2,#workingv2_2,#workingp3_2,#workingv3_2,#workingp4_2,#workingv4_2,#workingmgml_2,#conc").live('change',function()
    {
        var working_concetration =0;
        //volume mapped to subsequent disolutions    
        var r2=($('#Rv21').val()); 
        var vu=$('#vu2').val(r2);       
        
        var labelclaim=parseFloat($('#labelclaim').val());
        
             var wp1=parseFloat($('#workingp1_2').val());               
            var wv1=parseFloat($('#workingv_2').val());
        
            var wp2=parseFloat($('#workingp2_2').val());               
            var wv2=parseFloat($('#workingv2_2').val());
        
            var wp3=parseFloat($('#workingp3_2').val());               
            var wv3=parseFloat($('#workingv3_2').val());
        
            var wp4=parseFloat($('#workingp4_2').val());               
            var wv4=parseFloat($('#workingv4_2').val());
        
        
        var volume =parseFloat($('#vu2').val());
        
        var lv =((labelclaim/volume));
        var wv =((wp1/wv1)*(wp2/wv2)*(wp3/wv3)*(wp4/wv4));
        working_concetration=(lv*wv);
      
        $('#conc_2').val(working_concetration.toFixed(6));
        $('#workingmgml1').val(working_concetration.toFixed(6)); 

    });
    
     $('#conc').live('change',function(){
         
       conc=$(this).val(); 
       $('#workingmgml1').val(conc);
    });
    
  $('#workingvf2,#workingvf1,#workingmgml,#workingp11,#workingp12,#workingvf3,#workingp13,#workingvf4').change('live',function() {
        var answer=0;    
        
        
        var mgml=parseFloat($('#workingmgml1').val());               
                  
                                   
        var a=parseFloat($('#workingvf1').val());              
        var b=parseFloat($('#workingp11').val());               
        var c=parseFloat($('#workingvf2').val());
         var d=parseFloat($('#workingp12').val());
         var e=parseFloat($('#workingvf3').val());
         var f=parseFloat($('#workingp13').val());
         var g=parseFloat($('#workingvf4').val());
        
      
        
               
        answer=(mgml  *(c/b)*(e/d)*(g/f))*a;
               
        $('#workingweight').val(answer.toFixed(2));
        
           facf=parseFloat($('#convfact').val());
       
        test= answer/facf;   
         
         $('#workingnumber_c').val(test.toFixed(2));
               
                
    });  
     
});
 



