(function ($) {
    var $body = $('body'),
        $story = $('#storyLine'),
        $far = $story.find('.far'),
        $medium = $story.find('.medium'),
        $near = $story.find('.near'),
        sceneCount = $medium.find('.scene:last').data('scene'),
        minScreenWidth = 1204,
        screenWidth = ($body.innerWidth() < minScreenWidth) ? minScreenWidth : $body.innerWidth(),
        screenPosPrev = 0,
        screenPos = 0,
        sceneAnimationDelayInterval;

    /*SET SCREEN SIZE*/
    $story.find('.far, .medium, .near').css('width', sceneCount * screenWidth);
    $medium.find('.scene').css('width', screenWidth);
    $far.find('.clouds').css('marginLeft', screenWidth);

    /*BLOCK WINDOW*/
    $body.addClass('modal-open');

    function whichTransitionEvent() {
        var t;
        var el = document.createElement('fakeelement');
        var transitions = {
            'transition': 'transitionend',
            'OTransition': 'oTransitionEnd',
            'MozTransition': 'transitionend',
            'WebkitTransition': 'webkitTransitionEnd'
        }

        for (t in transitions) {
            if (el.style[t] !== undefined) {
                return transitions[t];
            }
        }
    }

    var mouseScrollDirection = function (event, delta) {
        var s = 0, id = event.currentTarget.id || event.currentTarget.nodeName;

        o = '#' + id + ':';

        if (delta > 0)
            s += delta;
        else if (delta < 0)
            s += delta;

        if (event.deltaY > 0)
            s += event.deltaY;
        else if (event.deltaY < 0)
            s += event.deltaY;

        if (event.deltaX > 0)
            s -= event.deltaX;
        else if (event.deltaX < 0)
            s -= event.deltaX;

        screenPos += s;
        if (screenPos > 0) screenPos = 0;

        _sceneAnimationDelay(screenPos);
    };

    var _sceneAnimationDelay = function (step) {
        clearInterval(sceneAnimationDelayInterval);
        sceneAnimationDelayInterval = setInterval(function () {
            if (step == screenPosPrev) return;

            var transitionEnd = whichTransitionEvent();
            $medium[0].addEventListener(transitionEnd, _sceneAnimation(step), false);
        }, 100);
    };

    var _sceneAnimation = function (step) {
        var rightBorder = $medium.width() - screenWidth;
        console.log(step, (Math.abs(step - screenPosPrev)) * 10);

        /*check if we didn't reach end of infograph*/
        if (Math.abs(step) >= rightBorder) {
            $medium.css('left', rightBorder + 'px');
            screenPos = -rightBorder;
            return;
        }

        $story.find('.far, .medium, .near').css('transition-duration', (Math.abs(step - screenPosPrev)) * 10 + 'ms');

        $far.css('left', (step * .4) + 'px');
        $medium.css('left', step + 'px');
        $near.css('left', step + 'px');

        screenPosPrev = step;
    };

    $(document).mousewheel(function (event, delta) {
        mouseScrollDirection(event, delta);
    });
}(jQuery));
