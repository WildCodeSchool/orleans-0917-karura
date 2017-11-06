$('document').ready(function () {
    $('.animJs1').fadeIn(500, 'linear', function () {
        $('.animJs2').fadeIn(500, 'linear', function(){
            $('.animJs3').fadeIn(500, 'linear', function(){});
        });
    });
});

