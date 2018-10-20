<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Profil;

/* @var $this yii\web\View */
/* @var $model app\models\Utilisateur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilisateur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRENOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_NAISSANCE')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'endDate' => date('Y-m-d'),
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'TELEPHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->input('email', ['maxlength' => true]) ?>

    <?= $form->field($model, 'ADRESSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'USERNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rawpassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ETAT')->dropDownList(['ACTIF' => 'Actif', 'INACTIF' => 'Inactif'], ['prompt' => 'Statut']) ?>

    <?= $form->field($model, 'profil')->widget(Select2::class, [
        'data' => ArrayHelper::map(Profil::find()->all(), 'CODE_PROFIL', 'LIBELLE'),
        'options' => [
            'placeholder' => 'Selectionner le profil de l\'utilisateur ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'SEXE')->radioList(['M' => 'Masculin', 'F' => 'Féminin']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
