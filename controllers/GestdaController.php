<?php

namespace app\controllers;

use app\models\FonctionProfil;
use app\models\FonctionUser;
use app\models\Menu;
use app\models\Profil;
use app\models\UserProfil;
use app\models\Utilisateur;
use function GuzzleHttp\Promise\all;
use kartik\builder\TabularForm;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        $modelUser = new Utilisateur();
        $modelProfil = new Profil();
        $modelMenu = new Menu();
        if (isset($_POST) && !empty($_POST)) {
            var_dump($_POST);
            die();
        }
        return $this->render('index', ['modelUser' => $modelUser, 'modelsMenu' => $modelMenu, 'modelsProfil' => $modelProfil]);
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionFonctionProfil()
    {
        //$fonct = "{2:2,3:2,4:2,5:2,6:2,7:2,8:2,9:2,29:2}";
        //$profil = "ADMIN";
        //$code_profil = $profil;
        //$model = Json::decode($fonct);//key = ID_FONCT value = ID_MENU
        //$model = ["2" => "2", "3" => "2", "4" => "2", "5" => "2", "6" => "2", "7" => "2", "8" => "2", "9" => 2, "29" => "2"];

        if (isset($_POST) && !empty($_POST['FONCT']) && !empty($_POST['PROFIL'])) {
            $code_profil = $_POST['PROFIL'];
            $model = Json::decode($_POST['FONCT']);//key = ID_FONCT value = ID_MENU

            $menu = 0;
            foreach ($model as $key => $value) {
                $menu = $value;
                //exit;
            }

            $previousFonctPro = $this->getPreviousProfileUserByMenu($menu);
            if (count($previousFonctPro) != 0) {
                foreach ($previousFonctPro as $oneprevFP) {
                    if (!array_key_exists($oneprevFP['ID_FONCT'], $model)) {
                        FonctionProfil::deleteAll(['CODE_PROFIL' => $oneprevFP['CODE_PROFIL'], 'ID_FONCT' => $oneprevFP['ID_FONCT']]);
                    }
                }
            }

            foreach ($model as $key => $value) {
                $fonction_profil = new FonctionProfil();
                $fonction_profil->CODE_PROFIL = $code_profil;
                $fonction_profil->ID_FONCT = $key;
                $fonction_profil->save();
            }

            $profileUser = $this->getProfileUser($code_profil);
            foreach ($profileUser as $onePU) {
                foreach ($model as $key => $value) {
                    if (!FonctionUser::find()->where(['IDPERSONNE' => $onePU['ID_PERSONNE'], 'IDENTIFIANT' => $onePU['IDENTIFIANT'], 'ID_FONCT' => $key])->all()) {
                        $fonction_user = new FonctionUser();
                        $fonction_user->IDPERSONNE = $onePU['ID_PERSONNE'];
                        $fonction_user->IDENTIFIANT = $onePU['IDENTIFIANT'];
                        $fonction_user->ID_FONCT = $key;
                        $fonction_user->save();
                    }
                }
            }
            return "Attribution des droits d'accès effectuée avec succès";
        }
    }

    /**
     * Get the previous fonction profile rows
     * will permit to check if some right will be delete
     *
     * @param $menu
     * @return array|bool
     */
    public function getPreviousProfileUserByMenu($menu)
    {
        $query = (new Query())->select('fp.*,f.ID_MENU')
            ->from('fonction_profil fp')
            ->innerJoin('fonctionnalite f', 'fp.`ID_FONCT` = f.ID_FONCT')
            ->andWhere(['f.ID_MENU' => $menu])
            ->all();
        return $query;
    }

    public function getProfileUser($code_profil)
    {
        $query = (new Query())->select('up.ID_PERSONNE,up.IDENTIFIANT')
            ->from('user_profil up')
            ->innerJoin('fonction_profil fp', 'up.CODE_PROFIL = fp.CODE_PROFIL')
            ->andWhere(['up.`CODE_PROFIL`' => $code_profil])
            ->distinct()
            ->all();

        return $query;
    }

    /**
     * @param $code_profil
     * @param $id_fonct
     * @return array|bool
     */
    public function getFonctionUser($code_profil, $id_fonct)
    {
        $query = (new Query())->select('fu.*')
            ->from('user_profil uf')
            ->innerJoin('fonction_user fu', ['fu.IDPERSONNE' => 'uf.ID_PERSONNE', 'fu.IDENTIFIANT' => 'uf.IDENTIFIANT'])
            ->andWhere(['uf.CODE_PROFIL' => $code_profil])
            ->andWhere(['fu.ID_FONCT' => $id_fonct])
            ->one();
        return $query;
    }

    public function actionFetch($data)
    {
        var_dump($data);
        die();
    }

    public function getFormAttribs()
    {
        return [
            'ID_FONCT' => [
                'type' => TabularForm::INPUT_HIDDEN,
                'columnOptions' => ['hidden' => true]
            ],
            'NAME_FONCT' => ['type' => TabularForm::INPUT_TEXT],
            'LIBEL_FONCT' => ['type' => TabularForm::INPUT_TEXT],
            'DESCRIPTION_FONCT' => ['type' => TabularForm::INPUT_TEXTAREA],

        ];
    }

    /**
     * Finds the Fonctionnalite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param $code_profil
     * @return \app\models\Fonctionnalite[]|FonctionProfil[]|array|\yii\db\ActiveRecord[]
     */
    protected function findAllModel($code_profil)
    {
        if (($model = FonctionProfil::find()->where(['CODE_PROFIL' => $code_profil])->all()) !== null) {
            return $model;
        }

        return null;
    }
}