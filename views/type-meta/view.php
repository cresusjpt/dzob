<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TypeMetadonnee */

$this->title = $model->ID_TYPEMETA;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Metadonnees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-metadonnee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID_TYPEMETA], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_TYPEMETA], [
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
            'ID_TYPEMETA',
            'LIBELLE_TYPEMETA',
        ],
    ]) ?>

</div>
