<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Courrier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courrier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERNCE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_PERSONNE')->textInput() ?>

    <?= $form->field($model, 'ID_PRIORITE')->textInput() ?>

    <?= $form->field($model, 'ID_TYPECOURRIER')->textInput() ?>

    <?= $form->field($model, 'DATE')->textInput() ?>

    <?= $form->field($model, 'OBJET_COURRIER')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
