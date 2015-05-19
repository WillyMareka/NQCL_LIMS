<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
       $('#listax').dataTable({
    "bJQueryUI": true,
    "bSortClasses": false,
    "bAutoWidth": true,
    "bInfo": true,
    "sScrollY": "100%",
    "sScrollX": "100%",
    "bScrollCollapse": true,
    "sPaginationType": "full_numbers",
    "bRetrieve": true,
    "oLanguage": {
        "sSearch": "Search Anything:"
    },
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('ajax_live/load') ?>",
    "aoColumns": [
                                        null,
                                        null,
                                        null,
                                        null,
                                        null
                                        
                                        //put as many null values as your columns

                    ],
    "fnServerData": function(sSource, aoData, fnCallback) {
        $.ajax({
            "dataType": 'json',
            "type": "POST",
            "url": sSource,
            "data": aoData,
            "success": fnCallback
        });
    }
});
    });
</script>

<table id="listax"></table>