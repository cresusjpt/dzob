<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TypeCourrier */

$this->title = $model->ID_TYPECOURRIER;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-courrier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID_TYPECOURRIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_TYPECOURRIER], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_TYPECOURRIER',
            'NOM_TYPE',
        ],
    ]) ?>

</div>
