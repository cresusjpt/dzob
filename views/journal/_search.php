<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_LOG') ?>

    <?= $form->field($model, 'CODE_ACTION') ?>

    <?= $form->field($model, 'ID_PERSONNE') ?>

    <?= $form->field($model, 'IDENTIFIANT') ?>

    <?= $form->field($model, 'DATE_LOG') ?>

    <?php // echo $form->field($model, 'TABLE_LOG') ?>

    <?php // echo $form->field($model, 'LIB_LOG') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
