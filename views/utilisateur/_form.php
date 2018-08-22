<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Utilisateur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilisateur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRENOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TELEPHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->input('email',['maxlength' => true]) ?>

    <?= $form->field($model, 'ADRESSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'USERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ETAT')->dropDownList(['ACTIF'=>'Actif','INACTIF'=>'Inactif'],['prompt'=>'Statut']) ?>

    <?= $form->field($model, 'SEXE')->radioList(['M' => 'Masculin','F'=>'Féminin']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
