<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Document */

$this->title = Yii::t('app', 'Modifier Document: {nameAttribute}', [
    'nameAttribute' => $model->TITRE_DOC,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DOC, 'url' => ['view', 'id' => $model->ID_DOC]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="document-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
