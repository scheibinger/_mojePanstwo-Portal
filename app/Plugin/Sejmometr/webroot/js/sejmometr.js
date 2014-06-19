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
    graphPoslankiPoslowie();
});

var ajaxQueue = jQuery({});

jQuery.ajaxQueue = function (ajaxOpts) {

    // Hold the original complete function.
    var oldComplete = ajaxOpts.complete;

    // Queue our ajax request.
    ajaxQueue.queue(function (next) {

        // Create a complete callback to fire the next event in the queue.
        ajaxOpts.complete = function () {

            // Fire the original complete if it was there.
            if (oldComplete) {
                oldComplete.apply(this, arguments);
            }

            // Run the next query in the queue.
            next();
        };

        // Run the query.
        jQuery.ajax(ajaxOpts);

    });

};