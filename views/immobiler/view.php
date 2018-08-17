<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Immobilier */

$this->title = $model->REFERENCE_PATRIMOINE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Immobiliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="immobilier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $model->ID_IMMOBILIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $model->ID_IMMOBILIER], [
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
            'REFERENCE_PATRIMOINE',
            'ID_IMMOBILIER',
            'ID_PERSONNE',
            'ID_AYANTDROIT',
            'DESCRIPTION_IMMO',
            'ADRESSE',
            'LATITUDE',
            'LONGITUDE',
        ],
    ]) ?>

</div>
