<?php

namespace app\controllers;

use app\models\Action;
use app\models\SysParam;
use Yii;
use app\models\Document;
use app\models\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
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
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Document::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();

        if ($model->load(Yii::$app->request->post())) {
            if (!is_null($model->file = UploadedFile::getInstance($model,'file'))){
                $model->DATE_EFFECTIVE = date("Y-m-d");
                $upload_dir = SysParam::findOne('UPLOADS_DIR_NAME');
                $doc_dir = SysParam::findOne('DOCUMENTS_DIR_NAME');
                $source =  $upload_dir->PARAM_VALUE.'/'.$doc_dir->PARAM_VALUE.'/'.str_replace(' ', '_',$model->TITRE_DOC ).'_'.$model->DATE_EFFECTIVE.'.'.$model->file->extension;
                $model->SOURCE = $source;
                $model->CREATEUR = Yii::$app->user->identity->USERNAME;
                $model->file->saveAs($source);
                $model->save();
                return $this->redirect(['view', 'id' => $model->ID_DOC]);
            }else{
                Yii::$app->session->setFlash('failed', 'Une erreur s\'est produite. Veuillez réessayer en prenant soin d\'ajouter un document');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!is_null($model->file = UploadedFile::getInstance($model,'file'))){
                $model->DATE_EFFECTIVE = date("Y-m-d");
                $upload_dir = SysParam::findOne('UPLOADS_DIR_NAME');
                $doc_dir = SysParam::findOne('DOCUMENTS_DIR_NAME');
                $source =  $upload_dir->PARAM_VALUE.'/'.$doc_dir->PARAM_VALUE.'/'.$model->TITRE_DOC.'_'.$model->DATE_EFFECTIVE.'.'.$model->file->extension;
                $model->SOURCE = $source;
                $model->CREATEUR = Yii::$app->user->identity->USERNAME;
                $model->file->saveAs($source);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID_DOC]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Document model.
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
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
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
