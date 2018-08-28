<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use app\models\Patrimoine;

/* @var $this yii\web\View */
/* @var $model app\models\Evenement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evenement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->dropDownList(
        ArrayHelper::map(Patrimoine::find()->all(), 'REFERENCE_PATRIMOINE', 'NOM_PATRIMOINE'),
        ['prompt' => 'Selectionner le patrimoine']
    ) ?>

    <?= $form->field($model, 'LIBELLE_EVENEMENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_EVENEMENT')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'DATE_REALISATION')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'ETAT_EVENEMENT')->radioList(['0' => 'En cours', '1' => 'Terminé']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
