<?php

namespace app\controllers;

use app\models\Action;
use Yii;
use app\models\Fonctionnalite;
use app\models\FonctionnaliteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FonctionnaliteController implements the CRUD actions for Fonctionnalite model.
 */
class FonctionnaliteController extends Controller
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
     * Lists all Fonctionnalite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FonctionnaliteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fonctionnalite model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Fonctionnalite::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Fonctionnalite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fonctionnalite();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_FONCT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fonctionnalite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_FONCT]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fonctionnalite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Fonctionnalite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fonctionnalite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fonctionnalite::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La page que vous demandez n\'existe pas.'));
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
