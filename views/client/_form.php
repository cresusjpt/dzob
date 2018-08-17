<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_PERSONNE')->textInput() ?>

    <?= $form->field($model, 'ID_CLIENT')->textInput() ?>

    <?= $form->field($model, 'NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRENOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEXE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TELEPHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADRESSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_NAISSANCE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
