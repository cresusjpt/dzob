<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 21/09/2018
 * Time: 01:52
 */

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Droits;
use kartik\select2\Select2;

$this->title = 'Remplir les champs pour la génération';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modeles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modele-generer">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin();
    $modeli = Yii::createObject(\app\models\Droits::class); ?>
    <?php
    for ($i = 0; $i < $model->NB_PARAMETRE; $i++) {
        ?>
        <?= $form->field($model, 'param_value')->textInput(['placeholder' => $modelParam[$i]->MODELE_PARAM, 'name' => 'param_value' . $i, 'id' => 'param_value' . $i])->label(false) ?>
        <?php
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Générer'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>

</div>
