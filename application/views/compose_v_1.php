<head>    
    <script>
        $(document).ready(function(){
    $(function() {
		$( "#username" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('messages/recipients'); ?>",
				data: { term: $("#username").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 1,
                                    Delay : 50
		});
	});
        });
        
          $(document).ready(function() {
            var success1 = $(".sent");
            var error1 = $(".not_sent");
            var selecterror = $(".selecterror");
            success1.hide();
            error1.hide();
            selecterror.hide()
        });

    </script>
     <style type="text/css">
    .sent{
            background-color: greenyellow;
            display: none;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:black;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
            z-index: 100;
            opacity: .9;

        }

        .not_sent{
            display: none;
            background-color: red;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:white;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
       
        .data{
            display: none;
        }
     </style>

</head>

<br>
<center>
   
</center>
<br>
<center>
    <form name="send" method="post" id="messages" action="<?php echo base_url().'messages/send/'.$this->session->userdata('labref').'/'.$this->session->userdata('module');?>">
         
        <p><b>Clearly outline why you rejected the test and what is to be done!</b></p>
        <div class="sent">Message has been successflly sent!</div>
        <div class="not_sent">An internal error 504 occured, Message not sent!</div>
        <table width="80%">
            <tr>
                <td width="150px" align="left" valign="top"><p>Username</p></td>
                <td width="" align="left" valign="top"><input name="username" type="text" required id="username" readonly value="<?php echo $this->session->userdata('mail_name');?>"></td>
            </tr>

            <tr>
                <td width="150px" align="left" valign="top"><p>Subject</p></td>
                <td width="" align="left" valign="top"><input name="subject" type="text" required id="subject" size="50" readonly value="<?php echo $this->session->userdata('labref')." --- ".$this->uri->segment(1);?>"></td>
            </tr>

            <tr>
                <td width="150px" align="left" valign="top"><p>Message Body</p></td>
                <td width="" align="left" valign="top"><textarea name="message" type="text" required id="message" value="" cols="50" rows="10"></textarea></td>
            </tr>

            <tr>  
                <td></td>
                <td><input type="button" id="send_message" value="Send Message"></td>
            </tr>
        </table>
    </form>
</center>
<script>
    $(document).ready(function(){
        $('#send_message').click(function() {            
            var data1 = $('#messages').serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'messages/send/' . $this->session->userdata('labref') . '/' . $this->session->userdata('module'); ?>",
                data: data1,
                success: function(data)                {
           
                    $('div.sent').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');                  setTimeout(function() {
                       window.location.href = "<?php echo base_url().'supervisors/home/'.$this->session->userdata('labref');?>";
                    }, 3000);                    
                    return true;
                },
                error: function(data) {
                    $('div.not_sent').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');                    
                    return false;
                }
            });
        });
    });
</script>

