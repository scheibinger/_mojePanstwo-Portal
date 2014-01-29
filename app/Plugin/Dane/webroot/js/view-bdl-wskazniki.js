jQuery(document).ready(function () {
    var main = jQuery('#bdl-wskazniki'),
        wskaznikiString = '';

    main.find('.wskaznik').each(function () {
        if (wskaznikiString != '')
            wskaznikiString += ';';
        wskaznikiString += jQuery(this).data('dim');
    });

    jQuery.ajax({
        url: "/date_for_dimmensions.json",
        type: "POST",
        data: { dim: wskaznikiString },
        dataType: "json",
        complete: function (data) {
            console.log(data);
        }
    })
});