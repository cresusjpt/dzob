<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rdv */

$this->title = Yii::t('app', 'Modifier Rdv: ' . $model->ID_RDV, [
    'nameAttribute' => '' . $model->ID_RDV,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rdvs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_RDV, 'url' => ['view', 'id' => $model->ID_RDV]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="rdv-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
