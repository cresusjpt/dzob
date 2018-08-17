<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SysParam */

$this->title = Yii::t('app', 'Create Sys Param');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Params'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-param-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
