<?php

namespace app\controllers;

use Yii;
use app\models\Immobilier;
use app\models\ImmobilierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImmobilerController implements the CRUD actions for Immobilier model.
 */
class ImmobilerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Immobilier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImmobilierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Immobilier model.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        return $this->render('view', [
            'model' => $this->findModel($REFERENCE_PATRIMOINE, $ID_IMMOBILIER),
        ]);
    }

    /**
     * Creates a new Immobilier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Immobilier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $model->ID_IMMOBILIER]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Immobilier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        $model = $this->findModel($REFERENCE_PATRIMOINE, $ID_IMMOBILIER);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $model->ID_IMMOBILIER]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Immobilier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        $this->findModel($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Immobilier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return Immobilier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        if (($model = Immobilier::findOne(['REFERENCE_PATRIMOINE' => $REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $ID_IMMOBILIER])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
