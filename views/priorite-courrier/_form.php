<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrioriteCourrier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="priorite-courrier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NATURE_COURRIER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CLASSER')->radioList(['0' => 'Non', '1' => 'Oui']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
