<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TYPE_CLIENT')->dropDownList(['PHYSIQUE'=>'Personne Physique','MORALE'=>'Personne Morale'],['prompt'=>'Type client']) ?>

    <?= $form->field($model, 'NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRENOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_NAISSANCE')->textInput() ?>

    <?= $form->field($model, 'TELEPHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADRESSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEXE')->radioList(['M' => 'Masculin','F'=>'Féminin']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
