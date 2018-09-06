<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Patrimoine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patrimoine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOM_PATRIMOINE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
