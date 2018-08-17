<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fichier */

$this->title = $model->ID_FICHIER;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fichiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID_FICHIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_FICHIER], [
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
            'ID_FICHIER',
            'REFERNCE',
            'NOM_FICHIER',
            'FORMAT_FICHIER',
        ],
    ]) ?>

</div>
