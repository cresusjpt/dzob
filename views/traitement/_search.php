<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TraitementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traitement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_DOSSIER') ?>

    <?= $form->field($model, 'ID_LT') ?>

    <?= $form->field($model, 'ID_TRAITEMENT') ?>

    <?= $form->field($model, 'ETAT_TRAITEMENT') ?>

    <?= $form->field($model, 'COMMENTAIRE_TRAITEMENT') ?>

    <?php // echo $form->field($model, 'DATE_DEBUT') ?>

    <?php // echo $form->field($model, 'DATE_FIN') ?>

    <?php // echo $form->field($model, 'DATE_PREVUE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
