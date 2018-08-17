<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImmobilierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="immobilier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE') ?>

    <?= $form->field($model, 'ID_IMMOBILIER') ?>

    <?= $form->field($model, 'ID_PERSONNE') ?>

    <?= $form->field($model, 'ID_AYANTDROIT') ?>

    <?= $form->field($model, 'DESCRIPTION_IMMO') ?>

    <?php // echo $form->field($model, 'ADRESSE') ?>

    <?php // echo $form->field($model, 'LATITUDE') ?>

    <?php // echo $form->field($model, 'LONGITUDE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
