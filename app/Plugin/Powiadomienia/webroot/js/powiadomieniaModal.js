var powiadomieniaModal;

(function ($) {
    powiadomieniaModal = {
        constans: {
            title: '',
            modal: null,
            footer: null,
            hiddenInput: {},
            ajax: {},
        },
        options: {},
        init: function (options) {
            powiadomieniaModal.options = $.extend({}, powiadomieniaModal.constans, options);

            powiadomieniaModal.createModal();
            powiadomieniaModal.editTitle();
        },
        createModal: function () {
            $('#frazyModalBox').remove();
            powiadomieniaModal.options.modal = $('<div></div>');
            powiadomieniaModal.options.modal.addClass("modal fade").attr({'id': "frazyModalBox", "tabindex": -1, "role": "dialog", "aria-labelledby": "myModalLabel", "aria-hidden": "true"}).append(
                $('<div></div>').addClass('modal-dialog').append(
                    $('<form></form>').append(
                        $('<div></div>').addClass('modal-content').append(
                                $('<div></div>').addClass('modal-header').append(
                                        $('<button></button>').addClass('close').attr({'role': 'close', "data-dismiss": "modal", "aria-hidden": "true"}).html('&times;')
                                    ).append(
                                        $('<h4></h4>').addClass('modal-title').attr({'id': 'frazyModalTitle', 'data-placeholder': _mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_TITLE_PLACEHOLDER}).text(powiadomieniaModal.options.title)
                                    ).append(
                                        $('<div></div>').addClass('edit modal-title hide').append(
                                            $('<textarea></textarea>').addClass('modal-title form-control').attr({'type': 'text', 'rows': 2, 'name': 'title', 'placeholder': _mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_TITLE_PLACEHOLDER}).text(powiadomieniaModal.options.title)
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
            if ($.isEmptyObject(powiadomieniaModal.options.hiddenInput === false)) {
                var hiddenInputs = $('<div></div>').addClass('visibledNone');

                $.each(powiadomieniaModal.options.hiddenInput, function (index, value) {
                    hiddenInputs.append($('<input />').attr({'name': index, type: 'hidden'}).val(value));
                });
                powiadomieniaModal.options.modal.find('.modal-dialog form').append(hiddenInputs);
            }
        },
        footerConstruct: function () {
            if (powiadomieniaModal.options.footer == null) {
                powiadomieniaModal.options.modal.find('.modal-content').append(
                    $('<div></div>').addClass('modal-footer').append(
                        $('<button></button>').addClass('btn btn-default closed pull-left').attr({'type': 'button'}).text('Zamknij')
                    )
                )
            } else {
                powiadomieniaModal.options.footer.prepend(
                    $('<button></button>').addClass('btn btn-default closed pull-left').attr({'type': 'button'}).text('Zamknij')
                );
                powiadomieniaModal.options.modal.find('.modal-content').append(powiadomieniaModal.options.footer);
            }
            powiadomieniaModal.options.modal.modal();
            powiadomieniaModal.options.modal.find('.modal-footer .closed').click(powiadomieniaModal.options.modal.modal('toggle'));
            powiadomieniaModal.additionalInfo();
        },
        editTitle: function () {
            if (powiadomieniaModal.options.title == '')
                powiadomieniaModal.options.modal.find('.modal-header h4.modal-title').text('...');

            powiadomieniaModal.options.modal.find('.modal-header h4.modal-title').click(function () {
                powiadomieniaModal.options.modal.find('.modal-header h4.modal-title').addClass('hide').focus();
                powiadomieniaModal.options.modal.find('.modal-header .edit.modal-title').removeClass('hide').keypress(function (e) {
                    if (e.which == 13) {
                        powiadomieniaModal.editTitleChange();
                        return false;
                    }
                });
                var tempTextarea = powiadomieniaModal.options.modal.find('.modal-header .edit.modal-title textarea').val();
                powiadomieniaModal.options.modal.find('.modal-header .edit.modal-title textarea').focus().val('').val(tempTextarea);
                setTimeout(function () {
                    $("body").click(function (event) {
                        if (event.target.nodeName != 'TEXTAREA') {
                            powiadomieniaModal.editTitleChange();
                        }
                    });
                }, 0);
            })
        },
        editTitleChange: function () {
            if (powiadomieniaModal.options.modal.find('.modal-header .edit.modal-title textarea').val() != powiadomieniaModal.options.modal.find('.modal-header h4.modal-title').text()) {
                powiadomieniaModal.options.title = $.trim(powiadomieniaModal.options.modal.find('.modal-header .edit.modal-title textarea').val());
                if (powiadomieniaModal.options.title == '')
                    powiadomieniaModal.options.modal.find('.modal-header h4.modal-title').text('...');
                else
                    powiadomieniaModal.options.modal.find('.modal-header h4.modal-title').text(powiadomieniaModal.options.title);
            }

            powiadomieniaModal.options.modal.find('.modal-header .edit.modal-title').addClass('hide');
            powiadomieniaModal.options.modal.find('.modal-header h4.modal-title').removeClass('hide');

            $("body").unbind('click');
        },
        additionalInfo: function () {
            if (powiadomieniaModal.options.ajax.additionalUrl != null) {
                if (powiadomieniaModal.options.additionalInfoList) {
                    var appList = powiadomieniaModal.options.additionalInfoList;
                    if (appList.status == undefined || appList.status == 'pending') {
                        window.setTimeout(function () {
                            powiadomieniaModal.additionalInfo();
                        }, 400);
                    } else if (appList.status == 'success' || appList.status == 'error') {
                        powiadomieniaModal.additionalInfoAjax();
                    }
                } else {
                    powiadomieniaModal.additionalInfoAjax();
                }
            } else {
                powiadomieniaModal.additionalInfoLoad({});
            }
        },
        additionalInfoAjax: function () {
            $.ajax({
                type: 'GET',
                url: powiadomieniaModal.options.ajax.additionalUrl,
                dataType: 'JSON',
                success: function (results) {
                    var data = results.group;
                    powiadomieniaModal.additionalInfoLoad(data);
                }
            })
        },
        additionalInfoLoad: function (data) {
            window.setTimeout(function () {
                    powiadomieniaModal.options.modal.find('.modal-body').html('');

                    powiadomieniaModal.options.modal.find('.modal-body').append(
                        $('<div></div>').addClass('keywords').append(
                                $('<h5></h5>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_KEYWORDS)
                            ).append(
                                $('<hr />')
                            )
                    )

                    powiadomieniaModal.options.modal.find('.modal-body .keywords').append(
                        $('<input />').attr({'name': 'keywords', 'id': 'keywordsInput'})
                    )
                    if (data.phrases && data.phrases.length > 0) {
                        var dataPhrasesArray = [];
                        $.each(data.phrases, function (index, value) {
                            dataPhrasesArray.push(value);
                        })
                        powiadomieniaModal.options.modal.find('.modal-body #keywordsInput').val(dataPhrasesArray.join(","))
                    }


                    powiadomieniaModal.options.modal.find('.modal-body .keywords #keywordsInput').tagsInput({
                        'interactive': true,
                        'defaultText': _mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_KEYWORDS_INPUT,
                        'minChars': 2
                    });


                    powiadomieniaModal.options.modal.find('.modal-body').append(
                        $('<div></div>').addClass('datasets').append(
                                $('<h5></h5>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_DATASETS)
                            ).append(
                                $('<hr />')
                            ).append(
                                $('<div></div>').addClass('datasetsContent')
                            )
                    )

                    if (powiadomieniaModal.options.additionalInfoList && powiadomieniaModal.options.additionalInfoList.status == 'success') {
                        var appList = powiadomieniaModal.options.additionalInfoList;
                        if (appList.list.length > 0) {
                            $.each(appList.list, function (index, app) {
                                powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsContent').append(
                                    $('<div></div>').addClass('switchCheckbox').append(
                                            $('<input />').attr({'type': 'checkbox', 'name': 'apps[' + app.name + ']'}).data({'size': 'small'}).val(app.id)
                                        ).append(
                                            $('<label></label>').text(app.name)
                                        ).append(
                                            $('<div></div>').addClass('datasetsList')
                                        )
                                )
                                $.each(app.datasets, function (index, subApp) {
                                    powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsList:last').append(
                                        $('<div></div>').addClass('checkbox').append(
                                            $('<label></label>').text(subApp.name).append(
                                                $('<input />').attr({'type': 'checkbox', 'name': 'subapps[' + app.name + '][' + subApp.name + ']'}).data({'size': 'small'}).val(subApp.id)
                                            )
                                        )
                                    )
                                })

                            });
                            if (data.apps && data.apps.length > 0) {
                                $.each(data.apps, function (index, app) {
                                    var checkedApp = powiadomieniaModal.options.modal.find('.modal-body .datasets input[name="apps[' + app.name + ']"]');
                                    checkedApp.attr('checked', 'checked');

                                    $.each(app.datasets, function (index, subapp) {
                                        var checkedSubApp = powiadomieniaModal.options.modal.find('.modal-body .datasets input[name="subapps[' + app.name + '][' + subapp.name + ']"]');
                                        checkedSubApp.attr('checked', 'checked');
                                    });
                                })
                            }
                            powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsContent > .switchCheckbox > input').bootstrapSwitch();
                        } else if (data.apps && data.apps.length > 0) {
                            $.each(data.apps, function (index, app) {
                                powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsContent').append(
                                    $('<div></div>').addClass('switchCheckbox').append(
                                            $('<input />').attr({'type': 'checkbox', 'name': 'apps[' + app.name + ']', 'checked': 'checked'}).data({'size': 'small'}).val(app.id)
                                        ).append(
                                            $('<label></label>').text(app.name)
                                        ).append(
                                            $('<div></div>').addClass('datasetsList')
                                        )
                                )
                                $.each(app.datasets, function (index, subApp) {
                                    powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsList:last').append(
                                        $('<div></div>').addClass('switchCheckbox checkbox').append(
                                            $('<label></label>').text(subApp.name).append(
                                                $('<input />').attr({'type': 'checkbox', 'name': 'subapps[' + app.name + '][' + subApp.name + ']', 'checked': 'checked'}).data({'size': 'small'}).val(subApp.id)
                                            )
                                        )
                                    )
                                })

                                powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsContent > .switchCheckbox:last > input').bootstrapSwitch();
                            });
                        } else {
                            powiadomieniaModal.options.modal.find('.modal-body .datasets').append(
                                $('<span></span>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_NO_DATASETS)
                            )
                        }
                    } else {
                        if (data.apps && data.apps.length > 0) {
                            $.each(data.apps, function (index, app) {
                                powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsContent').append(
                                    $('<div></div>').addClass('switchCheckbox').append(
                                            $('<input />').attr({'type': 'checkbox', 'name': app.name, 'checked': 'checked'}).data({'size': 'small'}).val(app.id)
                                        ).append(
                                            $('<label></label>').text(app.name)
                                        )
                                )
                                $.each(app.datasets, function (index, subApp) {
                                    powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsList:last').append(
                                        $('<div></div>').addClass('switchCheckbox checkbox').append(
                                            $('<label></label>').text(subApp.name).append(
                                                $('<input />').attr({'type': 'checkbox', 'name': 'subapps[' + app.name + '][' + subApp.name + ']', 'checked': 'checked'}).data({'size': 'small'}).val(subApp.id)
                                            )
                                        )
                                    )
                                })
                                powiadomieniaModal.options.modal.find('.modal-body .datasets .datasetsContent > .switchCheckbox:last > input').bootstrapSwitch();
                            });
                        } else {
                            powiadomieniaModal.options.modal.find('.modal-body .datasets').append(
                                $('<span></span>').text(_mPHeart.translation.LC_POWIADOMIENIA_POWIADOMENIA_MODAL_NO_DATASETS)
                            )
                        }
                    }
                    var appSwitch;
                    if ((appSwitch = powiadomieniaModal.options.modal.find('form .datasets .datasetsContent > .switchCheckbox')).length != 0) {
                        appSwitch.append(
                                jQuery('<a></a>').addClass('slide right').attr({'href': '#showDatasets'})
                            ).prepend(
                                jQuery('<a></a>').addClass('slide left').attr({'href': '#showDatasets'})
                            )
                        appSwitch.find('> label, >.slide').click(function (e) {
                            var that = $(this),
                                parent = that.parents('.switchCheckbox'),
                                subAppList = parent.find('.datasetsList'),
                                width = powiadomieniaModal.options.modal.find('.modal-body > .datasets').outerWidth(),
                                animSpeed = 600;

                            e.preventDefault();

                            if (parent.hasClass('choosed')) {
                                parent.removeClass('choosed');

                                parent.find('>.bootstrap-switch').stop(true, true).animate({'margin-left': 0}, animSpeed / 2, function () {
                                    parent.removeAttr('style');
                                });
                                parent.find('a.slide.left').stop(true, true).animate({left: '-50px', 'opacity': 0}, animSpeed / 2)
                                parent.find('a.slide.right').stop(true, true).animate({right: '1%', 'opacity': 1}, animSpeed / 2)
                                subAppList.stop(true, true).animate({right: -width, opacity: 0}, animSpeed, function () {
                                    subAppList.stop(true, true).animate({height: 0}, animSpeed / 2, function () {
                                        subAppList.hide().removeAttr('style');
                                    })
                                })
                                $.each(appSwitch, function () {
                                    $(this).slideDown(animSpeed / 2);
                                    $(this).stop(true, true).animate({opacity: 1}, animSpeed)
                                })
                            } else {
                                parent.addClass('choosed');

                                $.each(appSwitch, function () {
                                    if (!($(this).hasClass('choosed'))) {
                                        $(this).stop(true, true).animate({opacity: 0}, animSpeed / 2, function () {
                                            $(this).slideUp(animSpeed / 2);
                                        })
                                    } else {
                                        parent.find('>.bootstrap-switch').stop(true, true).animate({'margin-left': 40}, animSpeed / 2);
                                        parent.find('a.slide.left').stop(true, true).animate({left: '1%', 'opacity': 1}, animSpeed / 2)
                                        parent.find('a.slide.right').stop(true, true).animate({right: '-50px', 'opacity': 0}, animSpeed / 2)
                                    }
                                })

                                var autoHeight = subAppList.css('height', 'auto').outerHeight() + 20;

                                subAppList.css({'right': -width, opacity: 0}).height(0).show().stop(true, true).animate({height: autoHeight}, animSpeed / 2, function () {
                                    subAppList.stop(true, true).animate({right: 0, opacity: 1, height: 'auto'}, animSpeed);
                                });
                            }
                        })
                    }
                }, 200
            );
        }
    }
}(jQuery));