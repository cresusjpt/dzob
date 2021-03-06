<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AyantDroitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ayant-droit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_PERSONNE') ?>

    <?= $form->field($model, 'ID_AYANTDROIT') ?>

    <?= $form->field($model, 'NOM') ?>

    <?= $form->field($model, 'PRENOM') ?>

    <?= $form->field($model, 'SEXE') ?>

    <?php // echo $form->field($model, 'TELEPHONE') ?>

    <?php // echo $form->field($model, 'ADRESSE') ?>

    <?php // echo $form->field($model, 'DATE_NAISSANCE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
