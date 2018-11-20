<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /*[
                'class' => PageCache::className(),
                'only' => [''],
                'variations' => [
                    (Yii::$app->getUser()->id)
                ]
            ],*/
            /*'httpCache' => [
                'class' => 'yii\filters\HttpCache',
                'only' => ['about','index'],
                'cacheControlHeader' =>  'public, max-age=5',
                'lastModified' => function ($action, $params) {
                   // return (Yii::$app->user->isGuest)? Yii::$app->formatter->asTimestamp('2000-01-01 01:01:01') : time();
                    return (Yii::$app->user->isGuest)? time() - 50000 : time();

                },
                'etagSeed' => function ($action, $params) {
                    return serialize([Yii::$app->user->isGuest]); // generate ETag seed here
                }
            ],*/

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_DEV ? 'a' : null,
            ],
        ];
    }


    /**
     * Displays homepage.
     * @return mixed
     * @throws Exception
     */
    public function actionIndex()
    {

        if (!Yii::$app->getUser()->isGuest) return $this->redirect(['/admin']);
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack("/admin");
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id == 'error')
                $this->layout = 'error';//This is error layout without database or identity access tp avoid more sources or errors.
            return true;
        } else {
            return false;
        }
    }
}
