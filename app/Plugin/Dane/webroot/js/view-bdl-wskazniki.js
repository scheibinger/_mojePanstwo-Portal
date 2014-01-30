jQuery(document).ready(function () {
    var main = jQuery('#bdl-wskazniki'),
        wskazniki = main.find('.wskaznik'),
        wskaznikiStatic = main.find('.wskaznikStatic'),
        wskaznikiString = '';

    wskazniki.each(function () {
        if (wskaznikiString != '')
            wskaznikiString += ',';
        wskaznikiString += jQuery(this).data('dim_id');
    });

    jQuery.ajax({
        url: "/dane/bdl_wskazniki/chart_data_for_dimmensions.json?dims=" + wskaznikiString,
        type: "POST",
        dataType: "json",
        beforeSend: function () {
            wskazniki.find('.chart .progress-bar').attr('aria-valuenow', '45').css('width', '45%');
        },
        always: function () {
            wskazniki.find('.chart .progress-bar').attr('aria-valuenow', '80').css('width', '80%');
        },
        complete: function (res) {
            var data = res.responseJSON.data;

            jQuery.each(data, function () {
                var chart = this,
                    wskaznik = jQuery('.wskaznik[data-dim_id="' + chart.id + '"]').find('.chart'),
                    wskaznikBackground = (wskaznik.data('chart-background') != undefined) ? wskaznik.data('chart-background') : '#FFFFFF',
                    label = [],
                    value = [];

                jQuery.each(chart.data, function () {
                    label.push(this.y);
                    value.push(Number(this.v));
                });

                wskaznik.highcharts({
                    title: {
                        text: ''
                    },
                    chart: {
                        backgroundColor: wskaznikBackground
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
    });

    if (wskaznikiStatic.length > 0) {
        /*jQuery.each(wskaznikiStatic, function () {
         var wskaznik = jQuery(this).find('.chart'),
                chart = wskaznik.data('chart-datas'),
                label = [],
                value = [];

            jQuery.each(chart, function () {
                label.push(this['rocznik']);
                value.push(Number(this['v']));
            });

            wskaznik.highcharts({
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
         })*/
    }
});