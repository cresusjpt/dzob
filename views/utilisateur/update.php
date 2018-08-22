<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Utilisateur */

$this->title = Yii::t('app', 'Modifier Utilisateur: {nameAttribute}', [
    'nameAttribute' => $model->USERNAME,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utilisateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PERSONNE, 'url' => ['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'IDENTIFIANT' => $model->IDENTIFIANT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="utilisateur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
