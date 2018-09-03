<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dossier;
use app\models\LivreTraitement;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Traitement */
/* @var $modelT app\models\Traitement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traitement-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'ID_DOSSIER')->dropDownList(
        ArrayHelper::map(Dossier::find()->all(),'ID_DOSSIER','LIBELLE_DOSSIER'),
        ['prompt'=>'Libelle dossier','maxlength'=>true]
    ) ?>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-tasks"></i>Traitements</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 10, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelT[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'ID_DOSSIER',
                        'ID_LT',
                        'ETAT_TRAITEMENT',
                        'COMMENTAIRE_TRAITEMENT',
                        'DATE_DEBUT',
                        'DATE_FIN',
                        'DATE_PREVUE',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelT as $i => $modelTraitement): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Traitement</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelTraitement->isNewRecord) {
                                    echo Html::activeHiddenInput($modelTraitement, "[{$i}]ID_DOSSIER");
                                }
                                ?>
                                <?= $form->field($modelTraitement, "[{$i}]ID_LT")->dropDownList(
                                    ArrayHelper::map(LivreTraitement::find()->all(),'ID_LT','NOM_TRAITEMENT'),
                                    ['prompt'=>'Nom du traitement','maxlength'=>true]
                                ) ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($modelTraitement, "[{$i}]DATE_DEBUT")->widget(
                                            DatePicker::class, [
                                            // inline too, not bad
                                            'inline' => false,
                                            'language' => 'fr',
                                            //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'startDate'=>date('Y-m-d'),
                                                'todayHighlight' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelTraitement, "[{$i}]DATE_PREVUE")->widget(
                                            DatePicker::class, [
                                            // inline too, not bad
                                            'inline' => false,
                                            'language' => 'fr',
                                            //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'startDate'=>date('Y-m-d'),
                                                'todayHighlight' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelTraitement, "[{$i}]DATE_FIN")->widget(
                                            DatePicker::class, [
                                            // inline too, not bad
                                            'inline' => false,
                                            'language' => 'fr',
                                            //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'startDate'=>date('Y-m-d'),
                                                'todayHighlight' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ]); ?>
                                    </div>
                                </div><!-- .row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelTraitement, "[{$i}]ETAT_TRAITEMENT")->dropDownList(['0'=>'EnCours','1'=>'Terminé']) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelTraitement, "[{$i}]COMMENTAIRE_TRAITEMENT")->textarea(['rows'=>6,'maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
