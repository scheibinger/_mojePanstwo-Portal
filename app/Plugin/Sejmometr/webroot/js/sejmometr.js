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

    if (jQuery('#sejm_projekty_chart').length > 0) {
        $.ajax({
            url: '/sejmometr/autorzy_projektow.json',
            type: 'GET',
            async: true,
            dataType: "json",
            success: function (data) {
                displayChart(data);
            }
        });
    }
});

var prepare_slide = function (current_slide) {
    var slide_div = jQuery('.slider-item-container').children()[ current_slide ];
    if (!slide_div.hasClass('prepared')) {
        slide_div.addClass('prepared');

        var title_element = jQuery(jQuery('.slider-item-container').children()[63]).find('h3');
        var title_element_text = title_element.text();

        if (title_element_text[0] == '#') {
            // podmieniamy tytuł
        }
    }
};

function displayChart(data) {
    var colors = Highcharts.getOptions().colors,
        mainData = {
            const: {
                name: 'Autorzy projektów w Sejmie',
                colors: Highcharts.getOptions().colors,
                total: 0
            },
            kategoriaData: [
                {
                    name: 'Poselskie',
                    count: 0,
                    color: colors[1]
                },
                {
                    name: 'Komisyjne',
                    count: 0,
                    color: colors[2]
                },
                {
                    name: 'Rządowe',
                    count: 0,
                    color: colors[3]
                },
                {
                    name: 'Inne',
                    count: 0,
                    color: colors[4]
                }
            ],
            autorzyRawData: {
                poselskie: [],
                komisyjne: [],
                rzadowe: [],
                inne: []
            },
            autorzyData: []
        };

    for (var i = 0; i < data.length; i++) {
        var brightness = 0.2 - (i / data.length) / 5,
            collectInnerData, collectOuterData;

        if (data[i].typ_id == '1') {
            collectInnerData = mainData.kategoriaData[0];
            collectOuterData = mainData.autorzyRawData.poselskie;
        } else if (data[i].typ_id == '2') {
            collectInnerData = mainData.kategoriaData[1];
            collectOuterData = mainData.autorzyRawData.komisyjne;
        } else if (data[i].typ_id == '3') {
            collectInnerData = mainData.kategoriaData[2];
            collectOuterData = mainData.autorzyRawData.rzadowe;
        } else if (data[i].typ_id == '4') {
            collectInnerData = mainData.kategoriaData[3];
            collectOuterData = mainData.autorzyRawData.inne;
        }

        mainData.const.total += Number(data[i].count);

        collectInnerData.count += Number(data[i].count);

        collectOuterData.push({
            name: data[i].nazwa,
            count: Number(data[i].count),
            color: Highcharts.Color(collectInnerData.color).brighten(brightness).get()
        });
    }

    for (var j = 0; j < mainData.kategoriaData.length; j++) {
        mainData.kategoriaData[j].y = Math.round(((mainData.kategoriaData[j].count / mainData.const.total) * 100) * 100) / 100;
    }

    jQuery.each(mainData.autorzyRawData, function () {
        for (var k = 0; k < this.length; k++) {
            mainData.autorzyData.push({
                name: this[k].name,
                count: this[k].count,
                y: Math.round(((this[k].count / mainData.const.total) * 100) * 100) / 100,
                color: this[k].color
            });
        }
    });

    jQuery('#sejm_projekty_chart').highcharts({
        chart: {
            type: 'pie',
            height: 500
        },
        title: {
            text: mainData.const.name
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            pointFormat: 'Ilość projektów: <b>{point.count}</b>'
        },
        series: [
            {
                name: 'Kategoria',
                data: mainData.kategoriaData,
                size: '60%',
                dataLabels: {
                    formatter: function () {
                        return this.y > 5 ? this.point.name : null;
                    },
                    color: 'white',
                    distance: -50
                }
            },
            {
                name: 'Autorzy',
                data: mainData.autorzyData,
                size: '80%',
                innerSize: '60%',
                dataLabels: {
                    formatter: function () {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.point.count : null;
                    }
                }

            }
        ]
    });
};