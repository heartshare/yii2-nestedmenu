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
                .on('create-list-item', $.proxy(this._getForm, this))
                .on('update-list-item', $.proxy(this._getEditForm, this));
        },
        /**
         * update a leaf from a tree
         * @param event
         * @param modelId
         * @private
         */
        _getEditForm: function (event, modelId) {
            console.log('FormController->getEditForm()->modelId',modelId);
            var self = this,
                promise = $.ajaxSetup({
                    headers: {
                        'Authorization': "Basic"
                    },
                    beforeSend: function (xhr, settings) {
                        xhr.setRequestHeader("X-CSRFToken", self.$csrf_token);
                    }
                });
                promise = $.ajax({
                    'url': updateleaf,
                    'type': 'POST',
                    'data':{id:modelId}
                })

                promise.done(function (formBody) {
                    self._addFormBody(formBody, '#menu-list-config-_form_edit_list-form', 'Config bearbeiten');
                })

                promise.error(function () {
                    console.error(updateleaf + ' missmatch!')
                });


        },
        _getForm: function (event, root_id) {
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
    var SortTree = {
        $list: '',
        $activeItemId: null,
        $startArray: null,
        $updateArray: null,
        $changeItem: null,
        $updateItem: null,
        $inserType: null,
        $csrf_token:'',
        $csrf_param:'',
        /**
         * Start
         */
        init: function () {
            var self = this;
                self._getCsrf();
                self.$list = $('ol#taskTree1');
                self._setNestedSortable();
                self._registerEventListener();
        },
        /**
         * reda the token forom the header
         * @private
         */
        _getCsrf: function () {
            var self = this;
                self.$csrf_token = $('meta[name=csrf-token]').attr('content');
                self.$csrf_param = $('meta[name=csrf-var]').attr('content');
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
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                protectRoot: true,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: 120,
                connectWith: ".sortable",
                isTree: true,
                expandOnHover: 200,
                startCollapsed: true,
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
            }).disableSelection();

//            $('ol#taskTree2').nestedSortable({
//                forcePlaceholderSize: true,
//                handle: 'div',
//                helper: 'clone',
//                items: 'li',
//                opacity: .6,
//                placeholder: 'placeholder',
//                revert: 250,
//                tabSize: 25,
//                protectRoot: true,
//                tolerance: 'pointer',
//                toleranceElement: '> div',
//                maxLevels: 120,
//                connectWith: ".sortable",
//                isTree: true,
//                expandOnHover: 200,
//                startCollapsed: true,
//            }).disableSelection();
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

            console.log('SortTree->_changeLeaf()->changeItem',self.$changeItem);
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

            var result = self._moveUpdateType();
            self._move(result);

            console.log('SortTree->_updateLeaf()->result', result);
            console.log('SortTree->_updateLeaf()->id', self.$activeItemId);
            console.log('SortTree->_updateLeaf()->updateItem', self.$updateItem);
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
                        next: tree[index + 1] !== undefined?tree[index+1]:false
                    };
//                    console.log('SortTree->_returnItemByID()->'+attr,response);
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

            $('.disclose').on('click', function () {
                $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
                $(this).children('span').toggleClass('glyphicon-resize-full').toggleClass('glyphicon-resize-small');
            })
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
        /**
         * // move phones to the proper place
         * $x100 = Category::find(10);
         * $c200 = Category::find(9);
         * $samsung = Category::find(7);
         * $x100->moveAsFirst($samsung);
         * $c200->moveBefore($x100);
         *
         * // now move all Samsung phones branch
         * $mobile_phones = Category::find(1);
         * $samsung->moveAsFirst($mobile_phones);
         *
         * // move the rest of phone models
         * $iphone = Category::find(6);
         * $iphone->moveAsFirst($mobile_phones);
         * $motorola = Category::find(8);
         * $motorola->moveAfter($samsung);
         *
         * // move car models to appropriate place
         * $cars = Category::find(2);
         * $audi = Category::find(3);
         * $ford = Category::find(4);
         * $mercedes = Category::find(5);
         *
         * foreach(array($audi, $ford, $mercedes) as $category) {
         *  $category->moveAsLast($cars);
         * }
         * @private
         */
        _moveUpdateType: function () {
            var self = this,
                leaf = self.$updateItem.leaf,
                prev = self.$updateItem.prev,
                next = self.$updateItem.next;

            console.log('SortTree->_createInsertType()->prev', prev);
            console.log('SortTree->_createInsertType()->next', next);
            console.log('SortTree->_createInsertType()->leaf', leaf);

            if(prev.parent_id === leaf.parent_id){
                console.log('moveAfter : ' + prev.item_id);
                return {
                    moveType:'moveAfter',
                    leafId:leaf.item_id,
                    to:prev.item_id
                };
            }

            if(
                prev.parent_id === null && next.parent_id !== leaf.parent_id
                || prev.parent_id !== leaf.parent_id && next.parent_id === leaf.parent_id
            ){
                console.log('moveAsFirst : ' + leaf.parent_id);
                return {
                    moveType:'moveAsFirst',
                    leafId:leaf.item_id,
                    to:prev.item_id
                };
            }

            if(prev.parent_id !== leaf.parent_id && next.parent_id !== leaf.parent_id){
                console.log('moveAsLast : ' + leaf.parent_id);
                return {
                    moveType:'moveAsLast',
                    leafId:leaf.item_id,
                    to:prev.item_id
                };
            }


        },
        /**
         * https://github.com/creocoder/yii2-nested-set-behavior#adding-child-nodes
         * $category1->appendTo($root);
         * $category2->insertAfter($category1);
         * $category3->insertBefore($category1);
         * $category3->prependTo($root);
         * We get out which type we need
         * @private
         */
        _createInsertType: function () {
            var self = this,
                leaf = self.$updateItem.leaf,
                prev = self.$updateItem.prev,
                next = self.$updateItem.next;

            console.log('SortTree->_createInsertType()->prev', prev);
            console.log('SortTree->_createInsertType()->next', next);
            console.log('SortTree->_createInsertType()->leaf', leaf);
            console.log('insertAfter : ' + prev.item_id, prev.parent_id === leaf.parent_id);
            console.log('prependTo : ' + prev.item_id, prev.parent_id !== leaf.parent_id);
//            console.log('prependTo : ',prev.parent_id !== leaf.parent_id );

        },
        /**
         *
         * @param arr
         * @private
         */
        _move: function (arr) {
            $.ajaxSetup({
                headers: {
                    'Authorization': "Basic"
                },
                beforeSend: function (xhr, settings) {
                    xhr.setRequestHeader("X-CSRFToken", self.$csrf_token);
                }
            });
            var main = {MoveList: arr},
                self = this,
                promise = $.ajax({
                    'url': moveLeaf,
                    'type': 'POST',
                    'data': main
//                    ,
//                    'dataType': 'json'
                });

            promise.done(function (response) {
                console.log('SortTree->update()->respoonse : ',response);
//                arraied = self.dump(arraied);
//                (typeof($('#toArrayOutput')[0].textContent) != 'undefined') ? $('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
            })
            promise.error(function () {
                console.log(moveLeaf, 'something missmatch');
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
            SortTree.init()
            $('.sub_item').on(
                'webkitAnimationEnd mozAnimationEnd oAnimationEnd animationEnd',
                function () {
                    $(this).removeClass('animated bounceInDown');
                }
            )
        }
    );
}(jQuery));