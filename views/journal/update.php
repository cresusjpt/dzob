<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysLog */

$this->title = Yii::t('app', 'Update Sys Log: {nameAttribute}', [
    'nameAttribute' => $model->ID_LOG,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_LOG, 'url' => ['view', 'id' => $model->ID_LOG]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sys-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
