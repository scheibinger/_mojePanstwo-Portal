jQuery(document).ready(function () {
    var main = jQuery('#bdl-wskazniki'),
        wskaznikiString = '';

    main.find('.wskaznik').each(function () {
        if (wskaznikiString != '')
            wskaznikiString += ',';
        wskaznikiString += jQuery(this).data('dim_id');
    });

    jQuery.ajax({
        url: "/dane/bdl_wskazniki/chart_data_for_dimmensions.json?dims=" + wskaznikiString,
        type: "POST",
        dataType: "json",
        beforeSend: function () {
            jQuery('.wskaznik .chart .progress-bar').attr('aria-valuenow', '45').css('width', '45%');
        },
        complete: function (res) {
            var data = res.responseJSON.data;

            jQuery('.wskaznik .chart .progress-bar').attr('aria-valuenow', '80').css('width', '80%');
            jQuery.each(data, function () {
                var chart = this,
                    label = [],
                    value = [];

                jQuery.each(chart.data, function () {
                    label.push(this.y);
                    value.push(Number(this.v));
                });

                jQuery('.wskaznik[data-dim_id="' + chart.id + '"]').find('.chart').highcharts({
                    title: {
                        text: ''
                    },
                    credits: {
                        enabled: false
                    },
                    xAxis: {
                        categories: label
                    },
                    yAxis: {
                        title: ''
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        enabled: false,
                        align: 'left'
                    },
                    series: [
                        {
                            name: "Wartość",
                            data: value
                        }
                    ]
                });
            })
        }
    })
});