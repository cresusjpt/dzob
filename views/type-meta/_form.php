<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TypeMetadonnee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-metadonnee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LIBELLE_TYPEMETA')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
