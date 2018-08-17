<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fonctionnalite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fonctionnalite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_MENU')->textInput() ?>

    <?= $form->field($model, 'NAME_FONCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LIBEL_FONCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FONCT_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONTROLE_FONCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NUM_ORDREFONCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION_FONCT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
