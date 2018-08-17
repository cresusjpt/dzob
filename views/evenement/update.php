<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evenement */

$this->title = Yii::t('app', 'Update Evenement: {nameAttribute}', [
    'nameAttribute' => $model->ID_EVENEMENT,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evenements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_EVENEMENT, 'url' => ['view', 'id' => $model->ID_EVENEMENT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="evenement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
