<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Classeur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classeur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM_CLASSEUR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_CLASSEUR')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
