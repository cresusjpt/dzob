<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\AyantDroit;
use app\models\Patrimoine;

/* @var $this yii\web\View */
/* @var $model app\models\Avoir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avoir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_AYANTDROIT')->widget(Select2::class, [
        'data' => ArrayHelper::map(AyantDroit::find()->all(), 'ID_AYANTDROIT', 'civilite'),
        'options' => [
            'placeholder' => 'Nom de l\'héritier ...', 'id' => 'ayant_droit',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>


    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->widget(Select2::class, [
        'data' => ArrayHelper::map(Patrimoine::find()->all(), 'REFERENCE_PATRIMOINE', 'NOM_PATRIMOINE'),
        'options' => ['placeholder' => 'Nom du patrimoine ...', 'id' => 'patrimoine'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enrégistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
