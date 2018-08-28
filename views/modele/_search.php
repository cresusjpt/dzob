<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModeleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modele-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_MODELE') ?>

    <?= $form->field($model, 'NOM_MODELE') ?>

    <?= $form->field($model, 'SOURCE_MODELE') ?>

    <?= $form->field($model, 'CONTENU_MODELE') ?>

    <?= $form->field($model, 'NB_PARAMETRE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
