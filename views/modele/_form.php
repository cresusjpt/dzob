<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wadeshuler\ckeditor\widgets\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Modele */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modele-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM_MODELE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NB_PARAMETRE')->input('number') ?>

    <?= $form->field($model, 'CONTENU_MODELE')->widget(CKEditor::class,['options' => ['rows' => 50],]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-blue']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
