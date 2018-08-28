<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TypeMetadonnee;

/* @var $this yii\web\View */
/* @var $model app\models\Metadonnee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metadonnee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID_TYPEMETA')->dropDownList(
            ArrayHelper::map(TypeMetadonnee::find()->all(),'ID_TYPEMETA','LIBELLE_TYPEMETA'),
            [
                    'prompt'=>'Selectionner Type métadonnee'
            ]
    ) ?>

    <?= $form->field($model, 'META_LIBELLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'META_CONTENU')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
