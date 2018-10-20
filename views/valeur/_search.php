<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ValeurSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="valeur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_VALEUR') ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE') ?>

    <?= $form->field($model, 'TYPE_PATRIMOINE') ?>

    <?= $form->field($model, 'MONTANT') ?>

    <?= $form->field($model, 'DATE_DEBUT') ?>

    <?php // echo $form->field($model, 'DATE_FIN') ?>

    <?php // echo $form->field($model, 'REF_TYPE_PATRIMOINE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
