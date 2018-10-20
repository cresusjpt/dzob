<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Finance */

$this->title = Yii::t('app', 'Ajouter Finance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
