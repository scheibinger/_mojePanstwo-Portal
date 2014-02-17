(function ($) {
    var dataContent = $('.dataContent'),
        newNotification = dataContent.find('.objects .powiadomienia'),
        checkTime = 3000;

    if (newNotification.find('.objectRender').length > 0) {
        var intervalMain = setInterval(function () {

            $.each(newNotification.find('.objectRender:not(.readed)'), function () {
                var newNotify = $(this);

                if (isElementVisibled(this)) {
                    /*RUN FUNCTION AT SEEN EACH ELEMENTS*/

                    $.ajax({
                        type: "GET",
                        url: '/powiadomienia/flagObjects.json?mode=powiadomienia&action=read&oid=' + newNotify.attr('oid'),
                        success: function (data) {
                            /*MARK SEEN ELEMENT AS READED TO NOT TRIGGER FUNCTION AGAIN AT SAME ELEMENT*/
                            if (data.status == "OK")
                                newNotify.addClass('readed');
                        },
                        error: function () {
                            var dataCount = (newNotify.data('count')) ? newNotify.data('count') + 1 : 1;

                            newNotify.data('count', dataCount);

                            if (newNotify.data('count') > 4)
                                newNotify.addClass('readed');
                        }

                    });
                }
            });

            /*IS ALL ELEMENTS ARE READED - STOP FUNCTION*/
            if (newNotification.find('.objectRender:not(.readed)').length == 0)
                clearInterval(intervalMain);
        }, checkTime);
    }
}(jQuery));