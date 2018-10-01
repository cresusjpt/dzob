<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 28/08/2018
 * Time: 10:22
 */
namespace app\controllers;

use app\models\Immobilier;
use yii\web\Controller;

class PanoramaController extends Controller{

    public function actionIndex(){

        $model = Immobilier::find()->all();
        return $this->render('_form', ['model' => $model]);
    }
}