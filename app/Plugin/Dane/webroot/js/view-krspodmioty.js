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
        connectionGraph = jQuery('#connectionGraph'),
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

    if (connectionGraph.length > 0) {
        var d3Data = {
            'width': connectionGraph.outerWidth(),
            'height': 500,
            'color': {
                'links': '#333333',
                'podmiot': "#FF0000",
                'osoba': "#0000FF"
            },
            size: {
                'links': 150,
                'nodes': 50
            }
        };
        d3Data.force = d3.layout.force().linkDistance(d3Data.size.links).linkStrength(2).size([d3Data.width, d3Data.height]);
        d3Data.svg = d3.select("#connectionGraph").append("svg").attr("width", d3Data.width).attr("height", d3Data.height);

        d3.json(connectionGraph.data('id') + "/graph.json", function (error, results) {
            var graph = results._layers.graph;

            var nodes = graph.nodes.slice(),
                links = [];

            graph.relationships.forEach(function (link) {
                var s = jQuery.grep(nodes, function (e) {
                        return e.id == link.start;
                    })[0],
                    t = jQuery.grep(nodes, function (e) {
                        return e.id == link.end;
                    })[0];
                links.push({source: s, target: t});
            });

            d3Data.force
                .nodes(nodes)
                .links(links)
                .start();

            var link = d3Data.svg.selectAll(".link")
                .data(links)
                .enter().append("line")
                .attr("class", "link")
                .style({"stroke-width": 1, 'stroke': d3Data.color.links});

            var node = d3Data.svg.selectAll(".node")
                    .data(nodes)
                    .enter().append("g")
                    .attr("class", "node")
                    .attr("transform", function (d) {
                        return "translate(" + d.x + "," + d.y + ")";
                    })
            //.call(d3Data.force.drag)
                ;

            node.append("circle")
                .attr("r", d3Data.size.nodes)
                .style("fill", function (d) {
                    return d3Data.color[d.label]
                });

            node.append("text")
                .attr("dy", ".3em")
                .attr('class', 'nodeText')
                .style("text-anchor", "middle")
                .text(function (d) {
                    var name = '';
                    if (d.label == 'podmiot')
                        name = d.data.nazwa;
                    else if (d.label == 'osoba')
                        name = d.data.imiona + ' ' + d.data.nazwisko;
                    return name.substring(0, d3Data.size.nodes / 3);
                })
                .style("fill-opacity", 1);

            d3Data.force.on("tick", function () {
                link.attr("x1", function (d) {
                    return d.source.x;
                })
                    .attr("y1", function (d) {
                        return d.source.y;
                    })
                    .attr("x2", function (d) {
                        return d.target.x;
                    })
                    .attr("y2", function (d) {
                        return d.target.y;
                    });

                node.attr("cx", function (d) {
                    return d.x;
                })
                    .attr("cy", function (d) {
                        return d.y;
                    });
            });
        });
    }
});