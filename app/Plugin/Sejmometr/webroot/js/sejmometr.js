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

jQuery(document).ready(function () {
    var $sideMenu = $('.sideMenu > ul'),
        ajaxQueue = jQuery({});

    $sideMenu.css('width', $sideMenu.width()).affix({
        offset: {
            top: function () {
                return this.top = Math.floor($('.sideMenu').position().top) - $('header').outerHeight(true);
            }
        }
    });

    graphPoslankiPoslowie();

    jQuery.ajaxQueue = function (ajaxOpts) {
        var oldComplete = ajaxOpts.complete;

        ajaxQueue.queue(function (next) {
            ajaxOpts.complete = function () {
                if (oldComplete) {
                    oldComplete.apply(this, arguments);
                }
                next();
            };
            jQuery.ajax(ajaxOpts);
        });
    };
});