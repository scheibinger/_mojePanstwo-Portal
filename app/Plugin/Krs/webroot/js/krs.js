/*global _mPHeart*/
(function ($) {
    var searchInput = $('.appHeader .searchInput'),
        groupsAndResults = $('#groupsAndResults'),
        poslowieBlock = $('.poslowie .blockInfo'),
        poslowieAdditional = $('.poslowieDetails'),
        lastSearch = null,
        krsTime = null,
        krsCache = {},
        searchMinLength = 2,
        animSpeed = 200,
        ajaxDelay = 200;

    searchInput.on('submit keyup', function (e) {
        var input = searchInput.find('input').val();
        e.preventDefault();

        if (input != lastSearch) {
            window.clearTimeout(krsTime);
            krsTime = window.setTimeout(function () {
                searchAjax(input);
            }, ajaxDelay);
        }

    });

    function searchAjax(word) {
        var input = searchInput.find('input').val();

        if (input.length >= searchMinLength) {
            if (word == input) {
                lastSearch = input;
                if (word in krsCache) {
                    searchInput.find('.btn').addClass('loading');
                    resultList(word, krsCache[word]);
                    return;
                }

                $.ajax({
                    type: "GET",
                    url: "/krs/search.json?q=" + input,
                    beforeSend: function () {
                        if (groupsAndResults.find('.carousel-inner .item.results ul').length > 0)
                            groupsAndResults.find('.carousel-inner .item.results ul').animate({'opacity': '.2'}, animSpeed);
                        searchInput.find('.btn').addClass('loading');
                    },
                    success: function (data) {
                        krsCache[input] = data;
                        resultList(input, data);
                    },
                    complete: function () {
                        searchInput.find('.btn').removeClass('loading');
                    }
                });
            } else {
                window.clearTimeout(krsTime);
                krsTime = window.setTimeout(function () {
                    searchAjax(input);
                }, ajaxDelay);
            }
        }
    }

    function resultList(word, data) {
        if (groupsAndResults.find('.carousel-inner .item.results ul').length > 0 && groupsAndResults.find('.carousel-inner .item.results ul').css('opacity') == '1')
            groupsAndResults.find('.carousel-inner .item.results ul').animate({'opacity': '.2'}, animSpeed);

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
                        jQuery('<a></a>').addClass('btn btn-info').attr({'href': '/dane/kanal/krs?q=' + word, 'target': '_self'}).text(_mPHeart.translation.LC_KRS_SEARCH_LINK)
                    )
                );

            indicatorResults = indicatorLast.clone().attr({'data-slide-to': indicatorLast.data('slide-to') + 1});

            groupsAndResults.find('.carousel-inner .item:first-child').before(itemResults);
            indicatorLast.after(indicatorResults);
        }

        var resultUl = groupsAndResults.find('.carousel-inner .item.results ul');
        resultUl.html('');

        if (data.search.length == 0) {
            resultUl.append(
                jQuery('<span></span>').addClass('center').html(_mPHeart.translation.LC_KRS_BRAK_WYNIKOW + ': <strong>' + word + '</strong>')
            );
            groupsAndResults.find('.results .seeMore').hide();
        } else {
            if (groupsAndResults.find('.results .seeMore').is(':hidden'))
                groupsAndResults.find('.results .seeMore').show();
            $.each(data.search, function () {
                var dataSearch = this;
                resultUl.append(
                    $('<li></li>').append(function () {
                        var link = jQuery('<a></a>').attr('target', '_self');

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
        }
        resultUl.animate({'opacity': '1'}, animSpeed);

        $('#groupsAndResults').carousel(0);
    }

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