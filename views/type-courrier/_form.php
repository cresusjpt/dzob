<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TypeCourrier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-courrier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM_TYPE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
