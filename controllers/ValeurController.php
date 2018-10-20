<?php

namespace app\controllers;

use app\models\Immobilier;
use app\models\Mobilier;
use Yii;
use app\models\Valeur;
use app\models\ValeurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ValeurController implements the CRUD actions for Valeur model.
 */
class ValeurController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Valeur models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ValeurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList($ref, $id)
    {
        if ($id == 'IMMOBILIER') {
            $countImmobilier = Immobilier::find()
                ->where(['REFERENCE_PATRIMOINE' => $ref])
                ->count();

            $immobiliers = Immobilier::find()
                ->where(['REFERENCE_PATRIMOINE' => $ref])
                ->all();

            if ($countImmobilier > 0) {
                foreach ($immobiliers as $immobilier) {
                    echo "<option value='" . $immobilier->ID_IMMOBILIER . "'>" . $immobilier->DESCRIPTION_IMMO . "</option>";
                }
            } else {
                echo "<option>-</option>";
            }
        } elseif ($id == 'MOBILIER') {
            $countMobilier = Mobilier::find()
                ->where(['REFERENCE_PATRIMOINE' => $ref])
                ->count();

            $mobiliers = Mobilier::find()
                ->where(['REFERENCE_PATRIMOINE' => $ref])
                ->all();

            if ($countMobilier > 0) {
                foreach ($mobiliers as $mobilier) {
                    echo "<option value='" . $mobilier->ID_MOBILIER . "'>" . $mobilier->DESCRIPTION_MO . "</option>";
                }
            } else {
                echo "<option>-</option>";
            }
        } else {
            echo "<option>-</option>";
        }


    }

    /**
     * Displays a single Valeur model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Valeur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Valeur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Valeur::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Creates a new Valeur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Valeur();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_VALEUR]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Valeur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_VALEUR]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Valeur model.
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
}
