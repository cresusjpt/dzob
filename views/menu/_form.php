<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Menu;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAME_MENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LIBEL_MENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NUM_ORDREMENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ICONE_NAME_MENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONTROLE')->dropDownList(['OUI'=>'Oui','NON'=>'Non'],['maxlength' => true,'prompt'=>'Controle sur le menu']) ?>

    <?= $form->field($model, 'MEN_ID_MENU')->dropDownList(
        ArrayHelper::map(Menu::find()->all(),'ID_MENU','LIBEL_MENU'),
        ['prompt'=>'Libellé du menu parent','maxlength'=>true]
    ) ?>

    <?= $form->field($model, 'MENU_URL')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enregistrer'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
