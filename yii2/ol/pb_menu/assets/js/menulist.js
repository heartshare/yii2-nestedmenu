(function ($) {
    "use strict";
    var FormController = {
        $modalHolder: '',
        $form:'',
        $requestUrl:'',
        $modalOpen:false,
        $newTask:{},
        $root_id:'',
        init: function () {
            this.$modalHolder = $('#demo_modal');
            this.$requestUrl = appendTaskUrl;
            this._registerEventListener();
        },
        _registerEventListener:function()
        {
            $(document)
                .on('create-list-item',$.proxy(this._getForm,this))
                .on('update-list-item',$.proxy(this._getEditForm,this));
        },
        _getEditForm:function(event,modelId){
            var updateUrl = updateTreeUrl+'/id/'+modelId,
                self = this;
            $.ajax({
                'url': updateUrl,
                'type':'POST'
            })
            .done(function(formBody){
                self._addFormBody(formBody,'#menu-list-config-_form_edit_list-form','Config bearbeiten');
            })
            .error(function(){
                console.error(updateUrl+' missmatch!')
            });

        },
        _getForm:function(event,root_id)
        {
            this.$root_id = root_id;

            var self = this;
            $.ajax({
                'url': self.$requestUrl+'/root_id/'+self.$root_id,
                'type':'POST'
            })
            .done(function(formBody){
                self._addFormBody(formBody,'#todo-list-task-_form_todolisttask-form','Neuen Menüpunkt hinzufügen');
            })
            .error(function(){

            });
        },
        _addFormBody:function(body,formId,headline){
            $('.modal-header').children('h4').text(headline);
            $('.modal-body').children('p').html(body);

            this.$form = $(formId);
            if(!this.$modalOpen){
                this._openForm();
            }
            this._registerFormEvent();
        },
        _openForm:function(){
            var self = this;

            this.$modalHolder.modal();
            this.$modalHolder.on('shown',function(){
                self.$modalOpen = true;
            });
            this.$modalHolder.on('hide',function(){
                self.$modalOpen = false;
            });
        },
        _registerFormEvent:function(){
            var self = this;
            this.$form.on('submit',function(event){
                event.preventDefault();
                self.$newTask = $(this).serialize();
                self._sendForm(self.$newTask,$(this).attr('action'));
            });
        },
        /**
         * @param data
         * @private
         */
        _sendForm:function(data,action){
            var self =this;
            $.ajax({
                'url':action,
                'type':'POST',
                'data':data
            }).done(function(data){
                if(self._isJson(data))
                {
                    data = $.parseJSON(data);
                    console.log(data.redirect);
                    self.$modalHolder.modal('hide');
                    window.location.href= data.redirect;
                    return;
                }
                self._addFormBody(data);
                self._registerFormEvent();
            }).error(function(){
                console.error('failed');
            })
        },
        /**
         *
         * @param data
         * @returns {boolean}
         * @private
         */
        _isJson:function(data){
            var IS_JSON = true;
            try{
                $.parseJSON(data);

            }catch(err){
                IS_JSON = false;
            }
            return IS_JSON;

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
        $list:'',
        init: function () {
            this.$list = $('ol.sortable');
            $(this.$list).nestedSortable({
                handle: 'div',
                items: 'li',
                toleranceElement: '> div',
                helper:	'clone',
                isTree: true,
                expandOnHover: 700,
                startCollapsed: true,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25
            });
            this._registerEventListener();
        },
        _registerEventListener:function()
        {
            $(document)
                .on('task-save',$.proxy(this._getArray,this))
                .on('append-new-item-to-list',$.proxy(this._getArray,this));
        },
        _getArray:function(){
            var arraied =  this.$list.nestedSortable('toArray', {startDepthCount: 0});
            this._update(arraied);
        },
        dump:function(arr,level){
            var self = this;
            var dumped_text = "";
            if(!level) level = 0;

            //The padding given at the beginning of the line.
            var level_padding = "";
            for(var j=0;j<level+1;j++) level_padding += "    ";

            if(typeof(arr) == 'object') { //Array/Hashes/Objects
                for(var item in arr) {
                    var value = arr[item];

                    if(typeof(value) == 'object') { //If it is an array,
                        dumped_text += level_padding + "'" + item + "' ...\n";
                        dumped_text += self.dump(value,level+1);
                    } else {
                        dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                    }
                }
            } else { //Strings/Chars/Numbers etc.
                dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
            }
            return dumped_text;
        },
        _update:function(arr){
            var main= {sorted_list:arr};
            var self = this;
            $.ajax({
                'url':updateListSortingUrl,
                'type':'POST',
                'data':main,
                'dataType':'json'
            }).done(function(arraied){
                arraied = self.dump(arraied);
                (typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?$('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
            }).error(function(){
                console.log(updateTreeUrl,'smothing missmatch');
            });
        },
        _appendNewItem:function(event,root_id,model){

        }
    };

    /**
     * Initializes the component
     */
    $(
        function () {
            // Initializes the B_Gallery Grid
            SortableList.init()
        }
    );
}(jQuery));