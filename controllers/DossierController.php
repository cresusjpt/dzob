<?php

namespace app\controllers;

use app\models\Action;
use app\models\Classeur;
use app\models\Courrier;
use app\models\Document;
use app\models\Droits;
use app\models\DroitsSearch;
use app\models\Fichier;
use app\models\GrUsager;
use app\models\Traitement;
use app\models\TraitementQuery;
use app\models\TraitementSearch;
use Yii;
use app\models\Dossier;
use app\models\DossierSearch;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DossierController implements the CRUD actions for Dossier model.
 */
class DossierController extends Controller
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
     * Lists all Dossier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DossierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $libelle_document
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionEdit($libelle_document)
    {

        $modelDocument = Document::findOne(['TITRE_DOC' => $libelle_document]);
        $droits = new DroitsSearch();
        $droits = $droits->searchBYDOCAndIDENTIFIANT(Yii::$app->user->identity->IDENTIFIANT, $modelDocument->ID_DOC);
        $droits = Json::encode($droits);
        return $this->render('edit', [
            'modelDocument' => $modelDocument,
            'modelDroit' => $droits,
        ]);
    }

    public function actionGetDossierClick($libelle_document)
    {
        return $this->redirect('edit?libelle_document=' . $libelle_document);
    }

    /**
     * Finds the Traitement relative to selected Dossier
     * If the find is successful the browser will bind table body
     * @param integer $id_dossier
     *
     */
    public function actionGetTraitement($libelle_dossier)
    {
        // find the fonctionnality from the menu

        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Dossier::tableName();
        //$this->_models = $model;
        $this->_logging = true;
        $this->logger();

        $id_dossier = Dossier::findOne(['LIBELLE_DOSSIER' => $libelle_dossier])->ID_DOSSIER;
        $traitements = new TraitementSearch();
        $result = $traitements->searchBYDossier($id_dossier);
        echo Json::encode($result);
    }

    /**
     * Lists all Dossier models.
     * @return mixed
     */
    public function actionDossier()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }

        $modelClasseur = Classeur::find()->all();
        $modelDossier = Dossier::find()->all();
        $modelDocument = Document::find()->all();
        $modelGrUsager = GrUsager::find()->where(['IDENTIFIANT' => Yii::$app->user->identity->IDENTIFIANT])->all();

        return $this->render('dossier', [
            'modelClasseur' => $modelClasseur,
            'modelDossier' => $modelDossier,
            'modelDocument' => $modelDocument,
            'modelGrUsager' => $modelGrUsager,
        ]);
    }

    /**
     * Displays a single Dossier model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Dossier::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Dossier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dossier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_DOSSIER]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dossier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->DATE_DMDOSSIER = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID_DOSSIER]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dossier model.
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
     * Finds the Dossier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dossier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dossier::findOne(['ID_DOSSIER' => $id])) !== null) {
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
