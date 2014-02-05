(function ($) {
    var poslowieBlock = $('.poslowie .blockInfo'),
        poslowieAdditional = $('.poslowieDetails'),
        animSpeed = 400;

    poslowieBlock.find('.link > a').click(function (e) {
        e.preventDefault();

        poslowieBlock.removeClass('active');
        $(this).parents('.blockInfo').addClass('active');

        if (poslowieAdditional.is(':hidden'))
            poslowieAdditional.stop(true, true).slideDown();

        poslowieAdditional.find('.container').animate({
            opacity: 0
        }, animSpeed, function () {
            //change content
            poslowieAdditional.find('.container').animate({
                opacity: 1
            }, animSpeed);
        })
    })
}(jQuery));