<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mobilier */

$this->title = Yii::t('app', 'Update Mobilier: {nameAttribute}', [
    'nameAttribute' => $model->REFERENCE_PATRIMOINE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mobiliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->REFERENCE_PATRIMOINE, 'url' => ['view', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $model->ID_MOBILIER]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mobilier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
