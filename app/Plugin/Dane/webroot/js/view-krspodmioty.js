/*global googleMapAdres: true*/

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
        sys = null,
        dataHighlightsOptions = jQuery('.dataHighlightsOptions');

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

    /*jQuery.ajax({
     url: "graph.json",
     type: "GET",
     beforeSend: function () {
     sys = arbor.ParticleSystem();
     sys.parameters({stiffness: 900, repulsion: 2000, gravity: true, dt: 0.015});
     sys.renderer = Renderer("#connectionGraph");
     },
     success: function (data) {
     jQuery.each(data.nodes, function () {
     if (this.label == 'podmiot') {
     sys.addNode(this.id, {'color': 'blue', 'shape': 'dot', 'label': this.label, 'data': this.data, radius: .3});
     } else if (this.label == 'osoba') {
     sys.addNode(this.id, {'color': 'green', 'shape': 'dot', 'label': this.label, 'data': this.data, radius: .3});
     }
     });
     jQuery.each(data.relationships, function () {
     sys.addEdge(this.start, this.end, {'data': this.data});
     });
     }
     });*/
});

(function ($) {
    var Renderer = function (elt) {
        var dom = $(elt);
        var canvas = dom.get(0);
        var gfx = arbor.Graphics(canvas);
        var sys = null;

        var selected = null,
            nearest = null,
            _mouseP = null;


        var that = {
            init: function (pSystem) {
                sys = pSystem;
                sys.screen({size: {width: dom.width(), height: dom.height()},
                    padding: [20, 0, 20, 0]});

                $(window).resize(that.resize);
                that.resize();
                that._initMouseHandling();
            },
            resize: function () {
                canvas.width = dom.width();
                canvas.height = '500';
                sys.screen({size: {width: canvas.width, height: canvas.height}});
                that.redraw();
            },
            redraw: function () {
                gfx.clear();
                sys.eachEdge(function (edge, p1, p2) {
                    gfx.line(p1, p2, {stroke: "#b2b19d", width: 2});
                });
                sys.eachNode(function (node, pt) {
                    var name;
                    if (node.data.label == 'osoba') {
                        name = node.data.data.imiona + ' ' + node.data.data.nazwisko;
                    } else if (node.data.label == 'podmiot') {
                        name = node.data.data.nazwa;
                    }
                    var w = Math.max(20, gfx.textWidth(name) * .7);
                    if (node.data.shape == 'dot') {
                        gfx.oval(pt.x - w / 2, pt.y - w / 2, w, w, {fill: node.data.color, radius: node.data.radius});
                        gfx.text(name, pt.x, pt.y + 7, {color: "white", align: "center", font: "Arial", size: 8});
                        //gfx.text(name, pt.x, pt.y + 7, {color: "white", align: "center", font: "Arial", size: 10});
                    } else {
                        gfx.rect(pt.x - w / 2, pt.y - 8, w, 20, 4, {fill: node.data.color, radius: node.data.radius});
                        gfx.text(name, pt.x, pt.y + 9, {color: "white", align: "center", font: "Arial", size: 8});
                        //gfx.text(name, pt.x, pt.y + 9, {color: "white", align: "center", font: "Arial", size: 10});
                    }
                });
            },
            switchMode: function (e) {
                if (e.mode == 'hidden') {
                    dom.stop(true).fadeTo(e.dt, 0, function () {
                        if (sys) sys.stop();
                        $(this).hide();
                    })
                } else if (e.mode == 'visible') {
                    dom.stop(true).css('opacity', 0).show().fadeTo(e.dt, 1, function () {
                        that.resize()
                    });
                    if (sys) sys.start()
                }
            },
            switchSection: function (newSection) {
                var parent = $.map(sys.getEdgesTo(newSection), function (edge) {
                    return edge.target;
                });
                var children = $.map(sys.getEdgesFrom(newSection), function (edge) {
                    return edge.target;
                });
                console.log(parent, children);
            },
            _initMouseHandling: function () {
                selected = null;
                nearest = null;
                var dragged = null;

                var handler = {
                    moved: function (e) {
                        var pos = $(canvas).offset();
                        _mouseP = arbor.Point(e.pageX - pos.left, e.pageY - pos.top);
                        nearest = sys.nearest(_mouseP);
                        if (!nearest.node) return false;

                        sys.tweenNode(nearest, 3, {radius: 1});

                        return false
                    },
                    clicked: function (e) {
                        var pos = $(canvas).offset();
                        _mouseP = arbor.Point(e.pageX - pos.left, e.pageY - pos.top);
                        nearest = dragged = sys.nearest(_mouseP);

                        sys.tweenNode(nearest, 3, {radius: 1});

                        if (dragged && dragged.node !== null) dragged.node.fixed = true;

                        $(canvas).unbind('mousemove', handler.moved);
                        $(canvas).bind('mousemove', handler.dragged);
                        $(window).bind('mouseup', handler.dropped);

                    },
                    dragged: function (e) {
                        var pos = $(canvas).offset();
                        var s = arbor.Point(e.pageX - pos.left, e.pageY - pos.top);

                        if (!nearest) return;
                        if (dragged !== null && dragged.node !== null) {
                            dragged.node.p = sys.fromScreen(s)
                        }
                    },

                    dropped: function () {
                        if (dragged === null || dragged.node === undefined) return;
                        if (dragged.node !== null) dragged.node.fixed = false;
                        dragged.node.tempMass = 50;
                        dragged = null;
                        $(canvas).unbind('mousemove', handler.dragged);
                        $(window).unbind('mouseup', handler.dropped);
                        $(canvas).bind('mousemove', handler.moved);
                        _mouseP = null;
                    }
                };

                $(canvas).mousedown(handler.clicked);
                $(canvas).mousemove(handler.moved);

            }
        };

        return that;
    };
})(jQuery);