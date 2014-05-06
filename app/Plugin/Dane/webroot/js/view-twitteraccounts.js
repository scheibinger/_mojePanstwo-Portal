jQuery(document).ready(function () {
    var $followers = $('.followers'),
        dataJSON = $followers.data('json'),
        dataMonth = [],
        dataFollowers = [],
        dataFollowersMin = Number(dataJSON[0].count);

    $.each(dataJSON, function (index, data) {
        dataMonth.push(data.date);
        dataFollowers.push(Number(data.count));
        if (dataFollowersMin > Number(data.count))
            dataFollowersMin = Number(data.count)
    });

    $followers.highcharts({
        chart: {
            type: 'column'
        }, /*
         legend: {
         enabled: false
         },*/
        xAxis: {
            categories: dataMonth,
            labels: {
                rotation: 270,
                x: 4,
                y: 16
            },
            tickmarkPlacement: 'on'
        },
        yAxis: {
            min: dataFollowersMin,
            title: {
                text: 'Liczba obserwujących osób'
            }
        },
        title: {
            text: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Obserwujący',
                data: dataFollowers
            }
        ]
    });
});