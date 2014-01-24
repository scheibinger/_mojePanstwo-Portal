jQuery(document).ready(function () {
    createStoryJS({
        start_at_end: true,
        width: "100%",
        height: '500',
        source: jQuery("#timeline-embed").data("source") + '/timeline.json',
        embed_id: 'timeline-embed',
        css: '/css/timelinejs/timeline.css',
        js: '/js/timelinejs/timeline-min.js',
        lang: _mPHeart.language.twoDig
    });
});