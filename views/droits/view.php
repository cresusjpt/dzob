<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Droits */

$this->title = $model->LIBELLE_DROIT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Droits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="droits-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_DROITS], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_DROITS], [
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
            //'ID_DROITS',
            'LIBELLE_DROIT',
            'DATE_DROIT:date',
            'ETAT_DROIT',
            'COMMENTAIRE_DROIT',
            'DATE_DM:date',
        ],
    ]) ?>

</div>
