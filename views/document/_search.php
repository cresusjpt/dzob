<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_DOC') ?>

    <?= $form->field($model, 'TITRE_DOC') ?>

    <?= $form->field($model, 'DESCRIPTION_DOC') ?>

    <?= $form->field($model, 'DATE_DOC') ?>

    <?= $form->field($model, 'DATE_EFFECTIVE') ?>

    <?php // echo $form->field($model, 'CREATEUR') ?>

    <?php // echo $form->field($model, 'SOURCE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
