<?php

namespace app\controllers;

use app\models\Action;
use app\models\Classeur;
use app\models\Client;
use app\models\Courrier;
use app\models\Document;
use app\models\Droits;
use app\models\DroitsSearch;
use app\models\Fichier;
use app\models\GrUsager;
use app\models\Traitement;
use app\models\TraitementQuery;
use app\models\TraitementSearch;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Yii;
use app\models\Dossier;
use app\models\DossierSearch;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
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

    /**
     * @throws MpdfException
     */
    public function actionPrint()
    {
        if (isset($_POST['SOURCE'])) {
            $SOURCE = $_POST['SOURCE'];
            $url = Url::to($SOURCE);
            $file = null;
            $file = fopen($url, "r");
            if ($file == null) {
                echo "je suis magnifique";
            } elseif ($file) {
                $file_content = fread($file, filesize($url));
                $mpdf = new Mpdf();
                //$mpdf->title = $modeleObject->NOM_MODELE;
                $mpdf->WriteText(0, 0, Html::encode($file_content));
                //$mpdf->WriteHTML($file_content);
                echo $mpdf->Output();
                //echo $file_content;
            }
        }

    }

    public function actionUpdateTraitement()
    {
        if (isset($_POST['check'], $_POST['libelle_document'])) {
            $check = $_POST['check'];
            $lib = $_POST['libelle_document'];
            $variable = substr($check, 7);
            $typeTraitement = substr($variable, 0, 1); // 1 = en cours 2= terminé
            $typeTraitement = intval($typeTraitement) - 1;
            $idTraitement = substr($variable, 2);
            $idTraitement = intval($idTraitement) - 1;

            $id_dossier = Dossier::findOne(['LIBELLE_DOSSIER' => $lib])->ID_DOSSIER;
            $traitements = new TraitementSearch();
            $result = $traitements->searchBYDossier($id_dossier);
            $taille = count($result);

            for ($i = 0; $i < $taille; $i++) {
                if ($i == $idTraitement) {
                    $modelTraitement = new Traitement();
                    $modelTraitement->ID_DOSSIER = $result[$idTraitement]['ID_DOSSIER'];
                    $modelTraitement->ID_LT = $result[$idTraitement]['ID_LT'];
                    $modelTraitement->ID_TRAITEMENT = $result[$idTraitement]['ID_TRAITEMENT'];
                    $modelTraitement->ETAT_TRAITEMENT = $typeTraitement;
                    $modelTraitement->COMMENTAIRE_TRAITEMENT = $result[$idTraitement]['COMMENTAIRE_TRAITEMENT'];
                    $modelTraitement->DATE_DEBUT = $result[$idTraitement]['DATE_DEBUT'];
                    $modelTraitement->DATE_FIN = $result[$idTraitement]['DATE_FIN'];
                    $modelTraitement->DATE_PREVUE = $result[$idTraitement]['DATE_PREVUE'];

                    $mT = Traitement::findOne(['ID_DOSSIER' => $modelTraitement->ID_DOSSIER, 'ID_LT' => $modelTraitement->ID_LT, 'ID_TRAITEMENT' => $modelTraitement->ID_TRAITEMENT, 'COMMENTAIRE_TRAITEMENT' => $modelTraitement->COMMENTAIRE_TRAITEMENT, 'DATE_DEBUT' => $modelTraitement->DATE_DEBUT, 'DATE_FIN' => $modelTraitement->DATE_FIN, 'DATE_PREVUE' => $modelTraitement->DATE_PREVUE]);
                    $mT->ETAT_TRAITEMENT = $modelTraitement->ETAT_TRAITEMENT;
                    $mT->save();
                }
            }

            $all_count = $traitements->getCountTraitementByDossier($result[$idTraitement]['ID_DOSSIER']);
            $valid_count = $traitements->getCountValidTraitementByDossier($result[$idTraitement]['ID_DOSSIER']);

            $all_count = intval($all_count);
            $valid_count = intval($valid_count);

            $return_var = $valid_count / $all_count;

            echo $return_var;
            // echo Json::encode($result);
        }
    }

    public function actionGetDossierClick($libelle_document)
    {
        $url = Url::to(['dossier/edit', 'libelle_document' => $libelle_document]);
        //return $this->redirect('edit?libelle_document=' . $libelle_document);
        return $this->redirect($url);
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

        if ($model->load(Yii::$app->request->post())) {
            $model->ID_PERSONNE = Client::findOne(['ID_CLIENT' => $model->ID_CLIENT])->ID_PERSONNE;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->ID_DOSSIER]);
            } else {
                if ($model->hasErrors()) {
                    var_dump($model->getErrors());
                    die();
                }
            }
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
            $model->ID_PERSONNE = Client::findOne(['ID_CLIENT' => $model->ID_CLIENT])->ID_PERSONNE;
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
