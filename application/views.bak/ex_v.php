<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Export Test</title>
    </head>
    <body>
        <?php echo form_open('excel_page/export_to_excel/');?>
       <p> First name: <input type="text" name="name"/></p>
        <p>Last Name: <input type="text" name="lname"/></p>
        <p>Middle Name: <input type="text" name="name1"/></p>
       <p> Other Name: <input type="text" name="lname1"/></p>
       <input type="submit" value="Export to excel"/>
        <?php echo form_close();?>
    </body>
</html>
