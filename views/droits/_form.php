<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Droits */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="droits-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ETAT_DROIT')->dropDownList([ 'ACTIF' => 'ACTIF', 'INACTIF' => 'INACTIF', ], ['prompt' => 'Selectionner l\'état du droit']) ?>

    <?= $form->field($model, 'LIBELLE_DROIT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COMMENTAIRE_DROIT')->textarea(['rows'=>10,'maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_DROIT')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'endDate'=>date('Y-m-d'),
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
