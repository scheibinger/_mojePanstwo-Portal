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
                var term = request.term;
                if (term in globalSearchCache) {
                    response(globalSearchCache[ term ]);
                } else {
                    globalSearchBtn.addClass('loading');
                    $.getJSON("/dane/suggest.json?q=" + request.term, function (data, status, xhr) {
                        globalSearchBtn.removeClass('loading');
                        var results = $.map(data.hits, function (item) {

                            return {
                                title: item.title,
                                value: item.id,
                                dataset: item.dataset
                            };
                        });
                        if (results.length == 0)
                            results = [
                                {label: _mPHeart.translation.LC_SEARCH_BRAK_WYNIKOW, value: null}
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
                            $('<span></span>').addClass('col-md-10').text(item.title)
                        )
                )
                .appendTo(ul);
        };
    }
});