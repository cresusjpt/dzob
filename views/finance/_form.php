<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Patrimoine;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Finance */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="finance-form">

    <?php
    if (Yii::$app->session->hasFlash('required')) {
        ?>
        <div class="alert alert-danger">
            <button data-dismiss="alert" class="close">
                &times;
            </button>
            <strong><?= Yii::$app->session->getFlash('required') ?></strong>
        </div>
        <?php
    }
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->widget(Select2::class, [
        'data' => ArrayHelper::map(Patrimoine::find()->all(), 'REFERENCE_PATRIMOINE', 'NOM_PATRIMOINE'),
        'options' => ['placeholder' => 'Nom du patrimoine ...', 'id' => 'ref_patrimoine'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'TYPE_PATRIMOINE')->dropDownList(['IMMO' => 'Immobilier', 'MO' => 'Mobilier'], ['prompt' => 'Selectionner le type de patrimoine'])
    ?>

    <?= $form->field($model, 'MONTANT')->input('number') ?>

    <?= $form->field($model, 'DATE_FINANCE')->widget(
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

    <?= $form->field($model, 'NATURE_FINANCE')->widget(Select2::class, [
        'data' => ['ENTREE' => 'ENTREE', 'SORTIE' => 'SORTIE'],
        'options' => ['placeholder' => 'Nature de la finance ...', 'id' => 'nature_finance'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div style="display: none" class="fileupload">
        <?= $form->field($model, 'file', ['options' => ['tag' => 'span', 'class' => 'btn btn-success fileinput-button'], 'template' => '<i class="glyphicon glyphicon-plus"></i><span>Ajouter un Justificatif</span>{hint}{input}'])->fileInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enrégistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$(document).ready(function () {
$('#nature_finance').on('change',function () {
if ($(this).val() === 'ENTREE'){
$('.fileupload').show();
}else{
$('.fileupload').hide();
}
});
});
JS;
$this->registerJs($script);
?>

