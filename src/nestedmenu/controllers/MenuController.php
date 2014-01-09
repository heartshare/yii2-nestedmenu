<?php

namespace nestedmenu\controllers;

use Yii;
use nestedmenu\helpers\Sanitizer;
use nestedmenu\helpers\Typo;
use nestedmenu\helpers\Glyph;
use nestedmenu\models\NestedMenuProfile;
use nestedmenu\models\NestedMenuConfig;
use nestedmenu\models\NestedMenuTree;
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
                    'createLeave' => ['post']
                ],
            ],
//            'access' => [
//                'class' => \yii\web\AccessControl::className(),
//                'only' => ['createLeave', 'signup'],
//                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
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
        $model = new NestedMenuProfile();

        if ($model->load($_POST)) {

            $root = new NestedMenuTree();
            $root->title = Sanitizer::getSanitizedUrlValue($model->title);
            if ($root->saveNode()) {
                $config = new NestedMenuConfig();
                $config->tree_id = $root->id;
                $config->save(false);

                $model->tree_id = $root->id;
                $model->slug = $root->title;

                $uniqueTest = NestedMenuProfile::find()->where(['slug' => $root->title])->one();
                if(!empty($uniqueTest))
                    $model->slug = $model->slug.'-'.uniqid();

                if ($model->save()) {
                    Yii::$app->session->setFlash(
                        'info',
                        Typo::AlertBodyHelper(
                            Glyph::icon(Glyph::ICON_BELL),
                            'Tree saved'
                        )
                    );
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    VarDumper::dump($model->getErrors(),10,true);
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
        }else{
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
        VarDumper::dump($model->attributes,10,true);
        $this->registerJsProfile($model);
        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateleaf($root_id){
        $root = $this->findModel($root_id);
        $model = new NestedMenuTree();

        if($model->load($_POST)){
            $profile        = new NestedMenuProfile();
            $profile->title = $model->title;
            $model->title   = Sanitizer::getSanitizedUrlValue($model->title);

            if($model->appendTo($root)){
                $config = new NestedMenuConfig();

                $profile->tree_id   = $model->id;
                $config->tree_id    = $model->id;

                $uniqueTest = NestedMenuProfile::find()->where(['slug' => $model->title])->one();

                if(!empty($uniqueTest))
                    $profile->slug  = $profile->slug.'-'.uniqid();

                if($profile->save() && $config->save()){
                    echo json_encode(
                        [
                            'validate'  => $model->validate(),
                            'model'     => $model->attributes,
                            'root_id'   => $root_id,
                            'redirect'  => $this->createUrl('update',array('id' => $root_id))
                        ]
                    );
                    return;
                }

            }

        }
        echo $this->renderPartial('_form_create_leaf', [
            'model'     => $model,
            'action'    => $this->createAbsoluteUrl('createleaf',['root_id' => $root_id])
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteNode();
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
        if (($model = NestedMenuTree::find($id)) !== null) {
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
            'var appendTaskUrl = "'.$this->createAbsoluteUrl('createleaf').'"',
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
            'var model = '.json_encode($model->attributes).';',
            View::POS_HEAD,
            'root'
        );
        $view->registerJs(
            'var modelProfile = '.json_encode($model->profile).';',
            View::POS_HEAD,
            'profile'
        );
        $view->registerJs(
            'var modelConfig = '.json_encode($model->config).';',
            View::POS_HEAD,
            'config'
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
