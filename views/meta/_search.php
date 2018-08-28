<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MetadonneeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metadonnee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_META') ?>

    <?= $form->field($model, 'ID_TYPEMETA') ?>

    <?= $form->field($model, 'META_LIBELLE') ?>

    <?= $form->field($model, 'META_CONTENU') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
