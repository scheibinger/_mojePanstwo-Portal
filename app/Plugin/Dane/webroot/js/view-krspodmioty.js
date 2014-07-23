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

(function ($) {
    var connectionGraph = jQuery('#connectionGraph');

    if (connectionGraph.length > 0) {
        var margin = {top: -5, right: -5, bottom: -5, left: -5},
            width = connectionGraph.outerWidth() + 60 - margin.left - margin.right,
            height = connectionGraph.outerHeight() - margin.top - margin.bottom,
            d3Data = {
                'color': {
                    'mainFill': '#278DCD',
                    'links': '#333333',
                    'podmiot': "#6CACD8",
                    'osoba': "#24333A"
                },
                size: {
                    'distance': 150,
                    'linksLength': 40,
                    'linksWidth': 1,
                    'linkText': '4px',
                    'nodesPodmiot': 30,
                    'nodesOsoba': 20,
                    'nodeText': '5px',
                    'nodeTextBox': 6,
                    'nodeTextSeparate': 2
                }
            };

        d3.json("/dane/krs_podmioty/" + connectionGraph.data('id') + "/graph.json", function (error, results) {
            var graph = results._layers.graph;

            var nodes = graph.nodes,
                links = [],
                root = nodes[0];

            root.fixed = true;
            root.x = (width / 2);
            root.y = ((root.label == 'podmiot') ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba) + 20;

            graph.relationships.forEach(function (link) {
                var s = $.grep(nodes, function (e) {
                        return e.id == link.start;
                    })[0],
                    t = $.grep(nodes, function (e) {
                        return e.id == link.end;
                    })[0];
                links.push({source: s, target: t, label: link.type, id: link.id});
            });

            // Sort links by source, then target
            links.sort(function (a, b) {
                if (a.source.id > b.source.id) {
                    return 1;
                } else if (a.source.id < b.source.id) {
                    return -1;
                } else {
                    if (a.target.id > b.target.id) {
                        return 1;
                    } else if (a.target.id < b.target.id) {
                        return -1;
                    } else {
                        return 0;
                    }
                }
            });

            // Any links with duplicate source and target get an incremented 'linknum'
            for (var i = 0; i < links.length; i++) {
                if (i != 0 &&
                    links[i].source.id == links[i - 1].source.id &&
                    links[i].target.id == links[i - 1].target.id) {
                    links[i].linknum = links[i - 1].linknum + 1;
                }
                else {
                    links[i].linknum = 1;
                }
            }

            d3Data.zoom = d3.behavior.zoom()
                .scaleExtent([1, 4])
                .on("zoom", zoomed);

            d3Data.drag = d3.behavior.drag()
                .origin(function (d) {
                    return d;
                })
                .on("dragstart", dragstarted)
                .on("drag", dragged)
                .on("dragend", dragended);

            d3Data.svg = d3.select("#connectionGraph").append("svg:svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
                .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.right + ")")
                .call(d3Data.zoom)
                .on("dblclick.zoom", null);

            d3Data.borderLine = d3Data.svg.append("rect")
                .attr("width", width)
                .attr("height", height)
                .style("fill", "none")
                .style("pointer-events", "all");

            d3Data.innerContainer = d3Data.svg.append("g");

            d3Data.force = d3.layout.force()
                .gravity(0)
                .linkDistance(Math.floor((d3Data.size.linksLength + d3Data.size.distance)))
                .charge(function (d, i) {
                    return i ? 0 : -2000;
                })
                .nodes(d3.values(nodes))
                .links(links)
                .on("tick", tick)
                .start();

            // Per-type markers, as they don't inherit styles.
            d3Data.innerContainer.append("svg:defs").selectAll("marker")
                .data(["arrowPodmiot", "arrowOsoba", "arrow"])
                .enter().append("svg:marker")
                .attr("id", function (d) {
                    return d;
                })
                .attr("viewBox", "0 -5 10 10")
                .attr("refX", function (d) {
                    if (d == "arrowPodmiot")
                        return (d3Data.size.nodesPodmiot * 2);
                    else if (d == "arrowOsoba")
                        return (d3Data.size.nodesOsoba * 2);
                    else
                        return ((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? d3Data.size.nodesPodmiot * 2 : d3Data.size.nodesOsoba * 2);
                })
                .attr("refY", function (d) {
                    if (d == "arrowPodmiot")
                        return -5.5;
                    else if (d == "arrowOsoba")
                        return -3.5;
                    else
                        return ((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? -5.5 : -3.5);
                })
                .attr("markerWidth", 6)
                .attr("markerHeight", 6)
                .attr("orient", "auto")
                .append("svg:path")
                .attr("d", "M0,-5L10,0L0,5");

            /*CREATE LINE*/
            var path = d3Data.innerContainer.append("svg:g").selectAll("path")
                .data(d3Data.force.links())
                .enter().append("svg:path")
                .attr('class', 'link')
                .attr("marker-end", function (d) {
                    if (d.target.label == "podmiot")
                        return "url(#arrowPodmiot)";
                    else if (d.target.label == "osoba")
                        return "url(#arrowOsoba)";
                    else
                        return "url(#arrow)";
                })
                .style({"fill": "none", "stroke-width": d3Data.size.linksWidth, 'stroke': d3Data.color.links});

            /*CREATE CIRCLE*/
            var circle = d3Data.innerContainer.append("svg:g").selectAll("circle")
                .data(d3Data.force.nodes())
                .enter().append("svg:circle")
                .attr('class', 'circleBottom')
                .attr("r", function (d) {
                    if (d.label == "podmiot") {
                        return d3Data.size.nodesPodmiot;
                    }
                    else if (d.label == "osoba") {
                        return d3Data.size.nodesOsoba;
                    }
                })
                .style("stroke-width", "2px")
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
            var pathTextShadow = d3Data.innerContainer.append("svg:g").selectAll("text")
                .data(d3Data.force.links())
                .enter().append("svg:text")
                .attr('class', 'pathTextShadow')
                .style("text-anchor", "middle")
                .style("font-size", d3Data.size.linkText)
                .style("stroke", "white")
                .style("stroke-width", "1px")
                .style("opacity", '0.9')
                .text(function (d) {
                    return d.label;
                });

            /*CREATE LINE TEXT*/
            var pathText = d3Data.innerContainer.append("svg:g").selectAll("text")
                .data(links)
                .enter().append("svg:text")
                .attr('class', 'pathText')
                .style("text-anchor", "middle")
                .style("font-size", d3Data.size.linkText)
                .style("fill", "#000")
                .text(function (d) {
                    return d.label;
                });

            /*CREATE CIRCLE TEXT*/
            var circleText = d3Data.innerContainer.append("svg:g").selectAll("text")
                .data(nodes)
                .enter().append("svg:text")
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
                            .style("stroke-width", "1.5px")
                            .text(lines[i]);
                        d3.select(this)
                            .append("tspan")
                            .attr('x', 0)
                            .attr('y', y)
                            .text(lines[i]);
                    }
                });

            /*CREATE CIRCLE*/
            var circleDump = d3Data.innerContainer.append("svg:g").selectAll("circle")
                .data(nodes)
                .enter().append("svg:circle")
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
                .call(d3Data.drag)
                .on("dblclick", function (d) {
                    detailInfo(d);
                });

            function tick(d) {
                path.attr("d", linkArc);
                pathTextShadow.attr("transform", transformHalf).attr("x",function (d) {
                    var x = (d.target.x - d.source.x) / 4 - (10 * d.linknum);
                    return (x > 100) ? 10 : ((x < 20) ? 20 : x);
                }).attr("y", function (d) {
                    var y = -(d.target.y - d.source.y) / 4 - (10 * d.linknum);
                    return (y < -100) ? -100 : ((y > -20) ? -20 : y);
                });
                pathText.attr("transform", transformHalf).attr("x",function (d) {
                    var x = (d.target.x - d.source.x) / 4 - (10 * d.linknum);
                    return (x > 100) ? 10 : ((x < 20) ? 20 : x);
                }).attr("y", function (d) {
                    var y = -(d.target.y - d.source.y) / 4 - (10 * d.linknum);
                    return (y < -100) ? -100 : ((y > -20) ? -20 : y);
                });
                circle.attr("transform", transform);
                circleText.attr("transform", transform);
                circleDump.attr("transform", transform);

                var q = d3.geom.quadtree(nodes),
                    i = 0,
                    n = nodes.length;

                while (++i < n) {
                    q.visit(collide(nodes[i]));
                }
            }

            function linkArc(d) {
                var sourceX = Math.floor(d.source.x),
                    sourceY = Math.floor(d.source.y),
                    targetX = Math.floor(d.target.x),
                    targetY = Math.floor(d.target.y),
                    dx = targetX - sourceX,
                    dy = targetY - sourceY,
                    dr = Math.floor(Math.sqrt(dx * dx + dy * dy) - (40 * d.linknum));

                return "M" + sourceX + "," + sourceY + "A" + dr + "," + dr + " 0 0,1 " + targetX + "," + targetY;
            }

            function transformHalf(d) {
                var halfX = Math.floor((d.source.x + d.target.x) / 2),
                    halfY = Math.floor((d.source.y + d.target.y) / 2);

                return "translate(" + halfX + "," + halfY + ")";
            }

            function transform(d) {
                return "translate(" + d.x + "," + d.y + ")";
            }

            function collide(node) {
                if (node.y < ((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba)) node.y -= node.y - ((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba);

                var radius = (node.label == "podmiot") ? d3Data.size.nodesPodmiot : ((node.label == "osoba") ? d3Data.size.nodesOsoba : ((d3Data.size.nodesPodmiot > d3Data.size.nodesOsoba) ? d3Data.size.nodesPodmiot : d3Data.size.nodesOsoba)),
                    space = 6,
                    r = radius + space,
                    nx1 = node.x - r,
                    nx2 = node.x + r,
                    ny1 = node.y - r,
                    ny2 = node.y + r;

                return function (quad, x1, y1, x2, y2) {

                    if (quad.point && (quad.point !== node)) {
                        var x = node.x - quad.point.x,
                            y = node.y - quad.point.y,
                            l = Math.sqrt(x * x + y * y),
                            r = (radius * 2) + space;

                        if (l < r) {
                            l = (l - r) / l * .5;
                            node.x -= x *= l;
                            node.y -= y *= l;
                            quad.point.x += x;
                            quad.point.y += y;
                        }
                    }
                    return x1 > nx2 || x2 < nx1 || y1 > ny2 || y2 < ny1;
                };
            }

            function zoomed() {
                d3Data.innerContainer.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
            }

            function dragstarted(d) {
                d3.event.sourceEvent.stopPropagation();
                d3.select(this).classed("dragging", true);
            }

            function dragged(d) {
                d.x = d3.event.x;
                d.y = d3.event.y;
                tick(d);
            }

            function dragended(d) {
                d3.select(this).classed("dragging", false);
            }

            function detailInfo(node) {
                var birthdayPrivacy = false;

                connectionGraph.find('.dataContent').remove();

                var dataContent = $('<div></div>').addClass('dataContent').css('width', width / 2);
                dataContent.append($('<button></button>').addClass('btn btn-xs pull-right').text('x'));
                dataContent.append($('<table></table>').addClass('table table-striped'));

                var linkEl = $('<a></a>').attr('target', '_self').text(_mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_LINK);

                $.each(node.data, function (label, value) {
                    if (label == 'mp_id') {
                        if (node.label == "podmiot") {
                            linkEl.attr('href', '/dane/krs_podmioty/' + value);
                        } else if (node.label == "osoba") {
                            linkEl.attr('href', '/dane/krs_osoby/' + value);
                        }
                    } else {
                        var tr = $('<tr></tr>');

                        if (label == 'privacy_level' && Number(value) == 1)
                            birthdayPrivacy = true;

                        if (label == 'data_urodzenia') {
                            if (birthdayPrivacy)
                                return
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_DATA_URODZENIA;
                        } else if (label == 'plec') {
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_PLEC;
                            if (value == 'K')
                                value = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_KOBIETA;
                            else if (value == 'M')
                                value = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_MEZCZYZNA;
                        }
                        else if (label == 'nazwisko')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_NAZWISKO;
                        else if (label == 'imiona')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_IMIONA;
                        else if (label == 'krs')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_KRS;
                        else if (label == 'kapital_zakladowy')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_KAPITAL_ZAKLADOWY;
                        else if (label == 'miejscowosc')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_MIEJSCOWOSC;
                        else if (label == 'data_rejestracji')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_REJESTRACJI;
                        else if (label == 'forma')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_FORMA_PRAWNA;
                        else if (label == 'nazwa')
                            label = _mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_NAZWA;
                        else
                            return;
                        tr.append($('<td></td>').text(label));
                        tr.append($('<td></td>').text(value));
                        dataContent.find('table').append(tr);
                    }
                });

                var link = $('<tr></tr>').append(
                    $('<td colspan="2"></td>').append(linkEl)
                );
                dataContent.find('table').append(link);

                connectionGraph.append(dataContent);

                connectionGraph.find('.dataContent .btn').click(function () {
                    connectionGraph.find('.dataContent').remove();
                });
            }
        });
    }
}(jQuery));