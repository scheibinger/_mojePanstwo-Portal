(function ($) {
    var $body = $('body'),
        $story = $('#storyLine'),
        $far = $story.find('.far'),
        $medium = $story.find('.medium'),
        $near = $story.find('.near'),
        sceneCount = $medium.find('.scene:last').data('scene'),
        minScreenWidth = 1204,
        screenWidth = ($body.innerWidth() < minScreenWidth) ? minScreenWidth : $body.innerWidth(),
        rightBorder = $medium.width() - screenWidth,
        screenPosPrev = 0,
        screenPos = 0,
        screenPosHeading = false,
        sceneAnimationDelayInterval,
        sceneAnimationAllow = true;

    /*SET SCREEN SIZE*/
    $story.find('.far, .medium, .near').css('width', sceneCount * screenWidth);
    $medium.find('.scene').css('width', screenWidth);
    $far.find('.clouds').css('marginLeft', screenWidth);

    /*BLOCK WINDOW*/
    $body.addClass('modal-open');

    var mouseScrollDirection = function (event, delta) {
        var s = 0;

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
        clearTimeout(sceneAnimationDelayInterval);
        sceneAnimationDelayInterval = setTimeout(function () {
            if (step == screenPosHeading) return;
            _sceneAnimation(step);
        }, 20);
    };

    var _sceneAnimation = function (step) {
        var speedSet;

        if (screenPosHeading == false) screenPosHeading = step;

        if ((step != screenPosHeading) && !sceneAnimationAllow) {
            $story.find('.far, .medium, .near').stop();
            screenPosPrev = parseInt($medium.css('left'), 10);
        }

        /*check if we didn't reach end of infograph*/
        if (Math.abs(step) >= rightBorder) {
            $medium.css('left', rightBorder + 'px');
            screenPos = -rightBorder;
            return;
        }

        screenPosHeading = step;
        speedSet = Math.floor((Math.abs(step - screenPosPrev)) * 3);
        sceneAnimationAllow = false;

        $far.animate({'left': (step * .4)}, {duration: speedSet});
        $medium.animate({'left': step}, {duration: speedSet, complete: function () {
            screenPosPrev = screenPos = screenPosHeading;
            sceneAnimationAllow = true;
        }});
        $near.animate({'left': step}, {duration: speedSet});
    };

    $(document).mousewheel(function (event, delta) {
        mouseScrollDirection(event, delta);
    });
}(jQuery));
