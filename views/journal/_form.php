<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Utilisateur;
use app\models\Action;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SysLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CODE_ACTION')->dropDownList(
        ArrayHelper::map(Action::find()->all(),'CODE_ACTION','LIB_ACTION'),
        ['prompt'=>'Action','maxlength'=>true]
    ) ?>

    <?= $form->field($model, 'IDENTIFIANT')->dropDownList(
        ArrayHelper::map(Utilisateur::find()->all(),'IDENTIFIANT','USERNAME'),
        ['prompt'=>'Selectionner l\'utilisateur']
    ) ?>

    <?= $form->field($model, 'DATE_LOG')->textInput() ?>

    <?= $form->field($model, 'TABLE_LOG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LIB_LOG')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
