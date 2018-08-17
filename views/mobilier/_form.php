<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mobilier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mobilier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_MOBILIER')->textInput() ?>

    <?= $form->field($model, 'ID_PERSONNE')->textInput() ?>

    <?= $form->field($model, 'ID_AYANTDROIT')->textInput() ?>

    <?= $form->field($model, 'DESCRIPTION_MO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
