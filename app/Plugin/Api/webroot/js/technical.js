(function ($) {
    $('#navbar').css({'width': $('#navbar').width()});
    $('body').scrollspy({ target: '#navbar' });
    $('#navbar').affix({
        offset: {
            top: function () {
                return (this.top = $('.jumbotron').outerHeight(true))
            }, bottom: function () {
                return (this.bottom = $('footer').outerHeight(true))
            }
        }
    })
}(jQuery));