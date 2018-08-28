<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeMetadonnee */

$this->title = Yii::t('app', 'Update Type Metadonnee: {nameAttribute}', [
    'nameAttribute' => $model->LIBELLE_TYPEMETA,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Metadonnees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_TYPEMETA, 'url' => ['view', 'id' => $model->ID_TYPEMETA]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="type-metadonnee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
