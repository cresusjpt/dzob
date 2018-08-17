<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PrioriteCourrier */

$this->title = Yii::t('app', 'Update Priorite Courrier: {nameAttribute}', [
    'nameAttribute' => $model->ID_PRIORITE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Priorite Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PRIORITE, 'url' => ['view', 'id' => $model->ID_PRIORITE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="priorite-courrier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
