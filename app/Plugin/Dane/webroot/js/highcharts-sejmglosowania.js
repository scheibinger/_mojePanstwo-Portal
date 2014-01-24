var highchartInit = function () {
    var __charts_colors = {
        'z': '#109618',
        'p': '#DC3912',
        'w': '#3366CC',
        'n': '#DDDDDD'
    };

    /*RUN HIGHCHART FUNCTION ON EACH SPECIFY ELEMENT*/
    $('.highchart').each(function () {
        var data = $(this).data('wynikiklubowe');
        var series_data = [];

        for (var i = 0; i < data.length; i++) {
            var d = data[ i ];
            series_data.push({
                name: d['label'],
                y: Number(d['count']),
                color: __charts_colors[d['id']]
            });
        }

        /*HIGHCHART - CREATE CHART*/
        $(this).highcharts({
            credits: {
                enabled: false
            },
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                height: 140,
                width: 380,
                spacing: [0, 0, 0, 0],
                margin: [0, 0, 0, 0],
                style: {
                    padding: '0px',
                    margin: '0px'
                },
                animation: false
            },
            legend: {
                enabled: false,
                align: 'left'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '<b>{point.y}</b> <em>({point.percentage:.1f}%)</em>'
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        connectorColor: '#666666',
                        format: '<b>{point.name}</b>: {point.y}'
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%'],
                    allowPointSelect: true,
                    cursor: 'pointer',
                    size: '60%'
                }
            },

            series: [
                {
                    type: 'pie',
                    name: '',
                    innerSize: '30%',
                    data: series_data
                }
            ]
        });
    });
};

(function () {
    highchartInit();
})();
