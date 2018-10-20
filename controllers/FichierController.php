<?php

namespace app\controllers;

use app\models\Action;
use app\models\SysParam;
use app\models\Utilisateur;
use Throwable;
use Yii;
use app\models\Fichier;
use app\models\FichierSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\StringHelper;

/**
 * FichierController implements the CRUD actions for Fichier model.
 */
class FichierController extends Controller
{
    private $_uploadId = 0;
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
     * Lists all Fichier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FichierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fichier model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Fichier::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \yii\base\InvalidConfigException
     *
     * @throws \yii\base\Exception
     */
    public function actionFile()
    {
        //using $action will perhaps be in confusion with the $action for SysLog Management
        $method = '';

        // action update or create
        if ($this->_uploadId != 0) {
            $model = $this->findModel($this->_uploadId);
        } else {
            $model = new Fichier();
        }
        if (StringHelper::endsWith(Yii::$app->request->getUrl(), 'create')) {
            $method = 'create';
        } else if (StringHelper::endsWith(Yii::$app->request->getUrl(), 'update')) {
            $method = 'update';
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->REFERENCE == null || $model->NOM_FICHIER == null) {
                Yii::$app->session->setFlash('required', 'Tous les champs sont obligatoire');
                return $this->redirect($method, [
                    'model' => $model,
                ]);
            } else {
                $imageFile = UploadedFile::getInstance($model, 'file');
                $directory = SysParam::findOne('UPLOADS_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR . SysParam::findOne('FILE_DIR_NAME')->PARAM_VALUE . DIRECTORY_SEPARATOR;
                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                }
                if ($imageFile) {
                    $time = time() + 1;
                    $fileName = str_replace(' ', '_', $model->NOM_FICHIER) . $time . '.' . $imageFile->extension;
                    $filePath = $directory . $fileName;
                    if ($imageFile->saveAs($filePath)) {
                        $model->FORMAT_FICHIER = $imageFile->extension;
                        $model->DATE_EFFECTIVE = date('Y-m-d');
                        $model->CREATEUR = Yii::$app->user->identity->USERNAME;
                        $model->SOURCE = $filePath;
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->ID_FICHIER]);
                    }
                }
            }
        }
        return $this->render($method, [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Fichier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionCreate(Fichier $model = null)
    {
        $model = new Fichier();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fichier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->_uploadId = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID_FICHIER]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fichier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Fichier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fichier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fichier::findOne($id)) !== null) {
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
