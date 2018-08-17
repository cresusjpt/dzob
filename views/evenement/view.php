<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evenement */

$this->title = $model->ID_EVENEMENT;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evenements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evenement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID_EVENEMENT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID_EVENEMENT], [
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
            'ID_EVENEMENT',
            'REFERENCE_PATRIMOINE',
            'LIBELLE_EVENEMENT',
            'COMMENTAIRE_EVENEMENT',
            'DATE_EVENEMENT',
            'ETAT_EVENEMENT',
            'DATE_REALISATION',
        ],
    ]) ?>

</div>
