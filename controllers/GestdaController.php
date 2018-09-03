<?php

namespace app\controllers;

use app\models\Menu;
use app\models\Profil;
use app\models\Utilisateur;
use kartik\builder\TabularForm;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 21/08/2018
 * Time: 17:57
 */
class GestdaController extends Controller
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

    public function actionIndex()
    {
        //$model = GestdaController::getFormAttribs();
        $modelUser =new Utilisateur();
        $modelProfil = new Profil();
        $modelMenu = new Menu();
        return $this->render('index', ['modelUser'=>$modelUser,'modelsMenu' => $modelMenu, 'modelsProfil' => $modelProfil]);
    }

    public function getFormAttribs(){
        return [
            'ID_FONCT'=>[
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'NAME_FONCT'=>['type'=>TabularForm::INPUT_TEXT],
            'LIBEL_FONCT'=>['type'=>TabularForm::INPUT_TEXT],
            'DESCRIPTION_FONCT'=>['type'=>TabularForm::INPUT_TEXTAREA],

        ];
    }
}