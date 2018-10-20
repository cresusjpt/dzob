<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modele */
/* @var $modelParam app\models\ModelParam */

$this->title = Yii::t('app', 'Modifier Modele: {nameAttribute}', [
    'nameAttribute' => $model->NOM_MODELE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modeles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_MODELE, 'url' => ['view', 'id' => $model->ID_MODELE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="modele-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelParam' => $modelParam
    ]) ?>

</div>
