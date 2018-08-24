<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dossier */

$this->title = $model->LIBELLE_DOSSIER;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dossiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dossier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_DOSSIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_DOSSIER], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_DOSSIER',
            'LIBELLE_DOSSIER',
            'cLASSEUR.NOM_CLASSEUR',
            //'ID_PERSONNE',
            'pERSONNE.NOM',
            'pERSONNE.PRENOM',
            'dOSIDDOSSIER.LIBELLE_DOSSIER',
            'FRAIS_DOSSIER',
            'DATE_CREATION',
            'etatDossier',
            'STATUT_DOSSIER',
            'COMMENTAIRE_DOSSIER',
            'DATE_DMDOSSIER',
        ],
    ]) ?>

</div>
