jQuery(document).ready(function () {
    if ((timelineEmbed = jQuery("#timeline-embed")).length > 0) {
        createStoryJS({
            start_at_end: true,
            width: "100%",
            height: Math.max($('#_wrapper').height()-30, 400),
            source: '/sejmometr/posiedzenia_timeline.json',
            embed_id: 'timeline-embed',
            css: '/plugins/TimelineJS/build/css/timeline-2rows.css',
            js: '/plugins/TimelineJS/build/js/timeline-2rows.js',
            lang: _mPHeart.language.twoDig
        });

        $(window).on('DATAREADY', function () {
            var vcoNavigation = jQuery('.vco-navigation');

            vcoNavigation.on("UPDATE", function () {
                if (window.timelinejs_current_slide !== null)
                    prepare_slide(window.timelinejs_current_slide);
            });

            vcoNavigation.on("LOADED", function () {
                if (window.timelinejs_current_slide !== null)
                    prepare_slide(window.timelinejs_current_slide);
            });

        });
    }

    var $sideMenu = $('.sideMenu > ul');

    $sideMenu.css('width', $sideMenu.width()).affix({
        offset: {
            top: function () {
                return this.top = Math.floor($('.sideMenu').position().top) - $('header').outerHeight(true);
            }
        }
    });

    detailBlocks();
    graphPoslankiPoslowie();
});

function prepare_slide(current_slide) {
    
    var slide_div = jQuery('.slider-item-container').children()[ current_slide ];
    
	if (!(slide_div.hasClass('prepared'))) {
		
		slide_div.addClass('prepared');
		
		/*
		var title_element = jQuery(jQuery('.slider-item-container').children()[63]).find('h3');
		var title_element_text = title_element.text();
		
		if (title_element_text[0] == '#') {
		// podmieniamy tytuł
		}
		*/
	
	}

}