<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RdvSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rdv-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_RDV') ?>

    <?= $form->field($model, 'NOM') ?>

    <?= $form->field($model, 'TEL') ?>

    <?= $form->field($model, 'OBJET') ?>

    <?= $form->field($model, 'NOTAIRE') ?>

    <?php // echo $form->field($model, 'DATE_PRISE') ?>

    <?php // echo $form->field($model, 'DATE_RDV') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
