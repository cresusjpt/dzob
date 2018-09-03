<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Traitement */

$this->title = $model->ID_DOSSIER;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Traitements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traitement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'ID_DOSSIER' => $model->ID_DOSSIER, 'ID_LT' => $model->ID_LT, 'ID_TRAITEMENT' => $model->ID_TRAITEMENT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'ID_DOSSIER' => $model->ID_DOSSIER, 'ID_LT' => $model->ID_LT, 'ID_TRAITEMENT' => $model->ID_TRAITEMENT], [
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
            'ID_DOSSIER',
            'ID_LT',
            'ID_TRAITEMENT',
            'ETAT_TRAITEMENT',
            'COMMENTAIRE_TRAITEMENT:ntext',
            'DATE_DEBUT',
            'DATE_FIN',
            'DATE_PREVUE',
        ],
    ]) ?>

</div>
