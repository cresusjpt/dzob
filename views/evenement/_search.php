<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EvenementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evenement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_EVENEMENT') ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE') ?>

    <?= $form->field($model, 'LIBELLE_EVENEMENT') ?>

    <?= $form->field($model, 'COMMENTAIRE_EVENEMENT') ?>

    <?= $form->field($model, 'DATE_EVENEMENT') ?>

    <?php // echo $form->field($model, 'ETAT_EVENEMENT') ?>

    <?php // echo $form->field($model, 'DATE_REALISATION') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
