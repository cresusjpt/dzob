<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SysParam */

$this->title = $model->PARAM_CODE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paramètre Système'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-param-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->PARAM_CODE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->PARAM_CODE], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'La page que vous demandez n\'existe pas.'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PARAM_CODE',
            'PARAM_VALUE',
            'PARAM_DESC',
        ],
    ]) ?>

</div>
