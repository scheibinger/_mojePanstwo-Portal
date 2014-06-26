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

    function repeatButton() {
        $medium.find('.scene.stats .options .repeat').click(function (e) {
            e.preventDefault();

            scrollTo(0);
            setTimeout(function () {
                onResize();
            }, 1050);
        });
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
        $medium.find('.scene:first, .scene.stats .screen').css('width', screenWidth);
        //$medium.find('.scene.stats').css('width', screenWidth * 2);
        $medium.find('.scene.stats').css('width', screenWidth);

        $far.find('.clouds').css('marginLeft', screenWidth);

        $story.css({'width': screenWidth, 'height': $body.innerHeight() - $header.outerHeight(true)});
        $story.find('.far, .medium, .near').css({'width': $medium.outerWidth(true)});

        infoController = controller = new ScrollMagic({
            vertical: false,
            loglevel: 2
        });

        /*SETTING POSITION OF ANIMATED ELEMENTS*/
        $near.find('.posel').removeClass('hide outfit').css({left: $medium.find('.scene.sejm').position().left + 600, height: "", bottom: ""})
        $near.find('.samochod').removeClass('in').css({left: $medium.find('.scene.sejm').position().left + 850});
        $near.find('.taxi').removeClass('in').css({left: $medium.find('.scene.tlumaczenia').position().left, opacity: 0});
        $near.find('.samolot').css({left: $medium.find('.scene.lotnisko').position().left + 215, bottom: "", transform: ""});

        /*SEJM POSEL*/
        var sejmPosel = new TimelineMax()
            //.add(TweenMax.fromTo($medium.find('.scene.sejm .stat.zarobki'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.fromTo($near.find('.posel'), 1.5, { left: $medium.find('.scene.sejm').position().left + 600, opacity: 1}, {left: $near.find('.samochod').position().left + ($near.find('.samochod').width() / 2) - 70}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: 107}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: 127, height: 50}));

        new ScrollScene({
            duration: ($medium.find('.scene.sejm').width() / 2)
        }).on("end", function () {
                $near.find('.posel').addClass('hide');
                $near.find('.samochod').addClass('in');
                $medium.find('.scene.sejm .stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.sejm .building'))
            .setTween(sejmPosel)
            .reverse(false)
            .addTo(controller);

        /*SAMOCHOD SEJM - BIURO*/
        var sejmSamochod = new TimelineMax()
            .add(TweenMax.fromTo($medium.find('.scene.sejm .stat.przejazd'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.fromTo($near.find('.samochod'), 1, {left: $medium.find('.scene.sejm').position().left + 850}, { left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 1100}));

        new ScrollScene({
            duration: minScreenWidth / 2
        }).on("end", function () {
                $near.find('.samochod').removeClass('in');
            })
            .triggerElement($medium.find('.scene.sejm .stat.przejazd'))
            .setTween(sejmSamochod)
            .reverse(false)
            .addTo(controller);

        /*POSEL WALK - BIURO + INSIDE*/
        var biuroPosel = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.posel'), 1.5, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 1150, opacity: 0}, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 1020, opacity: 0}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: 107, height: 110, opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: 122}))
            .add(TweenMax.to($near.find('.posel'), 0.5, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 700}))
            .add(TweenMax.fromTo($medium.find('.scene.biuro .stat.biura'), 0.5, {opacity: 0}, {opacity: 1}));

        new ScrollScene({
            duration: $medium.find('.scene.biuro').width() * .7
        }).on("start",function () {
                $near.find('.posel').removeClass('hide').css({left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 920})
                $near.find('.posel').addClass('outfit');
            }).on("end", function () {
                $medium.find('.scene.biuro').find('.stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.biuro'))
            .setTween(biuroPosel)
            .reverse(false)
            .addTo(controller);

        /*POSEL WALK - BIURO, SZPITAL, BANK, SPOTKANIE, TLUMACZ, DOM*/
        var poselWalk = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.posel'), 2, {left: $medium.find('.scene.biuro').position().left + $medium.find('.scene.biuro').width() - 700}, {left: $medium.find('.scene.szpital').position().left + 20}))
            .add(TweenMax.fromTo($medium.find('.scene.szpital .stat.korespondencja'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 2.5, {left: $medium.find('.scene.szpital').position().left + $medium.find('.scene.szpital').width() - 250}))
            .add(TweenMax.fromTo($medium.find('.scene.szpital .stat.badania'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 4, {left: $medium.find('.scene.bank').position().left + $medium.find('.scene.bank').width() / 2}))
            .add(TweenMax.fromTo($medium.find('.scene.bank .stat.rachunki'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 4, {left: $medium.find('.scene.spotkanie').position().left + 490}))
            .add(TweenMax.fromTo($medium.find('.scene.spotkanie .stat.sala'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 5, {left: $medium.find('.scene.tlumaczenia').position().left + $medium.find('.scene.tlumaczenia').width() - 210}))
            .add(TweenMax.fromTo($medium.find('.scene.tlumaczenia .stat.ekspertyzy'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 5, {left: $medium.find('.scene.dom').position().left + $medium.find('.scene.dom').width() - 290}))
            .add(TweenMax.fromTo($medium.find('.scene.dom .stat.prywatny'), 0.25, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.fromTo($medium.find('.scene.dom .stat.dom'), 0.25, {opacity: 0}, {opacity: 1}));

        new ScrollScene({
            duration: ($medium.find('.scene.biuro').width() / 2 + $medium.find('.scene.szpital').width() + $medium.find('.scene.bank').width() + $medium.find('.scene.spotkanie').width() + $medium.find('.scene.tlumaczenia').width() + $medium.find('.scene.dom').width() - (minScreenWidth / 2))
        }).on("end", function () {
                $medium.find('.scene.szpital, .scene.bank, .scene.spotkanie, .scene.tlumaczenia, .scene.dom').find('.stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.biuro .marker'))
            .setTween(poselWalk)
            .reverse(false)
            .addTo(controller);

        /*POSEL TAXI - WALK + CALL*/
        var poselTaxi = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.taxi'), 10, {left: $medium.find('.scene.tlumaczenia').position().left, opacity: 0}, { left: $medium.find('.scene.tlumaczenia').position().left, opacity: 1}))
            .add(TweenMax.to($near.find('.taxi'), 6, {left: $medium.find('.scene.dom').position().left + $medium.find('.scene.dom').width() - 300}))
            .add(TweenMax.to($near.find('.posel'), 1.5, {left: $medium.find('.scene.dom').position().left + $medium.find('.scene.dom').width() - 220}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: 107}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: 127, height: 50}));

        new ScrollScene({
            duration: ($medium.find('.scene.dom').width())
        }).on("end", function () {
                $near.find('.posel').addClass('hide');
                $near.find('.taxi').addClass('in');
            })
            .triggerElement($medium.find('.scene.dom'))
            .setTween(poselTaxi)
            .reverse(false)
            .addTo(controller);

        /*POSEL TAXI - RIDE*/
        var poselTaxiRide = new TimelineMax()
            .add(TweenMax.fromTo($medium.find('.scene.droga .stat.taksowka'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.fromTo($near.find('.taxi'), 1, {left: $medium.find('.scene.dom').position().left + $medium.find('.scene.dom').width() - 300}, {left: $medium.find('.scene.lotnisko').position().left - 80}));

        new ScrollScene({
            duration: ($medium.find('.scene.droga').width() / 2)
        }).on("end", function () {
                $medium.find('.scene.droga').find('.stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.droga .marker'))
            .setTween(poselTaxiRide)
            .reverse(false)
            .addTo(controller);

        /*POSEL LOTNISKO - WALK*/
        var poselLotnisko = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.posel'), 0.1, {left: $medium.find('.scene.lotnisko').position().left}, {left: $medium.find('.scene.lotnisko').position().left, bottom: 107, height: 110}))
            .add(TweenMax.to($near.find('.posel'), 0.1, {bottom: 122}))
            .add(TweenMax.fromTo($medium.find('.scene.lotnisko .stat.loty'), 0.5, {opacity: 0}, {opacity: 1}))
            .add(TweenMax.to($near.find('.posel'), 1, {left: $medium.find('.scene.lotnisko').position().left + 200}))
            .add(TweenMax.to($near.find('.posel'), 0.5, {opacity: 0}));

        new ScrollScene({
            duration: ($medium.find('.scene.lotnisko').width() / 2)
        }).on("start", function () {
                $near.find('.posel').removeClass('hide').css({left: $medium.find('.scene.lotnisko').position().left})
                $near.find('.taxi').removeClass('in');
            })
            .on("end", function () {
                $near.find('.posel').addClass('hide');
                $medium.find('.scene.lotnisko').find('.stat').addClass('out');
            })
            .triggerElement($medium.find('.scene.lotnisko'))
            .setTween(poselLotnisko)
            .reverse(false)
            .addTo(controller);

        /*POSEL LOT*/
        var poselLot = new TimelineMax()
            .add(TweenMax.fromTo($near.find('.samolot'), 5, {left: $medium.find('.scene.lotnisko').position().left + 215, rotation: 0}, {left: $medium.find('.scene.stats').position().left, bottom: "+=" + $window.height() / 2, rotation: -15}));

        new ScrollScene({
            duration: ($medium.find('.scene.lot').width())
        })
            .triggerElement($medium.find('.scene.lotnisko .marker'))
            .setTween(poselLot)
            .reverse(false)
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

        if ((delta > minScreenWidth * .02) || (delta < -(minScreenWidth * .2)))
            delta = Math.floor(minScreenWidth * .02);

        scrollTo(String(Math.floor(delta)));

        return false;
    });

    $body.keydown(keyHandler);
    $body.keypress(keyHandler);
    $window.resize(calculateOffsets);
    $window.resize(onResize);

    repeatButton();
    scrollTo(0);
    setTimeout(function () {
        onResize();
        calculateOffsets();
    }, 1050);

    TweenLite.ticker.addEventListener('tick', tickHandler);
});