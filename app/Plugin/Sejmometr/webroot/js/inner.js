var globalController;
jQuery(function ($) {
    var controller, center, scale = 1, sum = 0, anchors = function () {
        }, lastCloudsOffset, images = {},
        positions = {};

    function sortedIndex(arr, n) {
        var i, l, ret = arr[0][1];
        for (i = 0, l = arr.length; i < l; i += 1) {
            if (arr[i][0] > n) {
                return ret;
            }
            ret = arr[i][1];
        }
        return ret;
    }

    function convertArr(arr, names) {
        var i, l, tempVal;
        for (i = 0, l = arr.length; i < l; i += 1) {
            arr[i][1] = names[arr[i][1]];
        }
        return arr;
    }

    function savePositions() {
        $.each('.hero-1|.hero-2|.hero-3|.cover.intro|.bus.morning|.bus.evening|.train'.split('|'), function (i, selector) {
            var elem = $(selector),
                top = elem.css('top') || elem.position().top,
                left = elem.css('left') || elem.position().left;
            positions[selector] = { position: 'absolute', top: top, left: left };
        });
    }

    function restorePositions() {
        $.each(positions, function (selector, css) {
            $(selector).css(css);
        });
    }

    savePositions();

    function onResize() {
        var transform, transformOrigin, pins = [],
            top = ($(window).height() - $('#menu').height() - 600) / 2 | 0;
        sum = 0;
        center = $(window).width() / 2 | 0;
        transformOrigin = center + 'px ' + center * 6 + 'px';
        $('.sun, .moon').css({ position: 'fixed' }); // TODO: wyrzuciÄ‡ do cssa
        $('.hero-1').css({ top: 305 }); // TODO: wyrzuciÄ‡ do cssa
        $('.hero-2').css({ top: $('.hero-2').position().top }); // TODO: wyrzuciÄ‡ do cssa
        $('.hero-3').css({ top: $('.hero-3').position().top }); // TODO: wyrzuciÄ‡ do cssa
        $('#container').css({ left: center * 2 });

        var maxHeight = 0;
        $('.tooltip').toggleClass('small', $(window).height() < 600);
        $('.tooltip').each(function () {
            var height = $(this).outerHeight(true);
            if (maxHeight < height) {
                maxHeight = height;
            }
        });
        if ($(window).height() >= 2 * maxHeight) {
            $('#story').css({ top: top });
            $('.tooltip').css({ bottom: '50%' });
        } else {
            $('#story').css({ top: maxHeight - 325 });
            $('.tooltip').css({ bottom: $(window).height() - maxHeight });
        }
        $('#story').height(Math.min($(window).height() - $('#story').position().top, 600)); // preventing from appearing vertical scrollbar
        $('.grass').css('top', $('#story').position().top + 350);

        if (controller) {
            // TODO: destroy controller
            controller.destroy();
        }

        restorePositions();
        globalController = controller = $.superscrollorama({
            isVertical: false,
            triggerAtCenter: true,
            playoutAnimations: false
        });

        function pos(x) {
            var localSum = 0;
            $.each(pins, function (i, pin) {
                if (x <= pin[0]) {
                    return false;
                }
                localSum += pin[1];
            });
            return x + localSum + center;
        }

        function pin(start, length) {
            controller.pin('#container', length, { offset: start - center, bonus: sum });
            controller.pin('.cover.intro', length, { offset: start + center, bonus: sum });
            sum += length;
            pins.push([start, length]);
        }

        $('.bus.morning').css('left', 880 - 10);
        $('.train').css('left', 3907);
        $('.bus.evening').css('left', 11850 + 50);
        controller.pin('.bus.morning', 1100 + 10, { offset: -center + $('.bus.morning').width() / 2 | 0, bonus: 0 });
        controller.pin('.train', 1061, { offset: -center + $('.train').width() / 2 | 0, bonus: 0 });
        controller.pin('.hero-1', 13900 + 69 - 394 + 90, { offset: -center, bonus: -23 });
        controller.pin('.hero-2', 13900 + 69 - 5678, { offset: -center - 80, bonus: -22 });
        controller.pin('.hero-3', 13900 + 69 - 6580, { offset: -center + 70 - 70, bonus: -21 });
        controller.pin('.bus.evening', 1380 - 90, { offset: -center + $('.bus.evening').width() / 2 | 0, bonus: 0 });
        $('.bus.morning').css('left', 1800);
        $('.train').css('left', 4870);
        $('.cyclist').css('left', 5600);
        $('.bus.evening').css('left', 13200);
        pin(801, 1500); // autobus przystanek pierwszy
        pin(2200, 500); // autobus przystanek drugi
        pin(3677, 1200); // praca
        pin(3917, 1000); // tramwaj przystanek pierwszy
        pin(5261, 500); // tramwaj przystanek drugi
        pin(5600, 550); // czekanie na dziecko
        pin(6500 - 70, 550); // czekanie na mamÄ™
        pin(11400, 1000); // oglÄ…danie zwierzÄ…t
        pin(11900, 1000); // autobus nocny przystanek pierwszy
        pin(13400 - 60, 500); // autobus nocny przystanek drugi
        pin(13900 + 69, 500); // Å›wiatÅ‚o w oknie

        controller.addTween(400, TweenMax.fromTo($('.hero-1'), 0.1, { x: 0, y: 0, scale: 0.4, opacity: 0 }, { x: 0, y: 0, scale: 0.4, opacity: 1, ease: 'linear' }), 200);
        controller.addTween(pos(0), TweenMax.to($('.hero-1'), 0.1, { scale: 1, y: 4, ease: 'linear' }), 300);
        controller.addTween(pos(300), TweenMax.to($('.hero-1'), 0.1, { scale: 1, y: 4, ease: 'linear' }), 300);
        controller.addTween(pos(650 - 24), TweenMax.to($('.hero-1'), 0.1, { scale: 0.4, y: 0, ease: 'linear' }), 180);
        controller.addTween(pos(250), TweenMax.fromTo($('.bus.morning'), 0.1, { left: 1800 }, { left: 880 - 10 }), 1750);
        controller.addTween(pos(801) + 1100, TweenMax.to($('.hero-1'), 0.1, { x: 79 }), 200);
        controller.addTween(pos(801) + 1300, TweenMax.to($('.hero-1'), 0.1, { opacity: 0 }), 100);

        controller.addTween(pos(801 + 1), TweenMax.fromTo($('.car-1'), 0.1, { left: 2100 }, { left: 800, ease: 'linear' }), 2000);

        controller.addTween(pos(2200) + 200, TweenMax.fromTo($('.hero-1'), 0.1, { x: -35 }, { x: -34, opacity: 1 }), 200);
        controller.addTween(pos(2200 + 1), TweenMax.to($('.hero-1'), 0.1, { scale: 1, x: 0, y: 50, ease: 'linear' }), 100);
        controller.addTween(pos(3400), TweenMax.to($('.hero-1'), 0.1, { scale: 0.25, y: 150, ease: 'linear' }), 290);
        controller.addTween(pos(3400), TweenMax.fromTo($('.work'), 0.1, { className: '+=front' }, { className: '-=front' }));
        controller.addTween(pos(3677), TweenMax.fromTo($('.watch'), 0.2, { opacity: 0, ease: 'linear' }, { opacity: 1 }));
        controller.addTween(pos(3677), TweenMax.fromTo($('.watch .hours'), 0.1, { rotation: -90 + 30 * 8, ease: 'linear' }, { rotation: -90 + 30 * 16 }), 2000);
        controller.addTween(pos(3677), TweenMax.fromTo($('.watch .minutes'), 0.1, { rotation: -90, ease: 'linear' }, { rotation: -90 + 360 * 8 }), 1500);
        controller.addTween(pos(3677) + 1000, TweenMax.fromTo($('.work'), 0.1, { className: '-=front' }, { className: '+=front' }));
        controller.addTween(pos(3677), TweenMax.fromTo($('.hero-1'), 0.2, { opacity: 1, ease: 'linear' }, { opacity: 0 }));
        controller.addTween(pos(3677 + 1), TweenMax.fromTo($('.watch'), 0.2, { opacity: 1, ease: 'linear' }, { opacity: 0 }));
        controller.addTween(pos(3677 + 1), TweenMax.fromTo($('.hero-1'), 0.1, { opacity: 0, ease: 'linear' }, { opacity: 1 }), 1);
        controller.addTween(pos(3677 + 1), TweenMax.fromTo($('.hero-1'), 0.1, { scale: 0.45, y: 70, ease: 'linear' }, { scale: 0.4, y: 0 }), 130);
        controller.addTween(pos(3917), TweenMax.fromTo($('.watch .minutes'), 0.1, { rotation: -90, ease: 'linear' }, { rotation: -85 }), 800);
        controller.addTween(pos(3917) + 800, TweenMax.to($('.hero-1'), 0.1, { opacity: 0 }), 200);
        controller.addTween(pos(3917), TweenMax.fromTo($('.train'), 0.1, { left: 4870 }, { left: 3907 }), 800);
        controller.addTween(pos(3917 + 1), TweenMax.fromTo($('.cyclist'), 0.1, { left: 6800 }, { left: 3270, ease: 'linear' }), 1900);
        controller.addTween(pos(5261) + 200, TweenMax.fromTo($('.hero-1'), 0.1, { opacity: 0 }, { opacity: 1 }), 200);
        controller.addTween(pos(5301), TweenMax.to($('.hero-1'), 0.1, { scale: 1, y: 4, ease: 'linear' }), 180);
        controller.addTween(pos(5600) + 250, TweenMax.fromTo($('.hero-2'), 0.1, { opacity: 0, y: -27, scale: 0.39 }, { opacity: 1, y: -27, scale: 0.4 }), 120);
        controller.addTween(pos(5600) + 250, TweenMax.fromTo($('.hero-2'), 0.1, { scale: 0.4, y: -27, ease: 'linear' }, { scale: 1, y: 0 }), 300);
        controller.addTween(pos(6500 - 70) + 250, TweenMax.fromTo($('.hero-3'), 0.1, { opacity: 0, y: -3, scale: 0.39 }, { opacity: 1, y: -3, scale: 0.4 }), 120);
        controller.addTween(pos(6500 - 70 + 1), TweenMax.fromTo($('.hero-1'), 0.1, { x: 0, easing: 'linear' }, { x: -90 }), 90);
        controller.addTween(pos(6500 - 70) + 250, TweenMax.fromTo($('.hero-3'), 0.3, { scale: 0.4, y: -3, ease: 'linear' }, { scale: 1, y: 0 }), 300);
        controller.addTween(pos(0), TweenMax.fromTo($('.elephant-eye'), 0.2, { y: -21 }, { y: -20 }), 1);
        controller.addTween(pos(11400) + 500, new TimelineLite()
            .append(TweenMax.fromTo($('.elephant-eye'), 0.2, { y: -20 }, { y: 0 }))
            .append(TweenMax.fromTo($('.elephant-eye'), 0.2, { y: 0 }, { y: -20 })));
        controller.addTween(pos(11700), TweenMax.to($('.hero-1'), 0.1, { scale: 0.4, y: 0, x: -5, ease: 'linear' }), 180);
        controller.addTween(pos(11700), TweenMax.to($('.hero-2'), 0.1, { scale: 0.4, y: -27, x: 0, ease: 'linear' }), 180);
        controller.addTween(pos(11700), TweenMax.to($('.hero-3'), 0.1, { scale: 0.4, y: -3, x: 45, ease: 'linear' }), 180);
        controller.addTween(pos(11900) + 800, TweenMax.to($('.hero-1'), 0.1, { opacity: 0 }), 180);
        controller.addTween(pos(11900) + 800, TweenMax.to($('.hero-2'), 0.1, { opacity: 0 }), 180);
        controller.addTween(pos(11900) + 800, TweenMax.to($('.hero-3'), 0.1, { opacity: 0 }), 180);
        controller.addTween(pos(11900) - 700, TweenMax.fromTo($('.bus.evening'), 0.1, { left: 13200 }, { left: 11850 + 50 }), 1750);
        controller.addTween(pos(11900 + 1), TweenMax.fromTo($('.car-2'), 0.1, { left: 13340 }, { left: 11900, ease: 'linear' }), 2300);
        controller.addTween(pos(13400 - 60) + 200, TweenMax.to($('.hero-1'), 0.1, { opacity: 1 }), 200);
        controller.addTween(pos(13400 - 60) + 200, TweenMax.to($('.hero-2'), 0.1, { opacity: 1 }), 200);
        controller.addTween(pos(13400 - 60) + 200, TweenMax.to($('.hero-3'), 0.1, { opacity: 1 }), 200);
        controller.addTween(pos(13400 - 60 + 1), TweenMax.to($('.hero-1'), 0.1, { scale: 1, x: -90, y: 4, ease: 'linear' }), 180);
        controller.addTween(pos(13400 - 60 + 1), TweenMax.to($('.hero-2'), 0.1, { scale: 1, x: 0, y: 0, ease: 'linear' }), 180);
        controller.addTween(pos(13400 - 60 + 1), TweenMax.to($('.hero-3'), 0.1, { scale: 1, x: 0, y: 0, ease: 'linear' }), 180);
        controller.addTween(pos(13900 + 69), TweenMax.to($('.hero-1'), 0.1, { scale: 1, x: 0, y: 0, ease: 'linear' }), 90);
        controller.addTween(pos(13900 + 69) + 90, TweenMax.to($('.hero-1'), 0.1, { scale: 0.4, x: 0, y: 0, ease: 'linear' }), 180);
        controller.addTween(pos(13900 + 69) - 70, TweenMax.to($('.hero-2'), 0.1, { scale: 0.4, x: 0, y: -27, ease: 'linear' }), 180);
        controller.addTween(pos(13900 + 69), TweenMax.to($('.hero-3'), 0.1, { scale: 0.4, x: 0, y: -3, ease: 'linear' }), 180);
        controller.addTween(pos(13900 + 69) + 180 + 90, TweenMax.to($('.hero-1'), 0.2, { opacity: 0 }));
        controller.addTween(pos(13900 + 69) + 180 - 70, TweenMax.to($('.hero-2'), 0.2, { opacity: 0 }));
        controller.addTween(pos(13900 + 69) + 180, TweenMax.to($('.hero-3'), 0.2, { opacity: 0 }));
        controller.addTween(pos(13900 + 69) + 180 + 90, TweenMax.fromTo($('.window'), 0.2, { opacity: 0 }, { opacity: 1 }));

        $('.front').removeClass('front');
        $('.back').removeClass('back');

        images = {
            '.hero-1': {
                elem: $('.hero-1'),
                arr: convertArr([
                    [pos(0), 0],
                    [pos(300 + 69 + $('.hero-1').width()), 1],
                    [pos(626), 2],
                    [pos(801), 0],
                    [pos(801) + 1100, 1],
                    [pos(801) + 1300, 2],
                    [pos(802), 0],
                    [pos(2301), 1],
                    [pos(3677), 2],
                    [pos(3677 + 1), 1],
                    [pos(3917), 0],
                    [pos(3917) + 800, 2],
                    [pos(3918), 0],
                    [pos(5481), 1],
                    [pos(5600), 2],
                    [pos(5601), 1],
                    [pos(6500 - 70), 2],
                    [pos(6500 - 70 + 1), 1],
                    [pos(11400), 2],
                    [pos(11400 + 1), 1],
                    [pos(11700), 2],
                    [pos(11900), 0],
                    [pos(11900) + 800, 2],
                    [pos(11900 + 1), 0],
                    [pos(13581), 1],
                    [pos(13900 + 69) + 90, 2]
                ], ['hero-1-front.png', 'hero-1-walk.png', 'hero-1-back.png'])
            },
            '.hero-2': {
                elem: $('.hero-2'),
                arr: convertArr([
                    [pos(0), 0],
                    [pos(5600 + 1), 1],
                    [pos(6500 - 70), 2],
                    [pos(6500 - 70 + 1), 1],
                    [pos(11400), 2],
                    [pos(11400 + 1), 1],
                    [pos(11700), 2],
                    [pos(11900), 0],
                    [pos(11900) + 800, 2],
                    [pos(11900 + 1), 0],
                    [pos(13581), 1],
                    [pos(13900 + 69) - 70, 2]
                ], ['hero-2-front.png', 'hero-2-walk.png', 'hero-2-back.png'])
            },
            '.hero-3': {
                elem: $('.hero-3'),
                arr: convertArr([
                    [pos(0), 0],
                    [pos(6500 + 1), 1],
                    [pos(11400), 2],
                    [pos(11400 + 1), 1],
                    [pos(11700), 2],
                    [pos(11900), 0],
                    [pos(11900) + 800, 2],
                    [pos(11900 + 1), 0],
                    [pos(13581), 1],
                    [pos(13900 + 69), 2]
                ], ['hero-3-front.png', 'hero-3-walk.png', 'hero-3-back.png'])
            },
            '.bus.morning': {
                elem: $('.bus.morning'),
                arr: convertArr([
                    [pos(0), 0],
                    [pos(801 + 1), 1]
                ], ['bus.png', 'bus-back.png'])
            },
            '.train': {
                elem: $('.train'),
                arr: convertArr([
                    [pos(0), 0],
                    [pos(3917 + 1), 1]
                ], ['train.png', 'train-back.png'])
            },
            '.bus.evening': {
                elem: $('.bus.evening'),
                arr: convertArr([
                    [pos(0), 0],
                    [pos(11900 + 1), 1]
                ], ['bus.png', 'bus-back.png'])
            }
        };

        // 10835
        controller.addTween(pos(11800 * scale), TweenMax.fromTo($('.sky-night'), 1, { autoAlpha: 0 }, { autoAlpha: 1 }), 1700 * scale);

        controller.addTween(pos(0), TweenMax.to($('.sun'), 1, { rotation: 22, ease: 'linear', transformOrigin: transformOrigin }), pos(14200 * scale - center));
        controller.addTween(pos(0), TweenMax.fromTo($('.moon'), 1, { rotation: -19, ease: 'linear', transformOrigin: transformOrigin }, { rotation: 3, ease: 'linear', transformOrigin: transformOrigin }), pos(14200 * scale + center));
        controller.addTween(pos(11700 * scale) + 800, TweenMax.fromTo($('.lamp-lights'), 0.5, { autoAlpha: 0 }, { autoAlpha: 1 }));

        if ($('html').hasClass('lt-ie10')) {
            $('.tooltip').toggleClass('active', true);
        } else {
            $('.tooltip').each(function () {
                var elem = $(this),
                    offset = ((elem.attr('data-visible-width') / 2) || 425) | 0,
                    shift = +elem.attr('data-shift') || 0;
                controller.addTween(pos(elem.position().left - offset) + shift, TweenMax.fromTo(elem, 1, { className: '-=active' }, { className: '+=active' }), 1);
                controller.addTween(pos(elem.position().left + offset) + shift, TweenMax.fromTo(elem, 1, { className: '+=active' }, { className: '-=active' }), 1);
                elem.removeClass('active');
            });
        }

        anchors = function (e) {
            var slideElem = $(e.currentTarget.href.replace(/.*#/, '#'));
            globalScrollTo(pos(slideElem.position().left), true);
            return false;
        };

        controller.triggerCheckAnim();
        $('.cover.outro').css({
            left: $('#container').width() + sum + center * 2
        });
        $('.cloud').width($('#container').width() + sum);
        $('.grass').height(top + 300);
    }


    onResize();
    $(window).resize(onResize);

    function tickHandler() {
        var offset = $('#container').offset().left,
            sl = $(window).scrollLeft(),
            value = sl - 2 * offset;
        if (lastCloudsOffset !== value) {
            lastCloudsOffset = value;
            $('.cloud-1').css('left', value / 14300 * 3000 | 0);
            $('.cloud-2').css('left', value / 14300 * 2000 - 50 | 0);

            $.each(images, function (selector, obj) {
                var src = 'images/' + sortedIndex(obj.arr, sl);
                if (obj.elem[0].src !== src) {
                    obj.elem[0].src = src;
                }
            });
        }
    }

    TweenLite.ticker.addEventListener('tick', tickHandler);


    $(window).scroll(function () {
        controller && controller.triggerCheckAnim(true);
    });

    $('#menu').on('click', 'a', anchors);
});