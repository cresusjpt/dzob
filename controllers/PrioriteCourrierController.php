<?php

namespace app\controllers;

use app\models\Action;
use Yii;
use app\models\PrioriteCourrier;
use app\models\PrioriteCourrierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrioriteCourrierController implements the CRUD actions for PrioriteCourrier model.
 */
class PrioriteCourrierController extends Controller
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
     * Lists all PrioriteCourrier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrioriteCourrierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PrioriteCourrier model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = PrioriteCourrier::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new PrioriteCourrier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PrioriteCourrier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_PRIORITE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PrioriteCourrier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_PRIORITE]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PrioriteCourrier model.
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
     * Finds the PrioriteCourrier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PrioriteCourrier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PrioriteCourrier::findOne($id)) !== null) {
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
