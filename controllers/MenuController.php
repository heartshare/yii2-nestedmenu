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

use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\View;


/**
 * MenuController implements the CRUD actions for Menu model.
 * Class MenuController
 * @package nestedmenu\controllers
 */
class MenuController extends Controller
{
    private $urlManager;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'createleaf' => ['post'],
                    'moveleaf' => ['post'],
                    'updateleaf' => ['post']
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

    public function init(){
        $this->urlManager = Yii::$app->urlManager;
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
//        VarDumper::dump($model->attributes,10,true);
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
        $model->setScenario('create');

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
                    echo Json::encode(
                        [
                            'validate'  => $model->validate(),
                            'model'     => $model->attributes,
                            'root_id'   => $root_id
                        ]
                    );
                    return;
                }
            }
        }
        echo $this->renderPartial('_form_create_leaf', [
            'model'     => $model,
            'action'    =>$this->urlManager->createAbsoluteUrl('nestedmenu/menu/createleaf',['root_id' => $root_id])
        ]);
    }

    /**
     * update a leaf by Id
     * the config and the profile would be updated
     */
    public function actionUpdateleaf($id){
        $model = NestedMenuTree::findOne($id);

        if($model->load($_POST) && $model->config->load($_POST) && $model->profile->load($_POST)){
//            echo VarDumper::dump($_POST,10,true);
//            echo VarDumper::dump($model->attributes,10,true);
            $model->config->update();
            $model->profile->update();
            echo Json::encode(
                [
                    'validate'  => $model->validate(),
                    'model'     => $model->attributes
                ]
            );
            return;
//            echo VarDumper::dump($model->config->attributes,10,true);
//            echo VarDumper::dump($model->profile->attributes,10,true);
//            exit;
        }
        echo $this->renderPartial(
            '_form_update_leaf',
            [
                'model' => $model
            ]
        );
//        echo VarDumper::dump($_POST,10,true);
    }
    /**
     * Move the leaf to the dragged position
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
     */
    public function actionMoveleaf(){

//        echo VarDumper::dump($_POST,10,true);
        $data       = $_POST['MoveList'];
        if( isset($data['leafId']) && isset($data['to']) && isset($data['moveType']) ){
            $root   = NestedMenuTree::findOne($data['to']);
            $model  = NestedMenuTree::findOne($data['leafId']);
            if($model->$data['moveType']($root)){
                echo VarDumper::dump($model->attributes,10,true);
            }else{
                echo 'no';
            };
            return;
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
        if (($model = NestedMenuTree::findOne($id)) !== null) {
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
        $manager = Yii::$app->urlManager;
        $view->registerJs(
            "$('[data-toggle=\"popover\"]').popover();".PHP_EOL,
            View::POS_READY,
            'popover'
        );
        $view->registerJs(
            "$('[data-toggle=\"tooltip\"]').tooltip();".PHP_EOL,
            View::POS_READY,
            'tooltip'
        );
        $view->registerJs(
            'var appendTaskUrl = "'.$manager->createAbsoluteUrl('nestedmenu/menu/createleaf').'"',
            View::POS_HEAD,
            'append-task-url'
        );
        $view->registerJs(
            'var moveLeaf = "'.$manager->createUrl('nestedmenu/menu/moveleaf').'"',
            View::POS_HEAD,
            'update-list-sorting'
        );
        $view->registerJs(
            'var updateleaf = "'.$manager->createAbsoluteUrl(['nestedmenu/menu/updateleaf']).'"',
            View::POS_HEAD,
            'update-leaf'
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
//        Yii::app()->clientscript->registerScript('appendList','var appendTaskUrl = "'.$this->urlManager->createUrl('appendMenuList',array('list_id' => $model->id)).'"',CClientScript::POS_END);
//        Yii::app()->clientscript->registerScript('updateListSorting','var updateListSortingUrl = "'.$this->urlManager->createUrl('updateListSorting').'"',CClientScript::POS_END);
//        Yii::app()->clientscript->registerScript('updateList','var updateTreeUrl = "'.$this->urlManager->createUrl('updateListItem').'"',CClientScript::POS_END);
    }
}
