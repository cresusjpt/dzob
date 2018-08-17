<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DossierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dossiers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dossier-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Dossier'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_DOSSIER',
            'ID_CLASSEUR',
            'ID_PERSONNE',
            'ID_CLIENT',
            'DOS_ID_DOSSIER',
            //'LIBELLE_DOSSIER',
            //'COMMENTAIRE_DOSSIER',
            //'DATE_CREATION',
            //'DATE_DMDOSSIER',
            //'FRAIS_DOSSIER',
            //'ETAT_DOSSIER_TRAITEMENT',
            //'STATUT_DOSSIER',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
