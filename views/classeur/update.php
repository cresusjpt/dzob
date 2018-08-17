<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Classeur */

$this->title = Yii::t('app', 'Update Classeur: {nameAttribute}', [
    'nameAttribute' => $model->ID_CLASSEUR,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classeurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_CLASSEUR, 'url' => ['view', 'id' => $model->ID_CLASSEUR]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="classeur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
