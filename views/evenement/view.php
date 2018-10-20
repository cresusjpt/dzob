<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evenement */

$this->title = $model->LIBELLE_EVENEMENT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evenements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evenement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->ID_EVENEMENT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->ID_EVENEMENT], [
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
            //'ID_EVENEMENT',
            //'REFERENCE_PATRIMOINE',
            'LIBELLE_EVENEMENT',
            'DATE_EVENEMENT:date',
            'DATE_REALISATION:date',
            'COMMENTAIRE_EVENEMENT:ntext',
            'ETAT_EVENEMENT',
        ],
    ]) ?>

</div>
