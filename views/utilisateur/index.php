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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin()?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Créer Utilisateur'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID_PERSONNE',
            //'IDENTIFIANT',
            'NOM',
            'PRENOM',
            'USERNAME',
            'TELEPHONE',
            'ADRESSE',
            'DATE_NAISSANCE',
            'SEXE',
            'EMAIL:email',
            //'PASSWORD',
            //'AUTH_KEY',
            //'ACCESS_TOKEN',
            'ETAT',
            //'DM_MODIFICATION',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end()?>
</div>
