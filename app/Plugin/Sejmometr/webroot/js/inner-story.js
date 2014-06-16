var infoController;

jQuery(function ($) {
    var
        $window = $(window),
        $html = $('html'),
        $body = $('body'),
        $htmlBody = $('html, body'),
        $header = $body.find('header'),

        $story = $('#storyLine'),
        $far = $story.find('.far'),
        $medium = $story.find('.medium'),
        $near = $story.find('.near'),

        minScreenWidth = 1204,
        screenWidth = ($body.innerWidth() < minScreenWidth) ? minScreenWidth : $body.innerWidth(),

        posMap,
        scrollDest = 0,
        duration = 1000,

        smallJump = '20%',
        keyMap = {
            33: '-100%', // pageUp
            34: '+100%', // pageDown
            35: 1 / 0, // end
            36: 0, // home
            37: '-' + smallJump, // left
            38: '-' + smallJump, // up
            39: '+' + smallJump, // right
            40: '+' + smallJump // down
        },
        keyThrottle = true,
        controller,
        center,
        scale = 1,
        sum = 0,
        anchors = function () {
        },
        lastCloudsOffset,
        images = {},
        positions = {};

    $.easing.easeOutExpo = function (x, t, b, c, d) {
        return t === d ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b;
    };

    function calculateOffsets() {
        posMap = [];
        $medium.find('.scene').each(function () {
            posMap.push({
                elem: $(this),
                pos: $(this).prop('offsetLeft') - $window['width']() / 2 | 0
            });
        });
        posMap.sort(function (a, b) {
            return b.pos - a.pos;
        });
        $window.triggerHandler('scroll');
    }

    function scrollTo(dest) {
        var obj = {}, multiplier, realStep,
            max = $story.find('.medium').outerWidth() - screenWidth;

        if (!$htmlBody.is(':animated')) {
            scrollDest = $window['scrollLeft']();
        }
        if (typeof dest === 'string') {
            multiplier = dest.indexOf('-') >= 0 ? -1 : 1;
            realStep = +smallJump || +String(smallJump).replace(/[^\d]/g, '') / 100 * screenWidth;
            dest = scrollDest + (dest.indexOf('%') >= 0 ? multiplier * realStep : +dest || 0);
        }
        scrollDest = Math.max(0, Math.min(max, dest));
        obj['scrollLeft'] = scrollDest;
        $htmlBody.stop(true).animate(obj, {
            duration: duration,
            easing: 'easeOutExpo',
            queue: false
        });
    }

    function keyHandler(e) {
        var keyCode = e.which || e.keyCode || e.originalEvent.keyCode;

        if (!keyThrottle) return;

        keyThrottle = false;
        if (keyMap[keyCode] != null) {
            scrollTo(keyMap[keyCode]);
            setTimeout(function () {
                keyThrottle = true;
            }, 0);
            return false;
        }
    }

    $window.scroll(function () {
        var i, pos = $window['scrollLeft']() + $html['width']() / 2;
        for (i = 0; i < posMap.length; i += 1) {
            if (posMap[i].pos < pos) {
                break;
            }
        }
    });

    $body.on('mousewheel DOMMouseScroll', function (e) {
        var delta = 0;
        e = e.originalEvent;
        if (e.wheelDelta) {
            delta = -e.wheelDelta;
        }
        if (e.detail) {
            delta = e.detail * 40;
        }
        scrollTo(String(delta));
        return false;
    });

    $body.keydown(keyHandler);
    $body.keypress(keyHandler);
    $window.resize(calculateOffsets);
    calculateOffsets();
    setTimeout(function () {
        scrollTo(0);
    }, 100);

    function onResize() {
        var transform, transformOrigin, pins = [],
            top = ($(window).height() - 600) / 2 | 0,
            sum = 0,
            center = $(window).width() / 2 | 0;

        transformOrigin = center + 'px ' + center * 6 + 'px';

        /*SET SCREEN SIZE*/
        $medium.find('.scene:first, .scene:last').css('width', screenWidth);
        $story.css({'width': screenWidth, 'height': $body.innerHeight() - $header.outerHeight(true)});
        $story.find('.far, .medium, .near').css({'width': $medium.outerWidth(true)});


        /*ANIMATED ELEMENTS SETUP*/
        $far.find('.clouds').css('marginLeft', screenWidth);
        $near.find('.posel').css('left', $medium.find('.sejm').position().left + 770);
        $near.find('.samochod').css('left', $medium.find('.sejm').position().left + 880);
        $near.find('.taxi').css('left', $medium.find('.dom').position().left + screenWidth - 400);
        $near.find('.samolot').css('left', $medium.find('.lotnisko').position().left + 880);

        //$story.css({ left: center * 2 });

        var maxHeight = 0;

    }

});