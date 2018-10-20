<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mobilier */

$this->title = $model->DESCRIPTION_MO;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mobiliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobilier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $model->ID_MOBILIER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE, 'ID_MOBILIER' => $model->ID_MOBILIER], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Voulez vous vraiment supprimer l\'élément?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'REFERENCE_PATRIMOINE',
            'ID_MOBILIER',
            'ID_PERSONNE',
            'ID_AYANTDROIT',
            'DESCRIPTION_MO',
            'image'
        ],
    ]) ?>

</div>
