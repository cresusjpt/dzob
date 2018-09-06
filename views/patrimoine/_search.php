<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatrimoineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patrimoine-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_PATRIMOINE') ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE') ?>

    <?= $form->field($model, 'NOM_PATRIMOINE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
