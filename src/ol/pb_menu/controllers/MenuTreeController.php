<?php
/**
 * Class MenuTreeController
 * @package pb_menu\controllers
 */
Yii::import('menu.models.MenuTree');
Yii::import('menu.models.MenuList');
Yii::import('menu.models.MenuListConfig');
Yii::import('menu.models.MenuIcons');
class MenuTreeController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column_2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array(
                    'index','view','create','update','admin','delete','updateListItem','icomoon','appendMenuList','updateListSorting',
                    'deleteList',
                ),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function init(){
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadInternModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new MenuTree();
        if (isset($_POST['MenuTree'])) {
            $model->attributes = $_POST['MenuTree'];

            if ($model->save()){
                $root = new MenuList('tree');
                $root->name = 'root';
                $root->create= $root->update= date('Y-m-d H:i:s');
                $root->treeId = $model->id;

                if($root->saveNode()){
                    $this->redirect(array('update','id' => $model->id));
                }
            }

        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {

        $model = $this->loadInternModel($id);
        $this->registerProfileCss();
        $this->registerJsProfile($model);

        if (isset($_POST['MenuTree'])) {
            $model->attributes = $_POST['MenuTree'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Append a new List Item to the Tree
     * @param $list_id
     * @param $root_id
     */
    public function actionAppendMenuList($list_id,$root_id)
    {
        $list = $this->loadInternModel($list_id);
        $model = new MenuList('tree');
        $model->treeId = $list_id;

        if(isset($_POST['MenuList']))
        {
            $model->attributes=$_POST['MenuList'];
            if($model->validate())
            {
                $root = MenuList::model()->findByPk($root_id);
                $model->appendTo($root);
//
//                $lookup = new MenuListTree();
//                $lookup->list_id = $model->id;
//                $lookup->tree_id = $list->id;

                if(Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(
                        array(
                            'validate' => $model->validate(),
                            'model' => $model->attributes,
                            'root_id' => $root_id,
                            'redirect' => $this->createUrl('update',array('id' => $model->treeId))
                        )
                    );
                    Yii::app()->end();
                }
            }
        }
        if(Yii::app()->request->isAjaxRequest)
        {
            $this->renderPartial('_form_list',array('model' =>$model));
            Yii::app()->end();
        }else{
            $this->render('_form_list',array('model' =>$model));
        }
    }

    /**
     * catch the Sorted List by Ajax and Save it to Db
     * @throws CHttpException
     */
    public function actionUpdateListSorting()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            if(isset($_POST['sorted_list']))
            {
                foreach($_POST['sorted_list'] as $key => $task)
                {
                    if($task['parent_id'] !== 'none' && $task['parent_id'] !== '')
                    {
                        $model = MenuList::model()->findByPk($task['item_id']);
                        $parent = MenuList::model()->findByPk($task['parent_id']);
                        $model->moveAsLast($parent);
                        $models[] = $model->attributes;
                    }
                }
                echo CJSON::encode($models);
                Yii::app()->end();
            }
        }
        throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * We update the MenuList by Id
     * @param $id
     * @throws CHttpException
     */
    public function actionUpdateListItem($id){
        if(!$id)
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');

//        $dataProvider = new AuthItemDataProvider();
//        $dataProvider->type = CAuthItem::TYPE_OPERATION;
//        $rules = array();
//
//        if(!empty($dataProvider->data))
//        {
//            $rules = CHtml::listData($dataProvider->data,'name','description');
//        }

        $list = MenuList::model()->with('menutree')->findByPk($id);
        $model = $this->getConfigToList($list);

        if(isset($_POST['MenuListConfig'])){
            $model->attributes = $_POST['MenuListConfig'];
            $model->name = $_POST['MenuListConfig']['name'];

            if($model->name !== $list->name){
                $list->name = $model->name;
                $list->saveNode();
            }
            if($model->validate())
            {
                if($model->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        echo CJSON::encode(
                            array(
                                'validate' => $model->validate(),
                                'model' => $model->attributes,
                                'redirect' => $this->createUrl('update',array('id' => $list->menutree[0]->id))
                            )
                        );
                    }
                }
            }
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest)
        {
            echo $this->renderPartial('_form_edit_list',array('model' => $model,/*'rules' => $rules*/));
            Yii::app()->end();
        }
        $this->render('_form_edit_list',array('model' => $model,/*'rules' => $rules*/));
    }

    /**
     * @param MenuList $list
     * @return CActiveRecord|MenuListConfig
     */
    public function getConfigToList(MenuList $list){
        if(isset($list->config)){
            $model = MenuListConfig::model()->findByPk($list->config->id);
            $model->name = $list->name;
        }else{
            $model = new MenuListConfig();
            $model->menu_list_id = $list->id;
            $model->name = $list->name;
        }
        return $model;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param $id
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
//            MenuList::model('tree')->removeNode

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param $id
     * @throws CHttpException
     */
    public function actionDeleteList($id)
    {
//        if (Yii::app()->request->isPostRequest) {
            MenuList::model()->findByPk($id)->deleteNode();

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        } else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('MenuTree');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionIcomoon(){
        $this->render('icomoon');
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new MenuTree('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['MenuTree']))
            $model->attributes = $_GET['MenuTree'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param $id
     * @return array|CActiveRecord|mixed|null
     * @throws CHttpException
     */
    public function loadInternModel($id)
    {
        $model = MenuTree::model()->with(array('list' => array('order' => 'lft')) )->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-tree-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * register the js Files
     * @param $model
     */
    private function registerJsProfile($model)
    {
        Yii::app()->clientscript->registerScriptFile($this->module->assetsUrl.'/js/vendor-min.js',CClientScript::POS_END);
        Yii::app()->clientscript->registerScriptFile($this->module->assetsUrl.'/js/menulist.js',CClientScript::POS_END);
        Yii::app()->clientscript->registerScriptFile($this->module->assetsUrl.'/js/menulist-events.js',CClientScript::POS_END);
        Yii::app()->clientscript->registerScript('profile','var voProfile = '.CJSON::encode($model->attributes),CClientScript::POS_END);
        Yii::app()->clientscript->registerScript('appendList','var appendTaskUrl = "'.$this->createUrl('appendMenuList',array('list_id' => $model->id)).'"',CClientScript::POS_END);
        Yii::app()->clientscript->registerScript('updateListSorting','var updateListSortingUrl = "'.$this->createUrl('updateListSorting').'"',CClientScript::POS_END);
        Yii::app()->clientscript->registerScript('updateList','var updateTreeUrl = "'.$this->createUrl('updateListItem').'"',CClientScript::POS_END);
    }

    /**
     * register the css files
     */
    private function registerProfileCss(){
        Yii::app()->clientscript->registerCssFile($this->module->assetsUrl.'/css/ui-lightness/jquery-ui-1.10.2.custom.min.css');
        Yii::app()->clientscript->registerCssFile($this->module->assetsUrl.'/css/tasktree.css');
    }
}
