<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Dossier;

/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php
    if (Yii::$app->session->hasFlash('failed')) {
        ?>
        <div class="alert alert-danger">
            <button data-dismiss="alert" class="close">
                &times;
            </button>
            <strong><?= Yii::$app->session->getFlash('failed') ?></strong>
        </div>
        <?php
    }
    ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'file',['options'=>['tag'=>'span','class'=>'btn btn-success fileinput-button'],'template'=>'<i class="glyphicon glyphicon-plus"></i><span>Ajouter Document</span>{hint}{input}'])->fileInput() ?>

    <table role="presentation" class="table table-striped">
        <tbody class="files"></tbody>
    </table>

    <?= $form->field($model, 'ID_DOSSIER')->dropDownList(
        ArrayHelper::map(Dossier::find()->all(),'ID_DOSSIER','LIBELLE_DOSSIER'),
        ['prompt'=>'Dossier','maxlength'=>true]
    ) ?>

    <?= $form->field($model, 'TITRE_DOC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_DOC')->widget(
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

    <?= $form->field($model, 'DESCRIPTION_DOC')->textarea(['rows'=>10,'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
