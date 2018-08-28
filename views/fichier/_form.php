<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Courrier;
use yii\helpers\ArrayHelper;
use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model app\models\Fichier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichier-form">

    <div class="alert alert-success">
        <button data-dismiss="alert" class="close">
            &times;
        </button>
        <strong><?= Yii::t('app','Si vous ajouter ou modifier un fichier utilisez le bouton Démarrer, Sinon c\'est le bouton Enrégistrer')?></strong>
    </div>

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

    <?= $form->field($model, 'REFERENCE')->dropDownList(
        ArrayHelper::map(Courrier::find()->all(), 'REFERENCE', 'displayName'),
        ['prompt' => 'Selectionner la réference du courrier']
    ) ?>

    <?= $form->field($model, 'NOM_FICHIER')->textInput(['maxlength' => true]) ?>

    <?= FileUploadUI::widget([
        'model' => $model,
        'attribute' => 'file',
        'url' => ['/fichier/file'],
        'gallery' => true,
        'fieldOptions' => [
            'multiple' => true,
            'accept' => '*',
        ],
        'clientOptions' => [
            'maxFileSize' => 10000000000,
        ],
        // ...
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                console.log("Trop fatigué que cela ne reussisse pas");
                                console.log(e);
                                console.log(data);
                            }',
            'fileuploadfail' => 'function(e, data) {
                                console.log("Encore un echec. Mais ou va le monde");
                                console.log(e);
                                console.log(data);
                            }',
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
