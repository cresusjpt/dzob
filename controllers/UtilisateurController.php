<?php

namespace app\controllers;

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
    public function actionView($ID_PERSONNE, $IDENTIFIANT)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_PERSONNE, $IDENTIFIANT),
        ]);
    }

    /**
     * Creates a new Utilisateur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Utilisateur();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT]);
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
     */
    public function actionUpdate($ID_PERSONNE, $IDENTIFIANT)
    {
        $model = $this->findModel($ID_PERSONNE, $IDENTIFIANT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT]);
        }

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
     */
    public function actionDelete($ID_PERSONNE, $IDENTIFIANT)
    {
        $this->findModel($ID_PERSONNE, $IDENTIFIANT)->delete();

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
}
