<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->ID_PERSONNE;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_CLIENT' => $model->ID_CLIENT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_CLIENT' => $model->ID_CLIENT], [
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
            'ID_PERSONNE',
            'ID_CLIENT',
            'NOM',
            'PRENOM',
            'SEXE',
            'TELEPHONE',
            'ADRESSE',
            'DATE_NAISSANCE',
        ],
    ]) ?>

</div>
