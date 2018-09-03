<?php

namespace app\controllers;

use app\models\TraitementExtendModel;
use Exception;
use Yii;
use app\models\Traitement;
use app\models\TraitementSearch;
use yii\helpers\ArrayHelper;
use yii\validators\Validator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * TraitementController implements the CRUD actions for Traitement model.
 */
class TraitementController extends Controller
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
     * Lists all Traitement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TraitementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Traitement model.
     * @param integer $ID_DOSSIER
     * @param integer $ID_LT
     * @param integer $ID_TRAITEMENT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_DOSSIER, $ID_LT, $ID_TRAITEMENT)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_DOSSIER, $ID_LT, $ID_TRAITEMENT),
        ]);
    }

    /**
     * Creates a new Traitement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\db\Exception
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new Traitement();
        $modelT = [new Traitement()];

        if ($model->load(Yii::$app->request->post())) {

            $modelT = TraitementExtendModel::createMultiple(Traitement::class);
            TraitementExtendModel::loadMultiple($modelT, Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple($modelT);
            }


            $valid = TraitementExtendModel::validateMultiple($modelT);
            //var_dump($valid);
            //die();

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = !empty($model->ID_DOSSIER)) {
                        foreach ($modelT as $modelTraitement) {

                            $modelTraitement->ID_DOSSIER = $model->ID_DOSSIER;

                            if (!($flag = $modelTraitement->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    //throw $e;
                }
            }else{
                echo "erreur";
                //var_dump($model->errors);
                foreach ($modelT as $m){
                    var_dump($m->errors);
                }
                die();
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelT' => (empty($modelT)) ? [new Traitement()] : $modelT
        ]);
    }

    /**
     * Updates an existing Traitement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_DOSSIER
     * @param integer $ID_LT
     * @param integer $ID_TRAITEMENT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_DOSSIER, $ID_LT, $ID_TRAITEMENT)
    {
        $model = $this->findModel($ID_DOSSIER, $ID_LT, $ID_TRAITEMENT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_DOSSIER' => $model->ID_DOSSIER, 'ID_LT' => $model->ID_LT, 'ID_TRAITEMENT' => $model->ID_TRAITEMENT]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Traitement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_DOSSIER
     * @param integer $ID_LT
     * @param integer $ID_TRAITEMENT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($ID_DOSSIER, $ID_LT, $ID_TRAITEMENT)
    {
        $this->findModel($ID_DOSSIER, $ID_LT, $ID_TRAITEMENT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Traitement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_DOSSIER
     * @param integer $ID_LT
     * @param integer $ID_TRAITEMENT
     * @return Traitement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_DOSSIER, $ID_LT, $ID_TRAITEMENT)
    {
        if (($model = Traitement::findOne(['ID_DOSSIER' => $ID_DOSSIER, 'ID_LT' => $ID_LT, 'ID_TRAITEMENT' => $ID_TRAITEMENT])) !== null) {
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
