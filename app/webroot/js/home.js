/*global _mPHeart*/

jQuery(function () {
    jQuery('#home').find('.apps .appFolder').click(function (event) {
        event.preventDefault();
        _mojePanstwoCockpitSlider.showDialogBox(event);
    });
});