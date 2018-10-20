<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Valeur */

$this->title = Yii::t('app', 'Update Valeur: ' . $model->ID_VALEUR, [
    'nameAttribute' => '' . $model->ID_VALEUR,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Valeurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_VALEUR, 'url' => ['view', 'id' => $model->ID_VALEUR]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="valeur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
