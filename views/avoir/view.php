<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Avoir */

$this->title = $model->REFERENCE_PATRIMOINE . DIRECTORY_SEPARATOR . $model->ID_AYANTDROIT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Avoirs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avoir-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT, 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT, 'REFERENCE_PATRIMOINE' => $model->REFERENCE_PATRIMOINE], [
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
            'ID_PERSONNE',
            'ID_AYANTDROIT',
            'REFERENCE_PATRIMOINE',
        ],
    ]) ?>

</div>
