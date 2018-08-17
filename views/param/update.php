<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysParam */

$this->title = Yii::t('app', 'Update Sys Param: {nameAttribute}', [
    'nameAttribute' => $model->PARAM_CODE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Params'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PARAM_CODE, 'url' => ['view', 'id' => $model->PARAM_CODE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sys-param-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
