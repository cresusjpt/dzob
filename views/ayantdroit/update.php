<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AyantDroit */

$this->title = Yii::t('app', 'Modifier Ayant Droit: {nameAttribute}', [
    'nameAttribute' => $model->NOM.' '.$model->PRENOM,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ayant Droits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PERSONNE, 'url' => ['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="ayant-droit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
