/* Pure Javascript cause _mojePanstwo User Cockpit (top bar) will be portable on others sites where there's can be no jQuery, Prototype, etc */
var _mojePanstwoCockpitSlider = {
    dialog: {
        'boxName': 'mojePanstwoCockpitDialogBox',
        'invisibleName': 'mojePanstwoCockpitInvisibleDialogBox'
    },
    data: {
        collection: null,
        controllersCollection: null,
        menuWidth: null,
        totalSlides: null
    },
    setting: {
        'prefix': "mojePanstwoCockpit-prefix-",
        'prefixhighlightClass': "_mojePanstwoCockpitMenuUpSubMenuListActive",
        'controlPrefix': "mojePanstwoCockpit-control-",
        'controlPrefixhighlightClass': "_mojePanstwoCockpitMenuUpSubMenuControlsListActive",
        'containerID': "_mojePanstwoCockpitMenuUpSubMenuList",
        'controlsID': "_mojePanstwoCockpitMenuUpSubMenuControlsList",
        'controlsArrowLeft': "_mojePanstwoCockpitMenuUpSubMenuControlsArrowLeft",
        'controlsArrowRight': "_mojePanstwoCockpitMenuUpSubMenuControlsArrowRight",
        'delay': 3000,
        'animationInterval': 20,
        'transitionSteps': 30
    },
    transStat: {
        'crtStep': 0,
        'timeout': 0,
        'crtIndex': 1,
        'nextSlideIndex': 1
    },

    init: function () {
        var that = this;
        // collect the slides and the controls
        this.data.collection = document.getElementById(this.setting.containerID).children;

        this.data.totalSlides = this.data.collection.length;
        if (this.data.totalSlides < 2) return;

        for (var i = 0; i < this.data.collection.length; i++) {
            // give IDs to slides and controls
            that.data.collection[i].id = that.setting.prefix + (i + 1);

            //create DOM element: anchor node
            var node = document.createElement('a');
            node.innerHTML = i;
            node.id = that.setting.controlPrefix + (i + 1);
            node.onclick = function (event) {
                event.preventDefault();
                that.clickSlide(this);
            };
            document.getElementById(that.setting.controlsID).appendChild(node);
        }

        this.data.controllersCollection = document.getElementById(this.setting.controlsID).children;

        document.getElementById(this.setting.prefix + '1').className = this.setting.prefixhighlightClass;
        document.getElementById(this.setting.controlPrefix + '1').className = this.setting.controlPrefixhighlightClass;

        this.initDialogBox();
        this.transComplete();
    },

    clickSlide: function (control) {
        this.changeSlide(Number(control.id.substr(control.id.lastIndexOf("-") + 1)));
    },

    prevSlide: function () {
        this.changeSlide(Number((this.transStat.crtIndex - 1 <= 0) ? 1 : this.transStat.crtIndex - 1));

        return false;
    },

    nextSlide: function () {
        this.changeSlide(Number((this.transStat.crtIndex + 1 > this.data.totalSlides) ? this.data.totalSlides : this.transStat.crtIndex + 1));

        return false;
    },

    changeSlide: function (slideNo) {
        // don't do any action while a transition is in progress
        if (this.transStat.crtStep != 0 || slideNo == this.transStat.crtIndex)
            return;

        clearTimeout(this.transStat.timeout);

        // get references to the current slide and to the one to be shown next
        this.transStat.nextSlideIndex = slideNo;
        this.transStat.crtSlide = document.getElementById(this.setting.prefix + this.transStat.crtIndex);
        this.transStat.nextSlide = document.getElementById(this.setting.prefix + this.transStat.nextSlideIndex);
        this.transStat.crtStep = 0;

        this.transSlide();
    },

    transSlide: function () {
        var that = this;

        // setup subMenu width (if not set yet)
        if (!this.data.menuWidth)
            that.data.menuWidth = document.getElementById(that.setting.containerID).offsetWidth;

        // make sure the next slide is visible (albeit transparent)
        this.transStat.nextSlide.style.display = "block";

        // calculate new move position
        if ((this.transStat.crtStep += this.setting.transitionSteps) > this.data.menuWidth)
            this.transStat.crtStep = this.data.menuWidth;

        // set direction of move (to the right)
        if (this.transStat.crtIndex < this.transStat.nextSlideIndex) {
            if (that.transStat.nextSlide.style.position != 'absolute')
                that.transStat.nextSlide.style.position = 'absolute';

            that.transStat.crtSlide.style.marginLeft = "-" + this.transStat.crtStep + "px";
            that.transStat.nextSlide.style.left = (that.data.menuWidth - that.transStat.crtStep) + "px";

        }// set direction of move (to the left)
        else if (this.transStat.crtIndex > this.transStat.nextSlideIndex) {
            if (that.transStat.nextSlide.style.position != 'absolute')
                that.transStat.nextSlide.style.position = 'absolute';

            that.transStat.crtSlide.style.marginLeft = that.transStat.crtStep + "px";
            that.transStat.nextSlide.style.left = "-" + (that.data.menuWidth - that.transStat.crtStep) + "px";
        }

        // if not completed, do this step again after a short delay
        if (this.transStat.crtStep < this.data.menuWidth)
            that.transStat.timeout = setTimeout("_mojePanstwoCockpitSlider.transSlide()", that.setting.animationInterval);
        else {
            // complete
            that.transStat.crtSlide.style.display = "none";
            that.transStat.crtSlide.style.marginLeft = "";
            that.transStat.nextSlide.style.position = "";
            that.transStat.nextSlide.style.left = "";
            that.transComplete();
        }
    },

    transComplete: function () {
        var that = this;

        this.transStat.crtStep = 0;
        this.transStat.crtIndex = this.transStat.nextSlideIndex;

        //unhighlight all controls
        for (var i = 0; i < this.data.controllersCollection.length; i++) {
            this.data.collection[i].className = "";
            this.data.controllersCollection[i].className = "";
        }

        // highlight the control for the next slide
        document.getElementById(this.setting.prefix + this.transStat.crtIndex).className = this.setting.prefixhighlightClass;
        document.getElementById(this.setting.controlPrefix + this.transStat.crtIndex).className = this.setting.controlPrefixhighlightClass;

        // change arrow status
        if (this.transStat.crtIndex - 1 <= 0) {
            document.getElementsByClassName(that.setting.controlsArrowLeft)[0].childNodes[0].style.opacity = "0.3";
            document.getElementsByClassName(that.setting.controlsArrowLeft)[0].childNodes[0].style.filter = 'alpha(opacity="30")';
        } else {
            document.getElementsByClassName(that.setting.controlsArrowLeft)[0].childNodes[0].style.opacity = "1";
            document.getElementsByClassName(that.setting.controlsArrowLeft)[0].childNodes[0].style.filter = 'alpha(opacity="100")';

            // for IE filters, removing filters reenables cleartype
            if (document.getElementsByClassName(that.setting.controlsArrowLeft)[0].childNodes[0].style.removeAttribute)
                document.getElementsByClassName(that.setting.controlsArrowLeft)[0].childNodes[0].style.removeAttribute("filter");
        }

        if (this.transStat.crtIndex + 1 > this.data.totalSlides) {
            document.getElementsByClassName(that.setting.controlsArrowRight)[0].childNodes[0].style.opacity = "0.3";
            document.getElementsByClassName(that.setting.controlsArrowRight)[0].childNodes[0].style.filter = 'alpha(opacity="30")';
        } else {
            document.getElementsByClassName(that.setting.controlsArrowRight)[0].childNodes[0].style.opacity = "1";
            document.getElementsByClassName(that.setting.controlsArrowRight)[0].childNodes[0].style.filter = 'alpha(opacity="100")';

            // for IE filters, removing filters reenables cleartype
            if (document.getElementsByClassName(that.setting.controlsArrowRight)[0].childNodes[0].style.removeAttribute)
                document.getElementsByClassName(that.setting.controlsArrowRight)[0].childNodes[0].style.removeAttribute("filter");
        }
    },

    initDialogBox: function () {
        var appFolders = document.getElementById('_mojePanstwoCockpitMenuUpSubMenuList').getElementsByClassName('appFolder');

        for (var i = 0; i < appFolders.length; i++) {
            appFolders[i].onclick = function (event) {
                event.preventDefault();
                _mojePanstwoCockpitSlider.showDialogBox(event);
            };
        }
    },

    showDialogBox: function (event) {
        var nodeMain = event.target;
        event.preventDefault();
        event.stopPropagation();

        //Closing menu list
        document.getElementById('_mojePanstwoCockpitMenuUpSubMenu').style.display = 'none';

        while (nodeMain.className != 'appContruct appFolder') {
            nodeMain = nodeMain.parentNode;
        }

        // Check if invisible box exist - if not, we create it
        if (document.contains(document.getElementById(_mojePanstwoCockpitSlider.dialog.invisibleName))) {
            document.getElementById(_mojePanstwoCockpitSlider.dialog.invisibleName).style.display = 'block';
        } else {
            var invisibleBox = document.createElement('div');
            invisibleBox.id = _mojePanstwoCockpitSlider.dialog.invisibleName;
            document.body.appendChild(invisibleBox);
            invisibleBox.style.display = 'block';
        }

        // Check if application list dialog exist - if yes, we destroy it before create new one
        if (document.contains(document.getElementById(_mojePanstwoCockpitSlider.dialog.boxName)))
            _mojePanstwoCockpitSlider.destroyDialogBox();

        var appListDialog = document.createElement('div'),
            appListClone = nodeMain.getElementsByClassName('appList')[0].cloneNode(true);

        appListDialog.id = _mojePanstwoCockpitSlider.dialog.boxName;
        appListDialog.appendChild(appListClone);
        document.body.appendChild(appListDialog);

        //center dialog box
        var padding = 20,
            boxHeight = appListDialog.getElementsByClassName('appList')[0].offsetHeight + padding;

        if (boxHeight < ((window.outerHeight * 0.9) - document.getElementsByTagName('header')[0].offsetHeight))
            appListDialog.style.height = boxHeight + "px";
        appListDialog.style.marginTop = "-" + ((appListDialog.offsetHeight / 2) - document.getElementsByTagName('header')[0].offsetHeight - padding / 2 ) + "px";
        appListDialog.style.marginLeft = "-" + (appListDialog.offsetWidth / 2) + "px";

        _mojePanstwoCockpitSlider.animateDialogBox();

        document.getElementById(_mojePanstwoCockpitSlider.dialog.invisibleName).onclick = function () {
            _mojePanstwoCockpitSlider.hideDialogBox();
        }
    },

    animateDialogBox: function () {
        var dialogBox = document.getElementById(_mojePanstwoCockpitSlider.dialog.boxName),
            done = true;

        //Setting opacity to 0
        dialogBox.style.opacity = 0;
        dialogBox.style.filter = 'alpha(opacity=0)';

        //setting top position at 0;
        dialogBox.style.top = "0";

        if (done && dialogBox.style.opacity !== '1') {
            done = false;
            for (var i = 1; i <= 100; i++) {
                setTimeout((function (x) {
                    return function () {
                        dialogBox.style.opacity = x / 100;
                        dialogBox.style.filter = 'alpha(opacity=' + x + ')';

                        dialogBox.style.top = ((100 - x) / 5) + (x / 2) + "%";

                        if (x == 1) {
                            dialogBox.style.display = 'block';
                        }
                        if (x == 100) {
                            done = true;
                        }
                    };
                })(i), i * 4);
            }
        }
    },

    hideDialogBox: function () {
        if (document.contains(document.getElementById(_mojePanstwoCockpitSlider.dialog.invisibleName)))
            document.getElementById(_mojePanstwoCockpitSlider.dialog.invisibleName).style.display = 'none';
        _mojePanstwoCockpitSlider.destroyDialogBox();
    },

    destroyDialogBox: function () {
        if (document.contains(document.getElementById(_mojePanstwoCockpitSlider.dialog.boxName))) {
            var element = document.getElementById(_mojePanstwoCockpitSlider.dialog.boxName);
            element.parentNode.removeChild(element);
        }
    }
};

(function () {
    _mojePanstwoCockpitSlider.init();

    document.getElementById('_mojePanstwoCockpitMenuUpContent').onclick = function (e) {
        e.stopPropagation();
        document.getElementById('_mojePanstwoCockpitMenuUpSubMenu').style.display = 'block';
    };
    document.getElementsByTagName('html')[0].onclick = function () {
        document.getElementById('_mojePanstwoCockpitMenuUpSubMenu').style.display = 'none';
    }
})();