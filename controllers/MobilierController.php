<?php

namespace app\controllers;

use Yii;
use app\models\Mobilier;
use app\models\MobilierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MobilierController implements the CRUD actions for Mobilier model.
 */
class MobilierController extends Controller
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
     * Lists all Mobilier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MobilierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mobilier model.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_MOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($REFERENCE_PATRIMOINE, $ID_MOBILIER)
    {
        return $this->render('view', [
            'model' => $this->findModel($REFERENCE_PATRIMOINE, $ID_MOBILIER),
        ]);
    }

    /**
     * Creates a new Mobilier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mobilier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $model->ID_MOBILIER]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mobilier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_MOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($REFERENCE_PATRIMOINE, $ID_MOBILIER)
    {
        $model = $this->findModel($REFERENCE_PATRIMOINE, $ID_MOBILIER);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $model->ID_MOBILIER]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mobilier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_MOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($REFERENCE_PATRIMOINE, $ID_MOBILIER)
    {
        $this->findModel($REFERENCE_PATRIMOINE, $ID_MOBILIER)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mobilier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_MOBILIER
     * @return Mobilier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($REFERENCE_PATRIMOINE, $ID_MOBILIER)
    {
        if (($model = Mobilier::findOne(['REFERENCE_PATRIMOINE' => $REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $ID_MOBILIER])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}