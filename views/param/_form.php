<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysParam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-param-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PARAM_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PARAM_VALUE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PARAM_DESC')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
