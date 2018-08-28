<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AyantDroit;
use app\models\Patrimoine;

/* @var $this yii\web\View */
/* @var $model app\models\Immobilier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="immobilier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->dropDownList(
        ArrayHelper::map(Patrimoine::find()->all(),'REFERENCE_PATRIMOINE','NOM_PATRIMOINE'),
        ['prompt'=>'Selectionner le patrimoine']
    ) ?>

    <?= $form->field($model, 'ID_AYANTDROIT')->dropDownList(
            ArrayHelper::map(AyantDroit::find()->all(),'ID_AYANTDROIT','civilite'),
            ['prompt'=>'Selectionner le responsable']
    ) ?>

    <?= $form->field($model, 'ADRESSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LATITUDE')->input('number',['step'=>'any']) ?>

    <?= $form->field($model, 'LONGITUDE')->input('number',['step'=>'any']) ?>

    <?= $form->field($model, 'DESCRIPTION_IMMO')->textarea(['rows'=>10,'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
