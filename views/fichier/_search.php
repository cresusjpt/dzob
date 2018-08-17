<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FichierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_FICHIER') ?>

    <?= $form->field($model, 'REFERNCE') ?>

    <?= $form->field($model, 'NOM_FICHIER') ?>

    <?= $form->field($model, 'FORMAT_FICHIER') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
