<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Immobilier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="immobilier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_IMMOBILIER')->textInput() ?>

    <?= $form->field($model, 'ID_PERSONNE')->textInput() ?>

    <?= $form->field($model, 'ID_AYANTDROIT')->textInput() ?>

    <?= $form->field($model, 'DESCRIPTION_IMMO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADRESSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LATITUDE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LONGITUDE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
