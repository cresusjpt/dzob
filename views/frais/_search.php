<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FraisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frais-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_FRAIS') ?>

    <?= $form->field($model, 'ID_DOSSIER') ?>

    <?= $form->field($model, 'MONTANT') ?>

    <?= $form->field($model, 'DATE_REGLE') ?>

    <?= $form->field($model, 'NATURE_FRAIS') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
