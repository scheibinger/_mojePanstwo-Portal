$(document).ready(function () {
    var lastChoose,
        $administracja = lastChoose = $('#administracja');

    $.each($administracja.find('.item a'), function () {
        var that = $(this),
            block = that.parents('.block');

        that.click(function (e) {
            var next = block.next(),
                targetPos = block.position().top,
                slideMark,
                data = that.data();

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
            infoBlock.data('marker', slideMark).find('.container').empty().append(function () {
                var slug = $(this)
                    , title = $.trim(data.title)
                    , info = data.info
                    ;

                console.log(slug, data);

                var leftCol = $('<div></div>').addClass('leftSide col-xs-12 col-md-6').append(
                        $('<div></div>').addClass('left col-xs-6')
                    ).append(
                        $('<div></div>').addClass('right col-xs-6')
                    );
                var rightCol = $('<div></div>').addClass('rightSide col-xs-12 col-md-6');

                leftCol.find('.left').before($('<h3></h3>').addClass('slugTitle').text(title));
                $.each(info, function (key, val) {
                    var i;

                    if (key == 'adres') {
                        leftCol.find('.left').append($('<div></div>').addClass('slugAdres'));
                        i = 0;
                        while (val[i]) {
                            var adr = val[i];
                            var adresRegexp = adr.match(/[0-9][0-9][-][0-9][0-9][0-9]/);
                            if (adresRegexp)
                                adr = adr.substr(0, adresRegexp.index) + "<br/>" + adr.substr(adresRegexp.index);
                            leftCol.find('.left .slugAdres').append($('<p></p>').html(adr));
                            i++;
                        }
                    }
                    if (key == 'www') {
                        leftCol.find('.right')
                            .append($('<h4></h4>').text(_mPHeart.translation.LC_ADMINISTRACJA_INFO_WWW))
                            .append($('<div></div>').addClass('slugWWW'));
                        i = 0;
                        while (val[i]) {
                            var www = val[i];
                            leftCol.find('.right .slugWWW').append($('<a></a>').attr({href: www, target: '_blank'}).text(www))
                            i++;
                        }
                    }
                    if (key == 'email') {
                        leftCol.find('.right')
                            .append($('<h4></h4>').text(_mPHeart.translation.LC_ADMINISTRACJA_INFO_EMAIL))
                            .append($('<div></div>').addClass('slugEmail'));
                        i = 0;
                        while (val[i]) {
                            var email = val[i];
                            leftCol.find('.right .slugEmail').append($('<a></a>').attr('href', 'mailto:' + $.trim(email)).text(email))
                            i++;
                        }
                    }
                    if (key == 'telefon') {
                        leftCol.find('.right')
                            .append($('<h4></h4>').text(_mPHeart.translation.LC_ADMINISTRACJA_INFO_TELEFON))
                            .append($('<div></div>').addClass('slugTelefon'));
                        i = 0;
                        while (val[i]) {
                            var tel = val[i];
                            leftCol.find('.right .slugTelefon').append($('<p></p>').text(tel));
                            i++;
                        }
                    }
                    if (key == 'fax') {
                        leftCol.find('.right')
                            .append($('<h4></h4>').text(_mPHeart.translation.LC_ADMINISTRACJA_INFO_FAX))
                            .append($('<div></div>').addClass('slugFax'));
                        i = 0;
                        while (val[i]) {
                            var fax = val[i];
                            leftCol.find('.right .slugFax').append($('<p></p>').text(fax));
                            i++;
                        }
                    }
                    if (key == 'instytucje') {
                        i = 0;
                        rightCol.append($('<h4></h4>').text(_mPHeart.translation.LC_ADMINISTRACJA_INFO_INSTYTUCJE));
                        while (val[i]) {
                            var inst = val[i];
                            rightCol.append($('<p></p>').text(inst));
                            i++;
                        }
                    }
                });

                leftCol.find('.left').append(
                    $('<a></a>').addClass('btn btn-primary').attr({href: that.attr('href'), target: '_self'}).text(_mPHeart.translation.LC_ADMINISTRACJA_INFO_WIECEJ)
                );

                slug.append(leftCol).append(rightCol);
            });

            if (infoBlock.position().left != 0) {
                infoBlock.css({'margin-left': -infoBlock.position().left, width: $(window).width()})
            }
            infoBlock.find('.arrow').css('left', block.position().left + (block.outerWidth() / 2) + 'px');
            infoBlock.removeClass('current').css('height', infoBlock.find('.container').outerHeight(true));
        })
    })
})
;