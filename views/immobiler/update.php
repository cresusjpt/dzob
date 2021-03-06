<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Immobilier */

$this->title = Yii::t('app', 'Modifier Immobilier: {nameAttribute}', [
    'nameAttribute' => $model->DESCRIPTION_IMMO,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Immobiliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->REFERENCE_PATRIMOINE, 'url' => ['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_IMMOBILIER' => $model->ID_IMMOBILIER]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="immobilier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
