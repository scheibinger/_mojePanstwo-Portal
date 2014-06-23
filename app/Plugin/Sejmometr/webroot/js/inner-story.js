/*global TimelineMax(), TweenMax*/

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
        pins = [],

        transformOrigin,
        top = ($window.height() - 600) / 2 | 0,
        center = $window.width() / 2 | 0,

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
        lastCloudsOffset,
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

    function tickHandler() {
        var offset = $story.offset().left,
            sl = $window.scrollLeft(),
            value = sl - 2 * offset;
        if (lastCloudsOffset !== value) {
            lastCloudsOffset = value;
            $far.find('.clouds').css('left', (value / 14300 * 3000) * 1.5 | 0);
        }
    }

    function onResize() {
        transformOrigin = center + 'px ' + center * 6 + 'px';

        if (controller) {
            // TODO: destroy controller
            controller.destroy();
        }

        /*SET SCREEN SIZE*/
        $medium.find('.scene:first, .scene:last').css('width', screenWidth);
        $far.find('.clouds').css('marginLeft', screenWidth);
        $story.css({'width': screenWidth, 'height': $body.innerHeight() - $header.outerHeight(true)});
        $story.find('.far, .medium, .near').css({'width': $medium.outerWidth(true)});

        infoController = controller = new ScrollMagic({
            vertical: false,
            loglevel: 1
        });

        $near.find('.posel').removeClass('hide').css({height: "", bottom: ""});
        $near.find('.samochod').removeClass('in');
        $near.find('.posel').css({left: $medium.find('.scene.sejm').position().left + 600});
        $near.find('.samochod').css({left: $medium.find('.scene.sejm').position().left + 850});

        /*SEJM POSEL*/
        var sejmPosel = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.posel'), 0.5, { left: $medium.find('.scene.sejm').position().left + 600}, { left: $medium.find('.scene.sejm').position().left + 770}))
            .add(TweenMax.fromTo($medium.find('.scene.sejm .stat.zarobki'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 0.5, {left: $near.find('.samochod').position().left + ($near.find('.samochod').width() / 2) - 70}))
            .add(TweenMax.fromTo($medium.find('.scene.sejm .stat.przejazd'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: "-=15"}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: "+=20", height: "-=50"}));

        /*SAMOCHOD SEJM - BIURO*/
        var sejmSamochod = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.samochod'), 1, {left: $medium.find('.scene.sejm').position().left + 850}, { left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 1000}));

        /*POSEL WALK - BIURO + INSIDE*/
        var biuroPosel = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.posel'), 0.1, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 920}, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 920, bottom: "-=20", height: "+=50"}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: "+=15"}))
            .add(TweenMax.to($near.find('.posel'), 0.2, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 700}));

        /*POSEL WALK - BIURO, SZPITAL, BANK, SPOTKANIE, TLUMACZ, DOM*/
        var poselWalk = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.posel'), 0.5, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 700}, {left: $medium.find('.scene.szpital').position().left + 20}))
            .add(TweenMax.fromTo($medium.find('.scene.szpital .stat.korespondencja'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 3, {left: $medium.find('.scene.szpital').position().left + $medium.find('.scene.szpital').width() - 250}))
            .add(TweenMax.fromTo($medium.find('.scene.szpital .stat.badania'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 4, {left: $medium.find('.scene.bank').position().left + $medium.find('.scene.bank').width() / 2}))
            .add(TweenMax.fromTo($medium.find('.scene.bank .stat.rachunki'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 4, {left: $medium.find('.scene.spotkanie').position().left + 490}))
            .add(TweenMax.fromTo($medium.find('.scene.spotkanie .stat.sala'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 6, {left: $medium.find('.scene.tlumaczenia').position().left + $medium.find('.scene.tlumaczenia').width() - 170}))
            .add(TweenMax.fromTo($medium.find('.scene.tlumaczenia .stat.ekspertyzy'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 4, {left: $medium.find('.scene.dom').position().left + $medium.find('.scene.dom').width() - 290}))
            .add(TweenMax.fromTo($medium.find('.scene.dom .stat.prywatny'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.fromTo($medium.find('.scene.dom .stat.dom'), 0.5, {opacity: 0}, {opacity: 1}));

        /*START*/
        new ScrollScene({
            duration: 1
        }).on("end", function () {
                $near.find('.posel').removeClass('hide outfit').css({left: $medium.find('.scene.sejm').position().left + 600, height: "", bottom: ""});
                $near.find('.samochod').removeClass('in').css({left: $medium.find('.scene.sejm').position().left + 850});
                scrollTo(0);
            })
            .addTo(controller);

        /*SEJM POSEL*/
        new ScrollScene({
            duration: ($medium.find('.scene.sejm').width() / 2)
        }).on("end", function () {
                $near.find('.posel').addClass('hide');
                $near.find('.samochod').addClass('in');
                $medium.find('.scene.sejm .stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.sejm'))
            .setTween(sejmPosel)
            .addTo(controller);

        /*SAMOCHOD SEJM - BIURO*/
        new ScrollScene({
            duration: minScreenWidth / 2
        }).on("end", function () {
                $medium.find('.scene.biuro .stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.sejm .stat.przejazd'))
            .setTween(sejmSamochod)
            .addTo(controller);

        /*POSEL WALK - BIURO + INSIDE*/
        new ScrollScene({
            duration: $medium.find('.scene.biuro').width() / 2
        }).on("start",function () {
                $near.find('.posel').removeClass('hide').css({left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 920})
                $near.find('.samochod').removeClass('in');
                $near.find('.posel').addClass('outfit');
            }).on("end", function () {
                $medium.find('.scene.biuro, .scene.szpital, .scene.bank, .scene.spotkanie, .scene.tlumaczenia, .scene.dom').find('.stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.biuro .stat.biura'))
            .setTween(biuroPosel)
            .addTo(controller);

        /*POSEL WALK - BIURO, SZPITAL, BANK, SPOTKANIE, TLUMACZ, DOM*/
        new ScrollScene({
            duration: ($medium.find('.scene.biuro').width() / 2 + $medium.find('.scene.szpital').width() + $medium.find('.scene.bank').width() + $medium.find('.scene.spotkanie').width() + $medium.find('.scene.tlumaczenia').width() + $medium.find('.scene.dom').width())
        }).on("end", function () {
            })
            .triggerElement($medium.find('.scene.szpital'))
            .triggerHook("onEnter")
            .setTween(poselWalk)
            .addTo(controller);
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
    onResize();

    $window.resize(onResize);

    TweenLite.ticker.addEventListener('tick', tickHandler);
});