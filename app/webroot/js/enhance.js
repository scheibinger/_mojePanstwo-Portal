/* SCRIPT FIX IMG WITH BROKEN LINKS */
function imgFixer(img) {
    var style = window.getComputedStyle(img),
        maxWidth = style.getPropertyValue('max-width'),
        size = (img.offsetWidth == 0) ? ((maxWidth == "") ? 100 : parseInt(maxWidth)) : img.offsetWidth,
        imgBlankSrc = img.src,
        imgBlankSetting = "/fff/ddd";

    /*IMG LINK TO DOCUMENT - SO WE GENERATE RECTANGLE*/
    if (imgBlankSrc.toLowerCase().indexOf("docs.sejmometr") >= 0) {
        /*WE TRY SIMILAR NEW IMAGE TO DOCUMENTS*/
        img.style.border = "2px solid #ddd";
        /*LINK WITH DOCUMENT TEXT*/
        imgBlankSrc = "http://placehold.it/" + size + "x" + Math.ceil(Number(size * 1.32)) + imgBlankSetting + "&text=document";
    }/*IMG LINK TO AVATAR - SO WE GENERATE SQUARE*/
    else if (imgBlankSrc.toLowerCase().indexOf("resources.sejmometr") >= 0) {
        /*LINK WITH AVATAR TEXT*/
        imgBlankSrc = "http://placehold.it/" + size + imgBlankSetting + "&text=avatar";
    }/*IMG LINK TO OTHERS - SO WE GENERATE SQUARE TOO*/
    else {
        /*LINK WITH ERROR TEXT*/
        imgBlankSrc = "http://placehold.it/" + size + imgBlankSetting + "&text=error";
    }

    /*REMOVE ONERROR FUNCTION - CAUSE WE USE IT ALREADY*/
    img.onerror = "";
    /*CLEAR SRC SO CHROME WILL NOW STOP AT ONE IMAGE*/
    img.setAttribute('src', null);
    /*AND INSTERT NEW SRC*/
    img.src = imgBlankSrc;

    if (typeof countDataObjectsSliderRowDetect != 'undefined' && countDataObjectsSliderRowDetect == true)
        countDataObjectsSliderRow();

    return true;
}
/**/
trimTitle = function () {
    jQuery('.trimTitle').each(function () {
        var that = jQuery(this),
            body = that.html(),
            title = (that.attr('title') != undefined && that.attr('title') != '') ? that.attr('title') : ((that.data('trimtitle') != undefined && that.data('trimtitle') != '') ? that.data('trimtitle') : false),
            trimLength = that.data('trimlength');

        if (title != false && trimLength != undefined) {
            if (body.length > trimLength + 20) {
                var splitLocation = body.indexOf(' ', trimLength),
                    shortTitle = false;

                if (splitLocation != -1) {
                    splitLocation = body.indexOf(' ', trimLength);
                    shortTitle = body.substring(0, splitLocation);
                    that.html(shortTitle + '...');
                    that.data('trimtitle', title);

                    that.click(function () {
                        jQuery(this).html(jQuery(this).data('trimtitle'));
                    });
                }
            }
        }
    })
};

/* JQUERY - STICK ELEMENT AT SCROLL */
sticky = function (dom, direction) {
    if (jQuery(dom).length) {
        if (direction == undefined)
            direction = 'down';

        stickyGo(dom, direction);

        jQuery(window).scroll(function () {
            stickyGo(dom, direction);
        });
    }
};

stickyGo = function (dom, direction) {
    var anchor = jQuery('.anchor'),
        exist = false;

    jQuery.each(anchor, function () {
        if (jQuery(this).attr('data-id') == dom)
            exist = true;
    });

    if (exist == false)
        jQuery('<div class="anchor" data-id=' + dom + '></div>').insertBefore(dom);

    var stickGoAnchor = jQuery('.anchor[data-id=' + dom + ']'),
        window_top = jQuery(window).scrollTop(),
        header_fixed = jQuery('header').outerHeight(true),
        window_height = jQuery(window).height(),
        div_top = stickGoAnchor.offset().top;

    if (window_top + header_fixed > div_top && direction == 'down') {
        jQuery(dom).addClass('stick');
    } else if ((window_top + header_fixed + window_height - jQuery(dom).outerHeight()) < div_top && direction == 'up') {
        jQuery(dom).addClass('stick');
    } else {
        jQuery(dom).removeClass('stick');
    }
};