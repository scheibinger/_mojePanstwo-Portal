(function ($) {
    var dataContent = $('.dataContent'),
        newNotification = dataContent.find('.objects .powiadomienia'),
        checkTime = 3000,
        newNotificationIntervalMain;

    function optionsMarkAsRead() {
        if (newNotification.find('.objectRender').length > 0 && $('.additionalOptions .markReadAfterThreeSec input').is(':checked')) {
            newNotificationIntervalMain = setInterval(function () {
                $.each(newNotification.find('.objectRender:not(.readed)'), function () {
                    var newNotify = $(this);

                    if (isElementVisibled(this)) {
                        /*RUN FUNCTION AT SEEN EACH ELEMENTS*/
                        $.ajax({
                            type: "GET",
                            url: '/powiadomienia/flagObjects.json?mode=powiadomienia&action=read&id=' + newNotify.attr('gid'),
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
                    clearInterval(newNotificationIntervalMain);
            }, checkTime);
        }
    }

    if (jQuery('.loadMoreContent').length) {
        var loadMoreContentIntervalRunable = true,
            loadMoreContent = jQuery('.dataContent .loadMoreContent'),
            showData = jQuery('.dataContent .powiadomienia'),
            loadMoreContentIntervalMain = null;

        loadMoreContentIntervalMain = setInterval(function () {
            if (isElementVisibled('.loadMoreContent') && loadMoreContentIntervalRunable) {
                var page = Number(loadMoreContent.data('currentpage')) + 1;
                loadMoreContentIntervalRunable = false;

                jQuery.ajax({
                    type: "GET",
                    url: "powiadomienia/powiadomienia.json?page=" + page,
                    beforeSend: function () {
                        loadMoreContent.addClass('loading');
                    },
                    success: function (data) {
                        loadMoreContent.removeClass('loading');
                        if (data.html) {
                            loadMoreContent.data('currentpage', page);
                            showData.append(data.html);
                            loadMoreContentIntervalRunable = true;
                        } else {
                            clearInterval(loadMoreContentIntervalMain);
                            loadMoreContent.remove();
                        }
                    },
                    complete: function () {
                        loadMoreContent.removeClass('loading');
                    }
                });
            }

        }, 1500);
    }

    $('.additionalOptions .markReadAfterThreeSec').change(function () {
        if ($(this).find('input').is(':checked')) {
            optionsMarkAsRead();
        } else {
            clearInterval(newNotificationIntervalMain);
        }
    });

    optionsMarkAsRead();
}(jQuery));