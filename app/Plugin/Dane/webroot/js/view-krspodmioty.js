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
            'height': 500, /*DEFAULT HEIGHT SETTING*/
            'color': {
                'mainFill': '#888888',
                'mainStroke': '#666666',
                'links': '#333333',
                'podmiot': "#FF0000",
                'osoba': "#0000FF"
            },
            size: {
                'linksLength': 100,
                'linksWidth': 1,
                'nodes': 50
            }
        };

        /*http://jsfiddle.net/qqGDG/*/
        d3Data.force = d3.layout.force()
            .charge(-2000)
            .linkDistance(d3Data.size.linksLength + d3Data.size.nodes)
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
            var newHeight = (d3Data.size.nodes * nodes.length);
            d3Data.height = (newHeight > d3Data.height) ? newHeight : d3Data.height;
            d3Data.force.size([d3Data.width, d3Data.height]);
            d3Data.svg
                .attr("width", d3Data.width)
                .attr("height", d3Data.height);

            /*Add call's*/
            d3Data.force
                .on("tick", tick);
            d3Data.svg
                .call(zoom);

            var root = nodes[0];
            root.fixed = true;
            root.x = (d3Data.width / 2);
            root.y = (d3Data.height / 2);

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
                .attr("refX", 72)
                .attr("refY", 0)
                .attr("markerWidth", 8)
                .attr("markerHeight", 8)
                .attr("orient", "auto")
                .append("path")
                .attr("d", "M0,-5L10,0L0,5");

            var path = d3Data.svg.append("g").selectAll("path")
                .data(links)
                .enter().append("path")
                .attr('class', 'link')
                .attr("marker-end", "url(#arrow)")
                .style({"fill": "none", "stroke-width": d3Data.size.linksWidth, 'stroke': d3Data.color.links});

            var pathText = d3Data.svg.append("g").selectAll("text")
                .data(links)
                .enter().append("text")
                .attr('class', 'pathText')
                .style("text-anchor", "middle")
                .style("font-size", "9px")
                .style("fill", "#000")
                .text(function (d) {
                    return d.label;
                });

            var circle = d3Data.svg.append("g").selectAll("circle")
                .data(nodes)
                .enter().append("circle")
                .attr('class', 'circle')
                .attr("r", d3Data.size.nodes)
                .style("stroke-width", 2)
                .style("stroke", function (d) {
                    if (d.id == root.id)
                        return d3Data.color['mainStroke'];
                    else
                        return d3Data.color[d.label];
                })
                .style("fill", function (d) {
                    if (d.id == root.id)
                        return d3Data.color['mainFill'];
                    else
                        return d3Data.color[d.label];
                })
                .call(d3Data.force.drag)
                .on('mousemove', function(d){
                    d.fixed = true;
                })
                .on('dblclick', function (d) {
                    detailInfo(d);
                });

            var circleText = d3Data.svg.append("g").selectAll("text")
                .data(nodes)
                .enter().append("text")
                .attr('class', 'circleText')
                .attr("y", ".31em")
                .style("text-anchor", "middle")
                .style("font-size", "9px")
                .style("fill", "#ffffff")
                .text(function (d) {
                    var name, nameBegin, nameEnd;

                    if (d.label == 'podmiot')
                        name = d.data.nazwa;
                    else if (d.label == 'osoba')
                        name = d.data.imiona + ' ' + d.data.nazwisko;

                    nameBegin = name.substring(0, Math.floor(d3Data.size.nodes / 4));
                    nameEnd = name.substring(Math.floor(d3Data.size.nodes / 4));

                    return nameBegin + nameEnd.substring(0, nameEnd.indexOf(' '));
                });

            function tick() {
                path.attr("d", function (d) {
                    return "M" + d.source.x + "," + d.source.y + "A" + 0 + "," + 0 + " 0 0,1 " + d.target.x + "," + d.target.y;
                });
                pathText.attr("transform", function (d) {
                    return "translate(" + (d.source.x + d.target.x) / 2 + "," + (d.source.y + d.target.y) / 2 + ")";
                });
                circle.attr("transform", function (d) {
                    return "translate(" + d.x + "," + d.y + ")";
                });
                circleText.attr("transform", function (d) {
                    return "translate(" + d.x + "," + d.y + ")";
                });

                var q = d3.geom.quadtree(nodes),
                    i = 0,
                    n = nodes.length;

                while (++i < n) {
                    q.visit(collide(nodes[i]));
                }
            }


            /*var link = container.selectAll("g.link")
             .data(links)
             .enter().append("svg:g")
             .attr("class", "link");

             link.append("svg:line")
             .attr("class", "linkLine")
             .attr('id', function (d) {
             return 'label-' + d.id
             })
             .style({"stroke-width": d3Data.size.linksWidth, 'stroke': d3Data.color.links})
             .attr("x1", function (d) {
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

             link.append("svg:text")
             .attr("class", "linkText")
             .attr("dx", function (d) {
             return (d.source.x + d.target.x) / 2;
             })
             .attr("dy", function (d) {
             return (d.source.y + d.target.y) / 2;
             })
             .text(function (d) {
             return d.label
             });

             var node = container.selectAll("g.node")
             .data(nodes)
             .enter().append("svg:g")
             .attr("class", "node")
             .attr("transform", function (d) {
             return "translate(" + d.x + "," + d.y + ")";
             })
             .call(d3Data.force.drag)
             .on('mousemove', function (d) {
             d.fixed = true;
             })
             .on('dblclick', function (d) {
             detailInfo(d);
             });

             node.append("svg:circle")
             .attr('class', 'nodeCircle')
             .attr("r", d3Data.size.nodes)
             .style("stroke-width", 2)
             .style("stroke", function (d) {
             if (d.id == root.id)
             return d3Data.color['mainStroke'];
             else
             return d3Data.color[d.label];
             })
             .style("fill", function (d) {
             if (d.id == root.id)
             return d3Data.color['mainFill'];
             else
             return d3Data.color[d.label];
             });

             node.append("svg:text")
             .attr('class', 'nodeText')
             .attr("dy", ".3em")
             .style("text-anchor", "middle")
             .style("font-size", "9px")
             .style("fill", "#ffffff")
             .text(function (d) {
             var name, nameBegin, nameEnd;

             if (d.label == 'podmiot')
             name = d.data.nazwa;
             else if (d.label == 'osoba')
             name = d.data.imiona + ' ' + d.data.nazwisko;

             nameBegin = name.substring(0, Math.floor(d3Data.size.nodes / 4));
             nameEnd = name.substring(Math.floor(d3Data.size.nodes / 4));

             return nameBegin + nameEnd.substring(0, nameEnd.indexOf(' '));
             });

             d3Data.force.on("tick", function () {
             var q = d3.geom.quadtree(nodes),
             i = 0,
             n = nodes.length;

             link.select('.linkLine')
             .attr("x1", function (d) {
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

             link.select('.linkText')
             .attr("dx", function (d) {
             return (d.source.x + d.target.x) / 2;
             })
             .attr("dy", function (d) {
             return (d.source.y + d.target.y) / 2;
             });

             node
             .attr("transform", function (d) {
             return "translate(" + d.x + "," + d.y + ")";
             });

             while (++i < n) {
             q.visit(collide(nodes[i]));
             }
             });*/

            function collide(node) {
                var alpha = .5,
                    nodePadding = 20,
                    r = d3Data.size.nodes + 20,
                    nx1 = node.x - r,
                    nx2 = node.x + r,
                    ny1 = node.y - r,
                    ny2 = node.y + r;

                return function (quad, x1, y1, x2, y2) {
                    if (quad.point && (quad.point !== node)) {
                        var x = node.x - quad.point.x,
                            y = node.y - quad.point.y,
                            l = Math.sqrt(x * x + y * y),
                            r = 2 * d3Data.size.nodes + nodePadding;
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

                jQuery.each(node.data, function (label, value) {
                    var tr = jQuery('<tr></tr>');

                    tr.append(jQuery('<td></td>').text(label));
                    tr.append(jQuery('<td></td>').text(value));
                    dataContent.find('table').append(tr);
                });

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
});