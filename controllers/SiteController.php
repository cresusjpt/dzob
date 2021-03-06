<?php

namespace app\controllers;

use app\models\ModeleSphinx;
use app\models\Profil;
use app\models\Rdv;
use app\models\SphinxModele;
use app\models\SysLog;
use app\models\SysParam;
use app\models\UserProfil;
use app\models\Utilisateur;
use SebastianBergmann\CodeCoverage\Util;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\sphinx\ActiveDataProvider;
use yii\sphinx\MatchExpression;
use yii\sphinx\Query;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserForm;
use app\controllers\ImageUtils;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public $_user_actions;
    public $_tablename;
    public $_models;
    public $_logging;

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        } else {

            $civilite = Yii::$app->user->identity->getCivilite();

            $date = date('Y-m-d H:00:00');
            $whereClause = "DATE_RDV >= '$date'";

            $modelRdv = Rdv::find()
                ->where($whereClause)
                ->andWhere(['NOTAIRE' => $civilite])
                ->limit(3)
                ->all();
            return $this->render('index', [
                'rdv' => $modelRdv,
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'loginLayout';
        $models = new Utilisateur();
        if ($models->load(Yii::$app->request->post())) {
            $models->setPassword($models->rawpassword);
            $models->generateAuthKey();
            $models->ETAT = 'INACTIF';
            if ($models->validate()) {
                $models->save();
                Yii::$app->session->setFlash('success', 'Inscription reussie');
                return $this->redirect('site/login');
            }
        }
        return $this->render('register', ['models' => $models]);
    }


    /**
     * Forgot password action
     * @return string
     */
    public function actionForgot()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'loginLayout';
        $models = new Utilisateur();
        return $this->render('forgot', ['models' => $models]);
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

    public function actionHello()
    {
        $test = 'JEANPAUL TOSSOU';
        return $this->render('hello', array('name' => $test));
    }

    /**
     * Displays profile page.
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }
        //$user = Yii::$app->user->identity;
        $user = Utilisateur::findOne(['IDENTIFIANT' => Yii::$app->user->identity->IDENTIFIANT]);
        $user_profil = UserProfil::findOne(['IDENTIFIANT' => Yii::$app->user->identity->IDENTIFIANT]);
        $profile_name = Profil::findOne(['CODE_PROFIL' => $user_profil->CODE_PROFIL]);
        $log = SysLog::find()->where(['IDENTIFIANT' => $user_profil->IDENTIFIANT])->orderBy('DATE_LOG DESC')->limit(20)->all();

        if ($user->load(Yii::$app->request->post())) {
            $user->rawpassword = 'password';
            if (!is_null($user->file = UploadedFile::getInstance($user, 'file'))) {
                $imageFile = UploadedFile::getInstance($user, 'file');
                $directory = SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('PP_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                }
                $initialName = 'pp_' . str_replace(' ', '_', $user->NOM . $user->PRENOM);
                $fileName = 'pp_' . str_replace(' ', '_', $user->NOM . $user->PRENOM) . '.' . $imageFile->extension;
                $filePath = $directory . $fileName;
                if ($imageFile->saveAs($filePath)) {
                    ImageUtils::generateMiniature($filePath, $imageFile->extension, $directory, $initialName);
                    $user->PHOTO = $filePath;
                }
            }
            if (!empty($user->oldpassword)) {
                if (!empty($user->newpassword)) {
                    if ($user->validatePassword($user->oldpassword)) {
                        if ($user->isSamePassword($user->newpassword, $user->repeatpassword)) {
                            $user->setPassword($user->newpassword);
                        } else {
                            $user->addError($user->newpassword, 'Les deux nouveau mot de passe ne correspondent pas');
                            $user->addError($user->repeatpassword, 'Les deux nouveau mot de passe ne correspondent pas');
                        }
                    } else {
                        $user->addError($user->oldpassword, 'Le mot de passe ne correspond pas');
                    }
                } else {
                    $user->addError($user->newpassword, 'Le nouveau mot de passe ne peut être vide');
                }
            }
            if (!$user->hasErrors()) {
                $user->DM_MODIFICATION = date("Y-m-d H:i:s");
                $user->save(false);
            } else {
                echo Json::encode($user->getErrors());
            }
            return $this->redirect('profile');

        }

        return $this->render('myprofile', [
                'log' => $log,
                'profile_name' => $profile_name,
                'user' => $user,
            ]
        );
    }

    public function actionViewPdf()
    {
        $filepath = $_GET['filename'];
        if (file_exists($filepath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename = Un titre pas comme les autres');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($filepath));
            header('Accept-Ranges: bytes');
            $this->renderAjax($filepath);
            //readfile($filepath);
        }
    }

    public function actionSphinx()
    {
    }

    public function actionRechercher()
    {
        $modele = new Sphinxmodele();
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }

        if (isset($_GET['toolbarSearch']) && !empty($_GET['toolbarSearch'])) {

            $search = $_GET['toolbarSearch'];

            $query = new Query();
            $rows = $query->from('sphinxmodele')
                //->match(new Expression(':match',['match'=>'@(contenu_modele) '.Yii::$app->sphinx->escapeMatchValue($search)]))
                ->match(new MatchExpression('@contenu_modele :contenu_modele', ['contenu_modele' => '' . Yii::$app->sphinx->escapeMatchValue($search)]))
                //->match(new MatchExpression('@nom_modele :nom_modele',['nom_modele'=>''.Yii::$app->sphinx->escapeMatchValue($search)]))
                //->orMatch(new MatchExpression('@contenu_modele :contenu_modele',['contenu_modele'=>''.Yii::$app->sphinx->escapeMatchValue($search)]))
                ->all();


            return $this->render('rechercher', [
                'result' => $rows,
                'initialsearch' => $search,
            ]);
        }
    }

    public function actionLock()
    {
        $this->layout = 'loginLayout';
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            Yii::$app->user->logout();
            return $this->render('lock', ['model' => $user]);
        } else {
            $model = new Utilisateur();
            if ($model->load(Yii::$app->request->post())) {
                $loginForm = new LoginForm();
                $loginForm->username = $model->USERNAME;
                $loginForm->password = $model->rawpassword;
                if ($loginForm->login()) {
                    return $this->goBack();
                }
            }
            $this->redirect('site/login');
        }
    }
}
