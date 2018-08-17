<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SysLog */

$this->title = Yii::t('app', 'Create Sys Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
