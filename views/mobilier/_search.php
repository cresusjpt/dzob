<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MobilierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mobilier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE') ?>

    <?= $form->field($model, 'ID_MOBILIER') ?>

    <?= $form->field($model, 'ID_PERSONNE') ?>

    <?= $form->field($model, 'ID_AYANTDROIT') ?>

    <?= $form->field($model, 'DESCRIPTION_MO') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
