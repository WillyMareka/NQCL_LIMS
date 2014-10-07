$(document).ready(function() {

    $('.pykwater,#pykmass').live('keyup', function() {
        var sum = 0;
        var sum1 = 0;
        var answer = 0;
        var answer1 = 0;
        boxes = $(".pykwater").filter(function() {
            return (this.value.length);
        }).length;
        $('.pykwater').each(function() {
            sum += Number($(this).val());
            sum1 = sum.toFixed(2);
            answer = sum1 / boxes;
            answer1 = answer.toFixed(2);
        });
        meanofwater = parseFloat($('.meanofwater').val(answer1));
        meanofwater_1 = parseFloat($('#meanofwater').val());
        pykmass = parseFloat($('#pykmass').val());
        massofWater = meanofwater_1 - pykmass;
        $('#maw').val(massofWater.toFixed(2));

    });

    $('.pyksample,#pykmass').live('keyup', function() {
        var sum1 = 0;
        var sum11 = 0;
        var answer = 0;
        var answer1 = 0;
        var answer11 = 0

        boxes1 = $(".pyksample").filter(function() {
            return (this.value.length);
        }).length;
        $('.pyksample').each(function() {
            sum1 += Number($(this).val());
            sum11 = sum1.toFixed(2);
            answer1 = sum11 / boxes1;
            answer11 = answer1.toFixed(2);
        });
        meanofsample = parseFloat($('.meanofsample').val(answer11));
        meanofsample_1 = parseFloat($('#meanofsample').val());
        pykmasss = parseFloat($('#pykmass').val());
        meanofSample = meanofsample_1 - pykmasss;
        $('#mos').val(meanofSample.toFixed(2));
    });

    $('.pykwater,#pykmass,.pyksample').live('keyup', function() {
        meanofsample_11 = parseFloat($('#mos').val());
        meanofwater_11 = parseFloat($('#maw').val());
        rd = meanofsample_11 / meanofwater_11;
        $('#srd').val(rd.toFixed(2));
    });


});

