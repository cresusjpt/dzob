<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Traitement */
/* @var $modelT app\models\Traitement */

$this->title = Yii::t('app', 'Update Traitement: ' . $model->ID_DOSSIER, [
    'nameAttribute' => '' . $model->ID_DOSSIER,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Traitements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DOSSIER, 'url' => ['view', 'ID_DOSSIER' => $model->ID_DOSSIER, 'ID_LT' => $model->ID_LT, 'ID_TRAITEMENT' => $model->ID_TRAITEMENT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="traitement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelT' => $modelT,
    ]) ?>

</div>
