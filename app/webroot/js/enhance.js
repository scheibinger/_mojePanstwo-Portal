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
            }

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
            }

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

/* SCRIPT FIX IMG WITH BROKEN LINKS */
function imgFixer(img) {
    var style = window.getComputedStyle(img, null),
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
        window.setTimeout(countDataObjectsSliderRow, 0);

    return true;
}
/*FUNCTION CHECK IS ELEMENT IS VISIBLE AT SCREEN*/
function isElementVisibled(elem) {
    var docViewTop, docViewBottom, elemTop, elemBottom;

    docViewTop = jQuery(window).scrollTop();
    docViewBottom = docViewTop + jQuery(window).height();
    elemTop = jQuery(elem).offset().top;
    elemBottom = elemTop + jQuery(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
/*FUNCTION CUT TITLE TO SHORTER FORM WITH OPTION OF EXPANDING IT*/
trimTitle = function () {
    jQuery('.trimTitle').each(function () {
        var that = jQuery(this),
            body = jQuery.trim(that.text()),
            title = (that.attr('title') != undefined && that.attr('title') != '') ? that.attr('title') : ((that.data('trimtitle') != undefined && that.data('trimtitle') != '') ? that.data('trimtitle') : false),
            trimLength = ((that.data('trimlength') != undefined) ? that.data('trimlength') : 150);

        if (title != false && trimLength != undefined) {
            if (body.length > trimLength + 20) {
                var splitLocation = body.indexOf(' ', trimLength),
                    shortTitle = false,
                    hyperlink = (that.children().length > 0);

                if (splitLocation != -1) {
                    splitLocation = body.indexOf(' ', trimLength);
                    shortTitle = body.substring(0, splitLocation);
                    that.data('trimtitle', title);

                    if (hyperlink == true) { /*TARGET IS HYPERLINK*/
                        that.find('a').html(shortTitle).after('<span class="trimTitleTrigger">...</span>');

                        that.find('.trimTitleTrigger').click(function () {                      //             ^oo1^
                            that.find('a').html(that.data('trimtitle'));                        //            ++o1^+o111111+^
                            jQuery('.trimTitleTrigger').remove();                               //           1+^^^ oo^1NNNooo+^+^
                        });                                                                     //           o^^^^^^01+100+^o0110o+
                    } else { /*TARGET IS NORMAL TEXT */                                         //           ooo^^^^100oooo1o000NMM1
                        that.html(shortTitle + '<span class="trimTitleTrigger">...</span>');    //           11^^^^^+00000000000NMMMN1
                        that.click(function () {                                                //           ^1+^^^^^^100000MM0NMN0NMMM01^
                            that.html(jQuery(this).data('trimtitle'));                          //            oMo^^^^^ +11+1o0MMNNMMN00NMMM0^
                        });                                                                     //             1Mo+^^+^^^^^^^^+0M00MMMMMMNNNM0
                    }                                                                           //             oMMN1+^^^^^^+1oNMMNNMMMMMMMMNNM+
                }                                                                               //             ^MN^ ^^^^^^^^^100NNM0NMMMMMMMMNM1
            }                                                                                   //             NM^^^^^^^^^^^^^^^^10M+^+1oNMMMNMM
        }                                                                                       //             0+^^^^^^^^^^^^^^^^^+oo     +oMM0^
    });                                                                                         //             ^^^^^^^^^^^^^^^^^^^^+o       1NM^
};                                                                                              //            1^^^^^^^^^^^^^^^^^^^^^++        +
/* JQUERY - STICK ELEMENT AT SCROLL */                                                          //           ^o^^^^^^^^^^^^^^^^^^^^^^^
sticky = function (dom, direction) {                                                            //            o^^^^^^^^^^^^^^^^^^^^^^
    if (jQuery(dom).length) {                                                                   //            NN^^^^^^^^^^^^^ ^^^^^^^^
        if (direction == undefined)                                                             //           ^MN^^^^^^ ^^^^^ ^^^^^^^^1+
            direction = 'down';                                                                 //           1M+^^^^^^^^^^^^^^^^^^ ++oo+
        stickyGo(dom, direction);                                                               //           0+^^^^^^^^^^^^^^^^^^+10000o
        jQuery(window).scroll(function () {                                                     //          0+^^^^^^^^^^^^ ^^^+1o0000000o
            stickyGo(dom, direction);                                                           //         0o^^^^^^^^^^^^^^+1o000000000000^
        });                                                                                     //        1Mo^^^o0+^++^^^+o000oo00000o0000o^
    }                                                                                           //        oM0++1o1MNMo^+1o00000000000000000o
};                                                                                              //        0M0001^ 0MMo1000000000000o000ooo001
stickyGo = function (dom, direction) {                                                          //          o1+   1MM00000000000000o000000000^
    var anchor = jQuery('.anchor'),                                                             //                ^MMN000000000000000000000001
        exist = false;                                                                          //                 oMMN000000000000000000o0000
    jQuery.each(anchor, function () {                                                           //                 ^MMMMMN000000o0000000000000
        if (jQuery(this).attr('data-id') == dom)                                                //                  NMMMN000oo000000000oo000oo
            exist = true;                                                                       //                 +MMMNN00000oo00000000000o0o
    });                                                                                         //                 0MMMMN000000000000oo000000o
    if (exist == false)                                                                         //                 MMMMM00000000000000000NMMM^
        jQuery('<div class="anchor" data-id=' + dom + '></div>').insertBefore(dom);             //                 MMMMMN00000000000o00MMMMM01^^
    var stickGoAnchor = jQuery('.anchor[data-id=' + dom + ']'),                                 //                 oMMMMMMN00o000000000MMMNo^^^+^
        window_top = jQuery(window).scrollTop(),                                                //               ^^^^+1NMMMN00000000000MMM0+^^^^11
        header_fixed = jQuery('header').outerHeight(true),                                      //          ^1+^^^+o00o0MMMM000000oo00NNMNNo0++^1o
        window_height = jQuery(window).height(),                                                //          ^+^++^+^^      ^+1o000o001+^
        div_top = stickGoAnchor.offset().top;                                                   //                     ^^^^^^^oo00o0+
    if (window_top + header_fixed > div_top && direction == 'down') {                           //                   +01111+++1+++^^^
        jQuery(dom).addClass('stick');
    } else if ((window_top + header_fixed + window_height - jQuery(dom).outerHeight()) < div_top && direction == 'up') {
        jQuery(dom).addClass('stick');
    } else {
        jQuery(dom).removeClass('stick');
    }
};