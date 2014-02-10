(function ($) {
    var searchInput = $('.header .searchKRSForm'),
        groupsAndResults = $('#groupsAndResults'),
        poslowieBlock = $('.poslowie .blockInfo'),
        poslowieAdditional = $('.poslowieDetails'),
        animSpeed = 400;

    searchInput.on('submit', function (e) {
        var input = searchInput.find('input').val();
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "/krs/search.json?q=" + input,
            beforeSend: function () {
                if (groupsAndResults.find('.carousel-inner .item.results ul').length > 0)
                    groupsAndResults.find('.carousel-inner .item.results ul').animate({'opacity': '.2'}, 400);
            },
            success: function (data) {
                if (groupsAndResults.find('.carousel-inner .item.results').length == 0) {
                    var indicatorLast = groupsAndResults.find('.carousel-indicators li:last-child'),
                        indicatorResults,
                        itemResults = $('<div></div>');

                    itemResults.addClass('item results').append(
                            jQuery('<div></div>').addClass('carousel-title').text(_mPHeart.translation.LC_KRS_SEARCH_TITLE)
                        ).append(
                            jQuery('<ul></ul>')
                        ).append(
                            jQuery('<div></div>').addClass('seeMore').append(
                                jQuery('<a></a>').addClass('btn btn-info').attr({'href': '/dane/kanal/krs?q=' + input, 'target': '_self'}).text(_mPHeart.translation.LC_KRS_SEARCH_LINK)
                            )
                        );

                    indicatorResults = indicatorLast.clone().attr({'data-slide-to': indicatorLast.data('slide-to') + 1});

                    groupsAndResults.find('.carousel-inner .item:first-child').before(itemResults);
                    indicatorLast.after(indicatorResults);
                }

                var resultUl = groupsAndResults.find('.carousel-inner .item.results ul');
                resultUl.html('');

                $.each(data.search, function () {
                    var dataSearch = this;
                    resultUl.append(
                        $('<li></li>').append(function () {
                            var link = jQuery('<a></a>').attr('target', '_self')
                            if (dataSearch['type'] == 'organization') {
                                link.attr('href', '/dane/krs_podmioty/' + dataSearch['id'])
                            } else if (dataSearch['type'] == 'person') {
                                link.attr('href', '/dane/krs_osoby/' + dataSearch['id'])
                            }
                            link.html(dataSearch['nazwa'] + ' <small>(' + dataSearch['field_name'] + ':&nbsp' + dataSearch['field_value'] + ')</small>');
                            $(this).append(link)
                        })
                    )
                });
                resultUl.animate({'opacity': '1'}, 400);

                $('#groupsAndResults').carousel(0);
            }
        })
    });

    poslowieBlock.find('.link > a').click(function (e) {
        e.preventDefault();

        poslowieBlock.removeClass('active');
        $(this).parents('.blockInfo').addClass('active');

        if (poslowieAdditional.is(':hidden'))
            poslowieAdditional.stop(true, true).slideDown();

        poslowieAdditional.find('.container').animate({
            opacity: 0
        }, animSpeed, function () {
            //@TODO: change content
            poslowieAdditional.find('.container').animate({
                opacity: 1
            }, animSpeed);
        })
    })
}(jQuery));