jQuery(document).ready(function () {
    if ((timelineEmbed = jQuery("#timeline-embed")).length > 0) {
        createStoryJS({
            start_at_end: true,
            width: "100%",
            height: '500',
            source: '/sejmometr/posiedzenia_timeline.json',
            embed_id: 'timeline-embed',
            css: '/css/timelinejs/timeline.css',
            js: '/js/timelinejs/timeline-min.js',
            lang: _mPHeart.language.twoDig
        });
    }
});