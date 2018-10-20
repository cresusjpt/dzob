<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avoir */

$this->title = Yii::t('app', 'Modifier Héritier: ' . $model->REFERENCE_PATRIMOINE, [
    'nameAttribute' => '' . $model->REFERENCE_PATRIMOINE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Avoirs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PERSONNE, 'url' => ['view', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT, 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="avoir-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
