<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AyantDroit */

$this->title = Yii::t('app', 'Create Ayant Droit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ayant Droits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ayant-droit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
