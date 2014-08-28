/*global _mPHeart*/
(function ($) {
    var _mPCockpit = $('#_mPCockpit'),
        _mPApplication = _mPCockpit.find('._mPApplication'),
        _mPCockpitHeart = _mPHeart.cockpit;

    _mPApplication.find('> _appBlock').click(function (e) {
        var option = $(this);

        e.preventDefault();

        if (option.hasClass('_mPSearch')) {
            //search
        } else if (option.hasClass('_mPAppsList')) {
            var _mPAppList = $('._mPAppList');
            console.log(_mPAppList);
            _mPAppList.animate({width: 'toggle'})
        } else if (option.hasClass('_mPFavorite ')) {
            //favorite
        }
    });
})(jQuery);