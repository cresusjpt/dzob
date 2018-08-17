<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Immobilier */

$this->title = Yii::t('app', 'Create Immobilier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Immobiliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="immobilier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
