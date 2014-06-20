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
            
            
            // console.log('DATAREADY');
            var vcoNavigation = jQuery('.vco-navigation');
            var vcoSlider = jQuery('.vco-slider');
            
            vcoSlider.on("FINISH", function () {
            	// console.log('FINISH', window.timelinejs_current_slide);
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
});

jQuery.fn.outerHTML = function(s) {
    return s
        ? this.before(s).remove()
        : jQuery("<p>").append(this.eq(0).clone()).html();
};

function prepare_slide(current_slide) {
	
	var slide_div, slide_content;

	if( 
		( slide_div = jQuery( jQuery('.slider-item-container').children()[ current_slide ] ) ) && 
		!(slide_div.hasClass('prepared')) && 
		( slide_content = slide_div.find('.slide_content') ) && 
		slide_content.length 
	) {
		
		var h = $('#_wrapper').height() - 300;
	    console.log('INIT', jQuery("#timeline-embed .content-container"), h);
		jQuery("#timeline-embed .content-container").height(h + 'px');
		
		
		var posiedzenie_id = slide_content.data('posiedzenie_id');
		console.log('preparing slide', posiedzenie_id);		
		slide_div.addClass('prepared');
		
		var title_element = jQuery( slide_div.find('h3')[0] );		
		var title_element_text = title_element.text();
		
		title_element.html('<a href="/dane/sejm_posiedzenia/' + posiedzenie_id + '">Posiedzenie Sejmu ' + title_element_text + '</a>');
		
		$.ajax({
			url: "/sejmometr/posiedzenie/" + posiedzenie_id + ".json",
			dataType: "json"
		}).done(function( data ) {
			
			var div = jQuery('#timeline-embed .slide_content[data-posiedzenie_id="' + data.id + '"]');
			if( div ) {
				
				div.html( data.projekty_html );
				
				var h = $('#_wrapper').height() - 390;
				jQuery("#timeline-embed .projekty").height(h + 'px').scrollTop(0);
				
			}
			
		});
		
	}

}