<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mobilier */

$this->title = $model->REFERENCE_PATRIMOINE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mobiliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobilier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $model->ID_MOBILIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $model->ID_MOBILIER], [
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
            'ID_MOBILIER',
            'ID_PERSONNE',
            'ID_AYANTDROIT',
            'DESCRIPTION_MO',
        ],
    ]) ?>

</div>
