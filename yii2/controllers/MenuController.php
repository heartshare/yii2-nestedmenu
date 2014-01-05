<?php

namespace nestedmenu\controllers;

use nestedmenu\helpers\Sanitizer;
use nestedmenu\models\Menu;
use nestedmenu\models\MenuProfile;
use nestedmenu\models\NestedMenuQuery;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use yii\web\View;

/**
 * MenuController implements the CRUD actions for Menu model.
 * Class MenuController
 * @package nestedmenu\controllers
 */
class MenuController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NestedMenuQuery;
        $dataProvider = $searchModel->search($_GET);
//        VarDumper::dump(\Yii::$app->db->driverName,100,true);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuProfile();

        if ($model->load($_POST)) {
            $root = new Menu();
            $root->title = Sanitizer::getSanitizedUrlValue($model->title);
            $root->root = 1;
            if ($root->saveNode()) {
                $model->tree_id = $root->id;
                $model->slug = $root->title;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            };
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->registerJsProfile($model);
        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * register the js Files
     * @param $model
     */
    private function registerJsProfile($model)
    {
        $view = $this->getView();
        $view->registerJs(
            'var appendTaskUrl = "'.$this->createUrl('appendMenuList',array('list_id' => $model->id)).'"',
            View::POS_HEAD,
            'append-task-url'
        );
        $view->registerJs(
            'var updateListSortingUrl = "'.$this->createUrl('updateListSorting').'"',
            View::POS_HEAD,
            'update-list-sorting'
        );
        $view->registerJs(
            'var updateTreeUrl = "'.$this->createUrl('updateListItem').'"',
            View::POS_HEAD,
            'update-list'
        );

        $view->registerJs(
            'var voProfile = '.json_encode($model->attributes).';',
            View::POS_HEAD,
            'profile'
        );

//        Yii::app()->clientscript->registerScriptFile($this->module->assetsUrl.'/js/vendor-min.js',CClientScript::POS_END);
//        Yii::app()->clientscript->registerScriptFile($this->module->assetsUrl.'/js/menulist.js',CClientScript::POS_END);
//        Yii::app()->clientscript->registerScriptFile($this->module->assetsUrl.'/js/menulist-events.js',CClientScript::POS_END);
//        Yii::app()->clientscript->registerScript('profile','var voProfile = '.CJSON::encode($model->attributes),CClientScript::POS_END);
//        Yii::app()->clientscript->registerScript('appendList','var appendTaskUrl = "'.$this->createUrl('appendMenuList',array('list_id' => $model->id)).'"',CClientScript::POS_END);
//        Yii::app()->clientscript->registerScript('updateListSorting','var updateListSortingUrl = "'.$this->createUrl('updateListSorting').'"',CClientScript::POS_END);
//        Yii::app()->clientscript->registerScript('updateList','var updateTreeUrl = "'.$this->createUrl('updateListItem').'"',CClientScript::POS_END);
    }
}
