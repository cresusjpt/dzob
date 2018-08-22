<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Courrier */

$this->title = Yii::t('app', 'Modifier Courrier: {nameAttribute}', [
    'nameAttribute' => $model->REFERENCE.'/'.$model->DATE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->REFERENCE, 'url' => ['view', 'id' => $model->REFERENCE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="courrier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
