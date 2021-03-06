<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UtilisateurSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Utilisateurs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilisateur-index">

    <?php Pjax::begin()?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'ID_PERSONNE',
            //'IDENTIFIANT',
            'NOM',
            'PRENOM',
            'USERNAME',
            'TELEPHONE',
            'ADRESSE',
            'DATE_NAISSANCE:date',
            'SEXE',
            'EMAIL:email',
            'ETAT',
        ],
    ]); ?>
    <?php Pjax::end()?>
</div>
