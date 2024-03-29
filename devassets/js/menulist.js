(function ($) {
    "use strict";
    var FormController = {
        $modalHolder: '',
        $form: '',
        $requestUrl: '',
        $modalOpen: false,
        $newTask: {},
        $root_id: '',
        $csrf_token: null,
        $csrf_param: null,
        init: function () {
            this.$modalHolder = $('#nested_menu_modal');
            this.$requestUrl = appendTaskUrl;
            this._getCsrf();
            this._registerEventListener();
            this.$modalHolder.find('btn-success').on('click', function (event) {
                event.preventDefault()
            });
        },
        _registerEventListener: function () {
            $(document)
                .on('create-list-item', $.proxy(this._appendLeaf, this))
                .on('update-list-item', $.proxy(this._getEditForm, this));
        },
        _getEditForm: function (event, modelId) {
            var updateUrl = updateTreeUrl + '/id/' + modelId,
                self = this;
            $.ajaxSetup({
                headers: {
                    'Authorization': "Basic"
                },
                beforeSend: function (xhr, settings) {
                    xhr.setRequestHeader("X-CSRFToken", self.$csrf_token);
                }
            });
            $.ajax({
                'url': updateUrl,
                'type': 'POST'
            })
                .done(function (formBody) {
                    self._addFormBody(formBody, '#menu-list-config-_form_edit_list-form', 'Config bearbeiten');
                })
                .error(function () {
                    console.error(updateUrl + ' missmatch!')
                });

        },
        _appendLeaf: function (event, root_id) {
            this.$root_id = root_id;

            var self = this;
            $.ajax({
                'url': self.$requestUrl + '?root_id=' + self.$root_id,
                'type': 'POST'
            })
                .done(function (formBody) {
                    self._addFormBody(formBody, '#form_create_leaf', 'Neuen Menüpunkt hinzufügen');
                })
                .error(function () {

                });
        },
        _addFormBody: function (body, formId, headline) {
            $('.modal-header').children('h2').text(headline);
            $('.modal-body').html(body);
            console.log(body);
            this.$form = $(formId);
            if (!this.$modalOpen) {
                this._openForm();
            }
            this._registerFormEvent();
        },
        _openForm: function () {
            var self = this;

            this.$modalHolder.modal();
            this.$modalHolder.on('shown', function () {
                self.$modalOpen = true;
            });
            this.$modalHolder.on('hide', function () {
                self.$modalOpen = false;
            });
        },
        _registerFormEvent: function () {
            var self = this;
            console.log(self.$form);
            self.$form.on('submit', function (event) {
                event.preventDefault();
                self.$newTask = $(this).serialize();
                console.log(['self.$newTask', self.$newTask])
                //return;
                self._sendForm(self.$newTask, $(this).attr('action'));
            });
        },
        /**
         * @param data
         * @private
         */
        _sendForm: function (data, action) {
            var self = this;
            $.ajax({
                'url': action,
                'type': 'POST',
                'data': data
            }).done(function (data) {
                    console.log(data);
                    return;
                    if (self._isJson(data)) {
                        data = $.parseJSON(data);
                        console.log(data.redirect);
                        self.$modalHolder.modal('hide');
//                    window.location.href= data.redirect;
                        return;
                    }
                    self._addFormBody(data);
                    self._registerFormEvent();
                }).error(function () {
                    console.error('failed');
                })
        },
        /**
         *
         * @param data
         * @returns {boolean}
         * @private
         */
        _isJson: function (data) {
            var IS_JSON = true;
            try {
                $.parseJSON(data);

            } catch (err) {
                IS_JSON = false;
            }
            return IS_JSON;

        },
        _getCsrf: function () {
            var self = this;
            self.$csrf_token = $('meta[name=csrf-token]').attr('content');
            self.$csrf_param = $('meta[name=csrf-var]').attr('content');
        }
    };

    /**
     * Initializes the component
     */
    $(
        function () {
            FormController.init()
        }
    );
}(jQuery));
/**
 *
 */
(function ($) {
    "use strict";
    /**
     *
     * @type {{$list: string, init: Function, _registerEventListener: Function, dump: Function}}
     */
    var SortableList = {
        $list: '',
        $activeItemId: null,
        $startArray: null,
        $updateArray: null,
        $changeItem: null,
        $updateItem: null,
        /**
         * Start
         */
        init: function () {
            var self = this;
            self.$list = $('ol.sortable');
            self._setNestedSortable();
            self._registerEventListener();
        },
        /**
         * append the nestedSortable to the $list
         * triggers update change Event
         * @private
         */
        _setNestedSortable: function () {
            var self = this;
                /**
                 * plz use https://github.com/FinalAngel/nestedSortable
                 * it be fixed ui 1.10
                 */
                self.$list.nestedSortable({
                    handle: 'div',
                    items: 'li',
                    toleranceElement: '> div',
                    helper: 'clone',
                    isTree: true,
                    expandOnHover: 700,
                    startCollapsed: false,
                    placeholder: 'placeholder',
                    revert: 250,
                    tabSize: 25,
                    update: function (event, ui) {
                        var list = $(this).nestedSortable('toArray', {startDepthCount: 0});
                        /**
                         * We trigger the nestedSortable update event
                         */
                        $(document).trigger('nestedmenu.updated', [ui, list])
                    },
                    change: function (event, ui) {
                        /**
                         * we trigger the nestedSortable Event
                         */
                        $(document).trigger('nestedmenu.change', [ui])
                    }
                });
                self.$startArray = self.$list.nestedSortable('toArray', {startDepthCount: 0})
        },

        /**
         * we catch the itemId and fill the
         * $changeItem with Object
         * @param event
         * @param ui
         * @private
         */
        _changeLeaf: function (event, ui) {
            var self = this;
            self.$activeItemId = $(ui.item).data('asset-id');
            self._returnItemByID(self.$startArray, self.$activeItemId, 'change');

            console.log(self.$changeItem, 'old');
        },

        /**
         * we check the new Position
         * @param event
         * @param ui
         * @param list
         * @private
         */
        _updateLeaf: function (event, ui, list) {
            var self = this;
            self.$updateArray = list;
            self._returnItemByID(self.$updateArray, self.$activeItemId, 'update');

            console.log('id', self.$activeItemId);
            console.log('new', self.$updateItem);
        },

        /**
         * each on change over the $startArray to get out old Position
         * each on update over the $updateArray to get out new Position
         * @param tree
         * @param id
         * @param attr
         * @private
         * @return Object{
         *  prev,
         *  leaf,
         *  next
         * }
         */
        _returnItemByID: function (tree, id, attr) {
            var self = this;

            $(tree).each(function (index, leaf) {
                if (parseInt(leaf.item_id) === parseInt(id)) {

                    var response = {
                        prev: tree[index - 1],
                        leaf: leaf,
                        next: tree[index + 1]
                    };
                    return attr === 'change' ? self.$changeItem = response : self.$updateItem = response;
                }
            });
        },

        /**
         * register the eventListener to Dom
         * @private
         */
        _registerEventListener: function () {
            var self = this;
            $(document)
                .on('task-save', $.proxy(this._getArray, this))
                .on('append-new-item-to-list', $.proxy(this._getArray, this))
                .on('nestedmenu.change', $.proxy(self._changeLeaf, this))
                .on('nestedmenu.updated', $.proxy(self._updateLeaf, this));
        },

        /**
         * Dump the tree
         * @param arr
         * @param level
         * @returns {string}
         */
        dump: function (arr, level) {
            var self = this;
            var dumped_text = "";
            if (!level) level = 0;

            //The padding given at the beginning of the line.
            var level_padding = "";
            for (var j = 0; j < level + 1; j++) level_padding += "    ";

            if (typeof(arr) == 'object') { //Array/Hashes/Objects
                for (var item in arr) {
                    var value = arr[item];

                    if (typeof(value) == 'object') { //If it is an array,
                        dumped_text += level_padding + "'" + item + "' ...\n";
                        dumped_text += self.dump(value, level + 1);
                    } else {
                        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                    }
                }
            } else { //Strings/Chars/Numbers etc.
                dumped_text = "===>" + arr + "<===(" + typeof(arr) + ")";
            }
            return dumped_text;
        },
        _update: function (arr) {
            var main = {sorted_list: arr};
            var self = this;
            $.ajax({
                'url': updateListSortingUrl,
                'type': 'POST',
                'data': main,
                'dataType': 'json'
            }).done(function (arraied) {
                    arraied = self.dump(arraied);
                    (typeof($('#toArrayOutput')[0].textContent) != 'undefined') ? $('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
                }).error(function () {
                    console.log(updateTreeUrl, 'something missmatch');
                });
        },
        _appendNewItem: function (event, root_id, model) {

        }
    };

    /**
     * Initializes the component
     */
    $(
        function () {
            // Initializes the B_Gallery Grid
            SortableList.init()
            $('.sub_item').on(
                'webkitAnimationEnd mozAnimationEnd oAnimationEnd animationEnd',
                function () {
                    $(this).removeClass('animated bounceInDown');
                }
            )
        }
    );
}(jQuery));