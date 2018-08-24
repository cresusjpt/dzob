<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dossier */

$this->title = Yii::t('app', 'Modifier Dossier: {nameAttribute}', [
    'nameAttribute' => $model->LIBELLE_DOSSIER,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dossiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DOSSIER, 'url' => ['view', 'id' => $model->ID_DOSSIER]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="dossier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
