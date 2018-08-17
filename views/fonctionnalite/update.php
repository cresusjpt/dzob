<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fonctionnalite */

$this->title = Yii::t('app', 'Update Fonctionnalite: {nameAttribute}', [
    'nameAttribute' => $model->ID_FONCT,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonctionnalites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_FONCT, 'url' => ['view', 'id' => $model->ID_FONCT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fonctionnalite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
