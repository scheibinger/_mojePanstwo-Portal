(function ($) {
    var ustawyCache = {},
        ustawaTime = null,
        lastSearch = null,
        searchMinLength = 1,
        shortcuts = $('#shortcuts'),
        shortcutArrow = {
            active: shortcuts.find('ul li.active'),
            arrow: shortcuts.find('.shortcutArrow'),
            arrowSize: shortcuts.find('.shortcutArrow').outerWidth() / 2,
            duration: 400
        },
        searchInput = $('.appHeader .searchInput'),
        ustawyCarousel = $('#ustawyCarousel'),
        resultsList = ustawyCarousel.find('.item.results'),
        animationTime = 200,
        ajaxDelay = 200;

    shortcuts.find('.shortcutArrow').css({
        'top': '5px',
        'left': shortcutArrow.active.position().left + (shortcutArrow.active.outerWidth() / 2) - shortcutArrow.arrowSize
    });

    shortcuts.find('li').click(function () {
        shortcutArrow.active = $(this);
        shortcuts.find('li.active').removeClass('active');
        $(this).addClass('active');
        shortcutArrow.arrow.animate({
            'left': $(this).position().left + ($(this).outerWidth() / 2) - shortcutArrow.arrowSize
        }, shortcutArrow.duration)
    });

    searchInput.on('submit keyup', function (e) {
        var input = searchInput.find('input').val();
        e.preventDefault();

        if (input != lastSearch) {
            ustawyCarousel.carousel(0);

            window.clearTimeout(ustawaTime);
            ustawaTime = window.setTimeout(function () {
                searchAjax(input);
            }, ajaxDelay);
        }
    });

    function searchAjax(word) {
        var input = searchInput.find('input').val(),
            resultsItem = shortcuts.find('ul li.results');
        ;

        if (input.length >= searchMinLength) {
            if (word == input) {
                lastSearch = input;
                if (word in ustawyCache) {
                    searchInput.find('.btn').addClass('loading');
                    resultList(word, ustawyCache[word]);
                    return;
                }

                $.ajax({
                    type: "GET",
                    url: "/ustawy/search.json?q=" + input,
                    beforeSend: function () {
                        if (resultsList.find('ul').length > 0)
                            resultsList.find('ul').animate({'opacity': '.2'}, animationTime);
                        searchInput.find('.btn').addClass('loading');

                        if (resultsItem.is(':visible')) {
                            shortcutArrow.arrow.animate({
                                'left': resultsItem.position().left + (resultsItem.outerWidth() / 2) - shortcutArrow.arrowSize
                            }, {duration: shortcutArrow.duration, queue: false});
                        }
                    },
                    success: function (data) {
                        ustawyCache[word] = data;
                        resultList(word, data);
                    },
                    complete: function () {
                        searchInput.find('.btn').removeClass('loading');
                    }
                });
            } else {
                window.clearTimeout(ustawaTime);
                ustawaTime = window.setTimeout(function () {
                    searchAjax(input);
                }, ajaxDelay);
            }
        }
    }

    function resultList(word, data) {
        var resultsListUl = resultsList.find('ul'),
            resultsItem = shortcuts.find('ul li.results');

        if (resultsList.find('ul').length > 0 && resultsList.find('ul').css('opacity') == '1') {
            resultsList.find('ul').animate({'opacity': '.2'}, animationTime);
        }

        if (resultsItem.is(':hidden')) {
            resultsItem.removeClass('hidden');
            shortcutArrow.arrow.css({
                'left': shortcuts.find('ul li.active').position().left + (shortcuts.find('ul li.active').outerWidth() / 2) - shortcutArrow.arrowSize
            });
            shortcutArrow.arrow.animate({
                'left': resultsItem.position().left + (resultsItem.outerWidth() / 2) - shortcutArrow.arrowSize
            }, {duration: shortcutArrow.duration, queue: false});
        }

        shortcuts.find('li.active').removeClass('active');
        resultsItem.addClass('active');

        resultsListUl.html('');

        if (data.search.length == 0) {
            resultsListUl.append(
                jQuery('<li></li>').addClass('center').html(_mPHeart.translation.LC_USTAWY_BRAK_WYNIKOW + ': <strong>' + word + '</strong>')
            )
        }

        $.each(data.search, function () {
            var dataSearch = this;

            resultsListUl.append(
                $('<li></li>').append(function () {
                    var header = $('<span></span>').addClass('resultHeader').append(
                            $('<a></a>').attr({'target': '_self', 'href': '/dane/ustawy/' + dataSearch['id'], 'title': data['tytul'], 'class': 'title'}).text(_mPHeart.translation.LC_USTAWY_TITLE_USTAWA + ' ' + dataSearch['tytul_skrocony'])
                        ).append(
                            $('<span></span>').addClass('subtitle').html(_mPHeart.translation.LC_USTAWY_PUBLIKACJA + ' ' + dataSearch['data_slowna'])
                        );
                    var hl = $('<span></span>').addClass('highlight alert alert-info').html(dataSearch.hl);
                    $(this).append(header);
                    $(this).append(hl);
                })
            )
        });
        resultsListUl.animate({'opacity': '1'}, animationTime);
        ustawyCarousel.find('.carousel-inner').css('height', ustawyCarousel.find('.carousel-inner .item.results.active').outerHeight());
    }

    ustawyCarousel.carousel();
    ustawyCarousel.on('slide.bs.carousel', function () {
        ustawyCarousel.find('.carousel-inner').css('height', ustawyCarousel.find('.carousel-inner .item.active').outerHeight());
    });
    ustawyCarousel.on('slid.bs.carousel', function () {
        ustawyCarousel.find('.carousel-inner').css('height', ustawyCarousel.find('.carousel-inner .item.active').outerHeight());
    });
}(jQuery));