function isElementVisibled(elem) {
    if (jQuery(elem).length) {
        var docViewTop = jQuery(window).scrollTop();
        var docViewBottom = docViewTop + jQuery(window).height();
        var elemTop = jQuery(elem).offset().top;
        var elemBottom = elemTop + jQuery(elem).height();
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    } else {
        return false;
    }
}

var intervalMain;

(function () {
    var myLines = [],
        svg = null,
        $lawMap = jQuery('.lawMap'),
        $svgLines = jQuery("#svgLines"),
        $svgPathMarker = $lawMap.find('.slide:first .path'),
        $svgLinesDiff = $svgPathMarker.offset().left - $lawMap.offset().left;

    $svgLines.css({
        'width': $svgPathMarker.width(),
        'height': '100%',
        'left': $svgLinesDiff
    });

    svg = Raphael("svgLines", $svgLines.width(), '100%');

    function drawLine(eTarget, eSource, color) {

        var $lawMapOffset = $lawMap.offset(),
            $sourceOffset = eSource.offset(),
            $targetOffset = eTarget.offset(),

            originX = -$svgLinesDiff + ($sourceOffset.left - $lawMapOffset.left) + (eSource.width() / 2) + 2,
            originY = ($sourceOffset.top - $lawMapOffset.top) + 3,

            endingX = -$svgLinesDiff + ($targetOffset.left - $lawMapOffset.left) + (eTarget.width() / 2) + 2,
            endingY = ($targetOffset.top - $lawMapOffset.top) + eTarget.height() - 3,

            space = 28,

            a = "M" + originX + " " + originY + " L" + endingX + " " + (originY - space),
            b = "M" + endingX + " " + (originY - space) + " L" + endingX + " " + endingY,
            all = a + " " + b,

            rachaelLine = svg
                .path(all)
                .attr({
                    "stroke": color,
                    "stroke-width": 2
                });

        if (!eSource.hasClass('active'))
            rachaelLine.toBack();

        myLines[myLines.length] = rachaelLine;
    }

    function showLines() {
        var colors = {
            'inactive': '#0BD35C',
            'lastActive': '#0BD35C',
            'lastNotActive': '#0BD35C',
            'passActive': '#0BD35C',
            'passNotActive': '#DDDDDD'
        };

        setTimeout(function () {
            svg.clear();
            jQuery('.icon-small').each(function () {
                var $self = jQuery(this),
                    arrayParent = $self.data('parent');
                if (arrayParent !== undefined) {

                    for (var i = 0; i < arrayParent.length; i++) {
                        var color = ($self.parents('.slide').hasClass('inactive') ? colors.inactive
                            : ($self.parents('.slide').hasClass('active')) ?
                            ($self.hasClass('active') ? colors.lastActive
                                : colors.lastNotActive)
                            : ($self.hasClass('active') ? colors.passActive
                            : colors.passNotActive));

                        drawLine(jQuery('#node_' + arrayParent[i]), $self, color);

                    }
                }
            });
        }, Math.floor(Math.random() * 50));
    }

    function loadNodeDocument(params) {
        var container,
            parent = jQuery('.additionalInfo.doc-' + params.s);

        $('#_mojePanstwoCockpit').addClass('loading');
        jQuery.ajax({
            type: "GET",
            url: "loadItemData.json",
            data: params,
            success: function (data) {

                $('#_mojePanstwoCockpit').removeClass('loading');

                if (data != null) {
                    if ((container = jQuery('.lawMap').find('.additionalInfo.addon.doc-' + params.s)).length) {
                        container.html('');
                        /*container reset*/
                        container.attr({'data-document': params.blockId, 'data-totalPage': data.pages});
                    } else {
                        container = jQuery('<div></div>').addClass('additionalInfo addon doc-' + params.s);
                        container.attr({'data-slide': params.s, 'data-document': params.blockId, 'data-totalPage': data.pages});
                        container.insertAfter(parent);
                        container.hide();
                    }

                    var pagination = jQuery('<ul></ul>'),
                        head = jQuery('<div></div>').addClass('head'),
                        docsLister = jQuery('<ul></ul>').addClass('docsLister');

                    if (params.blockId != 'undefined') {
                        var title = parent.find('.documentList a[data-number="' + params.blockId + '"]').data('title'),
                            docTitles = title.replace(/.{60}\S*\s+/g, "$&@").split(/\s+@/),
                            docTitle = docTitles[0];

                        if (docTitles.length > 1)
                            docListTitle += '...';

                        head.append(
                            jQuery('<div></div>').addClass('name').append(
                                jQuery('<h3></h3>').text(docTitle)
                            )
                        )
                    }

                    if (data.pages > 1) {
                        var paginationLeft,
                            paginationRight,
                            paginationLimit = 3;

                        paginationLeft = (params.currentPage - paginationLimit >= 1) ? paginationLimit : params.currentPage - 1;
                        paginationRight = (params.currentPage + paginationLimit <= data.pages) ? paginationLimit : data.pages - params.currentPage;

                        if (paginationLeft < paginationLimit)
                            (params.currentPage + paginationRight + (paginationLimit - paginationLeft) <= data.pages) ? paginationRight += (paginationLimit - paginationLeft) : paginationRight += data.pages - (params.currentPage + paginationRight);

                        if (paginationRight < paginationLimit)
                            (params.currentPage - paginationLeft - (paginationLimit - paginationRight) >= 1) ? paginationLeft += (paginationLimit - paginationRight) : paginationLeft += (params.currentPage - paginationLeft <= paginationLimit) ? ((params.currentPage - paginationLeft) - 1) : paginationLimit;

                        for (var i = 0; i <= (paginationLeft + paginationRight); i++) {
                            var liNode = jQuery('<li></li>').append(
                                jQuery('<a></a>').attr({'data-page': params.currentPage - (paginationLeft) + i, 'href': "#"}).text(params.currentPage - (paginationLeft) + i)
                            );
                            if ((params.currentPage - (paginationLeft) + i) == params.currentPage)
                                liNode.find('a').addClass('active');
                            pagination.append(liNode);
                        }

                        pagination.prepend(jQuery('<li></li>').append(jQuery('<a></a>').addClass('prev').attr('href', '#').text('<')));
                        pagination.append(jQuery('<li></li>').append(jQuery('<a></a>').addClass('next').attr('href', '#').text('>')));

                        head.append(pagination);

                        pagination.find('li a').click(function (e) {
                            var that = jQuery(this),
                                self = that.parents('.additionalInfo.addon'),
                                params,
                                page;
                            e.preventDefault();

                            if (that.hasClass('prev')) {
                                page = jQuery(this).parents('ul').find('.active').data('page') - 1;
                                page = (page < 1) ? 1 : page;
                            } else if (that.hasClass('next')) {
                                page = jQuery(this).parents('ul').find('.active').data('page') + 1;
                                page = (page > self.data('totalpage')) ? self.data('totalpage') : page;
                            } else {
                                page = jQuery(this).data('page');
                            }
                            params = {
                                's': self.parents('.slide').data('slide'),
                                'blockId': self.data('document'),
                                'currentPage': page,
                                'limitPerPage': 6,
                                'lang': _mPHeart.language.threeDig
                            };

                            loadNodeDocument(params);
                        });
                    }

                    container.append(head);

                    jQuery(data.docs).each(function () {
                        var docsNode = jQuery('<li></li>');
                        docsNode.append(
                            jQuery('<a></a>').attr('href', '#').data('document', this.dokument_id).text(this.title)
                        );

                        docsLister.append(docsNode);
                    });
                    container.append(docsLister);

                    container.append(jQuery('<a></a>').addClass('close glyphicon glyphicon-remove-sign').attr({'data-slide': params.s, 'href': "#"}));
                    container.find('.close').click(function (e) {
                        var slide = jQuery(this).data('slide');

                        e.preventDefault();
                        jQuery('.additionalInfo.addon.doc-' + slide).slideUp({
                            step: function (now, tween) {
                                if (tween.prop == 'height')
                                    showLines();
                            },
                            done: function () {
                                jQuery('.additionalInfo.doc-' + slide).find('.documentList li a.active').removeClass('active');
                                showLines();
                            }
                        });
                    });
                    container.find('.docsLister li a').click(function () {
                        var docViewer = null,
                            docId = jQuery(this).data('document'),
                            intervalRunable = true;

                        $('#_mojePanstwoCockpit').addClass('loading');
                        jQuery.ajax({
                            type: "GET",
                            url: "/docs/" + docId + "-1.json",
                            success: function (data) {

                                $('#_mojePanstwoCockpit').removeClass('loading');

                                if (data != null) {
                                    var mapaPrawa = jQuery('#mapaprawa');

                                    jQuery('head').append(
                                        jQuery('<link />').attr({
                                            'id': "imageViewCSS",
                                            'rel': "stylesheet",
                                            'href': 'http://docs.sejmometr.pl/htmlex/' + docId + '/' + docId + '.css',
                                            'type': "text/css"
                                        })
                                    );
                                    docViewer = jQuery('<div></div>').attr('id', 'docViewer').append(
                                        jQuery('<div></div>').addClass('container').append(
                                            jQuery('<div></div>').addClass('htmlexDoc').append(
                                                    jQuery('<div></div>').addClass('headline')
                                                ).append(
                                                    jQuery('<div></div>').addClass('docContent canvas').html(data.html)
                                                )
                                        )
                                    );
                                    mapaPrawa.find('.container > .headline').prependTo(docViewer.find('.headline'));

                                    docViewer.find('.htmlexDoc').append(jQuery('<a></a>').addClass('close glyphicon glyphicon-remove-sign'));

                                    if (data.doc.packages_count > 1)
                                        docViewer.find('.htmlexDoc').append(jQuery('<div></div>').addClass('loadMoreDocumentContent').data({'currentPackage': 1, 'packages': data.docs.packages_count}));

                                    mapaPrawa.append(docViewer);

                                    docViewer.find('.close').click(function (event) {
                                        event.preventDefault();

                                        jQuery('#imageViewCSS').remove();
                                        jQuery('#docViewer').remove();
                                    });

                                    if (jQuery('.loadMoreDocumentContent').length) {
                                        intervalMain = setInterval(function () {
                                            var loadMoreDocumentContent = jQuery('.loadMoreDocumentContent');

                                            if (isElementVisibled('.loadMoreDocumentContent') && intervalRunable) {
                                                if (loadMoreDocumentContent.data('currentPackage') < loadMoreDocumentContent.data('packages')) {
                                                    var page = Number(loadMoreDocumentContent.data('currentPackage')) + 1;

                                                    intervalRunable = false;
                                                    loadMoreDocumentContent.addClass('loading');
                                                    loadMoreDocumentContent.data('currentPackage', page);

                                                    $('#_mojePanstwoCockpit').addClass('loading');
                                                    jQuery.ajax({
                                                        type: "GET",
                                                        url: "/docs/" + docId + "-" + page + ".html",
                                                        success: function (html) {

                                                            $('#_mojePanstwoCockpit').removeClass('loading');

                                                            docViewer.find('.docContent').append(html);
                                                            intervalRunable = true;
                                                        }
                                                    });
                                                } else if (loadMoreDocumentContent.data('currentPackage') == loadMoreDocumentContent.data('packages')) {
                                                    clearInterval(intervalMain);
                                                    loadMoreDocumentContent.remove();
                                                }
                                            }

                                        }, 1500);
                                    }
                                }
                            }
                        });
                    });

                    if (container.is(':hidden')) {
                        container.slideDown({
                            step: function (now, tween) {
                                if (tween.prop == 'height')
                                    showLines();
                            },
                            done: function () {
                                showLines();
                            }
                        });
                    }
                }
            }
        });
    }

    $lawMap.find('.slide').click(function () {

        console.log('slide click');

        var self = jQuery(this),
            slideId = self.data('slide'),
            params = {
                s: slideId,
                lang: _mPHeart.language.threeDig
            },
            docContent = jQuery('<div></div>'),
            additionalInfoDocSlide = jQuery('.additionalInfo.doc-' + slideId);

        self.addClass('active');

        if (additionalInfoDocSlide.length == 0) {
            var docList = jQuery('<ul></ul>');

            $('#_mojePanstwoCockpit').addClass('loading');
            jQuery.ajax({
                type: "GET",
                url: "loadBlockData.json",
                data: params,
                success: function (data) {

                    $('#_mojePanstwoCockpit').removeClass('loading');


                    if (!data)
                        data = {'info': 'Etap', 'list': []};

                    docContent.addClass('additionalInfo doc-' + slideId);
                    docContent.attr({
                        'data-slide': slideId
                    });
                    docContent.append(
                            jQuery('<div></div>').addClass('documentInfo').append(
                                    jQuery('<h3></h3>').text(_mPHeart.translation.LC_MAPAPRAWA_STATUSETAPU)
                                ).append(
                                    jQuery('<p></p>').html(data.info)
                                )
                        ).append(function () {

                            if (data.list.length) {

                                var documentList = jQuery('<div></div>').addClass('documentList').addClass('documentation');
                                documentList.append(
                                        jQuery('<h3></h3>').text(_mPHeart.translation.LC_MAPAPRAWA_DOKUMENTACJA)
                                    ).append(function () {
                                        jQuery(data.list).each(function () {
                                            var docListTitles = this.tytul.replace(/.{48}\S*\s+/g, "$&@").split(/\s+@/),
                                                docListTitle = docListTitles[0];
                                            if (docListTitles.length > 1) docListTitle += '...';

                                            docList.append(jQuery('<li></li>').append(
                                                jQuery('<a></a>').attr({'href': "#", 'data-number': this.id, 'data-title': this.tytul }).text(docListTitle)
                                            ))
                                        });
                                        documentList.append(docList);
                                    });
                                docContent.append(documentList)

                            }
                        });

                    docContent.append(jQuery('<a></a>').addClass('close glyphicon glyphicon-remove-sign').attr({'data-slide': slideId, 'href': "#"}));
                    docContent.insertAfter(self);
                    docContent.hide();


                    docContent.slideDown({
                        step: function (now, tween) {
                            if (tween.prop == 'height')
                                showLines();
                        },
                        done: function () {
                            showLines();
                        },
                        duration: 150
                    });

                    docContent.find('.close').click(function (e) {


                        console.log('close');

                        var slide = jQuery(this).data('slide'),
                            additionalInfo = jQuery('.additionalInfo.doc-' + slide),
                            additionalInfoAddon = jQuery('.additionalInfo.addon.doc-' + slide);

                        e.preventDefault();
                        $('.slide.active').removeClass('active');

                        if (additionalInfoAddon.length > 0 && additionalInfoAddon.is(':visible')) {
                            additionalInfoAddon.slideUp({
                                step: function (now, tween) {
                                    if (tween.prop == 'height')
                                        showLines();
                                },
                                done: function () {
                                    additionalInfo.slideUp({
                                        step: function (now, tween) {
                                            if (tween.prop == 'height')
                                                showLines();
                                        },
                                        done: function () {
                                            showLines();
                                        }
                                    })
                                }
                            });
                        } else {
                            additionalInfo.slideUp({
                                step: function (now, tween) {
                                    if (tween.prop == 'height')
                                        showLines();
                                }, done: function () {
                                    showLines();
                                }
                            });
                        }
                    });

                    docList.find('li a').click(function (e) {
                        var that = jQuery(this),
                            list = that.parents('ul'),
                            parent = that.parents('.additionalInfo');
                        e.preventDefault();

                        list.find('.active').removeClass('active');
                        that.addClass('active');

                        loadNodeDocument({
                            's': parent.data('slide'),
                            'blockId': that.data('number'),
                            'currentPage': 1,
                            'limitPerPage': 6
                        });
                    })

                }
            });
        } else {
            if (additionalInfoDocSlide.is(':hidden')) {
                additionalInfoDocSlide.slideDown({
                    step: function (now, tween) {
                        if (tween.prop == 'height')
                            showLines();
                    },
                    done: function () {
                        showLines();
                    }
                })
            }
        }
    });

    /* Draw first line after page start*/
    showLines();
}());