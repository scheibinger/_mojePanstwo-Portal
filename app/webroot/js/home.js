jQuery(function () {
    jQuery('#home').find('.apps .appFolder').click(function (event) {
        event.preventDefault();
        _mojePanstwoCockpitSlider.showDialogBox(event);
    })

    var globalSearch;

    if ((globalSearch = $('.globalSearch')).length) {
        var globalSearchInput = globalSearch.find('input.form-control'),
            globalSearchBtn = globalSearch.find('.input-group-btn .btn'),
            globalSearchCache = {};

        console.log(globalSearchBtn);

        globalSearchInput.autocomplete({
            minLength: 2,
            delay: 150,
            source: function (request, response) {
                var term = request.term;
                if (term in globalSearchCache) {
                    response(globalSearchCache[ term ]);
                    return;
                }
                globalSearchBtn.addClass('loading');
                $.getJSON("/dane/suggest.json?q=" + request.term, function (data, status, xhr) {
                    globalSearchBtn.removeClass('loading');
                    var results = $.map(data.hits, function (item) {
                        
                        var label = '<span class="col-md-2">' + item.dataset + '</span><span class="col-md-10">' + item.title + '</span>';
                        
                        return {
                            label: label,
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
            },
            focus: function (event, ui) {
                if (ui.item.value !== null)
                    globalSearchInput.val(ui.item.title);
                return false;
            },
            select: function (event, ui) {
                if (ui.item.value !== null) {
                    globalSearchInput.val(ui.item.label);
                }
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	      return $( "<li class=\"row\">" )
	        .append( "<a href=\"/dane/" + item.dataset + "/" + item.value + "\">" + item.label + "</a>" )
	        .appendTo( ul );
	    };
	    
	    // ui-menu-item
	    // presentation
	    
    }
});