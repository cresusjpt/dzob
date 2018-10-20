<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Patrimoine;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Valeur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="valeur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'REFERENCE_PATRIMOINE')->dropDownList(
        ArrayHelper::map(Patrimoine::find()->all(), 'REFERENCE_PATRIMOINE', 'NOM_PATRIMOINE'),
        [
            'prompt' => 'Selectionner patrimoine',
            'id' => 'patrimoine',
        ]
    ) ?>

    <?= $form->field($model, 'TYPE_PATRIMOINE')->dropDownList(
        ['IMMOBILIER' => 'IMMOBILIER', 'MOBILIER' => 'MOBILIER',], [
            'prompt' => 'Selectionner type patrimoine',
            'id' => 'TYPE_PATRIMOINE',
        ]
    ) ?>

    <?= $form->field($model, 'REF_TYPE_PATRIMOINE')->dropDownList(
        ArrayHelper::map(Patrimoine::find()->all(), 'REFERENCE_PATRIMOINE', 'NOM_PATRIMOINE'),
        [
            'prompt' => 'Selectionner le nom du type de patrimoine',
            'id' => 'type_patri',
        ]
    )
    ?>

    <?= $form->field($model, 'MONTANT')->input('number') ?>

    <?= $form->field($model, 'DATE_DEBUT')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'startDate' => date('Y-m-d'),
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>


    <?= $form->field($model, 'DATE_FIN')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'startDate' => date('Y-m-d'),
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$('#patrimoine ').change(function() {
    var id = $("#TYPE_PATRIMOINE").val();
        $.post('/valeur/list?ref='+$(this).val()+'&id='+id,function(data){
            $("select#type_patri").html(data);
    });
});
$('#TYPE_PATRIMOINE ').change(function() {
    var refe = $("#patrimoine").val();
        $.post('/valeur/list?ref='+refe+'&id='+$(this).val(),function(data){
            $("select#type_patri").html(data);
    });
});
JS;
$this->registerJs($script);
?>
