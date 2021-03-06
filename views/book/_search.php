<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LivreTraitementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="livre-traitement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_LT') ?>

    <?= $form->field($model, 'NOM_TRAITEMENT') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
