$(document).ready(function() {
    function addLeadingZeros(n, length)
    {
        var str = (n > 0 ? n : -n) + "";
        var zeros = "";
        for (var i = length - str.length; i > 0; i--)
            zeros += "0";
        zeros += str;
        return n >= 0 ? zeros : "-" + zeros;
    }

    value = 1;
    year = new Date().getFullYear();
    padded_id = addLeadingZeros(value, 3);
    nqcl_ = "BIOL/" + padded_id + "/" + year;
    $('#microlab_no').val(nqcl_);
    console.log(nqcl_);






  
    $("#date_set").datepicker({
        dateFormat: "dd-M-yy", 
        minDate:  0,
        onSelect: function(){
            var date2 = $('#date_set').datepicker('getDate');
            date2.setDate(date2.getDate()+14);
            $('#date_of_results').datepicker('setDate', date2);
        }
    });

});