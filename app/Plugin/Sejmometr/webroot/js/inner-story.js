jQuery(function ($) {
    'use strict';
    var
        $window = $(window),
        $html = $('html'),
        $body = $('body'),

        $story = $('#storyLine'),
        $far = $story.find('.far'),
        $medium = $story.find('.medium'),
        $near = $story.find('.near'),

        sceneCount = $medium.find('.scene:last').data('scene'),

        minScreenWidth = 1204,
        screenWidth = ($body.innerWidth() < minScreenWidth) ? minScreenWidth : $body.innerWidth(),
        screenHeight = ($body.innerWidth() < minScreenWidth) ? minScreenWidth : $body.innerWidth(),

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
        keyThrottle = true;

    /*SET SCREEN SIZE*/
    //$story.css('width', sceneCount * screenWidth);
    //$story.find('.far, .medium, .near').css('width', sceneCount * screenWidth);
    $medium.find('.scene').css('width', screenWidth);


    /*ANIMATED ELEMENTS SETUP*/
    $far.find('.clouds').css('marginLeft', screenWidth);
    $near.find('.posel').css('left', $medium.find('.sejm').position().left + 770);
    $near.find('.samochod').css('left', $medium.find('.sejm').position().left + 880);
    $near.find('.taxi').css('left', $medium.find('.dom').position().left + screenWidth - 400);
    $near.find('.samolot').css('left', $medium.find('.lotnisko').position().left + 880);

    var controller = new ScrollMagic({vertical: false});

    var tween = new TimelineMax()
        .add([
            TweenMax.to(".innerStory .far", 1, {left: -((sceneCount - 1) * screenWidth * .4), ease: Linear.easeNone}),
            TweenMax.to(".innerStory .medium", 1, {left: -((sceneCount - 1) * screenWidth), ease: Linear.easeNone}),
            TweenMax.to(".innerStory .near", 1, {left: -((sceneCount - 1) * screenWidth), ease: Linear.easeNone})
        ]);

    var scene = new ScrollScene({triggerElement: ".innerStory", duration: 2000, offset: screenWidth / 2})
        .setTween(tween)
        //.setPin(".innerStory")
        .addTo(controller);

    scene.addIndicators();

    /*function keyHandler(e) {
     var keyCode = e.which || e.keyCode || e.originalEvent.keyCode;
     console.log('keyHandler', keyCode);

     if (!keyThrottle) return;

     keyThrottle = false;

     if (keyMap[keyCode] != null) {
     //scrollTo(keyMap[keyCode]);
     setTimeout(function () {
     keyThrottle = true;
     }, 0);
     return false;
     }
     }

     $body.keydown(keyHandler);
     $body.keypress(keyHandler);*/
});