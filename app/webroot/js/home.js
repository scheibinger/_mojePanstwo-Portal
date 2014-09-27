/*global _mPHeart*/

jQuery(function () {
    jQuery('#home').find('.apps .appFolder').click(function (event) {
        event.preventDefault();
        _mojePanstwoCockpitSlider.showDialogBox(event);
    });

    var $gridster = jQuery('.gridster');
    var grid = $gridster.find('ul').gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [120, 120],
        max_cols: Math.floor($gridster.outerWidth() / 140),
        draggable: {
            handle: 'header'
        }
    }).data('gridster');
});