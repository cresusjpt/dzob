<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Droits */

$this->title = Yii::t('app', 'Modifier Droits: ' . $model->LIBELLE_DROIT, [
    'nameAttribute' => '' . $model->ID_DROITS,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Droits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DROITS, 'url' => ['view', 'id' => $model->ID_DROITS]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="droits-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
