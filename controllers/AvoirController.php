<?php

namespace app\controllers;

use app\models\AyantDroit;
use Mpdf\Mpdf;
use Yii;
use app\models\Avoir;
use app\models\AvoirSearch;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvoirController implements the CRUD actions for Avoir model.
 */
class AvoirController extends Controller
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
     * Lists all Avoir models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AvoirSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avoir model.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @param string $REFERENCE_PATRIMOINE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_PERSONNE, $ID_AYANTDROIT, $REFERENCE_PATRIMOINE)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_PERSONNE, $ID_AYANTDROIT, $REFERENCE_PATRIMOINE),
        ]);
    }

    /**
     * Finds the Avoir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @param string $REFERENCE_PATRIMOINE
     * @return Avoir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_PERSONNE, $ID_AYANTDROIT, $REFERENCE_PATRIMOINE)
    {
        if (($model = Avoir::findOne(['ID_PERSONNE' => $ID_PERSONNE, 'ID_AYANTDROIT' => $ID_AYANTDROIT, 'REFERENCE_PATRIMOINE' => $REFERENCE_PATRIMOINE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Creates a new Avoir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Avoir();

        if ($model->load(Yii::$app->request->post())) {
            $count = count($model->ID_AYANTDROIT);
            $last_idPersonne = 0;
            $last_idAyantDroit = 0;
            for ($i = 0; $i < $count; $i++) {
                $oneAvoir = new Avoir();
                $oneAvoir->ID_AYANTDROIT = $model->ID_AYANTDROIT[$i];
                $oneAvoir->REFERENCE_PATRIMOINE = $model->REFERENCE_PATRIMOINE;
                $oneAvoir->ID_PERSONNE = AyantDroit::findOne(['ID_AYANTDROIT' => $oneAvoir->ID_AYANTDROIT])->ID_PERSONNE;
                $oneAvoir->save();
                $last_idPersonne = $oneAvoir->ID_PERSONNE;
                $last_idAyantDroit = $oneAvoir->ID_AYANTDROIT;

                //echo Json::encode($oneAvoir);

                //echo Jso ($oneAvoir);
                //die();
            }

            return $this->redirect(['view', 'ID_PERSONNE' => $last_idPersonne, 'ID_AYANTDROIT' => $last_idAyantDroit, 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Avoir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @param string $REFERENCE_PATRIMOINE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_PERSONNE, $ID_AYANTDROIT, $REFERENCE_PATRIMOINE)
    {
        $model = $this->findModel($ID_PERSONNE, $ID_AYANTDROIT, $REFERENCE_PATRIMOINE);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT, 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Avoir model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_PERSONNE
     * @param integer $ID_AYANTDROIT
     * @param string $REFERENCE_PATRIMOINE
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID_PERSONNE, $ID_AYANTDROIT, $REFERENCE_PATRIMOINE)
    {
        $this->findModel($ID_PERSONNE, $ID_AYANTDROIT, $REFERENCE_PATRIMOINE)->delete();

        return $this->redirect(['index']);
    }
}
