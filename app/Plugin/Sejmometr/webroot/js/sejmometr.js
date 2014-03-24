jQuery(document).ready(function () {
    if ((timelineEmbed = jQuery("#timeline-embed")).length > 0) {
        createStoryJS({
            start_at_end: true,
            width: "100%",
            height: '500',
            source: '/sejmometr/posiedzenia_timeline.json',
            embed_id: 'timeline-embed',
            css: '/plugins/TimelineJS/build/css/timeline-2rows.css',
            js: '/plugins/TimelineJS/build/js/timeline-2rows.js',
            lang: _mPHeart.language.twoDig
        });
    }
});



$(document).ready(function() {
	$.ajax({
		url: '/sejmometr/autorzy_projektow.json',
		type: 'GET',
		async: true,
		dataType: "json",
		success: function (data) {
			console.log('gotData', data);
			displayChart(data);
		}
	});
});


function displayChart(data) {
    
    var colors = Highcharts.getOptions().colors,
        categories = ['MSIE', 'Firefox', 'Chrome'],
        name = 'Browser brands';


    // Build the data arrays
    var browserData = [];
    var versionsData = [];
    for (var i = 0; i < data.length; i++) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        for (var j = 0; j < data[i].drilldown.data.length; j++) {
            var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    // Create the chart
    $('#sejm_projekty_chart').highcharts({
        chart: {
            type: 'pie',
            height: 500
        },
        title: {
            text: ''
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
    	    valueSuffix: '%'
        },
        series: [{
            name: 'Browsers',
            data: browserData,
            size: '60%',
            dataLabels: {
                formatter: function() {
                    return this.y > 5 ? this.point.name : null;
                },
                color: 'white',
                distance: -30
            }
        }, {
            name: 'Versions',
            data: versionsData,
            size: '80%',
            innerSize: '60%',
            dataLabels: {
                formatter: function() {
                    // display only if larger than 1
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;
                }
            }
        }]
    });
};