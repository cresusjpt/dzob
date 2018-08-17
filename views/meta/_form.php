<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Metadonnee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metadonnee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_META')->textInput() ?>

    <?= $form->field($model, 'ID_TYPEMETA')->textInput() ?>

    <?= $form->field($model, 'META_LIBELLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'META_CONTENU')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
