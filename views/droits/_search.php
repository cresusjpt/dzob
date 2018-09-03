<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DroitsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="droits-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_DROITS') ?>

    <?= $form->field($model, 'ETAT_DROIT') ?>

    <?= $form->field($model, 'LIBELLE_DROIT') ?>

    <?= $form->field($model, 'COMMENTAIRE_DROIT') ?>

    <?= $form->field($model, 'DATE_DROIT') ?>

    <?php // echo $form->field($model, 'DATE_DM') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
