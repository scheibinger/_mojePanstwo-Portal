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

        if (connectionGraph.length > 0) {
            var d3Data = {
                'width': connectionGraph.outerWidth(),
                'height': 500, /*DEFAULT HEIGHT SETTING*/
                'color': {
                    'mainFill': '#278DCD',
                    'links': '#333333',
                    'podmiot': "#6CACD8",
                    'osoba': "#24333A"
                },
                size: {
                    'distance': 50,
                    'linksLength': 80,
                    'linksWidth': 1,
                    'linkText': '8px',
                    'nodesPodmiot': 50,
                    'nodesOsoba': 40,
                    'nodeText': '10px',
                    'nodeTextBox': 12,
                    'nodeTextSeparate': 4
                }
            };

            d3Data.size.borderPadding = ((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba) + 10;
            d3Data.force = d3.layout.force()
                .gravity(0.1)
                .charge(-900)
                .linkDistance(d3Data.size.linksLength + d3Data.size.distance)
                .linkStrength(2);

            d3Data.svg = d3.select("#connectionGraph").append("svg");

            d3.json(connectionGraph.data('id') + "/graph.json", function (error, results) {
                var graph = results._layers.graph;

                var nodes = graph.nodes,
                    links = [];

                var zoom = d3.behavior.zoom()
                    .scaleExtent([0.1, 2])
                    .on("zoom", zoomed);

                /*SIZE SETTING*/
                var newHeight = (((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba) * nodes.length) * .8;
                d3Data.height = (newHeight > d3Data.height) ? newHeight : d3Data.height;
                d3Data.force.size([d3Data.width, d3Data.height]);
                d3Data.svg
                    .attr("width", d3Data.width)
                    .attr("height", d3Data.height);

                /*ADD CALLS*/
                d3Data.force
                    .on("tick", tick);
                d3Data.svg
                    .call(zoom);

                var root = nodes[0];
                root.fixed = true;
                root.x = (d3Data.width / 2);
                root.y = ((root.label == 'podmiot') ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba) + 20;

                graph.relationships.forEach(function (link) {
                    var s = jQuery.grep(nodes, function (e) {
                            return e.id == link.start;
                        })[0],
                        t = jQuery.grep(nodes, function (e) {
                            return e.id == link.end;
                        })[0];
                    links.push({source: s, target: t, label: link.type, id: link.id});
                });

                d3Data.force
                    .nodes(d3.values(nodes))
                    .links(links)
                    .start();

                // Per-type markers, as they don't inherit styles.
                d3Data.svg.append("defs").selectAll("marker")
                    .data(["arrow"])
                    .enter().append("marker")
                    .attr("id", function (d) {
                        return d;
                    })
                    .attr("viewBox", "0 -5 10 10")
                    .attr("refX", ((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba) + 20)
                    .attr("refY", 0)
                    .attr("markerWidth", 8)
                    .attr("markerHeight", 8)
                    .attr("orient", "auto")
                    .append("path")
                    .attr("d", "M0,-5L10,0L0,5");

                /*CREATE LINE*/
                var path = d3Data.svg.append("g").selectAll("path")
                    .data(links)
                    .enter().append("path")
                    .attr('class', 'link')
                    .attr("marker-end", "url(#arrow)")
                    .style({"fill": "none", "stroke-width": d3Data.size.linksWidth, 'stroke': d3Data.color.links});

                /*CREATE CIRCLE*/
                var circle = d3Data.svg.append("g").selectAll("circle")
                    .data(nodes)
                    .enter().append("circle")
                    .attr('class', 'circleBottom')
                    .attr("r", function (d) {
                        if (d.label == "podmiot") {
                            return d3Data.size.nodesPodmiot;
                        }
                        else if (d.label == "osoba") {
                            return d3Data.size.nodesOsoba;
                        }
                    })
                    .style("stroke-width", 2)
                    .style("stroke", function (d) {
                        return d3Data.color[d.label];
                    })
                    .style("fill", function (d) {
                        if (d.id == root.id)
                            return d3Data.color['mainFill'];
                        else
                            return d3Data.color[d.label];
                    });

                /*CREATE SHADOW UNDER LINE TEXT*/
                var pathTextShadow = d3Data.svg.append("g").selectAll("text")
                    .data(links)
                    .enter().append("text")
                    .attr('class', 'pathTextShadow')
                    .style("text-anchor", "middle")
                    .style("font-size", d3Data.size.linkText)
                    .style("stroke", "white")
                    .style("stroke-width", "2px")
                    .style("opacity", '0.9')
                    .text(function (d) {
                        return d.label;
                    });

                /*CREATE LINE TEXT*/
                var pathText = d3Data.svg.append("g").selectAll("text")
                    .data(links)
                    .enter().append("text")
                    .attr('class', 'pathText')
                    .style("text-anchor", "middle")
                    .style("font-size", d3Data.size.linkText)
                    .style("fill", "#000")
                    .text(function (d) {
                        return d.label;
                    });

                /*CREATE CIRCLE TEXT*/
                var circleText = d3Data.svg.append("g").selectAll("text")
                    .data(nodes)
                    .enter().append("text")
                    .attr('class', 'circleText')
                    .style("text-anchor", "middle")
                    .style("font-size", d3Data.size.nodeText)
                    .style("fill", "#ffffff")
                    .each(function (d) {
                        var name, nameBegin, nameEnd, lines,
                            limit = Math.floor((d.label == "podmiot") ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba),
                            width = Math.floor(((d.label == "podmiot") ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba) / 2.5),
                            regex = '.{1,' + width + '}(\\s|$)' + ('|\\S+?(\\s|$)');

                        if (d.label == 'podmiot')
                            name = d.data.nazwa;
                        else if (d.label == 'osoba')
                            name = d.data.imiona + ' ' + d.data.nazwisko;

                        nameBegin = name.substring(0, limit);
                        nameEnd = name.substring(limit);
                        name = nameBegin + nameEnd.substring(0, nameEnd.indexOf(' '));

                        if (d.id == root.id) name = name.toUpperCase();

                        lines = name.match(RegExp(regex, 'g')).join('\n').split('\n');

                        for (var i = 0; i < lines.length; i++) {
                            var y = ( (lines.length % 2 == 0) ? ((d3Data.size.nodeTextSeparate / 2) + d3Data.size.nodeTextBox) : (d3Data.size.nodeTextBox / 2)) - ( (Math.floor(lines.length / 2)) * (d3Data.size.nodeTextBox + d3Data.size.nodeTextSeparate) ) + ( i * (d3Data.size.nodeTextBox + d3Data.size.nodeTextSeparate) );

                            d3.select(this)
                                .append("tspan")
                                .attr('x', 0)
                                .attr('y', y)
                                .style("stroke", "rgba(0,0,0,.5)")
                                .style("stroke-width", "3px")
                                .text(lines[i]);
                            d3.select(this)
                                .append("tspan")
                                .attr('x', 0)
                                .attr('y', y)
                                .text(lines[i]);
                        }
                    });

                /*CREATE CIRCLE*/
                var circleDump = d3Data.svg.append("g").selectAll("circle")
                    .data(nodes)
                    .enter().append("circle")
                    .attr('class', 'circle')
                    .attr("r", function (d) {
                        if (d.label == "podmiot") {
                            return d3Data.size.nodesPodmiot + 4;
                        }
                        else if (d.label == "osoba") {
                            return d3Data.size.nodesOsoba + 4;
                        }
                    })
                    .style('fill-opacity', 0)
                    .call(d3Data.force.drag)
                    .on('mousemove', function (d) {
                        d.fixed = true;
                    })
                    .on('dblclick', function (d) {
                        detailInfo(d);
                    });

                function bouncyBordersX(axis) {
                    if (axis < d3Data.size.borderPadding) axis = d3Data.size.borderPadding + Math.floor((Math.random() * 20) - 10);
                    if (axis > d3Data.width - d3Data.size.borderPadding) axis = d3Data.width - d3Data.size.borderPadding - Math.floor((Math.random() * 20) - 10);

                    return axis;
                }

                function bouncyBordersY(axis) {
                    if (axis < d3Data.size.borderPadding) axis = d3Data.size.borderPadding * 2 + Math.floor((Math.random() * 20) + 10);
                    if (axis > d3Data.height - d3Data.size.borderPadding) axis = d3Data.height - d3Data.size.borderPadding - Math.floor((Math.random() * 20) - 10);

                    return axis;
                }

                function tick() {
                    path.attr("d", function (d) {
                        d.source.x = bouncyBordersX(d.source.x);
                        d.source.y = bouncyBordersY(d.source.y);
                        d.target.x = bouncyBordersX(d.target.x);
                        d.target.y = bouncyBordersY(d.target.y);

                        return "M" + d.source.x + "," + d.source.y + "A" + 0 + "," + 0 + " 0 0,1 " + d.target.x + "," + d.target.y;
                    });
                    pathTextShadow.attr("transform", function (d) {
                        d.source.x = bouncyBordersX(d.source.x);
                        d.source.y = bouncyBordersY(d.source.y);
                        d.target.x = bouncyBordersX(d.target.x);
                        d.target.y = bouncyBordersY(d.target.y);

                        return "translate(" + (d.source.x + d.target.x) / 2 + "," + (d.source.y + d.target.y) / 2 + ")";
                    });
                    pathText.attr("transform", function (d) {
                        d.source.x = bouncyBordersX(d.source.x);
                        d.source.y = bouncyBordersY(d.source.y);
                        d.target.x = bouncyBordersX(d.target.x);
                        d.target.y = bouncyBordersY(d.target.y);

                        return "translate(" + (d.source.x + d.target.x) / 2 + "," + (d.source.y + d.target.y) / 2 + ")";
                    });
                    circle.attr("transform", function (d) {
                        d.x = bouncyBordersX(d.x);
                        d.y = bouncyBordersY(d.y);

                        return "translate(" + d.x + "," + d.y + ")";
                    });
                    circleText.attr("transform", function (d) {
                        d.x = bouncyBordersX(d.x);
                        d.y = bouncyBordersY(d.y);

                        return "translate(" + d.x + "," + d.y + ")";
                    });
                    circleDump.attr("transform", function (d) {
                        d.x = bouncyBordersX(d.x);
                        d.y = bouncyBordersY(d.y);

                        return "translate(" + d.x + "," + d.y + ")";
                    });

                    var q = d3.geom.quadtree(nodes),
                        i = 0,
                        n = nodes.length;

                    while (++i < n) {
                        q.visit(collide(nodes[i]));
                    }
                }

                function collide(node) {
                    var alpha = .5,
                        nodePadding = 10,
                        r = (node.label == "podmiot") ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba;

                    var nx1 = node.x - r - nodePadding,
                        nx2 = node.x + r + nodePadding,
                        ny1 = node.y - r - nodePadding,
                        ny2 = node.y + r + nodePadding;

                    return function (quad, x1, y1, x2, y2) {

                        if (quad.point && (quad.point !== node)) {
                            var x = node.x - quad.point.x,
                                y = node.y - quad.point.y,
                                l = Math.sqrt(x * x + y * y),
                                r = (2 * r) + (2 * nodePadding);
                            if (l < r) {
                                l = (l - r) / l * alpha;
                                node.x -= x *= l;
                                node.y -= y *= l;

                                quad.point.x += x;
                                quad.point.y += y;
                            }
                        }

                        return x1 > nx2
                            || x2 < nx1
                            || y1 > ny2
                            || y2 < ny1;
                    };
                }

                function detailInfo(node) {
                    connectionGraph.find('.dataContent').remove();

                    var dataContent = jQuery('<div></div>').addClass('dataContent').css('width', d3Data.width / 2);
                    dataContent.append(jQuery('<button></button>').addClass('btn btn-xs pull-right').text('x'));
                    dataContent.append(jQuery('<table></table>').addClass('table table-striped'));

                    var linkEl = jQuery('<a></a>').attr('target', '_self').text(_mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_LINK);

                    jQuery.each(node.data, function (label, value) {
                        if (label == 'mp_id') {
                            if (node.label == "podmiot") {
                                linkEl.attr('href', '/dane/podmiot/' + value);
                            } else if (node.label == "osoba") {
                                linkEl.attr('href', '/dane/osoba/' + value);
                            }
                        } else {
                            var tr = jQuery('<tr></tr>');

                            if (label == 'data_urodzenia')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_DATA_URODZENIA;
                            if (label == 'plec') {
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_PLEC;
                                if (value == 'K')
                                    value = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_KOBIETA;
                                else if (value == 'M')
                                    value = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_MEZCZYZNA;
                            }
                            if (label == 'nazwisko')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_NAZWISKO;
                            if (label == 'imiona')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_IMIONA;
                            if (label == 'krs')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_KRS;
                            if (label == 'kapital_zakladowy')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_KAPITAL_ZAKLADOWY;
                            if (label == 'miejscowosc')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_MIEJSCOWOSC;
                            if (label == 'data_rejestracji')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_REJESTRACJI;
                            if (label == 'forma')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_FORMA_PRAWNA;
                            if (label == 'nazwa')
                                label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_NAZWA;
                            tr.append(jQuery('<td></td>').text(label));
                            tr.append(jQuery('<td></td>').text(value));
                            dataContent.find('table').append(tr);
                        }
                    });

                    var link = jQuery('<tr></tr>').append(
                        jQuery('<td colspan="2"></td>').append(linkEl)
                    );
                    dataContent.find('table').append(link);

                    connectionGraph.append(dataContent);

                    connectionGraph.find('.dataContent .btn').click(function () {
                        connectionGraph.find('.dataContent').remove();
                    });
                }

                function zoomed() {
                    container.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
                }
            });
        }

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
)
;