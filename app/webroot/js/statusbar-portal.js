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

                            $('<form></form>').attr({'action': '/dane/szukaj', 'method': 'GET'}).append(
                                $('<div></div>').addClass('col-md-12 searchFor globalSearch').append(

                                    $('<div></div>').addClass('input-group').append(
                                            $('<input>').attr({'type': 'text', 'name': 'q', 'autocomplete': 'off', 'placeholder': _mPHeart.globalSearch.placeholder, 'value': $("<div/>").html(_mPHeart.globalSearch.phrase).text()}).addClass('form-control input-lg')
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
    });

    var globalSearch;

    if ((globalSearch = $('.globalSearch')).length) {
        $.each($(".globalSearch"), function (index, block) {
            var globalSearchInput = $(block).find('input.form-control'),
                globalSearchBtn = $(block).find('.input-group-btn .btn'),
                globalSearchCache = {};

            globalSearchInput.autocomplete({
                minLength: 2,
                delay: 200,
                source: function (request, response) {
                    var term = request.term;

                    globalSearchBtn = this.element.parents('form').find('.input-group-btn .btn');

                    if (term in globalSearchCache) {
                        response(globalSearchCache[ term ]);
                    } else {
                        globalSearchBtn.addClass('loading');
                        $.getJSON("/dane/suggest.json?q=" + request.term, function (data) {

                            var results = $.map(data.hits, function (item) {
                                var shortTitleLimit = 200,
                                    shortTitle = '';

                                if ((item.title.length > shortTitleLimit) && (item.dataset != 'twitter')) {
                                    shortTitle = item.title.substr(0, shortTitleLimit);
                                    shortTitle = shortTitle.substr(0, Math.min(shortTitle.length, shortTitle.lastIndexOf(" "))) + '...';
                                } else {
                                    shortTitle = item.title;
                                }

                                return {
                                    type: 'item',
                                    title: item.title,
                                    shortTitle: shortTitle,
                                    value: item.id,
                                    link: item.dataset + '/' + item.id,
                                    label: item.label
                                };
                            });

                            globalSearchCache[ term ] = results;

                            if (results.length == 0) {
                                $('.ui-autocomplete').hide();
                                globalSearchInput.removeClass('open');
                                globalSearchBtn.removeClass('loading');
                            } else {
                                results.push({
                                    type: 'button',
                                    q: request.term
                                });
                                response(results);
                            }
                        });
                    }
                },
                open: function (ui) {
                    $('#ui-id-' + (index + 1)).css({
                        'margin-top': ((globalSearchInput.position().top + globalSearchInput.outerHeight()) - parseInt($('#ui-id-' + (index + 1)).css('top'))) + 'px',
                        'width': globalSearchInput.outerWidth() - 1
                    });
                    globalSearchInput.addClass('open');
                    globalSearchBtn.removeClass('loading');
                },
                close: function () {
                    globalSearchInput.removeClass('open');
                },
                select: function (ui) {
                    if (ui.item.value !== null) {
                        globalSearchInput.val(ui.item.title);
                    }
                    return false;
                }
            });

            globalSearchInput.data("ui-autocomplete")._renderItem = function (ul, item) {
                if (item.type == 'item') {
                    return $('<li></li>').addClass("row")
                        .append(
                            $('<a></a>').attr({'href': '/dane/' + item.link, 'target': '_blank'})
                                .append(
                                    $('<p></p>').addClass('col-xs-3 col-md-2').addClass('_label').html('<span class="label label-default label-sm">' + item.label + '</span>')
                                )
                                .append(
                                    $('<p></p>').addClass('col-md-9 col-md-10').addClass('_title').text(item.shortTitle)
                                )
                        )
                        .appendTo(ul)
                } else if (item.type == 'button') {
                    return $('<li></li>').addClass("row button").append(
                            $('<a></a>').addClass('btn btn-success').attr({'href': '/dane/szukaj?q=' + item.q, 'target': '_self'}).html('<span class="glyphicon glyphicon-search"> </span> ' + _mPHeart.globalSearch.fullSearch)
                        )
                        .appendTo(ul);

                }
            }
        });
    }
})(jQuery);