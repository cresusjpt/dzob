<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use app\models\Utilisateur;

/* @var $this yii\web\View */
/* @var $model app\models\Rdv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rdv-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOTAIRE')->dropDownList(
        ArrayHelper::map(Utilisateur::find()->all(), 'civilite', 'civilite'),
        ['maxlength' => true]) ?>

    <?= $form->field($model, 'NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TEL')->input('numer', ['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_RDV')->widget(DateTimePicker::class, [
        'options' => [
            'placeholder' => 'Selectionner la date et l\'heure du rendez-vous'
        ],
        'pluginOptions' => [
            'todayHighlight' => true,
            'orientation' => 'top',
            'startDate' => date('Y-m-d'),
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:mm:ss',
        ],
        'convertFormat' => true,
    ]) ?>

    <?= $form->field($model, 'OBJET')->textarea(['rows' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enrégistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
