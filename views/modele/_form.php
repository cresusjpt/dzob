<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Modele */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modele-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_MODELE')->textInput() ?>

    <?= $form->field($model, 'NOM_MODELE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SOURCE_MODELE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
