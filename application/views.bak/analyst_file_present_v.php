<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $labref;?> Re-upload page </title>
    </head>
    <body>
       <p><h3> Worksheet "<?php echo $labref.'.xlsx';?>" for Sample <?php echo $labref;?> already exists!</h3></p>
       <p>Please click <a href='<?php echo base_url();?>analyst_uploads/upload_re/<?php echo $labref;?>'><strong><u>Here</u></strong> </a>  to if you want to Re upload an update file</p>
    </body>
</html>
