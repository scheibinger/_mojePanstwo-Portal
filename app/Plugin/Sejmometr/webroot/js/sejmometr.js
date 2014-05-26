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

        $(window).on('DATAREADY', function () {
            var vcoNavigation = jQuery('.vco-navigation');

            vcoNavigation.on("UPDATE", function () {
                if (window.timelinejs_current_slide !== null)
                    prepare_slide(window.timelinejs_current_slide);
            });

            vcoNavigation.on("LOADED", function () {
                if (window.timelinejs_current_slide !== null)
                    prepare_slide(window.timelinejs_current_slide);
            });

        });
    }

    graphPoslankiPoslowie();
});

function prepare_slide(current_slide) {
    var slide_div = jQuery('.slider-item-container').children()[ current_slide ];
    /*if (!(slide_div.hasClass('prepared'))) {
     slide_div.addClass('prepared');

     var title_element = jQuery(jQuery('.slider-item-container').children()[63]).find('h3');
     var title_element_text = title_element.text();

     if (title_element_text[0] == '#') {
     // podmieniamy tytuł
     }
     }*/
}

function graphPoslankiPoslowie() {
    jQuery('#sejmometr').find('.poslowieGraphCircle li > .graph .graphInner').each(function () {
        var that = jQuery(this);
        that.highcharts({
            debug: true,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ' '
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            series: [
                {
                    type: 'pie',
                    name: 'Ilość[%]:',
                    data: that.data('setup'),
                    innerSize: '40%'
                }
            ]
        });
    });
}