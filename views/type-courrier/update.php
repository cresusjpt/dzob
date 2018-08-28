<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeCourrier */

$this->title = Yii::t('app', 'Modifier Type Courrier: {nameAttribute}', [
    'nameAttribute' => $model->NOM_TYPE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_TYPECOURRIER, 'url' => ['view', 'id' => $model->ID_TYPECOURRIER]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="type-courrier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
