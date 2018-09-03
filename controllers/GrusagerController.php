<?php

namespace app\controllers;

use app\models\Utilisateur;
use Yii;
use app\models\GrUsager;
use app\models\GrUsagerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GrusagerController implements the CRUD actions for GrUsager model.
 */
class GrusagerController extends Controller
{
    public $_user_actions;
    public $_tablename;
    public $_models;
    public $_logging;

    /**
     * {@inheritdoc}
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
     * Lists all GrUsager models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrUsagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GrUsager model.
     * @param integer $ID_DROITS
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @param integer $ID_DOSSIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_DROITS, $ID_PERSONNE, $IDENTIFIANT, $ID_DOSSIER)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_DROITS, $ID_PERSONNE, $IDENTIFIANT, $ID_DOSSIER),
        ]);
    }

    /**
     * Creates a new GrUsager model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GrUsager();

        if ($model->load(Yii::$app->request->post())) {
            $count = count($model->IDENTIFIANT);
            $last_idPersonne = 0;
            $last_identifiant = 0;
            for ($i = 0; $i < $count; $i++) {
                $oneGrUsager = new GrUsager();
                $oneGrUsager->ID_DROITS = $model->ID_DROITS;
                $oneGrUsager->ID_DOSSIER = $model->ID_DOSSIER;
                $oneGrUsager->GR_LIBELLE = $model->GR_LIBELLE;
                $oneGrUsager->GR_DESCRIPTION = $model->GR_DESCRIPTION;
                $oneGrUsager->IDENTIFIANT = $model->IDENTIFIANT[$i];
                $oneGrUsager->ID_PERSONNE = Utilisateur::findOne(['IDENTIFIANT' => $oneGrUsager->IDENTIFIANT])->ID_PERSONNE;
                $last_idPersonne = $oneGrUsager->ID_PERSONNE;
                $last_identifiant = $oneGrUsager->IDENTIFIANT;
                $oneGrUsager->save();
            }
            return $this->redirect(['view', 'ID_DROITS' => $model->ID_DROITS, 'ID_PERSONNE' => $last_idPersonne, 'IDENTIFIANT' => $last_identifiant, 'ID_DOSSIER' => $model->ID_DOSSIER]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GrUsager model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_DROITS
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @param integer $ID_DOSSIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_DROITS, $ID_PERSONNE, $IDENTIFIANT, $ID_DOSSIER)
    {
        $model = $this->findModel($ID_DROITS, $ID_PERSONNE, $IDENTIFIANT, $ID_DOSSIER);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_DROITS' => $model->ID_DROITS, 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_DOSSIER' => $model->ID_DOSSIER]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GrUsager model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_DROITS
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @param integer $ID_DOSSIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($ID_DROITS, $ID_PERSONNE, $IDENTIFIANT, $ID_DOSSIER)
    {
        $this->findModel($ID_DROITS, $ID_PERSONNE, $IDENTIFIANT, $ID_DOSSIER)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GrUsager model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_DROITS
     * @param integer $ID_PERSONNE
     * @param integer $IDENTIFIANT
     * @param integer $ID_DOSSIER
     * @return GrUsager the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_DROITS, $ID_PERSONNE, $IDENTIFIANT, $ID_DOSSIER)
    {
        if (($model = GrUsager::findOne(['ID_DROITS' => $ID_DROITS, 'ID_PERSONNE' => $ID_PERSONNE, 'IDENTIFIANT' => $IDENTIFIANT, 'ID_DOSSIER' => $ID_DOSSIER])) !== null) {
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
