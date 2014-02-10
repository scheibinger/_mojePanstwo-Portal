(function ($) {
    var shortcuts = $('#shortcuts'),
        searchInput = $('.appHeader .searchInput'),
        resultsList = $('#ustawyCarousel .item.results');

    shortcuts.find('li').click(function () {
        shortcuts.find('li.active').removeClass('active');
        $(this).addClass('active');
    })

    searchInput.on('submit', function (e) {
        var input = searchInput.find('input').val();
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "/ustawy/search.json?q=" + input,
            beforeSend: function () {
                if (resultsList.find('ul').length > 0)
                    resultsList.find('ul').animate({'opacity': '.2'}, 400);
            },
            success: function (data) {
                var resultsListUl = resultsList.find('ul');

                shortcuts.find('li.active').removeClass('active');

                if (shortcuts.find('li.results').is(':hidden'))
                    shortcuts.find('li.results').removeClass('hidden');

                shortcuts.find('li.results').addClass('active');

                $.each(data.search, function () {
                    var dataSearch = this;

                    resultsListUl.append(
                        $('<li></li>').append(function () {
                            var link = jQuery('<a></a>').attr({'target': '_self', 'href': '/dane/ustawy/' + dataSearch['id'], 'title': data['tytul']})
                            link.html(_mPHeart.translation.LC_USTAWY_TITLE_USTAWA + ' ' + dataSearch['tytul_skrocony'] + ' <small>' + _mPHeart.translation.LC_USTAWY_PUBLIKACJA + ': ' + dataSearch['data_publikacji'] + '</small>');
                            $(this).append(link)
                        })
                    )
                });
                resultsListUl.animate({'opacity': '1'}, 400);

                $('#ustawyCarousel').carousel(0);
            }
        });
    });
}(jQuery));