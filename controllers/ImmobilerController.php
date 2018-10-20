<?php

namespace app\controllers;

use app\models\Action;
use app\models\AyantDroit;
use app\models\SysParam;
use Yii;
use app\models\Immobilier;
use app\models\ImmobilierSearch;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImmobilerController implements the CRUD actions for Immobilier model.
 */
class ImmobilerController extends Controller
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
     * Lists all Immobilier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImmobilierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Immobilier model.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        $model = $this->findModel($REFERENCE_PATRIMOINE,$ID_IMMOBILIER);
        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Immobilier::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Immobilier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Immobilier();

        if ($model->load(Yii::$app->request->post())) {
            $imageFile = UploadedFile::getInstance($model, 'file');
            $directory = SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('RESOURCE_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
            if (!is_dir($directory)) {
                FileHelper::createDirectory($directory);
            }
            if ($imageFile) {
                $time = time();
                $fileName = str_replace(' ', '_', $model->DESCRIPTION_IMMO) . str_replace(' ', '_', $model->REFERENCE_PATRIMOINE) . $time . '.' . $imageFile->extension;
                $filePath = $directory . $fileName;
                if ($imageFile->saveAs($filePath)) {
                    $model->RESSOURCE = $filePath;
                }
            }
            $model->ID_PERSONNE = AyantDroit::findOne(['ID_AYANTDROIT'=>$model->ID_AYANTDROIT])->ID_PERSONNE;
            $model->save();
            return $this->redirect(['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $model->ID_IMMOBILIER]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Immobilier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return mixed
     * @throws Exception
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        $model = $this->findModel($REFERENCE_PATRIMOINE, $ID_IMMOBILIER);

        if ($model->load(Yii::$app->request->post())) {
            $imageFile = UploadedFile::getInstance($model, 'file');
            $directory = SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('RESOURCE_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
            if (!is_dir($directory)) {
                FileHelper::createDirectory($directory);
            }
            if ($imageFile) {
                $time = time();
                $fileName = str_replace(' ', '_', $model->DESCRIPTION_IMMO) . str_replace(' ', '_', $model->REFERENCE_PATRIMOINE) . $time . '.' . $imageFile->extension;
                $filePath = $directory . $fileName;
                if ($imageFile->saveAs($filePath)) {
                    $model->RESSOURCE = $filePath;
                }
            }
            $model->ID_PERSONNE = AyantDroit::findOne(['ID_AYANTDROIT'=>$model->ID_AYANTDROIT])->ID_PERSONNE;
            $model->save();
            return $this->redirect(['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $model->ID_IMMOBILIER]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Immobilier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        $this->findModel($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Immobilier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $REFERENCE_PATRIMOINE
     * @param integer $ID_IMMOBILIER
     * @return Immobilier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($REFERENCE_PATRIMOINE, $ID_IMMOBILIER)
    {
        if (($model = Immobilier::findOne(['REFERENCE_PATRIMOINE' => $REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $ID_IMMOBILIER])) !== null) {
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
