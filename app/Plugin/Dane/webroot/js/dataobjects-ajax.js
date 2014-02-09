/*global translation*/

var DataObjectesAjax = {
    init: function () {
        this.setLanguage();
        this.HistoryMagic();
        this.sniffFromClick();
        this.sorting();
        this.pageChange();
        this.submitChanger();
        this.datepickerForInputs();
        this.removeHiddenInput();
        this.buttonSearchWithoutPhrase();
    },
    /*WE ARE REMOVING HIDDEN INPUT NEED ONLY TO WORK CORRECTLY FORM WHEN PAGE DOESN'T PROVIDE JS */
    removeHiddenInput: function () {
        jQuery('#DatasetViewForm input[type="hidden"], .dataSortings input[type="hidden"]').remove();
    },
    setLanguage: function () {
        switch (_mPHeart.language.threeDig) {
            case "pol":
                /*CHANGE DATEPICKER i18n LANGUAGE*/
                jQuery.datepicker.setDefaults(jQuery.datepicker.regional['pl']);
                break;
            case "eng":
                /*CHANGE DATEPICKER i18n LANGUAGE*/
                jQuery.datepicker.setDefaults(jQuery.datepicker.regional['']);
                break;
        }
    },
    HistoryMagic: function () {
        History.Adapter.bind(window, 'statechange', function () { // Note: We are using statechange instead of popstate
            var State = History.getState(); // Note: We are using History.getState() instead of event.state

            if (State.data.page == "Dane") {
                DataObjectesAjax.ajaxReload(State.data.filters);
            }
        });
    },
    /*CREATING ADDITIONAL BUTTON TO RUN SEARCH WITHOUT LOOKING PHRASE (Q)*/
    buttonSearchWithoutPhrase: function () {
        var buttonExistance = jQuery('<span></span>').addClass('searchWithoutPhrase glyphicon glyphicon-remove'),
            filters = jQuery('#filters');

        filters.find('.filter input[type="text"]').each(function () {
            if (jQuery(this).val() != '') {
                var inputParent = jQuery(this).parent();

                if (inputParent.find('.searchWithoutPhrase').length == 0) {
                    inputParent.append(buttonExistance.clone());
                }
            }
        });

        filters.find('.searchWithoutPhrase').each(function () {
            jQuery(this).click(function () {
                jQuery(this).parent().find('input[type="text"]').val('');
                setTimeout(DataObjectesAjax.objectsReload, 5);
            });
        });
    },
    /*CHECK IF ANY OPTION WASN'T CHANGE - BY CLICK*/
    sniffFromClick: function () {
        var filters = jQuery('.dataBrowser').find('.dataFilters');

        filters.find('.option label').click(function (event) {
            var parent = jQuery(event.target).parent();

            if (parent.attr('class') && parent.attr('class') == 'radio-inline') {
                if (parent.find('#' + jQuery(event.target).attr('for')).prop("checked")) {
                    setTimeout(function () {
                        jQuery('#' + jQuery(event.target).attr('for')).prop("checked", false)
                    }, 0);
                }
            }

            /*HISTORY.JS CHANGE STATUS*/
            setTimeout(DataObjectesAjax.objectsReload, 5);
        })

    },
    submitChanger: function () {
        /*HIDE SUBMIT AT FILTER WHEN PAGE USE JS*/
        jQuery('.dataFilters .submit input').css('visibility', 'hidden');

        /*BLOCK SUBMIT OPTION AND SEND IT BY AJAX*/
        jQuery('#DatasetViewForm').submit(function (event) {
            event.preventDefault();

            setTimeout(DataObjectesAjax.objectsReload, 5);
        })
    },
    datepickerForInputs: function () {
        var filters = jQuery('.dataBrowser').find('.dataFilters');

        jQuery.datepicker.setDefaults({
            'dateFormat': 'yy-mm-dd',
            'changeMonth': true,
            'changeYear': true,
            'onSelect': function () {
                setTimeout(DataObjectesAjax.objectsReload, 5);
            }
        });

        filters.find('.jquery-datepicker').each(function () {
            jQuery(this).datepicker();
        })
    },
    /*REDESIGN SORTING OPTION AND ADD AJAX REQUEST*/
    sorting: function () {
        var sorting = jQuery('.dataSortings');

        /*HIDE UNNECESSARY ELEMENTS*/
        sorting.find('.submit').hide();
        sorting.find('#DatasetDirection').hide();
        sorting.find('#DatasetSort').hide();
        sorting.find('.sortingName').addClass('hidden');

        /*CREATE DROPDOWN MENU STRUCTURE*/
        var sortingChoosed = (sorting.find('#DatasetSort option:selected').length > 0) ? sorting.find('#DatasetSort option:selected').attr('title') : sorting.find('#DatasetSort option:first').attr('title');
        sorting.find('#DatasetSort').before(
                jQuery('<div></div>').addClass('sortingGroup btn-group pull-right').append(
                        jQuery('<button></button>').addClass('DatasetSort btn btn-default btn-sm').attr({'data-toggle': 'dropdown', 'type': 'button'}).text(sortingChoosed)
                    ).append(
                        jQuery('<button></button>').addClass('DatasetDirection btn btn-default btn-sm').attr({'data-toggle': 'dropdown', 'type': 'button'}).append(
                            jQuery('<span></span>').addClass('glyphicon glyphicon-chevron-down')
                        )
                    ).append(function () {
                        var ul = jQuery('<ul></ul>').addClass('dropdown-menu').attr('role', 'menu');

                        jQuery.each(sorting.find('#DatasetSort optgroup'), function () {
                            var grp = jQuery(this);
                            if (grp.data('special') == 'result') {
                                ul.append(
                                    jQuery('<li></li>').addClass('special result').append(function () {
                                        var that = jQuery(this);
                                        jQuery.each(grp.find('option'), function () {
                                            that.append(jQuery('<a></a>').attr({'href': '#', 'title': jQuery.trim(jQuery(this).text()), 'value': jQuery(this).val()}).text(jQuery.trim(jQuery(this).text())))
                                        });
                                    })
                                )
                            } else {
                                ul.append(jQuery('<li></li>').append(
                                        jQuery('<label></label>').text(grp.attr('label'))
                                    ).append(function () {
                                        var span = jQuery('<span></span>');
                                        jQuery.each(grp.find('option'), function () {
                                            span.append(jQuery('<a></a>').attr({'href': '#', 'title': grp.attr('label') + ' (' + jQuery.trim(jQuery(this).text()) + ')', 'value': jQuery(this).val()}).text(jQuery.trim(jQuery(this).text())));
                                        });
                                        jQuery(this).append(span);
                                    })
                                )
                            }
                        });
                        jQuery(this).append(ul);

                        DataObjectesAjax.sortingAddRemoveOptions();
                    })
            ).before(
                jQuery('<span></span>').css({'float': 'right', 'padding-right': '10px'}).text(_mPHeart.translation.LC_DANE_SORTOWANIE)
            );
        sorting.find('.sortingGroup > ul a').click(function (event) {
            var sortingDirection = sorting.find('.DatasetSort');
            event.preventDefault();

            sortingDirection.data('sort', jQuery(this).attr('value')).text(jQuery(this).attr('title'));

            DataObjectesAjax.sortingReload();
        });
    },
    /*ADDING/REMOVING NEW OPTION NORMALY ADDED AT GENERATING PAGE*/
    sortingAddRemoveOptions: function () {
        var filtersInputQ = jQuery('#filters').find('input[name="q"]'),
            sortingGroup = jQuery('.dataSortings .sortingGroup'),
            sortingName = sortingGroup.find('.DatasetSort'),
            sortingList = sortingGroup.find('ul.dropdown-menu');

        /*WHEN "LOOKING PHRASE" EXIST - WE ADD NEW OPTIONS AT SORTING...*/
        if (((filtersInputQ.length > 0) && (filtersInputQ.val() != '')) && (sortingList.find('a[value="score desc"]').length == 0)) {
            sortingList.prepend(jQuery('<li></li>').addClass('special result').append(jQuery('<a></a>').attr({'href': '#', 'title': _mPHeart.translation.LC_DANE_SORTOWANIE_TRAFNOSC, 'value': 'score desc'}).text(_mPHeart.translation.LC_DANE_SORTOWANIE_TRAFNOSC)));
            sortingName.text(_mPHeart.translation.LC_DANE_SORTOWANIE_TRAFNOSC);
        }

        /*... AND WHEN "LOOKING PHRASE" NOT EXIST - WE REMOVE IT*/
        if (((filtersInputQ.length == 0) || (filtersInputQ.val() == '')) && (sortingList.find('a[value="score desc"]').length != 0)) {
            sortingList.find('li.special.result').remove();
            sortingName.text(sortingList.find('a:first').attr('title'));
        }
    },
    /*FUNCTION RUN CHAGE PAGE BY AJAX*/
    pageChange: function () {
        var dataObject = jQuery('.dataBrowser').find('.dataObjects');

        dataObject.find('.pagination a').click(function (event) {
            event.preventDefault();

            DataObjectesAjax.pageReload(event.target);
        });
    },
    /*CLICKING ARROW SEND AJAX + CHANGE ARROW DIRECTION*/
    sortingReload: function () {
        var formSerialize = jQuery('#DatasetViewForm').serialize(),
            sortSerialize = 'order=' + jQuery(".DatasetSort").data("sort");

        History.pushState({ filters: formSerialize + '&' + sortSerialize + '&search=web', reloadForm: 'sorting', page: "Dane" }, jQuery(document).find("title").html(), "?" + formSerialize + '&' + sortSerialize + '&search=web');
    },
    /*GATHER FILTER OPTION AND SEND RELOAD AJAX REQUEST*/
    objectsReload: function () {
        var formSerialize = jQuery('#DatasetViewForm').serialize();
        History.pushState({ filters: formSerialize + '&search=web', reloadForm: 'object', page: "Dane" }, jQuery(document).find("title").html(), "?" + formSerialize + '&search=web');
    },
    /*GATHER SORT AND FILTER OPTION AND SEND RELOAD AJAX REQUEST*/
    pageReload: function (target) {
        var paginationSerialize = jQuery(target).attr('href').split("?").pop();
        History.pushState({ filters: paginationSerialize + '&search=web', reloadForm: 'page', page: "Dane" }, jQuery(document).find("title").html(), "?" + paginationSerialize + '&search=web');
    },
    /*AJAX REQUEST AND RELOAD FILTER/RESULT CONTENT*/
    ajaxReload: function (formActualFilters) {
        var main = jQuery('.dataBrowser'),
            filters = main.find('.dataFilters'),
            objects = main.find('.dataObjects'),
            formTarget = filters.find('form'),
            formAction = formTarget.attr('action').split("?").shift(),
            paramArray = formActualFilters.split('&'),
            redirectUrl = false,
            delay = 400;

        if (formAction.substr(formAction.length - 1) == '/') formAction = formAction.substring(0, formAction.length - 1);

        $.grep(paramArray, function (n) {
            if (n.match('dataset')) {
                var dataset = n.split('=');

                if (!redirectUrl)
                    redirectUrl = '/dane/' + dataset[1] + '?' + formActualFilters.replace(/&?((dataset)|(dataset%5B%5D)|(datachannel)|(search))=([^&]$|[^&]*)/gi, "");
            }
        });

        if (redirectUrl)
            location.href = redirectUrl;

        jQuery.ajax({
            url: formAction + '.json?' + formActualFilters,
            dataType: 'GET',
            beforeSend: function () {
                main.append(jQuery('<div></div>').addClass('loadingTwirl'));
                objects.find('.innerContainer').children().animate({
                    opacity: 0.5
                }, { duration: delay, queue: false });
            },
            complete: function (status) {
                var modalBackground,
                    tempContainer = jQuery('<div></div>').html(status.responseText);

                /*REMOVE MODAL BACKGROUND*/
                if ((modalBackground = jQuery('.modal-backdrop')).length > 0) {
                    modalBackground.fadeOut(300, function () {
                        jQuery(this).remove();
                    });
                }

                /*REMOVE LOADING TWIRL*/
                main.find('.loadingTwirl').remove();

                /*RELOAD FILTERS CONTENT WITH DATA FROM AJAX*/
                filters.html(tempContainer.find('#hiddenFilters').html());
                filtersController();

                /*RELOAD OBJECT CONTENT WITH DATA FROM AJAX*/
                objects.find('.innerContainer').children().animate({
                    opacity: 0
                }, delay, function () {
                    
                    objects.find('.pagination').html('');
                    
                    if (tempContainer.find('.innerContainer ul.list-group').children().length == 0)
                    {
                        objects.find('.innerContainer').html('<p class="noResults">' + _mPHeart.translation.LC_DANE_BRAK_WYNIKOW + '</p>');
                    }
                    else
                    {
                        objects.find('.innerContainer').html(tempContainer.find('.innerContainer').html());
                    }
                    objects.find('.innerContainer').children().css('opacity', 0);

                    objects.find('.innerContainer').children().animate({
                        opacity: 1
                    }, { duration: delay });

                    /*UPDATE ACTUAL TOTAL RESULTS*/
                    objects.find('.dataInfo .dataStats strong').text(tempContainer.find('#objectstatus').text());

                    /*RELOAD ASSIGNED FUNCTIONS*/
                    DataObjectesAjax.sniffFromClick();
                    DataObjectesAjax.pageChange();
                    DataObjectesAjax.submitChanger();
                    DataObjectesAjax.datepickerForInputs();
                    DataObjectesAjax.removeHiddenInput();
                    DataObjectesAjax.buttonSearchWithoutPhrase();

                    DataObjectesAjax.sortingAddRemoveOptions();
                    DataObjectesAjax.specialCase();
                    
                });

                /*ANIMATE SCROLL TO TOP OF PAGE*/
                jQuery('body, html').animate({
                    scrollTop: 0
                }, 800);
            }
        });
    },
    /*IN SOME OF VIEW WE LOAD ADDITIONAL JS SO WE HAVE TO REINIT IT AFTER AJAX RELOAD RESULTS*/
    specialCase: function () {
        var objects = jQuery('.dataBrowser').find('.dataObjects');

        /*VIEW - sejm_glosowania*/
        if (objects.find('.highchart').length) {
            objects.find('.highchart').each(function () {
                if (jQuery(this).children().length == 0)
                    highchartInit();
            });
        }
    }
};

jQuery(function () {
    DataObjectesAjax.init();
});