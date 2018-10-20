<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Finance */

$this->title = Yii::t('app', 'Modifier Finance: ' . $model->ID_FINANCE, [
    'nameAttribute' => '' . $model->ID_FINANCE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_FINANCE, 'url' => ['view', 'id' => $model->ID_FINANCE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="finance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
