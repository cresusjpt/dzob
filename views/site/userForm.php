<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

  $form = ActiveForm::begin();
  echo $form->field($model,'name');
  echo $form->field($model,'email');

  echo Html::submitButton('submit',['class'=>'btn btn-success']);
?>
