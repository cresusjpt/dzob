<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fichier */

$this->title = Yii::t('app', 'Update Fichier: {nameAttribute}', [
    'nameAttribute' => $model->ID_FICHIER,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fichiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_FICHIER, 'url' => ['view', 'id' => $model->ID_FICHIER]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fichier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
