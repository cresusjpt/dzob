<?php

namespace app\controllers;

use app\models\Resources;
use app\models\SysParam;
use Yii;
use app\models\Finance;
use app\models\FinanceSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FinanceController implements the CRUD actions for Finance model.
 */
class FinanceController extends Controller
{

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
     * Lists all Finance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FinanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Finance model.
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
     * Finds the Finance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Finance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Finance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La page que vous demandez n\'existe pas.'));
    }

    /**
     * Creates a new Finance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Finance();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->NATURE_FINANCE == 'ENTREE') {
                $imageFile = UploadedFile::getInstance($model, 'file');
                $directory = SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('RESOURCE_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                    //73283326372472596128
                }

                if ($imageFile) {
                    $time = time();
                    $fileName = str_replace(' ', '_', $model->REFERENCE_PATRIMOINE) . str_replace(' ', '_', $model->DATE_FINANCE) . $time . '.' . $imageFile->extension;
                    $filePath = $directory . $fileName;
                    if ($imageFile->saveAs($filePath)) {
                        $model->RESSOURCE = $filePath;
                    }
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID_FINANCE]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Finance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->NATURE_FINANCE == 'ENTREE') {
                $imageFile = UploadedFile::getInstance($model, 'file');
                $directory = SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('RESOURCE_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                }

                if ($imageFile) {
                    $time = time();
                    $fileName = str_replace(' ', '_', $model->REFERENCE_PATRIMOINE) . str_replace(' ', '_', $model->DATE_FINANCE) . $time . '.' . $imageFile->extension;
                    $filePath = $directory . $fileName;
                    if ($imageFile->saveAs($filePath)) {
                        $model->RESSOURCE = $filePath;
                    }
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID_FINANCE]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Finance model.
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
