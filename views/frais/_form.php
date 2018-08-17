<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Frais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_FRAIS')->textInput() ?>

    <?= $form->field($model, 'ID_DOSSIER')->textInput() ?>

    <?= $form->field($model, 'MONTANT')->textInput() ?>

    <?= $form->field($model, 'DATE_REGLE')->textInput() ?>

    <?= $form->field($model, 'NATURE_FRAIS')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
