(function ($) {
    var ustawyCache = {},
        ustawaTime = null,
        lastSearch = null,
        searchMinLength = 2,
        shortcuts = $('#shortcuts'),
        searchInput = $('.appHeader .searchInput'),
        resultsList = $('#ustawyCarousel').find('.item.results'),
        animationTime = 200,
        ajaxDelay = 200;

    shortcuts.find('li').click(function () {
        shortcuts.find('li.active').removeClass('active');
        $(this).addClass('active');
    });

    searchInput.on('submit keyup', function (e) {
        var input = searchInput.find('input').val();
        e.preventDefault();

        if (input != lastSearch) {
            $('#ustawyCarousel').carousel(0);

            window.clearTimeout(ustawaTime);
            ustawaTime = window.setTimeout(function () {
                searchAjax(input);
            }, ajaxDelay);
        }
    });

    function searchAjax(word) {
        var input = searchInput.find('input').val();

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
        var resultsListUl = resultsList.find('ul');

        if (resultsList.find('ul').length > 0 && resultsList.find('ul').css('opacity') == '1')
            resultsList.find('ul').animate({'opacity': '.2'}, animationTime);

        shortcuts.find('li.active').removeClass('active');

        if (shortcuts.find('li.results').is(':hidden'))
            shortcuts.find('li.results').removeClass('hidden');

        shortcuts.find('li.results').addClass('active');

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
                    var title = $('<p></p>').addClass('title').append(
                        $('<a></a>').attr({'target': '_self', 'href': '/dane/ustawy/' + dataSearch['id'], 'title': data['tytul']}).text(_mPHeart.translation.LC_USTAWY_TITLE_USTAWA + ' ' + dataSearch['tytul_skrocony'])
                    );
                    var subtitle = $('<p></p>').addClass('subtitle').append(
                        $('<span></span>').html(_mPHeart.translation.LC_USTAWY_PUBLIKACJA + ' ' + dataSearch['data_slowna'])
                    );
                    $(this).append(title);
                    $(this).append(subtitle);
                })
            )
        });
        resultsListUl.animate({'opacity': '1'}, animationTime);
    }
}(jQuery));