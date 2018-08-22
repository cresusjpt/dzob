<?php

namespace app\controllers;

use app\models\Menu;
use app\models\Profil;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 21/08/2018
 * Time: 17:57
 */

class GestdaController extends Controller{


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

    public function actionIndex(){

        $modelProfil = new Profil();
        $modelMenu = new Menu();
        return $this->render('index',['modelsMenu'=>$modelMenu,'modelsProfil'=>$modelProfil]);
    }
}