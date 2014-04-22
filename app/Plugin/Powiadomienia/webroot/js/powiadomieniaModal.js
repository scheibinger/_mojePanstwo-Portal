var powiadomieniaModal;

(function ($) {
    powiadomieniaModal = {
        title: null,
        modal: null,
        footer: null,
        hiddenInput: {},
        ajax: {
            saveUrl: null,
            additionalUrl: null,
            additionalParm: {}
        },
        init: function (options) {
            $.extend(powiadomieniaModal, options);
            powiadomieniaModal.createModal();
            powiadomieniaModal.editTitle();
        },
        createModal: function () {
            powiadomieniaModal.modal = $('<div></div>');
            powiadomieniaModal.modal.addClass("modal fade").attr({'id': "frazyModalBox", "tabindex": -1, "role": "dialog", "aria-labelledby": "myModalLabel", "aria-hidden": "true"}).append(
                $('<div></div>').addClass('modal-dialog').append(
                    $('<form></form>').append(
                        $('<div></div>').addClass('modal-content').append(
                                $('<div></div>').addClass('modal-header').append(
                                        $('<button></button>').addClass('close').attr({'role': 'close', "data-dismiss": "modal", "aria-hidden": "true"}).html('&times;')
                                    ).append(
                                        $('<h4></h4>').addClass('modal-title').attr('id', 'frazyModalBox').text(powiadomieniaModal.title)
                                    ).append(
                                        $('<div></div>').addClass('edit modal-title hide').append(
                                            $('<textarea></textarea>').addClass('modal-title form-control').attr({'type': 'text', 'rows': 2, 'name': 'title'}).text(powiadomieniaModal.title)
                                        )
                                    )
                            ).append(
                                $('<div></div>').addClass('modal-body').append(
                                    $('<span></span>').addClass('loading')
                                )
                            )
                    )
                )
            );
            powiadomieniaModal.hiddenInputConstruct();
            powiadomieniaModal.footerConstruct();
        },
        hiddenInputConstruct: function () {
            if ($.isEmptyObject(powiadomieniaModal.hiddenInput === false)) {
                var hiddenInputs = $('<div></div>').addClass('visibledNone');

                $.each(powiadomieniaModal.hiddenInput, function (index, value) {
                    hiddenInputs.append($('<input />').attr({'name': index, type: 'hidden'}).val(value));
                });
                powiadomieniaModal.modal.find('.modal-dialog form').append(hiddenInputs);
            }
        },
        footerConstruct: function () {
            if (powiadomieniaModal.footer == null) {
                powiadomieniaModal.modal.find('.modal-content').append(
                    $('<div></div>').addClass('modal-footer').append(
                            $('<button></button>').addClass('btn close btn-info pull-left').attr({'type': 'button'}).text('Zamknij')
                        ).append(
                            $('<button></button>').addClass('btn save btn-primary pull-right').attr({'type': 'button'}).text('Zapisz')
                        )
                )
            } else {
                powiadomieniaModal.modal.find('.modal-content').append(powiadomieniaModal.footer);
            }
            powiadomieniaModal.additionalInfo();
            console.log(powiadomieniaModal.modal);
        },
        editTitle: function () {
            powiadomieniaModal.modal.find('.modal-header h4.modal-title').click(function () {
                powiadomieniaModal.modal.find('.modal-header h4.modal-title').addClass('hide');
                powiadomieniaModal.modal.find('.modal-header .edit.modal-title').removeClass('hide');

                setTimeout(function () {
                    $("body").click(function (event) {
                        if (event.target.nodeName != 'TEXTAREA') {
                            if (powiadomieniaModal.modal.find('.modal-header .edit.modal-title textarea').val() != powiadomieniaModal.modal.find('.modal-header h4.modal-title').text()) {
                                powiadomieniaModal.title = $.trim(powiadomieniaModal.modal.find('.modal-header .edit.modal-title textarea').val());
                                powiadomieniaModal.modal.find('.modal-header h4.modal-title').text(powiadomieniaModal.title);
                            }

                            powiadomieniaModal.modal.find('.modal-header .edit.modal-title').addClass('hide');
                            powiadomieniaModal.modal.find('.modal-header h4.modal-title').removeClass('hide');

                            $("body").unbind('click');
                        }
                    });
                }, 0);
            })
        },
        additionalInfo: function () {
            console.log(powiadomieniaModal.ajax);
            window.setTimeout(function () {
                $.ajax({
                    type: 'GET',
                    url: powiadomieniaModal.ajax.additionalUrl,
                    data: powiadomieniaModal.ajax.additionalParm,
                    dataType: 'JSON',
                    beforeSend: function () {
                        powiadomieniaModal.modal.modal();
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

                        powiadomieniaModal.modal.find('.modal-body').html('');

                        powiadomieniaModal.modal.find('.modal-body').append(
                            $('<div></div>').addClass('datasets').append(
                                    $('<h5></h5>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_DATASETS)
                                ).append(
                                    $('<hr />')
                                )
                        )
                        if (data['datasets'].length > 0) {
                            $.each(data['datasets'], function () {
                                powiadomieniaModal.modal.find('.modal-body .datasets').append(
                                    $('<div></div>').addClass('checkbox').append(
                                        $('<label></label>').text(this.name).prepend(
                                            $('<input />').attr({'type': 'checkbox', 'name': 'data[datasets][ids]'}).val(this.id)
                                        )
                                    )
                                )
                                if (this.selected)
                                    powiadomieniaModal.modal.find('.modal-body .datasets input:last').prop('checked', true);
                            })
                        } else {
                            powiadomieniaModal.modal.find('.modal-body .datasets').append(
                                $('<span></span>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_NO_DATASETS)
                            )
                        }

                        powiadomieniaModal.modal.find('.modal-body').append(
                            $('<div></div>').addClass('keywords').append(
                                    $('<h5></h5>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_KEYWORDS)
                                ).append(
                                    $('<hr />')
                                )
                        )

                        if (data['keywords'].length > 0) {
                            $.each(data['keywords'], function () {
                                powiadomieniaModal.modal.find('.modal-body .keywords').append(
                                    $('<div></div>').addClass('checkbox').append(
                                        $('<label></label>').text(this.name).prepend(
                                            $('<input />').attr({'type': 'checkbox', 'name': 'data[keywords][ids]'}).val(this.id)
                                        )
                                    )
                                )
                                if (this.selected)
                                    powiadomieniaModal.modal.find('.modal-body .keywords input:last').prop('checked', true);
                            })
                        } else {
                            powiadomieniaModal.modal.find('.modal-body .keywords').append(
                                $('<span></span>').text('Brak keywordsów')
                            )
                        }
                    }
                })
            }, 0);
        }
    }
}(jQuery));