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

/* REDEFINE JQUERY UI DIALOG DEFAULT OPTIONS*/
jQuery.extend(jQuery.ui.dialog.prototype.options, {
    modal: true,
    resizable: false,
    draggable: false
});


(function ($) {
    Class = {
        create: function () {
            //figure out if we're creating a static or dynamic class
            var s = (arguments.length > 0 && //if we have arguments...
                arguments[arguments.length - 1].constructor == Boolean) ? //...and the last one is Boolean...
                arguments[arguments.length - 1] : //...then it's the static flag...
                false; //...otherwise default to a dynamic class

            //static: Object, dynamic: Function
            var c = s ? {} : function () {
                this.init.apply(this, arguments);
            };

            //all of our classes have these in common
            var methods = {
                //a basic namespace container to pass objects through
                ns: [],

                //a container to hold one level of overwritten methods
                supers: {},

                //a constructor
                init: function () {
                },

                //our namespace function
                namespace: function (ns) {
                    //don't add nothing
                    if (!ns) return null;

                    //closures are neat
                    var _this = this;

                    //handle ['ns1', 'ns2'... 'nsN'] format
                    if (ns.constructor == Array) {
                        //call namespace normally for each array item...
                        $.each(ns, function () {
                            _this.namespace.apply(_this, [this]);
                        });

                        //...then get out of this call to namespace
                        return;

                        //handle {'ns': contents} format
                    } else if (ns.constructor == Object) {
                        //loop through the object passed to namespace
                        for (var key in ns) {
                            //only operate on vanilla Objects and Functions
                            if ([Object, Function].indexOf(ns[key].constructor) > -1) {
                                //in case this.ns has been deleted
                                if (!this.ns) this.ns = [];

                                //copy the namespace into an array holder
                                this.ns[key] = ns[key];

                                //apply namespace, this will be caught by the ['ns1', 'ns2'... 'nsN'] format above
                                this.namespace.apply(this, [key]);
                            }
                        }

                        //we're done with namespace for now
                        return;
                    }

                    //note: [{'ns': contents}, {'ns2': contents2}... {'nsN': contentsN}] is inherently handled by the above two cases

                    var levels = ns.split(".");

                    //if init && constructor == Object or Function
                    var nsobj = this.prototype ? this.prototype : this;

                    $.each(levels, function () {
                        /* When adding a namespace check to see, in order:
                         * 1) does the ns exist in our ns passthrough object?
                         * 2) does the ns already exist in our class
                         * 3) does the ns exist as a global var?
                         * NOTE: support for this was added so that you can namespace classes
                         into other classes, i.e. MyContainer.namespace('MyUtilClass'). this
                         behaviour is dangerously greedy though, so it may be removed.
                         * 4) if none of the above, make a new static class
                         */
                        nsobj[this] = _this.ns[this] || nsobj[this] || window[this] || Class.create(true);

                        //remove our temp passthrough if it exists
                        delete _this.ns[this];

                        //move one level deeper for the next iteration
                        nsobj = nsobj[this];
                    });

                    //TODO: do we really need to return this? it's not that useful anymore
                    return nsobj;
                },

                /* create exists inside classes too. neat huh?
                 usage differs slightly: MyClass.create('MySubClass', { myMethod: function() }); */
                create: function () {
                    //turn arguments into a regular Array
                    var args = Array.prototype.slice.call(arguments);

                    //pull the name of the new class out
                    var name = args.shift();

                    //create a new class with the rest of the arguments
                    var temp = Class.create.apply(Class, args);

                    //load our new class into the {name: class} format to pass it into namespace()
                    var ns = {};
                    ns[name] = temp;

                    //put the new class into the current one
                    this.namespace(ns);
                },

                //call the super of a method
                sup: function () {
                    try {
                        var caller = this.sup.caller.name;
                        this.supers[caller].apply(this, arguments);
                    } catch (noSuper) {
                        return false;
                    }
                }
            };

            //static: doesn't need a constructor
            s ? delete methods.init : null;

            //put default stuff in the thing before the other stuff
            $.extend(c, methods);

            //double copy methods for dynamic classes
            //they get our common utils in their class definition AND their prototype
            if (!s) $.extend(c.prototype, methods);

            //static: extend the Object, dynamic: extend the prototype
            var extendee = s ? c : c.prototype;

            //loop through arguments. if they're the right type, tack them on
            $.each(arguments, function () {
                //either we're passing in an object full of methods, or the prototype of an existing class
                if (this.constructor == Object || typeof this.init != undefined) {
                    /* here we're going per-property instead of doing $.extend(extendee, this) so that
                     we overwrite each property instead of the whole namespace. also: we omit the 'namespace'
                     helper method that Class tacks on, as there's no point in storing it as a super */
                    for (i in this) {
                        /* if a property is a function (other than our built-in helpers) and it already exists
                         in the class, save it as a super. note that this only saves the last occurrence */
                        if (extendee[i] && extendee[i].constructor == Function && ['namespace', 'create', 'sup'].indexOf(i) == -1) {
                            //since Function.name is almost never set for us, do it manually
                            this[i].name = extendee[i].name = i;

                            //throw the existing function into this.supers before it's overwritten
                            extendee.supers[i] = extendee[i];
                        }

                        //extend the current property into our class
                        extendee[i] = this[i];
                    }
                }
            });

            //shiny new class, ready to go
            return c;
        }
    };
})(jQuery);

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

(function ($) {
    var carouselList,
        modalPaszportLoginForm,
        selectPickers;

    /* STOP ALL BOOTSTRAP CAROUSEL */
    if ((carouselList = $('.carousel')).length > 0) {
        carouselList.each(function () {
            $(this).carousel({
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
        _mPviewport = {
            width: $(document).width(),
            height: $(document).height()
        };

    $.each(sizeMarker, function (key, value) {
        if (((value.min == undefined) ? true : _mPviewport.width >= value.min) && ((value.max == undefined) ? true : _mPviewport.width <= value.max))
            checkSizeMarker = key;
    });

    _mPviewport.sizeMarker = checkSizeMarker;

    /*HACK FOR BETA LOGO CHANGE*/
    if ($.cookie('_mPFirstTime') == null)
        $.cookie('_mPFirstTime', 1);

    if (($.cookie('_mPViewport') == null) || ($.cookie('_mPViewport') != checkSizeMarker)) {
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
            _mPViewportReloadCookie = $.cookie('_mPViewportReload'),
            _mPViewportReload = (_mPViewportReloadCookie == undefined || Number(_mPViewportReloadCookie) == "NaN" ) ? 1 : Number(_mPViewportReloadCookie) + 1;

        $.cookie('_mPViewportCookieAvailable', 'true');
        var cookieAvailable = $.cookie('_mPViewportCookieAvailable');

        if (Number(_mPViewportReload) < 5 && cookieAvailable == 'true') {
            $.cookie('_mPViewport', checkSizeMarker, { expires: 365, path: '/' });
            $.cookie('_mPViewportReload', _mPViewportReload, { expires: 1, path: '/' });

            $('body').append(rescaleOverlay).append(rescaleWindow);
            if (cookieAvailable == 'true')
                location.reload();
        } else {
            $.cookie('_mPViewport', 'lg', { expires: 365, path: '/' });
            $.removeCookie('_mPViewportReload');
            $.removeCookie('_mPViewportCookieAvailable');
        }
    } else {
        $.removeCookie('_mPViewportReload');
        $.removeCookie('_mPViewportCookieAvailable');
    }

    /*COOKIE LAW*/
    var cookieLaw,
        cookieLawStart = ($(window).scrollTop() + 40) - ($(document).height() - $(window).height()) - 1;

    if ((cookieLaw = $('.cookieLaw')).length > 0) {
        cookieLaw.css('bottom', (cookieLawStart >= 0 ? cookieLawStart : 0));

        $(window).scroll(function () {
            if ($(window).scrollTop() + 40 > $(document).height() - $(window).height()) {
                cookieLaw.css('bottom', ($(window).scrollTop() + 40) - ($(document).height() - $(window).height()) - 1);
            } else {
                cookieLaw.css('bottom', 0);
            }
        });
        cookieLaw.find('.btn').click(function () {
            cookieLaw.animate({
                bottom: '-100px',
                right: '-100px'
            }, function () {
                cookieLaw.remove();
                $.cookie('_mPCookieLaw', 1);
            });
        })
    }

    /*JS SHORTER TITLE FUNCTION*/
    if ($('.trimTitle').length > 0)
        trimTitle();

    /*GLOBAL MODAL FOR LOGIN VIA PASZPORT PLUGIN*/
    if ((modalPaszportLoginForm = $('#modalPaszportLoginForm')).length > 0) {
        $('#_mojePanstwoCockpit').find('a._mojePanstwoCockpitPowerButton._mojePanstwoCockpitIcons-login').click(function (e) {
            e.preventDefault();
            modalPaszportLoginForm.modal('show');
        });
        /*SPECIAL CLASS TO POP UP LOGIN BUTTON FOR SPECIAL CASE*/
        $('._specialCaseLoginButton').click(function (e) {
            e.preventDefault();
            modalPaszportLoginForm.modal('show');
        });
    }

    /*GLOBAL BOOTSTRAP-SELECT FORM SELECTPICKER CLASS*/
    if ((selectPickers = $('.selectpicker')).length > 0)
        selectPickers.selectpicker();

    /*FACEBOOK API - ONLY WHEN DIV ID:FB-ROOT EXIST*/
    if ($('#fb-root').length > 0 && $('#facebook-jssdk').length == 0) {
        var js = document.createElement("script"),
            fjs = document.getElementsByTagName("script")[0];

        if (document.getElementById("facebook-jssdk")) {
            return;
        }

        js.id = "facebook-jssdk";

        if (_mPHeart.language.twoDig == 'pl')
            js.src = "//connect.facebook.net/pl_PL/all.js";
        else {
            js.src = "//connect.facebook.net/en_US/all.js";
        }

        fjs.parentNode.insertBefore(js, fjs);

        window.fbAsyncInit = function () {
            FB.init({
                "appId": _mPHeart.social.facebook.id,
                "status": true,
                "cookie": true,
                "oauth": true,
                "xfbml": true
            });
            FB.Canvas.setSize();
            FBApiInit = true;
        };
    }
})(jQuery);