<?php

namespace backend\controllers;

use backend\models\Consultation;
use backend\models\Detaileffectuerconsultation;
use backend\models\Historique;
use backend\models\Patient;
use Yii;
use backend\models\Effectuerconsultation;
use backend\models\EffectuerconsultationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EffectuerconsultationController implements the CRUD actions for Effectuerconsultation model.
 */
class EffectuerconsultationController extends Controller
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
     * Lists all Effectuerconsultation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EffectuerconsultationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Effectuerconsultation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $listeDetailConsultation = Yii:: $app->db->createCommand("SELECT consultation.libconsultation,detaileffectuerconsultation.fraisconsultation,detaileffectuerconsultation.coutconsultation,detaileffectuerconsultation.coutassurance, detaileffectuerconsultation.tauxreductionassurance FROM detaileffectuerconsultation, consultation WHERE detaileffectuerconsultation.idconsultation = consultation.idconsultation AND detaileffectuerconsultation.ideffectuerconsul=$id ")->query();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'listeDetailConsultation' => $listeDetailConsultation,
        ]);
    }

    /**
     * Finds the Effectuerconsultation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Effectuerconsultation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Effectuerconsultation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Effectuerconsultation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Effectuerconsultation();

        if ($model->load(Yii::$app->request->post())) {

            $model->ideffectuerconsul = $model->count() + 1;
            $model->dateconsultation = date('Y-m-d H:i:s');
            if ($_POST['Effectuerconsultation']['echeance'] != null)
                $model->echeance = date_format(date_create($_POST['Effectuerconsultation']['echeance']), 'Y-m-d');
            else
                $model->echeance = '0000-00-00';
            $model->payer = 0;

            //var_dump($model);

            if ($model->save()) {

                //$listedetailDonneSoins[] = new Detaildonnesoins();
                $nbrelignedetail = count($_POST['consultations']);
                for ($i = 0; $i < $nbrelignedetail; $i++) {
                    $detailEffectuerConsultation = new Detaileffectuerconsultation();
                    $detailEffectuerConsultation->idconsultation = $_POST['consultations'][$i];
                    $detailEffectuerConsultation->ideffectuerconsul = $model->ideffectuerconsul;

                    $infoconsultation = Consultation::find()
                        ->where(['idconsultation' => $detailEffectuerConsultation->idconsultation])
                        ->one();

                    $infopatient = Patient::find()
                        ->where(['idpatient' => $model->idpatient])
                        ->one();

                    $detailEffectuerConsultation->tauxreductionassurance = $infopatient->tauxassu;
                    $detailEffectuerConsultation->coutconsultation = $infoconsultation->coutconsultation - ($infoconsultation->coutconsultation * $detailEffectuerConsultation->tauxreductionassurance / 100);
                    $detailEffectuerConsultation->coutassurance = $infoconsultation->coutconsultation * $detailEffectuerConsultation->tauxreductionassurance / 100;
                    $detailEffectuerConsultation->fraisconsultation = $infoconsultation->coutconsultation;

//                     Yii:: $app->db->createCommand("DELETE FROM `detaildonnesoins` WHERE iddonnesoins=$model->idDonneconsultation  and idsoins=$detailEffectuerConsultation->idsoins")->query();

                    $detailEffectuerConsultation->save();

//                    var_dump($detailEffectuerConsultation);
                }

                $historique = new Historique();
                $historique->idhistorique = $historique->count() + 1;
                $historique->iduser = Yii::$app->user->id;
                $historique->action = 'Create';
                $historique->model = 'Effectuerconsultation';
                $historique->date = date('Y-m-j H:i:s');
                $historique->description = Yii::$app->user->identity->username . ' a enregistré la consultation N°' . $model->ideffectuerconsul . ' du patient N° ' . $model->idpatient;
                $historique->save();

                return $this->redirect(['view', 'id' => $model->ideffectuerconsul]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'consultations' => Consultation::find()->all(),
            ]);
        }
    }

    /**
     * Updates an existing Effectuerconsultation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            //$model->dateconsultation = date( 'Y-m-d');
            if ($_POST['Effectuerconsultation']['echeance'] != null)
                $model->echeance = date_format(date_create($_POST['Effectuerconsultation']['echeance']), 'Y-m-d');
            else
                $model->echeance = '0000-00-00';

            if ($model->save()) {

                $lignesDetail = Yii:: $app->db->createCommand("DELETE FROM `detaileffectuerconsultation` WHERE ideffectuerconsul=$model->ideffectuerconsul ")->query();

                $nbrelignedetail = count($_POST['consultations']);
                for ($i = 0; $i < $nbrelignedetail; $i++) {
                    $detailEffectuerConsultation = new Detaileffectuerconsultation();
                    $detailEffectuerConsultation->idconsultation = $_POST['consultations'][$i];
                    $detailEffectuerConsultation->ideffectuerconsul = $model->ideffectuerconsul;

                    $infoconsultation = Consultation::find()
                        ->where(['idconsultation' => $detailEffectuerConsultation->idconsultation])
                        ->one();

                    $infopatient = Patient::find()
                        ->where(['idpatient' => $model->idpatient])
                        ->one();

                    $detailEffectuerConsultation->tauxreductionassurance = $infopatient->tauxassu;
                    $detailEffectuerConsultation->coutconsultation = $infoconsultation->coutconsultation - ($infoconsultation->coutconsultation * $detailEffectuerConsultation->tauxreductionassurance / 100);
                    $detailEffectuerConsultation->coutassurance = $infoconsultation->coutconsultation * $detailEffectuerConsultation->tauxreductionassurance / 100;
                    $detailEffectuerConsultation->fraisconsultation = $infoconsultation->coutconsultation;

                    $detailEffectuerConsultation->save();
                }
                //var_dump( $detailEffectuerConsultation->tauxreductionassurance);exit;

                $historique = new Historique();
                $historique->idhistorique = $historique->count() + 1;
                $historique->iduser = Yii::$app->user->id;
                $historique->action = 'Update effectuerconsultation';
                $historique->date = date('Y-m-j H:i:s');
                $historique->description = Yii::$app->user->identity->username . ' a modifié la consultation N°' . $model->ideffectuerconsul . ' du patient N° ' . $model->idpatient;
                $historique->save();
                return $this->redirect(['view', 'id' => $model->ideffectuerconsul]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'consultations' => Consultation::find()->all(),
                'detailConsultations' => Detaileffectuerconsultation::find()->where(['ideffectuerconsul' => $model->ideffectuerconsul])->all(),

            ]);
        }
    }

    /**
     * Deletes an existing Effectuerconsultation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $lignesDetail = Yii:: $app->db->createCommand("DELETE FROM `detaileffectuerconsultation` WHERE ideffectuerconsul=$id ")->query();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPrint($ideffectuerconsul, $idpatient)
    {
        return $this->renderPartial('print', [
            'model' => $this->findModel($ideffectuerconsul, $idpatient),
        ]);
    }
}
