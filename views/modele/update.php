<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modele */

$this->title = Yii::t('app', 'Update Modele: {nameAttribute}', [
    'nameAttribute' => $model->ID_MODELE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modeles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_MODELE, 'url' => ['view', 'id' => $model->ID_MODELE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="modele-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
