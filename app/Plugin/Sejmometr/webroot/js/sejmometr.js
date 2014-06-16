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

var ajaxQueue = $({});

$.ajaxQueue = function (ajaxOpts) {

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
        $.ajax(ajaxOpts);

    });

};

function detailBlocks() {

    $(".detailBlock").each(function (idx) {

        // Queue up an ajax request.
        $.ajaxQueue({
            url: "/sejmometr/detailBlock.json",
            data: {
                id: $(this).attr('id')
            },
            // dataType: 'json',
            type: "GET",
            success: function (data) {

                console.log('success', $('.detailBlock[id=' + data.id + ']'));
                $('.detailBlock[id=' + data.id + ']').find('ul').removeClass('loading').html(data.html);

            }
        });

    });

}