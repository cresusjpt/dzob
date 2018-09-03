<?php

use yii\helpers\Html;
use app\models\Utilisateur;
use app\models\Droits;
use app\models\Dossier;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\GrUsager */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gr-usager-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_DROITS')->widget(Select2::class, [
        'data' => ArrayHelper::map(Droits::find()->all(), 'ID_DROITS', 'COMMENTAIRE_DROIT'),
        'options' => [
            'placeholder' => 'le nom du droits sur le dossier ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'IDENTIFIANT')->widget(Select2::class, [
        'data' => ArrayHelper::map(Utilisateur::find()->all(), 'IDENTIFIANT', 'civilite'),
        'options' => [
            'placeholder' => 'Nom et prénom de l\'utilisateur ...',
            'multiple' => true,
            'id' => 'profil'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'ID_DOSSIER')->widget(Select2::class, [
        'data' => ArrayHelper::map(Dossier::find()->all(), 'ID_DOSSIER', 'LIBELLE_DOSSIER'),
        'options' => [
            'placeholder' => 'le dossier...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'GR_LIBELLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GR_DESCRIPTION')->textarea(['rows'=>10,'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
