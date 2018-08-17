<?php

namespace app\controllers;

use app\models\Utilisateur;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
        if (Yii::$app->user->isGuest){
            $this->redirect('site/login');
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        Yii::$app->user->logout();
        $this->layout = 'loginLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'models' => $model,
        ]);
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $this->layout = 'loginLayout';
        $models = new Utilisateur();
        if ($models->load(Yii::$app->request->post())) {
            $models->setPassword($models->rawpassword);
            $models->generateAuthKey();

            if ($models->validate()) {
                $models->save();
                Yii::$app->session->setFlash('success', 'Sing up successfull');
                return $this->redirect('site/login');
            }
        }
        return $this->render('register',['models'=>$models]);
    }


    /**
     * Forgot password action
     * @return string
     */
    public function actionForgot()
    {
        $this->layout = 'loginLayout';
        $models = new Utilisateur();
        return $this->render('forgot',['models'=>$models]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        $model = new LoginForm();
        //return $this->render('login',['models'=>$model]);
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
    public function actionAbout(){
        return $this->render('about');
    }

    public function actionHello(){
      $test = 'JEANPAUL TOSSOU';
      return $this->render('hello',array('name'=>$test));
    }

    public function actionUser(){
      $model = new UserForm;
      if ($model->load(Yii::$app->request->post() && $model->validate() )) {
        // code...
      }else {
        return $this->render('userForm',['model'=>$model]);
      }
    }
}
