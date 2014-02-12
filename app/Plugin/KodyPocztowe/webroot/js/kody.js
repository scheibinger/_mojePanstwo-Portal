(function ($) {
    var autocomplete = $("#cityv"),
        cache = {};

    autocomplete.autocomplete({
        minLength: 2,
        source: function (request, response) {
            var term = request.term;
            if (term in cache) {
                response(cache[ term ]);
                return;
            }
            $('#_mojePanstwoCockpit').addClass('loading');
            $.getJSON("/kody_pocztowe/adres.json?q=" + request.term, function (data, status, xhr) {
                $('#_mojePanstwoCockpit').removeClass('loading');
                var results = $.map(data.search, function (item) {
                    return {
                        label: item.text,
                        value: item.id
                    }
                });
                cache[ term ] = results;
                response(results);
            });
        },
        focus: function (event, ui) {
            autocomplete.val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            autocomplete.val(ui.item.label);
            window.location = '/kody_pocztowe/adres/' + ui.item.value;
            return false;
        }
    });

    autocomplete.parents('form').on('submit', function (e) {
        e.preventDefault();

        window.location = '/kody_pocztowe/adres/' + $(this).find('.input.text > span').text();
    })
}(jQuery));
