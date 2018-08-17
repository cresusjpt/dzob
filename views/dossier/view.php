<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dossier */

$this->title = $model->ID_DOSSIER;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dossiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dossier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID_DOSSIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_DOSSIER], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_DOSSIER',
            'ID_CLASSEUR',
            'ID_PERSONNE',
            'ID_CLIENT',
            'DOS_ID_DOSSIER',
            'LIBELLE_DOSSIER',
            'COMMENTAIRE_DOSSIER',
            'DATE_CREATION',
            'DATE_DMDOSSIER',
            'FRAIS_DOSSIER',
            'ETAT_DOSSIER_TRAITEMENT',
            'STATUT_DOSSIER',
        ],
    ]) ?>

</div>
