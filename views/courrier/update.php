<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Courrier */

$this->title = Yii::t('app', 'Update Courrier: {nameAttribute}', [
    'nameAttribute' => $model->REFERNCE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->REFERNCE, 'url' => ['view', 'id' => $model->REFERNCE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="courrier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
