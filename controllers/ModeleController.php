<?php

namespace app\controllers;

use app\models\Action;
use app\models\DynamicModel;
use app\models\ModelParam;
use app\models\SysParam;
use Exception;
use Mpdf\Mpdf;
use Yii;
use app\models\Modele;
use app\models\ModeleSearch;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModeleController implements the CRUD actions for Modele model.
 */
class ModeleController extends Controller
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
     * Lists all Modele models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModeleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Modele model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $action = Action::findOne('SELECT');
        $this->_user_actions = $action->CODE_ACTION;
        $this->_tablename = Modele::tableName();
        $this->_models = $model;
        $this->_logging = true;
        $this->logger();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Modele model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new Modele();
        $modelParam = [new ModelParam];

        if ($model->load(Yii::$app->request->post())) {
            $modelParam = DynamicModel::createMultiple(ModelParam::class);
            DynamicModel::loadMultiple($modelParam, Yii::$app->request->post());

            $model->NB_PARAMETRE = count($modelParam);

            // validate all models
            $valid = $model->validate();
            $valid = DynamicModel::validateMultiple($modelParam) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelParam as $oneParam) {
                            $oneParam->ID_MODELE = $model->ID_MODELE;
                            if (!($flag = $oneParam->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->ID_MODELE]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelParam' => (empty($modelParam)) ? [new ModelParam()] : $modelParam,
        ]);
    }

    /**
     * Updates an existing Modele model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelParam = ModelParam::findAll(['ID_MODELE' => $id]);

        if ($model->load(Yii::$app->request->post())) {

            ModelParam::deleteAll(['ID_MODELE' => $model->ID_MODELE]);
            $oldIDs = ArrayHelper::map($modelParam, 'ID_MODELE', 'ID_MODELE');
            $modelParam = DynamicModel::createMultiple(ModelParam::class);
            DynamicModel::loadMultiple($modelParam, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelParam, 'ID_MODELE', 'ID_MODELE')));
            $model->NB_PARAMETRE = count($modelParam);

            // validate all models
            $valid = $model->validate();
            $valid = DynamicModel::validateMultiple($modelParam) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            ModelParam::deleteAll(['ID_MODELE' => $model->ID_MODELE]);
                        }
                        foreach ($modelParam as $oneParam) {
                            $oneParam->ID_MODELE = $model->ID_MODELE;
                            if (!($flag = $oneParam->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->ID_MODELE]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelParam' => (empty($modelParam)) ? [new ModelParam()] : $modelParam,

        ]);
    }

    /**
     * Deletes an existing Modele model.
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
        ModelParam::deleteAll(['ID_MODELE' => $id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Modele model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Modele the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Modele::findOne($id)) !== null) {
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

    /**
     * @param int $modele
     * @return string|\yii\web\Response
     * @throws \Mpdf\MpdfException
     */
    public function actionGenerer($modele = 0)
    {
        $modelModel = Modele::find()->all();
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }
        if ($modele != 0) {
            $modeleObject = Modele::findOne($modele);
            $modelParam = ModelParam::find()->where(['ID_MODELE' => $modeleObject->ID_MODELE])->orderBy('ORDRE ASC')->all();
            //echo Json::encode($modelParam);
            if (isset($_POST) && !empty($_POST)) {
                $value = 'param_value';
                $param = SysParam::findOne('MODELE_VARIABLE')->PARAM_VALUE;
                $result = [];
                $contenu = $modeleObject->CONTENU_MODELE;
                for ($i = 0; $i < $modeleObject->NB_PARAMETRE; $i++) {
                    $real = $i + 1;
                    array_push($result, array($param . $i => $_POST[$value . $i]));
                    $contenu = str_replace($param . $real, $_POST[$value . $i], $contenu);
                }
                //find another process
                $mpdf = new Mpdf();
                $mpdf->title = $modeleObject->NOM_MODELE;
                $mpdf->WriteHTML($contenu);
                $mpdf->Output();
            }
            return $this->render('_generer', [
                    'model' => $modeleObject,
                    'modelParam' => $modelParam,
                ]
            );
        }

        return $this->render('generer', [
            'model' => $modelModel,
        ]);
    }
}
