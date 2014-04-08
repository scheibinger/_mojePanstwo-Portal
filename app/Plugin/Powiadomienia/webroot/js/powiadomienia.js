(function ($) {
    var addNewPhrase,
        phraseContent;

    if ((addNewPhrase = $('#addPhraseModal')).length > 0) {
        var addNewPhraseSubmit = function () {
            var btn = addNewPhrase.find('.addNewPhrase .btn'),
                input = addNewPhrase.find('.addNewPhrase input');

            if (input.val().length >= 2) {
                console.log(encodeURI(input.val()));
                $.ajax({
                    url: "/powiadomienia/phrases/add.json",
                    data: {
                        add: input.val()
                    },
                    type: "POST",
                    dataType: "json",
                    beforeSend: function () {
                        btn.addClass('loading');
                        addNewPhrase.find('.error').addClass('hide');
                    },
                    success: function (res) {
                        if (res == true) {
                            jQuery('#addPhraseModal').modal('hide');
                            // TODO: dorobić odświerzanie samej warstwy z frazami, a nie przełodowanie całej strony
                            location.reload();
                        } else {
                            addNewPhrase.find('.error').removeClass('hide').text(_mPHeart.translation.LC_POWIADOMIENIA_JS_AJAX_ERROR);
                        }
                    },
                    complete: function () {
                        btn.removeClass('loading')
                    }
                });
            } else {
                addNewPhrase.find('.error').removeClass('hide').text(_mPHeart.translation.LC_POWIADOMIENIA_JS_PHRASE_AT_LEASE_2_CHARS);
            }
        };

        addNewPhrase.find('.addNewPhrase .btn').click(function () {
            if (!$(this).hasClass('loading')) {
                addNewPhraseSubmit();
            }
        });
        jQuery('#addPhraseModal').on('shown.bs.modal', function () {
            jQuery('.addNewPhrase input').val('').focus().keyup(function (e) {
                if (e.keyCode == '13') {
                    addNewPhraseSubmit();
                }
            });
        })
    }

    if ((phraseContent = $('#powiadomienia .frazy')).length > 0) {
        phraseContent.find('.keywords ul li a.options').click(function (e) {
            var that = $(this),
                parent = that.parents('li'),
                modal = jQuery('<div></div>');

            e.preventDefault();

            modal.addClass("modal fade").attr({'id': "frazyModalBox", "tabindex": -1, "role": "dialog", "aria-labelledby": "myModalLabel", "aria-hidden": "true"}).append(
                jQuery('<div></div>').addClass('modal-dialog').append(
                    jQuery('<form></form>').append(
                            jQuery('<div></div>').addClass('visibledNone').append(
                                jQuery('<input>').attr({'name': 'data[Dataobject][ids]', 'type': 'hidden'}).val(parent.data('id'))
                            )
                        ).append(
                            jQuery('<div></div>').addClass('modal-content').append(
                                    jQuery('<div></div>').addClass('modal-header').append(
                                            jQuery('<button></button>').addClass('close').attr({'role': 'close', "data-dismiss": "modal", "aria-hidden": "true"}).html('&times;')
                                        ).append(
                                            jQuery('<h4></h4>').addClass('modal-title').attr('id', 'frazyModalBox').text(jQuery.trim(parent.find('label a.wrap').text()))
                                        ).append(
                                            jQuery('<div></div>').addClass('edit modal-title hide').append(
                                                jQuery('<textarea></textarea>').addClass('modal-title form-control').attr({'type': 'text', 'rows': 2, 'name': 'title'}).text(jQuery.trim(parent.find('label a.wrap').text()))
                                            )
                                        )
                                ).append(
                                    jQuery('<div></div>').addClass('modal-body').append(
                                        jQuery('<span></span>').addClass('loading')
                                    )
                                ).append(
                                    jQuery('<div></div>').addClass('modal-footer').append(
                                            jQuery('<button></button>').addClass('btn delete btn-danger pull-left').attr({'type': 'button'}).text('Usuń')
                                        ).append(
                                            jQuery('<button></button>').addClass('btn duplicate btn-info pull-left').attr({'type': 'button'}).text('Duplikuj')
                                        ).append(
                                            jQuery('<button></button>').addClass('btn save btn-primary pull-right').attr({'type': 'button'}).text('Zapisz')
                                        )
                                )
                        )
                )
            );

            /*EDITING TITLE*/
            modal.find('.modal-header h4.modal-title').click(function () {
                modal.find('.modal-header h4.modal-title').addClass('hide');
                modal.find('.modal-header .edit.modal-title').removeClass('hide');

                setTimeout(function () {
                    jQuery("body").click(function (event) {
                        console.log(event.target.nodeName, event.target.nodeName != 'TEXTAREA')
                        if (event.target.nodeName != 'TEXTAREA') {
                            if (modal.find('.modal-header .edit.modal-title textarea').val() != modal.find('.modal-header h4.modal-title').text())
                                modal.find('.modal-header h4.modal-title').text(jQuery.trim(modal.find('.modal-header .edit.modal-title textarea').val()));

                            modal.find('.modal-header .edit.modal-title').addClass('hide');
                            modal.find('.modal-header h4.modal-title').removeClass('hide');

                            jQuery("body").unbind('click');
                        }
                    });
                }, 0);
            })

            /*DELETE*/
            modal.find('.modal-footer .btn.delete').click(function () {
                if (jQuery(this).hasClass('disabled')) return;

                jQuery.ajax({
                    type: 'GET',
                    url: '/',
                    data: {
                        id: parent.data('id'),
                        action: 'delete'
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        modal.find('.modal-footer .btn').addClass('loading');
                        modal.find('.modal-footer .btn.delete').addClass('loading');
                    },
                    complete: function () { /*TODO: zamienic na success gdy beda juz AJAX REQUEST gotowe*/
                        modal.modal('toggle');
                    }
                })
            });

            /*DUPLICATE*/
            modal.find('.modal-footer .btn.duplicate').click(function () {
                if (jQuery(this).hasClass('disabled')) return;

                jQuery.ajax({
                    type: 'GET',
                    url: '/',
                    data: {
                        id: parent.data('id'),
                        action: 'duplicate'
                    },
                    dataType: 'JSON',
                    beforeSend: function () {
                        modal.find('.modal-footer .btn').addClass('disabled');
                        modal.find('.modal-footer .btn.duplicate').addClass('loading');
                    },
                    complete: function () { /*TODO: zamienic na success gdy beda juz AJAX REQUEST gotowe*/
                        modal.modal('toggle');
                    }
                })
            });

            /*SAVE*/
            modal.find('.modal-footer .btn.save').click(function () {
                if (jQuery(this).hasClass('disabled')) return;

                jQuery.ajax({
                    type: 'GET',
                    url: '/?' + modal.find('form').serialize() + '&action=save',
                    dataType: 'JSON',
                    beforeSend: function () {
                        modal.find('.modal-footer .btn').addClass('disabled');
                        modal.find('.modal-footer .btn.save').addClass('loading');
                    },
                    complete: function () { /*TODO: zamienic na success gdy beda juz AJAX REQUEST gotowe*/
                        modal.modal('toggle');
                        parent.find('label a.wrap').text(jQuery.trim(modal.find('.modal-header textarea.modal-title').val()))
                    }
                })
            });

            /*AJAX - GET ADDITIONAL GROUP INFORMATION*/
            jQuery.ajax({
                type: 'GET',
                url: '/',
                data: {
                    id: parent.data('id')
                },
                dataType: 'JSON',
                beforeSend: function () {
                    modal.modal();
                },
                complete: function (data) { /*TODO: zamienic na success gdy beda juz AJAX REQUEST gotowe*/
                    data = {
                        'datasets': [
                            {id: 1, name: 'datasets-test'},
                            {id: 2, name: 'datasets-test2'},
                            {id: 3, name: 'datasets-test3', 'selected': true},
                            {id: 4, name: 'datasets-test4', 'selected': true},
                            {id: 5, name: 'datasets-test5'}
                        ],
                        'keywords': [
                            {id: 1, name: 'keywords-test'},
                            {id: 2, name: 'keywords-test2', 'selected': true},
                            {id: 3, name: 'keywords-test3', 'selected': true},
                            {id: 4, name: 'keywords-test4'},
                            {id: 5, name: 'keywords-test5'}
                        ]
                    }

                    modal.find('.modal-body').html('')

                    modal.find('.modal-body').append(
                        jQuery('<div></div>').addClass('datasets').append(
                                jQuery('<h5></h5>').text('Datasety')
                            ).append(
                                jQuery('<hr />')
                            )
                    )
                    if (data['datasets'].length > 0) {
                        jQuery.each(data['datasets'], function () {
                            modal.find('.modal-body .datasets').append(
                                jQuery('<div></div>').addClass('checkbox').append(
                                    jQuery('<label></label>').text(this.name).prepend(
                                        jQuery('<input />').attr({'type': 'checkbox', 'name': 'data[datasets][ids]'}).val(this.id)
                                    )
                                )
                            )
                            if (this.selected)
                                modal.find('.modal-body .datasets input:last').prop('checked', true);
                        })
                    } else {
                        modal.find('.modal-body .datasets').append(
                            jQuery('<span></span>').text('Brak datasetów')
                        )
                    }

                    modal.find('.modal-body').append(
                        jQuery('<div></div>').addClass('keywords').append(
                                jQuery('<h5></h5>').text('Keywords')
                            ).append(
                                jQuery('<hr />')
                            )
                    )

                    if (data['keywords'].length > 0) {
                        jQuery.each(data['keywords'], function () {
                            modal.find('.modal-body .keywords').append(
                                jQuery('<div></div>').addClass('checkbox').append(
                                    jQuery('<label></label>').text(this.name).prepend(
                                        jQuery('<input />').attr({'type': 'checkbox', 'name': 'data[keywords][ids]'}).val(this.id)
                                    )
                                )
                            )
                            if (this.selected)
                                modal.find('.modal-body .keywords input:last').prop('checked', true);
                        })
                    } else {
                        modal.find('.modal-body .keywords').append(
                            jQuery('<span></span>').text('Brak keywordsów')
                        )
                    }
                }
            })
        });
    }


    if (jQuery('.loadMoreContent').length) {
        var loadMoreContentIntervalRunable = true,
            loadMoreContent = jQuery('.dataContent .loadMoreContent'),
            showData = jQuery('.dataContent .powiadomienia'),
            loadMoreContentIntervalMain = null;

        loadMoreContentIntervalMain = setInterval(function () {
            if (isElementVisibled('.loadMoreContent') && loadMoreContentIntervalRunable) {
                var page = Number(loadMoreContent.data('currentpage')) + 1;
                loadMoreContentIntervalRunable = false;

                jQuery.ajax({
                    type: "GET",
                    url: "powiadomienia/powiadomienia.json?page=" + page,
                    beforeSend: function () {
                        loadMoreContent.addClass('loading');
                    },
                    success: function (data) {
                        loadMoreContent.removeClass('loading');
                        if (data) {
                            loadMoreContent.data('currentpage', page);
                            showData.append(data);
                            loadMoreContentIntervalRunable = true;
                        } else {
                            clearInterval(loadMoreContentIntervalMain);
                            loadMoreContent.remove();
                        }
                    },
                    complete: function () {
                        loadMoreContent.removeClass('loading');
                    }
                });
            }

        }, 1500);
    }

    $('.additionalOptions .markReadAfterThreeSec').change(function () {
        if ($(this).find('input').is(':checked')) {
            optionsMarkAsRead();
        } else {
            clearInterval(newNotificationIntervalMain);
        }
    });

    $('.additionalOptions .markAllAsRead').click(function () {
        $.ajax({
            url: "/",
            data: {},
            type: "POST",
            dataType: "json",
            success: function (res) {
                console.log(res)
                $('.dataContent .objectRender').addClass('.readed');
            }
        });
    });
}(jQuery));