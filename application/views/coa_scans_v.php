<style>
    h1, h2 { font-family: Arial, sans-serif; font-size: 25px; }
    h2 { font-size: 20px; }

    label { font-family: Verdana, sans-serif; font-size: 12px; display: block; }
    input { padding: 3px 5px; width: 250px; margin: 0 0 10px; }
    input[type="file"] { padding-left: 0; }
    input[type="submit"] { width: auto; }

    #files { font-family: Verdana, sans-serif; font-size: 11px; }
    #files strong { font-size: 13px; }
    #files a { float: right; margin: 0 0 5px 10px; }
    #files ul { list-style: none; padding-left: 0; }
    #files li { width: 280px; font-size: 12px; padding: 5px 0; border-bottom: 1px solid #CCC; }
</style>
<script>
    $(document).ready(function () {
        getData();
        $(function () {
            $('#upload_file').submit(function (e) {
                can = $('#title').val();
                labref =$('#labref').val();
                  file =$('#userfile').val();
                  
                  if(can ==''){
                      alert('CAN Number cannot be left empty, format CAN/2015/015');
                      return false;
                  }else if(labref ==''){
                       alert('Lab Reference cannot be left empty, format NDQD201502001');
                       return false;
                  }else if(file ==''){
                       alert('File must be selected, format *.jpg, *.jpeg');
                       return false; 
                  }else{
                
                e.preventDefault();
                $.ajaxFileUpload({
                    url: "<?php echo site_url('coa_scans/upload_file/'); ?>",
                    secureuri: false,
                    fileElementId: 'userfile',
                    dataType: 'json',
                    data: {
                        'title': $('#title').val(),
                         'labref': $('#labref').val()
                    },
                    success: function (data, status)
                    {
                        if (data.status != 'error')
                        {
                            $('#files').html('<p>Reloading files...</p>');
                            //refresh_files();
                            $('#title').val('');
                            $('#labref').val('');
                            $('#userfile').val('');
                            $("#refsubs").empty();
                            $('#refsubs').dataTable().fnDestroy();
                            getData();
                        }

                    }
                });
                }
                return false;
            });
            
        });

        $(document).on('click','#delete_data',function () {
            id = $(this).attr('class');
            $.post("<?php echo base_url(); ?>coa_scans/delete/" + id, function () {
                console.log('success');
                $("#refsubs").empty();
                $('#refsubs').dataTable().fnDestroy();
                getData();
            });
        });

        function getData() {

            rtable = $('#refsubs').dataTable({
                "bJQueryUI": true,
                "aoColumns": [
                    {"sTitle": "Lab Ref Number", "mData": "labref"},
                    {"sTitle": "CAN Number", "mData": "title"},
                    {"sTitle": "Action", "mData": null,
                        "mRender": function (data, type, row) {
                            return "<a href='<?php echo base_url(); ?>coa_scans_files/" + row.filename + "'>View</a>";
                        }},
                    {"sTitle": "Delete", "mData": null,
                        "mRender": function (data, type, row) {
                            return "<a class=" + row.filename + " id='delete_data' href='#DeleteScan?"+row.filename+"'>Delete</a>";
                        }}


                ],
                //"sScrollY": "300px",
                "sScrollX": "70%",
                "bDeferRender": true,
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "iDisplayLength": 16,
                "sAjaxDataProp": "",
                "sAjaxSource": '<?php echo site_url() . "coa_scans/requests_list" ?>'
            });
        }







    })
</script>
<!doctype html>
<html>
    <head>
        <script src="<?php echo base_url() ?>javascripts/ajaxfileupload.js"></script>
    </head>
    <body>
        <h1>Upload Scanned COA</h1>
        <form method="post" action="" id="upload_file">
            <label for="labref">Lab ref No.</label>
            <input type="text" name="labref" id="labref" value="" />

            <label for="title">CAN Number</label>
            <input type="text" name="title" id="title" value="" />

            <label for="userfile">File</label>
            <input type="file" name="userfile" id="userfile" size="20" />

            <input type="submit" name="submit" id="submit" value="Upload" />
        </form>
        <h2>COA LIST</h2>
        <table id = "refsubs">
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>
    </body>
</html>
