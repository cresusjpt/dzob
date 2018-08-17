<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Metadonnee */

$this->title = $model->ID_META;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Metadonnees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metadonnee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID_META], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_META], [
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
            'ID_META',
            'ID_TYPEMETA',
            'META_LIBELLE',
            'META_CONTENU',
        ],
    ]) ?>

</div>
