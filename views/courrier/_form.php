<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\PrioriteCourrier;
use app\models\TypeCourrier;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Courrier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courrier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACTEUR_COURRIER')->textInput() ?>

    <?= $form->field($model, 'ID_PRIORITE')->dropDownList(
        ArrayHelper::map(PrioriteCourrier::find()->all(), 'ID_PRIORITE', 'NATURE_COURRIER'),
        ['prompt' => 'Priorité courrier', 'maxlength' => true]
    ) ?>

    <?= $form->field($model, 'ID_TYPECOURRIER')->dropDownList(
        ArrayHelper::map(TypeCourrier::find()->all(), 'ID_TYPECOURRIER', 'NOM_TYPE'),
        ['prompt' => 'Type courrier', 'maxlength' => true]
    ) ?>

    <?= $form->field($model, 'DATE')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'OBJET_COURRIER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONTENU_COURRIER')->textarea(['rows' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
