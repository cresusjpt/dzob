<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DossierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dossier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID_DOSSIER') ?>

    <?= $form->field($model, 'ID_CLASSEUR') ?>

    <?= $form->field($model, 'ID_PERSONNE') ?>

    <?= $form->field($model, 'ID_CLIENT') ?>

    <?= $form->field($model, 'DOS_ID_DOSSIER') ?>

    <?php // echo $form->field($model, 'LIBELLE_DOSSIER') ?>

    <?php // echo $form->field($model, 'COMMENTAIRE_DOSSIER') ?>

    <?php // echo $form->field($model, 'DATE_CREATION') ?>

    <?php // echo $form->field($model, 'DATE_DMDOSSIER') ?>

    <?php // echo $form->field($model, 'FRAIS_DOSSIER') ?>

    <?php // echo $form->field($model, 'ETAT_DOSSIER_TRAITEMENT') ?>

    <?php // echo $form->field($model, 'STATUT_DOSSIER') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rechercher'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Annuler'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
