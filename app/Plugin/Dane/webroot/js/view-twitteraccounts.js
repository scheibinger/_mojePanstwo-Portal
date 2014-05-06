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

    console.log(dataMonth);
    console.log(dataFollowers);

    $followers.highcharts({
        chart: {
            type: 'column'
        },
        xAxis: {
            categories: dataMonth
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