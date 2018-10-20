<?php

use app\assets\CKEditorAsset;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wadeshuler\ckeditor\widgets\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Modele */
/* @var $form yii\widgets\ActiveForm */

CKEditorAsset::register($this)
?>

<div class="modele-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'NOM_MODELE')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-tasks"></i>Paramètres du modéle</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 10, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelParam[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'ID_MODELE',
                        'MODELE_PARAM',
                        'ORDRE',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelParam as $i => $oneParam): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Paramètre</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                                class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$oneParam->isNewRecord) {
                                    echo Html::activeHiddenInput($oneParam, "[{$i}]ID_MODELE");
                                }
                                ?>
                                <?= $form->field($oneParam, "[{$i}]MODELE_PARAM")->textInput(
                                    ['prompt' => 'Nom du parametre', 'maxlength' => true]
                                ) ?>
                                <?= $form->field($oneParam, "[{$i}]ORDRE")->input('number',
                                    ['prompt' => 'Numero d\'ordre du parametre', 'maxlength' => true]
                                ) ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'CONTENU_MODELE')->widget(CKEditor::class, ['options' => ['rows' => 50],]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-blue']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
