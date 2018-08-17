<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UtilisateurSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilisateur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_PERSONNE') ?>

    <?= $form->field($model, 'IDENTIFIANT') ?>

    <?= $form->field($model, 'NOM') ?>

    <?= $form->field($model, 'PRENOM') ?>

    <?= $form->field($model, 'SEXE') ?>

    <?php // echo $form->field($model, 'TELEPHONE') ?>

    <?php // echo $form->field($model, 'ADRESSE') ?>

    <?php // echo $form->field($model, 'DATE_NAISSANCE') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'USERNAME') ?>

    <?php // echo $form->field($model, 'PASSWORD') ?>

    <?php // echo $form->field($model, 'AUTH_KEY') ?>

    <?php // echo $form->field($model, 'ACCESS_TOKEN') ?>

    <?php // echo $form->field($model, 'ETAT') ?>

    <?php // echo $form->field($model, 'DM_MODIFICATION') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
