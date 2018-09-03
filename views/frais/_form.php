<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dossier;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Frais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_DOSSIER')->dropDownList(
    ArrayHelper::map(Dossier::find()->all(),'ID_DOSSIER','LIBELLE_DOSSIER'),
    ['prompt'=>'Selectionner le dossier','maxlength'=>true]
    ) ?>

    <?= $form->field($model, 'MONTANT')->input('number') ?>

    <?= $form->field($model, 'DATE_REGLE')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'endDate'=>date('Y-m-d'),
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
