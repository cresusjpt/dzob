<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Classeur;
use app\models\Dossier;
use app\models\Client;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Dossier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dossier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_CLASSEUR')->dropDownList(
        ArrayHelper::map(Classeur::find()->all(),'ID_CLASSEUR','NOM_CLASSEUR'),
        ['prompt'=>'Classeur','maxlength'=>true]
    ) ?>

    <?= $form->field($model, 'ID_CLIENT')->dropDownList(
        ArrayHelper::map(Client::find()->all(),'ID_CLIENT','NOM'),
        ['prompt'=>'Client','maxlength'=>true]
    ) ?>

    <?= $form->field($model, 'DOS_ID_DOSSIER')->dropDownList(
        ArrayHelper::map(Dossier::find()->all(),'ID_DOSSIER','LIBELLE_DOSSIER'),
        ['prompt'=>'Dossier parent','maxlength'=>true]
    ) ?>

    <?= $form->field($model, 'LIBELLE_DOSSIER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FRAIS_DOSSIER')->input('number') ?>

    <?= $form->field($model, 'DATE_CREATION')->widget(
        DatePicker::class, [
        // inline too, not bad
        'inline' => false,
        'language' => 'fr',
        //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'STATUT_DOSSIER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COMMENTAIRE_DOSSIER')->textarea(['rows'=>10,'maxlength' => true]) ?>

    <?= $form->field($model, 'ETAT_DOSSIER_TRAITEMENT')->radioList([
        '0'=>'En cours',
        '1'=>'Terminé',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
