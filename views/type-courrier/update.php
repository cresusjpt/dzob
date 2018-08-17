<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeCourrier */

$this->title = Yii::t('app', 'Update Type Courrier: {nameAttribute}', [
    'nameAttribute' => $model->ID_TYPECOURRIER,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_TYPECOURRIER, 'url' => ['view', 'id' => $model->ID_TYPECOURRIER]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="type-courrier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
