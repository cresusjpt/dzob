<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evenement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evenement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_EVENEMENT')->textInput() ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LIBELLE_EVENEMENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COMMENTAIRE_EVENEMENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_EVENEMENT')->textInput() ?>

    <?= $form->field($model, 'ETAT_EVENEMENT')->textInput() ?>

    <?= $form->field($model, 'DATE_REALISATION')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
