<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FemaleForm;
use app\models\Female;
use yii\helpers\ArrayHelper;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = '???????????????')
    {
        $model = Female::find()->select(['femalenumber','femalename','femalenote'])->all();
        // $rcvdatas = ArrayHelper::toArray($model, [
        //     'app\models\Female' => [
        //         'femalenumber',
        //         'femalename',
        //         'femalenote',
        //     ],
        // ]);

        // foreach($model as $key => $value){
        //     var_dump($model[$key]->femalename);
        // }
        // die();

        // $model = new Female();
        // $model->femalenumber = 'A008';
        // $model->femalename = '????????????';
        // $model->femalenote = '????????? ???????????????';
        // $model->save();
        // if ($model->validate()) {
        //     // ??????!
        // } else {
        //     // ??????!
        //     // $model->getErrors() ?????????
        // }

        return $this->render('say', ['message' => $message,'model'=>$model]);
    }

    public function actionEntry()
    {
        $model = new Female();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // $model ?????????????????????????????????????????????
            $rcvdata = Yii::$app->request->post("Female");
            $model->femalenumber = $rcvdata["femalenumber"];
            $model->femalename = $rcvdata["femalename"];
            $model->femalenote = $rcvdata["femalenote"];
            $model->save();
            // ????????? $model ???????????????????????????????????????????????? ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // ??????????????????????????????????????????????????????????????????????????????
            return $this->render('entry', ['model' => $model]);
        }
    }
}
