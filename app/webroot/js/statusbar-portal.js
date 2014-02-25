(function ($) {
    var cockpit = $('#_mojePanstwoCockpit'),
        cockpitLogo = cockpit.find('._mojePanstwoCockpitLogo'),
        searchEngine = $('<div></div>'),
        searchEngineButton,
        searchEngineInput;

    searchEngine.addClass('_mojePanstwoCockpitSearch').append(
        $('<div></div>').addClass('_mojePanstwoCockpitSearchContent').append(
                $('<div></div>').addClass('_mojePanstwoCockpitSearchContentButton _mojePanstwoCockpitIcons _mojePanstwoCockpitIcons-search _mojePanstwoCockpitBorderLeft')
            ).append(
                $('<div></div>').addClass('_mojePanstwoCockpitSearchInput').append(
                    $('<div></div>').addClass('container').append(
                        $('<div></div>').addClass('col-md-12').append(
                            $('<form></form>').attr({'action': '/dane', 'method': 'GET'}).append(
                                $('<div></div>').addClass('col-md-12 searchFor').append(
                                    $('<div></div>').addClass('input-group').append(
                                            $('<input>').attr({'type': 'text', 'name': 'q', 'placeholder': _mPHeart.globalSearch.placeholder, 'value': _mPHeart.globalSearch.phrase}).addClass('form-control input-lg')
                                        ).append(
                                            $('<span></span>').addClass('input-group-btn').append(
                                                $('<button></button>').addClass('btn').attr('type', 'submit')
                                            )
                                        )
                                )
                            )
                        )
                    )
                )
            )
    );

    cockpitLogo.after(searchEngine);

    searchEngineInput = $('._mojePanstwoCockpitSearchInput');

    (searchEngineButton = searchEngine.find('._mojePanstwoCockpitSearchContentButton')).click(function (e) {
        e.preventDefault();
        var searchEngineHeight = searchEngineInput.css('height');

        if (searchEngineInput.is(':hidden')) {
            searchEngineButton.addClass('active');
            searchEngineInput.stop(true, true).slideDown(400);
            $('#_main').stop(true, true).animate({'marginTop': searchEngineHeight}, 400);
        } else {
            searchEngineButton.removeClass('active');
            searchEngineInput.stop(true, true).slideUp(400);
            $('#_main').stop(true, true).animate({'marginTop': '0'}, 400);
        }
    });
    cockpit.find('._mojePanstwoCockpitMenuUp ._mojePanstwoCockpitMenuUpContentButton').click(function () {
        if (searchEngineInput.is(':visible')) {
            searchEngineButton.removeClass('active');
            searchEngineInput.stop(true, true).slideUp(400);
            $('#_main').stop(true, true).animate({'marginTop': '0'}, 400);
        }
    })
})(jQuery);