/*RUN CAROUSEL AT CATALOG PAGE PLUS DETERMINATE HEIGHT OF ELEMENT EQUAL OF HIGHEST HEIGHT*/
var countDataObjectsSliderRowDetect = false;

function countDataObjectsSliderRow() {
    $('.dataobjectsSliderRow').each(function () {
        var height = 0,
            row = 2,
            block = $(this),
            blockSlider = block.find('.dataobjectsSlider');

        //RESET POTENCIAL BAD SETTING
        block.find('.carousel-inner .item, .carousel-inner .item .object').css('height', 'auto');

        block.find('.carousel-inner').each(function () {
            $(this).find('.item .object').each(function () {
                if (height < $(this).actual('outerHeight'))
                    height = $(this).actual('outerHeight')
            })
        });

        if (blockSlider.data('rownumber') !== undefined)
            row = blockSlider.data('rownumber');

        block.find('.carousel-inner .item').css('height', row * height);
        block.find('.carousel-inner .item .object').css('height', height);

        countDataObjectsSliderRowDetect = true;
    })
}

$(document).ready(function () {
    countDataObjectsSliderRow();
});