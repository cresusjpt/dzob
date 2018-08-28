<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Frais */

$this->title = Yii::t('app', 'Modifier Frais: {nameAttribute}', [
    'nameAttribute' => $model->MONTANT.DIRECTORY_SEPARATOR.$model->DATE_REGLE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_FRAIS, 'url' => ['view', 'id' => $model->ID_FRAIS]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="frais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
