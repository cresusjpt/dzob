<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_DOC')->textInput() ?>

    <?= $form->field($model, 'TITRE_DOC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION_DOC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_DOC')->textInput() ?>

    <?= $form->field($model, 'DATE_EFFECTIVE')->textInput() ?>

    <?= $form->field($model, 'CREATEUR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SOURCE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
