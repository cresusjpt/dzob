<?php

namespace app\controllers;

use app\models\FinanceSearch;
use app\models\Frais;
use app\models\FraisSearch;
use Yii;

class RecheditController extends \yii\web\Controller
{
    public function actionReglement()
    {
        $model = new Frais();
        $searchModel = new FraisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reglement', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
