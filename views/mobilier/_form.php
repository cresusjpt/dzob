<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Patrimoine;
use app\models\AyantDroit;

/* @var $this yii\web\View */
/* @var $model app\models\Mobilier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mobilier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->dropDownList(
            ArrayHelper::map(Patrimoine::find()->all(),'REFERENCE_PATRIMOINE','NOM_PATRIMOINE'),
            ['prompt'=>'Selectionner le patrimoine']
    ) ?>

    <?= $form->field($model, 'ID_AYANTDROIT')->dropDownList(
        ArrayHelper::map(Patrimoine::find()->all(),'ID_AYANTDROIT','civilite'),
        ['prompt'=>'Selectionner le patrimoine']
    ) ?>

    <?= $form->field($model, 'DESCRIPTION_MO')->textarea(['rows'=>10,'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
