jQuery(function () {
    jQuery('#home').find('.apps .appFolder').click(function (event) {
        event.preventDefault();
        _mojePanstwoCockpitSlider.showDialogBox(event);
    });

    var globalSearch;

    if ((globalSearch = $('.globalSearch')).length) {
        var globalSearchInput = globalSearch.find('input.form-control'),
            globalSearchBtn = globalSearch.find('.input-group-btn .btn'),
            globalSearchCache = {};

        globalSearchInput.autocomplete({
            minLength: 2,
            delay: 100,
            source: function (request, response) {
                var term = globalSearchWord = request.term;
                if (term in globalSearchCache) {
                    response(globalSearchCache[ term ]);
                } else {
                    globalSearchBtn.addClass('loading');
                    $.getJSON("/dane/suggest.json?q=" + request.term, function (data, status, xhr) {
                        var results = $.map(data.hits, function (item) {
                            var shortTitleLimit = 200,
                                shortTitle = '';

                            if (item.title.length > shortTitleLimit) {
                                shortTitle = item.title.substr(0, shortTitleLimit);
                                shortTitle = shortTitle.substr(0, Math.min(shortTitle.length, shortTitle.lastIndexOf(" "))) + '...';
                            } else {
                                shortTitle = item.title;
                            }
                            return {
                                title: item.title,
                                shortTitle: shortTitle,
                                value: item.id,
                                dataset: item.dataset
                            };
                        });
                        if (results.length == 0)
                            results = [
                                {
                                    title: _mPHeart.translation.LC_SEARCH_BRAK_WYNIKOW,
                                    shortTitle: _mPHeart.translation.LC_SEARCH_BRAK_WYNIKOW,
                                    value: null,
                                    dataset: null
                                }
                            ];
                        globalSearchCache[ term ] = results;
                        response(results);
                    });
                }
            },
            focus: function (event, ui) {
                if (ui.item.value !== null)
                    globalSearchInput.val(ui.item.title);
                return false;
            },
            open: function (event, ui) {
                var uiAutocomplete = $('.ui-autocomplete');
                uiAutocomplete.css({'top': parseInt(uiAutocomplete.css('top')) - 6 + 'px', 'width': globalSearchInput.outerWidth()});
                globalSearchBtn.removeClass('loading');
            },
            select: function (event, ui) {
                if (ui.item.value !== null) {
                    globalSearchInput.val(ui.item.title);
                }
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $('<li></li>').addClass("row")
                .append(
                    $('<a></a>').attr({'href': '/dane/' + item.dataset + '/' + item.value, 'target': '_blank'})
                        .append(
                            $('<span></span>').addClass('col-md-2').text(item.dataset)
                        )
                        .append(
                            $('<span></span>').addClass('col-md-10').text(item.shortTitle)
                        )
                )
                .appendTo(ul);
        };
    }
});