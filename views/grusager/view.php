<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GrUsager */

$this->title = $model->ID_DROITS;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groupe d\'utilisateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gr-usager-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'ID_DROITS' => $model->ID_DROITS, 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_DOSSIER' => $model->ID_DOSSIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'ID_DROITS' => $model->ID_DROITS, 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT, 'ID_DOSSIER' => $model->ID_DOSSIER], [
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
            'ID_DROITS',
            'ID_PERSONNE',
            'IDENTIFIANT',
            'ID_DOSSIER',
            'GR_LIBELLE',
            'GR_DESCRIPTION',
        ],
    ]) ?>

</div>
