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
        <?= Html::a(Yii::t('app', 'Ajouter Dossier'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID_DOSSIER',
            'dOSIDDOSSIER.LIBELLE_DOSSIER',
            'cLASSEUR.NOM_CLASSEUR',
            //'ID_PERSONNE',
            'pERSONNE.NOM',
            'pERSONNE.PRENOM',
            'LIBELLE_DOSSIER',
            //'COMMENTAIRE_DOSSIER',
            'DATE_CREATION',
            //'DATE_DMDOSSIER',
            'FRAIS_DOSSIER',
            'etatDossier',
            //'STATUT_DOSSIER',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
