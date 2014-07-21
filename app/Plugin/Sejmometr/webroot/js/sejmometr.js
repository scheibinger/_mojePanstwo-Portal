function graphPoslankiPoslowie() {
    jQuery('#sejmometr').find('.poslowieGraphCircle li > .graph .graphInner').each(function () {
        var that = jQuery(this);
        that.highcharts({
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
        }, function (chart) {
            var img = new Image();
            img.src = that.data('logo');

            var imgWidthCheck = (img.width > Math.floor(that.width() * .4)) ? img.width - Math.floor(that.width() * .4) + 10 : 0;
            var imgHeightCheck = (img.height > Math.floor(that.height() * .4)) ? img.height - Math.floor(that.height() * .4) + 10 : 0;
            var imgResize = (imgWidthCheck > imgHeightCheck) ? imgWidthCheck : imgHeightCheck;

            chart.renderer.image(that.data('logo'), (that.width() / 2) - ((img.width - imgResize) / 2), (that.height() / 2) - ((img.height - imgResize) / 2), (img.width - imgResize), (img.height - imgResize)).add();
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

    $('body').scrollspy({ target: '.sideMenu' })


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