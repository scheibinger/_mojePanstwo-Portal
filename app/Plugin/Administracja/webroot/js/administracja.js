$(document).ready(function () {
    var lastChoose,
        $administracja = lastChoose = $('#administracja');

    $.each($administracja.find('.item a'), function () {
        var that = $(this),
            block = that.parents('.block');

        that.click(function (e) {
            var next = block.next(),
                targetPos = block.position().top,
                slideMark;

            e.preventDefault();

            if (block[0] === lastChoose[0])
                return;
            else
                lastChoose = block;

            if (next.length == 0) {
                slideMark = block;
            } else {
                while (next.length != 0) {
                    if (next.next().length == 0) {
                        slideMark = next;
                        break;
                    } else {
                        if (next.position().top != targetPos) {
                            slideMark = next.prev();
                            break;
                        }
                        next = next.next();
                    }
                }
            }

            var infoBlock = $('<div></div>').addClass('infoBlock current').css('height', 0).append(
                    $('<div></div>').addClass('arrow')
                ).append(
                    $('<div></div>').addClass('container')
                );

            if ($administracja.find('.infoBlock').length !== 0) {
                if ($administracja.find('.infoBlock').data('marker')[0] === slideMark[0]) {
                    infoBlock = $administracja.find('.infoBlock');
                    infoBlock.addClass('current');
                } else {
                    $administracja.find('.infoBlock').addClass('old').css('height', 0);
                    slideMark.after(infoBlock);
                }
            } else {
                slideMark.after(infoBlock);
            }

            $administracja.find('.infoBlock.old').remove();
            infoBlock.data('marker', slideMark).find('.container').empty().append(
                $('<p></p>').text('test' + Math.random())
            );
            if (infoBlock.position().left != 0) {
                infoBlock.css({'margin-left': -infoBlock.position().left, width: $(window).width()})
            }
            infoBlock.find('.arrow').css('left', block.position().left + (block.outerWidth() / 2) + 'px');
            infoBlock.removeClass('current').css('height', infoBlock.find('.container').outerHeight(true));
        })
    })
});