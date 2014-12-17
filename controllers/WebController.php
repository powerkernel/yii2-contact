<?php

namespace harrytang\contact\controllers;

use harrytang\contact\ContactModule;
use harrytang\contact\models\Setting;
use Yii;
use harrytang\contact\models\Contact;
use harrytang\contact\models\search\Contact as ContactSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WebController implements the CRUD actions for Contact model.
 */
class WebController extends Controller
{
    public $defaultAction = 'create';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'delete', 'done', 'setting'],
                        'allow' => true,
                        'roles' => ['staff'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '@vendor/harrytang/yii2-admin/views/layouts/admin.php';
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Setting
     * @return string
     */
    public function actionSetting()
    {
        $this->layout = '@vendor/harrytang/yii2-admin/views/layouts/admin.php';
        $models = Setting::find()->all();

        if (Yii::$app->request->isPost) {
            foreach ($models as $model) {
                $value = Yii::$app->request->post($model->key);
                $model->value = $value;
                $model->save();
            }
            return $this->refresh();
        } else {

            return $this->render('setting', [
                'models' => $models,
            ]);
        }
    }

    /**
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '@vendor/harrytang/yii2-admin/views/layouts/admin.php';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $settings = Setting::loadAsArray();
        $model = new Contact();


        $model->setScenario('create');
        if (!Yii::$app->user->isGuest) {
            $model->name = Yii::$app->user->identity->username;
            $model->email = Yii::$app->user->identity->email;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', ContactModule::t('Thank you for contacting us. We will respond to you as soon as possible.'));

            // send mail
            Yii::$app->mailer->compose('newContact', ['model' => $model])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($model->email)
                ->setSubject(ContactModule::t('{USER} have contacted you.', ['USER' => $model->name]))
                ->send();

            return $this->refresh();
        } else {
            return $this->render('create', [
                'model' => $model,
                'settings' => $settings
            ]);
        }

    }

    /**
     * Make done a contact
     * @param integer $id
     * @return mixed
     */
    public function actionDone($id)
    {
        $model = $this->findModel($id);
        $model->status = Contact::STATUS_DONE;
        if ($model->save()) {

            return $this->redirect(['index']);
        } else  var_dump($model->errors);
    }

    /**
     * Deletes an existing Contact model.
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
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
