<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LivreTraitement */

$this->title = Yii::t('app', 'Update Livre Traitement: {nameAttribute}', [
    'nameAttribute' => $model->ID_LT,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Livre Traitements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_LT, 'url' => ['view', 'id' => $model->ID_LT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="livre-traitement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
