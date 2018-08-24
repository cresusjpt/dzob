<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evenement */

$this->title = Yii::t('app', 'Modifier Evenement: {nameAttribute}', [
    'nameAttribute' => $model->LIBELLE_EVENEMENT,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evenements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_EVENEMENT, 'url' => ['view', 'id' => $model->ID_EVENEMENT]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="evenement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
