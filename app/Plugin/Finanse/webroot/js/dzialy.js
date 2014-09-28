jQuery(document).ready(function () {

    /*
     jQuery('#localizeMe').click(function () {
     localizer.request_position()
     });
     */

    var autocomplete = jQuery("#teryt_search_input"),
        cache = {};

    autocomplete.autocomplete({
        minLength: 2,
        source: function (request, response) {
            console.log(request.term);
            var term = request.term;
            if (term in cache) {
                response(cache[term]);
                return;
            }
            jQuery.getJSON("/moja_gmina/search.json?q=" + request.term, function (data) {
                var results = jQuery.map(data, function (item) {
                    return {
                        name: item.nazwa,
                        label: item.nazwa + " (" + item.typ + ")",
                        value: item.id
                    }
                });
                if (results.length == 0)
                    results = [
                        {label: _mPHeart.translation.LC_FINANSE_SEARCH_BRAK_WYNIKOW, value: null}
                    ];
                cache[term] = results;
                response(results);
            });
        },
        focus: function (event, ui) {
            if (ui.item.value !== null)
                autocomplete.val(ui.item.name);
            return false;
        },
        select: function (event, ui) {
            if (ui.item.value !== null) {
                autocomplete.val(ui.item.name);

                jQuery.getJSON("/finanse/finanse/getBudgetData.json?gmina_id=" + ui.item.value, function (data) {

                    var sections = data['sections'];

                    for (var i = 0; i < sections.length; i++) {

                        var section = sections[i];

                        var section_li = jQuery('#sections').find('.section[data-id=' + section['dzial.id'] + ']');
                        var gradient_cont_div = section_li.find('.gradient_cont');
                        var gradient_addons = gradient_cont_div.find('.addons');

                        gradient_addons.find('._teryt').remove();

                        /*
                         gradient_addons.html('');

                         var li_min = jQuery('<li/>', {
                         html: '<p><a href="/dane/gminy/' + '1' + '">Radom</a></p>',
                         }).appendTo(gradient_addons);

                         var li_teryt = jQuery('<li/>', {
                         html: '<p><a href="/dane/gminy/' + '1' + '">Kraków</a></p>',
                         class: '_teryt'
                         }).appendTo(gradient_addons);

                         var li_max = jQuery('<li/>', {
                         html: '<p><a href="/dane/gminy/' + '1' + '">Wałbrzych</a></p>'
                         }).appendTo(gradient_addons);


                         li_min.animate({left: '0%'});
                         li_teryt.animate({left: '50%'});
                         li_max.animate({left: '100%'});

                         */

                        var li_teryt = jQuery('<li/>', {
                            html: '<p><a href="/dane/gminy/' + '1' + '">Kraków</a></p>',
                            class: '_teryt'
                        }).appendTo(gradient_addons);

                        li_teryt.animate({left: '50%'});


                    }

                });

            }
            return false;
        }
    });

});