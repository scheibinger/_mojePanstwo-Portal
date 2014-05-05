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
            $('#frazyModalBox').remove();
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
            console.log(powiadomieniaModal.footer);
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
            window.setTimeout(function () {
                $.ajax({
                    type: 'GET',
                    url: powiadomieniaModal.ajax.additionalUrl,
                    // data: powiadomieniaModal.ajax.additionalParm,
                    dataType: 'JSON',
                    beforeSend: function () {
                        powiadomieniaModal.modal.modal();
                    },
                    success: function (results) {
                        var data = results.group;

                        powiadomieniaModal.modal.find('.modal-body').html('');

                        powiadomieniaModal.modal.find('.modal-body').append(
                            $('<div></div>').addClass('keywords').append(
                                    $('<h5></h5>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_KEYWORDS)
                                ).append(
                                    $('<hr />')
                                )
                        )

                        if (data.phrases.length > 0) {
                            powiadomieniaModal.modal.find('.modal-body .keywords').append(
                                $('<input />').attr({'name': 'keywords', 'id': 'keywordsInput'})
                            )
                            var dataPhrasesArray = [];
                            $.each(data.phrases, function (index, value) {
                                dataPhrasesArray.push(value);
                            })
                            powiadomieniaModal.modal.find('.modal-body #keywordsInput').val(dataPhrasesArray.join(","))
                        } else {
                            powiadomieniaModal.modal.find('.modal-body .keywords').append(
                                $('<input />').attr({'name': 'keywords', 'id': 'keywordsInput'})
                            )
                        }
                        $('#keywordsInput').tagsInput({
                            'interactive': true,
                            'defaultText': _mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_KEYWORDS_INPUT,
                            'minChars': 0
                        });

                        powiadomieniaModal.modal.find('.modal-body').append(
                            $('<div></div>').addClass('datasets').append(
                                    $('<h5></h5>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_DATASETS)
                                ).append(
                                    $('<hr />')
                                )
                        )

                        if (data.apps.length > 0) {
                            $.each(data.apps, function (index, value) {
                                powiadomieniaModal.modal.find('.modal-body .datasets').append(
                                    $('<div></div>').addClass('switchCheckbox').append(
                                            $('<input />').attr({'type': 'checkbox', 'name': value.name, 'checked': 'checked'}).data({'size': 'small'}).val(value.id)
                                        ).append(
                                            $('<label></label>').text(value.name)
                                        )
                                )
                                powiadomieniaModal.modal.find('.modal-body .datasets .switchCheckbox:last input').bootstrapSwitch('disabled', true, true);
                            });
                        } else {
                            powiadomieniaModal.modal.find('.modal-body .datasets').append(
                                $('<span></span>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_NO_DATASETS)
                            )
                        }
                    }
                })
            }, 0);
        }
    }
}(jQuery));