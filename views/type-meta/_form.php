<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TypeMetadonnee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-metadonnee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_TYPEMETA')->textInput() ?>

    <?= $form->field($model, 'LIBELLE_TYPEMETA')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
