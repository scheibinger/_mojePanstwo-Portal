/*global googleMapAdres: true, connectionGraphObject*/

function initialize() {
    //SETTING DEFAULT CENTER TO GOOGLE MAP AT POLAND//
    var polandLatlng = new google.maps.LatLng(51.919438, 19.145136),
        mapOptions = {
            zoom: 15,
            center: polandLatlng
        },
        map = new google.maps.Map(document.getElementById('googleMap'), mapOptions),
        geocoder = new google.maps.Geocoder(),
        contentString = document.createElement("div");
    contentString.innerHTML = googleMapAdres + '<a href="https://maps.google.com/maps?daddr=' + googleMapAdres.replace(/ /g, '+') + '&t=m" target="_blank" class="btn btn-info">Dojazd</a>';
    contentString.id = "googleMapsContent";
    contentString.style.width = "360px";

    /*GETTING HEIGHT OF CONTENT*/
    var contentStringHeightTemp = contentString.cloneNode(true);
    contentStringHeightTemp.style.visibility = "hidden";
    document.body.appendChild(contentStringHeightTemp);

    /*ADDING HEIGHT TO ORIGIN NODE*/
    /*ADDING HEIGHT TO ORIGIN NODE*/
    contentString.style.height = contentStringHeightTemp.clientHeight;

    /*REMOVING CLONED NODE*/
    var element = document.getElementById("googleMapsContent");
    element.parentNode.removeChild(element);

    infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    geocoder.geocode({ 'address': googleMapAdres}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });

            //CENTER ON MARKER
            map.setCenter(results[0].geometry.location);

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });

            //NEED TO WAIT A LITTLE UNTIL MAP IDLE AND CAN CENTER ON AUTO OPEN INFOWINDOW//
            google.maps.event.addListenerOnce(map, 'idle', function () {
                setTimeout(function () {
                    google.maps.event.trigger(marker, 'click');
                }, 2000);
            });
        }
    });
}

//ASYNC INIT GOOGLE MAP JS//
function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=' + _mPHeart.language.twoDig + '&' + 'callback=initialize';
    document.body.appendChild(script);
}

jQuery(document).ready(function () {
        var banner = jQuery('.profile_baner'),
            menu = jQuery('.objectsPageContent .objectMenu'),
            menuAutoScroll = true,
            headerHeight = jQuery('header').outerHeight(),
            dataHighlightsOptions = jQuery('.dataHighlightsOptions'),
            $showHideSide = $('.showHideSide'),
            $objectSideInner = $('.objectSideInner');

        if (banner.length > 0) {
            banner.find('.bg img').css('width', banner.width() + 'px');

            /*ASYNCHRONIZE ACTION FOR GOOGLE MAP*/
            window.onload = loadScript();

            banner.find('.bg .btn').click(function () {
                banner.find('.bg').fadeOut()
            });
        }

        /*STICKY MENU*/
        menu.attr('id', 'stickyMenu').css('width', menu.outerWidth() + 'px');
        sticky('#stickyMenu');

        menu.find('.nav a').click(function (event) {
            var target = jQuery(this).attr('href'),
                padding = 10;
            event.preventDefault();

            menuAutoScroll = false;
            menu.find('li.active').removeClass('active');
            jQuery(this).parent('li').addClass('active');

            jQuery('body, html').stop(true, true).animate({
                scrollTop: jQuery(target).offset().top - jQuery('header').outerHeight() - padding
            }, 800, function () {
                menuAutoScroll = true;
            });
        });

        if (dataHighlightsOptions.length > 0) {
            var dataHighlights = jQuery('.dataHighlights');

            dataHighlightsOptions.find('.btn').click(function () {
                if (jQuery(this).hasClass('showMore')) {
                    dataHighlightsOptions.find('.showMore').addClass('hidden');
                    dataHighlightsOptions.find('.showLess').removeClass('hidden');
                    dataHighlights.find('.secondRow').show();
                } else if (jQuery(this).hasClass('showLess')) {
                    dataHighlightsOptions.find('.showLess').addClass('hidden');
                    dataHighlightsOptions.find('.showMore').removeClass('hidden');
                    dataHighlights.find('.secondRow').hide();
                }
            })
        }

        jQuery(window).scroll(function () {
            if (menuAutoScroll) {
                var windscroll = jQuery(window).scrollTop(),
                    searchHeight = (jQuery('._mojePanstwoCockpitSearchInput:visible') ? jQuery('._mojePanstwoCockpitSearchInput').outerHeight() : 0);
                if (windscroll >= 100) {
                    jQuery('.objectsPageContent .object > .block').each(function (i) {
                        if (jQuery(this).position().top <= windscroll + headerHeight + searchHeight + 60) {
                            menu.find('li.active').removeClass('active');
                            menu.find('li').eq(i).addClass('active');
                        }
                    });
                } else {
                    menu.find('li.active').removeClass('active');
                    menu.find('li:first').addClass('active');
                }
            }
        }).scroll();

        $showHideSide.find('> a').click(function () {
            var that = $(this);
            $showHideSide.find('>a').removeClass('hide');
            that.addClass('hide');
            if (that.hasClass('a-more')) {
                $objectSideInner.find('.dataHighlights.hide').removeClass('hide').hide().addClass('unhide').slideDown();
            } else if (that.hasClass('a-less')) {
                $objectSideInner.find('.dataHighlights.unhide').slideUp(function () {
                    $objectSideInner.find('.dataHighlights.unhide').removeClass('uhhide').addClass('hide');
                });
            }
        })
    }
);