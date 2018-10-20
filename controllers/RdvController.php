<?php

namespace app\controllers;

use Yii;
use app\models\Rdv;
use app\models\RdvSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2fullcalendar\yii2fullcalendar;

/**
 * RdvController implements the CRUD actions for Rdv model.
 */
class RdvController extends Controller
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
     * Lists all Rdv models.
     * @return mixed
     */
    public function actionIndex()
    {

        $rdv = Rdv::find()->all();
        $finalRdv = [];
        foreach ($rdv as $oneRdv) {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $oneRdv->ID_RDV;
            $event->title = $oneRdv->NOM;
            $event->start = $oneRdv->DATE_RDV;
            $finalRdv[] = $event;
        }

        return $this->render('index', [
            'events' => $finalRdv,
        ]);
    }

    /**
     * Displays a single Rdv model.
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
     * Finds the Rdv model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rdv the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rdv::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Creates a new Rdv model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rdv();

        if ($model->load(Yii::$app->request->post())) {
            $model->DATE_PRISE = date('Y-m-d');
            $model->save();
            if (!$model->hasErrors()) {
                return $this->redirect(['view', 'id' => $model->ID_RDV]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rdv model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->DATE_PRISE = date('Y-m-d');
            $model->save();
            if (!$model->hasErrors()) {
                return $this->redirect(['view', 'id' => $model->ID_RDV]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rdv model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
