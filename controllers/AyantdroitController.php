<?php

namespace app\controllers;

use Yii;
use app\models\AyantDroit;
use app\models\AyantDroitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AyantdroitController implements the CRUD actions for AyantDroit model.
 */
class AyantdroitController extends Controller
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
     * Lists all AyantDroit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AyantDroitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AyantDroit model.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_PERSONNE, $ID_AYANTDROIT)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_PERSONNE, $ID_AYANTDROIT),
        ]);
    }

    /**
     * Creates a new AyantDroit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AyantDroit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AyantDroit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_PERSONNE, $ID_AYANTDROIT)
    {
        $model = $this->findModel($ID_PERSONNE, $ID_AYANTDROIT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AyantDroit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID_PERSONNE, $ID_AYANTDROIT)
    {
        $this->findModel($ID_PERSONNE, $ID_AYANTDROIT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AyantDroit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @return AyantDroit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_PERSONNE, $ID_AYANTDROIT)
    {
        if (($model = AyantDroit::findOne(['ID_PERSONNE' => $ID_PERSONNE, 'ID_AYANTDROIT' => $ID_AYANTDROIT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
