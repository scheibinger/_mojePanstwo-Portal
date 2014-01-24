/*LOAD YOUTUBE BASIC JS*/
var tag = document.createElement('script');
tag.src = "http://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

/*GENERATE YT IFRAME*/
function onYouTubeIframeAPIReady() {
    var videoId = jQuery('#pb_player').data('youtube');
    var player = new YT.Player('pb_player', {
        videoId: videoId,
        events: {
            'onReady': function () {
                /*SEAK AND JUMP TO SPECIFY SEC AT MOVIE*/
                var hash = window.location.hash;
                var a = jQuery('.wystapienia ul li a[href=' + hash + ']');

                if (a)
                    player.seekTo(jQuery(a).data('video-position'));

                jQuery('.wystapienia ul').find('li a').click(function () {
                    player.seekTo(jQuery(this).data('video-position'));
                    return false;
                })

            }
        }
    });
}