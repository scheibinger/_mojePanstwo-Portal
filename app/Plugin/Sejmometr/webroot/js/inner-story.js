(function ($) {
    var $body = $('body'),
        $story = $('#storyLine'),
        $far = $story.find('.far'),
        $medium = $story.find('.medium'),
        $near = $story.find('.near'),
        sceneCount = $medium.find('.scene:last').data('scene'),
        minScreenWidth = 1204,
        screenWidth = ($body.innerWidth() < minScreenWidth) ? minScreenWidth : $body.innerWidth();

    /*SET SCREEN SIZE*/
    $story.find('.far, .medium, .near').css('width', sceneCount * screenWidth);
    $medium.find('.scene').css('width', screenWidth);

    /*BLOCK WINDOW*/
    $body.addClass('modal-open');
}(jQuery));