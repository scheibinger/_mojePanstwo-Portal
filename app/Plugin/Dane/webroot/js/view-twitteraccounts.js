jQuery(document).ready(function () {
    var $followers = $('.followers'),
        dataJSON = $followers.data('json'),
        dataMonth = [],
        dataFollowers = [],
        dataFollowersMin = Number(dataJSON[0].count),
        $objectSideInner = $('.objectSideInner'),
        $showHideSide = $('.showHideSide');

    $.each(dataJSON, function (index, data) {
        dataMonth.push(data.date_str);
        dataFollowers.push(Number(data.count));
        if (dataFollowersMin > Number(data.count))
            dataFollowersMin = Number(data.count)
    });

    $followers.highcharts({
        chart: {
            type: 'line',
            height: 250,
            backgroundColor:'rgba(255, 255, 255, 0)'
        }, 
        legend: {
        	enabled: false
        },
        xAxis: {
            categories: dataMonth,
            labels: {
                rotation: 270,
                x: 4,
                y: 16
            },
            tickmarkPlacement: 'on',
        },
        yAxis: {
            min: dataFollowersMin,
            title: false
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
        credits: {
	    	enabled: false    
        },
        series: [
            {
                name: 'Obserwujący',
                data: dataFollowers
            }
        ]
    });

    $showHideSide.find('> a').click(function () {
        var that = $(this);
        $showHideSide.find('>a').removeClass('hide');
        that.addClass('hide');
        if (that.hasClass('a-more')) {
            $objectSideInner.find('.dataHighlights.hide').removeClass('hide').hide().addClass('unhide').slideDown();
        } else if (that.hasClass('a-less')) {
            $objectSideInner.find('.dataHighlights.unhide').slideUp(function () {
                $objectSideInner.find('.dataHighlights.unhide').removeClass('uhhide').addClass('hide');
            });
        }
    })
});