/* REDEFINE JQUERY UI DIALOG DEFAULT OPTIONS*/
jQuery.extend(jQuery.ui.dialog.prototype.options, {
    modal: true,
    resizable: false,
    draggable: false
});

(function ($) {
    /* JQUERY FUNCTION RETURNING SIZE/WIDTH/HEIGHT/ETC HIDDEN ELEMENTS */

    $.fn.addBack = $.fn.addBack || $.fn.andSelf;
    $.fn.extend({

        actual: function (method, options) {
            // check if the jQuery method exist
            if (!this[ method ]) {
                throw '$.actual => The jQuery method "' + method + '" you called does not exist';
            }

            var defaults = {
                absolute: false,
                clone: false,
                includeMargin: true
            };

            var configs = $.extend(defaults, options);

            var $target = this.eq(0);
            var fix, restore;

            if (configs.clone === true) {
                fix = function () {
                    var style = 'position: absolute !important; top: -1000 !important; ';

                    // this is useful with css3pie
                    $target = $target.
                        clone().
                        attr('style', style).
                        appendTo('body');
                };

                restore = function () {
                    // remove DOM element after getting the width
                    $target.remove();
                };
            } else {
                var tmp = [];
                var style = '';
                var $hidden;

                fix = function () {
                    // get all hidden parents
                    $hidden = $target.parents().addBack().filter(':hidden');
                    style += 'visibility: hidden !important; display: block !important; ';

                    if (configs.absolute === true) style += 'position: absolute !important; ';

                    // save the origin style props
                    // set the hidden el css to be got the actual value later
                    $hidden.each(function () {
                        var $this = $(this);

                        // Save original style. If no style was set, attr() returns undefined
                        tmp.push($this.attr('style'));
                        $this.attr('style', style);
                    });
                };

                restore = function () {
                    // restore origin style values
                    $hidden.each(function (i) {
                        var $this = $(this);
                        var _tmp = tmp[ i ];

                        if (_tmp === undefined) {
                            $this.removeAttr('style');
                        } else {
                            $this.attr('style', _tmp);
                        }
                    });
                };
            }

            fix();
            // get the actual value with user specific methed
            // it can be 'width', 'height', 'outerWidth', 'innerWidth'... etc
            // configs.includeMargin only works for 'outerWidth' and 'outerHeight'
            var actual = /(outer)/.test(method) ?
                $target[ method ](configs.includeMargin) :
                $target[ method ]();

            restore();
            // IMPORTANT, this plugin only return the value of the first element
            return actual;
        }
    });

    /*TURN OFF CASE-SENSITIVE FOR CONTAINS PLUGIN IN JQUERY*/
    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toLowerCase().indexOf(arg.toLowerCase()) >= 0;
        };
    });
})(jQuery);

/* HTML5 HISTORY.JS */
(function (window) {
    // Prepare
    var History = window.History; // Note: We are using a capital H instead of a lower h
    if (!History.enabled) {
        // History.js is disabled for this browser.
        // This is because we can optionally choose to support HTML4 browsers or not.
        return false;
    }
})(window);

jQuery(function () {
    var carouselList;

    /* STOP ALL BOOTSTRAP CAROUSEL */
    if ((carouselList = jQuery('.carousel')).length > 0) {
        carouselList.each(function () {
            jQuery(this).carousel({
                interval: false
            });
        });
    }

    /* SETTING INFORMATION WITH RESOLUTION FOR PHP/JS */
    var sizeMarker = {
            'xs': {
                'max': 768
            },
            'sm': {
                'min': 768,
                'max': 992
            },
            'md': {
                'min': 992,
                'max': 1200
            },
            'lg': {
                'min': 1200
            }
        },
        checkSizeMarker = null,
        viewport = this.viewport = {
            width: jQuery(document).width(),
            height: jQuery(document).height()
        };

    jQuery.each(sizeMarker, function (key, value) {
        if (((value.min == undefined) ? true : viewport.width >= value.min) && ((value.max == undefined) ? true : viewport.width <= value.max))
            checkSizeMarker = key;
    });

    viewport.sizeMarker = checkSizeMarker;

    if ((jQuery.cookie('_mPViewport') == null) || (jQuery.cookie('_mPViewport') != checkSizeMarker)) {
        var rescaleOverlay = $('<div></div>').css({
                'position': 'fixed',
                'top': 0,
                'left': 0,
                'width': '100%',
                'height': '100%',
                'background': 'rgba(255,255,255,0.8)',
                'z-index': '9998'
            }),
            rescaleWindow = $('<div></div>').css({
                'position': 'fixed',
                'top': '50%',
                'left': '50%',
                'width': '40px',
                'height': '100px',
                'marginTop': '-20px',
                'marginLeft': '-50px',
                'z-index': '9999',
                'textAlign': 'center',
                'fontSize': '25px'
            }).text("Rescaling..."),
            _mPViewportReloadCookie = jQuery.cookie('_mPViewportReload'),
            _mPViewportReload = (_mPViewportReloadCookie == undefined || Number(_mPViewportReloadCookie) == "NaN" ) ? 1 : Number(_mPViewportReloadCookie) + 1;

        if (Number(_mPViewportReload) < 5) {
            jQuery.cookie('_mPViewport', checkSizeMarker, { expires: 365, path: '/' });
            jQuery.cookie('_mPViewportReload', _mPViewportReload, { expires: 1, path: '/' });

            $('body').append(rescaleOverlay).append(rescaleWindow);
            location.reload();
        } else {
            jQuery.cookie('_mPViewport', 'lg', { expires: 365, path: '/' });
            jQuery.removeCookie('_mPViewportReload');
        }
    } else {
        jQuery.removeCookie('_mPViewportReload');
    }

    /*JS SHORTER TITLE FUNCTION*/
    if (jQuery('.trimTitle').length > 0)
        trimTitle();
});