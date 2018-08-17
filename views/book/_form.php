<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LivreTraitement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="livre-traitement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_LT')->textInput() ?>

    <?= $form->field($model, 'NOM_TRAITEMENT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
