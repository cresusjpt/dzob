<?php

namespace app\controllers;

use app\models\Action;
use Yii;
use app\models\Utilisateur;
use app\models\UtilisateurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtilisateurController implements the CRUD actions for Utilisateur model.
 */
class UtilisateurController extends Controller
{
    public $_user_actions;
    public $_tablename;
    public $_models;
    public $_logging;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Utilisateur models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UtilisateurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Utilisateur model.
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_PERSONNE = 0, $IDENTIFIANT)
    {
        $model = $this->findModel($ID_PERSONNE, $IDENTIFIANT);

        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Utilisateur::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Utilisateur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws Yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Utilisateur();
        $this->_logging = false;

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->rawpassword);
            $model->generateAuthKey();
            if ($model->validate()) {
                $action = Action::findOne('CREATE');
                $this->_user_actions = $action->CODE_ACTION;
                $this->_tablename = Utilisateur::tableName();
                $this->_models = $model;
                $this->_logging = true;
                $model->save();
                $this->logger();
                return $this->redirect(['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Utilisateur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\Exception
     */
    public function actionUpdate($ID_PERSONNE, $IDENTIFIANT)
    {
        $model = $this->findModel($ID_PERSONNE, $IDENTIFIANT);
        $this->_logging = false;

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->rawpassword);
            $model->generateAuthKey();
            $model->DM_MODIFICATION = date("Y-m-d H:i:s");
            $action = Action::findOne('UPDATE');
            $this->_user_actions = $action->CODE_ACTION;
            $this->_tablename = Utilisateur::tableName();
            $this->_models = $model;
            $this->_logging = true;
            $model->save();
            $this->logger();
            return $this->redirect(['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT]);
        }

        //set password to null avoid to show the hashpassword in the view
        $model->PASSWORD = null;
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Utilisateur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($ID_PERSONNE, $IDENTIFIANT)
    {
        $model = $this->findModel($ID_PERSONNE, $IDENTIFIANT);

        $action = Action::findOne('CREATE');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Utilisateur::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $model->delete();
        $this->logger();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Utilisateur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @return Utilisateur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_PERSONNE, $IDENTIFIANT)
    {
        if (($model = Utilisateur::findOne(['ID_PERSONNE' => $ID_PERSONNE, 'IDENTIFIANT' => $IDENTIFIANT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'Cette page n\'existe pas.'));
    }

    /**
     *
     */
    protected function logger()
    {
        if ($this->_logging) {
            $logManager = new SysLogManager();
            $logManager->inputLog($this->_user_actions, $this->_tablename, $this->_models);
        }
    }
}
