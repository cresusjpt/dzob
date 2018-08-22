<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AyantDroit */

$this->title = $model->NOM.' '.$model->PRENOM;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ayant Droits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ayant-droit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'ID_PERSONNE' => $model->ID_PERSONNE, 'ID_AYANTDROIT' => $model->ID_AYANTDROIT], [
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
            'NOM',
            'PRENOM',
            'SEXE',
            'TELEPHONE',
            'ADRESSE',
            'DATE_NAISSANCE',
        ],
    ]) ?>

</div>
