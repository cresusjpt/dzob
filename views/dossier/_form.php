<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dossier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dossier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_DOSSIER')->textInput() ?>

    <?= $form->field($model, 'ID_CLASSEUR')->textInput() ?>

    <?= $form->field($model, 'ID_PERSONNE')->textInput() ?>

    <?= $form->field($model, 'ID_CLIENT')->textInput() ?>

    <?= $form->field($model, 'DOS_ID_DOSSIER')->textInput() ?>

    <?= $form->field($model, 'LIBELLE_DOSSIER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COMMENTAIRE_DOSSIER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_CREATION')->textInput() ?>

    <?= $form->field($model, 'DATE_DMDOSSIER')->textInput() ?>

    <?= $form->field($model, 'FRAIS_DOSSIER')->textInput() ?>

    <?= $form->field($model, 'ETAT_DOSSIER_TRAITEMENT')->textInput() ?>

    <?= $form->field($model, 'STATUT_DOSSIER')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
