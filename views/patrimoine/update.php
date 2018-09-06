<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patrimoine */

$this->title = Yii::t('app', 'Modifier Patrimoine: ' . $model->ID_PATRIMOINE, [
    'nameAttribute' => '' . $model->ID_PATRIMOINE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patrimoines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PATRIMOINE, 'url' => ['view', 'id' => $model->ID_PATRIMOINE]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modifier');
?>
<div class="patrimoine-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
